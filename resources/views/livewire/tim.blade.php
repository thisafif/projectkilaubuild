<div class="w-full flex flex-col gap-20 pb-20">
    <div class="w-full flex items-center justify-center flex-col gap-12 px-6 py-8 lg:flex-row lg:gap-25 lg:px-40">
        <div class="flex flex-col justify-center items-center gap-6 max-w-2xl">
            <span class="font-serif-display italic text-sky-700 ml-1 relative text-8xl">
                Tim
            </span>
            <span class="font-bold text-slate-800 tracking-tight relative-text-6xl">Profesional Kami
                <svg class="absolute -bottom-1 left-0 w-full h-1 text-white" viewBox="0 0 100 10"
                    preserveAspectRatio="none">
                    <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="2" fill="none" />
                </svg>
            </span>
            <p class="text-gray-800 text-base lg:text-lg leading-relaxed font-sans text-center">
                Kami memiliki tim yang berpengalaman dan berdedikasi dalam memberikan solusi terbaik untuk kebutuhan
                konstruksi dan desain Anda.
            </p>
        </div>
    </div>

    {{-- Team Grid --}}
    <div class="w-full px-6 lg:px-40">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($tim as $member)
                <div class="flex flex-col items-center text-center group">
                    <div class="relative mb-6">
                        <div class="w-40 h-40 rounded-full overflow-hidden border-4 border-white shadow-lg">
                            @if ($member->attechment_tim)
                                <img src="{{ asset('storage/' . $member->attechment_tim) }}"
                                    alt="{{ $member->nama_lengkap }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <h3 class="text-xl font-medium text-gray-900 mb-1">
                        {{ $member->nama_lengkap }}
                    </h3>
                    <p class="text-gray-600 mb-4">
                        {{ $member->posisi }}
                    </p>

                    <div class="flex items-center justify-center gap-4">
                        @if ($member->linkedin)
                            <a href="{{ $member->linkedin }}" target="_blank" rel="noopener noreferrer"
                                class="text-gray-900 hover:text-blue-700 transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
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
