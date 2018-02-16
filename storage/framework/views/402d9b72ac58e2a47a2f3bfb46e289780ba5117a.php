

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Edit User # <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></strong>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <form method="POST" action="<?php echo e(url('/admin/users/' . $user->id)); ?>" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        <?php echo e(method_field('PATCH')); ?>

                        <?php echo e(csrf_field()); ?>

                        <?php echo $__env->make('admin.users.form', ['submitButtonText' => 'Update'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>