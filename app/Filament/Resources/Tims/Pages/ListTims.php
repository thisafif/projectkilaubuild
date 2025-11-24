<?php

namespace App\Filament\Resources\Tims\Pages;

use App\Filament\Resources\Tims\TimResource;
use App\Filament\Resources\Tims\Widgets\TimStatsWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTims extends ListRecords
{
    protected static string $resource = TimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua'),

            'by_name' => Tab::make('Nama A-Z')
                ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('nama_lengkap')),

            'by_position' => Tab::make('Berdasarkan Posisi')
                ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('posisi')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TimStatsWidget::class,
        ];
    }
}
