@extends('admin.admin_template')

@section('content')
    @if ( session()->has('flash_message') )
        <div class="alert alert-success">{{ session()->get('flash_message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading bold"><strong>Banners</strong></div>
                <div class="panel-body">
                    <a href="{{ url('/admin/banners/create') }}" class="btn btn-success btn-sm" title="Add New Banner">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New Banner
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table id="banner" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Banner Name</th>
                                <th>Banner Image</th>
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

    var dataTableBannerUrl = "{{route('banners.index')}}";
            {{--var dataTableViewUrl = "{{url('admin/users')}}";--}}
    var dataTableBannerViewUrl = "{{route('banners.show',['id'])}}";

    var dataTableBannerEditUrl = "{{route('banners.edit',['id'])}}";

    var dataTableBannerDeleteUrl = "{{route('banners.destroy',['id'])}}";
</script>