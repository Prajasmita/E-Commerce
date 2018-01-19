@extends('admin.admin_template')

@section('content')
    @if ( session()->has('flash_message') )
        <div class="alert alert-success">{{ session()->get('flash_message') }}</div>
    @endif
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Categories</strong></div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/categories/create') }}" class="btn btn-success btn-sm" title="Add New Category">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Category
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table id='categories' class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Parent Category </th>
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
<script type="text/javascript">
    var dataTableCatUrl = "{{route('categories.index')}}";
            {{--var dataTableViewUrl = "{{url('admin/categories')}}";--}}
    var dataTableCatViewUrl = "{{route('categories.show',['id'])}}";

    var dataTableCatEditUrl = "{{route('categories.edit',['id'])}}";

    var dataTableCatDeleteUrl = "{{route('categories.destroy',['id'])}}";
</script>
