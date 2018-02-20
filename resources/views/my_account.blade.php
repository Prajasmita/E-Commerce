@extends('home_template')
@section('content')
    <section>
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li class="active">My Account</li>
                </ol>
            </div><!--/breadcrums-->
            @if ( session()->has('update_myaccount') )
                <div class="alert alert-success">{{ session()->get('update_myaccount') }}</div>
            @endif
            {!! Form::open(['route' => ['my.details'],'class'=>'checkout_form','files' => true]) !!}
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="fa-border ">
                        <img src="{{asset('img/user/'.$user->avatar)}}" id="avatar" name="avatar" class="show_img">
                    </div>
                    {!! Form::file('image', array('id'=> 'user_image', 'class' => 'image')) !!}
                </div>
                <div class="col-md-9">
                    <div class=" col-md-12">
                            <input type="text" name="user_id" id="user_id" value="{{$user->id}}"
                                   class="hidden_field">
                            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                                <input type="text" name="first_name" value="{{$user->first_name or ''}}"
                                       placeholder="First Name *" class="checkout-form-input">
                                {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            @if($user->middle_name)
                            <div class="form-group {{ $errors->has('middle_name') ? 'has-error' : ''}}">
                                <input type="text" name="middle_name"
                                       value="{{$user->middle_name or ''}}" placeholder="Middle Name"
                                       class="checkout-form-input">
                                {!! $errors->first('middle_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            @endif
                            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                                <input type="text" name="last_name" value="{{$user->last_name or ''}}"
                                       placeholder="Last Name *" class="checkout-form-input">
                                {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                <input type="text" name="email" value="{{$user->email or ''}}"
                                       placeholder="Email*" class="checkout-form-input" readonly="readonly">
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('contact_no') ? 'has-error' : ''}}">
                                <input type="text" name="contact_no" value="{{$user->contact_no or ''}}"
                                       placeholder="Mobile Phone" class="checkout-form-input">
                                {!! $errors->first('contact_no', '<span class="help-block">:message</span>') !!}
                            </div>
                            {!! Form::submit('Update', ['class' => 'btn btn-warning pull-right']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <br/>
        <br/>
    </section>
    @endsection