<div class="w-full flex flex-col gap-20 pb-20">
    <div class="w-full flex items-center justify-center flex-col gap-12 px-6 py-8 lg:flex-row lg:gap-25 lg:px-40">
        <div class="flex flex-col justify-start items-start gap-6 max-w-2xl">
            <h2 class="text-4xl lg:text-6xl font-semibold font-mono text-black">
                Tim Profesional
            </h2>
            <p class="text-gray-800 text-lg leading-relaxed font-sans">
                Kami memiliki tim yang berpengalaman dan berdedikasi dalam memberikan solusi terbaik untuk kebutuhan konstruksi dan desain Anda.
            </p>
        </div>
    </div>

    {{-- Team Grid --}}
    <div class="w-full px-6 lg:px-40">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($tim as $member)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if ($member->attechment_tim)
                        <img src="{{ asset('storage/' . $member->attechment_tim) }}" alt="{{ $member->nama_lengkap }}" class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-500">No photo</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold font-mono text-black mb-2">
                            {{ $member->nama_lengkap }}
                        </h3>
                        <p class="text-sm font-semibold text-blue-600 mb-4">
                            {{ $member->posisi }}
                        </p>
                        
                        @if ($member->linkedin)
                            <a href="{{ $member->linkedin }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-blue-500 hover:text-blue-700 text-sm font-medium">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.5 2h-17A1.5 1.5 0 002 3.5v17A1.5 1.5 0 003.5 22h17a1.5 1.5 0 001.5-1.5v-17A1.5 1.5 0 0020.5 2zM8 19H5v-9h3zM6.5 8.25A1.75 1.75 0 118.3 6.5a1.78 1.78 0 01-1.8 1.75zM19 19h-3v-4.74c0-1.42-.6-1.93-1.38-1.93A1.74 1.74 0 0013 14.19a.66.66 0 000 .14V19h-3v-9h2.9v1.3a3.11 3.11 0 012.7-1.4c1.55 0 3.36.86 3.36 3.66z"/>
                                </svg>
                                LinkedIn
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 italic col-span-full">Tim tidak ditemukan.</p>
            @endforelse
        </div>
    </div>
</div>
