@extends('admin.admin_template')

@section('content')
    @if ( session()->has('flash_message') )
        <div class="alert alert-success">{{ session()->get('flash_message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Users</strong></div>
                <div class="panel-body">
                    <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm" title="Add New User">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New User
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table id="example1" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
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
    var dataTableUrl = "{{route('users.index')}}";

    var dataTableViewUrl = "{{route('users.show',['id'])}}";

    var dataTableEditUrl = "{{route('users.edit',['id'])}}";

    var dataTableDeleteUrl = "{{route('users.destroy',['id'])}}";

    var dataTableViewAddressUrl = "{{route('users.address',['id'])}}"

</script>
