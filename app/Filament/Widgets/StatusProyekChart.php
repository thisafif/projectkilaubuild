<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class StatusProyekChart extends ChartWidget
{
    protected ?string $heading = 'Status Proyek Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
