<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Artikel extends Component
{
    public $search = '';

    public function render()
    {
        $artikels = collect([
            [
                'judul' => 'Lorem Ipsum',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'gambar' => 'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?auto=format&fit=crop&w=800&q=60'
            ],
            [
                'judul' => 'Dolor Sit Amet',
                'deskripsi' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'gambar' => 'https://images.unsplash.com/photo-1522205408450-add114ad53fe?auto=format&fit=crop&w=800&q=60'
            ],
            [
                'judul' => 'Consectetur Adipiscing',
                'deskripsi' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.',
                'gambar' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=800&q=60'
            ],
        ])->filter(fn($item) => str_contains(strtolower($item['judul']), strtolower($this->search)));

        return view('livewire.artikel', [
            'artikels' => $artikels
        ]);
    }
}
