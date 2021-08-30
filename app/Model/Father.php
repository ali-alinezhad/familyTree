<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    protected $table = 'fathers';

    protected $fillable = [
        'user_id',
        'father_id',
    ];
}
