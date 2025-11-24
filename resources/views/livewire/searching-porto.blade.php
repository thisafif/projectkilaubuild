<div class="w-full lg:px-40 px-6 py-8 animate-fade-in-delay">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-950">Portofolio Kami</h2>
            <p class="text-xl font-mono text-blue-950">Filter berdasarkan:</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:w-1/2">
            <div>
                <label for="jenisKonsultasi" class="block text-sm font-semibold text-blue-900">
                    Tipe Proyek
                </label>
                <select id="jenisKonsultasi" wire:model="jenisKonsultasi"
                    class="mt-1 w-full bg-white rounded-xl border-2 border-blue-200 px-2 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-0">
                    <option value="">Tipe Proyek</option>
                    <option value="bgnrumah_renovasi">Bangun Rumah</option>
                    <option value="maintenance">Renovasi Rumah</option>
                    <option value="desain_interior">Desain Arsitektural & Interior</option>
                </select>
                @error('jenisKonsultasi')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="tahun" class="block text-sm font-semibold text-blue-900">Tahun</label>
                <div class="mt-1 flex items-center rounded-xl border-2 border-blue-200 bg-white shadow-sm focus-within:border-blue-500">
                    <input id="tahun" type="integer" wire:model="tahun"
                        class="flex-1 rounded-xl rounded-l-none border-none px-3 py-2 focus:outline-none focus:ring-0"
                        placeholder="Masukkan Tahun">
                </div>
                @error('tahun')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($portofolios as $portofolio)
                <div class="w-full bg-white rounded-[20px] shadow-lg overflow-hidden">
                    @if ($portofolio->attachmentportofolio)
                        <img class="w-full h-48 object-cover"
                            src="{{ asset('storage/' . $portofolio->attachmentportofolio) }}"
                            alt="{{ $portofolio->judul }}" />
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No image</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold font-mono text-black">
                            {{ $portofolio->judul }}
                        </h3>
                        <p class="mt-2 text-base font-medium font-sans text-gray-600 line-clamp-3">
                            {{ $portofolio->deskripsi_singkat }}
                        </p>
                        <div class="mt-4">
                            <a href="#"
                                class="inline-block px-4 py-2 bg-cyan-600 hover:bg-cyan-900 transition delay-150 duration-300 ease-in-out hover:-translate-y-1
                                rounded-[20px] text-white text-sm font-normal font-sans">
                                See more...
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-gray-500">Tidak ada portofolio yang cocok.</p>
            @endforelse

        </div>
    </div>
</div>
