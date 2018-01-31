@extends('home_template')
@section('content')
    <div class="container">
        <div class="row">
            @if ( session()->has('retrieve_password') )
                <div class="alert alert-success">{{ session()->get('retrieve_password') }}</div>
            @endif
            @if ( session()->has('register_email') )
                <div class="alert alert-danger">{{ session()->get('register_email') }}</div>
            @endif
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Forget Password</h2>
                    {!! Form::open(['route' => 'retrieve.password',]) !!}
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            {!! Form::text('email','', array('class' => 'form-control','placeholder'=>'Email *'));  !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="login-box">
                        <div class="form-group form-actions">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection