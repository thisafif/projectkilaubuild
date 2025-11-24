<div>
    <div class="min-h-screen font-sans text-[#333]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <h1 class="text-3xl md:text-4xl font-bold text-black mb-3 leading-tight">
                        {{ $this->artikel->judul }}
                    </h1>

                    <div class="flex items-center text-gray-600 text-sm mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $this->artikel->created_at ? $this->artikel->created_at->format('d F Y') : 'Tanggal tidak tersedia' }}
                    </div>

                    <div class="w-full aspect-video bg-gray-300 rounded-lg overflow-hidden mb-8 shadow-sm">
                        @if($this->artikel->attachmentartikel)
                            <img src="{{ asset('storage/'.$this->artikel->attachmentartikel) }}" 
                                 alt="{{ $this->artikel->judul }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-[#D69E76] flex items-center justify-center text-white/50">
                                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                        @endif
                    </div>

                    <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed text-justify">
                        {!! $this->artikel->isi !!}
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-10">
                        <h3 class="text-xl font-bold text-black mb-6 border-l-4 border-blue-600 pl-3">
                            Artikel lainnya
                        </h3>
                        <div class="space-y-6">
                            @for($i=0; $i<3; $i++) 
                            <a href="#" class="group flex gap-4 items-start hover:bg-white/50 p-2 rounded-lg transition">
                                <div class="w-24 h-16 bg-[#D69E76] rounded-md flex-shrink-0 overflow-hidden">
                                    <div class="w-full h-full bg-[url('https://images.unsplash.com/photo-1501594907352-04cda38ebc29?auto=format&fit=crop&w=200&q=60')] bg-cover bg-center"></div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm leading-tight group-hover:text-blue-700 transition mb-1">
                                        Lorem ipsum dolor sit amet
                                    </h4>
                                    <p class="text-xs text-gray-500">31 Oktober 2025</p>
                                </div>
                            </a>
                            @endfor
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
