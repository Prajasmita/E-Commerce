

<?php $__env->startSection('content'); ?>
    <?php if( session()->has('flash_message') ): ?>
        <div class="alert alert-success"><?php echo e(session()->get('flash_message')); ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Products</strong></div>
                <div class="panel-body">
                    <a href="<?php echo e(url('/admin/products/create')); ?>" class="btn btn-success btn-sm"
                       title="Add New Product">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New Product
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table id="product" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Actions</th>
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
    </div>
<?php $__env->stopSection(); ?>
<script>

    var dataTableProductUrl = "<?php echo e(route('products.index')); ?>";
            
    var dataTableProductViewUrl = "<?php echo e(route('products.show',['id'])); ?>";

    var dataTableProductEditUrl = "<?php echo e(route('products.edit',['id'])); ?>";

    var dataTableProductDeleteUrl = "<?php echo e(route('products.destroy',['id'])); ?>";

    var productPath = "<?php echo e(config('constants.product_path')); ?>";

</script>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>