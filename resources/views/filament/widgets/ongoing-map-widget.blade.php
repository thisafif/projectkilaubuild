<x-filament::widget>
    <x-filament::card>
        <div class="space-y-4">
            <h3 class="text-lg font-semibold">
                Peta Proyek yang Sedang Berjalan
            </h3>

            @if($points->count() > 0)
                <div
                    id="ongoing-map-{{ $this->getId() }}"
                    class="w-full h-96 rounded-lg border border-gray-200"
                    data-map-points="{{ $points->toJson() }}"
                    data-map-initialized="false"
                ></div>

                <p class="text-sm text-gray-500">
                    Menampilkan {{ $points->count() }} lokasi proyek
                </p>
            @else
                <div class="text-center py-12 text-gray-500">
                    <p>Belum ada proyek dengan data lokasi.</p>
                </div>
            @endif
        </div>
    </x-filament::card>
</x-filament::widget>