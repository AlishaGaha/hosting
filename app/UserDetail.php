<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'dob',
        'address',
        'contact',
        'profile_image',
        'status',
        'user_id'
    ];
}
