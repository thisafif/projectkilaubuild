<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'tipe',
        'tanggal_proyek',
        'url_gambar',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_proyek' => 'date',
        ];
    }
}
