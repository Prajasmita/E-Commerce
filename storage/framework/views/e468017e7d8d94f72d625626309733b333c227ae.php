<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php if( session()->has('message') ): ?>
            <div class="alert alert-success"><?php echo e(session()->get('message')); ?></div>
        <?php endif; ?>
        <div class="col-sm-4 pull-right">
            <button type="button" id="add" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add New Address</button>
        </div>
        <br/>
            <br/>
        <div class="row">
            <div class="col-sm-12">
                <?php $__currentLoopData = $userAddress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="fa-border">
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td><strong><h4><?php echo e($user_address->first_name); ?> <?php echo e($user_address->middle_name ? $user_address->middle_name  : ''); ?> <?php echo e($user_address->last_name); ?> <h4><strong></td>
                                </tr>
                                <tr>
                                    <td> <?php echo e($user_address->email); ?> , <?php echo e($user_address->contact_no); ?></td>
                                </tr>
                                <tr>
                                    <td> <?php echo e($user_address->address1); ?>,  <?php echo e($user_address->address2 ? $user_address->address2.',' : ''); ?></td>
                                </tr>
                                <tr>
                                    <td> <?php echo e($user_address->city); ?> , <?php echo e($user_address->zip_code); ?> , <?php echo e($user_address->states->name); ?></td>
                                </tr>
                                <tr>
                                    <td> <?php echo e($user_address->countries->name); ?></td>
                                    <td><input name="primary" class="primary_address" data-id="<?php echo e($user_address->id); ?>" type="checkbox" id="primary_<?php echo e($user_address->id); ?>" <?php echo e($user_address->primary ? 'checked' : ''); ?>></td>
                                    <td class="primary_<?php echo e($user_address->id); ?>"><?php echo e($user_address->primary ? 'Primary' : ''); ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm edit_address" id="edit_address" data-id="<?php echo e($user_address->id); ?>"><i class=" glyphicon glyphicon-pencil">Edit</i></button>
                                        <?php if(!$user_address->primary): ?>
                                        <a href="<?php echo e(route('address.delete',$user_address->id)); ?>" type="button" class="btn btn-danger btn-sm delete_address" id="delete_address"  data-id="<?php echo e($user_address->id); ?>"><i class=" glyphicon glyphicon-trash">Delete</i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </div>
                    <br/>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<div id="load_modal_add">
</div>
<div id="load_modal_edit">
</div>


<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>