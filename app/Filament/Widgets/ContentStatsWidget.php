<?php

namespace App\Filament\Widgets;

use App\Models\Artikel;
use App\Models\Portofolio;
use App\Models\Testimoni;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentStatsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Artikel', Artikel::count())
                ->description('Articles published')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),

            Stat::make('Total Portofolio', Portofolio::count())
                ->description('Portfolio items')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success'),

            Stat::make('Total Testimoni', Testimoni::count())
                ->description('Client testimonials')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
}
