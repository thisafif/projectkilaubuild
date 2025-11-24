<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\RecentConsultations;
use App\Filament\Widgets\ContentStatsWidget;
use App\Filament\Widgets\OngoingMapWidget;
use App\Filament\Widgets\KalenderKonsultasiWidget;
use App\Filament\Widgets\ProyekWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            OngoingMapWidget::class,
            StatsOverview::class,
            ContentStatsWidget::class,
            RecentConsultations::class,
            ProyekWidget::class,
            KalenderKonsultasiWidget::class,
        ];
    }
}
