<div class="bg-gradient-to-b from-[#EAF4FF] to-[#CDE3F9] min-h-screen px-6 py-10 font-sans">
    <div class="max-w-6xl mx-auto">
        {{-- Judul & Search --}}
        <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
            <h1 class="text-3xl font-bold text-black">Artikel</h1>
            <div class="flex items-center bg-white rounded-full px-4 py-2 shadow-md w-64">
                <input wire:model="search" type="text" placeholder="Search"
                    class="flex-1 bg-transparent border-none focus:ring-0 text-sm text-gray-700 placeholder-gray-400" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                </svg>
            </div>
        </div>

        {{-- Grid Artikel --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($artikels as $artikel)
                <div
                    class="bg-[#f5faff] rounded-xl shadow-lg p-4 hover:scale-[1.02] transition-transform duration-300">
                    <img src="{{ $artikel['gambar'] }}" alt="{{ $artikel['judul'] }}"
                        class="rounded-xl w-full mb-3">
                    <h2 class="text-xl font-bold mb-2">{{ $artikel['judul'] }}</h2>
                    <p class="text-gray-700 text-sm mb-3">{{ $artikel['deskripsi'] }}</p>
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white rounded-full px-4 py-2 text-sm font-medium transition">
                        See more...
                    </button>
                </div>
            @empty
                <p class="text-gray-500 italic">Artikel tidak ditemukan.</p>
            @endforelse
        </div>
    </div>
</div>
