<?php

namespace App\Filament\Resources\Tims\Widgets;

use App\Models\Tim;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TimStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = null;

    protected function getStats(): array
    {
        $totalTim = Tim::count();
        $timByRole = Tim::select('posisi')
            ->distinct()
            ->count();

        return [
            Stat::make('Total Anggota Tim', $totalTim)
                ->description('Semua anggota tim')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->color('primary'),

            // Stat::make('Jumlah Posisi', $timByRole)
            //     ->description('Unique roles dalam tim')
            //     ->color('info'),
        ];
    }
}
