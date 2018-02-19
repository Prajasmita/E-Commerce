@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading col-md-10"><strong>Email Template : {{ $template->title }}</strong></div>
                <div class="panel-heading col-md-2">
                    <a href="{{ route('email_template.edit',$template->id) }}" class="btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <a href="{{route('email.template')}}" class="btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
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
