<?php $__env->startSection('content'); ?>
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <?php $__currentLoopData = $banner_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item <?php echo e($index == 0 ? 'active' : ''); ?>">
                                    <div class="col-sm-6">
                                        <h1><?php echo e($banner->banner_name); ?></h1>
                                        <h2>Free E-Commerce Template</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. </p>
                                        <button type="button" class="btn btn-default get">Get it now</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="<?php echo e(asset('img/banner/'.$banner->banner_image)); ?>"
                                             class="girl img-responsive" alt=""/>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--/slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
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
                    </div><!--/category-products-->


                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->

                    <h2 class="title text-center"><?php echo e($categoryName->name); ?> Products</h2>

                    <?php if(count($products)): ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img class="show_img"
                                                 src="<?php echo e(asset('/img/product/'.$product['products']['image'])); ?>" alt=""/>
                                            <h2>$<?php echo e($product['products']['price']); ?></h2>
                                            <p><?php echo e($product['products']['product_name']); ?></p>
                                            <?php if(in_array($product['products']['id'],$cart_product)): ?>
                                                <a href="javascript:void(0)" class=" btn btn-default product-added "><i
                                                            class="glyphicon glyphicon-ok"></i>Added to cart</a>
                                            <?php else: ?>
                                                <a href="javascript:void(0)" data-id="<?php echo e($product['products']['id']); ?>"
                                                   class="cart-data btn btn-default add-to-cart <?php echo e("product_id_cart".$product['products']['id']); ?>"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                            <?php endif; ?>                                  </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$<?php echo e($product['products']['price']); ?></h2>
                                                <p><a class=""
                                                      href="<?php echo e(Auth::user() ? route('products.details',$product['products']['id']) : route('register')); ?>"><?php echo e($product['products']['product_name']); ?></a>
                                                </p>
                                                <?php if(in_array($product['products']['id'],$cart_product)): ?>
                                                    <a href="javascript:void(0)"
                                                       class=" btn btn-default product-added  "><i
                                                                class="glyphicon glyphicon-ok"></i>Added to cart</a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)"
                                                       data-id="<?php echo e($product['products']['id']); ?>"
                                                       class="cart-data btn btn-default add-to-cart <?php echo e("product_id_cart".$product['products']['id']); ?>"><i
                                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                                <?php endif; ?>                                    </div>
                                        </div>
                                    </div>

                                    <div class="choose nav nav-pills nav-justified <?php echo e(Auth::user() ?'':'hidden_field'); ?>">

                                        <?php if(in_array($product['products']['id'],$my_wishlist)): ?>
                                            <li><a class="added "><i class=" fa fa-heart"></i></a></li>
                                        <?php else: ?>
                                            <li class="<?php echo e("product_id_".$product['products']['id']); ?>"><a
                                                        class="wishlist link_text_color" href="javascript:void(0)"
                                                        data-id="<?php echo e($product['products']['id']); ?>"><i
                                                            class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p class="text-center"><b>Sorry,No Product Available</b></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!--features_items-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>