<?php $__env->startSection('content'); ?>
    <section id="cart_items">
        <div class="container">


            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->
            <div class="form-group">
                <?php if(count($cart)): ?>

                    <?php echo Form::open(['route' => ['order.store'],'class'=>'checkout_form']); ?>

                    <div class="shopper-informations">
                        <div class="row">
                            <div class="col-sm-6 clearfix">
                                <div class="bill-to">
                                    <p>Bill To</p>
                                    <div class=" col-sm-12">

                                        <div class="col-sm-6">
                                            <input type="text" name="user_id" id="user_id" value="<?php echo e($user_id); ?>"
                                                   class="hidden_field">

                                            <div class="form-group <?php echo e($errors->has('company_name') ? 'has-error' : ''); ?>">
                                                <input type="text" name="company_name" id="company_name"
                                                       value="<?php echo e(isset($user->company_name) ? $user->company_name : ''); ?>" placeholder="Company Name"
                                                       class="checkout-form-input">
                                                <?php echo $errors->first('company_name', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                            <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                                                <input type="text" name="email" value="<?php echo e(isset($user->email) ? $user->email : ''); ?>"
                                                       placeholder="Email*" class="checkout-form-input">
                                                <?php echo $errors->first('email', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                            <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                                                <input type="text" name="title" value="<?php echo e(isset($user->title) ? $user->title : ''); ?>"
                                                       placeholder="Title" class="checkout-form-input">
                                                <?php echo $errors->first('title', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                            <div class="form-group <?php echo e($errors->has('first_name') ? 'has-error' : ''); ?>">
                                                <input type="text" name="first_name" value="<?php echo e(isset($user->first_name) ? $user->first_name : ''); ?>"
                                                       placeholder="First Name *" class="checkout-form-input">
                                                <?php echo $errors->first('first_name', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                            <div class="form-group <?php echo e($errors->has('middle_name') ? 'has-error' : ''); ?>">
                                                <input type="text" name="middle_name"
                                                       value="<?php echo e(isset($user->middle_name) ? $user->middle_name : ''); ?>" placeholder="Middle Name"
                                                       class="checkout-form-input">
                                                <?php echo $errors->first('middle_name', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                            <div class="form-group <?php echo e($errors->has('last_name') ? 'has-error' : ''); ?>">
                                                <input type="text" name="last_name" value="<?php echo e(isset($user->last_name) ? $user->last_name : ''); ?>"
                                                       placeholder="Last Name *" class="checkout-form-input">
                                                <?php echo $errors->first('last_name', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                            <div class="form-group <?php echo e($errors->has('address1') ? 'has-error' : ''); ?>">
                                                <input type="text" name="address1" value="<?php echo e(isset($user->address1) ? $user->address1 : ''); ?>"
                                                       placeholder="Address 1 *" class="checkout-form-input">
                                                <?php echo $errors->first('address1', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                            <div class="form-group <?php echo e($errors->has('address2') ? 'has-error' : ''); ?>">
                                                <input type="text" name="address2" value="<?php echo e(isset($user->address2) ? $user->address2 : ''); ?>"
                                                       placeholder="Address 2" class="checkout-form-input">
                                                <?php echo $errors->first('address2', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                            <div class="form-group <?php echo e($errors->has('city') ? 'has-error' : ''); ?>">
                                                <input type="text" name="city" value="<?php echo e(isset($user->city) ? $user->city : ''); ?>"
                                                       placeholder="City *" class="checkout-form-input">
                                                <?php echo $errors->first('city', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group <?php echo e($errors->has('zip_code') ? 'has-error' : ''); ?>">
                                                <input type="text" name="zip_code" value="<?php echo e(isset($user->zip_code) ? $user->zip_code : ''); ?>"
                                                       placeholder="Zip / Postal Code *" class="checkout-form-input">
                                                <?php echo $errors->first('zip_code', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                            <select name="country" class="checkout-form-input select-country">
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e(isset($country->id) ? $country->id : ''); ?>" <?php echo e($user ? (($user->country == $country->id) ? 'selected' : '') : ''); ?>><?php echo e($country->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <select name="state" class="checkout-form-input select-state">
                                                <?php $country_id = ($country->name) ? $country->id : ''  ?>
                                                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e(isset($state->id) ? $state->id : ''); ?>" <?php echo e($user ? (($user->state == $state->id) ? 'selected' : '') : ''); ?>><?php echo e($state->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="form-group <?php echo e($errors->has('contact_no') ? 'has-error' : ''); ?>">
                                                <input type="text" name="contact_no" value="<?php echo e(isset($user->contact_no) ? $user->contact_no : ''); ?>"
                                                       placeholder="Mobile Phone" class="checkout-form-input">
                                                <?php echo $errors->first('contact_no', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="order-message">
                                    <p>Shipping Order</p>
                                    <textarea name="message"
                                              placeholder="Notes about your order, Special Notes for Delivery"
                                              rows="16"></textarea>
                                    <label><input type="checkbox"> Shipping to bill address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="review-payment">
                        <h2>Review & Payment</h2>
                    </div>

                    <div class="table-responsive cart_info">
                        <?php $total = 0 ?>
                        <table class="table table-condensed no-item">
                            <thead>
                            <tr class="cart_menu">
                                <td class="image">Item</td>
                                <td class="description"></td>
                                <td class="price">Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php $total += $cartItem->subtotal ?>
                                <tr id="cart_product_<?php echo e($cartItem->id); ?>">
                                    <td class="cart_product">
                                        <a href="#"><img class="index_img"
                                                         src="<?php echo e(asset('img/product/'.$cartItem->options->image)); ?>"
                                                         alt=""></a>
                                    </td>
                                    <td class="cart_description hidden">
                                        <h4><a href=""><?php echo e($cartItem->rowId); ?></a></h4>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href=""><?php echo e($cartItem->name); ?></a></h4>
                                    </td>
                                    <td class="cart_price">
                                        <p>$<?php echo e($cartItem->price); ?></p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button" id="<?php echo e("qty_".$cartItem->id); ?>"
                                             data-quantity="<?php echo e($cartItem->qty); ?>" data-id="<?php echo e($cartItem->id); ?>"
                                             data-rowid="<?php echo e($cartItem->rowId); ?>" data-price=<?php echo e($cartItem->price); ?>>
                                            <input type="text" class="qty cart_quantity_input" name="quantity"
                                                   value="<?php echo e($cartItem->qty); ?>" min="1" size="2" id="number" readonly/>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p id=<?php echo e("subtotal_".$cartItem->id); ?> class="cart_total_price">
                                            $<?php echo e($cartItem->subtotal); ?></p>
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td>
                                    <div class="input-group ">
                                        <?php echo Form::text('Coupon Code',null,['id' => 'coupon_input','class' => 'form-control']);; ?>


                                        <span class="input-group-btn" id="coupon_button">
                                                <button class="btn btn-sm" type="button" id="apply_coupon"
                                                        data-total="<?php echo e($total); ?>"><i class="glyphicon glyphicon-ok "></i></button>
                                        </span>
                                    </div>
                                </td>
                                <td colspan="4">&nbsp;</td>
                                <td colspan="2">
                                    <table class="table table-condensed total-result order-amount">
                                        <tr>
                                            <td>Cart Sub Total</td>
                                            <td id="total" data-total="<?php echo e($total); ?>"><?php echo e("$".$total); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Discount</td>
                                            <?php $discount = 0 ?>
                                            <td id="discount"><?php echo e($discount); ?></td>
                                        </tr>
                                        <tr class="shipping-cost">
                                            <?php $shipping_Tax = config('constants.shipping_Tax');?>
                                            <td>Shipping Cost</td>
                                            <?php  $shipping_cost = ($total < 500 ? $shipping_Tax : 0) ?>
                                            <td id="shipping_cost"
                                                data-shipping_cost="<?php echo e($shipping_cost); ?>"><?php echo e($shipping_cost== 0 ?  "Free" : "$".$shipping_cost); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <?php $finalTotal = $total + ($shipping_cost == "Free" ? 0 : $shipping_Tax) + $discount ?>
                                            <td id="finalTotal" data-finalTotal="<?php echo e($finalTotal); ?>">
                                                <span><?php echo e("$".$finalTotal); ?></span></td>
                                        </tr>
                                        <input type="text" name="coupon" class="hidden_field" value="0">
                                        <input type="text" name="grand_total" class="hidden_field"
                                               value="<?php echo e($finalTotal); ?>">
                                        <input type="text" name="shipping_charge" class="hidden_field"
                                               value="<?php echo e($shipping_cost); ?>">
                                        <input type="text" name="discount" class="hidden_field" value="<?php echo e($discount); ?>">

                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>



                    <div class="col-sm-4 pull-left payment-options">

                        <div class="form-group <?php echo e($errors->has('payment_gateway') ? 'has-error' : ''); ?>">
                            <div class="col-md-6">
                                <input name="payment_gateway" value=1 type="radio" id="cod" data-pg="1" }}>COD
                                <input name="payment_gateway" value=2 type="radio" class="payment_gateway" id="paypal"
                                       data-pg="2" }}>Paypal
                                <?php echo $errors->first('payment_gateway', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>

                    </div>
                    <div>
                        <?php echo Form::submit('Proceed', ['class' => 'btn btn-warning pull-right']); ?>

                    </div>
                    <?php echo Form::close(); ?>

            </div>
            <?php else: ?>
                <div>
                    <br/>
                    <p class="text-center"><strong>You Have No Items In The Shopping Cart.Buy Something For
                            Checkout.</strong></p>
                    <br/>
                </div>

            <?php endif; ?>
        </div>


    </section> <!--/#cart_items-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>