@extends('admin.admin_template')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Banner #{{ $banner->banner_name }}</div>
                    <div class="panel-body">
                        <br />
                        <br />

                        <form method="POST" action="{{ url('/admin/banners/' . $banner->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.banners.form', ['submitButtonText' => 'Update'])

                        </form>

                    </div>
                </div>
            </div>
        </div>

@endsection
