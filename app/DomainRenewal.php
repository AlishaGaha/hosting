<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;

class DomainRenewal extends Model
{
    protected $table = 'domain_renewals';
    protected $fillable = [
        'title',
        'slug',
        'status'
    ];

    // public function clients()
    // {
    //     return $this->belongsTo(Client::class, 'domain_renewal_id', 'id');
    // }
}
