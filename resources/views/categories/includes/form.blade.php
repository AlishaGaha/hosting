<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name<span style="color: red">*</span></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" name="name" value="{{ isset($category) ? $category->name : ''}}" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <textarea name="description" class="form-control" id="description" cols="30" rows="5" required>{!! isset($category) ? $category->description : '' !!}</textarea>
    </div>
  </div>