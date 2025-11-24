<div class="min-h-screen px-6 py-10 font-sans lg:px-40 lg:py-20">
    <div class="w-full">

        <!-- Title & Search -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div class="max-w-2xl">
                <h1 class="text-4xl font-bold text-blue-950 mb-4">Artikel & Berita</h1>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Jadilah pemilik rumah yang cerdas. Temukan panduan konstruksi yang tepat, tips renovasi hemat, dan
                    tren interior terkini langsung dari pengalaman 23 tahun KilauBuild </p>
            </div>

            <div class="relative w-full md:w-72">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari artikel..."
                    class="w-full pl-12 pr-4 py-3 bg-white border-2 border-gray-100 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-0 transition-colors shadow-sm text-gray-700 placeholder-gray-400" />
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Grid Artikel -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($artikels as $artikel)
                <div class="bg-[#f5faff] rounded-xl shadow-lg p-4 hover:scale-[1.02] transition-transform duration-300">

                    @if ($artikel->attachmentartikel)
                        <img src="{{ asset('storage/' . $artikel->attachmentartikel) }}" alt="{{ $artikel->judul }}"
                            class="rounded-xl w-full h-48 object-cover mb-3">
                    @else
                        <div class="rounded-[15px] w-full h-48 bg-gray-200 mb-3 flex items-center justify-center">
                            <span class="text-gray-400">No image</span>
                        </div>
                    @endif

                    <h2 class="text-xl font-bold mb-2">{{ $artikel->judul }}</h2>

                    <p class="text-gray-700 text-sm mb-2 line-clamp-3">
                        {!! Str::limit(strip_tags($artikel->isi), 100) !!}
                    </p>

                    <p class="text-gray-500 text-xs mb-3">
                        {{ $artikel->tanggal_publikasi->format('d M Y') }}
                    </p>

                    <a href="{{ route('artikel.detail', ['id' => $artikel->id]) }}" wire:navigate
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
