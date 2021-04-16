@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.flash_notification')
        <div>
            <a href="{{ route($base_route.'.create') }}" class="btn btn-primary">Add {{$panel}}</a>
        </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 200px">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @forelse($categories as $key => $category)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description, 50) }}</td>
                        <td>
                            {{-- <button class="btn btn-sm btn-danger">Delete</button> --}}
                            <form action="{{ route($base_route.'.destroy', $category->id)}}" method="POST">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <a href="{{ route($base_route.'.edit', $category->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route($base_route.'.show', $category->id) }}" class="btn btn-info">Show</a>
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
            {{-- {{ $post->links() }} --}}
    </div>
@endsection