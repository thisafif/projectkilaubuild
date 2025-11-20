<?php

namespace App\Filament\Widgets;

use App\Models\Ongoing;
use Filament\Widgets\Widget;

class OngoingMapWidget extends Widget
{
    protected string $view = 'filament.widgets.ongoing-map-widget';

    protected static ?int $sort = -1;

    public function getViewData(): array
    {
        $locations = Ongoing::query()
            ->whereNotNull('location->lat')
            ->whereNotNull('location->lng')
            ->get(['id', 'client_name', 'location']);

        $points = $locations->map(fn ($item) => [
            'id' => $item->id,
            'name' => $item->client_name,
            'lat' => data_get($item->location, 'lat'),
            'lng' => data_get($item->location, 'lng'),
            'address' => data_get($item->location, 'formatted_address', ''),
        ])->filter(fn ($p) => $p['lat'] && $p['lng'])->values();

        return [
            'points' => $points,
        ];
    }
}
