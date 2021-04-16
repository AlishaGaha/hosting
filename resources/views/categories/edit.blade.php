@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <a href="{{ route($base_route.'.index') }}" class="btn btn-primary">List of {{$panel}}</a>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mt-3 mb-5">Edit {{$panel}}</h2>
                <form action="{{ route($base_route.'.update', $category->id) }}" method="POST">
                    @csrf
                    @method('put')

                    @include($view.'.includes.form')
                    <div class="form-group row">
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>
@endsection