<?php

namespace App\Livewire;

use App\Models\Konsultasi;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class RecentConsultations extends Widget
{
    protected string $view = 'livewire.recent-consultations';

    public function render(): View
    {
        $consultations = Konsultasi::with('jadwal')
            ->latest('created_at')
            ->limit(8)
            ->get();

        return view($this->view, [
            'consultations' => $consultations,
        ]);
    }
}
