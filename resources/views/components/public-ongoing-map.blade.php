@props(['points'])

<div class="w-full">
    <div class="rounded-xl bg-white p-6 shadow-lg">
        <h2 class="mb-4 text-2xl font-bold text-gray-900">
            Peta Lokasi Proyek
        </h2>

        @if($points->count() > 0)
            <div
                id="public-ongoing-map"
                class="h-96 w-full rounded-lg border-2 border-gray-200 lg:h-[500px]"
                data-map-points="{{ $points->toJson() }}"
                data-map-initialized="false"
            ></div>

            <p class="mt-3 text-sm text-gray-600">
                📍 Menampilkan {{ $points->count() }} lokasi proyek ongoing
            </p>
        @else
            <div class="rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 py-12 text-center">
                <p class="text-gray-500">Belum ada proyek dengan data lokasi.</p>
            </div>
        @endif
    </div>
</div>

@once
@push('scripts')
<script>
    (function() {
        const GOOGLE_MAPS_API_KEY = '{{ config("services.google.maps.key") }}';

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
            }

            function initPublicMap() {
                const container = document.getElementById('public-ongoing-map');
                if (!container || container.dataset.mapInitialized === 'true') return;

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

                const map = new google.maps.Map(container, {
                    zoom: 11,
                    center: { lat: points[0].lat, lng: points[0].lng },
                    mapTypeControl: true,
                    streetViewControl: true,
                    fullscreenControl: true,
                });

                const bounds = new google.maps.LatLngBounds();

                // Status colors
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
                        map,
                        title: point.name,
                        icon: {
                            path: google.maps.SymbolPath.CIRCLE,
                            scale: 10,
                            fillColor: color,
                            fillOpacity: 0.9,
                            strokeColor: '#ffffff',
                            strokeWeight: 2,
                        },
                    });

                    bounds.extend(position);

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
                            ${point.progress ? `
                                <p style="margin: 4px 0; font-size: 13px; color: #555;">
                                    Progress: <strong>${point.progress}%</strong>
                                </p>
                            ` : ''}
                            ${point.address ? `
                                <p style="margin: 4px 0; font-size: 12px; color: #666;">
                                    📍 ${point.address}
                                </p>
                            ` : ''}
                        </div>
                    `;

                    const infoWindow = new google.maps.InfoWindow({
                        content: infoContent,
                    });

                    marker.addListener('click', () => infoWindow.open(map, marker));
                });

                if (points.length > 1) {
                    map.fitBounds(bounds);
                } else if (points.length === 1) {
                    map.setZoom(14);
                }

                container.dataset.mapInitialized = 'true';
            }

            function initMaps() {
                if (document.getElementById('public-ongoing-map')) {
                    loadGoogleMaps()
                        .then(() => initPublicMap())
                        .catch(err => console.error('Maps error:', err));
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initMaps);
            } else {
                initMaps();
            }

            // Support Livewire updates
            document.addEventListener('livewire:navigated', () => setTimeout(initMaps, 100));
        })();
    </script>
@endpush
@endonce
</div>
