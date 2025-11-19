<?php

namespace App\Filament\Resources\OngoingResource\Pages;

use App\Filament\Resources\OngoingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOngoing extends EditRecord
{
    protected static string $resource = OngoingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
