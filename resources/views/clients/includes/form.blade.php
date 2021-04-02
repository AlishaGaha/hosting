<div class="form-group row">
    <label for="first_name" class="col-sm-4 col-form-label">First Name<span style="color: red">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="first_name" name="first_name" value="{{ isset($client) ? $client->first_name: '' }}" required>
    </div>
    @include('includes.form_validation_alert', ['field' => 'first_name'])
</div>
<div class="form-group row">
    <label for="last_name" class="col-sm-4 col-form-label">Last Name<span style="color: red">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="last_name" name="last_name" value="{{ isset($client) ? $client->last_name: '' }}" required>
    </div>
    @include('includes.form_validation_alert', ['field' => 'last_name'])
</div>
<div class="form-group row">
    <label for="email" class="col-sm-4 col-form-label">Email<span style="color: red">*</span></label>
    <div class="col-sm-8">
      <input type="email" class="form-control" id="email" name="email" value="{{ isset($client) ? $client->email: '' }}" required>
    </div>
    @include('includes.form_validation_alert', ['field' => 'email'])
</div>
<div class="form-group row">
    <label for="contact_number" class="col-sm-4 col-form-label">Contact Number<span style="color: red">*</span></label>
    <div class="col-sm-8">
      <input type="number" class="form-control" id="contact_number" name="contact_number" value="{{ isset($client) ? $client->contact_number : '' }}" required>
    </div>
    @include('includes.form_validation_alert', ['field' => 'contact_number'])
</div>
<div class="form-group row">
    <label for="address" class="col-sm-4 col-form-label">Address</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="address" name="address" value="{{ isset($client) ? $client->address: '' }}">
    </div>
    @include('includes.form_validation_alert', ['field' => 'address'])
</div>
<div class="form-group row">
    <label for="service_type" class="col-sm-4 col-form-label">Service Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="service_type" name="service_type" required>
            <option disabled>------Select options-------</option>
            @forelse ($serviceType as $service)
                <option value="{{ $service }}" {!! isset($client) && $client->service_type == $service ? 'selected': '' !!}>{{ucfirst($service)}}</option>
            @empty
                <option disabled>No records found!</option>
            @endforelse
        </select>
    </div>
    @include('includes.form_validation_alert', ['field' => 'service_type'])
</div>
<div class="form-group row domain_section">
    <label for="domain_name" class="col-sm-4 col-form-label">Domain Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="domain_name" name="domain_name" value="{{ isset($client) ? $client->domain_name: '' }}">
    </div>
    @include('includes.form_validation_alert', ['field' => 'domain_name'])
</div>
<div class="form-group row domain_section">
    <label for="domain_renewal" class="col-sm-4 col-form-label">Domain Renewal</label>
    <div class="col-sm-8">
        <div class="row" style="padding-left: 1rem; padding-right: 1rem;">
            <input class="col-sm-3 form-control" type="number" id="domain_renewal" min="1" name="domain_renewal" value="{{ isset($client) ? $client->domain_renewal: '' }}">
            <select class="col-sm-9 form-control" id="domain_renewal_type" name="domain_renewal_type">
                <option disabled>------Select options-------</option>
                @forelse ($renewalType as $renewal)
                    <option value="{{ $renewal }}" {!! isset($client) && $client->domain_renewal_type == $renewal ? 'selected': '' !!}>{{ucfirst($renewal)}}</option>
                @empty
                    <option disabled>No records found!</option>
                @endforelse
            </select>
        </div>
    </div>
    @include('includes.form_validation_alert', ['field' => 'domain_renewal'])
</div>
<fieldset class="form-group row hosting_section">
    <legend class="col-form-label col-sm-4 float-sm-left pt-0">Hosting Plan</legend>
    <div class="col-sm-8">
        @forelse ($plans as $plan)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="plan_id" id="plan" value="{{ $plan->id }}" {!! isset($client) && $client->plan_id == $plan->id ? 'checked': '' !!}>
                <label class="form-check-label" for="plan">
                    {{ $plan->title }}
                </label>
            </div>
        @empty
            <div class="form-check">
                <label class="form-check-label">
                    No records found!
                </label>
            </div>
        @endforelse
    </div>
    @include('includes.form_validation_alert', ['field' => 'plan_id'])
</fieldset>
<div class="form-group row hosting_section">
    <label for="hosting_renewal" class="col-sm-4 col-form-label">Hosting Renewal</label>
    <div class="col-sm-8">
        <div class="row" style="padding-left: 1rem; padding-right: 1rem;">
            <input type="number" min="1" class="col-sm-3 form-control" id="hosting_renewal" name="hosting_renewal" value="{{ isset($client) ? $client->hosting_renewal: '' }}">
            <select class="col-sm-9 form-control" id="hosting_renewal_type" name="hosting_renewal_type">
                <option disabled>------Select-------</option>
                @forelse ($renewalType as $hosting)
                    <option value="{{ $hosting }}" {!! isset($client) && $client->hosting_renewal_type == $hosting ? 'selected': '' !!}> {{ucfirst($hosting)}}</option>
                @empty
                    <option disabled>No records found!</option>
                @endforelse
            </select>
        </div>
    </div>
    @include('includes.form_validation_alert', ['field' => 'hosting_renewal'])
</div>
<div class="form-group row">
    <label for="annual_maintenance_cost_type" class="col-sm-4 col-form-label">Annual Maintenace Cost Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="annual_maintenance_cost_type" name="annual_maintenance_cost_type">
            <option disabled>------Select options-------</option>
            @forelse ($annualMaintenanceCostType as $type)
                <option value="{{ $type }}" {!! isset($client) && $client->annual_maintenance_cost_type == $type ? 'selected': '' !!}>{{$type}}</option>
            @empty
                <option disabled>No records found!</option>
            @endforelse
        </select>
    </div>
    @include('includes.form_validation_alert', ['field' => 'annual_maintenance_cost_type'])
</div>
<div class="form-group row">
    <label for="annual_maintenance_cost" class="col-sm-4 col-form-label">Annual Maintenace Cost</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="annual_maintenance_cost" name="annual_maintenance_cost" value="{{ isset($client) ? $client->annual_maintenance_cost : ''}}">
    </div>
    @include('includes.form_validation_alert', ['field' => 'annual_maintenance_cost'])
</div>