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
                <div class="text-xl">
                    <span class="font-bold text-slate-800 tracking-tight text-4xl">Mengenal</span>
                    <span class="font-serif-display italic text-sky-700 ml-1 relative text-4xl">
                        Kilau Build
                        <svg class="absolute -bottom-1 left-0 w-full h-1 text-white" viewBox="0 0 100 10"
                            preserveAspectRatio="none">
                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="2" fill="none" />
                        </svg>
                    </span>
                </div>
                <p class="text-gray-800 text-lg leading-relaxed font-sans text-justify">
                    Setelah lebih dari <strong class="text-slate-900">dua dekade</strong> di industri konstruksi,
                    KilauBuild kini memfokuskan keahlian kami
                    untuk sektor residensial. Baik itu <strong class="text-slate-900">bangun baru, renovasi, atau
                        interior,</strong> kami paham bahwa <span
                        class="text-sky-700 font-semibold bg-sky-50 px-2 py-1 rounded-full">rumah
                        bukan sekadar bangunan,</span> tapi aset masa depan. <strong class="text-slate-900">Hindari
                        risiko salah</strong> dengan
                    perencanaan RAB
                    yang matang dari kami. Rasakan nyamannya bekerja sama dengan partner yang berani memberikan garansi
                    <span class="text-sky-700 font-semibold bg-sky-50 px-2 py-1 rounded-full"> Bangun Dulu, Baru Bayar.
                    </span>
                </p>
                <button
                    class="px-6 py-3 text-white text-2xl bg-[#73ABD3] font-semibold font-mono rounded-full shadow hover:bg-sky-800 transition delay-150 duration-300 ease-in-out hover:-translate-y-1">
                    <a href="{{ route('konsultasi') }}">
                        Hubungi Kami
                    </a>
                </button>
            </div>
        </div>
    </div>
    {{-- Tim --}}
    </div>
    <livewire:tim />
</x-layouts.app>
