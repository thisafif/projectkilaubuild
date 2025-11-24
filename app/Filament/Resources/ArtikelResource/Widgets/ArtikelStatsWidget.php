<?php

namespace App\Filament\Resources\ArtikelResource\Widgets;

use App\Models\Artikel;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ArtikelStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = null;

    protected function getStats(): array
    {
        $totalArtikel = Artikel::count();
        $recentMonth = Artikel::where('tanggal_publikasi', '>=', now()->subMonth())->count();
        $recentYear = Artikel::where('tanggal_publikasi', '>=', now()->subYear())->count();

        return [
            Stat::make('Total Artikel', $totalArtikel)
                ->description('Semua artikel')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->color('info'),

            Stat::make('Artikel Bulan Ini', $recentMonth)
                ->description('Dalam 30 hari terakhir')
                ->color('primary'),

            Stat::make('Artikel Tahun Ini', $recentYear)
                ->description('Dalam 365 hari terakhir')
                ->color('success'),
        ];
    }
}
