<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;

class HostingRenewal extends Model
{
    protected $table = 'hosting_renewals';
    protected $fillable = [
        'title',
        'slug',
        'status'
    ];

    public function clients()
    {
        return $this->belongsTo(Client::class, 'hosting_renewal_id', 'id');
    }
}
