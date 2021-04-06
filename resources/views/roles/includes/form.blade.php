<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name<span style="color: red">*</span></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" name="name" value="{{ isset($data['row']) ? $data['row']->name : ''}}" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="hint" class="col-sm-2 col-form-label">Hint</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="hint" name="hint" value="{{ isset($data['row']) ? $data['row']->hint : ''}}" required>
    </div>
  </div>
  <fieldset class="form-group row">
    <legend class="col-form-label col-sm-2 float-sm-left pt-0">Status</legend>
    <div class="col-sm-10">
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
  </fieldset>