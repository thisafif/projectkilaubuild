<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimoni extends Model
{
    use HasFactory;

    protected $fillable = [
        'teks',
        'rating',
        'nama',
        'kegseharihari',
        'user_id'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
