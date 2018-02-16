<?php $__env->startSection('content'); ?>
    <section id="form"><!--form-->
        <div class="container">
            <?php if( session()->has('flash_message') ): ?>
                <div class="alert alert-success"><?php echo e(session()->get('flash_message')); ?></div>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="<?php echo e(route('user_login')); ?>" method="post">

                            <div class="form-group has-feedback">
                                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                                    <input id="email" type="email" class="form-control" placeholder="Email" name="email"
                                           value="<?php echo e(old('email')); ?>" autofocus>
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                    <?php if($errors->has('password')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                    <input id="password" type="password" class="form-control" placeholder="Password"
                                           name="password" value="<?php echo e(old('password')); ?>" autofocus>
                                </div>
                            </div>


                            <div class="login-box">
                                <div class="form-group form-actions">
                                    <span><a href="<?php echo e(route('forget.password')); ?>">Forget Password</a></span>

                                    <button type="submit" class="btn btn-default">Login</button>
                                </div>
                            </div>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('register')); ?>">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group<?php echo e($errors->has('first_name') ? ' has-error' : ''); ?>">
                                <div class="col-md-12">
                                    <input id="first_name" type="text" class="form-control" name="first_name"
                                           placeholder="First Name" value="<?php echo e(old('first_name')); ?>">

                                    <?php if($errors->has('first_name')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>">
                                <div class="col-md-12">
                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                           placeholder="Last Name" value="<?php echo e(old('last_name')); ?>">

                                    <?php if($errors->has('last_name')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email"
                                           placeholder="Email Address" value="<?php echo e(old('email')); ?>">

                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" placeholder="Password"
                                           name="password">

                                    <?php if($errors->has('password')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('contact_no') ? ' has-error' : ''); ?>">

                                <div class="col-md-12">
                                    <input id="contact_no" type="text" class="form-control" placeholder="Contact No."
                                           name="contact_no">

                                    <?php if($errors->has('contact_no')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('contact_no')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>