@once
    @push('styles')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        </style>
    @endpush
@endonce

<div class="animate-fade-in-delay">
    <div class="w-full lg:px-40 px-6 pt-8">
        <h2 class="text-3xl font-bold text-blue-950">Formulir Konsultasi</h2>
    </div>
    <form wire:submit="bukaModalKonfirmasi" class="container mx-auto px-4 py-10"
        style="font-family: 'Poppins', sans-serif;">
        <!-- Loading Toast -->
        <div wire:loading.delay class="fixed bottom-6 right-6 z-50">
            <div class="bg-white rounded-lg shadow-lg p-4 flex items-center gap-3 border border-blue-100">
                <svg class="animate-spin h-5 w-5 text-[#73ABD3]" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span class="text-gray-700 font-medium">Sedang memproses...</span>
            </div>
        </div>

        <!-- Success Toast -->
        @if (session('sukses'))
            <div class="fixed bottom-6 right-6 z-50">
                <div
                    class="bg-green-50 rounded-lg shadow-lg p-4 flex items-center gap-3 border border-green-200 max-w-md">
                    <svg class="h-5 w-5 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-green-800 font-medium">{{ session('sukses') }}</span>
                </div>
            </div>
        @endif

        <div class="max-w-6xl mx-auto space-y-12">
            <div class="grid grid-cols-1 lg:grid-cols-[1.4fr_1fr] gap-10">
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-blue-50">
                    <h2 class="text-2xl md:text-3xl font-semibold text-blue-950 mb-6 text-center">Formulir Konsultasi
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label for="nama" class="block text-sm font-semibold text-blue-900">Nama</label>
                            <input id="nama" type="text" wire:model="nama"
                                class="mt-1 w-full rounded-xl border-2 border-blue-200 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-0"
                                placeholder="Nama lengkap Anda">
                            @error('nama')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="wa" class="block text-sm font-semibold text-blue-900">No. WhatsApp</label>
                            <div
                                class="mt-1 flex items-center rounded-xl border-2 border-blue-200 bg-white shadow-sm focus-within:border-blue-500">
                                <span
                                    class="inline-flex items-center px-3 py-2 text-blue-900 text-sm font-medium">+62</span>
                                <input id="wa" type="text" wire:model="noWhatsapp"
                                    class="flex-1 rounded-xl rounded-l-none border-none px-3 py-2 focus:outline-none focus:ring-0"
                                    placeholder="81234567890">
                            </div>
                            @error('noWhatsapp')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="jenisKonsultasi" class="block text-sm font-semibold text-blue-900">Jenis
                                Konsultasi</label>
                            <select id="jenisKonsultasi" wire:model="jenisKonsultasi"
                                class="mt-1 w-full rounded-xl border-2 border-blue-200 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-0">
                                <option value="">Pilih Jenis Konsultasi</option>
                                <option value="bgnrumah_renovasi">Bangun Rumah & Renovasi</option>
                                <option value="maintenance">Maintenance Rumah</option>
                                <option value="desain_interior">Desain Arsitektural & Interior</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                            @error('jenisKonsultasi')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="provinsi" class="block text-sm font-semibold text-blue-900">Provinsi</label>
                            <select id="provinsi" wire:model.live="provinsi"
                                class="mt-1 w-full rounded-xl border-2 border-blue-200 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-0">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($daftarProvinsi as $prov)
                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="kabupaten"
                                class="block text-sm font-semibold text-blue-900">Kabupaten/Kota</label>
                            <select id="kabupaten" wire:model.live="kabupaten"
                                class="mt-1 w-full rounded-xl border-2 border-blue-200 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-0">
                                @if (count($daftarKabupaten) > 0)
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    @foreach ($daftarKabupaten as $kab)
                                        <option value="{{ $kab->id }}">{{ $kab->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">Pilih Provinsi Terlebih Dahulu</option>
                                @endif
                            </select>
                            @error('kabupaten')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="kecamatan" class="block text-sm font-semibold text-blue-900">Kecamatan</label>
                            <select id="kecamatan" wire:model="kecamatan"
                                class="mt-1 w-full rounded-xl border-2 border-blue-200 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-0">
                                @if (count($daftarKecamatan) > 0)
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($daftarKecamatan as $kec)
                                        <option value="{{ $kec->id }}">{{ $kec->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">Pilih Kabupaten Terlebih Dahulu</option>
                                @endif
                            </select>
                            @error('kecamatan')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-blue-900 mb-3">Tipe Konsultasi</label>
                            <div class="grid grid-cols-2 gap-3">
                                <button type="button" wire:click="$set('tipeKonsultasi', 'visit')"
                                    class="py-3 px-4 rounded-xl font-medium transition-all border-2 flex items-center gap-2
                                        {{ $tipeKonsultasi === 'visit'
                                            ? 'bg-blue-900 text-white border-blue-900 shadow-md'
                                            : 'bg-white text-blue-900 border-blue-200 hover:border-blue-400' }}">
                                    <flux:icon name="map-pin"
                                        class="w-5 h-5 {{ $tipeKonsultasi === 'visit' ? 'text-white' : 'text-blue-900' }}" />
                                    Kunjungan ke Lokasi
                                </button>
                                <button type="button" wire:click="$set('tipeKonsultasi', 'online')"
                                    class="py-3 px-4 rounded-xl font-medium transition-all border-2 flex items-center gap-2
                                        {{ $tipeKonsultasi === 'online'
                                            ? 'bg-blue-900 text-white border-blue-900 shadow-md'
                                            : 'bg-white text-blue-900 border-blue-200 hover:border-blue-400' }}">
                                    <flux:icon name="computer-desktop"
                                        class="w-5 h-5 {{ $tipeKonsultasi === 'online' ? 'text-white' : 'text-blue-900' }}" />
                                    Konsultasi secara Online
                                </button>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label for="detailKonsultasi" class="block text-sm font-semibold text-blue-900">Detail
                                Konsultasi</label>
                            <textarea id="detailKonsultasi" rows="5" wire:model="detailKonsultasi"
                                class="mt-1 w-full rounded-xl border-2 border-blue-200 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-0"
                                placeholder="Ceritakan sedikit tentang proyek Anda..."></textarea>
                            @error('detailKonsultasi')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div>
                    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-blue-50 text-blue-950">
                        <h3 class="text-xl font-semibold text-blue-950 mb-6">Pilih Jadwal</h3>

                        <div class="flex items-center justify-between mb-6">
                            <button type="button" wire:click="pilihBulanSebelumnya"
                                class="px-3 py-1 text-xs font-medium uppercase tracking-wide border border-blue-200 text-blue-900 rounded-lg hover:bg-blue-50 transition"
                                aria-label="Bulan sebelumnya">
                                &larr;
                            </button>
                            <div class="text-center">
                                <p class="text-sm uppercase text-blue-500 tracking-[0.35em]">Kalender</p>
                                <p class="text-lg font-semibold">{{ $calendarTitle }}</p>
                            </div>
                            <button type="button" wire:click="pilihBulanBerikutnya"
                                class="px-3 py-1 text-xs font-medium uppercase tracking-wide border border-blue-200 text-blue-900 rounded-lg hover:bg-blue-50 transition"
                                aria-label="Bulan berikutnya">
                                &rarr;
                            </button>
                        </div>

                        <div
                            class="grid grid-cols-7 text-center text-[0.7rem] font-semibold uppercase tracking-[0.2em] text-blue-400 mb-4">
                            @foreach (['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $label)
                                <div class="py-1">{{ $label }}</div>
                            @endforeach
                        </div>

                        <div class="space-y-2">
                            @foreach ($calendarWeeks as $weekIndex => $week)
                                <div class="grid grid-cols-7 gap-2" wire:key="kalender-{{ $weekIndex }}">
                                    @foreach ($week as $day)
                                        @php
                                            $isSelected = $selectedDate === $day['date'];
                                            $status = $day['status'] ?? null;
                                        @endphp
                                        <button type="button" wire:key="day-{{ $day['date'] }}" wire:click="pilihTanggal('{{ $day['date'] }}')"
                                            @disabled($day['isDisabled'])
                                            class="relative flex aspect-square items-center justify-center rounded-xl text-sm font-semibold transition-all border
                                                {{ $isSelected ? 'bg-blue-900 text-white border-blue-900 shadow-lg' : '' }}
                                                {{ !$isSelected && $day['isPast'] ? 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed opacity-60' : '' }}
                                                {{ !$isSelected && $day['isSunday'] ? 'bg-red-50 text-red-400 border-red-100 cursor-not-allowed opacity-60' : '' }}
                                                {{ !$isSelected && !$day['isPast'] && !$day['isSunday'] && $day['isCurrentMonth'] ? 'bg-blue-50 text-blue-900 border-blue-100 hover:bg-blue-100' : '' }}
                                                {{ !$day['isCurrentMonth'] ? 'bg-white text-blue-300 border-blue-50 opacity-50' : '' }}">
                                            <span>{{ $day['label'] }}</span>
                                            {{-- @if ($status && !$isSelected)
                                                <span
                                                    class="absolute -bottom-1 left-1/2 h-1 w-6 -translate-x-1/2 rounded-full
                                                {{ $status === \App\Models\JadwalKonsultasi::STATUS_CONFIRMED
                                                    ? 'bg-green-400'
                                                    : ($status === \App\Models\JadwalKonsultasi::STATUS_CANCELLED
                                                        ? 'bg-red-400'
                                                        : 'bg-yellow-400') }}">
                                                </span>
                                            @endif --}}
                                        </button>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 rounded-xl bg-blue-50 px-4 py-3 text-sm">
                            <p class="font-semibold text-blue-900">Tanggal dipilih</p>
                            <p class="text-blue-700">
                                {{ $selectedDate ? \Illuminate\Support\Carbon::parse($selectedDate)->translatedFormat('d F Y') : '-' }}
                            </p>
                        </div>

                        @if ($selectedDate && $tipeKonsultasi && count($availableSlots) > 0)
                            <div class="mt-6 rounded-xl bg-blue-50 px-4 py-3 border border-blue-200">
                                <p class="font-semibold text-blue-900 mb-3">Pilih Sesi</p>
                                <div class="grid grid-cols-3 gap-2">
                                    @foreach ($availableSlots as $slot)
                                        <button type="button" wire:key="slot-{{ $slot }}"
                                            wire:click.throttle.500ms="$set('selectedTime', '{{ $slot }}')"
                                            wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            class="py-2 px-3 text-sm rounded-lg font-medium transition-all
                                                {{ $selectedTime === $slot
                                                    ? 'bg-blue-900 text-white shadow-md'
                                                    : 'bg-white text-blue-900 border border-blue-200 hover:bg-blue-50' }}">
                                            {{ $slot }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @elseif ($selectedDate && $tipeKonsultasi && count($availableSlots) === 0)
                            <div
                                class="mt-6 rounded-xl bg-amber-50 px-4 py-3 border border-amber-200 text-sm text-amber-800">
                                ⚠️ Kuota konsultasi pada tanggal {{ $selectedDate ? \Illuminate\Support\Carbon::parse($selectedDate)->translatedFormat('d F') : '-' }} sudah penuh. Silakan pilih tanggal/tipe konsultasi lain.
                            </div>
                        @elseif ($selectedDate && !$tipeKonsultasi)
                            <div
                                class="mt-6 rounded-xl bg-blue-50 px-4 py-3 border border-blue-200 text-sm text-blue-800">
                                ℹ️ Silakan pilih tipe konsultasi terlebih dahulu untuk melihat jadwal tersedia.
                            </div>
                        @endif

                        {{-- @error('selectedTime')
                            <span class="mt-3 block text-xs text-red-500">{{ $message }}</span>
                        @enderror

                        @error('selectedDate')
                            <span class="mt-3 block text-xs text-red-500">{{ $message }}</span>
                        @enderror --}}
                    </div>
                </div>

                <div class="lg:col-span-2 flex justify-center">
                    <button type="submit" wire:loading.attr="disabled"
                        wire:loading.class="opacity-50 cursor-not-allowed"
                        class="mt-4 w-full max-w-xs px-8 py-4 bg-[#73ABD3] hover:bg-[#1C274C]
                            delay-75 duration-150 ease-in-out hover:-translate-y-1 transition-colors rounded-full shadow-[0px_6px_4px_rgba(0,0,0,0.25)] inline-flex justify-center items-center gap-3">
                        <!-- Loading Spinner -->
                        <div wire:loading class="flex items-center gap-3">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>

                        <!-- Default State -->
                        <div wire:loading.remove class="flex items-center gap-3">
                            <img class="w-10 h-10 rounded-full"
                                src="{{ asset('images/logo-kilau-build(80x80).png') }}"
                                alt="logo-kilau-build-button" />
                            <span class="text-white text-xl font-semibold ">Hubungi Kami</span>
                        </div>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[1.4fr_1fr] gap-8">
                <div class="rounded-3xl overflow-hidden shadow-2xl">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.6028386926278!2d106.80404900000003!3d-6.445011500000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e92ce61a47ef%3A0x4a71e1bb8f782d09!2sKILAU%20BUILD%20%7C%20Jasa%20Konstruksi%2C%20Interior%2C%20dan%20Design%20Terpercaya!5e0!3m2!1sen!2sid!4v1762003546387!5m2!1sen!2sid"
                        class="w-full aspect-video" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="bg-white p-6 md:p-7 rounded-2xl shadow-lg text-blue-950 space-y-4 border border-blue-50">
                    <div class="text-3xl">
                        <span class="italic">Kilau</span>
                        <span class="font-bold">Location</span>
                    </div>
                    <a href="https://maps.app.goo.gl/2522uqyte4YnvYNi6" target="_blank" rel="noopener noreferrer"
                        class="text-sm leading-relaxed flex flex-row items-start gap-2 hover:text-blue-600">
                        <flux:icon name="map-pin" class="w-6 h-6 text-blue-950 shrink-0" />
                        Jl. Raya Citayam No.34, RT.7/RW.001/004, Pd. Jaya, Kec. Cipayung, Kota Depok, Jawa Barat 16444
                    </a>

                    <div class="text-sm text-blue-900">
                        <p class="font-semibold">Catatan:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Anda akan dialihkan melalui aplikasi WhatsApp untuk konfirmasi konsultasi. Mohon untuk
                                mengirim pesan yang terdapat di dalam aplikasi WhatsApp.</li>
                            <li>Permintaan konsultasi akan kami verifikasi terlebih dahulu.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Konfirmasi -->
    @if ($showModalKonfirmasi && $dataKonfirmasi && isset($dataKonfirmasi['nama']))
        <div class="fixed inset-0 flex items-center justify-center z-50 p-4 mt-6"
            style="font-family: 'Poppins', sans-serif; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);">
            <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
                <!-- Header -->
                <div
                    class="
                    {{-- bg-linear-to-r from-blue-900 to-blue-800 --}}
                    px-6 py-5 pt-5 flex justify-between sticky top-0">
                    <h2 class="text-xl font-bold text-blue-900 px-4 pt-5">Konfirmasi Data Konsultasi</h2>
                    <button type="button" wire:click="tutupModalKonfirmasi"
                        class="text-white hover:bg-white hover:bg-opacity-20 rounded-full p-2 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Content -->
                <div class="px-6 py-6 space-y-4">
                    <!-- Alert Info -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded-lg">
                        <p class="text-blue-900 text-xs">
                            <span class="font-semibold">ℹ️ Informasi:</span> Setelah Anda mengklik "Kirim ke WhatsApp",
                            Anda akan dialihkan ke aplikasi WhatsApp untuk mengirimkan data konsultasi ini kepada tim
                            kami.
                        </p>
                    </div>

                    <!-- Data Display -->
                    <div class="space-y-3">
                        <div class="bg-gray-50 p-4 rounded-xl space-y-2">
                            <div class="grid grid-cols-1 gap-3">
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">Nama</p>
                                    <p class="text-base text-blue-950 font-semibold">{{ $dataKonfirmasi['nama'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">No. WhatsApp
                                    </p>
                                    <p class="text-base text-blue-950 font-semibold">
                                        +{{ $dataKonfirmasi['noWhatsappFormatted'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">Jenis
                                        Konsultasi</p>
                                    <p class="text-base text-blue-950 font-semibold">
                                        {{ $dataKonfirmasi['jenisKonsultasi'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">Tipe
                                        Konsultasi</p>
                                    <p class="text-base text-blue-950 font-semibold">
                                        {{ $dataKonfirmasi['tipeKonsultasi'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">Lokasi</p>
                                    <p class="text-base text-blue-950 font-semibold">{{ $dataKonfirmasi['lokasi'] }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">Tanggal</p>
                                    <p class="text-base text-blue-950 font-semibold">
                                        {{ $dataKonfirmasi['tanggalFormatted'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">Sesi</p>
                                    <p class="text-base text-blue-950 font-semibold">{{ $dataKonfirmasi['jam'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">Detail
                                        Konsultasi</p>
                                    <p class="text-sm text-blue-950 break-all">
                                        {{ $dataKonfirmasi['detailKonsultasi'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-3 flex gap-2 justify-end sticky bottom-0 border-t border-gray-200">
                    <button type="button" wire:click="tutupModalKonfirmasi"
                        class="px-4 py-2 rounded-lg text-sm font-semibold text-blue-950 bg-white border-2 border-blue-200 hover:bg-blue-50 transition">
                        Batal
                    </button>
                    <button type="button" wire:click="kirimKonsultasi" wire:loading.attr="disabled"
                        wire:loading.class="opacity-50 cursor-not-allowed"
                        class="px-4 py-2 rounded-lg text-sm font-semibold text-white bg-blue-900 hover:bg-blue-800 transition flex items-center gap-2">
                        <div wire:loading class="flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5 text-[#73ABD3]" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Sedang memproses...</span>
                        </div>
                        <div wire:loading.remove class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2 1m2-1L12 3m2 1v2.5M12 14l-2 1m2-1l-2-1m2 1v2.5" />
                            </svg>
                            <span>Kirim ke WhatsApp</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
