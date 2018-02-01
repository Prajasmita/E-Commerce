@extends('admin.admin_template')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Create New Email Template</strong></div>
                <div class="panel-body">
                    <br />
                    <br />

                    {!! Form::open(['route'=>'email_template.store' ,'class'=>'form-horizontal']) !!}

{{--
                    <form method="POST" action="{{ }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
--}}
                        {{ csrf_field() }}

                        @include ('admin.email_template.form')

                    {!! Form::close() !!}
{{--
                    </form>
--}}

                </div>
            </div>
        </div>
    </div>
@endsection
