@extends('admin.admin_template')

@section('content')
    @if ( session()->has('template_message') )
        <div class="alert alert-success">{{ session()->get('template_message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Email Templates</strong></div>
                <div class="panel-body">
                    <a href="{{route('email_template.create')}}" class="btn btn-success btn-sm" title="Add New Banner">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New Email Template
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table id="template" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    var dataTableEmailTemplateUrl = "{{route('email.template')}}";
    var dataTableEmailTemplateViewUrl = "{{route('email_template.show',['id'])}}";

    var dataTableEmailTemplateEditUrl = "{{route('email_template.edit',['id'])}}";
</script>