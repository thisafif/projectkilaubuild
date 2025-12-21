<?php

namespace App\Livewire;

use App\Models\Tim as TimModel;
use Livewire\Component;

class Tim extends Component
{
    public function render()
    {
        $tim = TimModel::orderBy('indeks')->get();

        return view('livewire.tim', [                   # Asosiasi dengan view tim
            'tim' => $tim,
        ]);
    }
}
