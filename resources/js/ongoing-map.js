// Fungsi untuk initialize Google Maps
function initOngoingMaps() {
    const mapContainers = document.querySelectorAll('[id^="ongoing-map-"]');
    
    mapContainers.forEach(container => {
        // Skip jika sudah di-init
        if (container.dataset.mapInitialized === 'true') {
            return;
        }

        const pointsData = container.dataset.mapPoints;
        if (!pointsData) return;

        let points = [];
        try {
            points = JSON.parse(pointsData);
        } catch (e) {
            console.error('Failed to parse map points:', e);
            return;
        }

        if (points.length === 0) return;

        // Buat map
        const map = new google.maps.Map(container, {
            zoom: 11,
            center: { lat: points[0].lat, lng: points[0].lng },
            mapTypeControl: true,
            streetViewControl: false,
        });

        // Buat bounds untuk auto-fit semua marker
        const bounds = new google.maps.LatLngBounds();

        // Tambahkan marker untuk setiap point
        points.forEach(point => {
            const position = { lat: parseFloat(point.lat), lng: parseFloat(point.lng) };
            
            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: point.name,
            });

            bounds.extend(position);

            // InfoWindow untuk popup
            const infoContent = `
                <div style="padding: 8px; max-width: 250px;">
                    <h4 style="margin: 0 0 4px 0; font-weight: 600; font-size: 14px;">
                        ${point.name}
                    </h4>
                    ${point.address ? `
                        <p style="margin: 0; font-size: 12px; color: #666;">
                            ${point.address}
                        </p>
                    ` : ''}
                </div>
            `;

            const infoWindow = new google.maps.InfoWindow({
                content: infoContent,
            });

            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });
        });

        // Fit map ke semua marker
        if (points.length > 1) {
            map.fitBounds(bounds);
        }

        // Mark sebagai sudah di-init
        container.dataset.mapInitialized = 'true';
    });
}

// Load Google Maps API
function loadGoogleMapsAPI(apiKey) {
    return new Promise((resolve, reject) => {
        // Cek apakah sudah loaded
        if (window.google && window.google.maps) {
            resolve();
            return;
        }

        // Cek apakah sedang loading
        if (window.googleMapsLoading) {
            // Wait for existing load
            const checkLoaded = setInterval(() => {
                if (window.google && window.google.maps) {
                    clearInterval(checkLoaded);
                    resolve();
                }
            }, 100);
            return;
        }

        window.googleMapsLoading = true;

        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}`;
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

// Export untuk digunakan di render hook
window.initOngoingMaps = initOngoingMaps;
window.loadGoogleMapsAPI = loadGoogleMapsAPI;