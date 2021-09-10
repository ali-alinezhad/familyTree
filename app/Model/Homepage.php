<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    protected $table = 'homepage';

    protected $fillable = [
        'header_title',
        'header_des',
        'about_us_title',
        'about_us_des',
        'logo',
        'music',
    ];

    protected $attributes = [
        'header_title' => ['Family Tree']
    ];
}
