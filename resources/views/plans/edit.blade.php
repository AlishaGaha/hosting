@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <a href="{{ route('plans') }}" class="btn btn-primary">List of Plan</a>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mt-3 mb-5">Edit Hosting Plan</h2>
                <form action="{{ route('plans.update', $plan->slug) }}" method="POST">
                    @csrf
                    @method('put')

                    @include('plans.includes.form')
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