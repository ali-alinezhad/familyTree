<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mother extends Model
{
    protected $table = 'mothers';

    protected $fillable = [
        'user_id',
        'mother_id',
    ];
}
