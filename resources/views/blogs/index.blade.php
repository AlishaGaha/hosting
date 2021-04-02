@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.flash_notification')
        <div>
            <a href="{{ route('blogs.create') }}" class="btn btn-primary">Add Blog</a>
        </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 200px">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Publish Date</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @forelse($blogs as $key => $blog)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->description }}</td>
                        <td>{{ $blog->publish_date }}</td>
                        <td>{{ $blog->image }}</td>
                        <td>{{ $blog->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            {{-- <button class="btn btn-sm btn-danger">Delete</button> --}}
                            <form action="{{ route('blogs.destroy', $blog->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">No records found!</td>
                    </tr>
                @endforelse
            </tbody>
          </table>
            {{ $blogs->links() }}
    </div>
@endsection