@extends('admin.admin_template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading col-md-10"><strong>User
                        Name: {{ $user->first_name }} {{ $user->last_name }}</strong></div>
                <div class="panel-heading col-md-2">
                    <a href="{{ route('users.edit',$user->id) }}" class="btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <a href="{{ url('/admin/users') }}" class="btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>

                            <tr>
                                <th> First Name</th>
                                <td> {{ $user->first_name }} </td>
                            </tr>
                            <tr>
                                <th> Last Name</th>
                                <td> {{ $user->last_name }} </td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> {{ $user->email }} </td>
                            </tr>
                            <tr>
                                <th> Role</th>
                                <td> {{ $user->role->name}} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
