<?php

namespace App\Filament\Resources\PortofolioResource\Pages;

use App\Filament\Resources\PortofolioResource;
use App\Filament\Resources\PortofolioResource\Widgets\PortofolioStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPortofolios extends ListRecords
{
    protected static string $resource = PortofolioResource::class;

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
                ->modifyQueryUsing(fn(Builder $query) => $query->latest('tanggal_proyek')),

            'oldest' => Tab::make('Terlama')
                ->modifyQueryUsing(fn(Builder $query) => $query->oldest('tanggal_proyek')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PortofolioStatsWidget::class,
        ];
    }
}
