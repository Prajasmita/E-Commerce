@extends('admin.admin_template')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Category: {{ $category->name }}</div>
                    <div class="panel-body">

                    
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $category->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $category->name }} </td></tr>
                                    <tr><th> Category Name </th><td> {{ $category->pname == '' ? 'Parent Category' : $category->pname }}  </td></tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-offset-4">
                            <a href={{ url('/admin/categories') }} class="btn btn-danger">Cancle</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
