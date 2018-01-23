<script>
    $(document).ready(function() {
            $('#add_Modal').modal();
    });

</script>
<div class="modal fade" id="add_Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {!! Form::open(['route' => ['address.store'],'class'=>'checkout_form']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">User address</h4>
            </div>
            <div class="modal-body">
                   <div class=" col-sm-12">
                       <div class="col-sm-6">
                           <input type="text" name="user_id" id="user_id" class="hidden_field">
                           <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                               <input type="text" name="company_name" id="company_name" placeholder="Company Name" class="checkout-form-input">
                               {!! $errors->first('company_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                               <input type="text" name="email" placeholder="Email*" class="checkout-form-input">
                               {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                               <input type="text" name="title" placeholder="Title" class="checkout-form-input">
                               {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                               <input type="text" name="first_name" placeholder="First Name *" class="checkout-form-input">
                               {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->has('middle_name') ? 'has-error' : ''}}">
                               <input type="text" name="middle_name" placeholder="Middle Name" class="checkout-form-input">
                               {!! $errors->first('middle_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                               <input type="text" name="last_name" placeholder="Last Name *" class="checkout-form-input">
                               {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->has('address1') ? 'has-error' : ''}}">
                               <input type="text" name="address1" placeholder="Address 1 *" class="checkout-form-input">
                               {!! $errors->first('address1', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->has('address2') ? 'has-error' : ''}}">
                               <input type="text" name="address2" placeholder="Address 2" class="checkout-form-input">
                               {!! $errors->first('address2', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                               <input type="text" name="city" placeholder="City" class="checkout-form-input">
                               {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
                           </div>
                       </div>

                       <div class="col-sm-6">
                           <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : ''}}">
                               <input type="text" name="zip_code" placeholder="Zip / Postal Code *" class="checkout-form-input">
                               {!! $errors->first('zip_code', '<span class="help-block">:message</span>') !!}
                           </div>
                           <select name="country" class="checkout-form-input select-country">
                               @foreach($countries as $country)
                                   <option>{{ $country->name }}</option>
                               @endforeach
                           </select>

                           <select name="state" class="checkout-form-input select-state">
                               @php $country_id = ( $country->name ) ? $country->id : ''  @endphp
                               @foreach($states as $state)
                                   <option value="{{ ($state->name) ? $state->id  : '' }}" >{{ $state->name }}</option>
                               @endforeach
                           </select>
                           <div class="form-group {{ $errors->has('contact_no') ? 'has-error' : ''}}">
                               <input type="text" name="contact_no" placeholder="Mobile Phone" class="checkout-form-input">
                               {!! $errors->first('contact_no', '<span class="help-block">:message</span>') !!}
                           </div>
                       </div>
                   </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                {!! Form::submit('Save', ['class' => 'btn btn-warning','id' => 'save_address']) !!}
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>

