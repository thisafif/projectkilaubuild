<?php

namespace App\Livewire;

use Livewire\Component;

class Ongoing extends Component
{
    public $tipeProyek;
    public $tahun;

    public function render()
    {
        $ongoings = [
            [
                'judul' => 'Lorem Ipsum',
                'deskripsi_singkat' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime deleniti et tempore.',
                'url_gambar' => 'https://via.placeholder.com/400x300?text=Proyek+1'
            ],
            [
                'judul' => 'Lorem Ipsum',
                'deskripsi_singkat' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime deleniti et tempore.',
                'url_gambar' => 'https://via.placeholder.com/400x300?text=Proyek+2'
            ],
            [
                'judul' => 'Lorem Ipsum',
                'deskripsi_singkat' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime deleniti et tempore.',
                'url_gambar' => 'https://via.placeholder.com/400x300?text=Proyek+3'
            ],
            [
                'judul' => 'Lorem Ipsum',
                'deskripsi_singkat' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime deleniti et tempore.',
                'url_gambar' => 'https://via.placeholder.com/400x300?text=Proyek+4'
            ],
            [
                'judul' => 'Lorem Ipsum',
                'deskripsi_singkat' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime deleniti et tempore.',
                'url_gambar' => 'https://via.placeholder.com/400x300?text=Proyek+5'
            ],
            [
                'judul' => 'Lorem Ipsum',
                'deskripsi_singkat' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime deleniti et tempore.',
                'url_gambar' => 'https://via.placeholder.com/400x300?text=Proyek+6'
            ],
        ];

        return view('livewire.proyeks', [
            'ongoings' => $ongoings,
        ]);

    }

}