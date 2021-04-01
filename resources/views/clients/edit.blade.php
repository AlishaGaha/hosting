@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <a href="{{ route('clients') }}" class="btn btn-sm btn-primary">List of Client</a>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mt-3 mb-5">Add New Client</h2>
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" value="{{ $client->id }}" name="id">
                    @include('clients.includes.form')
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