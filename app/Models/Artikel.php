<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'penulis',
        'tanggal_publikasi',
        'attachmentartikel',
        'user_id'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_publikasi' => 'date',
        ];
    }

        public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
