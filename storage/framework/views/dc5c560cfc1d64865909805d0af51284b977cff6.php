<?php $__env->startSection('content'); ?>
    <?php if( session()->has('admin_note') ): ?>
        <div class="alert alert-success"><?php echo e(session()->get('admin_note')); ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Users Queries</strong></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="queries" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<script>
    var dataTableContactAdminUrl = "<?php echo e(route('contact.admin')); ?>";
</script>
<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>