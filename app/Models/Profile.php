<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user',
        'host',
        'path',
        'ascii',
        'neofetch_title_name',
        'neofetch_title_host',
        'neofetch_rows',
        'about_lead',
        'about_meta',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'neofetch_rows' => 'array',
        'about_meta' => 'array',
    ];
}
