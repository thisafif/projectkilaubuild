<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
