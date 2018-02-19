<?php $__env->startSection('content'); ?>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                    <li class="active">WishList</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">

                <?php if(count($wishlists)): ?>
                    <table class="table table-condensed no-item">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td></td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $wishlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="delete_wishlist_<?php echo e($list['product_id']); ?>">
                                <td class="cart_product">
                                    <a href="#"><img class="index_img"
                                                     src="<?php echo e(asset('img/product/'.$list['product']['image']['product_image_name'])); ?>"
                                                     alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""><?php echo e($list['product']['product_name']); ?></a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>$<?php echo e($list['product']['price']); ?></p>
                                </td>
                                <td>
                                    <?php if(in_array($list['product']['id'],$cart_product)): ?>
                                        <a href="javascript:void(0)"
                                           class=" btn btn-default link_text_color detail-added-to-cart"><i
                                                    class="glyphicon glyphicon-ok"></i>Added to cart</a>
                                    <?php else: ?>
                                        <a href="javascript:void(0)" data-id="<?php echo e($list['product']['id']); ?>"
                                           data-count="<?php echo e(Cart::count()); ?>"
                                           class="cart-data btn btn-default detail-add-to-cart }}"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                    <?php endif; ?>
                                </td>
                                <td class="cart_delete">
                                    <a class="wishlist_delete" href="Javascript:void(0)"
                                       id="delete_wishlist_<?php echo e($list['product']['id']); ?>"
                                       data-id="<?php echo e($list['product']['id']); ?>"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div>
                                <br/>
                                <p class="text-center"><strong>You have no items in the Wish List.</strong></p>
                                <br/>
                            </div>
                        <?php endif; ?>
                        </tbody>
                    </table>
            </div>
            <div class="no-item-checkbox">
                <div class="pull-right col-md-4">
                </div>
            </div>
        </div>
        <br/>
    </section> <!--/#cart_items-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>