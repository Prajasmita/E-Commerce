@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading col-md-10"><strong>Banner Name : {{ $banner->banner_name }}</strong></div>
                <div class="panel-heading col-md-2">
                    <a href="{{ route('banners.edit',$banner->id) }}" class="btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <a href="{{ url('/admin/banners') }}" class="btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <tbody>
                            <tr>
                                <td class="col-sm-4" rowspan="3">
                                    <img class="show_img" src="{{asset('img/banner/'.$banner->banner_image)}}">
                                </td>
                            </tr>
                            <tr>
                                <th> Banner Name</th>
                                <td> {{ $banner->banner_name }} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
