<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <?php if( session()->has('retrieve_password') ): ?>
                <div class="alert alert-success"><?php echo e(session()->get('retrieve_password')); ?></div>
            <?php endif; ?>
            <?php if( session()->has('register_email') ): ?>
                <div class="alert alert-danger"><?php echo e(session()->get('register_email')); ?></div>
            <?php endif; ?>
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Forget Password</h2>
                    <?php echo Form::open(['route' => 'retrieve.password',]); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="form-group has-feedback">
                        <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                            <?php echo Form::text('email','', array('class' => 'form-control','placeholder'=>'Email *'));; ?>

                            <?php echo $errors->first('email', '<p class="help-block">:message</p>'); ?>

                        </div>
                    </div>
                    <div class="login-box">
                        <div class="form-group form-actions">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>