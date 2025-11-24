<?php

namespace App\Livewire;

use App\Models\Konsultasi;
use App\Models\Ongoing;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Konsultasi', Konsultasi::count())
                ->description('Semua konsultasi')
                ->descriptionIcon('heroicon-m-chat-bubble-oval-left-ellipsis')
                ->color('primary'),

            Stat::make('Proyek Ongoing', Ongoing::where('status', '!=', 'done')->count())
                ->description('Sedang berjalan')
                ->descriptionIcon('heroicon-m-cog-6-tooth')
                ->color('warning'),

            Stat::make('Proyek Selesai', Ongoing::where('status', 'done')->count())
                ->description('Completed projects')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
