<div class="form-row">
    <div class="form-group col-md-3">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="">
    </div>
    {{-- <div class="form-group col-md-3">
        <label for="created_by">Created By</label>
        <input type="text" class="form-control" id="created_by" name="created_by" value="{{ $filters['created_by'] }}">
    </div> --}}
    {{-- <div class="form-group col-md-3">
        <label for="category">Category</label>
        <select class="form-control" id="category" name="category">
            <option disabled>------Select options-------</option>
            @forelse ($categories as $category)
                <option value="{{ $category->id }}" {!! isset($filters['category']) && $filters['category'] == $category->id ? 'selected': '' !!}>{{ $category->name }}</option>
            @empty
                <option disabled>No records found!</option>
            @endforelse
        </select>
    </div> --}}
</div>
  {{-- <div class="form-row">
    <div class="form-group col-md-3">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="{{ $filters['title'] }}">
    </div>
    <div class="form-group col-md-3">
      <label for="created_by">Created by</label>
      <input type="text" class="form-control" id="created_by" name="created_by" value="{{ $filters['created_by'] }}">
    </div>
    <div class="form-group col-md-3">
      <label for="category">Category</label>
      <select class="form-control" id="category" name="category">
          <option disabled>------Select options-------</option>
          @forelse ($categories as $category)
              <option value="{{ $category->id }}" {!! isset($filters['category']) && $filters['category'] == $category->id ? 'selected': '' !!}>{{ $category->name }}</option>
          @empty
              <option disabled>No records found!</option>
          @endforelse
      </select>
    </div>
  </div> --}}