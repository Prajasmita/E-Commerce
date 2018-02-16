<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <?php if( session()->has('traced_order') ): ?>
                <div class="alert alert-success"><?php echo e(session()->get('traced_order')); ?></div>
            <?php endif; ?>
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Track Order</h2>
                    <?php echo Form::open(['route' => 'track.my_order',]); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="form-group has-feedback">
                        <div class="form-group <?php echo e($errors->has('order_id') ? 'has-error' : ''); ?>">
                            <?php echo Form::text('order_id','', array('class' => 'form-control','placeholder'=>'Order Id *'));; ?>

                            <?php echo $errors->first('order_id', '<p class="help-block">:message</p>'); ?>

                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                            <?php echo Form::text('email','', array('class' => 'form-control','placeholder'=>'Email *'));; ?>

                            <?php echo $errors->first('email', '<p class="help-block">:message</p>'); ?>

                        </div>
                    </div>
                    <div class="login-box">
                        <div class="form-group form-actions">
                            <button type="submit" class="btn btn-default">Send</button>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div><!--/login form-->
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>