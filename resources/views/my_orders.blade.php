@extends('home_template')
@section('content')
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">My Orders</li>
            </ol>
        </div><!--/breadcrums-->
        <div class="row">
            <div class="table-responsive ">
                @if(count($my_order))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($my_order as $order)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{$order->created_at->format('d M,Y')}}</td>
                                <td>{{'ORD'.str_pad($order->id, 4, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$order->grand_total}}</td>
                                <td>{{($order->status == 'O') ? 'Processing' : 'Pending' }}</td>
                                <td>{{($order->payment_gateway_id == 1) ? 'COD' : 'Paypal'}}</td>
                                <td><a href="{{route('my.order',$order->id)}}">Check</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span class="pull-right">{!! $my_order->links() !!}</span>

                @else
                    <div>
                        <br/>
                        <p class="text-center"><strong>You have not yet order anything from our site.</strong></p>
                        <br/>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection