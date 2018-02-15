@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Edit Configuration # {{ $configuration->conf_key }}</strong></div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <form method="POST" action="{{ url('/admin/configuration/' . $configuration->id) }}"
                          accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        @include ('admin.configuration.form', ['submitButtonText' => 'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
