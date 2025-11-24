<?php

use Livewire\Volt\Component;
use App\Models\Artikel;

new class extends Component {
    public $artikel;

    public function mount($id)
    {
        $this->artikel = Artikel::findOrFail($id);
    }
}; ?>

<div>
    <div class="min-h-screen font-sans text-[#333]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <h1 class="text-3xl md:text-4xl font-bold text-black mb-3 leading-tight">
                        {{ $this->artikel->judul }}
                    </h1>

                    <div class="flex items-center text-gray-600 text-sm mb-6">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                            {{ $this->artikel->penulis ?? 'Admin' }}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $this->artikel->tanggal_publikasi ? $this->artikel->tanggal_publikasi->format('d F Y') : 'Tanggal tidak tersedia' }}
                    </div>

                    <div class="w-full aspect-video bg-gray-300 rounded-lg overflow-hidden mb-8 shadow-sm">
                        @if($this->artikel->attachmentartikel)
                            <img src="{{ Storage::url($this->artikel->attachmentartikel) }}" 
                                 alt="{{ $this->artikel->judul }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                <span class="text-xl">No Image Available</span>
                            </div>
                        @endif
                    </div>

                    <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed text-justify">
                        {!! $this->artikel->isi !!}
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-10">
                        <h3 class="text-xl font-bold text-black mb-6 border-l-4 border-blue-900 pl-3">
                            Artikel Lainnya
                        </h3>
                        <div class="space-y-6">
                            @php
                                $others = Artikel::where('id', '!=', $this->artikel->id)->latest('tanggal_publikasi')->take(3)->get();
                            @endphp
                            @foreach($others as $other)
                            <a href="{{ route('artikel.detail', $other->id) }}" class="group flex gap-4 items-start hover:bg-white/50 p-2 rounded-lg transition">
                                <div class="w-24 h-16 bg-gray-200 rounded-md shrink-0 overflow-hidden">
                                    @if($other->attachmentartikel)
                                        <img src="{{ Storage::url($other->attachmentartikel) }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-gray-800 group-hover:text-blue-800 line-clamp-2">
                                        {{ $other->judul }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $other->tanggal_publikasi ? $other->tanggal_publikasi->format('M Y') : '' }}
                                    </p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
