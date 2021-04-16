@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.flash_notification')
        <div>
            <a href="{{ route($base_route.'.create') }}" class="btn btn-primary">Add Post</a>
        </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 200px">Title</th>
                <th scope="col">Body</th>
                <th scope="col">Created By</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @forelse($posts as $key => $post)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->body, 50) }}</td>
                        <td>{{ $post->user->userDetail->first_name.' '.$post->user->userDetail->last_name }}</td>
                        <td>
                            {{-- <button class="btn btn-sm btn-danger">Delete</button> --}}
                            <form action="{{ route($base_route.'.destroy', $post->id)}}" method="post">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <a href="{{ route($base_route.'.edit', $post->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route($base_route.'.show', $post->id) }}" class="btn btn-info">Show</a>
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
            {{-- {{ $posts->links() }} --}}
    </div>
@endsection