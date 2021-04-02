<div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title<span style="color: red">*</span></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="title" name="title" value="{{ isset($blog) ? $blog->title : ''}}" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Description<span style="color: red">*</span></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="description" name="description" value="{{ isset($blog) ? $blog->cost : ''}}" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="publish_date" class="col-sm-2 col-form-label">Publish Date<span style="color: red">*</span></label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="publish_date" name="publish_date" value="{{ isset($blog) ? $blog->publish_date : ''}}" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="image" class="col-sm-2 col-form-label">Publish Date<span style="color: red">*</span></label>
    <div class="col-sm-10">
      <input type="file" id="image" name="image" value="{{ isset($blog) ? $blog->image : ''}}" required>
    </div>
  </div>
  <fieldset class="form-group row">
    <legend class="col-form-label col-sm-2 float-sm-left pt-0">Status</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="active" value="1" {!! isset($blog) && $blog->status == 1 ? 'checked' : '' !!} checked>
        <label class="form-check-label" for="active">
          Active
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="inactive" value="0" {!! isset($blog) && $blog->status == 0 ? 'checked' : '' !!}>
        <label class="form-check-label" for="inactive">
          Inactive
        </label>
      </div>
    </div>
  </fieldset>