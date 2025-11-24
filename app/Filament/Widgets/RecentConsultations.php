<?php

namespace App\Filament\Widgets;

use App\Models\Konsultasi;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class RecentConsultations extends Widget
{
    protected string $view = 'filament.widgets.recent-consultations';
    protected static ?int $sort = 3;

    public function render(): View
    {
        $consultations = Konsultasi::with('jadwal')
            ->latest('created_at')
            ->get();

        return view($this->view, [
            'consultations' => $consultations,
        ]);
    }
}
