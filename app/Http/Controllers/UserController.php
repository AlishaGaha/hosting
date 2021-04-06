<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\UserDetail;
use App\Http\Requests\User\AddFormRequest;
use App\Http\Requests\User\EditFormRequest;

class UserController extends BaseController
{
    protected $model;
    protected $base_route = 'users';
    protected $view = 'users';
    protected $panel = 'User';
    protected $folder = 'users';
    protected $folder_path;
    protected $image_name;

    public function __construct()
    {
        $this->model = new User();
        $this->folder_path = public_path('images'.DIRECTORY_SEPARATOR.$this->folder);
    }

    public function index()
    {
        $data['rows'] = $this->model->select([
                'users.id',
                'users.email',
                'user_details.first_name',
                'user_details.last_name',
                'user_details.gender',
                'user_details.dob',
                'user_details.address',
                'user_details.contact',
                'user_details.profile_image',
                'user_details.status'
            ])
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->with('roles')
            ->orderBy('users.created_at', 'DESC')
            ->paginate(10);
        return view(parent::loadDefaultDataToView($this->view.'.index'), compact('data'));
    }
    public function create()
    {
        $roles = Role::select(['id', 'name', 'slug'])->where('status', 1)->get();
        return view(parent::loadDefaultDataToView($this->view.'.create'), compact('roles'));
    }
    public function store(AddFormRequest $addFormRequest)
    {
        // dd($addFormRequest->all());
        if($addFormRequest->hasFile('image') && $addFormRequest->file('image')) {
            $image = $addFormRequest->file('image');
            $this->image_name = time().mt_rand(10000, 99999)."_".$image->getClientOriginalName();
            // dd($image_name);
            $image->move($this->folder_path, $this->image_name);
        }

        $validatedData = $addFormRequest->validated();
        $validatedData['profile_image'] = isset($this->image_name) ? $this->image_name : '';
        $user = $this->model->create([
            'name' => $validatedData['email'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password'])
        ]);
        UserDetail::create([
            'user_id' => $user->id,
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'gender' => $validatedData['gender'],
            'dob' => $validatedData['dob'],
            'address' => $validatedData['address'],
            'contact' => $validatedData['contact'],
            'status' => $validatedData['status'],
            'profile_image' => $validatedData['profile_image'],
        ]);
        $user->roles()->sync($validatedData['roles']);
        return redirect()->route($this->base_route.'.index')->with('success', $this->panel.' added successfully!');
    }
    public function show($id)
    {
        $data['row'] = $this->model->findOrFail($id);
        if(!$data['row']) {
            return redirect()->back()->with('danger', 'Invalid request!');
        }
        $data['user_details'] = $data['row']->userDetail;
        $data['roles'] = $data['row']->roles;
        return view(parent::loadDefaultDataToView($this->view.'.show'), compact('data'));
    }
    public function edit($id)
    {
        $data['row'] = $this->model->findOrFail($id);
        if(!$data['row']) {
            return redirect()->back()->with('danger', 'Invalid request!');
        }
        $user_details = $data['row']->userDetail;
        $data['row']->first_name = $user_details->first_name;
        $data['row']->last_name = $user_details->last_name;
        $data['row']->gender = $user_details->gender;
        $data['row']->dob = $user_details->dob;
        $data['row']->address = $user_details->address;
        $data['row']->contact = $user_details->contact;
        $data['row']->profile_image = $user_details->profile_image;
        $data['row']->status = $user_details->status;
        $data['user_roles'] = $data['row']->roles()->pluck('roles.name', 'roles.id')->toArray();
        $roles = Role::select(['id', 'name', 'slug'])->where('status', 1)->get();
        return view(parent::loadDefaultDataToView($this->view.'.edit'), compact('roles', 'data'));
    }
    public function update(EditFormRequest $request, $id)
    {
        $data['row'] = $this->model->findOrFail($id);
        if(!$data['row']) {
            return redirect()->back()->with('danger', 'Invalid request!');
        }
        $data['user_details'] = $data['row']->userDetail;
        $this->image_name = $data['user_details']->profile_image;
        if($request->hasFile('image') && $request->file('image')) {
            $image = $request->file('image');
            $this->image_name = time().mt_rand(10000, 99999)."_".$image->getClientOriginalName();
            $image->move($this->folder_path, $this->image_name);

            if($data['user_details']->profile_image) {
                if(file_exists($this->folder_path.DIRECTORY_SEPARATOR.$data['user_details']->profile_image)) {
                    unlink($this->folder_path.DIRECTORY_SEPARATOR.$data['user_details']->profile_image);
                }
            }
        }

        $validatedData = $request->validated();
        $data['row']->update([
            'name' => $validatedData['email'],
            'email' => $validatedData['email'],
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $data['row']->password
        ]);
        $data['user_details']->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'gender' => $validatedData['gender'],
            'dob' => $validatedData['dob'],
            'address' => $validatedData['address'],
            'contact' => $validatedData['contact'],
            'status' => $validatedData['status'],
            'profile_image' => $this->image_name,
        ]);
        $data['row']->roles()->sync($validatedData['roles']);
        return redirect()->route($this->base_route.'.index')->with('success', $this->panel.' updated successfully!');
    }
    public function destroy($id)
    {
        $data['row'] = $this->model->findOrFail($id);
        if(!$data['row']) {
            return redirect()->back()->with('danger', 'Invalid request!');
        }

        if(!$this->delete($data['row'])) {
            return redirect()->back()->with('danger', 'Invalid request!');
        }

        return redirect()->route($this->base_route.'.index')->with('success', $this->panel.' deleted successfully!');
    }

    protected function delete($row)
    {
        if(!$row || !$row->isUserDeletable()) {
            return false;
        }
        $userDetails = $row->userDetail;
        if($userDetails->profile_image) {
            if(file_exists($this->folder_path.DIRECTORY_SEPARATOR.$userDetails->profile_image)) {
                unlink($this->folder_path.DIRECTORY_SEPARATOR.$userDetails->profile_image);
            }
        }
        $userDetails->delete();
        $row->delete();
        return true;
    }
}
