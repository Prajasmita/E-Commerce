@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading col-md-11"><strong>Configuration : {{ $configuration->conf_key }}</strong>
                </div>
                <div class="panel-heading col-md-1">
                    <a href="{{ url('/admin/configuration') }}" class="btn-sm btn-primary">Back</a>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th> Conf Key</th>
                                <td> {{ $configuration->conf_key }} </td>
                            </tr>
                            <tr>
                                <th> Conf Value</th>
                                <td> {{ $configuration->conf_value }} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
