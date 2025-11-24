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
                <div class="bg-[#f5faff] rounded-xl shadow-lg p-4 hover:scale-[1.02] transition-transform duration-300">
                    
                    @if ($artikel->attachmentartikel)
                        <img src="{{ asset('storage/' . $artikel->attachmentartikel) }}"
                            alt="{{ $artikel->judul }}"
                            class="rounded-xl w-full h-48 object-cover mb-3">
                    @else
                        <div class="rounded-[15px] w-full h-48 bg-gray-200 mb-3 flex items-center justify-center">
                            <span class="text-gray-400">No image</span>
                        </div>
                    @endif

                    <h2 class="text-xl font-bold mb-2">{{ $artikel->judul }}</h2>

                    <p class="text-gray-700 text-sm mb-2">
                        {{ Str::limit($artikel->isi, 100) }}
                    </p>

                    <p class="text-gray-500 text-xs mb-3">
                        {{ $artikel->tanggal_publikasi->format('d M Y') }}
                    </p>

                    <a href="{{ route('artikel.detail', ['id' => $artikel->id]) }}" 
                        wire:navigate
                        class="bg-cyan-600 hover:bg-cyan-950 text-white rounded-full px-4 py-2 text-sm font-medium transition inline-block text-center w-full">
                        See more...
                    </a>
                </div>
            @empty
                <p class="text-gray-500 italic">Artikel tidak ditemukan.</p>
            @endforelse
        </div>
    </div>
</div>
