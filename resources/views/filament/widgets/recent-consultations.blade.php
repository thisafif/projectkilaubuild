<x-filament-widgets::widget>
    <x-filament::section heading="Konsultasi & Jadwal">
        @php
            $pending = $consultations->filter(fn($c) => $c->jadwal?->status === 'pending');
            $confirmed = $consultations->filter(fn($c) => $c->jadwal?->status === 'confirmed');
            $cancelled = $consultations->filter(fn($c) => $c->jadwal?->status === 'cancelled');
        @endphp

        @if($consultations->count() > 0)
            <div x-data="{ activeTab: 'pending' }">
                <!-- Tab Navigation -->
                <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                    <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                        <button @click="activeTab = 'pending'"
                            :class="{ 'border-primary-500 text-primary-600': activeTab === 'pending', 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': activeTab !== 'pending' }"
                            class="relative whitespace-nowrap border-b-2 py-2 px-1 text-sm font-medium transition-colors duration-200">
                            Pending
                            <span class="ml-2 inline-flex items-center rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-800">
                                {{ $pending->count() }}
                            </span>
                        </button>
                        <button @click="activeTab = 'confirmed'"
                            :class="{ 'border-primary-500 text-primary-600': activeTab === 'confirmed', 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': activeTab !== 'confirmed' }"
                            class="relative whitespace-nowrap border-b-2 py-2 px-1 text-sm font-medium transition-colors duration-200">
                            Confirmed
                            <span class="ml-2 inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
                                {{ $confirmed->count() }}
                            </span>
                        </button>
                        <button @click="activeTab = 'cancelled'"
                            :class="{ 'border-primary-500 text-primary-600': activeTab === 'cancelled', 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': activeTab !== 'cancelled' }"
                            class="relative whitespace-nowrap border-b-2 py-2 px-1 text-sm font-medium transition-colors duration-200">
                            Cancelled
                            <span class="ml-2 inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-800">
                                {{ $cancelled->count() }}
                            </span>
                        </button>
                    </nav>
                </div>

                <!-- Pending Tab -->
                <div x-show="activeTab === 'pending'">
                    @if($pending->count() > 0)
                        <div class="@if($pending->count() > 3) max-h-96 overflow-y-auto @endif space-y-4">
                            @foreach($pending as $consultation)
                                <div class="rounded-lg border border-gray-200 bg-white p-4 hover:border-blue-300 hover:shadow-sm transition">
                                    <div class="mb-3 flex items-center justify-between">
                                        <h3 class="font-semibold text-gray-900">{{ $consultation->nama }}</h3>
                                        <span class="text-xs text-gray-500">{{ $consultation->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="mb-3 flex flex-wrap gap-2 text-sm text-gray-600">
                                        <span class="inline-block rounded bg-gray-100 px-2 py-1 text-xs">
                                            {{ ucfirst(str_replace('_', ' ', $consultation->jenis_konsultasi)) }}
                                        </span>
                                        <span class="text-gray-400">•</span>
                                        <span class="text-xs">{{ $consultation->no_wa ?? '-' }}</span>
                                    </div>
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
                                                        <span class="inline-block rounded-full bg-yellow-100 text-yellow-800 px-2 py-0.5 text-xs font-medium">
                                                            Pending
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
                            <p class="text-gray-500">Tidak ada konsultasi pending</p>
                        </div>
                    @endif
                </div>

                <!-- Confirmed Tab -->
                <div x-show="activeTab === 'confirmed'" style="display: none;">
                    @if($confirmed->count() > 0)
                        <div class="@if($confirmed->count() > 3) max-h-96 overflow-y-auto @endif space-y-4">
                            @foreach($confirmed as $consultation)
                                <div class="rounded-lg border border-gray-200 bg-white p-4 hover:border-blue-300 hover:shadow-sm transition">
                                    <div class="mb-3 flex items-center justify-between">
                                        <h3 class="font-semibold text-gray-900">{{ $consultation->nama }}</h3>
                                        <span class="text-xs text-gray-500">{{ $consultation->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="mb-3 flex flex-wrap gap-2 text-sm text-gray-600">
                                        <span class="inline-block rounded bg-gray-100 px-2 py-1 text-xs">
                                            {{ ucfirst(str_replace('_', ' ', $consultation->jenis_konsultasi)) }}
                                        </span>
                                        <span class="text-gray-400">•</span>
                                        <span class="text-xs">{{ $consultation->no_wa ?? '-' }}</span>
                                    </div>
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
                                                        <span class="inline-block rounded-full bg-green-100 text-green-800 px-2 py-0.5 text-xs font-medium">
                                                            Confirmed
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
                            <p class="text-gray-500">Tidak ada konsultasi confirmed</p>
                        </div>
                    @endif
                </div>

                <!-- Cancelled Tab -->
                <div x-show="activeTab === 'cancelled'" style="display: none;">
                    @if($cancelled->count() > 0)
                        <div class="@if($cancelled->count() > 3) max-h-96 overflow-y-auto @endif space-y-4">
                            @foreach($cancelled as $consultation)
                                <div class="rounded-lg border border-gray-200 bg-white p-4 hover:border-blue-300 hover:shadow-sm transition">
                                    <div class="mb-3 flex items-center justify-between">
                                        <h3 class="font-semibold text-gray-900">{{ $consultation->nama }}</h3>
                                        <span class="text-xs text-gray-500">{{ $consultation->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="mb-3 flex flex-wrap gap-2 text-sm text-gray-600">
                                        <span class="inline-block rounded bg-gray-100 px-2 py-1 text-xs">
                                            {{ ucfirst(str_replace('_', ' ', $consultation->jenis_konsultasi)) }}
                                        </span>
                                        <span class="text-gray-400">•</span>
                                        <span class="text-xs">{{ $consultation->no_wa ?? '-' }}</span>
                                    </div>
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
                                                        <span class="inline-block rounded-full bg-red-100 text-red-800 px-2 py-0.5 text-xs font-medium">
                                                            Cancelled
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
                            <p class="text-gray-500">Tidak ada konsultasi cancelled</p>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="py-8 text-center">
                <p class="text-gray-500">Tidak ada data konsultasi</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
