<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'slug',
        'hint',
        'status'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
