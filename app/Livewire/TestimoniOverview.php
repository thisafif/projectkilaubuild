<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class TestimoniOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            // Stat 1
            Stat::make('Total Testimoni', \App\Models\Testimoni::count())
                ->description('Total semua review')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->color('success'), 

            // Stat 2
            Stat::make('Rata-rata Rating', number_format(\App\Models\Testimoni::avg('rating'), 1))
                ->description('Dari skala 5.0')
                ->color('info'),
        ];
    }
}
