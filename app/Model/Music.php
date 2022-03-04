<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $table = 'music';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'file',
        'status',
    ];
}
