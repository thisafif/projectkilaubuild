<?php

namespace App\Filament\Resources\TestimoniResource\Pages;

use Filament\Actions;
use App\Livewire\TestimoniOverview;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TestimoniResource;

class ListTestimonis extends ListRecords
{
    protected static string $resource = TestimoniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),

            '5_star' => Tab::make('Bintang 5')
                ->icon('heroicon-m-star')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('rating', 5)),

            '4_star' => Tab::make('Bintang 4')
                ->icon('heroicon-m-star')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('rating', 4)),

            'recent' => Tab::make('Terbaru')
                ->modifyQueryUsing(fn(Builder $query) => $query->latest()),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TestimoniOverview::class,
        ];
    }
}
