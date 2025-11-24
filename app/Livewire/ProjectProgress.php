<?php

namespace App\Livewire;

use App\Models\Ongoing;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ProjectProgress extends ChartWidget
{
    protected static ?string $heading = 'Progress Proyek';

    protected function getData(): array
    {
        $projectsByStatus = Ongoing::query()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');

        $projectsByType = Ongoing::query()
            ->selectRaw('tipe, COUNT(*) as count')
            ->groupBy('tipe')
            ->get()
            ->pluck('count', 'tipe');

        return [
            'datasets' => [
                [
                    'label' => 'Proyek by Status',
                    'data' => [
                        $projectsByStatus->get('consultation', 0),
                        $projectsByStatus->get('planning', 0),
                        $projectsByStatus->get('in_progress', 0),
                        $projectsByStatus->get('done', 0),
                    ],
                    'backgroundColor' => ['#f59e0b', '#3b82f6', '#8b5cf6', '#10b981'],
                ],
            ],
            'labels' => ['Konsultasi', 'Perencanaan', 'Dalam Progres', 'Selesai'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
