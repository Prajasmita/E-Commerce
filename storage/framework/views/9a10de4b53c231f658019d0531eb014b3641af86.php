<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong># Admin Note</strong></div>
                <div class="panel-body">
                    <div class="col-sm-6 col-sm-offset-1">
                        <div class="login-form">
                            <h2><?php echo e($query_data->subject); ?></h2>
                            <?php echo Form::open(['route'=>'admin_note.save']); ?>


                            <?php echo e(csrf_field()); ?>

                            <input type="text" name="id" id="id" value="<?php echo e($query_data->id); ?>" class="hidden_field">

                            <div class="form-group has-feedback">
                                <div class="form-group <?php echo e($errors->has('message') ? 'has-error' : ''); ?>">
                                    <?php echo Form::text('message',$query_data->message, array('class' => 'form-control','readonly'=> 'readonly'));; ?>

                                    <?php echo $errors->first('message', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="form-group <?php echo e($errors->has('note_admin') ? 'has-error' : ''); ?>">

                                    <textarea name="note_admin" class="form-control" id="ckeditor-note" placeholder="Admin Reply *"></textarea>

                                    <?php echo $errors->first('note_admin', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                            <div class="pull-right">
                                <?php echo Form::submit('Save',array('class'=>'btn btn-primary','data-id'=>$query_data->id ));; ?>

                                <a href="<?php echo e(route('contact.admin')); ?>" class="btn btn-danger">Cancel</a>
                            </div>


                            
                            <?php echo Form::close();; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script>var dataTableContactAdminUrl = "<?php echo e(route('contact.admin')); ?>";</script>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>