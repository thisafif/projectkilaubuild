<?php

namespace App\Livewire;

use App\Models\JadwalKonsultasi;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class UpcomingSchedules extends Widget
{
    protected string $view = 'livewire.upcoming-schedules';

    public function render(): View
    {
        $schedules = JadwalKonsultasi::with('konsultasi')
            ->where('tanggal', '>=', now())
            ->orderBy('tanggal')
            ->limit(10)
            ->get();

        return view($this->view, [
            'schedules' => $schedules,
        ]);
    }
}
