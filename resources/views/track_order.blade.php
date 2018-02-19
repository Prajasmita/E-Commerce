@extends('home_template')
@section('content')
    <div class="container">
        <div class="row">
            @if ( session()->has('traced_order') )
                <div class="alert alert-success">{{ session()->get('traced_order') }}</div>
            @endif
            <div class="col-sm-4">
                <div class="login-form"><!--login form-->
                    <h2>Track Order</h2>
                    {!! Form::open(['route' => 'track.my_order',]) !!}
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <div class="form-group {{ $errors->has('order_id') ? 'has-error' : ''}}">
                            {!! Form::text('order_id','', array('class' => 'form-control','placeholder'=>'Order Id *'));  !!}
                            {!! $errors->first('order_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            {!! Form::text('email','', array('class' => 'form-control','placeholder'=>'Email *'));  !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="login-box">
                        <div class="form-group form-actions">
                            <button type="submit" class="btn btn-default">Send</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!--/login form-->
            </div>
        </div>
    </div>
@endsection