<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Home | Ecommerce</title>
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/prettyPhoto.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/price-range.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">

    <!-- CSS STYLE-->
    <link rel="stylesheet" href="<?php echo e(asset('css/xzoom.css')); ?>" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo e(asset('js/html5shiv.js')); ?>"></script>
    <script src="<?php echo e(asset('js/respond.min.js')); ?>"></script>
    <![endif]-->
    <script>
        var base_url = "<?php echo e(config('constants.base_url')); ?>";

        var base_url_cat = "<?php echo e(route('category_data',['id'])); ?>";

        var productDetails = "<?php echo e(route('products.details',['id'])); ?>";

        var productDetailsUrl = "<?php echo e(config('constants.product_details_url')); ?>";

        var wishlistUrl = "<?php echo e(route('products.wishlist',['id'])); ?>";

        var cartUrl = "<?php echo e(route('cart_data',['id'])); ?>";

        var categoryProduct = "<?php echo e(route('category_product',['id'])); ?>";

        var cartUpdateUrl = "<?php echo e(route('cart.update',['id'])); ?>";

        var cartDeleteUrl = "<?php echo e(route('cart.delete',['id'])); ?>";

        var couponApplyUrl = "<?php echo e(route('coupon.apply')); ?>";

        var selectStateUrl = "<?php echo e(route('country.state',['id'])); ?>";

        var makeAddressPrimary = "<?php echo e(route('address.primary')); ?>";


        var addressAddUrl = "<?php echo e(route('address.add')); ?>";

        var addressStoreUrl = "<?php echo e(route('address.store')); ?>";

        var addressEditUrl = "<?php echo e(route('address.edit',['id'])); ?>";

        var addressUpdateUrl = "<?php echo e(route('address.update')); ?>";

        var wishlistDeleteUrl = "<?php echo e(route('wishlist.delete',['id'])); ?>";

    </script>


    
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>

<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<section>
    <!-- Your Page Content Here -->

    <?php echo $__env->yieldContent('content'); ?>

</section><!-- /.content -->



<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.scrollUp.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/price-range.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.prettyPhoto.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<script src="<?php echo e(asset('js/category_bar.js')); ?>"></script>
<script src="<?php echo e(asset('js/zoom-slideshow.js')); ?>"></script>

<!-- XZOOM JQUERY PLUGIN  -->
<script src="<?php echo e(asset('js/xzoom.js')); ?>"></script>
<script src="<?php echo e(asset('js/image_gallery.js')); ?>"></script>
<script src="<?php echo e(asset('js/script.js')); ?>"></script>
<script src="<?php echo e(asset('js/cart.js')); ?>"></script>
<script src="<?php echo e(asset('js/apply_coupon_code.js')); ?>"></script>


<!-- Modal Popup For editing address-->
<script>
    $(document).ready(function () {

        $('#add').on('click', function () {
            $("#load_modal_add").load(addressAddUrl);
        });

        $('.edit_address').on('click', function () {
            //console.log("hello");
            var id = $(this).attr('data-id');
            //alert(id);
            var reExp = /id/;
            var url = addressEditUrl;
            var editUrl = url.replace(reExp, id);

            $("#load_modal_edit").load(editUrl);
        });


    });

</script>
<script src="<?php echo e(asset('js/address_book.js')); ?>"></script>


</body>
</html>
