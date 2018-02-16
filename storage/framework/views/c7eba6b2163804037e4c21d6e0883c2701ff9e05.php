<div class="form-group <?php echo e($errors->has('product_name') ? 'has-error' : ''); ?>">
    <label for="product_name" class="col-md-4 control-label"><?php echo e('Product Name'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="product_name" type="text" id="product_name"
               value="<?php echo e(isset($product->product_name) ? $product->product_name : ''); ?>">
        <?php echo $errors->first('product_name', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('sku') ? 'has-error' : ''); ?>">
    <label for="sku" class="col-md-4 control-label"><?php echo e('Sku'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="sku" type="text" id="sku" value="<?php echo e(isset($product->sku) ? $product->sku : ''); ?>">
        <?php echo $errors->first('sku', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('short_discription') ? 'has-error' : ''); ?>">
    <label for="short_discription" class="col-md-4 control-label"><?php echo e('Short Discription'); ?><span
                class="require">*</span></label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="short_discription" type="textarea"
                  id="short_discription"><?php echo e(isset($product->short_discription) ? $product->short_discription : ''); ?></textarea>
        <?php echo $errors->first('short_discription', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('long_discription') ? 'has-error' : ''); ?>">
    <label for="long_discription" class="col-md-4 control-label"><?php echo e('Long Discription'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="long_discription" type="textarea"
                  id="long_discription"><?php echo e(isset($product->long_discription) ? $product->long_discription : ''); ?></textarea>
        <?php echo $errors->first('long_discription', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('price') ? 'has-error' : ''); ?>">
    <label for="price" class="col-md-4 control-label"><?php echo e('Price'); ?> <span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="price" type="text" id="price" value="<?php echo e(isset($product->price) ? $product->price : ''); ?>">
        <?php echo $errors->first('price', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('special_price') ? 'has-error' : ''); ?>">
    <label for="special_price" class="col-md-4 control-label"><?php echo e('Special Price'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="special_price" type="text" id="special_price"
               value="<?php echo e(isset($product->special_price) ? $product->special_price : ''); ?>">
        <?php echo $errors->first('special_price', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('special_price_from_date') ? 'has-error' : ''); ?>">
    <label for="special_price_from_date" class="col-md-4 control-label"><?php echo e('Special Price From Date'); ?></label>
    <div class="col-md-6">
        <div class='input-group date'>
            <input class="date form-control " data-provide="datepicker" name="special_price_from_date" type="text"
                   id="special_price_from_date" value="<?php echo e(isset($product->special_price_from_date) ? $product->special_price_from_date : ''); ?>">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        <?php echo $errors->first('special_price_from_date', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('special_price_to_date') ? 'has-error' : ''); ?>">
    <label for="special_price_to_date" class="col-md-4 control-label"><?php echo e('Special Price To Date'); ?></label>
    <div class="col-md-6">
        <div class='input-group date'>
            <input class="date form-control " data-provide="datepicker" name="special_price_to_date" type="text"
                   id="special_price_to_date" value="<?php echo e(isset($product->special_price_to_date) ? $product->special_price_to_date : ''); ?>">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        <?php echo $errors->first('special_price_to_date', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('image_name') ? 'has-error' : ''); ?>">
    <label for="image_name" class="col-md-4 control-label"><?php echo e('Image Name'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="image_name[]" type="file" id="image_name"
               value="<?php echo e(isset($product->image_name) ? $product->image_name : ''); ?>" multiple>
        <?php echo $errors->first('image_name', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('quantity') ? 'has-error' : ''); ?>">
    <label for="quantity" class="col-md-4 control-label"><?php echo e('Quantity'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="quantity" type="text" id="quantity" value="<?php echo e(isset($product->quantity) ? $product->quantity : ''); ?>">
        <?php echo $errors->first('quantity', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('meta_title') ? 'has-error' : ''); ?>">
    <label for="meta_title" class="col-md-4 control-label"><?php echo e('Meta Title'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="meta_title" type="text" id="meta_title"
               value="<?php echo e(isset($product->meta_title) ? $product->meta_title : ''); ?>">
        <?php echo $errors->first('meta_title', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('meta_discription') ? 'has-error' : ''); ?>">
    <label for="meta_discription" class="col-md-4 control-label"><?php echo e('Meta Discription'); ?></label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="meta_discription" type="textarea"
                  id="meta_discription"><?php echo e(isset($product->meta_discription) ? $product->meta_discription : ''); ?></textarea>
        <?php echo $errors->first('meta_discription', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('meta_keyword') ? 'has-error' : ''); ?>">
    <label for="meta_keyword" class="col-md-4 control-label"><?php echo e('Meta Keyword'); ?></label>
    <div class="col-md-6">
        <input class="form-control" name="meta_keyword" type="text" id="meta_keyword"
               value="<?php echo e(isset($product->meta_keyword) ? $product->meta_keyword : ''); ?>">
        <?php echo $errors->first('meta_keyword', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('category') ? 'has-error' : ''); ?>">
    <label for="category" class="col-md-4 control-label"><?php echo e('Category'); ?> <span class="require">*</span></label>

    <div class="col-md-6">
        <select name="category[]" id="selected" data-cat = "<?php echo e(json_encode($cat)); ?>" class="form-control select2" multiple="multiple" data-placeholder="Select Category">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php echo e((isset($product->product_id) && in_array($category->id,$cat)) ? ' selected="selected"' : ''); ?>><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php echo $errors->first('category', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">

    <label for="status" class="col-md-4 control-label"><?php echo e('Product status'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input name="status" value="1" type="radio"
               id="status" <?php echo e(isset( $product->status) ? $product->status == 1 ? 'checked' :'' : ''); ?>>Active
        <input name="status" value="0" type="radio"
               id="status" <?php echo e(isset( $product->status) ? $product->status == 0 ? 'checked' :'' : ''); ?>>Inactive
        <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group <?php echo e($errors->has('is_feature') ? 'has-error' : ''); ?>">

    <label for="is_feature" class="col-md-4 control-label"><?php echo e('Is Feature'); ?><span class="require">*</span></label>
    <div class="col-md-6">
        <input name="is_feature" value="1" type="checkbox"
               id="is_feature" <?php echo e(isset( $product->is_feature) ? $product->is_feature == 1 ? 'checked' :'' : ''); ?>>
        <?php echo $errors->first('is_feature', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="<?php echo e(isset($submitButtonText) ? $submitButtonText : 'Create'); ?>">
        <a href="<?php echo e(url('/admin/products')); ?>" class="btn btn-danger">Cancel</a>

    </div>
</div>
