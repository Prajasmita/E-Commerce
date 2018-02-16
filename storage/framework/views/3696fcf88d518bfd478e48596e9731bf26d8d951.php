<?php $__env->startSection('content'); ?>

    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Contact <strong>Us</strong></h2>
                   
                </div>
            </div>
            <?php if( session()->has('query_message') ): ?>
                <div class="alert alert-success"><?php echo e(session()->get('query_message')); ?></div>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Get In Touch</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <?php echo Form::open(['route' => ['contact'],'class'=>'contact-form row']); ?>


                        <?php echo e(csrf_field()); ?>

                            <div class="form-group col-md-6 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                                <?php echo Form::text('name','', array('class' => 'form-control','placeholder' => 'Name'));; ?>

                                <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

                            </div>
                            <div class="form-group col-md-6 <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                                <?php echo Form::text('email','', array('class' => 'form-control','placeholder' => 'Email'));; ?>

                                <?php echo $errors->first('email', '<p class="help-block">:message</p>'); ?>

                            </div>
                            <div class="form-group col-md-12 <?php echo e($errors->has('contact_no') ? 'has-error' : ''); ?>">
                                <?php echo Form::text('contact_no','', array('class' => 'form-control','placeholder' => 'Contact Number'));; ?>

                                <?php echo $errors->first('contact_no', '<p class="help-block">:message</p>'); ?>

                            </div>
                            <div class="form-group col-md-12 <?php echo e($errors->has('subject') ? 'has-error' : ''); ?>">
                                <?php echo Form::text('subject','', array('class' => 'form-control','placeholder' => 'Subject'));; ?>

                                <?php echo $errors->first('subject', '<p class="help-block">:message</p>'); ?>

                            </div>
                            <div class="form-group col-md-12 <?php echo e($errors->has('message') ? 'has-error' : ''); ?>">
                                <textarea name="message" id="message"  class="form-control" rows="8" placeholder="Your Message Here"></textarea>
                                <?php echo $errors->first('message', '<p class="help-block">:message</p>'); ?>

                            </div>
                            <div class="form-group col-md-12">
                                <?php echo Form::submit('Submit', ['class' => 'btn btn-warning pull-right']); ?>

                            </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <h3><strong>E-Commerce Shopping Cart</strong></h3>
                            <p>935 W. A.P.J.Kalam New Streets Andheri, 400 093 ,</p>
                            <p>Mumbai India</p>
                            <p>Mobile: +91 985 869 5869</p>
                            <p>Fax: 1-714-252-0026</p>
                            <p>Email: prajakta.neosoft@gmail.com</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Social Networking</h2>
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/login/"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/login"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="https://plus.google.com/people"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/#contact-page-->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>