@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.flash_notification')
        <div>
            <a href="{{ route('plans.create') }}" class="btn btn-primary">Add Plan</a>
        </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 200px">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Cost</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @forelse($plans as $key => $plan)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $plan->title }}</td>
                        <td>{{ $plan->slug }}</td>
                        <td>{{ $plan->cost }}</td>
                        <td>{{ $plan->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            {{-- <button class="btn btn-sm btn-danger">Delete</button> --}}
                            <form action="{{ route('plans.destroy', $plan->slug)}}" method="post">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <a href="{{ route('plans.edit', $plan->slug) }}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger" type="submit">Delete</button>
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
            {{ $plans->links() }}
    </div>
@endsection