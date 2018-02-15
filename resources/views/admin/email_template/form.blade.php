<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!!  Form::label('title', 'Title', array('class' => 'col-md-4 control-label required'));!!}
    <div class="col-md-6">
        {!! Form::text('title', isset($template) ? $template->title :'', array('class' => 'form-control',isset($template ) ? 'readOnly' : ''));  !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        <br/>
    </div>
</div>
<div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    {!!  Form::label('subject', 'Subject', array('class' => 'col-md-4 control-label required'));!!}
    <div class="col-md-6">
        {!! Form::text('subject', isset($template) ? $template->subject :'', array('class' => 'form-control '));  !!}
        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
        <br/>
    </div>
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    {!!  Form::label('content', 'Content', array('class' => 'col-md-4 control-label required'));!!}
    <div class="col-md-6">
        {!! Form::textarea('content', isset($template) ? $template->content :'', array('class' => 'form-control','id'=>'ckeditor-note'));  !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
        <br/>
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4 pull-right">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
        <a href="{{route('email.template')}}" class="btn btn-danger">Cancel</a>
        <br/>
    </div>
</div>
