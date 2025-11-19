@php
    $statePath = $getStatePath();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="gmapLocationField({
            state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$statePath}')") }},
        })"
        x-init="init()"
        class="space-y-3"
    >
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end border-b pb-2">
            <div class="flex-1">
                <input
                    x-ref="searchInput"
                    type="text"
                    placeholder="Cari alamat, nama jalan, atau tempat..."
                    style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;"
                    @focus="$el.style.outline = 'none'; $el.style.borderColor = '#3b82f6'; $el.style.boxShadow = '0 0 0 2px rgba(59, 130, 246, 0.1)';"
                    @blur="$el.style.borderColor = '#d1d5db'; $el.style.boxShadow = 'none';"
                />
            </div>
            <br>
        </div>

        {{-- peta --}}
        <div
            x-ref="map"
            class="w-full rounded-lg border border-gray-200 overflow-hidden p-3"
            style="height: 320px; min-height: 320px;"
            wire:ignore
        ></div>

        <br>

                    <div class="sm:w-auto w-full border-b pb-2">
                <x-filament::button
                    type="button"
                    color="gray"
                    outlined
                    class="w-full sm:w-auto"
                    @click="useGeolocation()"
                >
                    Gunakan lokasi saya
                </x-filament::button>
            </div>

            <br>

        {{-- alamat terpilih --}}
        <template x-if="state && state.formatted_address">
            <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-xs font-semibold text-blue-900">
                    Alamat yang dipilih
                </p>
                <p class="text-sm text-blue-800 mt-1" x-text="state.formatted_address"></p>
            </div>
        </template>
    </div>
</x-dynamic-component>

@assets
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.key') }}&libraries=places"></script>

    <script>
        // JS-mu tadi tetap sama persis, nggak perlu diubah
        function gmapLocationField(config) {
            return {
                state: config.state,
                defaultLocation: {
                    lat: -6.444968849424258,
                    lng: 106.80404899634287,
                    formatted_address: null,
                },
                map: null,
                marker: null,
                init() {
                    if (!window.google || !window.google.maps) {
                        const interval = setInterval(() => {
                            if (window.google && window.google.maps) {
                                clearInterval(interval);
                                this.initMap();
                            }
                        }, 200);
                    } else {
                        this.initMap();
                    }
                },
                getCurrentPosition() {
                    if (this.state && this.state.lat && this.state.lng) {
                        return {
                            lat: Number(this.state.lat),
                            lng: Number(this.state.lng),
                        };
                    }
                    return this.defaultLocation;
                },
                initMap() {
                    const center = this.getCurrentPosition();

                    this.map = new google.maps.Map(this.$refs.map, {
                        center,
                        zoom: 16,
                        fullscreenControl: true,
                        streetViewControl: true,
                        rotateControl: true,
                        scaleControl: true,
                        mapTypeControl: false,
                        clickableIcons: true,
                    });

                    this.marker = new google.maps.Marker({
                        position: center,
                        map: this.map,
                        draggable: true,
                    });

                    this.map.addListener('click', (event) => {
                        this.setPosition(event.latLng);
                    });

                    this.marker.addListener('dragend', (event) => {
                        this.setPosition(event.latLng);
                    });

                    const autocomplete = new google.maps.places.Autocomplete(
                        this.$refs.searchInput,
                        { fields: ['geometry', 'formatted_address'] },
                    );

                    autocomplete.addListener('place_changed', () => {
                        const place = autocomplete.getPlace();
                        if (!place.geometry || !place.geometry.location) return;

                        this.map.panTo(place.geometry.location);
                        this.map.setZoom(17);
                        this.setPosition(place.geometry.location, place.formatted_address);
                    });
                },
                setPosition(latLng, formattedAddress = null) {
                    const lat = latLng.lat();
                    const lng = latLng.lng();

                    this.marker.setPosition(latLng);

                    if (!formattedAddress) {
                        const geocoder = new google.maps.Geocoder();
                        geocoder.geocode({ location: latLng }, (results, status) => {
                            if (status === 'OK' && results[0]) {
                                formattedAddress = results[0].formatted_address;
                            }
                            this.updateState(lat, lng, formattedAddress);
                        });
                    } else {
                        this.updateState(lat, lng, formattedAddress);
                    }
                },
                updateState(lat, lng, formattedAddress) {
                    this.state = {
                        ...(this.state || {}),
                        lat,
                        lng,
                        formatted_address: formattedAddress ?? null,
                    };

                    window.dispatchEvent(new CustomEvent('location-changed', {
                        detail: { lat, lng, formatted_address: formattedAddress },
                    }));
                },
                useGeolocation() {
                    if (!navigator.geolocation) return;

                    navigator.geolocation.getCurrentPosition((position) => {
                        const latLng = new google.maps.LatLng(
                            position.coords.latitude,
                            position.coords.longitude,
                        );
                        this.map.panTo(latLng);
                        this.map.setZoom(17);
                        this.setPosition(latLng);
                    });
                },
            };
        }
    </script>
@endassets
