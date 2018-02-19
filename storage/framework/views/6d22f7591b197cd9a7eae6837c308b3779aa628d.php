
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading col-md-11"><strong>User
                        Name: <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></strong></div>
                <div class="panel-heading col-md-1">
                    <a href="<?php echo e(url('/admin/users')); ?>" class="btn-sm btn-primary">Back</a>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>

                            <tr>
                                <th> First Name</th>
                                <td> <?php echo e($user->first_name); ?> </td>
                            </tr>
                            <tr>
                                <th> Last Name</th>
                                <td> <?php echo e($user->last_name); ?> </td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?php echo e($user->email); ?> </td>
                            </tr>
                            <tr>
                                <th> Role</th>
                                <td> <?php echo e($user->role->name); ?> </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>