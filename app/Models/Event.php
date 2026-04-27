<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'date', 'end_date',
        'location', 'address', 'image', 'registration_link',
        'is_free', 'status',
    ];

    protected $casts = [
        'date' => 'datetime',
        'end_date' => 'datetime',
        'is_free' => 'boolean',
    ];

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'scheduled')
            ->where('date', '>=', now())
            ->orderBy('date');
    }
}
