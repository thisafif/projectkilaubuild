@if(! app()->runningInConsole())
    <script>
        (function() {
            const apiKey = '{{ config('services.google.maps.key') }}';
            if (!apiKey) {
                console.warn('Google Maps API Key is missing in config/services.php');
                return;
            }

            if (window.google && window.google.maps) {
                return; // Already loaded
            }

            const script = document.createElement('script');
            script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places`;
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        })();

        document.addEventListener('alpine:init', () => {
            Alpine.data('ongoingMap', ({ points }) => ({
                map: null,
                markers: [],
                points: points,

                init() {
                    // Wait for Google Maps API to be available
                    const checkGoogleMaps = setInterval(() => {
                        if (window.google && window.google.maps) {
                            clearInterval(checkGoogleMaps);
                            this.initMap();
                        }
                    }, 100);
                },

                initMap() {
                    const mapEl = this.$refs.map;
                    if (!mapEl) return;

                    // Default center (Indonesia)
                    const defaultCenter = { lat: -0.7893, lng: 113.9213 }; 
                    
                    this.map = new google.maps.Map(mapEl, {
                        center: defaultCenter,
                        zoom: 5,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        streetViewControl: false,
                        mapTypeControl: false,
                    });

                    this.addMarkers();
                },

                addMarkers() {
                    if (!this.points || this.points.length === 0) return;

                    const bounds = new google.maps.LatLngBounds();
                    const infoWindow = new google.maps.InfoWindow();

                    this.points.forEach(point => {
                        if (!point.lat || !point.lng) return;

                        const position = { lat: parseFloat(point.lat), lng: parseFloat(point.lng) };
                        
                        const marker = new google.maps.Marker({
                            position: position,
                            map: this.map,
                            title: point.name,
                        });

                        const contentString = `
                            <div style="color: black; padding: 4px;">
                                <h3 style="font-weight: bold; margin-bottom: 4px;">${point.name}</h3>
                                <p style="font-size: 12px;">${point.address || ''}</p>
                            </div>
                        `;

                        marker.addListener("click", () => {
                            infoWindow.setContent(contentString);
                            infoWindow.open(this.map, marker);
                        });

                        bounds.extend(position);
                        this.markers.push(marker);
                    });

                    if (this.markers.length > 0) {
                        this.map.fitBounds(bounds);
                        // Adjust zoom if too close or single marker
                        const listener = google.maps.event.addListener(this.map, "idle", () => { 
                            if (this.map.getZoom() > 16) this.map.setZoom(16); 
                            google.maps.event.removeListener(listener); 
                        });
                    }
                }
            }));
        });
    </script>
@endif
