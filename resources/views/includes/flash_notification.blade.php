@if(session()->has('success'))
    <div class="alert alert-success">
        <p>{{session()->get('success')}}</p>
    </div>
@endif

@if(session()->has('danger'))
    <div class="alert alert-warning">
        <p>{{ session()->get('danger') }}</p>
    </div>
@endif