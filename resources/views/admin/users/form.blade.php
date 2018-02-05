

<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">

    <label for="first_name" class="col-md-4 control-label">{{ 'First Name' }}<span class="require">*</span></label>

    <div class="col-md-6">
        <input class="form-control" name="first_name" type="text" id="first_name" value="{{ $user->first_name or ''}}" >
        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">

    <label for="last_name" class="col-md-4 control-label">{{ 'Last Name' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="last_name" type="text" id="last_name" value="{{ $user->last_name or ''}}" >
        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">

    <label for="email" class="col-md-4 control-label">{{ 'Email' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" rows="5" name="email" type="email" id="email" value="{{ $user->email or ''}}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('contact_no') ? 'has-error' : ''}}">

    <label for="contact_no" class="col-md-4 control-label">{{ 'Contact No' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" rows="5" name="contact_no" type="text" id="contact_no" value="{{ $user->contact_no or ''}}">
        {!! $errors->first('contact_no', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">

    <label for="password" class="col-md-4 control-label">{{ 'Password' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="password" type="password" id="password" maxlength=12 >
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">

    <label for="status" class="col-md-4 control-label">{{ 'status' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input   name="status" value="1" type="radio" id="status" {{ isset( $user->status) ? $user->status == 1 ? 'checked' :'' : '' }}>Active
        <input  name="status" value="0" type="radio" id="status" {{ isset( $user->status) ? $user->status == 0 ? 'checked' :'' : '' }}>Inactive
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('role_id') ? 'has-error' : ''}}">

    <label for="role_id" class="col-md-4 control-label">{{ 'Role' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <select name="role_id" class="form-control" id="role_id" >

            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ (isset($user->role_id) && $user->role_id == $role->id) ? 'selected' : ''}}>{{ $role->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('role_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">

        <a href="{{ url('/admin/users') }}" class="btn btn-danger">Cancel</a>

    </div>
</div>
