$(document).ready(function() {
    var presentCartCount = ($(this).attr("data-count"));

    //console.log(presentCartCount);


    addToWishlist();
    addToCart();

    /*Main function*/
    $('.cat_nav').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id =($(this).attr("data-id"));
        $.ajax({
            type:"POST",
            url:base_url_cat,
            data:{id:id},
            dataType: 'json',
            success: function (output) {

                //console.log(output);exit;

                var html = "";
                var hidden = "hidden_field";
                if (authUser) {
                    hidden = "";
                }
                var products = output[0];
                var my_wishlist = output[1];
                var cart_product = output[2];

                if (!(products.length === 0) ) {

                    $.each(products, function (index, data) {

                        console.log(data);
                        /*var quantity = $("proinfo"+index).attr("data-qty");

                        console.log(quantity);*/
                        var value = data.products.id;

                        var image = data.products.image;
                        if (image == null) {
                            image = 'defaultimage.jpeg';
                        }
                        else {
                            image = data.products.image.product_image_name;
                        }

                        html += "                                <div class=\"col-sm-3 proinfo"+index+"\">\n" +
                            "                                    <div class=\"product-image-wrapper\">\n" +
                            "                                        <div class=\"single-products\">\n" +
                            "                                            <div  class=\"productinfo text-center\">\n" +
                            "                                                <img class=\"show_img\" src=" + base_url + "/img/product/" + image + "\>\n" +
                            "                                                <h2>$" + data.products.price + "</h2>\n" ;

                        if(authUser){
                            html +="<p><a href=\"" + base_url + '/product_details/' + data.products.id + "\" >" + data.products.product_name + "</a></p>\n";
                        }else{
                            html +="<p><a href=\"" + base_url + '/register'+"\" >" + data.products.product_name + "</a></p>\n";
                        }
                        if(data.products.quantity > 0){
                            if ($.inArray(value, cart_product) != -1) {

                                html += "<a href=\"javascript:void(0)\" class=\" btn btn-default link_text_color add-to-cart \"><i class=\"glyphicon glyphicon-ok\"></i> Added to cart</a>\n";
                            } else {
                                html += "<a href=\"javascript:void(0)\" class=\"product_id_cart" + data.products.id + " cart-data btn btn-default add-to-cart\"  data-id=" + data.products.id + " name = \"notify\" onclick=\"$.notify('Product Added To Your Cart.','success');\"><i class=\"fa fa-shopping-cart\"></i> Add to cart</a>\n";
                            }
                        }
                        else{
                            html += "<br/><a href=\"javascript:void(0)\" class=\" btn btn-default link_text_color pd_wl_btn add-to-cart \" disabled='disabled'> Out Of Stock</a>\n";
                        }
                        html += "                                       <div  class=\" choose nav nav-pills nav-justified " + hidden + "\">\n";
                        if ($.inArray(value, my_wishlist) != -1) {

                            html += "<li><a class=\"link_text_color\"><i class=\" glyphicon glyphicon-ok  \"></i> Added to Wishlist</a></li>\n";
                        } else {
                            html += "<li class=\"product_id_" + data.products.id + " choose\"><a class=\"wishlist link_text_color \" href=\"javascript:void(0)\" data-id=" + data.products.id + " name = \"notify\" onclick=\"$.notify('Product Added To Your Wish List.','success');\"><i class=\"fa fa-plus-square \"></i> Add to Wishlist</a></li>\n";
                        }
                        html += "                                            </div>\n" +
                            "                                            </div>\n" +
                            "                                        </div>\n" +
                            "                                        </div>\n" +
                            "                                   </div>\n";


                    });


                    $('#category_product').html(html);

                }
                else {
                    var html = "";
                    html += "<div class=\"productinfo text-center\">\n" +
                        "                    <br/>\n" +
                        "                        <p class=\"text-center\"><strong>Sorry, No item available.</strong></p>\n" +
                        "                    <br/>\n" +
                        "                    </div>";
                    $('.proinfo0').html(html);

                    $('.proinfo1').empty();$('.proinfo2').empty();$('.proinfo3').empty();
                }
                    addToWishlist();
                    addToCart();

            }
        });
    });


    /*function for add to wish list*/
    function addToWishlist() {
        $('.wishlist').on('click',function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var product_id = ($(this).attr("data-id"));

            var current_wishlist_count = $('#wishlist_count').attr("data-wishlcount");

            var changed_count = parseInt(current_wishlist_count) + parseInt(1);

            $('#wishlist_count').attr("data-wishlcount",changed_count);

            $.ajax({
                type: "POST",
                url: wishlistUrl,
                dataType: 'json',
                data: {id: product_id},
                success: function (data) {
                  // console.log(data);exit;
                    if (data == "true") {

                        var html = "";

                        html = "<a class=\"link_text_color \"><i class=\" glyphicon glyphicon-ok\" ></i> Added to Wishlist</a>";

                        $('.product_id_' + product_id).html(html);

                        var html1='';

                        html1 = '<li><a id="wishlist_count" href="'+base_url+'/wishlist"><i\n' +
                            '                                            class="fa fa-star"></i> Wishlist ('+changed_count+')</a></li>';

                        $('#wishlist_count').html(html1);

                    }
                }

            });

        });
    }

    /*function for add to cart*/
    function addToCart() {
        $('.cart-data').click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = ($(this).attr("data-id"));
            var _this = $(this);

            var presentCartCount = $('.cart-count').attr("data-count");
            if(presentCartCount)
                var changedCartCount = parseInt(presentCartCount) + parseInt(1);

            var count = $('.qty').attr("data-value");
            if(count > 0)
                var changedCartCount = parseInt(count) + parseInt(presentCartCount);

            var quantity =  count ? count : 1 ;

            $.ajax({
                type: "POST",
                url: cartUrl,
                data: {id: id , qty : quantity},
                dataType: 'json',
                success: function (data) {

                    if (data == "true") {

                       $('.cart-count').attr("data-count",changedCartCount);

                        _this.removeClass( "cart-data add-to-cart");
                        _this.attr("disabled", true);
                        _this.addClass( "added-to-cart" );

                        var html = "";
                        html = "<i class=\" glyphicon glyphicon-ok\"  ></i> Added to Cart";
                        _this.html(html);

                        var html1 = "";
                        html1 = "<i class=\"fa fa-shopping-cart cart-count\"></i> Cart("+changedCartCount+")\n";

                        $('.cart-count').html(html1);
                    }

                }

            });
        });
    }

    $('.wishlist_delete').click(function () {

        var id = ($(this).attr("data-id"));

        var current_wishlist_count = $('.wishlist_delete').attr("data-wlcount");

        var changed_count = parseInt(current_wishlist_count)-parseInt(1);

        $('.wishlist_delete').attr("data-wlcount",changed_count);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "Delete",
            url: wishlistDeleteUrl,
            data: {id: id},
            dataType: 'json',
            success: function (data) {
                if (data == "true") {

                    $('#delete_wishlist_' + id).animate({backgroundColor: "#fbc7c7"}, "fast")
                        .animate({opacity: "hide"}, "slow");


                    var html='';

                    html = '<li><a class=\"active\" id="wishlist_count" href="'+base_url+'/wishlist"><i\n' +
                        '                                            class="fa fa-star"></i> Wishlist ('+changed_count+')</a></li>';

                    $('#wishlist_count').html(html);

                    if(changed_count === 0){

                       var html1 = '';
                        html1 = "<div>\n" +
                            "                                <br/>\n" +
                            "                                <p class=\"text-center\"><strong>You have no items in the Wish List.</strong></p>\n" +
                            "                            </div>";
                        $('.no-item').html(html1);
                    }
                }
            }
        });
    });
});
