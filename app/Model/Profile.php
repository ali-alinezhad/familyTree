<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = [
        'user_id',
        'birthday',
        'birthday_place',
        'residence_place',
        'education',
        'job_title',
        'job_place' ,
        'father_name',
        'mother_name',
        'spouse_name',
        'marriage_date',
        'marriage_place',
        'children_number',
        'titles',
        'telephone',
        'email',
        'picture',
        'about_me',
        'death_date',
        'death_place',
        'burial_place',
    ];

    protected $casts = [
        'birthday' => 'datetime:Y-m-d',
    ];
}
