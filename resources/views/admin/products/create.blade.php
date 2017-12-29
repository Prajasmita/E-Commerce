@extends('admin.admin_template')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Product</div>
                    <div class="panel-body">
                        <br />
                        <br />
                        <form method="POST" action="{{ url('/admin/products') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.products.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
