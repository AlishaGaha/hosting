<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Plan;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'address',
        'domain_name',
        'expiry_date',
        'domain_renewal',
        'plan_id',
        'hosting_renewal',
        'annual_maintenance_cost_type',
        'annual_maintenance_cost'
    ];

    const DOMAIN_RENEWAL = ['auto', '2 years', '5 years'];
    const HOSTING_RENEWAL = ['auto', '2 years', '5 years'];
    const ANNUAL_MAINTENACE_COST_TYPE = ['p', 'f'];
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }
}
