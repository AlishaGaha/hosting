<div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title<span style="color: red">*</span></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="title" name="title" value="{{ isset($plan) ? $plan->title : ''}}" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="cost" class="col-sm-2 col-form-label">Cost<span style="color: red">*</span></label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="cost" name="cost" value="{{ isset($plan) ? $plan->cost : ''}}" required>
    </div>
  </div>
  <fieldset class="form-group row">
    <legend class="col-form-label col-sm-2 float-sm-left pt-0">Status</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="active" value="1" {!! $plan->status == 1 ? 'checked' : '' !!} checked>
        <label class="form-check-label" for="active">
          Active
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="inactive" value="0" {!! $plan->status == 0 ? 'checked' : '' !!}>
        <label class="form-check-label" for="inactive">
          Inactive
        </label>
      </div>
    </div>
  </fieldset>