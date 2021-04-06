@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.flash_notification')
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 200px !important;">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Hint</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @forelse($data['rows'] as $key => $row)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->slug }}</td>
                        <td>{{ $row->hint }}</td>
                        <td>{{ $row->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route($base_route.'.edit', $row->slug) }}" class="btn btn-success">Edit</a>
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
