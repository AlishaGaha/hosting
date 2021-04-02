<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    protected $model;
    protected $view = 'blogs';
    protected $base_route = 'blogs';

    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    public function index()
    {
        $blogs = $this->model->select('id', 'title', 'description', 'status', 'publish_date', 'image')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view($this->view.'.index', compact('blogs'));
    }

    public function create()
    {
        return view($this->view.'.create');
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $validatedData = $request->except('_token', 'image');
        $validatedData['image'] = $image->getClientOriginalName();
        $this->model->create($validatedData);
        return redirect()->route($this->base_route.'.index')->with('success', 'Blog added successfully!');
    }

    public function edit($id)
    {
        $blog = $this->model->where('id', $id)
            ->select('id', 'title', 'description', 'status', 'publish_date', 'image')
            ->firstOrFail();
        return view($this->view.'.edit', compact('blog'));
    }

    public function update(AddDomainRenewalRequest $addDomainRenewalRequest, $id)
    {
        $domainRenewal = $this->model->where('id', $id)
            ->firstOrFail();
        if(!$domainRenewal) {
            return redirect()->back()->with('danger', 'Invalid Request!');
        }
        $domainRenewal->update($addDomainRenewalRequest->validated());
        return redirect()->route($this->base_route.'.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = $this->model->where('id', $id)
            ->firstOrFail();
        if(!$blog) {
            return redirect()->route($this->base_route.'.index')->with('danger', 'Invalid Request!');
        }
        $blog->delete();
        return redirect()->back()->with('success', 'Blog deleted successfully!');
    }
}
