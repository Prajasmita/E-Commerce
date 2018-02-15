@extends('admin.admin_template')

@section('content')
    @if ( session()->has('flash_message') )
        <div class="alert alert-success">{{ session()->get('flash_message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Coupons</strong></div>
                <div class="panel-body">
                    <a href="{{ url('/admin/coupons/create') }}" class="btn btn-success btn-sm" title="Add New Coupon">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New Coupon
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table id="coupons" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Percent Off</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    var dataTableCouUrl = "{{route('coupons.index')}}";
            {{--var dataTableViewUrl = "{{url('admin/users')}}";--}}
    var dataTableCouViewUrl = "{{route('coupons.show',['id'])}}";

    var dataTableCouEditUrl = "{{route('coupons.edit',['id'])}}";

    var dataTableCouDeleteUrl = "{{route('coupons.destroy',['id'])}}";

</script>
