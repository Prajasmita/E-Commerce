@extends('home_template')
@section('content')
    @if ( session()->has('query_message') )
        <div class="alert alert-success">{{ session()->get('query_message') }}</div>
    @endif
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Contact <strong>Us</strong></h2>
                   {{-- <div id="gmap" class="contact-map">
                    </div>--}}
                </div>


            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Get In Touch</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        {!! Form::open(['route' => ['contact'],'class'=>'contact-form row']) !!}

                        {{ csrf_field() }}
                            <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : ''}}">
                                {!! Form::text('name','', array('class' => 'form-control','placeholder' => 'Name'));  !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('email') ? 'has-error' : ''}}">
                                {!! Form::text('email','', array('class' => 'form-control','placeholder' => 'Email'));  !!}
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('contact_no') ? 'has-error' : ''}}">
                                {!! Form::text('contact_no','', array('class' => 'form-control','placeholder' => 'Contact Number'));  !!}
                                {!! $errors->first('contact_no', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('subject') ? 'has-error' : ''}}">
                                {!! Form::text('subject','', array('class' => 'form-control','placeholder' => 'Subject'));  !!}
                                {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('message') ? 'has-error' : ''}}">
                                <textarea name="message" id="message"  class="form-control" rows="8" placeholder="Your Message Here"></textarea>
                                {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::submit('Submit', ['class' => 'btn btn-warning pull-right']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <p>E-Shopper Inc.</p>
                            <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                            <p>Newyork USA</p>
                            <p>Mobile: +2346 17 38 93</p>
                            <p>Fax: 1-714-252-0026</p>
                            <p>Email: info@e-shopper.com</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Social Networking</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/#contact-page-->


@endsection