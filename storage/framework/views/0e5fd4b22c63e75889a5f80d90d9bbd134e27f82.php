<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo $page_data->content; ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>