@extends('home_template')
@section('content')
    <section id="form"><!--form-->
        <div class="container">
            @if ( session()->has('flash_message') )
                <div class="alert alert-success">{{ session()->get('flash_message') }}</div>
            @endif
                @if ( session()->has('login_error') )
                    <div class="alert alert-danger">{{ session()->get('login_error') }}</div>
                @endif
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="{{ route('user_login') }}" method="post">

                            <div class="form-group has-feedback">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <input id="email" type="email" class="form-control" placeholder="Email" name="email"
                                           value="{{ old('email') }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <input id="password" type="password" class="form-control" placeholder="Password"
                                           name="password" value="{{ old('password') }}" autofocus>
                                </div>
                            </div>


                            <span><input id="remember" type="checkbox" class="field login-checkbox" name="remember" readonly
                                value="First Choice" tabindex="4">
                                        <label class="choice" for="remember">Keep me signed in</label></span>
                            <div class="login-box">
                                <div class="form-group form-actions">
                                    <button type="submit" class="btn btn-default">Login</button>
                                </div>
                                <span><a href="{{route('forget.password')}}">Forget Password ?</a></span>
                            </div>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form name='form_register' class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->form_register->has('first_name') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input id="first_name" type="text" class="form-control" name="first_name"
                                           placeholder="First Name" value="{{ old('first_name') }}">

                                    @if ($errors->form_register->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->form_register->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->form_register->has('last_name') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                           placeholder="Last Name" value="{{ old('last_name') }}">

                                    @if ($errors->form_register->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->form_register->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->form_register->has('email') ? ' has-error' : '' }}">

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email"
                                           placeholder="Email Address" value="{{ old('email') }}">

                                    @if ($errors->form_register->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->form_register->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->form_register->has('password') ? ' has-error' : '' }}">

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" placeholder="Password"
                                           name="password">

                                    @if ($errors->form_register->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->form_register->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->form_register->has('contact_no') ? ' has-error' : '' }}">

                                <div class="col-md-12">
                                    <input id="contact_no" type="text" class="form-control" placeholder="Contact No."
                                           name="contact_no">

                                    @if ($errors->form_register->has('contact_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->form_register->first('contact_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
