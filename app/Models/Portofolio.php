<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'tipe',
        'tanggal_proyek',
        'attachmentportofolio',
        'user_id'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_proyek' => 'date',
        ];
    }

        public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
