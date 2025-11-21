<?php

namespace App\Providers\Filament;

use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->id('admin')
            ->path('admin')
            ->login()
            ->darkMode(false)
            ->defaultThemeMode(ThemeMode::Light)
            ->colors([
                'primary' => Color::hex('#0066AE'),
                'gray' => Color::Slate,
            ])
            ->font('Poppins')
            ->brandLogo(fn () => view('filament.admin.logo'))
            ->brandLogoHeight('3rem')
            ->profile(isSimple: false)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->spa();
    }

    public function boot(): void
    {
        FilamentView::registerRenderHook(
            'panels::body.end',
            fn (): string => Blade::render(<<<'BLADE'
                @once
                <script>
                    (function() {
                        const GOOGLE_MAPS_API_KEY = '{{ config("services.google.maps.key") }}';

                        // Load Google Maps API
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

                        // Initialize maps
                        function initOngoingMaps() {
                            const containers = document.querySelectorAll('[id^="ongoing-map-"]');
                            if (containers.length === 0) return;

                            containers.forEach(container => {
                                if (container.dataset.mapInitialized === 'true' || container.offsetParent === null) return;

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

                                setTimeout(() => {
                                    const map = new google.maps.Map(container, {
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
                                            map,
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
                                                ${point.progress ? `<p style="margin: 4px 0; font-size: 13px; color: #555;">Progress: <strong>${point.progress}%</strong></p>` : ''}
                                                ${point.address ? `<p style="margin: 4px 0; font-size: 12px; color: #666;">📍 ${point.address}</p>` : ''}
                                            </div>
                                        `;

                                        const infoWindow = new google.maps.InfoWindow({ content: infoContent });
                                        marker.addListener('click', () => infoWindow.open(map, marker));
                                    });

                                    if (points.length > 1) {
                                        map.fitBounds(bounds);
                                    } else if (points.length === 1) {
                                        map.setZoom(14);
                                    }

                                    container.dataset.mapInitialized = 'true';
                                }, 100);
                            });
                        }

                        function initMaps() {
                            if (document.querySelector('[id^="ongoing-map-"]')) {
                                loadGoogleMaps()
                                    .then(() => initOngoingMaps())
                                    .catch(err => console.error('Maps error:', err));
                            }
                        }

                        if (document.readyState === 'loading') {
                            document.addEventListener('DOMContentLoaded', initMaps);
                        } else {
                            initMaps();
                        }

                        document.addEventListener('livewire:navigated', () => {
                            setTimeout(initMaps, 100);
                        });

                        if (typeof Livewire !== 'undefined') {
                            Livewire.hook('morph.updated', () => {
                                setTimeout(initMaps, 150);
                            });
                        }

                        const observer = new MutationObserver((mutations) => {
                            for (const mutation of mutations) {
                                if (mutation.addedNodes.length) {
                                    const hasMapContainer = Array.from(mutation.addedNodes).some(node => {
                                        return node.nodeType === 1 && (
                                            node.id?.startsWith('ongoing-map-') ||
                                            node.querySelector?.('[id^="ongoing-map-"]')
                                        );
                                    });
                                    if (hasMapContainer) {
                                        setTimeout(initMaps, 200);
                                        break;
                                    }
                                }
                            }
                        });
                        observer.observe(document.body, { childList: true, subtree: true });
                    })();
                </script>
                @endonce
            BLADE)
        );
    }
}
