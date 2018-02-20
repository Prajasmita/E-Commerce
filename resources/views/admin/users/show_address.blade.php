@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading col-md-11"><strong>User
                            Address</strong></div>
                <div class="panel-heading col-md-1">
                    <a href="{{ url('/admin/users') }}" class="btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>

                @if(count($userAddress))
                <div class="panel-body">
                @foreach($userAddress as $user_address)
                    <div>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td><strong>
                                                <h4>{{$user_address->first_name}} {{ $user_address->middle_name ? $user_address->middle_name  : ''}} {{$user_address->last_name}}
                                                    </h4></strong></td>
                                    </tr>
                                    <tr>
                                        <td> {{$user_address->email}} , {{$user_address->contact_no}}</td>
                                    </tr>
                                    <tr>
                                        <td> {{$user_address->address1}}
                                            , {{$user_address->address2 ? $user_address->address2.',' : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td> {{$user_address->city}} , {{$user_address->zip_code}}
                                            , {{$user_address->states->name}}</td>
                                    </tr>
                                    <tr>
                                        <td> {{$user_address->countries->name}}</td>
                                        <td>{{ $user_address->primary ? 'Primary' : '' }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </div>
                    <br/>
                @endforeach
                </div>
                @else
                        <div>
                            <br/>
                            <br/>
                            <h3 class="text-center"><strong>No address added.</strong></h3>
                        </div>
                @endif
            </div>
        </div>
    </div>

    @endsection


