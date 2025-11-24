<x-layouts.app :title="__('Tentang Kami')">
    <div class="animate-fade-in-delay">
        {{-- Hero --}}
        <div class="relative w-full h-70 flex items-center justify-center bg-center bg-cover"
            style="background-image: url('{{ asset('images/design.png') }}')">
        <div class="absolute inset-0 bg-sky-950/70"></div>

        <div class="relative text-white text-4xl lg:text-6xl font-bold font-mono text-center">
            Tentang Kami
        </div>
        </div>

        {{-- Tentang Kilau Build --}}
        <div class="w-full flex flex-col lg:flex-row items-center justify-center px-3 gap-20 lg:pl-30 lg:pr-10 py-16">
            <div class="relative w-80 h-80">
                <div class="absolute top-4 left-4 w-full h-full bg-sky-700/80 rounded-2xl"></div>
                <img src="{{ asset('images/design.png') }}" alt="Tentang Kilau Build"
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
                    class="px-6 py-3 text-white text-2xl bg-[#73ABD3] font-semibold font-mono rounded-full shadow hover:bg-sky-800 transition delay-150 duration-300 ease-in-out hover:-translate-y-1">
                    <a href="{{ route('konsultasi') }}">
                    Hubungi Kami
                    </button>
                </div>
            </div>
        </div>

        {{-- Tim --}}
        <livewire:tim />
    </div>
</x-layouts.app>