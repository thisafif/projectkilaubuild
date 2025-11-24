<x-filament-widgets::widget>
    <x-filament::section heading="Konsultasi Terbaru">
        @if($consultations->count() > 0)
            <div class="space-y-3">
                @foreach($consultations as $consultation)
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3 last:border-0">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $consultation->nama }}</h3>
                            <div class="mt-1 flex flex-wrap gap-2 text-sm text-gray-600">
                                <span class="text-xs">{{ ucfirst(str_replace('_', ' ', $consultation->jenis_konsultasi)) }}</span>
                                @if($consultation->jadwal)
                                    <span class="text-gray-400">•</span>
                                    <span>
                                        @if($consultation->jadwal->status === 'pending')
                                            <span class="inline-block rounded bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-800">Pending</span>
                                        @elseif($consultation->jadwal->status === 'confirmed')
                                            <span class="inline-block rounded bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">Confirmed</span>
                                        @else
                                            <span class="inline-block rounded bg-red-100 px-2 py-0.5 text-xs font-medium text-red-800">Cancelled</span>
                                        @endif
                                    </span>
                                    <span class="text-gray-400">•</span>
                                    <span class="text-xs">{{ $consultation->jadwal->tanggal->format('d M Y') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="ml-4 text-right">
                            <p class="text-xs text-gray-500">{{ $consultation->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-8 text-center">
                <p class="text-gray-500">Tidak ada konsultasi terbaru</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
