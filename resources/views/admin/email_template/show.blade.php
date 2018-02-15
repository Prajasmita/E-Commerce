@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading col-md-11"><strong>Email Template : {{ $template->title }}</strong></div>
                <div class="panel-heading col-md-1">
                    <a href="{{route('email.template')}}" class="btn-sm btn-primary">Back</a>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <div class="table-responsive ">
                        <table class="table fa-border">
                            <tbody>
                            <tr>
                                <th> Title</th>
                                <td> {{ $template->title }} </td>
                            </tr>
                            <tr>
                                <th> Subject</th>
                                <td> {{ $template->subject }} </td>
                            </tr>
                            <tr>
                                <th> Content</th>
                                <td> {!! $template->content   !!}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
