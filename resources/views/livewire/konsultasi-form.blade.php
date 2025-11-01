<form wire:submit="simpanKonsultasi" class="container mx-auto px-4 py-8">

    @if (session('sukses'))
        <div class="p-4 mb-4 bg-green-200 text-green-800 rounded-lg">
            {{ session('sukses') }}
        </div>
    @endif
    <div class="lg:px-40 px-20">    
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="bg-white p-8 rounded-lg shadow-lg font-mono">
                <h2 class="text-2xl font-bold text-blue-950 mb-6 justify-center flex flex-center">Formulir Konsultasi</h2>
                <div class="space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-blue-950">Nama</label>
                        <input type="text" id="nama" wire:model="nama" 
                            class="w-full border-blue-950 rounded-md shadow-sm border-2 px-1">
                        @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="wa" class="block text-sm font-semibold text-blue-950">No. WhatsApp</label>
                        <div class="flex mt-1 rounded-md shadow-sm border-blue-950 border-2 ">
                            <span class="inline-flex items-center px-1  py-1 rounded-l-md text-blue-950 text-sm">
                                +62
                            </span>
                            <input type="text" id="wa" wire:model="noWhatsapp" 
                                class="flex-1 w-full rounded-none rounded-r-md focus:outline-none focus:ring-0">
                        </div>
                        @error('noWhatsapp')
                        <span class="inline-flex items-center px-3 rounded-l-md text-black text-sm">
                            +62
                        </span> 
                        <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div>
                        <label for="provinsi" class="block text-sm font-semibold text-blue-950">Provinsi</label>
                        <select id="provinsi" wire:model.live="provinsi" 
                                class="w-full border-blue-950 rounded-md shadow-sm border-2">
                            <option value="">Pilih Provinsi</option>
                            @foreach($daftarProvinsi as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                            @endforeach
                        </select>
                        @error('provinsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="kabupaten" class="block text-sm font-semibold text-blue-950">Kabupaten/Kota</label>
                        <select id="kabupaten" wire:model.live="kabupaten" 
                                class="w-full border-blue-950 rounded-md shadow-sm border-2">
                            @if (count($daftarKabupaten) > 0)
                                <option value="">Pilih Kabupaten/Kota</option>
                                @foreach($daftarKabupaten as $kab)
                                    <option value="{{ $kab->id }}">{{ $kab->name }}</option>
                                @endforeach
                            @else
                                <option value="">Pilih Provinsi Terlebih Dahulu</option>
                            @endif
                        </select>
                        @error('kabupaten') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="kecamatan" class="block text-sm font-semibold text-blue-950">Kecamatan</label>
                        <select id="kecamatan" wire:model="kecamatan" 
                                class="w-full border-blue-950 rounded-md shadow-sm border-2">
                            @if (count($daftarKecamatan) > 0)
                                <option value="">Pilih Kecamatan</option>
                                @foreach($daftarKecamatan as $kec)
                                    <option value="{{ $kec->id }}">{{ $kec->name }}</option>
                                @endforeach
                            @else
                                <option value="">Pilih Kabupaten Terlebih Dahulu</option>
                            @endif
                        </select>
                        @error('kecamatan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="jenisKonsultasi" class="block text-sm font-semibold text-blue-950">Jenis Konsultasi</label>
                        <select id="jenisKonsultasi" wire:model="jenisKonsultasi" 
                                class="w-full border-blue-950 rounded-md shadow-sm border-2">
                            <option value="">Pilih Jenis Konsultasi</option>
                            <option value="bangun_baru">Bangun Baru</option>
                            <option value="renovasi">Renovasi</option>
                            <option value="desain_interior">Desain Interior</option>
                        </select>
                        @error('jenisKonsultasi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="detailKonsultasi" class="block text-sm font-semibold text-blue-950">Detail Konsultasi</label>
                        <textarea id="detailKonsultasi" wire:model="detailKonsultasi" rows="4"
                                class="w-full border-blue-950 rounded-md shadow-sm border-2"
                                placeholder="Ceritakan sedikit tentang proyek Anda..."></textarea>
                        @error('detailKonsultasi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                </div>
            </div>
        </div>
        <div class="py-10">
            <button type="submit" 
                    class="px-8 py-4 bg-[#73ABD3] rounded-[50px]  shadow-[0px_6px_4px_0px_rgba(0,0,0,0.25)] inline-flex justify-center items-center gap-2.5">
                <img class="w-10 h-10 rounded-[50px]" 
                    src="{{ asset('images/logo-kilau-build(80x80).png') }}" alt="logo-kilau-build-button" />
                <span class="text-white text-xl font-semibold font-mono">Hubungi Kami</span>
            </button>
        </div>
        <div>
            <div class="max-w-4xl mx-auto">     
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="relative lg:col-span-2">
                        <div class="rounded-3xl w-full overflow-hidden shadow-2xl">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.6028386926278!2d106.80404900000003!3d-6.445011500000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e92ce61a47ef%3A0x4a71e1bb8f782d09!2sKILAU%20BUILD%20%7C%20Jasa%20Konstruksi%2C%20Interior%2C%20dan%20Design%20Terpercaya!5e0!3m2!1sen!2sid!4v1762003546387!5m2!1sen!2sid" 
                                class="w-full aspect-video" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                    <div class="flex flex-col font-sans gap-6 item-start justify-start">
                        <div class="justify-start text-blue-950 text-3xl">
                            <span class="italic font-sans">Kilau</span>
                            <span class="font-bold font-mono">Location</span>
                        </div>
                        <a href="https://maps.app.goo.gl/2522uqyte4YnvYNi6"
                        class="text-blue-950 text-sm leading-relaxed flex flex-row items-start gap-2" target="_blank" rel="noopener noreferrer">
                            <flux:icon name="map-pin" class="w-6 h-6 text-blue-950 flex-shrink-0" />
                            Jl. Raya Citayam No.34,<br>
                            RT.7/RW.001/004, Pd.<br>
                            Jaya, Kec. Cipayung, Kota<br>
                            Depok, Jawa Barat 16444
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</form>