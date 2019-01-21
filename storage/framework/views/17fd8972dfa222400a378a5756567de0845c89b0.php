<?php $__env->startSection('content'); ?>

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">

                        <?php $count = count($banner_images) ?>
                        <ol class="carousel-indicators">
                            <?php $__currentLoopData = $banner_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li data-target="#slider-carousel" data-slide-to="<?php echo e($index); ?>"
                                    class="<?php echo e($index == 0 ? 'active' : ''); ?>"></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>

                        <div class="carousel-inner">
                            <?php $__currentLoopData = $banner_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item <?php echo e($index == 0 ? 'active' : ''); ?>">
                                    <div class="col-sm-6">
                                        <h1><?php echo e($banner->banner_name); ?></h1>
                                        <h2>Free E-Commerce Template</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="<?php echo e(asset('img/banner/'.$banner->banner_image)); ?>"
                                             class="girl img-responsive" alt=""/>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(count($banner_images) > 1): ?>
                            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        <?php endif; ?>
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
                    <h2 class="title text-center">Features Items</h2>


                    <?php $__currentLoopData = $featured_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo e(asset('/img/product/'.$featured_product['image']['product_image_name'])); ?>"
                                             alt=""/>
                                        <h2>$<?php echo e($featured_product['price']); ?></h2>
                                        <p><?php echo e($featured_product['product_name']); ?></p>
                                    </div>
                                    <div class=" product-overlay">
                                        <div class="overlay-content">
                                            <h2>$<?php echo e($featured_product['price']); ?></h2>
                                            <p><a class=""
                                                  href="<?php echo e(Auth::user() ? route('products.details',$featured_product['id']) : route('register')); ?>"><?php echo e($featured_product['product_name']); ?></a>
                                            </p>
                                            <?php if(in_array($featured_product['id'],$cart_product)): ?>
                                                <span><a href="javascript:void(0)"
                                                         class="btn btn-default link_text_color added-to-cart "><i
                                                                class="glyphicon glyphicon-ok"></i>Added to cart</a></span>
                                            <?php else: ?>
                                                <a href="javascript:void(0)" data-id="<?php echo e($featured_product['id']); ?>"
                                                   data-count="<?php echo e(count($cart_product)); ?>"
                                                   class="cart-data btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose <?php echo e(Auth::user() ?'':'hidden_field'); ?>">
                                    <ul class="nav nav-pills nav-justified">
                                        <?php if(in_array($featured_product['id'],$my_wishlist)): ?>
                                            <li><a class="link_text_color" disabled="disabled"><i class=" glyphicon glyphicon-ok" ></i>Added to Wishlist</a></li>
                                        <?php else: ?>
                                            <li class="<?php echo e("product_id_".$featured_product['id']); ?>"><a
                                                        class="wishlist link_text_color" href="javascript:void(0)"
                                                        data-id="<?php echo e($featured_product['id']); ?>"><i
                                                            class="fa fa-plus-square "></i>Add to wishlist</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!--features_items-->

                <!--category-tab-->
                <div class="category-tab">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $count => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class=" <?php if($count == 0): ?> active <?php endif; ?>">
                                    <a class="cat_nav " href="#<?php echo e($category->id); ?>" data-id="<?php echo e($category->id); ?>"
                                       data-toggle="tab"><?php echo e($category->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="tab-content ">
                        <div class="tab-pane fade active in" id="category_product">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-3 proinfo0">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo  text-center">
                                                <img class="show_img"
                                                     src="<?php echo e(asset('img/product/'.$cat['products']['image'])); ?>"/>
                                                <h2>$<?php echo e($cat['products']['price']); ?></h2>
                                                <p><a class="text-dark"
                                                      href="<?php echo e(Auth::user() ? route('products.details',$cat['products']['id']) : route('register')); ?>"><?php echo e($cat['products']['product_name']); ?></a>
                                                </p>
                                                <?php if(in_array($cat['products']['id'],$cart_product)): ?>
                                                    <span><a href="javascript:void(0)"
                                                             class="link_text_color btn btn-default added-to-cart "><i
                                                                    class="glyphicon glyphicon-ok"></i>Added to cart</a></span>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)" data-id="<?php echo e($cat['products']['id']); ?>"
                                                       data-count="<?php echo e(Cart::count()); ?>"
                                                       class="cart-data btn btn-default add-to-cart <?php echo e("product_id_cart".$cat['products']['id']); ?>"><i
                                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                                <?php endif; ?>
                                                <div class="choose nav nav-pills nav-justified <?php echo e(Auth::user() ?'':'hidden_field'); ?>">

                                                    <?php if(in_array($cat['products']['id'],$my_wishlist)): ?>
                                                        <li class="<?php echo e("product_id_".$cat['products']['id']); ?>"><a
                                                                    class="link_text_color" href="javascript:void(0)"
                                                                    data-id="<?php echo e($cat['products']['id']); ?>"><i
                                                                        class="glyphicon glyphicon-ok "></i>Added to Wishlist</a></li>
                                                    <?php else: ?>
                                                        <li class="<?php echo e("product_id_".$cat['products']['id']); ?>"><a
                                                                    class="wishlist link_text_color "
                                                                    href="javascript:void(0)"
                                                                    data-id="<?php echo e($cat['products']['id']); ?>"><i
                                                                        class="fa fa-plus-square"></i> Add to
                                                                Wishlist</a></li>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div><!--/category-tab-->
            </div>
        </div>
    </div>
    <script>
        var authUser = <?php echo e(Auth::user() ? 1 : 0); ?> ;
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>