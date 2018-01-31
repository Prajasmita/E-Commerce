@extends('admin.admin_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong># Admin Note</strong></div>
                <div class="panel-body">
                    @if ( session()->has('admin_note') )
                        <div class="alert alert-success">{{ session()->get('admin_note') }}</div>
                    @endif
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="login-form">
                            <h2>{{$query_data->subject}}</h2>
                            {!! Form::open(['route' => 'admin_note.save']) !!}
                            {{ csrf_field() }}
                            <input type="text" name="id" id="id" value="{{$query_data->id}}" class="hidden_field">

                            <div class="form-group has-feedback">
                                <div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
                                    {!! Form::text('message',$query_data->message, array('class' => 'form-control','readonly'=> 'readonly'));  !!}
                                    {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="form-group {{ $errors->has('note_admin') ? 'has-error' : ''}}">

                                    <textarea name="note_admin" class="form-control" id="ckeditor-note" placeholder="Admin Reply *"></textarea>
{{--
                                    {!! Form::textarea('note_admin','', array('id'=>'ckeditor-note','class' => 'form-control','placeholder'=>'Admin Reply *'));  !!}
--}}
                                    {!! $errors->first('note_admin', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="pull-right">
                                    {!! Form::submit('Save',array('class'=>'btn btn-primary')); !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>var dataTableContactAdminUrl = "{{route('contact.admin')}}";</script>
