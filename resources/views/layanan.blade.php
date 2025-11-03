<x-layouts.app :title="__('Layanan')">
    <div class="w-full flex flex-col items-center justify-center px-6 lg:px-40 py-20 bg-gradient-to-b from-sky-100 to-sky-200 gap-12">

        {{-- Judul --}}
        <div class="w-full text-left">
            <h1 class="text-3xl lg:text-5xl font-bold text-blue-950 font-sans">Layanan Kami</h1>
        </div>

        {{-- Card Section --}}
        <div class="w-full flex flex-col gap-12">

            {{-- Card 1 --}}
            <div class="w-full bg-white rounded-3xl shadow-lg p-6 flex flex-col gap-4">
                <img src="https://placehold.co/800x400" alt="Bangun Rumah" class="rounded-2xl object-cover">
                <h2 class="text-2xl lg:text-3xl font-bold text-black font-sans">Bangun Rumah</h2>
                <p class="text-gray-700 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel rhoncus sapien.
                    Quisque dapibus et libero vitae consequat. Nam sit amet nunc vel augue aliquam tempor vel eget lectus.
                </p>
            </div>

            {{-- Card 2 --}}
            <div class="w-full bg-white rounded-3xl shadow-lg p-6 flex flex-col gap-4">
                <img src="https://placehold.co/800x400" alt="Renovasi Rumah" class="rounded-2xl object-cover">
                <h2 class="text-2xl lg:text-3xl font-bold text-black font-sans">Renovasi Rumah</h2>
                <p class="text-gray-700 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel rhoncus sapien.
                    Quisque dapibus et libero vitae consequat. Nam sit amet nunc vel augue aliquam tempor vel eget lectus.
                </p>
            </div>

            {{-- Card 3 --}}
            <div class="w-full bg-white rounded-3xl shadow-lg p-6 flex flex-col gap-4">
                <img src="https://placehold.co/800x400" alt="Desain Interior" class="rounded-2xl object-cover">
                <h2 class="text-2xl lg:text-3xl font-bold text-black font-sans">Desain Interior</h2>
                <p class="text-gray-700 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel rhoncus sapien.
                    Quisque dapibus et libero vitae consequat. Nam sit amet nunc vel augue aliquam tempor vel eget lectus.
                </p>
            </div>

        </div>
    </div>
</x-layouts.app>
