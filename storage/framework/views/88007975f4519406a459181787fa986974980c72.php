<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <?php if( session()->has('success_message') ): ?>
                <div class="alert alert-success"><?php echo e(session()->get('success_message')); ?></div>
            <?php endif; ?>
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Change Password</h2>
                    <?php if( session()->has('message') ): ?>
                        <div class="alert alert-danger"><?php echo e(session()->get('message')); ?></div>
                    <?php endif; ?>
                    <?php echo Form::open(['route' => 'store.change_password',]); ?>

                    <?php echo e(csrf_field()); ?>

                        <div class="form-group has-feedback">
                            <div class="form-group <?php echo e($errors->has('old_password') ? 'has-error' : ''); ?>">
                                <?php echo Form::text('old_password','', array('class' => 'form-control','placeholder'=>'Old Password *'));; ?>

                                <?php echo $errors->first('old_password', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="form-group <?php echo e($errors->has('new_password') ? 'has-error' : ''); ?>">
                                <?php echo Form::text('new_password','', array('class' => 'form-control','placeholder'=>'New Password *'));; ?>

                                <?php echo $errors->first('new_password', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="form-group <?php echo e($errors->has('confirm_new_password') ? 'has-error' : ''); ?>">
                                <?php echo Form::text('confirm_new_password','', array('class' => 'form-control','placeholder'=>'Confirm New Password *'));; ?>

                                <?php echo $errors->first('confirm_new_password', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>
                        <div class="login-box">
                            <div class="form-group form-actions">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    <?php echo Form::close(); ?>

                </div><!--/login form-->
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>