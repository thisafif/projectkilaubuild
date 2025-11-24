<x-filament-widgets::widget>
    <x-filament::section heading="Konsultasi & Jadwal">
        @if($consultations->count() > 0)
            <div class="space-y-4">
                @foreach($consultations as $consultation)
                    <div class="rounded-lg border border-gray-200 bg-white p-4 hover:border-blue-300 hover:shadow-sm transition">
                        <!-- Nama Konsultasi (Heading) -->
                        <div class="mb-3 flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900">{{ $consultation->nama }}</h3>
                            <span class="text-xs text-gray-500">{{ $consultation->created_at->diffForHumans() }}</span>
                        </div>

                        <!-- Detail Konsultasi -->
                        <div class="mb-3 flex flex-wrap gap-2 text-sm text-gray-600">
                            <span class="inline-block rounded bg-gray-100 px-2 py-1 text-xs">
                                {{ ucfirst(str_replace('_', ' ', $consultation->jenis_konsultasi)) }}
                            </span>
                            <span class="text-gray-400">•</span>
                            <span class="text-xs">{{ $consultation->no_wa ?? '-' }}</span>
                        </div>

                        <!-- Jadwal Terkait (jika ada) -->
                        @if($consultation->jadwal)
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex items-start gap-3">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-100">
                                        @if($consultation->jadwal->tipe_konsultasi === 'visit')
                                            <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                            </svg>
                                        @else
                                            <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $consultation->jadwal->jam }}
                                            </span>
                                            <span class="inline-block rounded-full 
                                                @if($consultation->jadwal->status === 'pending')
                                                    bg-yellow-100 text-yellow-800
                                                @elseif($consultation->jadwal->status === 'confirmed')
                                                    bg-green-100 text-green-800
                                                @else
                                                    bg-red-100 text-red-800
                                                @endif
                                                px-2 py-0.5 text-xs font-medium">
                                                @if($consultation->jadwal->status === 'pending')
                                                    Pending
                                                @elseif($consultation->jadwal->status === 'confirmed')
                                                    Confirmed
                                                @else
                                                    Cancelled
                                                @endif
                                            </span>
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $consultation->jadwal->tanggal->format('d M Y') }} 
                                            • 
                                            {{ $consultation->jadwal->tipe_konsultasi === 'visit' ? 'Kunjungan Lokasi' : 'Online' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="border-t border-gray-200 pt-3">
                                <p class="text-xs text-gray-400">Belum ada jadwal terjadwal</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-8 text-center">
                <p class="text-gray-500">Tidak ada data konsultasi</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
