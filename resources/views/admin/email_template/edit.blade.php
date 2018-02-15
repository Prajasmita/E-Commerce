@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Edit Email Template # {{ $template->title }}</strong></div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    {!! Form::open(['url' => url('/admin/email_template/' . $template->id)]) !!}
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    @include ('admin.email_template.form', ['submitButtonText' => 'Update'])
                    {!! Form::Close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
