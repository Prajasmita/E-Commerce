@extends('admin.admin_template')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Coupon {{ $coupon->id }}</div>
                    <div class="panel-body">
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $coupon->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $coupon->code }} </td></tr><tr><th> Percent Off </th><td> {{ $coupon->percent_off }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{url('/admin/coupons/')}}" class="btn btn-danger">Cancle</a>

                    </div>
                </div>
            </div>
    </div>
@endsection
