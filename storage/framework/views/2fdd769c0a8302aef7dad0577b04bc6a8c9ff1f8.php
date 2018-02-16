<?php $__env->startSection('content'); ?>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">

                <?php if(count($cart)): ?>
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
                                    <h4><a href="<?php echo e(Auth::user() ? route('products.details',$cartItem->id) : route('register')); ?>"><?php echo e($cartItem->name); ?></a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>$<?php echo e($cartItem->price); ?></p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button" id="<?php echo e("qty_".$cartItem->id); ?>"
                                         data-quantity="<?php echo e($cartItem->qty); ?>" data-id="<?php echo e($cartItem->id); ?>"
                                         data-rowid="<?php echo e($cartItem->rowId); ?>" data-price=<?php echo e($cartItem->price); ?>>
                                        <a class="minus cart_quantity_down qty"> - </a>
                                        <input type="text" class="qty cart_quantity_input" name="quantity"
                                               value="<?php echo e($cartItem->qty); ?>" min="1" size="2" id="number" readonly/>
                                        <a class="plus cart_quantity_up qty"> + </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p id=<?php echo e("subtotal_".$cartItem->id); ?> class="cart_total_price">
                                        $<?php echo e($cartItem->subtotal); ?></p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="Javascript:void(0)"
                                       id="delete_<?php echo e($cartItem->id); ?>" data-id="<?php echo e($cartItem->id); ?>"
                                       data-count="<?php echo e(count($cart)); ?>" data-rowid="<?php echo e($cartItem->rowId); ?>"><i
                                                class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div>
                                <br/>
                                <p class="text-center"><strong>You have no items in the shopping cart</strong></p>
                                <br/>
                            </div>
                        <?php endif; ?>
                        </tbody>
                    </table>
            </div>
            <div class="no-item-checkbox">
                <div class="pull-right col-md-4">
                    <a class="<?php echo e((count($cart)) ? "btn btn-default check_out" : "hidden_field"); ?>"
                       href="<?php echo e(Auth::user() ? route('checkout') : url('register')); ?>">Check Out</a>
                </div>
            </div>
        </div>
        <br/>


    </section> <!--/#cart_items-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>