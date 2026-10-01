<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'lang',
        'color',
        'stars',
        'desc',
        'tags',
        'url',
        'sort_order',
    ];

    protected $casts = [
        'tags' => 'array',
        'stars' => 'integer',
        'sort_order' => 'integer',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
