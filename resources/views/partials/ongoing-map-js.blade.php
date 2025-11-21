<script>
    (function () {
        function getPoints() {
            var container = document.getElementById('ongoing-map');
            if (!container) return [];

            var json = container.getAttribute('data-ongoing-map-points') || '[]';

            try {
                return JSON.parse(json);
            } catch (e) {
                console.error('OngoingMapWidget: gagal parse points', e);
                return [];
            }
        }

        function loadGoogleMaps(callback) {
            if (typeof google !== 'undefined' && google.maps) {
                callback();
                return;
            }

            var existing = document.getElementById('kilau-google-maps-script');
            if (existing) {
                setTimeout(function () {
                    loadGoogleMaps(callback);
                }, 500);
                return;
            }

            var s = document.createElement('script');
            s.id  = 'kilau-google-maps-script';
            s.src = 'https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.key') }}';
            s.async = true;
            s.defer = true;
            s.onload = callback;
            document.head.appendChild(s);
        }

        function initOngoingMap() {
            var el = document.getElementById('ongoing-map');
            if (!el) return;

            if (el.dataset.initialized === '1') return;
            el.dataset.initialized = '1';

            var points = getPoints();
            console.log('OngoingMapWidget: points =', points);

            loadGoogleMaps(function () {
                var defaultCenter = { lat: -6.5888, lng: 106.8062 }; // sekitar Bogor

                var map = new google.maps.Map(el, {
                    center: defaultCenter,
                    zoom: 11,
                    mapTypeControl: true,
                    streetViewControl: false,
                    fullscreenControl: true
                });

                if (!points.length) {
                    console.log('OngoingMapWidget: no points, only default map');
                    return;
                }

                var bounds = new google.maps.LatLngBounds();

                points.forEach(function (p) {
                    if (!p.lat || !p.lng) return;

                    var position = { lat: Number(p.lat), lng: Number(p.lng) };

                    var marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: p.name || 'Proyek'
                    });

                    var content =
                        '<div style="max-width: 220px">' +
                            '<strong>' + (p.name || 'Proyek') + '</strong><br>' +
                            '<small>' + (p.address || '') + '</small>' +
                        '</div>';

                    var infoWindow = new google.maps.InfoWindow({
                        content: content
                    });

                    marker.addListener('click', function () {
                        infoWindow.open(map, marker);
                    });

                    bounds.extend(position);
                });

                if (!bounds.isEmpty()) {
                    map.fitBounds(bounds, { padding: 30 });
                }
            });
        }

        window.addEventListener('load', initOngoingMap);
        document.addEventListener('livewire:navigated', function () {
            // reset supaya bisa init ulang setelah navigate
            var el = document.getElementById('ongoing-map');
            if (el) {
                el.dataset.initialized = '';
            }
            initOngoingMap();
        });
    })();
</script>
