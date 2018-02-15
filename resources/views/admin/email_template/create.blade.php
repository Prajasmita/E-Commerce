@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Create New Email Template</strong></div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    {!! Form::open(['route'=>'email_template.store' ,'class'=>'form-horizontal']) !!}
                    {{ csrf_field() }}
                    @include ('admin.email_template.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
