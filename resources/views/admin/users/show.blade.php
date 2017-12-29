@extends('admin.admin_template')
@section('content')
        <div class="row">
           {{-- @include('admin.sidebar')--}}

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">User : {{ $user->first_name }} {{ $user->first_name }}</div>
                    <div class="  panel-body">

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $user->id }}</td>
                                    </tr>
                                    <tr><th> First Name </th>
                                        <td> {{ $user->first_name }} </td>
                                    </tr>
                                    <tr><th> Last Name </th>
                                        <td> {{ $user->last_name }} </td>
                                    </tr>
                                    <tr><th> Email </th>
                                        <td> {{ $user->email }} </td>
                                    </tr>
                                   <tr><th> Role </th>
                                        <td> {{ $user->role->name}} </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <div class="col-md-offset-4">
                          <a href="{{ url('/admin/users') }}" class="btn btn-danger">Cancle</a>
                        </div>
                    </div>
                </div>
    </div>
@endsection
