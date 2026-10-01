<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillGroup extends Model
{
    protected $fillable = [
        'group',
        'sort_order',
        'items',
    ];

    protected $casts = [
        'items' => 'array',
        'sort_order' => 'integer',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
