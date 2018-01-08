@extends('admin.admin_template')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Products</strong></div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/products/create') }}" class="btn btn-success btn-sm" title="Add New Product">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Product
                        </a>

                        <br/>
                        <br/>


                        <div class="table-responsive">
                            <table id="product" class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Product Name</th><th>Image</th><th>Price</th><th>Actions</th>
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
    </div>
@endsection
<script>

    var dataTableProductUrl = "{{route('products.index')}}";
            {{--var dataTableViewUrl = "{{url('admin/users')}}";--}}
    var dataTableProductViewUrl = "{{route('products.show',['id'])}}";

    var dataTableProductEditUrl = "{{route('products.edit',['id'])}}";

    var dataTableProductDeleteUrl = "{{route('products.destroy',['id'])}}";

    var productPath = "{{config('constants.product_path')}}";

</script>
