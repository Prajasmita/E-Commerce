@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Create New Product</strong></div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <form method="POST" action="{{ url('/admin/products') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include ('admin.products.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<!-- Datepicker -->
{{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}
