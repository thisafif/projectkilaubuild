<?php

namespace App\Livewire;

use App\Models\Portofolio;
use Livewire\Component;

class SearchingPorto extends Component
{
    public $jenisKonsultasi = '';

    public $tahun = '';

    public function render()
    {
        $query = Portofolio::query();

        if ($this->jenisKonsultasi) {
            $query->where('tipe', $this->jenisKonsultasi);
        }

        if ($this->tahun) {
            $query->whereYear('tanggal_proyek', $this->tahun);
        }

        $portofolios = $query->latest('tanggal_proyek')->get();

        return view('livewire.searching-porto', [
            'portofolios' => $portofolios,
        ]);
    }
}
