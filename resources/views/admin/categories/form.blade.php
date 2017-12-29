<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $selected_category->name or ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>





<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}}">
    <label for="parent_id" class="col-md-4 control-label">{{ 'Parent Id' }}</label>
    <div class="col-md-6">

        <select name="parent_id" class="form-control" id="parent_id" >
            <option value="0">No Parent</option>>
            @foreach ($category as $category)
                <option value="{{ $category->id }}" {{--{{ (isset($category->parent_id) && $category->parent_id == $selected_category->id) ? 'selected' : ''}}--}}>{{ $category->name }}</option>

            @endforeach

        </select>
        {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">

    <label for="status" class="col-md-4 control-label">{{ 'status' }}</label>
    <div class="col-md-6">
        <input   name="status" value="1" type="radio" id="status" >Active
        <input  name="status" value="0" type="radio" id="status" >Inactive
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
         <a href={{ url('/admin/categories') }}" class="btn btn-danger">Cancle</a>
    </div>
</div>
