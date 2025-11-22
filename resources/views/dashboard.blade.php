<x-layouts.app :title="__('Beranda')">
    <div class="w-full flex flex-col gap-20 pb-20">

        {{-- Section 1: Hero --}}

        <div class="w-full h-[583px] px-40 py-50 flex flex-col relative justify-start items-start gap-2.5">
            <div style="background-image: url( '{{ asset('images/house-design.png') }}')"
                class="absolute top-0 left-0 w-full h-full object-cover bg-cover bg-center bg-scroll z-[-1]"></div>
            <div class="absolute top-0 left-0 w-full h-[583px] bg-black opacity-60 z-0"></div>
            <div class="w-full h-full flex flex-col text-center justify-center items-center gap-5 z-1">
                <div class="mb-6 inline-flex items-center gap-2 backdrop-blur-md px-4 py-2 rounded-full w-fit border border-white/20 animate-slide-down">
                    <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                    <span class="text-white/90 text-sm font-medium">Dipercaya oleh 100+ Keluarga Bahagia</span>
                </div>
                <div class="justify-start text-white text-3xl lg:text-6xl font-bold font-mono animate-slide-up">Bangun Dulu<br />Baru
                    Bayar</div>
                <p class="text-base font-sans sm:text-lg text-white/80 mb-10 max-w-3xl leading-relaxed animate-slide-up-delay">
                    Wujudkan rumah impian Anda dengan konsultasi gratis. Mulai dari desain hingga konstruksi, kami siap membantu setiap langkah perjalanan Anda.
                </p>
                <a 
                    href="{{ route('konsultasi') }}" 
                    class="group px-8 py-4 bg-white text-gray-900 rounded-full font-semibold text-lg shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 inline-flex items-center justify-center gap-3 animate-scale-in"
                >
                    <span>Hubungi Kami</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <div id="scrollDown"
                    class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 cursor-pointer animate-bounce">
                    <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
            </div>
            <a href="https://wa.me/+6282295444284" class="w-15 h-15 p-2.5 flex absolute bottom-0 right-0 gap-2.5 z-1 animate-fade-in-delay">
                <img src="{{ asset('icons/ic-whatsapp.svg') }}" alt="Icon WhatsApp" />
            </a>
        </div>

        {{-- Section 2:Tentang Kami --}}

        <div id="about"
            class="w-full flex items-center justify-center
            flex-col gap-12 px-6 py-8            
            lg:flex-row lg:gap-25 lg:px-40">
            <div data-aos="fade-up"
            class="flex flex-col justify-start items-center text-center lg:items-start lg:text-left gap-14">
                <div
                    class="px-4 py-2 bg-sky-700/30 rounded-[50px] shadow-[0px_6px_4px_0px_rgba(0,0,0,0.40)] inline-flex justify-center items-center gap-2.5">
                    <div class="justify-start text-blue-950 text-3xl">
                        <span class="font-bold font-mono">Di balik</span>
                        <span class="italic font-sans">Kilau</span>
                    </div>
                </div>
                <div class=" justify-start text-blue-950 text-lg lg:text-xl font-medium font-sans self-stretch">
                    <div class="flex-1">
                        Setiap kilau menyimpan kisah, setiap kisah mengundang langkah. Ikuti kami, rasakan
                        perjalanannya, dan wujudkan sinar baru bersama kami.
                    </div>
                    <div class="pt-5 hover:underline hover:text-sky-700">
                        <a href="{{ route('tentang-kami') }}" >
                            Selengkapnya...
                        </a>
                    </div>
                </div>
            </div>
            <img data-aos="fade-left"
            class="size-[200px]
            lg:size-[300px]
            rounded-[10px] shadow-[0px_15px_4px_0px_rgba(0,0,0,0.40)]"
                src="https://placehold.co/300x300" />
        </div>

        {{-- Section 3: Portofolio --}}

        <div
            class="w-full flex items-center justify-center
            flex-col gap-12 px-6 py-8            
            lg:flex-row lg:gap-25 lg:px-40">
            <style>
                .swiper {
                    width: 100%;
                    max-width: 700px;
                    height: 400px;
                    padding-top: 50px;
                    padding-bottom: 50px;
                }

                .swiper-wrapper {
                    align-items: center;
                }

                .swiper-slide {
                    background-position: center;
                    background-size: cover;
                    width: 300px;
                    height: 300px;
                }

                .swiper-slide img {
                    display: block;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 12px;
                }

                :root {
                    --swiper-navigation-color: #1e3a8a;
                    --swiper-pagination-color: #1e3a8a;
                }

                .swiper-button-prev,
                .swiper-button-next {
                    color: #1C274C;
                    background: #5AB0EF;
                    width: 44px;
                    height: 44px;
                    border-radius: 50%;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                }

                .swiper-button-next:hover,
                .swiper-button-prev:hover {
                    background: #1C274C;
                    color: white;
                    transition: ease-in-out;
                    duration: 300ms;
                    transition-delay: 150ms;
                }

                .swiper-button-prev:after,
                .swiper-button-next:after {
                    font-size: 18px;
                    font-weight: bold;
                }
            </style>

            <div class="swiper card-portofolio" data-aos="flip-down">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://placehold.co/300x300/334155/white?text=Slide+1" alt="Property 1">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/300x300/1e40af/white?text=Slide+2" alt="Property 2">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/300x300/15803d/white?text=Slide+3" alt="Property 3">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/300x300/9a3412/white?text=Slide+4" alt="Property 4">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/300x300/7c2d12/white?text=Slide+5" alt="Property 5">
                    </div>
                </div>
                <div class="swiper-button-prev ">
                    <flux:icon name="arrow-left" />
                </div>
                <div class="swiper-button-next">
                    <flux:icon name="arrow-right" />
                </div>

                <div class="swiper-pagination"></div>
            </div>

            <div data-aos="fade-left"
            class="flex flex-col justify-start items-start gap-6 max-w-md">
                <div class="text-blue-950 text-3xl font-bold font-mono border-b-4 border-blue-950 pb-2">
                    Portofolio kami
                </div>
                <div class="text-blue-950 text-lg font-medium font-sans leading-relaxed">
                    Berbagai tantangan dalam pembangunan telah kami selesaikan. Kami bertekad untuk membantu dan menjadi
                    solusi untuk #OwneRumah
                </div>
            </div>
        </div>

        {{-- Section4: Project On-going --}}

        {{-- <div>
            Buat Maps:P
        </div> --}}
        <div data-aos="zoom-in-up"
            class="w-full flex items-center justify-center
            flex-col gap-12 px-6 py-8            
            lg:flex-row lg:gap-25 lg:px-40">
            <div class="flex flex-col justify-center items-center gap-3">
                <div class="justify-start text-blue-950 text-4xl font-bold font-mono">Project On-going</div>
                <div
                    class="self-stretch rounded-[50px] outline outline-black inline-flex justify-center items-center gap-2.5">
                    <div class="flex-1 text-center justify-start text-blue-950 text-lg font-medium font-sans">100</div>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center gap-3">
                <div class="justify-start text-blue-950 text-4xl font-bold font-mono">Project Completed</div>
                <div
                    class="self-stretch rounded-[50px] outline outline-black inline-flex justify-center items-center gap-2.5">
                    <div class="flex-1 text-center justify-start text-blue-950 text-lg font-medium font-sans">100</div>
                </div>
            </div>
        </div>

        {{-- Testimoni --}}
        <div
            class="w-full flex items-center justify-center
            flex-col gap-12 px-6 py-8            
            lg:flex-row lg:gap-25 lg:px-40">

            <div data-aos="zoom-out-up"
            class="flex flex-col justify-start items-start gap-6 max-w-md">
                <div class="text-blue-950 text-3xl font-bold font-mono border-b-4 border-blue-950 pb-2">
                    Testimoni Klien
                </div>
                <div class="text-blue-950 text-lg font-medium font-sans leading-relaxed">
                    Kepercayaan klien adalah prioritas utama kami. Simak pengalaman mereka bekerja sama dengan Kilau
                    Build.
                </div>
            </div>
            <style>
                .swiper.card-testimoni {
                    width: 320px;
                    height: 420px;
                    padding: 20px 0;
                }

                .swiper.card-testimoni .swiper-slide {
                    width: 320px;
                    height: 400px;
                    border-radius: 18px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
            </style>
            <div class="swiper card-testimoni" data-aos="flip-right">
                <div class="swiper-wrapper">
                    @if (isset($testimonis) && $testimonis->isNotEmpty())
                        @foreach ($testimonis as $t)
                            <div class="swiper-slide">
                                <div
                                    class="w-full h-full p-6 bg-white rounded-3xl shadow-xl flex flex-col justify-between">
                                    <div class="text-gray-500 text-6xl font-bold leading-none">"</div>
                                    <p class="text-gray-700 text-base italic leading-relaxed">
                                        {{ $t->teks }}
                                    </p>
                                    <div>
                                        <div class="font-bold text-blue-950 text-xl">{{ $t->nama }}</div>
                                        <div class="text-sm text-gray-500">{{ $t->kegseharihari }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="swiper-slide">
                            <div class="w-full h-full p-6 bg-white rounded-3xl shadow-xl flex flex-col justify-between">
                                <div class="text-gray-500 text-6xl font-bold leading-none">"</div>
                                <p class="text-gray-700 text-base italic leading-relaxed">
                                    Belum ada testimoni tersedia saat ini.
                                </p>
                                <div>
                                    <div class="font-bold text-blue-950 text-xl">Admin</div>
                                    <div class="text-sm text-gray-500">Kilau Build</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Section 5: Artikel --}}

        <div data-aos="fade-up" data-aos-delay="100"
        class="self-stretch inline-flex flex-col justify-start items-start gap-16">
            <div class="self-stretch px-40 inline-flex justify-start items-start gap-2.5">
                <div class="justify-start text-blue-950 text-3xl">
                    <span class="italic font-normal font-sans">Kilau</span>
                    <span class="font-bold font-mono">Journal</span>
                </div>
            </div>
            <div data-aos-delay="300"class="self-stretch flex flex-col justify-start items-center gap-14">
                <div class="card w-full flex items-center justify-center
                    flex-col gap-12 px-6 py-8           
                    lg:flex-row lg:gap-25 lg:px-20">
                    <div class="w-70 h-70 bg-white rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] inline-flex flex-col justify-start items-start gap-2.5">
                        <div class="self-stretch flex flex-col justify-start items-center gap-2">
                            <img class="self-stretch h-45 rounded-[20px] object-cover" src="https://placehold.co/435x250" />
                            <div class="self-stretch px-5 flex flex-col justify-start items-start gap-1.5">
                                <div class="self-stretch justify-start text-black text-lg lg:text-xl font-bold font-mono">Judul Artikel</div>
                                <div class="self-stretch justify-start text-black text-sm lg:text-base font-medium font-sans">Lorem ipsum dolor sit amet, consect...</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-70 h-70 bg-white rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] inline-flex flex-col justify-start items-start gap-2.5">
                        <div class="self-stretch flex flex-col justify-start items-center gap-2">
                            <img class="self-stretch h-45 rounded-[20px] object-cover" src="https://placehold.co/435x250" />
                            <div class="self-stretch px-5 flex flex-col justify-start items-start gap-1.5">
                                <div class="self-stretch justify-start text-black text-lg lg:text-xl font-bold font-mono">Judul Artikel</div>
                                <div class="self-stretch justify-start text-black text-sm lg:text-base font-medium font-sans">Lorem ipsum dolor sit amet, consect...</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-70 h-70 bg-white rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] inline-flex flex-col justify-start items-start gap-2.5">
                        <div class="self-stretch flex flex-col justify-start items-center gap-2">
                            <img class="self-stretch h-45 rounded-[20px] object-cover" src="https://placehold.co/435x250" />
                            <div class="self-stretch px-5 flex flex-col justify-start items-start gap-1.5">
                                <div class="self-stretch justify-start text-black text-lg lg:text-xl font-bold font-mono">Judul Artikel</div>
                                <div class="self-stretch justify-start text-black text-sm lg:text-base font-medium font-sans">Lorem ipsum dolor sit amet, consect...</div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('artikel') }}" data-aos-delay="600"
                class="px-4 py-2 bg-cyan-600/20 rounded-[50px] 
                        shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]
                        inline-flex flex-row items-center gap-2
                        text-black text-xl font-light font-sans
                        hover:bg-[#1C274C] hover:text-white
                        transition-colors delay-150 duration-300 ease-in-out hover:-translate-y-1">
                    <span>See more</span>
                    <flux:icon name="chevron-right" class="w-6 h-6" />
                </a>
            </div>
        </div>

        {{-- Section 6: Lokasi Kantor --}}

        <div class="w-full flex items-center justify-center
            flex-col gap-12 px-6 py-8            
            lg:flex-row lg:gap-25 lg:px-40">
            <div class="max-w-4xl mx-auto">     
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                    <div class="relative" data-aos="fade-right">
                        <div class="rounded-3xl overflow-hidden shadow-2xl">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.602838743073!2d106.80147407469862!3d-6.445011493546286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e92ce61a47ef%3A0x4a71e1bb8f782d09!2sKILAU%20BUILD%20%7C%20Jasa%20Konstruksi%2C%20Interior%2C%20dan%20Design%20Terpercaya!5e0!3m2!1sen!2sid!4v1761927489704!5m2!1sen!2sid" 
                                    width="600" 
                                    height="450" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                    <div data-aos="zoom-in-up"
                    class="flex flex-col font-sans gap-6 item-start justify-start">
                        <div class="justify-start text-blue-950 text-3xl">
                            <span class="italic font-sans">Kilau</span>
                            <span class="font-bold font-mono">Location</span>
                        </div>
                        <a href="https://maps.app.goo.gl/2522uqyte4YnvYNi6"
                        class="text-blue-950 text-sm leading-relaxed flex flex-row items-start gap-2" target="_blank" rel="noopener noreferrer">
                            <flux:icon name="map-pin" class="w-6 h-6 text-blue-950 shrink-0" />
                            Jl. Raya Citayam No.34,<br>
                            RT.7/RW.001/004, Pd.<br>
                            Jaya, Kec. Cipayung, Kota<br>
                            Depok, Jawa Barat 16444
                        </a>
                        <div class="py-15">
                            <a href="{{ route('konsultasi') }}" 
                            class="px-4 py-2 bg-cyan-600/20 rounded-[50px] 
                                    shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]
                                    w-fit flex flex-row items-left gap-6
                                    text-black text-xl font-light font-sans
                                    hover:bg-[#1C274C] hover:text-white
                                    transition-colors delay-150 duration-300 ease-in-out hover:-translate-y-1">
                                    <span>Konsultasi</span>
                                <flux:icon name="arrow-right" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 7: FAQ --}}

        <div class="w-full items-center justify-center
                    flex flex-col gap-12 px-6 py-8            
                    lg:flex-col lg:gap-25 lg:px-40"
            data-aos="fade-up"
            data-aos-duration="1500">
            <div class="w-fit mx-auto px-8 py-4 rounded-[50px] outline-2 -outline-offset-2 outline-black inline-flex justify-center items-center gap-2.5">
                <div class=" text-black text-lg lg:text-xl font-bold font-mono">FAQ</div>
            </div>
            <div class="w-full -my-4 flex flex-col divide-y divide-black">
                <div x-data="{ open: false }" class="py-4">
                    <summary 
                        x-on:click="open = !open" 
                        class="flex cursor-pointer items-center justify-between gap-1.5 text-gray-900">
                        <h2 class="text-lg font-semibold font-sans">Pertanyaan Pertama...?</h2>
                        <div x-bind:class="{ '-rotate-180': open }" class="size-5 shrink-0 transition-transform duration-300">
                            <flux:icon name="chevron-down" />
                        </div>
                    </summary>
                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-screen"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-screen"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="overflow-hidden">
                        <p class="pt-4 text-gray-900 font-sans">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab hic veritatis...
                        </p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="py-4">
                    <summary 
                        x-on:click="open = !open" 
                        class="flex cursor-pointer items-center justify-between gap-1.5 text-gray-900">
                        <h2 class="text-lg font-semibold font-sans">Pertanyaan Kedua...?</h2>
                        <div x-bind:class="{ '-rotate-180': open }" class="size-5 shrink-0 transition-transform duration-300">
                            <flux:icon name="chevron-down" />
                        </div>
                    </summary>
                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-screen"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-screen"
                          x-transition:leave-end="opacity-0 max-h-0"
                        class="overflow-hidden">
                        <p class="pt-4 text-gray-900 font-sans">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab hic veritatis...
                        </p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="py-4">
                    <summary 
                        x-on:click="open = !open" 
                        class="flex cursor-pointer items-center justify-between gap-1.5 text-gray-900">
                        <h2 class="text-lg font-semibold font-sans">Pertanyaan Ketiga...?</h2>
                        <div x-bind:class="{ '-rotate-180': open }" class="size-5 shrink-0 transition-transform duration-300">
                            <flux:icon name="chevron-down" />
                        </div>
                    </summary>
                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-screen"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-screen"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="overflow-hidden">
                        <p class="pt-4 text-gray-900 font-sans">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab hic veritatis...
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-layouts.app>
