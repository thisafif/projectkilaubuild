<x-layouts.app :title="__('Layanan')">
    <div class="w-full flex flex-col items-center justify-center px-6 lg:px-40 py-20 gap-12 text-sans animate-fade-in-delay">

        {{-- Judul --}}
        <div class="w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-bold text-blue-950 font-sans">Layanan Kami</h1>
        </div>

        {{-- Card Section --}}
        <div class="w-full flex flex-row gap-12">

            {{-- Card 1 --}}
            <div class="w-full max-w-sm bg-white rounded-3xl shadow-lg p-4 flex flex-col gap-3 animate-breathe">
                <img src="https://placehold.co/800x400" alt="Bangun Rumah" class="rounded-2xl object-cover h-40 w-full">
                <h2 class="text-lg font-bold text-black font-sans">Bangun Rumah</h2>
                <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel rhoncus sapien.
                    Quisque dapibus et libero vitae consequat.
                </p>
            </div>


            {{-- Card 2 --}}
            <div class="w-full max-w-sm bg-white rounded-3xl shadow-lg p-4 flex flex-col gap-3 animate-breathe">
                <img src="https://placehold.co/800x400" alt="Bangun Rumah" class="rounded-2xl object-cover h-40 w-full">
                <h2 class="text-lg font-bold text-black font-sans">Renovasi Rumah</h2>
                <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel rhoncus sapien.
                    Quisque dapibus et libero vitae consequat.
                </p>
            </div>


            {{-- Card 3 --}}
            <div class="w-full max-w-sm bg-white rounded-3xl shadow-lg p-4 flex flex-col gap-3 animate-breathe">
                <img src="https://placehold.co/800x400" alt="Bangun Rumah" class="rounded-2xl object-cover h-40 w-full">
                <h2 class="text-lg font-bold text-black font-sans">Desain Interior</h2>
                <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel rhoncus sapien.
                    Quisque dapibus et libero vitae consequat.
                </p>
            </div>


        </div>
    </div>
</x-layouts.app>
