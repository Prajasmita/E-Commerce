@extends('home_template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive ">
                @if(count($order))
                <table class="table">
                    <thead>
                    <tr>
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