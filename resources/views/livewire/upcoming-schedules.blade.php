<x-filament-widgets::widget>
    <x-filament::section heading="Jadwal Mendatang">
        @if($schedules->count() > 0)
            <div class="space-y-3">
                @foreach($schedules as $schedule)
                    <div class="flex items-start gap-3 rounded-lg border border-gray-200 bg-gray-50 p-3">
                        <div class="flex-shrink-0">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                                @if($schedule->tipe_konsultasi === 'visit')
                                    <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                    </svg>
                                @else
                                    <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $schedule->konsultasi?->nama ?? 'Konsultasi' }}</h3>
                            <div class="mt-1 space-y-1 text-sm text-gray-600">
                                <p>{{ $schedule->jam }}</p>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block rounded-full bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-800">
                                        {{ $schedule->tipe_konsultasi === 'visit' ? 'Kunjungan Lokasi' : 'Online' }}
                                    </span>
                                    <span class="text-xs text-gray-500">{{ $schedule->tanggal->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-8 text-center">
                <p class="text-gray-500">Tidak ada jadwal mendatang</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
