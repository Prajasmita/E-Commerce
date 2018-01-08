<div class="form-group {{ $errors->has('banner_name') ? 'has-error' : ''}}">
    <label for="banner_name" class="col-md-4 control-label ">{{ 'Banner Name' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control " name="banner_name" type="text" id="banner_name" value="{{ $banner->banner_name or ''}}" >
        {!! $errors->first('banner_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('banner_image') ? 'has-error' : ''}}">
    <label for="banner_image" class="col-md-4 control-label">{{ 'Banner Image' }}<span class="require">*</span></label>
<div class="col-md-6">
        {!! Form::file('banner_image', array('class' => 'form-control', 'accept' =>'.jpg')) !!}
       {{-- <input class="form-control" name="banner_path" type="file" id="banner_path" placeholder="Choose File" value="{{ $banner->banner_path or ''}}" >--}}
        {!! $errors->first('banner_image', '<p class="help-block">:message</p>') !!}

</div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">

    <label for="status" class="col-md-4 control-label">{{ 'status' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input   name="status" value=1 type="radio" id="status" {{ isset( $banner->status) ? $banner->status == 1 ? 'checked' :'' : '' }}>Active
        <input  name="status" value=0 type="radio" id="status" {{isset( $banner->status) ? $banner->status == 0 ? 'checked' :'' : '' }}>Inactive
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{--<div class="form-group {{ $errors->has('banner_image') ? 'has-error' : ''}}">
    <label for="banner_name" class="col-md-4 control-label">{{ 'Banner image' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="banner_name" type="text" id="banner_name" value="{{ $banner->banner_image or ''}}" >
        {!! $errors->first('banner_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>--}}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">

        <a href="{{ url('/admin/banners') }}" class="btn btn-danger">Cancel</a>
    </div>
</div>
