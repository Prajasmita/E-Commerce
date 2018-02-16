

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class=" panel panel-default">
                <div class="col-md-11 panel-heading"><strong>Name : <?php echo e($product_data->product_name); ?></strong></div>
                <div class="col-md-1 panel-heading">
                    <a href="<?php echo e(url('/admin/products')); ?>" class="btn-sm btn-primary">Back</a>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="col-sm-4" rowspan="6">
                                    <img class="show_img"
                                         src="<?php echo e(asset('img/product/'.$product_data['image_products'])); ?>">
                                </td>
                            </tr>
                            <tr>
                                <th> Product Name &nbsp;</th>
                                <td> <?php echo e($product_data->product_name); ?> </td>
                            </tr>
                            <tr>
                                <th>Sku &nbsp;</th>
                                <td><?php echo e($product_data->sku); ?></td>
                            </tr>
                            <tr>
                                <th> Price &nbsp;</th>
                                <td> <?php echo e($product_data->price); ?> </td>
                            </tr>
                            <tr>
                                <th> Category &nbsp;</th>
                                <td>
                                    
                                    
                                    <?php $__currentLoopData = $product_data->category_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($cat->category->name); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                            </tr>
                            <tr>
                                <th> Discription &nbsp;</th>
                                <td> <?php echo e($product_data->long_discription); ?> </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>