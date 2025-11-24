<?php

namespace App\Filament\Widgets;

use App\Models\Ongoing;
use Filament\Widgets\Widget;

class OngoingMapWidget extends Widget
{
    protected string $view = 'filament.widgets.ongoing-map-widget';

    protected static ?int $sort = -1;

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        $locations = Ongoing::query()
            ->whereNotNull('location->lat')
            ->whereNotNull('location->lng')
            ->get(['id', 'client_name', 'location', 'status', 'progress_percentage']);

        $points = $locations->map(fn ($item) => [
            'id' => $item->id,
            'name' => $item->client_name,
            'lat' => data_get($item->location, 'lat'),
            'lng' => data_get($item->location, 'lng'),
            'address' => data_get($item->location, 'formatted_address', ''),
            'status' => $item->status,
            'progress' => $item->progress,
        ])->filter(fn ($p) => $p['lat'] && $p['lng'])->values();

        return [
            'points' => $points,
        ];
    }
}
