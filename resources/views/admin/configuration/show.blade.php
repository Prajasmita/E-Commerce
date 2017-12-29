@extends('admin.admin_template')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Configuration {{ $configuration->id }}</div>
                    <div class="panel-body">

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $configuration->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Conf Key </th>
                                        <td> {{ $configuration->conf_key }} </td>
                                    </tr>
                                    <tr>
                                        <th> Conf Value </th>
                                        <td> {{ $configuration->conf_value }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-offset-4">
                            <a href="{{ url('/admin/configuration') }}" class="btn btn-danger">Cancle</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
