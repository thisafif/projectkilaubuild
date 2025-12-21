<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'user_id'
    ];

        public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


