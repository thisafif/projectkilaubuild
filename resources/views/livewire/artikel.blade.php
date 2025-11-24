<div class="min-h-screen px-6 py-10 font-sans">
    <div class="max-w-6xl mx-auto">

        <!-- Title & Search -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
            <h1 class="text-3xl font-bold text-black">Artikel</h1>

            <div class="flex items-center bg-white rounded-full px-4 py-2 shadow-md w-64">
                <input wire:model="search" type="text" placeholder="Search"
                    class="flex-1 bg-transparent border-none focus:outline-none focus:ring-0 text-sm text-gray-700 placeholder-gray-400" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                </svg>
            </div>
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

                    <a href="#"
                        class="bg-cyan-600 hover:bg-cyan-950 text-white rounded-full px-4 py-2 text-sm font-medium transition inline-block text-center w-full">
                        See more...
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-blue-950">Tidak ada artikel ditemukan</h3>
                <p class="text-slate-500 mt-1">Coba ubah kata kunci pencarian Anda.</p>
            </div>
        @endforelse
    </div>
</div>
