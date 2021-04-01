@if($errors->has($field))
    <span class="alert alert-danger col-sm-offset-3" style="padding: 0px;">
        <strong>{{$errors->first($field)}}</strong>
    </span>
@endif