<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Plan;
use App\Http\Requests\Client\AddClientRequest;
use App\Http\Requests\Client\EditClientRequest;
use Carbon\Carbon;

class ClientController extends Controller
{
    protected $model;

    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    public function index()
    {
        // $domainRenewal = $this->model::DOMAIN_RENEWAL;
        // $hostingRenewal = $this->model::HOSTING_RENEWAL;
        // $annualMaintenanceCostType = $this->model::ANNUAL_MAINTENACE_COST_TYPE;
        $clients = $this->model->select([
            'id',
            'first_name',
            'last_name',
            'email',
            'contact_number',
            'address',
            'service_type',
            'domain_name',
            'domain_renewal',
            'domain_renewal_type',
            'plan_id',
            'hosting_renewal',
            'hosting_renewal_type',
            'annual_maintenance_cost_type',
            'annual_maintenance_cost'
        ])
            ->with('plan:id,title')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('clients.index', compact(
            // 'domainRenewal',
            // 'hostingRenewal',
            // 'annualMaintenanceCostType',
            'clients'
        ));
    }
    public function create()
    {
        $serviceType = $this->model::SERVICE_TYPE;
        $renewalType = $this->model::RENEWAL_TYPE;
        $domainRenewal = $this->model::DOMAIN_RENEWAL;
        $hostingRenewal = $this->model::HOSTING_RENEWAL;
        $annualMaintenanceCostType = $this->model::ANNUAL_MAINTENACE_COST_TYPE;
        $plans = Plan::select('id', 'slug', 'title')->where('status', 1)->get();
        return view('clients.create', compact(
            'serviceType',
            'renewalType',
            'domainRenewal',
            'hostingRenewal',
            'annualMaintenanceCostType',
            'plans'
        ));
    }

    public function store(AddClientRequest $addClientRequest)
    {
        $validatedData = $addClientRequest->validated();
        $this->model->create($validatedData);
        return redirect()->route('clients.index')->with('success', 'Client added successfully!');
    }
    public function edit($id)
    {
        $client = $this->model->findOrFail($id);
        if(!$client) {
            return redirect()->back()->with('danger', 'Invalid Request!');
        }
        $serviceType = $this->model::SERVICE_TYPE;
        $renewalType = $this->model::RENEWAL_TYPE;
        $annualMaintenanceCostType = $this->model::ANNUAL_MAINTENACE_COST_TYPE;
        $plans = Plan::select('id', 'slug', 'title')->where('status', 1)->get();
        return view('clients.edit', compact(
            'serviceType',
            'renewalType',
            'annualMaintenanceCostType',
            'plans',
            'client'
        ));
    }
    public function update(EditClientRequest $editClientRequest, $id)
    {
        $client = $this->model->findOrFail($id);
        if(!$client) {
            return redirect()->back()->with('danger', 'Invalid Request!');
        }
        $validatedData = $editClientRequest->validated();
        $client->update($validatedData);
        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }
}
