<div class="min-h-screen px-6 py-10 font-sans animate-fade-in-delay">
    <div class="max-w-6xl mx-auto">

        <!-- Title & Search -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
            <h1 class="text-3xl font-bold text-black">Artikel</h1>

            <div class="flex items-center w-64 rounded-xl border-2 border-blue-200 bg-white shadow-sm focus-within:border-blue-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input wire:model="search" 
                    type="text" 
                    placeholder="Search"
                    class="flex-1 w-full bg-transparent border-none focus:outline-none focus:ring-0 text-sm text-gray-700 placeholder-gray-400 px-3 py-2 rounded-xl" />
            </div>
        </div>

        <!-- Grid Artikel -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($artikels as $artikel)
                <div class="bg-white rounded-3xl p-4 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full border border-slate-100">
                    
                    <div class="relative w-full aspect-4/3 rounded-2xl overflow-hidden bg-gray-100 mb-4">
                        @if ($artikel->attachmentartikel)
                            <img src="{{ asset('storage/' . $artikel->attachmentartikel) }}"
                                alt="{{ $artikel->judul }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-50">
                                <span class="text-slate-300 text-sm">No Image</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col flex-1 px-1">
                        <h3 class="text-xl font-bold text-slate-900 mb-2 line-clamp-1">
                            {{ $artikel->judul }}
                        </h3>

                        <p class="text-slate-500 text-sm mb-2 line-clamp-2">
                            {{ Str::limit(strip_tags($artikel->isi), 100) }}
                        </p>

                        <p class="text-slate-400 text-xs mb-5">
                            {{ $artikel->tanggal_publikasi->format('d M Y') }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('artikel.detail', ['id' => $artikel->id]) }}" 
                                wire:navigate
                                class="block w-full py-3 bg-cyan-600 hover:bg-cyan-700 text-white text-center text-sm font-semibold rounded-full transition-colors">
                                See more...
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 italic">Artikel tidak ditemukan.</p>
            @endforelse
        </div>
    </div>
</div>
