@extends('admin.admin_template')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="col-md-11 panel-heading"><strong>Edit Product #{{ $product->product_name }}</strong></div>
                    <div class="col-md-1 panel-heading">
                        <a href="{{ url('/admin/products') }}" class="btn-sm btn-primary">Back</a>
                    </div>
                    <div class="panel-body">
                        <br />
                        <br />
                        <form method="POST" action="{{ url('/admin/products/' . $product->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.products.form', ['submitButtonText' => 'Update'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
