<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Plan;
use App\DomainRenewal;
use App\HostingRenewal;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'address',
        'service_type',
        'domain_name',
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
    public function domainRenewal()
    {
        return $this->belongsTo(DomainRenewal::class, 'domain_renewal_id', 'id');
    }
    public function hostingRenewal()
    {
        return $this->belongsTo(HostingRenewal::class, 'hosting_renewal_id', 'id');
    }
}
