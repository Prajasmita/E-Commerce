<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="col-md-4 control-label ">{{ 'Title' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control " name="title" type="text" id="title" value="{{ $cms->title or ''}}">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="col-md-4 control-label">{{ 'Content' }}<span class="require">*</span></label>
    <div class="col-md-6">
        {!! Form::textarea('content', isset($cms) ? $cms->content :'', array('class' => 'form-control','id'=>'ckeditor-note'));  !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}

    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">

        <a href="{{ url('/admin/cms') }}" class="btn btn-danger">Cancel</a>
    </div>
</div>
