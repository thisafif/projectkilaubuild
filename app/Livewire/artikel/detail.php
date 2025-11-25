<?php

namespace App\Livewire\Artikel;

use App\Models\Artikel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Detail extends Component
{
    public Artikel $artikel;

    public function mount($slug)
    {
        $dataAsli = Artikel::where('slug', $slug)->first();

        // 2. Cek kondisinya
        if ($dataAsli) {
            $this->artikel = $dataAsli;
        } else {
            $dummy = new Artikel();
            $dummy->judul = "Contoh Judul: " . str_replace('-', ' ', $slug);
            $dummy->isi = "<p>Ini adalah contoh isi artikel karena data asli tidak ditemukan di database. Yang penting tampilannya bener dulu kan?</p><p>Lorem ipsum dolor sit amet.</p>";
            $dummy->penulis = "Admin";
            $dummy->tanggal_publikasi = now(); 
            $dummy->attachmentartikel = null; 
            
            $this->artikel = $dummy;
        }
    }

    public function render()
    {
        return view('livewire.artikel.detail');
    }
}