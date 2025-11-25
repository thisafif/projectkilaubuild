<div>
    <div class="min-h-screen font-sans text-[#333]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <h1 class="text-3xl md:text-4xl font-bold text-black mb-3 leading-tight">
                        {{ $this->portofolio->judul }}
                    </h1>

                    <div class="flex items-center text-gray-600 text-sm mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $this->portofolio->tanggal_proyek ? $this->portofolio->tanggal_proyek->format('d F Y') : 'Tanggal tidak tersedia' }}
                        
                        <span class="mx-2">•</span>
                        
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-900 border border-blue-100">
                            {{ ucfirst(str_replace('_', ' ', $this->portofolio->tipe)) }}
                        </span>
                    </div>

                    <div class="w-full aspect-video bg-gray-300 rounded-lg overflow-hidden mb-8 shadow-sm">
                        @if($this->portofolio->attachmentportofolio)
                            <img src="{{ asset('storage/'.$this->portofolio->attachmentportofolio) }}" 
                                 alt="{{ $this->portofolio->judul }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-blue-50 flex items-center justify-center text-blue-300">
                                <span class="font-medium">No image available</span>
                            </div>
                        @endif
                    </div>

                    <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed text-justify">
                        {!! $this->portofolio->deskripsi_lengkap ?? $this->portofolio->deskripsi_singkat !!}
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-10">
                        <h3 class="text-xl font-bold text-black mb-6 border-l-4 border-blue-600 pl-3">
                            Portofolio Lainnya
                        </h3>
                        <div class="space-y-6">
                            @forelse($portoLain as $item) 
                            <a href="{{ route('portofolio.detail', $item->id) }}" class="group flex gap-4 items-start hover:bg-white/50 p-2 rounded-lg transition">
                                <div class="w-24 h-16 bg-gray-200 rounded-md flex-shrink-0 overflow-hidden">
                                    @if($item->attachmentportofolio)
                                        <img src="{{ asset('storage/'.$item->attachmentportofolio) }}" class="w-full h-full object-cover" alt="{{ $item->judul }}">
                                    @else
                                        <div class="w-full h-full bg-blue-50 flex items-center justify-center text-blue-300 text-xs">No Image</div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm leading-tight group-hover:text-blue-700 transition mb-1 line-clamp-2">
                                        {{ $item->judul }}
                                    </h4>
                                    <p class="text-xs text-gray-500">
                                        {{ $item->tanggal_proyek ? $item->tanggal_proyek->format('Y') : '-' }}
                                    </p>
                                </div>
                            </a>
                            @empty
                                <p class="text-gray-500 text-sm">Belum ada portofolio lain.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
