

<?php $__env->startSection('content'); ?>
    <?php if( session()->has('flash_message') ): ?>
        <div class="alert alert-success"><?php echo e(session()->get('flash_message')); ?></div>
    <?php endif; ?>
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Configuration</strong></div>
                    <div class="panel-body">
                        <a href="<?php echo e(url('/admin/configuration/create')); ?>" class="btn btn-success btn-sm" title="Add New Configuration">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Configuration
                        </a>

                        <form method="GET" action="<?php echo e(url('/admin/configuration')); ?>" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">

                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table id="configuration" class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Conf Key</th>
                                        <th>Conf Value</th>
                                        <th>Actions</th>
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

    var dataTableConfUrl = "<?php echo e(route('configuration.index')); ?>";
            
    var dataTableConfViewUrl = "<?php echo e(route('configuration.show',['id'])); ?>";

    var dataTableConfEditUrl = "<?php echo e(route('configuration.edit',['id'])); ?>";

    var dataTableConfDeleteUrl = "<?php echo e(route('configuration.destroy',['id'])); ?>";
</script>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>