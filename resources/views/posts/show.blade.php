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
                        <td>Title</td>
                        <td>{{$post->title}}</td>
                    </tr>
                    <tr>
                        <td>Body</td>
                        <td>{!! $post->body !!}</td>
                    </tr>
                    <tr>
                        <td>Created By</td>
                        <td>{!! $post->user->userDetail->first_name.' '.$post->user->userDetail->last_name !!}</td>
                    </tr>
            </tbody>
          </table>
    </div>
@endsection
