<div width="600">
    <?php $total = 0 ?>

    <?php if(count($order_review_page['order_products'])): ?>
        <table border="1">
            <thead>
            <tr >
                <td colspan="2">Item</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Total</td>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $order_review_page['order_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id=""  >
                    <td colspan="2">
                        <?php $image_name = $order_product['image_name'] ?>

                        <a href="#"><img class="index_img" height="10px" width="10px" src="<?php echo e(asset('img/product/'.$image_name)); ?>" alt=""></a>
                        <h4><?php echo e($order_product['name']); ?></h4>
                    </td>
                    <td>
                        <p>$<?php echo e($order_product['price']); ?></p>
                    </td>
                    <td>
                        <div>
                            <input type="text" class="qty cart_quantity_input"  name="quantity" value="<?php echo e($order_product['quantity']); ?>" min="1"  size="2" id="number" readonly/>
                        </div>
                    </td>
                    <td>
                        <?php $total = $total + $order_product['subtotal']  ?>
                        <p class="cart_total_price">$<?php echo e($order_product['subtotal']); ?></p>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="4">&nbsp;</td>
                <td colspan="2">
                    <table  border="1">
                        <tr>
                            <td>Cart Sub Total</td>
                            <td><?php echo e("$".$total); ?></td>
                        </tr>
                        <?php if(($order_review_page['payment_details']['discount'])): ?>
                            <tr>
                                <td>Discount</td>
                                <td> <?php echo e("$".$order_review_page['payment_details']['discount']); ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Shipping Cost</td>
                            <td><?php echo e($order_review_page['payment_details']['shipping_charges'] ?  "$". $order_review_page['payment_details']['shipping_charges']: "Free Shipping"); ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><span><?php echo e("$".$order_review_page['payment_details']['grand_total']); ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>