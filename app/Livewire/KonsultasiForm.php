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

    public bool $showModalKonfirmasi = false;

    public ?array $dataKonfirmasi = null;

    public function mount(): void
    {
        // mulai dari besok
        $besok = now()->addDay();

        // bulan & tahun kalender ikut tanggal besok
        $this->calendarMonth = (int) $besok->format('m');
        $this->calendarYear = (int) $besok->format('Y');

        $this->daftarProvinsi = DB::table('indonesia_provinces')->orderBy('name')->get()->all();
        $this->daftarKabupaten = [];
        $this->daftarKecamatan = [];

        // load tanggal yang sudah kebooking di bulan tsb
        $this->muatTanggalTerbooking();

        // set selectedDate ke tanggal tersedia pertama, mulai dari besok
        $this->selectedDate = $this->temukanTanggalTersedia($besok->copy());

        // slot masih kosong karena tipe konsultasi belum dipilih
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

        // minimal boleh pilih = besok (gunakan today() untuk consistency)
        $minSelectableDate = today()->addDay()->startOfDay();

        if ($pilihan->lt($minSelectableDate)) {
            $this->addError('selectedDate', 'Tanggal tidak boleh hari ini atau tanggal yang sudah lewat.');

            return;
        }

        $this->resetErrorBag('selectedDate');
        $this->selectedDate = $tanggal;
        $this->selectedTime = null;

        $this->regenerateSlots();
    }

    public function bukaModalKonfirmasi(): void
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
        $jenisLabel = $this->getLabelJenisKonsultasi($data['jenisKonsultasi']);
        $tipeLabel = $data['tipeKonsultasi'] === 'visit' ? 'Kunjungan ke Lokasi' : 'Konsultasi Online';
        $tanggalFormatted = Carbon::parse($data['selectedDate'])->translatedFormat('d F Y');

        $this->dataKonfirmasi = [
            'nama' => $data['nama'],
            'noWhatsapp' => $data['noWhatsapp'],
            'noWhatsappFormatted' => $this->formatNomorWhatsapp($data['noWhatsapp']),
            'jenisKonsultasi' => $jenisLabel,
            'tipeKonsultasi' => $tipeLabel,
            'lokasi' => implode(', ', array_filter([$namaKecamatan, $namaKabupaten, $namaProvinsi])),
            'tanggal' => $data['selectedDate'],
            'tanggalFormatted' => $tanggalFormatted,
            'jam' => $data['selectedTime'],
            'detailKonsultasi' => $data['detailKonsultasi'] ?? '-',
            'provinsi' => $data['provinsi'],
            'kabupaten' => $data['kabupaten'],
            'kecamatan' => $data['kecamatan'],
            'namaProvinsi' => $namaProvinsi,
            'namaKabupaten' => $namaKabupaten,
            'namaKecamatan' => $namaKecamatan,
        ];

        $this->showModalKonfirmasi = true;
    }

    public function tutupModalKonfirmasi(): void
    {
        $this->showModalKonfirmasi = false;
        $this->dataKonfirmasi = null;
    }

    public function kirimKonsultasi(): void
    {
        if (! $this->dataKonfirmasi) {
            return;
        }

        $data = $this->dataKonfirmasi;

        // Buat record di database
        $konsultasi = Konsultasi::create([
            'nama' => $data['nama'],
            'no_wa' => $data['noWhatsappFormatted'],
            'provinsi' => $data['namaProvinsi'],
            'kabupatenkota' => $data['namaKabupaten'],
            'kecamatan' => $data['namaKecamatan'],
            'jenis_konsultasi' => $this->getJenisConsultationKey($data['jenisKonsultasi']),
            'detil_konsultasi' => $data['detailKonsultasi'] !== '-' ? $data['detailKonsultasi'] : '',
        ]);

        JadwalKonsultasi::create([
            'konsultasi_id' => $konsultasi->id,
            'tanggal' => $data['tanggal'],
            'tipe_konsultasi' => strtolower(str_starts_with($data['tipeKonsultasi'], 'Kunjungan') ? 'visit' : 'online'),
            'jam' => $data['jam'],
            'status' => JadwalKonsultasi::STATUS_PENDING,
        ]);

        // Kirim ke WhatsApp user
        $this->buatPesanDanKirimWhatsapp($data);
    }

    private function buatPesanDanKirimWhatsapp(array $data): void
    {
        $pesan = "Halo, saya ingin membuat jadwal konsultasi dengan KILAU BUILD.\n\n";
        $pesan .= "*Detail Konsultasi:*\n";
        $pesan .= "Nama: {$data['nama']}\n";
        $pesan .= "No. WhatsApp: +{$data['noWhatsappFormatted']}\n";
        $pesan .= "Jenis Konsultasi: {$data['jenisKonsultasi']}\n";
        $pesan .= "Tipe Konsultasi: {$data['tipeKonsultasi']}\n";
        $pesan .= "Lokasi: {$data['lokasi']}\n";
        $pesan .= "Tanggal: {$data['tanggalFormatted']}\n";
        $pesan .= "Sesi: {$data['jam']}\n";
        $pesan .= "Detail: {$data['detailKonsultasi']}\n\n";
        $pesan .= 'Terima kasih, mohon segera dikonfirmasi.';

        $nomorWhatsapp = '6282295444284'; // NOMOR WA KILAUBUILD

        session()->flash('sukses', 'Konsultasi berhasil dikirim. Anda akan dialihkan ke WhatsApp.');

        // Reset form
        $this->reset(['nama', 'noWhatsapp', 'tipeKonsultasi', 'jenisKonsultasi', 'detailKonsultasi', 'provinsi', 'kabupaten', 'kecamatan', 'selectedDate', 'selectedTime']);
        $this->daftarKabupaten = [];
        $this->daftarKecamatan = [];
        $this->availableSlots = [];
        $this->showModalKonfirmasi = false;
        $this->dataKonfirmasi = null;

        $this->muatTanggalTerbooking();
        $this->selectedDate = $this->temukanTanggalTersedia(Carbon::now()->addDay());

        // Dispatch event untuk membuka WhatsApp
        $this->dispatch('buka-wa', url: 'https://wa.me/'.$nomorWhatsapp.'?text='.urlencode($pesan));
    }

    private function getLabelJenisKonsultasi(string $jenis): string
    {
        return match ($jenis) {
            'bgnrumah_renovasi' => 'Bangun Rumah & Renovasi',
            'maintenance' => 'Maintenance Rumah',
            'desain_interior' => 'Desain Arsitektural & Interior',
            'lainnya' => 'Lainnya',
            default => $jenis,
        };
    }

    private function getJenisConsultationKey(string $label): string
    {
        return match ($label) {
            'Bangun Rumah & Renovasi' => 'bgnrumah_renovasi',
            'Maintenance Rumah' => 'maintenance',
            'Desain Arsitektural & Interior' => 'desain_interior',
            'Lainnya' => 'lainnya',
            default => 'lainnya',
        };
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

        // minimal tanggal yg boleh diklik: besok (gunakan today() untuk consistency)
        $minSelectableDate = today()->addDay()->startOfDay();

        $hari = [];
        $tanggal = $awalKalender->copy();

        while ($tanggal->lte($akhirKalender)) {
            $dateString = $tanggal->format('Y-m-d');
            $dayOfWeek = (int) $tanggal->format('w');

            $isSunday = $dayOfWeek === 0;
            $isBeforeMin = $tanggal->lt($minSelectableDate); // < besok = gak boleh

            $hari[] = [
                'date' => $dateString,
                'label' => $tanggal->format('j'),
                'isCurrentMonth' => $tanggal->month === $awalBulan->month,
                'isPast' => $isBeforeMin,
                'isBooked' => array_key_exists($dateString, $this->bookedDates),
                'isSunday' => $isSunday,
                'isDisabled' => $isBeforeMin || $isSunday || $tanggal->month !== $awalBulan->month,
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

        // minggu (tdk menerima)
        if ($dayOfWeek === 0) {
            return [];
        }

        // cek limit
        $capacityLimit = $this->getCapacityLimit();

        // slot sesi
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
        if (! $this->tipeKonsultasi) {
            return true;
        }

        // Cek available ato nggak
        $bookingCount = JadwalKonsultasi::query()
            ->whereDate('tanggal', $tanggal)
            ->where('jam', $sesi)
            ->where('tipe_konsultasi', $this->tipeKonsultasi)
            ->whereNotIn('status', [JadwalKonsultasi::STATUS_CANCELLED])
            ->count();

        // Maksimum 1 org per sesi
        return $bookingCount < 1;
    }

    private function getCapacityLimit(): int
    {
        // Basis kapasitas pada tipe konsultasi
        if ($this->tipeKonsultasi === 'visit') {
            return 2; // Visit lokasi (2 sesi/hari)
        } elseif ($this->tipeKonsultasi === 'online') {
            return 10; // Online (10 sesi/hari)
        }

        // Default ke visit lokasi jika tipe belum dipilih
        return 2;
    }
}
