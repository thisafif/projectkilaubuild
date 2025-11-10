<x-layouts.app :title="__('Tentang Kami')">
    <div>
        {{-- Hero --}}
        <div class="relative w-full h-70 flex items-center justify-center bg-center bg-cover"
            style="background-image: url('https://placehold.co/1200x400');">
        <div class="absolute inset-0 bg-sky-700/80"></div>

        <div class="relative text-white text-4xl lg:text-6xl font-bold font-mono text-center">
            Tentang Kami
        </div>
        </div>

        {{-- Tentang Kilau Build --}}
        <div class="w-full flex flex-col lg:flex-row items-center justify-center px-3 gap-20 lg:pl-30 lg:pr-10 py-16">
            <div class="relative w-80 h-80">
                <div class="absolute top-4 left-4 w-full h-full bg-sky-700/80 rounded-2xl"></div>
                <img src="/storage/foto-rumah.jpg" alt="Rumah"
                    class="relative w-full h-full object-cover rounded-2xl shadow-lg">
                </div>

                <div class="flex flex-col justify-start items-start gap-6 max-w-2xl">
                    <h2 class="text-4xl lg:text-6xl font-semibold font-mono text-black">
                    Lorem Ipsum
                    </h2>
                    <p class="text-gray-800 text-lg leading-relaxed font-sans">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                    <button
                    class="px-6 py-3 text-white text-2xl bg-[#73ABD3] font-semibold font-mono rounded-full shadow hover:bg-sky-800 transition">
                    <a href="{{ route('konsultasi') }}">
                    Hubungi Kami
                    </button>
                </div>
            </div>
        </div>

        {{-- Tim --}}
        <div class="flex flex-wrap justify-center items-center px-3 gap-12 py-16">
            <div class="w-72 flex flex-col justify-start items-center gap-4 text-center">
                <img class="w-48 h-48 rounded-full object-cover" src="https://placehold.co/200x200" alt="Foto Tim" />
                <div class="py-2">
                    <h3 class="text-2xl font-semibold font-sans text-gray-900">Nama Ipsum</h3>
                    <p class="text-gray-600 text-lg">Jabatan Ipsum</p>
                </div>
                <div class="flex justify-center items-center gap-3">
                    <a href="#" class="w-8 h-8 flex justify-center items-center">
                        <img src="{{ asset('icons/ic-instagram-dark.svg') }}" alt="Logo Instagram" class="w-6 h-6">
                    </a>
                    <a href="#" class="w-8 h-8 flex justify-center items-center">
                        <img src="{{ asset('icons/ic-linkedin.svg') }}" alt="Logo Linkedin" class="w-6 h-6">
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>