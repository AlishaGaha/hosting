<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HostingRenewal;
use App\Http\Requests\Hosting\AddHostingRenewalRequest;

class HostingRenewalController extends Controller
{
    protected $model;
    protected $view = 'hosting_renewals';
    protected $base_route = 'hosting-renewal';

    public function __construct(HostingRenewal $hostingRenewal)
    {
        $this->model = $hostingRenewal;
    }

    public function index()
    {
        $hostingRenewals = $this->model->select('title', 'status', 'slug')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view($this->view.'.index', compact('hostingRenewals'));
    }

    public function create()
    {
        return view($this->view.'.create');
    }

    public function store(AddHostingRenewalRequest $addHostingRenewalRequest)
    {
        $validatedData = $addHostingRenewalRequest->validated();
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $this->model->create($validatedData);
        return redirect()->route($this->base_route.'.index')->with('success', 'Hosting Renewal added successfully!');
    }

    public function edit($slug)
    {
        $hostingRenewal = $this->model->where('slug', $slug)
            ->select('title', 'status', 'slug')
            ->firstOrFail();
        return view($this->view.'.edit', compact('hostingRenewal'));
    }

    public function update(AddHostingRenewalRequest $addHostingRenewalRequest, $slug)
    {
        $hostingRenewal = $this->model->where('slug', $slug)
            ->firstOrFail();
        if(!$hostingRenewal) {
            return redirect()->back()->with('danger', 'Invalid Request!');
        }
        $hostingRenewal->update($addHostingRenewalRequest->validated());
        return redirect()->route($this->base_route.'.index')->with('success', 'Hosting Renewal updated successfully!');
    }

    public function destroy($slug)
    {
        $hostingRenewal = $this->model->where('slug', $slug)
            ->firstOrFail();
        if(!$hostingRenewal) {
            return redirect()->route($this->base_route.'.index')->with('danger', 'Invalid Request!');
        }
        $hostingRenewal->delete();
        return redirect()->back()->with('success', 'Hosting Renewal deleted successfully!');
    }
}
