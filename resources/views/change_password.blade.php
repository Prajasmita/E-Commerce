@extends('home_template')
@section('content')
    <div class="container">
        <div class="row">
            @if ( session()->has('success_message') )
                <div class="alert alert-success">{{ session()->get('success_message') }}</div>
            @endif
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Change Password</h2>
                    @if ( session()->has('message') )
                        <div class="alert alert-danger">{{ session()->get('message') }}</div>
                    @endif
                    {!! Form::open(['route' => 'store.change_password',]) !!}
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <div class="form-group {{ $errors->has('old_password') ? 'has-error' : ''}}">
                            {!! Form::text('old_password','', array('class' => 'form-control','placeholder'=>'Old Password *'));  !!}
                            {!! $errors->first('old_password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
                            {!! Form::text('new_password','', array('class' => 'form-control','placeholder'=>'New Password *'));  !!}
                            {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="form-group {{ $errors->has('confirm_new_password') ? 'has-error' : ''}}">
                            {!! Form::text('confirm_new_password','', array('class' => 'form-control','placeholder'=>'Confirm New Password *'));  !!}
                            {!! $errors->first('confirm_new_password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="login-box">
                        <div class="form-group form-actions">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!--/login form-->
            </div>
        </div>
    </div>


@endsection