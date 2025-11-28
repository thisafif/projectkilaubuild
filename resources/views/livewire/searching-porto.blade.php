<div class="w-full h-min-screen lg:px-40 px-6 py-8 animate-fade-in-delay">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-950">Portofolio Kami</h2>
            <p class="text-xl font-mono text-blue-950">Filter berdasarkan:</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:w-1/2">
            <div>
                <label for="jenisKonsultasi" class="block text-sm font-semibold text-blue-900">
                    Tipe Proyek
                </label>
                <select id="jenisKonsultasi" wire:model.live="jenisKonsultasi"
                    class="mt-1 w-full bg-white rounded-xl border-2 border-blue-200 px-2 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-0">
                    <option value="">Tipe Proyek</option>
                    <option value="bgnrumah_renovasi">Bangun Rumah</option>
                    <option value="maintenance">Renovasi Rumah</option>
                    <option value="desain_interior">Desain Arsitektural & Interior</option>
                </select>
                @error('jenisKonsultasi')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="tahun" class="block text-sm font-semibold text-blue-900">Tahun</label>
                <div class="mt-1 flex items-center rounded-xl border-2 border-blue-200 bg-white shadow-sm focus-within:border-blue-500">
                    <input id="tahun" type="number" wire:model.live="tahun"
                        class="flex-1 rounded-xl rounded-l-none border-none px-3 py-2 focus:outline-none focus:ring-0"
                        placeholder="Masukkan Tahun">
                </div>
                @error('tahun')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-left">

            @forelse($portofolios as $portofolio)
                <div class="bg-white rounded-3xl p-4 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full border border-slate-100">
                    
                    <div class="relative w-full aspect-4/3 rounded-2xl overflow-hidden bg-gray-100 mb-4">
                        @if ($portofolio->attachmentportofolio)
                            <img src="{{ asset('storage/' . $portofolio->attachmentportofolio) }}"
                                alt="{{ $portofolio->judul }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-50">
                                <span class="text-slate-300 text-sm">No Image</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col flex-1 px-1">
                        <h3 class="text-xl font-bold text-slate-900 mb-2 line-clamp-1">
                            {{ $portofolio->judul }}
                        </h3>
                        
                        <p class="text-slate-500 text-sm mb-2 line-clamp-2">
                            {{ $portofolio->deskripsi_singkat ?? strip_tags($portofolio->isi) }}
                        </p>

                        <p class="text-slate-400 text-xs mb-5">
                            {{ $portofolio->tanggal_proyek ? $portofolio->tanggal_proyek->format('d M Y') : '' }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('portofolio.detail', ['id' => $portofolio->id]) }}" 
                               wire:navigate
                               class="block w-full py-3 bg-cyan-600 hover:bg-cyan-700 text-white text-center text-sm font-semibold rounded-full transition-colors">
                               See more...
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-gray-500 text-center">Tidak ada portofolio yang cocok.</p>
            @endforelse

        </div>
    </div>
</div>