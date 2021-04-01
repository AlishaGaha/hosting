<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Http\Requests\Plan\AddPlanRequest;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    protected $model;

    public function __construct(Plan $plan)
    {
        $this->model = $plan;
    }

    public function index()
    {
        $plans = $this->model->select('title', 'cost', 'status', 'slug')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('plans.index', compact('plans'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(AddPlanRequest $addPlanRequest)
    {
        $validatedData = $addPlanRequest->validated();
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $this->model->create($validatedData);
        return redirect()->route('plans')->with('success', 'Plan added successfully!');
    }

    public function edit($slug)
    {
        $plan = $this->model->where('slug', $slug)
            ->select('title', 'cost', 'status', 'slug')
            ->firstOrFail();
        return view('plans.edit', compact('plan'));
    }

    public function update(AddPlanRequest $addPlanRequest, $slug)
    {
        $plan = $this->model->where('slug', $slug)
            ->firstOrFail();
        if(!$plan) {
            return redirect()->route('plans')->with('danger', 'Invalid Request!');
        }
        $plan->update($addPlanRequest->validated());
        return redirect()->route('plans')->with('success', 'Plan updated successfully!');
    }

    public function destroy($slug)
    {
        $plan = $this->model->where('slug', $slug)
            ->firstOrFail();
        if(!$plan) {
            return redirect()->route('plans')->with('danger', 'Invalid Request!');
        }
        $plan->delete();
        return redirect()->back()->with('success', 'Plan deleted successfully!');
    }
}
