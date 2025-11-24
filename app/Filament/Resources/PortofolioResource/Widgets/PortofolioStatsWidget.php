<?php

namespace App\Filament\Resources\PortofolioResource\Widgets;

use App\Models\Portofolio;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortofolioStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = null;

    protected function getStats(): array
    {
        $totalPortofolio = Portofolio::count();
        $recentMonth = Portofolio::whereDate('tanggal_proyek', '>=', now()->subDays(30))->count();
        $recentYear = Portofolio::whereDate('tanggal_proyek', '>=', now()->subDays(365))->count();

        return [
            Stat::make('Total Portofolio', $totalPortofolio)
                ->description('Semua proyek portofolio')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->color('success'),

            // Stat::make('Portofolio Bulan Ini', $recentMonth)
            //     ->description('Dalam 30 hari terakhir')
            //     ->color('primary'),

            Stat::make('Portofolio Tahun Ini', $recentYear)
                ->description('Dalam 365 hari terakhir')
                ->color('warning'),
        ];
    }
}
