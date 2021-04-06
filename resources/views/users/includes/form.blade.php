<div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label">Email Address<span style="color: red">*</span></label>
    <div class="col-sm-9">
        <input type="email" class="form-control" id="email" name="email" value="{{ isset($data['row']) ? $data['row']->email : ''}}" required>
    </div>
    @include('includes.form_validation_alert', ['field' => 'email'])
</div>
@if (!isset($data['row']))
    <div class="form-group row">
        <label for="password" class="col-sm-3 col-form-label">Password<span style="color: red">*</span></label>
        <div class="col-sm-9">
            <input type="password" class="form-control" id="password" name="password" value="{{ isset($data['row']) ? $data['row']->password : ''}}" required>
        </div>
        @include('includes.form_validation_alert', ['field' => 'password'])
    </div>
    <div class="form-group row">
        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password<span style="color: red">*</span></label>
        <div class="col-sm-9">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ isset($data['row']) ? $data['row']->password_confirmation : ''}}" required>
        </div>
        @include('includes.form_validation_alert', ['field' => 'password_confirmation'])
    </div>
@endif
<div class="form-group row">
    <label for="first_name" class="col-sm-3 col-form-label">First Name<span style="color: red">*</span></label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ isset($data['row']) ? $data['row']->first_name : ''}}" required>
    </div>
    @include('includes.form_validation_alert', ['field' => 'first_name'])
</div>
<div class="form-group row">
    <label for="last_name" class="col-sm-3 col-form-label">Last Name<span style="color: red">*</span></label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ isset($data['row']) ? $data['row']->last_name : ''}}" required>
    </div>
    @include('includes.form_validation_alert', ['field' => 'last_name'])
</div>
<div class="form-group row">
    <label for="gender" class="col-sm-3 col-form-label">Gender<span style="color: red">*</span></label>
    <div class="col-sm-9">
        <select class="form-control" id="gender" name="gender" required>
            <option disabled>------Select options-------</option>
            <option value="Male" {!! isset($data['row']) && $data['row']->gender == 'Male' ? 'selected': '' !!}>Male</option>
            <option value="Female" {!! isset($data['row']) && $data['row']->gender == 'Female' ? 'selected': '' !!}>Female</option>
        </select>
    </div>
    @include('includes.form_validation_alert', ['field' => 'gender'])
</div>
<div class="form-group row">
    <label for="dob" class="col-sm-3 col-form-label">DOB</label>
    <div class="col-sm-9">
        <input type="date" class="form-control" id="dob" name="dob" value="{{ isset($data['row']) ? $data['row']->dob : ''}}">
    </div>
    @include('includes.form_validation_alert', ['field' => 'dob'])
</div>
<div class="form-group row">
    <label for="address" class="col-sm-3 col-form-label">Address</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="address" name="address" value="{{ isset($data['row']) ? $data['row']->address : ''}}">
    </div>
    @include('includes.form_validation_alert', ['field' => 'address'])
</div>
<div class="form-group row">
    <label for="contact" class="col-sm-3 col-form-label">Contact</label>
    <div class="col-sm-9">
        <input type="number" minlength="10" class="form-control" id="contact" name="contact" value="{{ isset($data['row']) ? $data['row']->contact : ''}}">
    </div>
    @include('includes.form_validation_alert', ['field' => 'contact'])
</div>
@if (isset($data['row']))
    <div class="form-group row">
        <label for="existing_image" class="col-sm-3 col-form-label">Existing Image</label>
        <div class="col-sm-9">
            @if ($data['row']->profile_image)
                <img src="{{asset('images/'.$folder.'/'.$data['row']->profile_image)}}" width="250px" height="200px" alt="profile_image">
            @else
                No image
            @endif
        </div>
    </div>
@endif
<div class="form-group row">
    <label for="image" class="col-sm-3 col-form-label">Profile Image</label>
    <div class="col-sm-9">
        <input type="file" id="image" name="image">
    </div>
    @include('includes.form_validation_alert', ['field' => 'image'])
</div>
<fieldset class="form-group row">
    <legend class="col-form-label col-sm-3 float-sm-left pt-0">Assign Roles<span style="color: red">*</span></legend>
    <div class="col-sm-9">
        @forelse ($roles as $role)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" {!! array_key_exists($role->id, $data['user_roles']) ? 'checked' : '' !!} id="{{$role->slug}}">
                <label class="form-check-label" for="{{$role->slug}}">
                    {{ $role->name }}
                </label>
            </div>
        @empty
            No records found!
        @endforelse
    </div>
    @include('includes.form_validation_alert', ['field' => 'roles'])
</fieldset>
<fieldset class="form-group row">
    <legend class="col-form-label col-sm-3 float-sm-left pt-0">Status</legend>
    <div class="col-sm-9">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="active" value="1" {!! isset($data['row']) && $data['row']->status == 1 ? 'checked' : '' !!} checked>
            <label class="form-check-label" for="active">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="inactive" value="0" {!! isset($data['row']) && $data['row']->status == 0 ? 'checked' : '' !!}>
            <label class="form-check-label" for="inactive">
                Inactive
            </label>
        </div>
    </div>
    @include('includes.form_validation_alert', ['field' => 'status'])
</fieldset>

@if (isset($data['row']))
<hr/>
    <div class="form-group row">
        <label for="password" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" id="password" >
        </div>
        @include('includes.form_validation_alert', ['field' => 'password'])
    </div>
    <div class="form-group row">
        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        @include('includes.form_validation_alert', ['field' => 'password_confirmation'])
    </div>
@endif