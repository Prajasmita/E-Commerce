
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $selected_category->name or ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}}">
    <label for="parent_id" class="col-md-4 control-label">{{ 'Parent Id' }}<span class="require">*</span></label>
    <div class="col-md-6">

        <select name="parent_id" class="form-control" id="parent_id" >
            <option value="0">No Parent</option>>
            @foreach ($category as $cate)
                <option value="{{ $cate->id }}" {{ (isset($selected_category) && $cate->id == $selected_category->parent_id) ? 'selected' : ''}}>{{ $cate->name }}</option>
            @endforeach

        </select>
        {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">

    <label for="status" class="col-md-4 control-label">{{ 'status' }}<span class="require">*</span></label>
    <div class="col-md-6">

        <input   name="status" value=1 type="radio" id="status" {{ (isset( $selected_category->status) && $selected_category->status == 1) ? 'checked' :''  }}>Active
        <input  name="status" value=0 type="radio" id="status" {{ (isset( $selected_category->status) && $selected_category->status == 0) ? 'checked' :'' }}>Inactive
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
         <a href="{{ url('/admin/categories') }}" class="btn btn-danger">Cancel</a>
    </div>
</div>
