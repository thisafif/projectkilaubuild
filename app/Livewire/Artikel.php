<?php

namespace App\Livewire;

use App\Models\Artikel as ArtikelModel;
use Livewire\Component;

class Artikel extends Component
{
    public $search = '';

    public function render()
    {
        $query = ArtikelModel::query();

        if ($this->search) {
            $query->where('judul', 'like', "%{$this->search}%")
                ->orWhere('isi', 'like', "%{$this->search}%");
        }

        $artikels = $query->latest('tanggal_publikasi')->get();

        return view('livewire.artikel', [
            'artikels' => $artikels,
        ]);
    }
}
