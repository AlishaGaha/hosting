<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Plan;
use App\Http\Requests\Client\AddClientRequest;
use App\Http\Requests\Client\EditClientRequest;
use Carbon\Carbon;
use App\Jobs\SendEmailUserJob;

class ClientController extends Controller
{
    protected $model;

    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    public function index(Request $request)
    {
        $filters = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'contact_number' => $request->get('contact_number'),
            'service_type' => $request->get('service_type'),
            'domain_name' => $request->get('domain_name'),
            'domain_renewal_type' => $request->get('domain_renewal_type'),
            'domain_renewal' => $request->get('domain_renewal'),
            'plan' => $request->get('plan'),
            'hosting_renewal_type' => $request->get('hosting_renewal_type'),
            'hosting_renewal' => $request->get('hosting_renewal'),
            'expiry_date' => $request->get('expiry_date')
        ];
        $serviceType = $this->model::SERVICE_TYPE;
        $renewalType = $this->model::RENEWAL_TYPE;
        $plans = Plan::select('id', 'slug', 'title')->where('status', 1)->get();
        $clients = $this->model->select([
            'clients.id',
            'clients.first_name',
            'clients.last_name',
            'clients.email',
            'clients.contact_number',
            'clients.address',
            'clients.service_type',
            'clients.domain_name',
            'clients.domain_renewal',
            'clients.domain_renewal_type',
            'clients.plan_id',
            'clients.hosting_renewal',
            'clients.hosting_renewal_type',
            'clients.annual_maintenance_cost_type',
            'clients.annual_maintenance_cost',
            'plans.title'
        ])
            // ->with('plan:id,title')
            ->join('plans', 'clients.plan_id', '=', 'plans.id')
            ->when(isset($filters['name']), function($query) use ($filters) {
                $query->where('clients.first_name', 'like', '%'.$filters['name'].'%')
                    ->orWhere('clients.last_name', 'like', '%'.$filters['name'].'%');
            })
            ->when(isset($filters['email']), function($query) use ($filters) {
                $query->where('clients.email', 'like', '%'.$filters['email'].'%');
            })
            ->when(isset($filters['contact_number']), function($query) use ($filters) {
                $query->where('clients.contact_number', 'like', '%'.$filters['contact_number'].'%');
            })
            ->when(isset($filters['service_type']), function($query) use ($filters) {
                $query->where('clients.service_type', $filters['service_type']);
            })
            ->when(isset($filters['domain_renewal']), function($query) use ($filters) {
                $query->where('clients.domain_renewal', 'like', '%'.$filters['domain_renewal'].'%');
            })
            ->when(isset($filters['domain_renewal_type']), function($query) use ($filters) {
                $query->orWhere('clients.domain_renewal_type', $filters['domain_renewal_type']);
            })
            ->when(isset($filters['hosting_renewal']), function($query) use ($filters) {
                $query->where('clients.hosting_renewal', 'like', '%'.$filters['hosting_renewal'].'%');
            })
            ->when(isset($filters['hosting_renewal_type']), function($query) use ($filters) {
                $query->orWhere('clients.hosting_renewal_type', $filters['hosting_renewal_type']);
            })
            ->when(isset($filters['plan']), function($query) use ($filters) {
                $query->where('plans.id', '=', $filters['plan']);
            })
            ->orderBy('clients.created_at', 'DESC')
            ->paginate(10);
        return view('clients.index', compact(
            'clients',
            'filters',
            'plans',
            'serviceType',
            'renewalType'
        ));
    }
    public function create()
    {
        $serviceType = $this->model::SERVICE_TYPE;
        $renewalType = $this->model::RENEWAL_TYPE;
        $annualMaintenanceCostType = $this->model::ANNUAL_MAINTENACE_COST_TYPE;
        $plans = Plan::select('id', 'slug', 'title')->where('status', 1)->get();
        return view('clients.create', compact(
            'serviceType',
            'renewalType',
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
