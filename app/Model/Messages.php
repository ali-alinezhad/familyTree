<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'sender_user_id',
        'receiver_user_id',
        'subject',
        'description',
    ];
}
