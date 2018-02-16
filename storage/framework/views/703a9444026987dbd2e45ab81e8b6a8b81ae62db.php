<script>
    $(document).ready(function() {
        $('#add_Modal').modal();

        /*Function For Saving New Address*/

        $( ".save_address" ).click(function(e) {
            e.preventDefault();
            //console.log('hello');

            //console.log($(that).serialize());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                type: "POST",
                url: addressStoreUrl,
                data: $("#add_address").serialize(),
                success: function(data) {
                   //  console.log(data.message);exit;
                    if(data.message){
                        if(confirm(data.message)) {
                            window.location = base_url+data.redirecturl;
                        }
                    }

                    if(data.errors){
                        var error = data.errors;
                        $.each(error, function(key, value) {
                            $("#errors").append("<span class=\"require \">"+value+"</span><br/>");
                        });
                    }
                }
            });


            return false;
        });

    });

</script>
<div class="modal fade" id="add_Modal" role="dialog">
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
                <form id="add_address" class="checkout_form" method="POST" action="#">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <input type="text" name="user_id" value="<?php echo e(Auth::user()->id); ?>" id="user_id" class="hidden_field">
                                <input type="text" name="company_name" id="company_name" placeholder="Company Name" class="checkout-form-input">
                                <input type="text" name="email" placeholder="Email*" class="checkout-form-input">
                                <input type="text" name="title" placeholder="Title" class="checkout-form-input">
                                <input type="text" name="first_name" placeholder="First Name *" class="checkout-form-input">
                                <input type="text" name="middle_name" placeholder="Middle Name" class="checkout-form-input">
                                <input type="text" name="last_name" placeholder="Last Name *" class="checkout-form-input">
                                </div>
                            <div class="col-sm-6">
                                <input type="text" name="address1" placeholder="Address 1 *" class="checkout-form-input">
                                <input type="text" name="address2" placeholder="Address 2" class="checkout-form-input">
                                <input type="text" name="city" placeholder="City" class="checkout-form-input">
                                <input type="text" name="zip_code" placeholder="Zip / Postal Code *" class="checkout-form-input">
                                <select name="country" class="checkout-form-input select-country">
                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <select name="state" class="checkout-form-input select-state">
                                    <?php $country_id = ($country->name) ? $country->id : ''  ?>
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <input type="text" name="contact_no" placeholder="Mobile Phone" class="checkout-form-input">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button class="btn btn-warning save_address" id="save_address">Save</button>
            </div>
        </div>
    </div>
</div>

