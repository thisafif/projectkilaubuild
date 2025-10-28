<x-layouts.app :title="__('Dashboard')">
    <div class="w-full flex flex-col gap-20 pb-20">

        {{-- Section 1: Hero --}}

        <div class="w-full h-[600px] px-40 py-72 flex flex-col relative justify-start items-start gap-2.5">
            <div style="background-image: url( '{{ asset('images/house-design.png') }}')"
            class="absolute top-0 left-0 w-full h-full bg-center bg-no-repeat object-cover bg-fixed z-[-1]"></div>
            <div class="absolute top-0 left-0 w-full h-[600px] bg-black opacity-30 z-0"></div>
            <div class="w-full h-full flex flex-col justify-center items-start gap-10 z-1">
                <div class="justify-start text-white text-3xl lg:text-6xl font-bold font-mono">Bangun Dulu<br/>Baru Bayar</div>
                <div class="px-8 py-4 bg-slate-400/40 rounded-[50px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] inline-flex justify-center items-center gap-2.5">
                    <button class="justify-start text-white text-2xl lg:text-4xl font-semibold font-sans">Hubungi Kami</button>
                </div>
            </div>
            <a href="https://wa.me/+6282295444284" 
                class="w-15 h-15 p-2.5 flex absolute bottom-0 right-0 gap-2.5 z-1">
                <img src="{{ asset('icons/ic-whatsapp.svg') }}" alt="Icon WhatsApp" />
            </a>
        </div>

        {{-- Section 2:Tentang Kami --}}

        <div class="w-full flex items-center justify-center
            flex-col gap-12 px-6 py-8            
            lg:flex-row lg:gap-25 lg:px-40">
            <div class="flex flex-col justify-start items-center text-center lg:items-start lg:text-left gap-14">
                <div class="px-4 py-2 bg-sky-700/30 rounded-[50px] shadow-[0px_6px_4px_0px_rgba(0,0,0,0.40)] inline-flex justify-center items-center gap-2.5">
                    <div class="justify-start text-blue-950 text-3xl">
                        <span class="font-bold font-mono">Di balik</span>
                        <span class="italic font-sans">Kilau</span>
                    </div>
                </div>
                <div class="self-stretch">
                    <div class="flex-1 justify-start text-blue-950 text-lg lg:text-xl font-medium font-sans">
                        Setiap kilau menyimpan kisah, setiap kisah mengundang langkah. Ikuti kami, rasakan perjalanannya, dan wujudkan sinar baru bersama kami.
                    </div>
                </div>
            </div>
            <img class="
            size-[200px]
            lg:size-[300px]
            rounded-[10px] shadow-[0px_15px_4px_0px_rgba(0,0,0,0.40)]" 
            src="https://placehold.co/300x300" />
        </div>

        {{-- Section 3: Portofolio --}}

        <div class="w-full flex items-center justify-center
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
                color: black;
                background: #5AB0EF;
                width: 44px;
                height: 44px;
                border-radius: 50%;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            }

            .swiper-button-prev:after,
            .swiper-button-next:after {
                font-size: 18px;
                font-weight: bold;
            }
            </style>

            <div class="swiper card-portofolio">
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
                    <flux:icon name="arrow-left" />
                </div>
                <div class="swiper-button-next">
                    <flux:icon name="arrow-right" />
                </div>
                
                <div class="swiper-pagination"></div>
            </div>

            <div class="flex flex-col justify-start items-start gap-6 max-w-md">
                <div class="text-blue-950 text-3xl font-bold font-mono border-b-4 border-blue-950 pb-2">
                    Portofolio kami
                </div>
                <div class="text-blue-950 text-lg font-medium font-sans leading-relaxed">
                    Berbagai tantangan dalam pembangunan telah kami selesaikan. Kami bertekad untuk membantu dan menjadi solusi untuk #OwneRumah
                </div>
            </div>
        </div>

        {{-- Section4: Project On-going --}}

        {{-- <div>
            Buat Maps:P
        </div> --}}
        <div class="w-full flex items-center justify-center
            flex-col gap-12 px-6 py-8            
            lg:flex-row lg:gap-25 lg:px-40">
            <div class="flex flex-col justify-center items-center gap-3">
                <div class="justify-start text-blue-950 text-4xl font-bold font-mono">Project On-going</div>
                <div class="self-stretch rounded-[50px] outline outline-black inline-flex justify-center items-center gap-2.5">
                    <div class="flex-1 text-center justify-start text-blue-950 text-lg font-medium font-sans">100</div>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center gap-3">
                <div class="justify-start text-blue-950 text-4xl font-bold font-mono">Project Completed</div>
                <div class="self-stretch rounded-[50px] outline outline-black inline-flex justify-center items-center gap-2.5">
                    <div class="flex-1 text-center justify-start text-blue-950 text-lg font-medium font-sans">100</div>
                </div>
            </div>
        </div>

        {{-- Testimoni --}}
        <div class="w-full flex items-center justify-center
            flex-col gap-12 px-6 py-8            
            lg:flex-row lg:gap-25 lg:px-40">
            
            <div class="flex flex-col justify-start items-start gap-6 max-w-md">
                <div class="text-blue-950 text-2xl font-bold font-mono border-b-4 border-blue-950 pb-2">
                    Testimoni Klien
                </div>
                <div class="text-blue-950 text-lg font-medium font-sans leading-relaxed">
                    Kepercayaan klien adalah prioritas utama kami. Simak pengalaman mereka bekerja sama dengan Kilau Build.
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
            <div class="swiper card-testimoni">
                <div class="swiper-wrapper">
                    
                    <div class="swiper-slide">
                        <div class="w-full h-full p-6 bg-white rounded-3xl shadow-xl flex flex-col justify-between">
                            <div class="text-gray-500 text-6xl font-bold leading-none">"</div>
                            <p class="text-gray-700 text-base italic leading-relaxed">
                                Pekerjaan sangat rapi dan hasilnya melebihi ekspektasi. Tim Kilau Build benar-benar profesional.
                            </p>
                            <div>
                                <div class="font-bold text-blue-950 text-xl">Zafira Ryani</div>
                                <div class="text-sm text-gray-500">CEO, Proyek VB-01</div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="w-full h-full p-6 bg-white rounded-2xl shadow-xl flex flex-col justify-between">
                            <div class="text-gray-500 text-6xl font-bold leading-none">"</div>
                            <p class="text-gray-700 text-base italic leading-relaxed">
                                Komunikasi lancar dari awal sampai akhir. Saya sangat merekomendasikan jasa mereka untuk renovasi rumah.
                            </p>
                            <div>
                                <div class="font-bold text-blue-950 text-xl">Budi Santoso</div>
                                <div class="text-sm text-gray-500">Pemilik Rumah, Depok</div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="w-full h-full p-6 bg-white rounded-2xl shadow-xl flex flex-col justify-between">
                            <div class="text-gray-500 text-6xl font-bold leading-none">"</div>
                            <p class="text-gray-700 text-base italic leading-relaxed">
                                Desainnya modern dan fungsional. Terima kasih Kilau Build!
                            </p>
                            <div>
                                <div class="font-bold text-blue-950 text-xl">Citra Lestari</div>
                                <div class="text-sm text-gray-500">Klien, Jakarta</div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="w-full h-full p-6 bg-white rounded-2xl shadow-xl flex flex-col justify-between">
                            <div class="text-gray-500 text-6xl font-bold leading-none">"</div>
                            <p class="text-gray-700 text-base italic leading-relaxed">
                                Proyeknya selesai tepat waktu dan sesuai budget. Highly recommended!
                            </p>
                            <div>
                                <div class="font-bold text-blue-950 text-xl">Ahmad Fauzi</div>
                                <div class="text-sm text-gray-500">Developer, Bogor</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Section 5: Artikel --}}

        <div class="self-stretch inline-flex flex-col justify-start items-start gap-16">
            <div class="self-stretch px-16 inline-flex justify-start items-start gap-2.5">
                <div class="justify-start text-blue-950 text-2xl">
                    <span class="italic font-normal font-sans">Kilau</span>
                    <span class="font-bold font-mono">Journal</span>
                </div>
            </div>
            <div class="self-stretch flex flex-col justify-start items-center gap-14">
                <div class="card w-full flex items-center justify-center
                    flex-col gap-12 px-6 py-8            
                    lg:flex-row lg:gap-25 lg:px-40">
                    <div class="w-96 h-96 bg-white rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] inline-flex flex-col justify-start items-start gap-2.5">
                        <div class="self-stretch flex flex-col justify-start items-center gap-5">
                            <img class="self-stretch h-64 rounded-[20px] object-cover" src="https://placehold.co/435x250" />
                            <div class="self-stretch px-5 flex flex-col justify-start items-start gap-1.5">
                                <div class="self-stretch justify-start text-black text-xl lg:text-3xl font-bold font-mono">Judul Artikel</div>
                                <div class="self-stretch justify-start text-black text-lg lg:text-2xl font-medium font-sans">Lorem ipsum dolor sit amet, consect...</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-96 h-96 bg-white rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] inline-flex flex-col justify-start items-start gap-2.5">
                        <div class="self-stretch flex flex-col justify-start items-center gap-5">
                            <img class="self-stretch h-64 rounded-[20px] object-cover" src="https://placehold.co/435x250" />
                            <div class="self-stretch px-5 flex flex-col justify-start items-start gap-1.5">
                                <div class="self-stretch justify-start text-black text-xl lg:text-3xl font-bold font-mono">Judul Artikel</div>
                                <div class="self-stretch justify-start text-black text-lg lg:text-2xl font-medium font-sans">Lorem ipsum dolor sit amet, consect...</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-96 h-96 bg-white rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] inline-flex flex-col justify-start items-start gap-2.5">
                        <div class="self-stretch flex flex-col justify-start items-center gap-5">
                            <img class="self-stretch h-64 rounded-[20px] object-cover" src="https://placehold.co/435x250" />
                            <div class="self-stretch px-5 flex flex-col justify-start items-start gap-1.5">
                                <div class="self-stretch justify-start text-black text-xl lg:text-3xl font-bold font-mono">Judul Artikel</div>
                                <div class="self-stretch justify-start text-black text-lg lg:text-2xl font-medium font-sans">Lorem ipsum dolor sit amet, consect...</div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="px-4 py-2 bg-cyan-600/20 rounded-[50px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] inline-flex justify-start items-center gap-4">
                    <div class="justify-start text-black text-3xl font-light font-sans">See more </div>
                    <flux:icon name="chevron-right" class="w-6 h-6 relative">
                </button>
            </div>
        </div>

        {{-- Section 6: Lokasi Kantor --}}

        {{-- Section 7: FAQ --}}

        <div class="flow-root">
        <div class="-my-4 flex flex-col divide-y divide-gray-200">
            <div x-data="{ open: false }" class="py-4">
            <summary 
                @click="open = !open" 
                class="flex cursor-pointer items-center justify-between gap-1.5 text-gray-900">
                <h2 class="text-lg font-medium">Ini Pertanyaan Pertama?</h2>

                <svg :class="{ '-rotate-180': open }" class="size-5 shrink-0 transition-transform duration-300" ...>
                <path ... d="M19 9l-7 7-7-7"></path>
                </svg>
            </summary>
            
            <div x-show="open" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 max-h-0"
                x-transition:enter-end="opacity-100 max-h-screen"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 max-h-screen"
                x-transition:leave-end="opacity-0 max-h-0"
                class="overflow-hidden">
                <p class="pt-4 text-gray-900">
                Ini adalah jawaban untuk pertanyaan pertama. Animasinya akan terlihat halus.
                </p>
            </div>
            </div>

            {{-- ACCORDION ITEM 2 --}}
            <div x-data="{ open: false }" class="py-4">
            <summary @click="open = !open" ...>
                <h2 class="text-lg font-medium">Ini Pertanyaan Kedua?</h2>
                <svg :class="{ '-rotate-180': open }" ...> ... </svg>
            </summary>
            <div x-show="open" x-transition... class="overflow-hidden">
                <p class="pt-4 text-gray-900">
                Ini adalah jawaban untuk pertanyaan kedua.
                </p>
            </div>
            </div>

        </div>
        </div>


    </div>
</x-layouts.app>
