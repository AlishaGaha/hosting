<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends BaseController
{
    protected $model;
    protected $base_route = 'roles';
    protected $view = 'roles';
    protected $panel = 'Role';

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function index()
    {
        $data['rows'] = $this->model->select(['name', 'slug', 'hint', 'status'])->get();
        return view(parent::loadDefaultDataToView($this->view.'.index'), compact('data'));
    }

    public function edit($slug)
    {
        $data['row'] = $this->model->where('slug', $slug)->select(['name', 'slug', 'hint', 'status'])->firstOrFail();
        if(!$data['row']) {
            return redirect()->back()->with('danger', 'Invalid request!');
        }
        return view(parent::loadDefaultDataToView($this->base_route.'.edit'), compact('data'));
    }

    public function update(Request $request, $slug)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required|string',
            'hint' => 'nullable|string',
            'status' => 'required|in:0,1'
        ]);
        $data['row'] = $this->model->where('slug', $slug)->firstOrFail();
        if(!$data['row']) {
            return redirect()->back()->with('danger', 'Invalid request!');
        }

        $data['row']->update($validatedData);
        return redirect()->route($this->base_route.'.index')->with('success', 'Role updated successfully!');
    }
}
