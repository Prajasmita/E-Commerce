

<?php $__env->startSection('content'); ?>
    <?php if( session()->has('flash_message') ): ?>
        <div class="alert alert-success"><?php echo e(session()->get('flash_message')); ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Users</strong></div>
                <div class="panel-body">
                    <a href="<?php echo e(url('/admin/users/create')); ?>" class="btn btn-success btn-sm" title="Add New User">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New User
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table id="example1" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
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

<script>
    var dataTableUrl = "<?php echo e(route('users.index')); ?>";

    var dataTableViewUrl = "<?php echo e(route('users.show',['id'])); ?>";

    var dataTableEditUrl = "<?php echo e(route('users.edit',['id'])); ?>";

    var dataTableDeleteUrl = "<?php echo e(route('users.destroy',['id'])); ?>";


</script>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>