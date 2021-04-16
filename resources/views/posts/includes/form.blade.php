<div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title<span style="color: red">*</span></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="title" name="title" value="{{ isset($post) ? $post->title : ''}}" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="body" class="col-sm-2 col-form-label">Body<span style="color: red">*</span></label>
    <div class="col-sm-10">
      <textarea name="body" class="form-control" id="body" cols="30" rows="10" required>{!! isset($post) ? $post->body : '' !!}</textarea>
    </div>
  </div>