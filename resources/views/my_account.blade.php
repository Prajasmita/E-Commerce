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
        </div>
    </section>

    @endsection