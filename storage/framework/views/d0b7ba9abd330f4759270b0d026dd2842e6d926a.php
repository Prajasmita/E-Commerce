<div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
    <label for="name" class="col-md-4 control-label"><?php echo e('Name'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="<?php echo e(isset($selected_category->name) ? $selected_category->name : ''); ?>" >
        <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('parent_id') ? 'has-error' : ''); ?>">
    <label for="parent_id" class="col-md-4 control-label"><?php echo e('Parent Id'); ?><span class="require">*</span></label>
    <div class="col-md-6">

        <select name="parent_id" class="form-control" id="parent_id" >
            <option value="0">No Parent</option>>
            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php echo e(($category->id == $selected_category->parent_id) ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>
        <?php echo $errors->first('parent_id', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">

    <label for="status" class="col-md-4 control-label"><?php echo e('status'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input   name="status" value="1" type="radio" id="status" <?php echo e(isset( $category->status) ? $category->status == 1 ? 'checked' :'' : ''); ?>>Active
        <input  name="status" value="0" type="radio" id="status" <?php echo e(isset( $category->status) ? $category->status == 0 ? 'checked' :'' : ''); ?>>Inactive
        <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="<?php echo e(isset($submitButtonText) ? $submitButtonText : 'Create'); ?>">
         <a href="<?php echo e(url('/admin/categories')); ?>" class="btn btn-danger">Cancel</a>
    </div>
</div>
