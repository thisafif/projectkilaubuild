<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class OngoingProyek extends Component
{
    public $tipeProyek = ''; 
    public $tahun = ''; 
    public $lokasi = '';

    public function mount()
    {
    
    }

    public function render()
    {
        $query = DB::table('ongoingproyeks');

        if ($this->tipeProyek) {
            $query->where('tipe', $this->tipeProyek); 
        }
        
        if ($this->tahun) { 
            $query->whereYear('tanggal_proyek', $this->tahun); 
        }

        if ($this->lokasi) { 
            $query->where('provinsi_proyek', 'like', '%' . $this->lokasi . '%'); 
        }

        $ongoingproyek = $query->latest('tanggal_proyek')->get();

        $daftarProvinsi = DB::table('indonesia_provinces')
                            ->orderBy('name', 'asc')
                            ->get();

        return view('livewire.ongoing-proyek', [
            'ongoingproyeks' => $ongoingproyek,
            'daftarProvinsi' => $daftarProvinsi,
        ]);
    }
}