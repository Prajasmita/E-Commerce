<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!!  Form::label('code', 'Code', array('class' => 'col-md-4 control-label'));!!}
    <div class="col-md-6">
        {!! Form::text('code', isset($coupon) ? $coupon->code :'', array('class' => 'form-control'));  !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
        <br/>
    </div>
</div>
<br/>
<div class="form-group {{ $errors->has('percent_off') ? 'has-error' : ''}}">
    {!!  Form::label('percent_off', 'Percent Off', array('class' => 'col-md-4 control-label'));!!}
    <div class="col-md-6">
        {!! Form::text('percent_off', isset($coupon) ? $coupon->percent_off :'', array('class' => 'form-control'));  !!}
        {!! $errors->first('percent_off', '<p class="help-block">:message</p>') !!}
        <br/>
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit('Create',array('class'=>'btn btn-primary')); !!}
{{--
        {!! Form::button('Cancel',array('url'=>'admin/coupons','class'=>'btn btn-danger')); !!}
--}}
        <a href="{{url('/admin/coupons/')}}" class="btn btn-danger">Cancle</a>
        <br/>
    </div>
</div>
