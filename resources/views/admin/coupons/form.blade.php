<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!!  Form::label('code', 'Code', array('class' => 'col-md-4 control-label required'));!!}


    <div class="col-md-6">
        {!! Form::text('code', isset($coupon) ? $coupon->code :'', array('class' => 'form-control'));  !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
        <br/>
    </div>
</div>
<br/>
<div class="form-group {{ $errors->has('percent_off') ? 'has-error' : ''}}">
    {!!  Form::label('percent_off', 'Percent Off', array('class' => 'col-md-4 control-label required'));!!}
    <div class="col-md-6">
        {!! Form::text('percent_off', isset($coupon) ? $coupon->percent_off :'', array('class' => 'form-control '));  !!}
        {!! $errors->first('percent_off', '<p class="help-block">:message</p>') !!}
        <br/>
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">

    <label for="status" class="col-md-4 control-label">{{ 'status' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input   name="status" value="1" type="radio" id="status" {{ isset( $coupon->status) ? $coupon->status == 1 ? 'checked' :'' : '' }}>Active
        <input  name="status" value="0" type="radio" id="status" {{ isset( $coupon->status) ? $coupon->status == 0 ? 'checked' :'' : '' }}>Inactive
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
        <a href="{{url('/admin/coupons/')}}" class="btn btn-danger">Cancel</a>
        <br/>
    </div>
</div>
