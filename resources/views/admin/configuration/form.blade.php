<div class="form-group {{ $errors->has('conf_key') ? 'has-error' : ''}}">
    <label for="conf_key" class="col-md-4 control-label">{{ 'Conf Key' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="conf_key" type="text" id="conf_key" value="{{ $configuration->conf_key or ''}}" {{isset($configuration->conf_key) ? 'readonly' : ''}}>
        {!! $errors->first('conf_key', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('conf_value') ? 'has-error' : ''}}">
    <label for="conf_value" class="col-md-4 control-label">{{ 'Conf Value' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="conf_value" type="text" id="conf_value" value="{{ $configuration->conf_value or ''}}" >
        {!! $errors->first('conf_value', '<p class="help-block">:message</p>') !!}
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

        <a href="{{ url('/admin/configuration') }}" class="btn btn-danger">Cancle</a>


    </div>
</div>
