@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.flash_notification')
        <div>
            <a href="{{ route($base_route.'.index') }}" class="btn btn-primary">List of {{ $panel }}</a>
        </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Column</th>
                <th scope="col">Value</th>
              </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{$data['user_details']->first_name.' '.$data['user_details']->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$data['row']->email}}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{$data['user_details']->gender}}</td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>
                            {{'|'}}
                            @forelse ($data['roles'] as $role)
                                {{$role->name.'|'}}
                            @empty
                                No roles assigned |
                            @endforelse
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{$data['user_details']->address}}</td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td>{{$data['user_details']->contact}}</td>
                    </tr>
                    <tr>
                        <td>DOB</td>
                        <td>{{$data['user_details']->dob}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{{$data['user_details']->status == 1 ? 'Active' : 'Inactive' }}</td>
                    </tr>
                    <tr>
                        <td>Profile Image</td>
                        <td>
                            @if ($data['user_details']->profile_image)
                                <img src="{{asset('images/'.$folder.'/'.$data['user_details']->profile_image)}}" width="250px" height="200px" alt="profile_image">
                            @else
                                No image
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Created At</td>
                        <td>{{ $data['row']->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Updated At</td>
                        <td>{{ $data['row']->updated_at }}</td>
                    </tr>
            </tbody>
          </table>
    </div>
@endsection
