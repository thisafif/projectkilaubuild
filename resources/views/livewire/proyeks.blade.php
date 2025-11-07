<div class="w-full lg:px-40 px-6 py-8">
    <div>
        <h2 class="text-2xl font-bold text-blue-950">Proyek On-Going</h2>
        <p class="text-xl font-mono text-blue-950">Filter berdasarkan:</p>
    </div>
    <div class="flex flex-col lg:flex-row lg:gap-8 mt-4">
        <div class="lg:w-1/3">
            <div class="flex flex-col gap-4">
                <div class="block text-sm text-blue-950">
                    <label for="tipe" class="font-semibold">Tipe Proyek</label>
                    <select id="tipe" wire:model.live="tipeProyek"
                        class="w-full border-blue-950 rounded-md shadow-sm bg-white border-2 px-1">
                        <option value="">Pilih Tipe Proyek</option>
                        <option value="bangun_baru">Bangun Baru</option>
                        <option value="renovasi">Renovasi</option>
                        <option value="interior">Desain Interior</option>
                    </select>
                </div>
                <div class="block text-sm text-blue-950">
                    <label for="tahun" class="font-semibold">Tahun</label>
                    <input type="text" id="tahun" wire:model.live="tahun"
                        placeholder="Masukkan Tahun"
                        class="w-full border-blue-950 rounded-md shadow-sm bg-white border-2 px-1 placeholder:text-gray-400">
                    @error('tahun') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="lg:w-2/3 mt-8 lg:mt-0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse($ongoings as $ongoing)
                    <div class="w-full bg-white rounded-[20px] shadow-lg overflow-hidden">
                        <img class="w-full h-48 object-cover"
                            src="{{ $ongoing['url_gambar'] }}"
                            alt="{{ $ongoing['judul'] }}" />
                        <div class="p-6">
                            <h3 class="text-xl font-semibold font-mono text-black">
                                {{ $ongoing['judul'] }}
                            </h3>
                            <p class="mt-2 text-base font-medium font-sans text-gray-600 line-clamp-3">
                                {{ $ongoing['deskripsi_singkat'] }}
                            </p>
                            <div class="mt-4">
                                <a href="#"
                                    class="inline-block px-4 py-2 bg-cyan-600 rounded-[20px] text-white text-sm font-normal font-sans">
                                    See more...
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-gray-500">Belum ada proyek yang sedang berjalan.</p>
                @endforelse

            </div>
        </div>
    </div>
</div>
