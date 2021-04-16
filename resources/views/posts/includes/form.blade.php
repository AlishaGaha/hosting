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
<fieldset class="form-group row">
  <label for="categories" class="col-sm-2 col-form-label">Category<span style="color: red">*</span></label>
  <div class="col-sm-10">
    <select class="form-control" id="categories" name="categories[]" multiple required>
      <option disabled>------Select options-------</option>
      @forelse ($categories as $category)
          <option value="{{ $category->id }}" {!! isset($post) && in_array($category->id, $category_post) ? 'selected': '' !!}>{{$category->name}}</option>
      @empty
          <option disabled>No records found!</option>
      @endforelse
  </select>
  </div>
  @include('includes.form_validation_alert', ['field' => 'categories'])
</fieldset>
