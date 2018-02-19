@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading col-md-10"><strong>Coupon : {{ $coupon->code }}</strong></div>
                <div class="panel-heading col-md-2">
                    <a href="{{ route('coupons.edit',$coupon->id) }}" class="btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <a href="{{url('/admin/coupons/')}}" class="btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th> Code</th>
                                <td> {{ $coupon->code }} </td>
                            </tr>
                            <tr>
                                <th> Percent Off</th>
                                <td> {{ $coupon->percent_off }} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
