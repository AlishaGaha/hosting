@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <a href="{{ route($base_route.'.index') }}" class="btn btn-primary">List of {{$panel}}</a>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mt-3 mb-5">Add {{$panel}}</h2>
                <form action="{{ route($base_route.'.update', $data['row']->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" value="{{$data['row']->id}}" name="id">
                    @include($view.'.includes.form')
                    <div class="form-group row">
                      <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>
@endsection