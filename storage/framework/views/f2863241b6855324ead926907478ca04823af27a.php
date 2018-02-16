<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading col-md-11"><strong>Email Template : <?php echo e($template->title); ?></strong></div>
                <div class="panel-heading col-md-1">
                    <a href="<?php echo e(route('email.template')); ?>" class="btn-sm btn-primary">Back</a>
                </div>
                <div class="panel-body">

                    <br/>
                    <br/>

                    <div class="table-responsive ">
                        <table class="table fa-border">
                            <tbody>

                            <tr>
                                <th> Title </th>
                                <td> <?php echo e($template->title); ?> </td>
                            </tr>
                            <tr>
                                <th> Subject </th>
                                <td> <?php echo e($template->subject); ?> </td>
                            </tr>
                            <tr>
                                <th> Content </th>
                                <td> <?php echo $template->content; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>