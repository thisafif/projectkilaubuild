<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Portofolio;

class DetailPorto extends Component
{
    public Portofolio $portofolio;
    public $portoLain; 

    public function mount($id)
    {
        $dataAsli = Portofolio::find($id);

        if ($dataAsli) {
            $this->portofolio = $dataAsli;
        } else {
            $dummy = new Portofolio();
            $dummy->id = 0; 
            $dummy->judul = "Contoh Judul (ID $id tidak ditemukan)";
            $dummy->isi = "<p>Ini adalah contoh isi portofolio karena data asli tidak ditemukan.</p>";
            $dummy->attachmentporto = null;

            $this->portofolio = $dummy;
        }

        $this->portoLain = Portofolio::where('id', '!=', $id)
                                    ->latest() 
                                    ->take(5)  
                                    ->get();
    }
    
    public function render()
    {
        return view('livewire.detail-porto')
        ->title($this->portofolio->judul);
    }
}