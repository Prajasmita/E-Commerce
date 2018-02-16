

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="col-md-11 panel-heading"><strong>Edit Product #<?php echo e($product->product_name); ?></strong></div>
                <div class="col-md-1 panel-heading">
                    <a href="<?php echo e(url('/admin/products')); ?>" class="btn-sm btn-primary">Back</a>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <form method="POST" action="<?php echo e(url('/admin/products/' . $product->id)); ?>" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        <?php echo e(method_field('PATCH')); ?>

                        <?php echo e(csrf_field()); ?>

                        <?php echo $__env->make('admin.products.form', ['submitButtonText' => 'Update'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>