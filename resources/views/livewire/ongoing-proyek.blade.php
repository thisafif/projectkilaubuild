<div class="w-full lg:px-40 lg:py-20 px-6 py-8 animate-fade-in-delay">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-blue-950 mb-2">Proyek yang Sedang Berjalan</h2>
        <p class="text-gray-600">Lihat peta dan daftar proyek yang sedang kami kerjakan</p>
    </div>

    {{-- Peta Lokasi Proyek --}}
    <div class="mb-10">
        <div class="w-full">
            <div class="rounded-xl bg-white p-6 shadow-lg">
                <h2 class="mb-4 text-2xl font-bold text-gray-900">
                    Peta Lokasi Proyek
                </h2>

                @if($mapPoints->count() > 0)
                    <div
                        wire:ignore
                        id="public-ongoing-map"
                        class="h-96 w-full rounded-lg border-2 border-gray-200 lg:h-[500px]"
                        data-map-points="{{ $mapPoints->toJson() }}"
                        data-map-initialized="false"
                    ></div>

                    <p class="mt-3 text-sm text-gray-600">
                        📍 Menampilkan {{ $mapPoints->count() }} lokasi proyek ongoing
                    </p>
                @else
                    <div class="rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 py-12 text-center">
                        <p class="text-gray-500">Belum ada proyek dengan data lokasi.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8 gap-4">
        <div>
            <p class="text-xl font-mono text-blue-950">Filter proyek:</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:w-1/2">
            <div>
                <label for="jenisKonsultasi" class="block text-sm font-semibold text-blue-900">
                    Tipe Proyek
                </label>
                <select id="jenisKonsultasi" wire:model="jenisKonsultasi"
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
                    <input id="tahun" type="integer" wire:model="tahun"
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($ongoingproyeks as $ongoingproyek)
                <div class="w-full bg-white rounded-[20px] shadow-lg overflow-hidden">
                    @if ($ongoingproyek->images && is_array($ongoingproyek->images) && count($ongoingproyek->images) > 0)
                        <img class="w-full h-48 object-cover"
                            src="{{ asset('storage/' . $ongoingproyek->images[0]) }}"
                            alt="{{ $ongoingproyek->client_name }}" />
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No image</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold font-mono text-black">
                            {{ $ongoingproyek->client_name }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-2">
                            Status: <span class="font-semibold text-blue-600">{{ ucfirst($ongoingproyek->status) }}</span>
                        </p>
                        <p class="text-sm text-gray-500 mb-2">
                            Progress: <span class="font-semibold">{{ $ongoingproyek->progress_percentage ?? 0 }}%</span>
                        </p>
                        @if (isset($ongoingproyek->location['formatted_address']) && $ongoingproyek->location['formatted_address'])
                            <p class="text-sm text-gray-500 mb-3">
                                📍 {{ $ongoingproyek->location['formatted_address'] }}
                            </p>
                        @endif
                        <p class="mt-2 text-base font-medium font-sans text-gray-600 line-clamp-3">
                            {{ $ongoingproyek->description }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-gray-500">Tidak ada proyek yang cocok.</p>
            @endforelse

        </div>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        const GOOGLE_MAPS_API_KEY = '{{ config("services.google.maps.key") }}';
        let publicMapInstance = null;
        let mapInstance = null;

        function loadGoogleMaps() {
            return new Promise((resolve, reject) => {
                if (window.google?.maps) {
                    resolve();
                    return;
                }
                if (window.googleMapsLoading) {
                    const check = setInterval(() => {
                        if (window.google?.maps) {
                            clearInterval(check);
                            resolve();
                        }
                    }, 100);
                    return;
                }
                window.googleMapsLoading = true;
                const script = document.createElement('script');
                script.src = `https://maps.googleapis.com/maps/api/js?key=${GOOGLE_MAPS_API_KEY}&loading=async`;
                script.async = true;
                script.defer = true;
                script.onload = () => {
                    window.googleMapsLoading = false;
                    resolve();
                };
                script.onerror = () => {
                    window.googleMapsLoading = false;
                    reject(new Error('Failed to load Google Maps'));
                };
                document.head.appendChild(script);
            });
        }        function initPublicMap() {
            const container = document.getElementById('public-ongoing-map');
            if (!container) return;
            
            if (container.dataset.mapInitialized === 'true') return;
            
            if (container.offsetParent === null || container.offsetWidth === 0) {
                console.log('Container not visible yet, retrying...');
                setTimeout(initPublicMap, 200);
                return;
            }

            const pointsData = container.dataset.mapPoints;
            if (!pointsData) return;

            let points = [];
            try {
                points = JSON.parse(pointsData);
            } catch (e) {
                console.error('Parse error:', e);
                return;
            }

            if (points.length === 0 || !window.google?.maps) return;

            publicMapInstance = new google.maps.Map(container, {
                zoom: 11,
                center: { lat: points[0].lat, lng: points[0].lng },
                mapTypeControl: true,
                streetViewControl: true,
                fullscreenControl: true,
            });

                const bounds = new google.maps.LatLngBounds();
                const statusColors = {
                    'consultation': '#f59e0b',
                    'planning': '#3b82f6',
                    'in_progress': '#8b5cf6',
                    'done': '#10b981',
                };
                const statusLabels = {
                    'consultation': 'Konsultasi',
                    'planning': 'Perencanaan',
                    'in_progress': 'Dalam Progres',
                    'done': 'Selesai',
                };

                points.forEach(point => {
                    const position = { lat: parseFloat(point.lat), lng: parseFloat(point.lng) };
                    const color = statusColors[point.status] || '#6b7280';

                const marker = new google.maps.Marker({
                    position,
                    map: publicMapInstance,
                    title: point.name,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 10,
                        fillColor: color,
                        fillOpacity: 0.9,
                        strokeColor: '#ffffff',
                        strokeWeight: 2,
                    },
                });                    bounds.extend(position);

                    const infoContent = `
                        <div style="padding: 12px; max-width: 280px;">
                            <h4 style="margin: 0 0 8px; font-weight: 700; font-size: 16px; color: #111;">
                                ${point.name}
                            </h4>
                            <div style="margin-bottom: 6px;">
                                <span style="display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; color: white; background-color: ${color};">
                                    ${statusLabels[point.status] || point.status}
                                </span>
                            </div>
                            ${point.progress ? `<p style="margin: 4px 0; font-size: 13px; color: #555;">Progress: <strong>${point.progress}%</strong></p>` : ''}
                            ${point.address ? `<p style="margin: 4px 0; font-size: 12px; color: #666;">📍 ${point.address}</p>` : ''}
                        </div>
                    `;

                const infoWindow = new google.maps.InfoWindow({ content: infoContent });
                marker.addListener('click', () => infoWindow.open(publicMapInstance, marker));
                });

            if (points.length > 1) {
                publicMapInstance.fitBounds(bounds);
            } else if (points.length === 1) {
                publicMapInstance.setZoom(14);
            }

            container.dataset.mapInitialized = 'true';
        }

        let initTimeout = null;
        function initMaps() {
            clearTimeout(initTimeout);
            initTimeout = setTimeout(() => {
                const container = document.getElementById('public-ongoing-map');
                if (container) {
                    loadGoogleMaps()
                        .then(() => {
                            setTimeout(initPublicMap, 150);
                        })
                        .catch(err => console.error('Maps error:', err));
                }
            }, 100);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMaps);
        } else {
            initMaps();
        }

        document.addEventListener('livewire:navigated', () => {
            publicMapInstance = null;
            setTimeout(initMaps, 150);
        });
    })();
    </script>
@endpush
