<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="table-responsive ">
                <?php if(count($my_order)): ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $my_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($order->created_at->format('d M,Y')); ?></td>
                                <td><?php echo e('ORD'.str_pad($order->id, 4, '0', STR_PAD_LEFT)); ?></td>
                                <td><?php echo e($order->grand_total); ?></td>
                                <td><?php echo e(($order->status == 'O') ? 'Processing' : 'Pending'); ?></td>
                                <td><?php echo e(($order->payment_gateway_id == 1) ? 'COD' : 'Paypal'); ?></td>
                                <td><a href="<?php echo e(route('my.order',$order->id)); ?>">Check</a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div>
                        <br/>
                        <p class="text-center"><strong>You have not yet order anything from our site.</strong></p>
                        <br/>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>