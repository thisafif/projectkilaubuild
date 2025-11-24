<x-layouts.app :title="__('Beranda')">
    <div class="w-full flex flex-col gap-20 pb-20">

        {{-- Section 1: Hero --}}

        <div id="hero"
            class="w-full h-[583px] px-20 py-15 lg:px-40 lg:py-50 flex flex-col relative justify-start items-start gap-2.5">
            <div style="background-image: url( '{{ asset('images/house-design.png') }}')"
                class="absolute top-0 left-0 w-full h-full object-cover bg-cover bg-center bg-scroll z-[-1]"></div>
            <div class="absolute top-0 left-0 w-full h-[583px] bg-black opacity-60 z-0"></div>
            <div class="w-full h-full flex flex-col text-center justify-center items-center gap-5 z-1">
                <div
                    class="inline-flex items-center gap-2 backdrop-blur-md px-4 py-2 rounded-full w-fit border border-white/20 animate-slide-down">
                    <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                    <span class="text-white/90 text-sm font-medium">Dipercaya oleh 100+ Customer</span>
                </div>
                <div class="justify-start text-white text-xl lg:text-6xl font-bold font-mono animate-slide-up">Bangun
                    Dulu<br />Baru
                    Bayar</div>
                <p
                    class="text-base font-sans lg:text-lg text-white/80 max-w-3xl leading-relaxed animate-slide-up-delay">
                    Wujudkan rumah impian Anda dengan konsultasi gratis. Mulai dari desain hingga konstruksi, kami siap
                    membantu setiap langkah perjalanan Anda.
                </p>
                <a href="{{ route('konsultasi') }}"
                    class="group px-4 py-2 lg:px-8 lg:py-4 bg-white text-gray-900 rounded-full font-semibold text-base lg:text-lg shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 inline-flex items-center justify-center gap-3 animate-scale-in">
                    <span>Hubungi Kami</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                <div id="scrollDown"
                    class="absolute bottom-3 left-1/2 transform -translate-x-1/2 z-10 cursor-pointer animate-bounce">
                    <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </div>
            <a href="https://wa.me/+6282295444284"
                class="lg:w-15 lg:h-15 w-13 h-13 p-2.5 flex absolute bottom-0 right-0 gap-2.5 z-1 animate-fade-in-delay">
                <img src="{{ asset('icons/ic-whatsapp.svg') }}" alt="Icon WhatsApp" />
            </a>
        </div>

        {{-- Section 2: Tentang --}}

        <section id="about" class="relative w-full py-20 lg:py-32 ">
            <div class="absolute inset-0 pointer-events-none opacity-[0.03]"
                style="background-image: radial-gradient(#0f172a 1px, transparent 1px); background-size: 32px 32px;">
            </div>

            <div class="container mx-auto px-6 lg:px-16 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

                    <div data-aos="fade-right"
                        class="lg:col-span-6 flex flex-col items-center lg:items-start text-center lg:text-left">

                        <div class="mb-8">
                            <div
                                class="bg-sky-700/30 inline-flex items-center px-6 py-3 rounded-full shadow-sm transition-all hover:shadow-md hover:bg-sky-700/30 group cursor-default">
                                <div class="text-xl">
                                    <span class="font-bold text-slate-800 tracking-tight text-2xl">Di balik</span>
                                    <span class="font-serif-display italic text-sky-700 ml-1 relative text-2xl">
                                        Kilau Build
                                        <svg class="absolute -bottom-1 left-0 w-full h-1 text-white"
                                            viewBox="0 0 100 10" preserveAspectRatio="none">
                                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="2"
                                                fill="none" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-6 leading-tight">
                            Investasi Hunian Jadi Aman.
                        </h2>

                        <div class="space-y-6 text-slate-600 text-lg leading-relaxed text-justify">
                            <p>
                                Rumah adalah investasi jangka panjang yang tak ternilai. Kami memegang prinsip: <strong
                                    class="text-slate-900">"Jangan sampai Anda salah bangun."</strong> Membangun hunian
                                bukan sekadar menyusun bata, melainkan menciptakan aset masa depan yang harus presisi
                                dan bernilai.
                            </p>
                            <p>
                                Kami menghadirkan rasa aman dan nyaman bagi Anda melalui sistem <strong
                                    class="text-slate-900">"Bangun Dulu, Baru Bayar."</strong> dan menyediakan <strong
                                    class="text-slate-900">
                                    Konsultasi Gratis </strong> ke lokasi melalui
                                <span
                                    class="text-sky-700 font-semibold bg-sky-50 px-2 py-1 rounded-full">#KilauDatangKerumah.
                                </span>
                            </p>
                        </div>

                        <div class="w-24 h-1 bg-gradient-to-r from-sky-700/30 to-transparent mt-8 mb-8 rounded-full">
                        </div>

                        <div>
                            <a href="{{ route('konsultasi') }}"
                                class="group inline-flex items-center gap-3 text-slate-900 font-semibold transition-all">
                                <span
                                    class="border-b-2 border-transparent group-hover:border-sky-700 transition-colors pb-0.5">Konsultasi
                                    Gratis Sekarang</span>
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 group-hover:bg-sky-700 group-hover:text-white transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div data-aos="fade-left" class="lg:col-span-6 relative mt-12 lg:mt-0 group perspective-1000">

                        <div class="absolute -top-8 -right-8 w-32 h-32 opacity-20">
                            <svg width="100%" height="100%" fill="none">
                                <pattern id="dots" x="0" y="0" width="20" height="20"
                                    patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="3" height="3" class="text-sky-700"
                                        fill="currentColor" />
                                </pattern>
                                <rect width="100%" height="100%" fill="url(#dots)" />
                            </svg>
                        </div>
                        <div
                            class="relative rounded-3xl overflow-hidden shadow-2xl shadow-slate-200 border-[6px] border-white transform transition-transform duration-700 hover:scale-[1.02]">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=2053&auto=format&fit=crop"
                                alt="Arsitek Kilau Build Profesional"
                                class="w-full h-[400px] lg:h-[500px] object-cover object-center" />
                            <div
                                class="absolute bottom-0 left-0 w-full h-1/3 bg-gradient-to-t from-slate-900/50 to-transparent">
                            </div>
                        </div>
                        <div
                            class="absolute -bottom-6 -left-4 lg:-left-10 bg-white p-5 rounded-xl shadow-soft-xl border border-slate-100 max-w-[220px] transform transition-transform hover:-translate-y-2 duration-300 flex items-center gap-4">
                            <div class="bg-sky-50 p-3 rounded-lg text-sky-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                                </svg>

                            </div>
                            <div>
                                <p class="text-2xl font-bold text-slate-900 leading-none">23+</p>
                                <p class="text-xs text-slate-500 uppercase tracking-wide font-semibold mt-1">Tahun
                                    Pengalaman</p>
                            </div>
                        </div>

                        <div
                            class="hidden lg:flex absolute top-8 -right-6 bg-slate-900 text-white px-5 py-3 rounded-lg shadow-lg items-center gap-3 transform rotate-3 group-hover:rotate-0 transition-all duration-500">
                            <div class="text-left">
                                <p class="text-lg font-bold text-sky-400">GRATIS</p>
                                <p class="text-[10px] text-slate-300 uppercase tracking-wider">Biaya Konsultasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 3: Portofolio --}}

        <div
            class="w-full flex items-center justify-center
            flex-col gap-16 px-6 py-12            
            lg:flex-row lg:gap-16 lg:px-40 lg:py-20">
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
                    width: 35px;
                    height: 35px;
                    border-radius: 100%;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                    transition: all 300ms ease-in-out;
                    padding: 8px;
                }

                .swiper-button-next:hover,
                .swiper-button-prev:hover {
                    background: #1C274C;
                    color: white;
                    transform: translateY(-2px);
                    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
                }

                .swiper-button-prev:after,
                .swiper-button-next:after {
                    font-size: 18px;
                    font-weight: bold;
                }
            </style>

            <div class="swiper card-portofolio w-full lg:w-auto" data-aos="flip-down">
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
                <div class="swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                            clip-rule="evenodd" />
                    </svg>

                    </svg>

                </div>

                <div class="swiper-pagination"></div>
            </div>

            <div data-aos="fade-left" class="flex flex-col justify-start items-start gap-6 max-w-lg w-full lg:w-auto">
                <div class="mb-2">
                    <div
                        class="bg-sky-700/30 inline-flex items-center px-6 py-3 rounded-full shadow-sm transition-all hover:shadow-md hover:bg-sky-700/40 group cursor-default">
                        <div class="text-xl">
                            <span class="font-bold text-slate-800 tracking-tight text-2xl">Kilau Build's</span>
                            <span class="font-serif-display italic text-sky-700 ml-1 relative text-2xl">
                                Portofolio
                                <!-- Underline decoration -->
                                <svg class="absolute -bottom-1 left-0 w-full h-1 text-white" viewBox="0 0 100 10"
                                    preserveAspectRatio="none">
                                    <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="2"
                                        fill="none" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-blue-950 leading-tight">Bukti Nyata.</h3>
                <div class="space-y-6 text-slate-600 text-lg leading-relaxed text-justify">
                    <p class="text-blue-950 text-base lg:text-lg font-medium font-sans leading-relaxed">
                        Portofolio ini adalah <strong class="text-slate-900"> bukti nyata </strong> 
                        bagaimana kami mengubah desain menjadi <strong class="text-slate-900">aset masa depan yang berkualitas.</strong>
                        Setiap karya di sini menjadi jaminan transparansi bahwa investasi hunian Anda <span
                            class="text-sky-700 font-semibold bg-sky-50 px-2 py-1 rounded-full">aman dan
                            berkualitas</span> yang dibangun terstandar.
                    </p>
                </div>
                <!-- Divider Line -->
                <div class="w-24 h-1 bg-gradient-to-r from-sky-700/30 to-transparent rounded-full">
                </div>

                <!-- CTA Link -->
                <div>
                    <a href="{{ route('portofolio') }}"
                        class="group inline-flex items-center gap-3 text-slate-900 font-semibold transition-all">
                        <span
                            class="border-b-2 border-transparent group-hover:border-sky-700 transition-colors pb-0.5">Lihat
                            Portofolio</span>
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 group-hover:bg-sky-700 group-hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Section 4: Project On-going | Buat Maps:P --}}

        <div class="w-full flex flex-col gap-12 px-6 py-12 lg:px-40 lg:py-20" data-aos="fade-up"
            data-aos-duration="1500">
            <div class="flex flex-col gap-8 items-start">
                <div>
                    <div
                        class="bg-sky-700/30 inline-flex items-center px-6 py-3 rounded-full shadow-sm transition-all hover:shadow-md hover:bg-sky-700/30 group cursor-default">
                        <div class="text-xl">
                            <span class="font-bold text-slate-800 tracking-tight text-2xl">Peta</span>
                            <span class="font-serif-display italic text-sky-700 ml-1 relative text-2xl">
                                Proyek
                                <svg class="absolute -bottom-1 left-0 w-full h-1 text-white" viewBox="0 0 100 10"
                                    preserveAspectRatio="none">
                                    <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="2"
                                        fill="none" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 text-slate-600 text-lg leading-relaxed text-justify">
                    <p>Menampilkan lokasi proyek kami yang <strong class="text-slate-900">sedang
                            berjalan</strong> dan <strong class="text-slate-900">telah selesai</strong>.</p>
                </div>

                <div class="w-full flex">
                    <x-public-ongoing-map :points="$points" />
                </div>

                <div data-aos="zoom-in-up"
                    class="w-full flex items-center justify-center
            flex-col gap-12 px-6            
            lg:flex-row lg:gap-25 lg:px-40">
                    <div class="w-full max-w-5xl mx-auto py-10">

                        <div
                            class="flex flex-col md:flex-row items-center justify-center divide-y md:divide-y-0 md:divide-x divide-slate-800">

                            <div class="w-full md:w-1/2 flex items-center justify-center gap-6 py-8 md:py-0 md:pr-12"
                                data-aos="fade-up">
                                <div class="p-4 bg-white rounded-full text-sky-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 576 512"
                                        fill="currentColor"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path
                                            d="M208 40a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zM10.5 181.3c5.9-11.9 20.3-16.7 32.2-10.7l24.6 12.3 12.2-20.4c18.9-31.5 53.2-50.5 89.6-50.5 46.2 0 87.7 30.5 100.5 75.4l32.2 112.7 92.9 46.4 25.8-43c5.8-9.6 16.2-15.5 27.4-15.5s21.7 5.9 27.4 15.5l96 160c5.9 9.9 6.1 22.2 .4 32.2S555.5 512 544 512l-192 0c-11.5 0-22.2-6.2-27.8-16.2s-5.5-22.3 .4-32.2L370 387.8 21.3 213.5c-11.9-5.9-16.7-20.3-10.7-32.2zM94.3 307.4l112 56c10.8 5.4 17.7 16.5 17.7 28.6l0 88c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-68.2-61.3-30.7-36.3 109c-5.6 16.8-23.7 25.8-40.5 20.2S-3.9 486.6 1.7 469.9l48-144c2.9-8.8 9.5-15.9 18.1-19.4s18.3-3.2 26.6 .9z" />
                                    </svg>
                                </div>

                                <div class="flex flex-col">
                                    <span
                                        class="text-4xl lg:text-5xl font-bold text-blue-950 tracking-tight leading-none">
                                        {{ $ongoingCount ?? 0 }}
                                    </span>
                                    <span
                                        class="text-sm font-medium text-slate-500 mt-1 uppercase tracking-wide">Proyek
                                        Berjalan</span>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 flex items-center justify-center gap-6 py-8 md:py-0 md:pl-12"
                                data-aos="fade-up" data-aos-delay="100">
                                <div class="p-4 bg-white rounded-full text-sky-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                                        class="size-6"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path
                                            d="M277.8 8.6c-12.3-11.4-31.3-11.4-43.5 0l-224 208c-9.6 9-12.8 22.9-8 35.1S18.8 272 32 272l16 0 0 176c0 35.3 28.7 64 64 64l288 0c35.3 0 64-28.7 64-64l0-176 16 0c13.2 0 25-8.1 29.8-20.3s1.6-26.2-8-35.1l-224-208zM240 320l32 0c26.5 0 48 21.5 48 48l0 96-128 0 0-96c0-26.5 21.5-48 48-48z" />
                                    </svg>
                                </div>

                                <div class="flex flex-col">
                                    <span
                                        class="text-4xl lg:text-5xl font-bold text-blue-950 tracking-tight leading-none">
                                        {{ $completedCount ?? 0 }}
                                    </span>
                                    <span
                                        class="text-sm font-medium text-slate-500 mt-1 uppercase tracking-wide">Proyek
                                        Selesai</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container mx-auto px-6 py-16 lg:px-16 relative z-10">
                <div
                    class="w-full flex items-center justify-center
                flex-col gap-12           
                lg:flex-row lg:gap-16">

        {{-- Section 4: Testimoni --}}


                    <div data-aos="zoom-out-up" class="flex flex-col justify-start items-start gap-6 max-w-md">
                        <div>
                            <div
                                class="bg-sky-700/30 inline-flex items-center px-6 py-3 rounded-full shadow-sm transition-all hover:shadow-md hover:bg-sky-700/30 group cursor-default">
                                <div class="text-xl">
                                    <span class="font-bold text-slate-800 tracking-tight text-2xl">Ucap</span>
                                    <span class="font-serif-display italic text-sky-700 ml-1 relative text-2xl">
                                        Mereka
                                        <svg class="absolute -bottom-1 left-0 w-full h-1 text-white"
                                            viewBox="0 0 100 10" preserveAspectRatio="none">
                                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="2"
                                                fill="none" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-6 text-slate-600 text-lg leading-relaxed text-justify"> Pengalaman para
                            klien
                            menjadi bukti bahwa proses kami memberikan <strong class="text-slate-900">rasa
                                aman</strong>
                            sepanjang
                            pembangunan hunian.
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
                                    <div
                                        class="w-full h-full p-6 bg-white rounded-3xl shadow-xl flex flex-col justify-between">
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
            </div>
        </div>


        {{-- Section 5: Artikel --}}
        <div data-aos="fade-up" data-aos-delay="100"
            class="w-full flex flex-col justify-start items-start gap-16 px-6 py-12 lg:px-40 lg:py-20">
            <div data-aos-delay="300" class="w-full flex flex-col justify-start items-center gap-14">
                <div>
                    <div
                        class="bg-sky-700/30 inline-flex items-center px-6 py-3 rounded-full shadow-sm transition-all hover:shadow-md group cursor-default">
                        <div class="text-xl">
                            <span class="font-bold text-slate-800 tracking-tight text-2xl">Kilau Build's</span>
                            <span class="font-serif-display italic text-sky-700 ml-1 relative text-2xl">
                                Journal
                                <svg class="absolute -bottom-1 left-0 w-full h-1 text-white" viewBox="0 0 100 10"
                                    preserveAspectRatio="none">
                                    <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="2"
                                        fill="none" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div
                    class="w-full flex items-center justify-center flex-col gap-4 px-6 py-8 lg:flex-row lg:gap-8 lg:px-0">
                    @forelse($artikels as $artikel)
                        <div
                            class="w-full lg:w-72 h-auto bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 inline-flex flex-col justify-start items-start gap-0 overflow-hidden">
                            <div class="self-stretch flex flex-col justify-start items-center gap-0">
                                @if ($artikel->attachmentartikel)
                                    <img class="self-stretch h-48 lg:h-52 rounded-2xl object-cover"
                                        src="{{ asset('storage/' . $artikel->attachmentartikel) }}"
                                        alt="{{ $artikel->judul }}" />
                                @else
                                    <div class="self-stretch h-48 lg:h-52 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">No image</span>
                                    </div>
                                @endif
                                <div class="self-stretch p-5 flex flex-col justify-start items-start gap-2">
                                    <div
                                        class="self-stretch justify-start text-gray-900 text-lg lg:text-xl font-bold font-mono line-clamp-2">
                                        {{ $artikel->judul }}
                                    </div>
                                    <div
                                        class="self-stretch justify-start text-gray-600 text-sm lg:text-base font-medium font-sans line-clamp-2">
                                        {!! Str::limit(strip_tags($artikel->isi), 100) !!}
                                    </div>
                                    <a href="{{ route('artikel.detail', ['id' => $artikel->id]) }}"
                                        class="text-sky-700 font-semibold text-sm hover:underline mt-2">
                                        Baca Selengkapnya &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">Belum ada artikel terbaru.</p>
                    @endforelse
                </div>
                <div>
                    <div class="w-24 h-1 bg-gradient-to-r from-sky-700/30 to-transparent rounded-full">
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('artikel') }}"
                            class="group inline-flex items-center gap-3 text-slate-900 font-semibold transition-all">
                            <span
                                class="border-b-2 border-transparent group-hover:border-sky-700 transition-colors pb-0.5">Lihat
                                Artikel Lainnya</span>
                            <span
                                class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 group-hover:bg-sky-700 group-hover:text-white transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 6: Lokasi Kantor --}}

        <section id="location" class="relative w-full py-16 lg:py-24 overflow-hidden">
            <div class="container mx-auto px-6 lg:px-12 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    <div class="order-2 lg:order-1" data-aos="fade-right">
                        <div>
                            <div
                                class="bg-sky-700/30 inline-flex items-center px-6 py-3 rounded-full shadow-sm transition-all hover:shadow-md group cursor-default">
                                <div class="text-xl">
                                    <span class="font-bold text-slate-800 tracking-tight text-2xl">Kilau Build's</span>
                                    <span class="font-serif-display italic text-sky-700 ml-1 relative text-2xl">
                                        Location
                                        <svg class="absolute -bottom-1 left-0 w-full h-1 text-white"
                                            viewBox="0 0 100 10" preserveAspectRatio="none">
                                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="2"
                                                fill="none" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <h2 class="pt-8 text-3xl lg:text-4xl font-bold text-blue-950 mb-6 leading-tight">
                            Kunjungi Kami,<br>
                            <span class="text-sky-700 font-serif-display italic">Wujudkan Rencana Anda.</span>
                        </h2>

                        <p class="text-slate-600 text-lg mb-8 leading-relaxed">
                            Diskusikan detail hunian impian Anda secara langsung dengan <strong
                                class="text-slate-900">tim ahli kami secara langsung</strong>
                            tatap muka. Kopi hangat sudah kami siapkan untuk Anda.
                        </p>
                        <div
                            class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 mb-8 hover:border-sky-100 transition-colors duration-300">
                            <a href="https://maps.app.goo.gl/2522uqyte4YnvYNi6" target="_blank"
                                rel="noopener noreferrer" class="flex items-start gap-4 group">
                                <div
                                    class="p-3 bg-sky-50 text-sky-700 rounded-lg group-hover:bg-sky-700 group-hover:text-white transition-colors duration-300 shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-blue-950 font-bold text-lg mb-1">Kilau Buld | Jasa Konstruksi,
                                        Interior, dan Design Terpercaya</h4>
                                    <p class="text-slate-600 leading-relaxed">
                                        Jl. Raya Citayam No.34, RT.7/RW.001/004,<br>
                                        Pd. Jaya, Kec. Cipayung, Kota Depok,<br>
                                        Jawa Barat 16444
                                    </p>
                                    <span
                                        class="inline-block mt-2 text-sm font-medium text-sky-700 group-hover:underline">Lihat
                                        di Google Maps &rarr;</span>
                                </div>
                            </a>
                        </div>
                        <span class="text-sky-700 font-semibold bg-sky-50 px-4 py-2 rounded-full"> #KilauDatangKerumah
                        </span>
                        <p class="text-slate-600 text-lg mb-8 leading-relaxed mt-4">
                            Kami juga melayani <strong class="text-slate-900">konsultasi di hunian Anda </strong>
                            dengan mengisi
                            form melalui tombol di bawah ini.
                        </p>

                        <div>
                            <div class="w-24 h-1 bg-gradient-to-r from-sky-700/30 to-transparent rounded-full">
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('artikel') }}"
                                    class="group inline-flex items-center gap-3 text-slate-900 font-semibold transition-all">
                                    <span
                                        class="border-b-2 border-transparent group-hover:border-sky-700 transition-colors pb-0.5">Jadwalkan
                                        Konsultasi</span>
                                    <span
                                        class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 group-hover:bg-sky-700 group-hover:text-white transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12">
                                            </line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="order-1 lg:order-2 relative" data-aos="zoom-in-up">
                        <div class="absolute -top-6 -right-6 w-24 h-24 opacity-20 -z-10">
                            <svg width="100%" height="100%" fill="none">
                                <pattern id="dots-loc" x="0" y="0" width="20" height="20"
                                    patternUnits="userSpaceOnUse">
                                    <circle cx="2" cy="2" r="2" class="text-sky-700"
                                        fill="currentColor" />
                                </pattern>
                                <rect width="100%" height="100%" fill="url(#dots-loc)" />
                            </svg>
                        </div>

                        <div
                            class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white h-[400px] lg:h-[500px] w-full">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.602838743073!2d106.80147407469862!3d-6.445011493546286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e92ce61a47ef%3A0x4a71e1bb8f782d09!2sKILAU%20BUILD%20%7C%20Jasa%20Konstruksi%2C%20Interior%2C%20dan%20Design%20Terpercaya!5e0!3m2!1sen!2sid!4v1761927489704!5m2!1sen!2sid"
                                class="absolute inset-0 w-full h-full border-0" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- Section 7: FAQ --}}

        <div class="w-full items-center justify-center
                    flex flex-col gap-12 px-6 py-8            
                    lg:flex-col lg:gap-25 lg:px-40"
            data-aos="fade-up" data-aos-duration="1500">
            <div>
                <div
                    class="bg-sky-700/30 inline-flex items-center px-6 py-3 rounded-full shadow-sm transition-all hover:shadow-md group cursor-default">
                    <div class="text-xl">
                        <span class="font-bold text-slate-800 tracking-tight text-2xl">Yang Biasa</span>
                        <span class="font-serif-display italic text-sky-700 ml-1 relative text-2xl">
                            Ditanyakan
                            <svg class="absolute -bottom-1 left-0 w-full h-1 text-white" viewBox="0 0 100 10"
                                preserveAspectRatio="none">
                                <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="2" fill="none" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="w-full -my-4 flex flex-col divide-y divide-black">
                <div x-data="{ open: false }" class="py-4">
                    <summary x-on:click="open = !open"
                        class="flex cursor-pointer items-center justify-between gap-1.5 text-gray-900">
                        <h2 class="text-lg font-semibold font-sans">Pertanyaan Pertama...?</h2>
                        <div x-bind:class="{ '-rotate-180': open }"
                            class="size-5 shrink-0 transition-transform duration-300">
                            <flux:icon name="chevron-down" />
                        </div>
                    </summary>
                    <div x-show="open" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0"
                        class="overflow-hidden">
                        <p class="pt-4 text-gray-900 font-sans">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab hic veritatis...
                        </p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="py-4">
                    <summary x-on:click="open = !open"
                        class="flex cursor-pointer items-center justify-between gap-1.5 text-gray-900">
                        <h2 class="text-lg font-semibold font-sans">Pertanyaan Kedua...?</h2>
                        <div x-bind:class="{ '-rotate-180': open }"
                            class="size-5 shrink-0 transition-transform duration-300">
                            <flux:icon name="chevron-down" />
                        </div>
                    </summary>
                    <div x-show="open" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0"
                        class="overflow-hidden">
                        <p class="pt-4 text-gray-900 font-sans">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab hic veritatis...
                        </p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="py-4">
                    <summary x-on:click="open = !open"
                        class="flex cursor-pointer items-center justify-between gap-1.5 text-gray-900">
                        <h2 class="text-lg font-semibold font-sans">Pertanyaan Ketiga...?</h2>
                        <div x-bind:class="{ '-rotate-180': open }"
                            class="size-5 shrink-0 transition-transform duration-300">
                            <flux:icon name="chevron-down" />
                        </div>
                    </summary>
                    <div x-show="open" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0"
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
