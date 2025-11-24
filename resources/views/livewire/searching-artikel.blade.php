<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 animate-fade-in-delay">
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-10 gap-6">
        <div class="space-y-2">
            <h2 class="text-3xl font-bold text-blue-950">Artikel Kami</h2>
            <p class="text-lg text-blue-900/80 font-medium">Temukan wawasan dan informasi terbaru</p>
        </div>

        <div class="w-full lg:w-auto lg:min-w-[300px]">
            <div class="space-y-1">
                <label for="search" class="text-sm font-semibold text-blue-900 ml-1">Cari Artikel</label>
                <div class="relative rounded-xl border-2 border-blue-100 bg-white shadow-sm focus-within:border-blue-500 transition-colors">
                    <input id="search" type="text" wire:model.live.debounce.500ms="search"
                        class="w-full rounded-xl border-none px-4 py-2.5 focus:outline-none focus:ring-0 bg-transparent text-blue-900 placeholder-blue-300"
                        placeholder="Cari judul atau isi...">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-blue-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($artikels as $artikel)
            <div class="group flex flex-col bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-blue-100">
                <div class="relative overflow-hidden aspect-4/3">
                    @if ($artikel->attachmentartikel)
                        <img class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                            src="{{ Storage::url($artikel->attachmentartikel) }}"
                            alt="{{ $artikel->judul }}" />
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
                                {{ $artikel->tanggal_publikasi ? $artikel->tanggal_publikasi->format('Y') : '-' }}
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-50 text-slate-600 border border-slate-100">
                                {{ $artikel->penulis ?? 'Admin' }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-blue-950 mb-2 line-clamp-1 group-hover:text-blue-900 transition-colors">
                            {{ $artikel->judul }}
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed line-clamp-3 mb-4">
                            {{ Str::limit(strip_tags($artikel->isi), 100) }}
                        </p>
                    </div>
                    
                    <div class="mt-auto pt-4 border-t border-blue-50">
                        <a href="{{ route('artikel.detail', $artikel->id) }}"
                            class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-white border-2 border-blue-900 text-blue-900 hover:bg-blue-900 hover:text-white rounded-xl text-sm font-semibold transition-all duration-300 group-hover:shadow-md">
                            Lihat Detail
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
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
                <h3 class="text-lg font-medium text-blue-950">Tidak ada artikel ditemukan</h3>
                <p class="text-slate-500 mt-1">Coba ubah kata kunci pencarian Anda.</p>
            </div>
        @endforelse
    </div>
</div>
