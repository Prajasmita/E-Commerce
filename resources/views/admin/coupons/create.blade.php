@extends('admin.admin_template')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Coupon</div>
                    <div class="panel-body">
                        <br />
                        <br />

                        {!! Form::open(['url' => url('/admin/coupons')]) !!}
                        {{ csrf_field() }}
                        @include ('admin.coupons.form')
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
    </div>
@endsection
