<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SearchingPorto extends Component
{
    public $tipeProyek = ''; 
    public $tahun = ''; 

    public function mount()
    {
    
    }

    public function render()
    {
        $query = DB::table('portofolios');

        if ($this->tipeProyek) {
            $query->where('tipe', $this->tipeProyek); 
        }

        
        if ($this->tahun) { 
            $query->whereYear('tanggal_proyek', $this->tahun); 
        }

        $portofolios = $query->latest('tanggal_proyek')->get();

        return view('livewire.searching-porto', [
            'portofolios' => $portofolios
        ]);
    }
}