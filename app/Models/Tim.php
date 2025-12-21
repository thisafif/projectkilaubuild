<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tim extends Model
{
    use HasFactory;

    protected $fillable = [
        'indeks',
        'nama_lengkap',
        'linkedin',
        'posisi',
        'attechment_tim',
        'user_id'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
