<div class="form-row">
    <div class="form-group col-md-3">
      <label for="name">Client Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $filters['name'] }}">
    </div>
    <div class="form-group col-md-3">
      <label for="email">Email</label>
      <input type="text" class="form-control" id="email" name="email" value="{{ $filters['email'] }}">
    </div>
    <div class="form-group col-md-3">
      <label for="contact_number">Conact Number</label>
      <input type="number" class="form-control" id="contact_number" name="contact_number" value="{{ $filters['contact_number'] }}">
    </div>
    <div class="form-group col-md-3">
      <label for="service_type">Service Type</label>
      <select class="form-control" id="service_type" name="service_type">
          <option disabled>------Select options-------</option>
          @forelse ($serviceType as $service)
              <option value="{{ $service }}" {!! isset($filters['service_type']) && $filters['service_type'] == $service ? 'selected': '' !!}>{{ $service }}</option>
          @empty
              <option disabled>No records found!</option>
          @endforelse
      </select>
    </div>
  </div>
  <div class="form-row">
      <div class="form-group col-md-3">
          <label for="domain_name">Domain Name</label>
          <input type="text" class="form-control" id="domain_name" name="domain_name" value="{{ $filters['domain_name'] }}">
        </div>
      <div class="form-group col-md-3">
          <label for="domain_renewal">Domain Renewal</label>
          <div class="form-row" style="padding: 0 0.4rem">
              <input class="col-sm-4 form-control" type="number" id="domain_renewal" min="1" name="domain_renewal" value="{{ $filters['domain_renewal'] }}">
              <select class="col-sm-8 form-control" id="domain_renewal_type" name="domain_renewal_type">
                  <option disabled>------Select options-------</option>
                  @forelse ($renewalType as $renewal)
                      <option value="{{ $renewal }}" {!! isset($filters['domain_renewal_type']) && $filters['domain_renewal_type'] == $renewal ? 'selected': '' !!}>{{ucfirst($renewal)}}</option>
                  @empty
                      <option disabled>No records found!</option>
                  @endforelse
              </select>
          </div>
      </div>
      <div class="form-group col-md-3">
          <label for="plan">Hosting Plan</label>
          <select class="form-control" id="plan" name="plan">
              <option disabled>------Select options-------</option>
              @forelse ($plans as $plan)
                  <option value="{{ $plan->id }}" {!! isset($filters['plan']) && $filters['plan'] == $plan->id ? 'selected': '' !!}>{{ $plan->title }}</option>
              @empty
                  <option disabled>No records found!</option>
              @endforelse
          </select>
      </div>
      <div class="form-group col-md-3">
          <label for="hosting_renewal">Hosting Renewal</label>
          <div class="form-row" style="padding: 0 0.4rem">
              <input class="col-sm-3 form-control" type="number" id="hosting_renewal" min="1" name="hosting_renewal" value="{{ $filters['hosting_renewal'] }}">
              <select class="col-sm-9 form-control" id="hosting_renewal_type" name="hosting_renewal_type">
                  <option disabled>------Select options-------</option>
                  @forelse ($renewalType as $hosting)
                      <option value="{{ $hosting }}" {!! isset($filters['hosting_renewal_type']) && $filters['hosting_renewal_type'] == $hosting ? 'selected': '' !!}>{{ ucfirst($hosting) }}</option>
                  @empty
                      <option disabled>No records found!</option>
                  @endforelse
              </select>
          </div>
      </div>
  </div>