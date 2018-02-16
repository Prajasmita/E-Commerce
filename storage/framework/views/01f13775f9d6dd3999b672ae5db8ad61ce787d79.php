

<?php $__env->startSection('content'); ?>
    <?php if( session()->has('flash_message') ): ?>
        <div class="alert alert-success"><?php echo e(session()->get('flash_message')); ?></div>
    <?php endif; ?>
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Categories</strong></div>
                    <div class="panel-body">
                        <a href="<?php echo e(url('/admin/categories/create')); ?>" class="btn btn-success btn-sm" title="Add New Category">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Category
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table id='categories' class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Parent Category </th>
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
<?php $__env->stopSection(); ?>
<script type="text/javascript">
    var dataTableCatUrl = "<?php echo e(route('categories.index')); ?>";
            
    var dataTableCatViewUrl = "<?php echo e(route('categories.show',['id'])); ?>";

    var dataTableCatEditUrl = "<?php echo e(route('categories.edit',['id'])); ?>";

    var dataTableCatDeleteUrl = "<?php echo e(route('categories.destroy',['id'])); ?>";
</script>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>