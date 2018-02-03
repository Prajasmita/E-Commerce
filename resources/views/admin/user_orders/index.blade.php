@extends('admin.admin_template')

@section('content')
    @if ( session()->has('template_message') )
        <div class="alert alert-success">{{ session()->get('template_message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>User Orders</strong></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="user_orders" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Order Id</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Action</th>
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
    var dataTableUserOrderUrl = "{{route('user.orders')}}";
    var dataTableUserOrderDetail = "{{route('order.details',['id'])}}";
</script>
