@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class=" panel panel-default">
                <div class="col-md-10 panel-heading"><strong>Name : {{ $product_data->product_name }}</strong></div>
                <div class="col-md-2 panel-heading">
                    <a href="{{ route('products.edit',$product_data->id) }}" class="btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <a href="{{ url('/admin/products') }}" class="btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="col-sm-4" rowspan="6">
                                    <img class="show_img"
                                         src="{{asset('img/product/'.$product_data['image_products'])}}">
                                </td>
                            </tr>
                            <tr>
                                <th> Product Name &nbsp;</th>
                                <td> {{ $product_data->product_name }} </td>
                            </tr>
                            <tr>
                                <th>Sku &nbsp;</th>
                                <td>{{ $product_data->sku }}</td>
                            </tr>
                            <tr>
                                <th> Price &nbsp;</th>
                                <td> ${{ $product_data->price }} </td>
                            </tr>
                            <tr>
                                <th> Category &nbsp;</th>
                                <td>
                                    @foreach($product_data->category_product as $key=>$cat)
                                        @if($key > 0)
                                            {{'>>'}}
                                        @endif
                                        {{ $cat->category->name }}

                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th> Discription &nbsp;</th>
                                <td> {{ $product_data->long_discription }} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
