<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'hash',
        'role',
        'company',
        'when',
        'what',
        'stack',
        'sort_order',
    ];

    protected $casts = [
        'what' => 'array',
        'stack' => 'array',
        'sort_order' => 'integer',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
