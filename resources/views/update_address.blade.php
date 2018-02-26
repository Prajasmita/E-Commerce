<script src="{{asset('js/script.js')}}"></script>
<script>

    $(document).ready(function () {
        $('#edit_Modal').modal();

        /*Function For Updating New Address*/
        $(".update_address").click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                type: "POST",
                url: addressUpdateUrl,
                data: $("#edit_address").serialize(),
                success: function (data) {
                    if (data.message) {
                        if (confirm(data.message)) {
                            window.location = base_url +'/'+data.redirecturl;
                        }
                    }

                    if (data.errors) {
                        var error = data.errors;
                        $.each(error, function (key, value) {
                            $("#errors").append("<span class=\"require \">" + value + "</span><br/>");
                        });
                    }
                }
            });
        });
    });

</script>

<div class="modal fade" id="edit_Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">User address</h4>
            </div>
            <div class="modal-body">
                <div class="has-error" id="errors">

                </div>
                <form id="edit_address" class="checkout_form" method="POST" action="#">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <input type="text" name="id" value="{{$user_address->id}}" class="hidden_field">
                                <input type="text" name="company_name" id="company_name"
                                       value="{{$user_address['company_name']}}" placeholder="Company Name"
                                       class="checkout-form-input">
                                <input type="text" name="email" value="{{$user_address->email}}" placeholder="Email*"
                                       class="checkout-form-input">
                                <input type="text" name="title" value="{{$user_address->title}}" placeholder="Title"
                                       class="checkout-form-input">
                                <input type="text" name="first_name" value="{{$user_address->first_name}}"
                                       placeholder="First Name *" class="checkout-form-input">
                                <input type="text" name="middle_name" value="{{$user_address->middle_name}}"
                                       placeholder="Middle Name" class="checkout-form-input">
                                <input type="text" name="last_name" value="{{$user_address->last_name}}"
                                       placeholder="Last Name *" class="checkout-form-input">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="address1" value="{{$user_address->address1}}"
                                       placeholder="Address 1 *" class="checkout-form-input">
                                @if($user_address->address2)
                                    <input type="text" name="address2" value="{{$user_address->address2}}"
                                           placeholder="Address 2" class="checkout-form-input">
                                @endif
                                <input type="text" name="city" value="{{$user_address->city}}" placeholder="City *"
                                       class="checkout-form-input">
                                <input type="text" name="zip_code" value="{{$user_address->zip_code}}"
                                       placeholder="Zip / Postal Code *" class="checkout-form-input">
                                <select name="country" class="checkout-form-input select-country">
                                    @foreach($countries as $country)
                                        <option value="{{ ($country->name) ? $country->id : '' }}" {{ ($user_address->country == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>

                                <select name="state" class="checkout-form-input select-state">
                                    @php $country_id = ($country->name) ? $country->id : ''  @endphp
                                    @foreach($states as $state)
                                        <option value="{{ ($state->name) ? $state->id  : '' }}" {{ ($user_address->state == $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="contact_no" value="{{$user_address->contact_no}}"
                                       placeholder="Mobile Phone" class="checkout-form-input">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button class="btn btn-warning update_address" id="update_address">Update</button>
            </div>
        </div>
    </div>
</div>
