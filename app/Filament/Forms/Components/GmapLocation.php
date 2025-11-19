<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class GmapLocation extends Field
{
    protected string $view = 'filament.forms.components.gmap-location';

    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function (GmapLocation $component, $state) {
            if (is_string($state)) {
                $state = json_decode($state, true);
            }

            $component->state($state ?? [
                'lat' => -6.444968849424258,
                'lng' => 106.80404899634287,
                'formatted_address' => null,
            ]);
        });

        $this->dehydrateStateUsing(function ($state) {
            if (is_array($state)) {
                return $state;
            }

            return json_decode($state, true);
        });
    }
}
