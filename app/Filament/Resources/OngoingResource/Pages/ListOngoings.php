<?php

namespace App\Filament\Resources\OngoingResource\Pages;

use App\Filament\Resources\OngoingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOngoings extends ListRecords
{
    protected static string $resource = OngoingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
