<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Artikel;

class DetailArtikel extends Component
{
    public Artikel $artikel;
    public $artikelLain;

    public function mount($id)
    {
        $dataAsli = Artikel::find($id);

        if ($dataAsli) {
            $this->artikel = $dataAsli;
        } else {
            $dummy = new Artikel();
            $dummy->id = 0;
            $dummy->judul = "Contoh Judul (ID $id tidak ditemukan)";
            $dummy->isi = "<p>Ini adalah contoh isi artikel karena data asli tidak ditemukan.</p>";
            $dummy->penulis = "Admin";
            $dummy->created_at = now();
            $dummy->attachmentartikel = null;

            $this->artikel = $dummy;
        }

        $this->artikelLain = Artikel::where('id', '!=', $id)
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.detail-artikel')
            ->title($this->artikel->judul);
    }
}
