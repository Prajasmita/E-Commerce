

<div class="form-group <?php echo e($errors->has('first_name') ? 'has-error' : ''); ?>">

    <label for="first_name" class="col-md-4 control-label"><?php echo e('First Name'); ?><span class="require">*</span></label>

    <div class="col-md-6">
        <input class="form-control" name="first_name" type="text" id="first_name" value="<?php echo e(isset($user->first_name) ? $user->first_name : ''); ?>" >
        <?php echo $errors->first('first_name', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('last_name') ? 'has-error' : ''); ?>">

    <label for="last_name" class="col-md-4 control-label"><?php echo e('Last Name'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="last_name" type="text" id="last_name" value="<?php echo e(isset($user->last_name) ? $user->last_name : ''); ?>" >
        <?php echo $errors->first('last_name', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">

    <label for="email" class="col-md-4 control-label"><?php echo e('Email'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" rows="5" name="email" type="email" id="email" value="<?php echo e(isset($user->email) ? $user->email : ''); ?>">
        <?php echo $errors->first('email', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('contact_no') ? 'has-error' : ''); ?>">

    <label for="contact_no" class="col-md-4 control-label"><?php echo e('Contact No'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" rows="5" name="contact_no" type="text" id="contact_no" value="<?php echo e(isset($user->contact_no) ? $user->contact_no : ''); ?>">
        <?php echo $errors->first('contact_no', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">

    <label for="password" class="col-md-4 control-label"><?php echo e('Password'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="password" type="password" id="password" maxlength=12 >
        <?php echo $errors->first('password', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group">
    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
    </div>
</div>

<div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">

    <label for="status" class="col-md-4 control-label"><?php echo e('status'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input   name="status" value="1" type="radio" id="status" <?php echo e(isset( $user->status) ? $user->status == 1 ? 'checked' :'' : ''); ?>>Active
        <input  name="status" value="0" type="radio" id="status" <?php echo e(isset( $user->status) ? $user->status == 0 ? 'checked' :'' : ''); ?>>Inactive
        <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('role_id') ? 'has-error' : ''); ?>">

    <label for="role_id" class="col-md-4 control-label"><?php echo e('Role'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <select name="role_id" class="form-control" id="role_id" >
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($role->id); ?>" <?php echo e((isset($user->role_id) && $user->role_id == $role->id) ? 'selected' : ''); ?>><?php echo e($role->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php echo $errors->first('role_id', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="<?php echo e(isset($submitButtonText) ? $submitButtonText : 'Create'); ?>">
        <a href="<?php echo e(url('/admin/users')); ?>" class="btn btn-danger">Cancel</a>
    </div>
</div>
