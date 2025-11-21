<?php

namespace App\Filament\Resources\OngoingResource\Pages;

use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\OngoingMapWidget;
use App\Filament\Resources\OngoingResource;

class ListOngoings extends ListRecords
{
    protected static string $resource = OngoingResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            OngoingMapWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
