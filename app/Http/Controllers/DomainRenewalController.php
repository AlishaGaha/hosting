<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DomainRenewal;
use App\Http\Requests\Hosting\AddDomainRenewalRequest;

class DomainRenewalController extends Controller
{
    protected $model;
    protected $view = 'domain_renewals';
    protected $base_route = 'domain-renewal';

    public function __construct(DomainRenewal $domainRenewal)
    {
        $this->model = $domainRenewal;
    }

    public function index()
    {
        $domainRenewals = $this->model->select('title', 'status', 'slug')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view($this->view.'.index', compact('domainRenewals'));
    }

    public function create()
    {
        return view($this->view.'.create');
    }

    public function store(AddDomainRenewalRequest $addDomainRenewalRequest)
    {
        $validatedData = $addDomainRenewalRequest->validated();
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $this->model->create($validatedData);
        return redirect()->route($this->base_route.'.index')->with('success', 'Domain Renewal added successfully!');
    }

    public function edit($slug)
    {
        $domainRenewal = $this->model->where('slug', $slug)
            ->select('title', 'status', 'slug')
            ->firstOrFail();
        return view($this->view.'.edit', compact('domainRenewal'));
    }

    public function update(AddDomainRenewalRequest $addDomainRenewalRequest, $slug)
    {
        $domainRenewal = $this->model->where('slug', $slug)
            ->firstOrFail();
        if(!$domainRenewal) {
            return redirect()->back()->with('danger', 'Invalid Request!');
        }
        $domainRenewal->update($addDomainRenewalRequest->validated());
        return redirect()->route($this->base_route.'.index')->with('success', 'Domain Renewal updated successfully!');
    }

    public function destroy($slug)
    {
        $domainRenewal = $this->model->where('slug', $slug)
            ->firstOrFail();
        if(!$domainRenewal) {
            return redirect()->route($this->base_route.'.index')->with('danger', 'Invalid Request!');
        }
        $domainRenewal->delete();
        return redirect()->back()->with('success', 'Domain Renewal deleted successfully!');
    }
}
