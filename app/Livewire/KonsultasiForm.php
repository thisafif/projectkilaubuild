<?php

namespace App\Livewire;

use Livewire\Component;

// use Laravolt\Indonesia\Models\Province;
// use Laravolt\Indonesia\Models\Regency;
// use Laravolt\Indonesia\Models\District;
use Illuminate\Support\Facades\DB;

class KonsultasiForm extends Component
{
    public $nama = '';
    public $noWhatsapp = '';
    public $jenisKonsultasi = '';
    public $detailKonsultasi = '';

    public $selectedDate; 
    public array $bookedDates = [];

    public $provinsi;
    public $kabupaten;
    public $kecamatan;

    public $daftarProvinsi = [];
    public $daftarKabupaten = [];
    public $daftarKecamatan = [];

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
        $this->bookedDates = [
            now()->addDays(2)->format('Y-m-d'),
            now()->addDays(5)->format('Y-m-d'),
        ];
        
        $this->daftarProvinsi = DB::table('indonesia_provinces')->get();
        $this->daftarKabupaten = [];
        $this->daftarKecamatan = [];
    }

    public function updatedProvinsi($provinceId)
    {
        $provinsi = DB::table('indonesia_provinces')->find($provinceId);

        if ($provinsi) {
            $this->daftarKabupaten = DB::table('indonesia_cities')
                                      ->where('province_code', $provinsi->code)
                                      ->get();
        } else {
            $this->daftarKabupaten = [];
        }
        $this->kabupaten = null;
        $this->kecamatan = null;
        $this->daftarKecamatan = [];
    }

    public function updatedKabupaten($regencyId)
    {
        $kabupaten = DB::table('indonesia_cities')->find($regencyId);

        if ($kabupaten) {
            $this->daftarKecamatan = DB::table('indonesia_districts')
                                      ->where('city_code', $kabupaten->code) 
                                      ->get();
        } else {
            $this->daftarKecamatan = [];
        }
        $this->kecamatan = null;
    }

    public function simpanKonsultasi()
    {
        $data = $this->validate([
            'nama' => 'required',
            'noWhatsapp' => 'required|numeric',
            'selectedDate' => 'required|date',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'jenisKonsultasi' => 'required',
            'detailKonsultasi' => 'nullable|string|max:1000',
        ]);

        $nomorBersih = $data['noWhatsapp'];
        if (str_starts_with($nomorBersih, '0')) {
            $nomorBersih = ltrim($nomorBersih, '0'); 
        }
        $nomorWAFinal = '62' . $nomorBersih;

        DB::table('konsultasi_baru')->insert([
            'nama' => $data['nama'],
            'no_wa' => $nomorWAFinal,
            'province_id' => $data['provinsi'],
            'regency_id' => $data['kabupaten'],
            'district_id' => $data['kecamatan'],
            'jenis' => $data['jenisKonsultasi'],
            'detail' => $data['detailKonsultasi'],
            'tanggal' => $data['selectedDate'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $namaProvinsi = DB::table('indonesia_provinces')->where('id', $this->provinsi)->value('name');
        $namaKabupaten = DB::table('indonesia_cities')->where('id', $this->kabupaten)->value('name');
        $namaKecamatan = DB::table('indonesia_districts')->where('id', $this->kecamatan)->value('name'); 

        $nomorTujuan = '6282295444284';

        $pesan = "Halo, saya ingin konsultasi dengan Kilau Build.\n\n";
        $pesan .= "Nama: " . $this->nama . "\n";
        $pesan .= "No. WhatsApp: " . $nomorWAFinal . "\n";
        $pesan .= "Lokasi: " . $namaKecamatan . ", " . $namaKabupaten . ", " . $namaProvinsi . "\n";
        $pesan .= "Jenis Konsultasi: " . $this->jenisKonsultasi . "\n";
        $pesan .= "Tanggal Pilihan: " . $this->selectedDate . "\n\n";
        $pesan .= "Detail: \n" . $this->detailKonsultasi;

        $pesanEncoded = urlencode($pesan);
        $whatsappUrl = "https://wa.me/" . $nomorTujuan . "?text=" . $pesanEncoded;

        session()->flash('sukses', 'Formulir konsultasi berhasil terkirim!');
        $this->reset(); 
        $this->mount();
        $this->dispatch('buka-wa', url: $whatsappUrl);
    }

    public function render()
    {
        return view('livewire.konsultasi-form');
    }
}