@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.flash_notification')
        <div>
            <a href="{{ route($base_route.'.create') }}" class="btn btn-primary">Add {{ $panel }}</a>
        </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 200px !important;">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Gender</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @forelse($data['rows'] as $key => $row)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $row->first_name.' '.$row->last_name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>
                            {{'|'}}
                            @forelse ($row->roles as $role)
                                {{$role->name.'|'}}
                            @empty
                                No role assigned.|
                            @endforelse
                        </td>
                        <td>{{ $row->gender }}</td>
                        <td>{{ $row->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <form action="{{ route($base_route.'.destroy', $row->id)}}" method="post">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <a href="{{ route($base_route.'.edit', $row->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route($base_route.'.show', $row->id) }}" class="btn btn-warning">Show</a>
                                @if ($row->isUserDeletable())
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%">No records found!</td>
                    </tr>
                @endforelse
            </tbody>
          </table>
    </div>
@endsection
