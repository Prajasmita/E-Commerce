@extends('admin.admin_template')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Edit Coupon # {{ $coupon->code }}</strong></div>
                    <div class="panel-body">
                        <br />
                        <br />

                        {!! Form::open(['url' => url('/admin/coupons/' . $coupon->id)]) !!}

                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.coupons.form', ['submitButtonText' => 'Update'])

                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
    </div>
@endsection
