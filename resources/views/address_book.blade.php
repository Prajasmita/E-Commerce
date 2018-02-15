@extends('home_template')
@section('content')
    <div class="container">
        @if ( session()->has('message') )
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        <div class="col-sm-4 pull-right">
            <button type="button" id="add" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>
                Add New Address
            </button>
        </div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-sm-12">
                @foreach($userAddress as $user_address)
                    <div class="fa-border">
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td><strong>
                                                <h4>{{$user_address->first_name}} {{ $user_address->middle_name ? $user_address->middle_name  : ''}} {{$user_address->last_name}}
                                                    <h4><strong></td>
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
                                        <td><input name="primary" class="primary_address"
                                                   data-id="{{$user_address->id}}" type="checkbox"
                                                   id="primary_{{$user_address->id}}" {{ $user_address->primary ? 'checked' : '' }}>
                                        </td>
                                        <td class="primary_{{$user_address->id}}">{{ $user_address->primary ? 'Primary' : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm edit_address"
                                                    id="edit_address" data-id="{{$user_address->id}}"><i
                                                        class=" glyphicon glyphicon-pencil">Edit</i></button>
                                            @if(!$user_address->primary)
                                                <a href="{{route('address.delete',$user_address->id)}}" type="button"
                                                   class="btn btn-danger btn-sm delete_address" id="delete_address"
                                                   data-id="{{$user_address->id}}"><i
                                                            class=" glyphicon glyphicon-trash">Delete</i></a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </div>
                    <br/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
<div id="load_modal_add">
</div>
<div id="load_modal_edit">
</div>

