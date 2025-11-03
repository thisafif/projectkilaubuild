<?php

namespace App\Livewire;

use App\Models\JadwalKonsultasi;
use App\Models\Konsultasi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class KonsultasiForm extends Component
{
    public string $nama = '';

    public string $noWhatsapp = '';

    public string $tipeKonsultasi = '';

    public string $jenisKonsultasi = '';

    public string $detailKonsultasi = '';

    public ?string $selectedDate = null;

    public ?string $selectedTime = null;

    public array $availableSlots = [];

    public int $calendarMonth;

    public int $calendarYear;

    public array $bookedDates = [];

    public ?string $provinsi = null;

    public ?string $kabupaten = null;

    public ?string $kecamatan = null;

    public array $daftarProvinsi = [];

    public array $daftarKabupaten = [];

    public array $daftarKecamatan = [];

    public function mount(): void
    {
        $today = now()->addDay();
        $this->calendarMonth = (int) $today->format('m');
        $this->calendarYear = (int) $today->format('Y');

        $this->daftarProvinsi = DB::table('indonesia_provinces')->orderBy('name')->get()->all();
        $this->daftarKabupaten = [];
        $this->daftarKecamatan = [];

        $this->muatTanggalTerbooking();
        $this->selectedDate = $this->temukanTanggalTersedia($today->copy());
        // Don't load slots initially - wait for user to select consultation type
        $this->availableSlots = [];
    }

    public function updatedProvinsi($provinceId): void
    {
        $provinsi = DB::table('indonesia_provinces')->find($provinceId);

        $this->daftarKabupaten = $provinsi
            ? DB::table('indonesia_cities')
                ->where('province_code', $provinsi->code)
                ->orderBy('name')
                ->get()
                ->all()
            : [];

        $this->kabupaten = null;
        $this->kecamatan = null;
        $this->daftarKecamatan = [];
    }

    public function updatedTipeKonsultasi(): void
    {
        // Regenerate slots when consultation type changes
        $this->regenerateSlots();
        $this->selectedTime = null;
    }

    public function updatedKabupaten($regencyId): void
    {
        $kabupaten = DB::table('indonesia_cities')->find($regencyId);

        $this->daftarKecamatan = $kabupaten
            ? DB::table('indonesia_districts')
                ->where('city_code', $kabupaten->code)
                ->orderBy('name')
                ->get()
                ->all()
            : [];

        $this->kecamatan = null;
    }

    private function regenerateSlots(): void
    {
        if ($this->selectedDate && $this->tipeKonsultasi) {
            $this->availableSlots = $this->getAvailableSlots($this->selectedDate);
        } else {
            $this->availableSlots = [];
        }
    }

    public function pilihBulanSebelumnya(): void
    {
        $tanggal = Carbon::create($this->calendarYear, $this->calendarMonth, 1)->subMonth();
        $this->calendarMonth = (int) $tanggal->format('m');
        $this->calendarYear = (int) $tanggal->format('Y');
        $this->muatTanggalTerbooking();
    }

    public function pilihBulanBerikutnya(): void
    {
        $tanggal = Carbon::create($this->calendarYear, $this->calendarMonth, 1)->addMonth();
        $this->calendarMonth = (int) $tanggal->format('m');
        $this->calendarYear = (int) $tanggal->format('Y');
        $this->muatTanggalTerbooking();
    }

    public function pilihTanggal(string $tanggal): void
    {
        $pilihan = Carbon::parse($tanggal)->startOfDay();
        $today = now()->startOfDay();

        if ($pilihan <= $today) {
            $this->addError('selectedDate', 'Tanggal tidak boleh hari ini atau tanggal yang sudah lewat.');

            return;
        }

        $this->resetErrorBag('selectedDate');
        $this->selectedDate = $tanggal;
        $this->selectedTime = null;

        // Regenerate slots
        $this->regenerateSlots();
    }

    public function updatedJenisKonsultasi(): void
    {
        // Regenerate slots when consultation type changes
        $this->regenerateSlots();
        $this->selectedTime = null;
    }

    public function simpanKonsultasi(): void
    {
        $data = $this->validate([
            'nama' => ['required', 'string', 'max:100'],
            'noWhatsapp' => ['required', 'numeric', 'digits_between:9,15'],
            'tipeKonsultasi' => ['required', 'in:visit,online'],
            'selectedDate' => ['required', 'date', 'after:today'],
            'selectedTime' => ['required', 'string', 'regex:/^Sesi \d+$/'],
            'provinsi' => ['required', 'exists:indonesia_provinces,id'],
            'kabupaten' => ['required', 'exists:indonesia_cities,id'],
            'kecamatan' => ['required', 'exists:indonesia_districts,id'],
            'jenisKonsultasi' => ['required', 'in:bgnrumah_renovasi,maintenance,desain_interior,lainnya'],
            'detailKonsultasi' => ['nullable', 'string', 'max:1000'],
        ]);

        $namaProvinsi = DB::table('indonesia_provinces')->where('id', $data['provinsi'])->value('name');
        $namaKabupaten = DB::table('indonesia_cities')->where('id', $data['kabupaten'])->value('name');
        $namaKecamatan = DB::table('indonesia_districts')->where('id', $data['kecamatan'])->value('name');

        $konsultasi = Konsultasi::create([
            'nama' => $data['nama'],
            'no_wa' => $this->formatNomorWhatsapp($data['noWhatsapp']),
            'provinsi' => $namaProvinsi,
            'kabupatenkota' => $namaKabupaten,
            'kecamatan' => $namaKecamatan,
            'jenis_konsultasi' => $data['jenisKonsultasi'],
            'detil_konsultasi' => $data['detailKonsultasi'] ?? '',
        ]);

        JadwalKonsultasi::create([
            'konsultasi_id' => $konsultasi->id,
            'tanggal' => $data['selectedDate'],
            'tipe_konsultasi' => $data['tipeKonsultasi'],
            'jam' => $data['selectedTime'],
            'status' => JadwalKonsultasi::STATUS_PENDING,
        ]);

        $tipeLabel = $data['tipeKonsultasi'] === 'visit' ? 'Kunjungan Lokasi' : 'Konsultasi Online';

        $this->kirimWhatsappKeAdmin(
            nama: $data['nama'],
            nomor: $this->formatNomorWhatsapp($data['noWhatsapp']),
            tipe: $tipeLabel,
            tanggal: $data['selectedDate'],
            jam: $data['selectedTime'],
            lokasi: [$namaKecamatan, $namaKabupaten, $namaProvinsi],
            jenis: $data['jenisKonsultasi'],
            detail: $data['detailKonsultasi']
        );

        session()->flash('sukses', value: 'Request konsultasi berhasil dikirim. Kami akan menghubungi Anda setelah verifikasi.');

        $this->reset(['nama', 'noWhatsapp', 'tipeKonsultasi', 'jenisKonsultasi', 'detailKonsultasi', 'provinsi', 'kabupaten', 'kecamatan', 'selectedDate', 'selectedTime']);
        $this->daftarKabupaten = [];
        $this->daftarKecamatan = [];
        $this->availableSlots = [];

        $this->muatTanggalTerbooking();
        $this->selectedDate = $this->temukanTanggalTersedia(Carbon::now()->addDay());
    }

    public function render()
    {
        return view('livewire.konsultasi-form', [
            'calendarTitle' => $this->formatJudulKalender(),
            'calendarWeeks' => $this->susunKalender(),
            'bookedDates' => $this->bookedDates,
        ]);
    }

    private function formatNomorWhatsapp(string $nomor): string
    {
        $bersih = ltrim($nomor, '0');

        return '62'.$bersih;
    }

    private function muatTanggalTerbooking(): void
    {
        $awal = Carbon::create($this->calendarYear, $this->calendarMonth, 1)->startOfMonth();
        $akhir = $awal->copy()->endOfMonth();

        $this->bookedDates = JadwalKonsultasi::query()
            ->whereBetween('tanggal', [$awal->toDateString(), $akhir->toDateString()])
            ->whereNotIn('status', [JadwalKonsultasi::STATUS_CANCELLED])
            ->pluck('status', 'tanggal')
            ->mapWithKeys(fn ($status, $tanggal) => [Carbon::parse($tanggal)->format('Y-m-d') => $status])
            ->toArray();
    }

    private function susunKalender(): array
    {
        $awalBulan = Carbon::create($this->calendarYear, $this->calendarMonth, 1);
        $awalKalender = $awalBulan->copy()->startOfWeek();
        $akhirBulan = $awalBulan->copy()->endOfMonth();
        $akhirKalender = $akhirBulan->copy()->endOfWeek();

        $hari = [];
        $tanggal = $awalKalender->copy();

        while ($tanggal->lte($akhirKalender)) {
            $dateString = $tanggal->format('Y-m-d');
            $dayOfWeek = (int) $tanggal->format('w');
            $isPast = $tanggal->lt(now()->startOfDay());
            $isSunday = $dayOfWeek === 0;

            $hari[] = [
                'date' => $dateString,
                'label' => $tanggal->format('j'),
                'isCurrentMonth' => $tanggal->month === $awalBulan->month,
                'isPast' => $isPast,
                'isBooked' => array_key_exists($dateString, $this->bookedDates),
                'isSunday' => $isSunday,
                'isDisabled' => $isPast || $isSunday,
                'status' => $this->bookedDates[$dateString] ?? null,
            ];

            $tanggal->addDay();
        }

        return array_chunk($hari, 7);
    }

    private function temukanTanggalTersedia(Carbon $mulai): string
    {
        $limit = $mulai->copy()->addMonthsNoOverflow(6);
        $tanggal = $mulai->copy();

        while ($tanggal->lte($limit)) {
            if (JadwalKonsultasi::isTanggalTersedia($tanggal->toDateString())) {
                return $tanggal->toDateString();
            }

            $tanggal->addDay();
        }

        return $mulai->toDateString();
    }

    private function formatJudulKalender(): string
    {
        return Carbon::create($this->calendarYear, $this->calendarMonth, 1)
            ->locale(app()->getLocale())
            ->translatedFormat('F Y');
    }

    private function getAvailableSlots(string $tanggal): array
    {
        $date = Carbon::parse($tanggal);
        $dayOfWeek = (int) $date->format('w');

        // Sunday is closed
        if ($dayOfWeek === 0) {
            return [];
        }

        // Determine capacity limit based on consultation type
        $capacityLimit = $this->getCapacityLimit();

        // Generate session slots based on capacity
        $slots = [];
        for ($session = 1; $session <= $capacityLimit; $session++) {
            $sesiLabel = "Sesi {$session}";
            $slots[] = $sesiLabel;
        }

        // Filter out slots that are fully booked
        $availableSlots = [];
        foreach ($slots as $sesiLabel) {
            if ($this->isSlotAvailable($tanggal, $sesiLabel)) {
                $availableSlots[] = $sesiLabel;
            }
        }

        return $availableSlots;
    }

    private function isSlotAvailable(string $tanggal, string $sesi): bool
    {
        // If no consultation type is selected yet, return true
        // (This shouldn't happen in normal flow as slots are only loaded after type selection)
        if (! $this->tipeKonsultasi) {
            return true;
        }

        // Each session (Sesi 1, Sesi 2, etc.) can only have 1 booking
        // Check if this specific session on this date is already booked
        $bookingCount = JadwalKonsultasi::query()
            ->whereDate('tanggal', $tanggal)
            ->where('jam', $sesi)
            ->where('tipe_konsultasi', $this->tipeKonsultasi)
            ->whereNotIn('status', [JadwalKonsultasi::STATUS_CANCELLED])
            ->count();

        // Each session can only accommodate 1 person
        return $bookingCount < 1;
    }

    private function getCapacityLimit(): int
    {
        // Basis kapasitas pada tipe konsultasi
        if ($this->tipeKonsultasi === 'visit') {
            return 2; // Visit lokasi: max 2 sesi per hari
        } elseif ($this->tipeKonsultasi === 'online') {
            return 10; // Online: max 10 sesi per hari
        }

        // Default ke visit lokasi jika tipe belum dipilih
        return 2;
    }

    private function kirimWhatsappKeAdmin(string $nama, string $nomor, string $tipe, string $tanggal, string $jam, array $lokasi, string $jenis, ?string $detail): void
    {
        $nomorTujuan = config('app.wa_admin', '6282295444284');

        $pesan = "Halo, ada permintaan konsultasi baru.\n\n";
        $pesan .= "Nama: {$nama}\n";
        $pesan .= "Kontak: {$nomor}\n";
        $pesan .= "Tipe: {$tipe}\n";
        $pesan .= 'Lokasi: '.implode(', ', array_filter($lokasi))."\n";
        $pesan .= "Jenis: {$jenis}\n";
        $pesan .= "Tanggal: {$tanggal}\n";
        $pesan .= "Sesi: {$jam}\n\n";
        $pesan .= 'Detail: '.($detail ?: '-')."\n";

        $this->dispatch('buka-wa', url: 'https://wa.me/'.$nomorTujuan.'?text='.urlencode($pesan));
    }
}
