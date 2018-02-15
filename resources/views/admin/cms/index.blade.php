@extends('admin.admin_template')

@section('content')
    @if ( session()->has('flash_message') )
        <div class="alert alert-success">{{ session()->get('flash_message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading bold"><strong>Content Management System</strong></div>
                <div class="panel-body">
                    <a href="{{ url('/admin/cms/create') }}" class="btn btn-success btn-sm" title="Add New Banner">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New content
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table id="cms" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Actions</th>
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

    var dataTableCmsUrl = "{{route('cms.index')}}";

    var dataTableCmsViewUrl = "{{route('cms.show',['id'])}}";

    var dataTableCmsEditUrl = "{{route('cms.edit',['id'])}}";

    var dataTableCmsDeleteUrl = "{{route('cms.destroy',['id'])}}";
</script>
