@extends('admin.admin_template')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading col-md-11"><strong>Category: {{ $category->name }}</strong></div>
                    <div class="panel-heading col-md-1">
                        <a href="{{ url('/admin/categories') }}" class="btn-sm btn-primary">Back</a>
                    </div>
                    <div class="panel-body">

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>

                                    <tr><th> Name </th><td> {{ $category->name }} </td></tr>
                                    <tr><th> Category Name </th><td> {{ $category->pname == '' ? 'Parent Category' : $category->pname }}  </td></tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
