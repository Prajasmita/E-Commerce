<?php $__env->startSection('content'); ?>
    <?php if( session()->has('template_message') ): ?>
        <div class="alert alert-success"><?php echo e(session()->get('template_message')); ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>User Orders</strong></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="user_orders" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Order Id</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<script>
    var dataTableUserOrderUrl = "<?php echo e(route('user.orders')); ?>";
    var dataTableUserOrderDetail = "<?php echo e(route('order.details',['id'])); ?>";
</script>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>