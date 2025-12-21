<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ongoing extends Model
{
    protected $fillable = [
        'client_name',
        'status',
        'progress_percentage',
        'summary_location',
        'images',
        'description',
        'start_date',
        'expected_end_date',
        'budget',
        'pic_name',
        'pic_phone',
        'vendors',
        'project_address',
        'location',
        'user_id'
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'location' => 'array',
            'start_date' => 'date',
            'expected_end_date' => 'date',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
