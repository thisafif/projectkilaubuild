<?php

namespace App\Livewire;

use App\Models\Artikel;
use Livewire\Component;

class SearchingArtikel extends Component
{
    public $search = '';

    public function render()
    {
        $query = Artikel::query();

        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('isi', 'like', '%' . $this->search . '%');
        }

        $artikels = $query->latest('tanggal_publikasi')->get();

        return view('livewire.searching-artikel', [
            'artikels' => $artikels,
        ]);
    }
}
