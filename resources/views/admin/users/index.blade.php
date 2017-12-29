@extends('admin.admin_template')

@section('content')
    @if ( session()->has('flash_message') )
        <div class="alert alert-success">{{ session()->get('flash_message') }}</div>
    @endif
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm" title="Add New User">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New User
                        </a>

                        <form method="GET" action="{{ url('/admin/users') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">

                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table id="example1"class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                       <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                            {{--<div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection

<script>
    var dataTableUrl = "{{route('users.index')}}";
    {{--var dataTableViewUrl = "{{url('admin/users')}}";--}}
    var dataTableViewUrl = "{{route('users.show',['id'])}}";

    var dataTableEditUrl = "{{route('users.edit',['id'])}}";

    var dataTableDeleteUrl = "{{route('users.destroy',['id'])}}";


</script>
