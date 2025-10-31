<?php

namespace App\Filament\Resources\Testimonis\Pages;

use App\Filament\Resources\Testimonis\TestimoniResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Pages\Page;

class ViewTestimoni extends ViewRecord 
{
    protected static string $resource = TestimoniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];  
    }
}

