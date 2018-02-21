@extends('home_template')
@section('content')
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Track Order</li>
            </ol>
        </div><!--/breadcrums-->
        <div class="row">
            @if ( session()->has('traced_order') )
                <div class="alert alert-success">{{ session()->get('traced_order') }}</div>
            @endif
                @if ( session()->has('traced_order_failed') )
                    <div class="alert alert-danger">{{ session()->get('traced_order_failed') }}</div>
                @endif

            <div class="col-sm-4">
                <div class="login-form"><!--login form-->
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