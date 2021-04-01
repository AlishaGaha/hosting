<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;

class Plan extends Model
{
    protected $table = 'plans';
    protected $fillable = [
        'title',
        'slug',
        'cost',
        'status'
    ];

    public function clients()
    {
        return $this->belongsTo(Client::class, 'plan_id', 'id');
    }
}
