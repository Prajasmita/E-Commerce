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

                        //console.log(index);
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
                            "                                                <img class=\"show_img\" src=" + base_url + "img/product/" + image + "\>\n" +
                            "                                                <h2>$" + data.products.price + "</h2>\n" ;

                        if(authUser){
                            html +="<p><a href=\"" + base_url + 'product_details/' + data.products.id + "\" >" + data.products.product_name + "</a></p>\n";
                        }else{
                            html +="<p><a href=\"" + base_url + 'register'+"\" >" + data.products.product_name + "</a></p>\n";
                        }
                        if ($.inArray(value, cart_product) != -1) {

                            html += "<a href=\"javascript:void(0)\" class=\" btn btn-default link_text_color product-added \"><i class=\"glyphicon glyphicon-ok\"></i>Added to cart</a>\n";
                        } else {
                            html += "<a href=\"javascript:void(0)\" class=\"product_id_cart" + data.products.id + " cart-data btn btn-default add-to-cart\"  data-id=" + data.products.id + " ><i class=\"fa fa-shopping-cart\"></i>Add to cart</a>\n";
                        }
                        html += "                                       <div  class=\" choose nav nav-pills nav-justified " + hidden + "\">\n";
                        if ($.inArray(value, my_wishlist) != -1) {

                            html += "<li><a class=\"link_text_color added\"><i class=\" fa fa-heart \"></i></a></li>\n";
                        } else {
                            html += "<li class=\"product_id_" + data.products.id + " choose\"><a class=\"wishlist link_text_color \" href=\"javascript:void(0)\" data-id=" + data.products.id + "><i class=\"fa fa-plus-square \"></i> Add to Wishlist</a></li>\n";
                        }
                        html += "                                            </div>\n" +
                            "                                            </div>\n" +
                            "                                        </div>\n" +
                            "                                        </div>\n" +
                            "                                   </div>\n";


                    });


                    $('#category_product').html(html);

                } else {
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

            $.ajax({
                type: "POST",
                url: wishlistUrl,
                dataType: 'json',
                data: {id: product_id},
                success: function (data) {
                  // console.log(data);exit;
                    if (data == "true") {
                        var html = "";


                        html = "<a class=\"link_text_color added \"><i class=\" fa fa-heart\"  ></i></a>";

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

                        var html = "";
                        html = "<a href=\"javascript:void(0)\" class=\"link_text_color added-to-cart \"><i class=\" glyphicon glyphicon-ok\"  ></i>Added to Cart</a>";
                        $('.product_id_cart' + id).html(html);

                        var html1 = "";
                        html1 = "<li><a href="+base_url+"cart\><i class=\"fa fa-shopping-cart cart-count\"></i>Cart("+changedCartCount+")</a></li>\n";

                        $('.cart-count').html(html1);
                    }

                }

            });
        });
    }

    $('.wishlist_delete').click(function () {

        var id = ($(this).attr("data-id"));

        console.log(id);

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

                }
            }
        });
    });
});
