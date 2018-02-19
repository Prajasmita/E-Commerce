@extends('admin.admin_template')

@section('content')
    @if ( session()->has('flash_message') )
        <div class="alert alert-success">{{ session()->get('flash_message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Configuration</strong></div>
                <div class="panel-body">
                    <a href="{{ url('/admin/configuration/create') }}" class="btn btn-success btn-sm"
                       title="Add New Configuration">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New Configuration
                    </a>
                    <form method="GET" action="{{ url('/admin/configuration') }}" accept-charset="UTF-8"
                          class="navbar-form navbar-right" role="search">
                    </form>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table id="configuration" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Conf Key</th>
                                <th>Conf Value</th>
                                <th>Status</th>
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

    var dataTableConfUrl = "{{route('configuration.index')}}";
            {{--var dataTableViewUrl = "{{url('admin/users')}}";--}}
    var dataTableConfViewUrl = "{{route('configuration.show',['id'])}}";

    var dataTableConfEditUrl = "{{route('configuration.edit',['id'])}}";

    var dataTableConfDeleteUrl = "{{route('configuration.destroy',['id'])}}";
</script>
