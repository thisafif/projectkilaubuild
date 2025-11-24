<?php

namespace App\Filament\Resources\ArtikelResource\Pages;

use App\Filament\Resources\ArtikelResource;
use App\Filament\Resources\ArtikelResource\Widgets\ArtikelStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListArtikels extends ListRecords
{
    protected static string $resource = ArtikelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua'),

            'recent' => Tab::make('Terbaru')
                ->modifyQueryUsing(fn(Builder $query) => $query->latest('tanggal_publikasi')),

            'oldest' => Tab::make('Terlama')
                ->modifyQueryUsing(fn(Builder $query) => $query->oldest('tanggal_publikasi')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ArtikelStatsWidget::class,
        ];
    }
}
