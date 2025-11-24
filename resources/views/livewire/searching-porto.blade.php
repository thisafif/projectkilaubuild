<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 animate-fade-in-delay">
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-10 gap-6">
        <div class="space-y-2">
            <h2 class="text-3xl font-bold text-blue-950">Portofolio Kami</h2>
            <p class="text-lg text-blue-900/80 font-medium">Jelajahi hasil karya terbaik kami</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full lg:w-auto lg:min-w-[500px]">
            <div class="space-y-1">
                <label for="jenisKonsultasi" class="text-sm font-semibold text-blue-900 ml-1">
                    Tipe Proyek
                </label>
                <div class="relative">
                    <select id="jenisKonsultasi" wire:model.live="jenisKonsultasi"
                        class="w-full bg-white rounded-xl border-2 border-blue-100 px-4 py-2.5 shadow-sm focus:border-blue-900 focus:outline-none focus:ring-0 transition-colors cursor-pointer appearance-none text-blue-900">
                        <option value="">Semua Tipe</option>
                        <option value="bangun_baru">Bangun Rumah</option>
                        <option value="renovasi">Renovasi Rumah</option>
                        <option value="interior">Interior</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-blue-900">
                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>

            <div class="space-y-1">
                <label for="tahun" class="text-sm font-semibold text-blue-900 ml-1">Tahun</label>
                <div class="relative rounded-xl border-2 border-blue-100 bg-white shadow-sm focus-within:border-blue-900 transition-colors">
                    <input id="tahun" type="number" wire:model.live.debounce.500ms="tahun"
                        class="w-full rounded-xl border-none px-4 py-2.5 focus:outline-none focus:ring-0 bg-transparent text-blue-900 placeholder-blue-300"
                        placeholder="Cari Tahun...">
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($portofolios as $portofolio)
                <div class="w-full bg-white rounded-[20px] shadow-lg">
                    @if ($portofolio->attachmentportofolio)
                        <img class="w-full h-48 object-cover rounded-t-[20px]"
                            src="{{ asset('storage/' . $portofolio->attachmentportofolio) }}"
                            alt="{{ $portofolio->judul }}" />
                    @else
                        <div class="w-full h-full bg-blue-50 flex items-center justify-center">
                            <span class="text-blue-300 font-medium">No image available</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-linear-to-t from-blue-950/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                
                <div class="flex flex-col flex-1 p-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-900 border border-blue-100">
                                {{ $portofolio->tanggal_proyek ? $portofolio->tanggal_proyek->format('Y') : '-' }}
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-50 text-slate-600 border border-slate-100">
                                {{ ucfirst(str_replace('_', ' ', $portofolio->tipe)) }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-blue-950 mb-2 line-clamp-1 group-hover:text-blue-900 transition-colors">
                            {{ $portofolio->judul }}
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 mb-4">
                            {{ $portofolio->deskripsi_singkat }}
                        </p>
                        <div class="mt-4">
                            <a href="#"
                                class="inline-block px-4 py-2 bg-cyan-600 hover:bg-cyan-950 transition delay-150 duration-300 ease-in-out hover:-translate-y-1
                                rounded-[20px] text-white text-sm font-normal font-sans">
                                See more...
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-blue-950">Tidak ada portofolio ditemukan</h3>
                <p class="text-slate-500 mt-1">Coba ubah filter pencarian Anda.</p>
            </div>
        @endforelse
    </div>
</div>
