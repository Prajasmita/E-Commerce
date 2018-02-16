<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 padding-left">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#<?php echo e($category->name); ?>">

                                            <?php if($category->sub_category->count() > 0): ?>
                                                <span class="badge pull-right">
                                                <i class=" fa fa-plus"></i></span>
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('category_product',$category->id)); ?>"><?php echo e($category->name); ?></a>

                                        </a>
                                    </h4>
                                </div>
                                <div id="<?php echo e($category->name); ?>" class="panel-collapse collapse">
                                    
                                    <div class=<?php echo e(($category->sub_category->count() > 0) ? "panel-body" :""); ?>>
                                        <?php if($category->sub_category->count() > 0): ?>
                                            <ul>
                                                <?php $__currentLoopData = $category->sub_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($sub_category->parent_id == $category->id ): ?>
                                                        <li>
                                                            <a href="<?php echo e(route('category_product',$sub_category->id)); ?>"><?php echo e($sub_category->name); ?></a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <!--/category-products-->
            <div class="col-sm-9 padding-right">
                <div class="product-details col-sm-5">
                    <img class="xzoom show_img"
                         src="<?php echo e(asset('img/product/'.$products['image']['product_image_name'])); ?>"
                         xoriginal="<?php echo e(asset('img/product/'.$products['image']['product_image_name'])); ?>"/>
                    <div class="xzoom-thumbs">
                        <?php $__currentLoopData = $products['image_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="">
                                <img class="xzoom-gallery" width="80"
                                     src="<?php echo e(asset('img/product/'.$product['product_image_name'])); ?>"
                                     xpreview="<?php echo e(asset('img/product/'.$product['product_image_name'])); ?>">
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-sm-7">

                    <div class="product-information"><!--/product-information-->

                        <?php if($products['is_feature'] == 1): ?>
                            <img src="<?php echo e(asset('img/images/product-details/featured_tag.png')); ?>" class="newarrival"
                                 alt=""/>
                        <?php endif; ?>
                        <h1><?php echo e($products['product_name']); ?></h1>
                        <span >
                            <span>$<?php echo e($products['price']); ?></span>
                            <div class="quantity">
                                <label><b>Qty:</b></label>
                                <input type="button" class="qty_minus" value="-"/>
                                <input type="text" class="qty" id="quantity" name="quantity"
                                       data-value="<?php echo e(Cart::count()); ?>" value="1" min="1"
                                       max="<?php echo e($products['quantity']); ?>" size="1" id="number"
                                       readonly/>
                                <input type="button" class="qty_plus" value="+"/>
                            </div>
                            <br/>
                        <span>
                            <?php if(in_array($products['id'],$cart_product)): ?>
                                <a href="javascript:void(0)" class=" btn btn-default link_text_color detail-added-to-cart"><i
                                            class="glyphicon glyphicon-ok"></i>Added to cart</a>
                            <?php else: ?>
                                <a href="javascript:void(0)" data-id="<?php echo e($products['id']); ?>"
                                   data-price="<?php echo e($products['price']); ?>" data-count="<?php echo e(Cart::count()); ?>"
                                   class="cart-data btn btn-default detail-add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                            <?php endif; ?>
                                    <?php if(in_array($products['id'],$my_wishlist)): ?>
                                        <button type="button" class="btn btn-lg wishlist_color added " >
                                                      <a class=" added " disabled="disabled"><i class="fa fa-heart"></i></a>
                                        </button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-lg wishlist_color">
                                                    <a href="javascript:void(0)"
                                                       class="<?php echo e("product_id_".$products['id']); ?> wishlist "
                                                       data-id="<?php echo e($products['id']); ?>"><i
                                                                class="fa fa-heart"></i></a></li>
                                        </button>
                                    <?php endif; ?>
                            </span>
                                        <p><b>Availability:</b> <?php echo e(($products['quantity'])? "In Stock" : "Not In Stock"); ?></p>
                                        <p><b>Description:</b> <?php echo e($products['short_discription']); ?></p>
                        </span>
                    </div><!--/product-information-->
                </div>
            </div><!--/product-details-->
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>