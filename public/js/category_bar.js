$(document).ready(function() {
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
                var html = "";
                var hidden = "hidden_field";
                if(authUser){
                    hidden = "";
                }
                var products = output[0];
                var my_wishlist = output[1];
                var cart_product = output[2] ;

                $.each(products ,function (index,data) {

                    var value = data.products.id;

                        html += "                                <div class=\"col-sm-3\">\n" +
                            "                                    <div class=\"product-image-wrapper\">\n" +
                            "                                        <div class=\"single-products\">\n" +
                            "                                            <div class=\"productinfo text-center\">\n" +
                            "                                                <img class=\"show_img\" src="+base_url+"img/product/"+data.products.image.product_image_name+"\>\n" +
                            "                                                <h2>$"+data.products.price+"</h2>\n" +
                            "                                                <p><a href=\""+productDetailsUrl+data.products.id+"\" >"+data.products.product_name+"</a></p>\n" ;
                                                                            if($.inArray(value, cart_product) != -1) {

                                                                                html += "<a href=\"javascript:void(0)\" class=\" btn btn-default product-added \"><i class=\"glyphicon glyphicon-ok\"></i>Added to cart</a>\n";
                                                                            }else {
                                                                                html += "<a href=\"javascript:void(0)\" class=\"product_id_cart"+data.products.id+" cart-data btn btn-default add-to-cart\"  data-id="+data.products.id+" ><i class=\"fa fa-shopping-cart\"></i>Add to cart</a>\n";
                                                                            }
                            html += "                                       <div  class=\" choose nav nav-pills nav-justified "+hidden+"\">\n" ;
                                                                            if($.inArray(value, my_wishlist) != -1) {

                                                                                html += "<li><a class=\"link_text_color\"><i class=\" glyphicon glyphicon-ok\"></i>Added to Wishlist</a></li>\n";
                                                                            }else {
                                                                                html += "<li class=\"product_id_"+data.products.id+" choose\"><a class=\"wishlist link_text_color \" href=\"javascript:void(0)\" data-id="+data.products.id+"><i class=\"fa fa-plus-square \"  ></i> Add to wishlist</a></li>\n";
                                                                            }
                        html += "                                            </div>\n" +
                            "                                            </div>\n" +
                            "                                        </div>\n" +
                            "                                        </div>\n" +
                            "                                   </div>\n" ;


                });

              $('#category_product').html(html);
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

            $.ajax({
                type: "POST",
                url: wishlistUrl,
                dataType: 'json',
                data: {id: product_id},
                success: function (data) {
                  // console.log(data);exit;
                    if (data == "true") {
                        var html = "";
                        html = "<a class=\"link_text_color \"><i class=\" glyphicon glyphicon-ok\"  ></i>Added to Wishlist</a>";

                        $('.product_id_' + product_id).html(html);
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
            var presentCartCount = ($(this).attr("data-count"));
            var changedCartCount = parseInt(presentCartCount) + parseInt(1);

            $.ajax({
                type: "POST",
                url: cartUrl,
                data: {id: id},
                dataType: 'json',
                success: function (data) {

                    if (data == "true") {

                        $('.cart-data').attr("data-count",changedCartCount);

                        var html = "";
                        html = "<a class=\"link_text_color product-added\"><i class=\" glyphicon glyphicon-ok\"  ></i>Added to Cart</a>";
                        $('.product_id_cart' + id).html(html);

                        var html1 = "";
                        html1 = "<li><a href="+base_url+"cart\><i class=\"fa fa-shopping-cart cart-count\"></i>Cart("+changedCartCount+")</a></li>\n";
                        $('.cart-count').html(html1);
                    }

                }

            });
        });
    }










});
