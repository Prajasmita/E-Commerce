$(document).ready(function() {
    addToWishlist();
    $('.cat_nav').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id =($(this).attr("data-id"));
       //console.log(authUser);
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
                //console.log(hidden);

                $.each(output ,function (vip,data) {

                    html += "                                <div class=\"col-sm-3\">\n" +
                        "                                    <div class=\"product-image-wrapper\">\n" +
                        "                                        <div class=\"single-products\">\n" +
                        "                                            <div class=\"productinfo text-center\">\n" +
                        "                                                <img class=\"show_img\" src="+base_url+"img/product/"+data.products.image.product_image_name+"\>\n" +
                        "                                                <h2>$"+data.products.price+"</h2>\n" +
                        "                                                <p><a href=\"http://127.0.0.1:8000/product_details/"+data.products.id+"\" >"+data.products.product_name+"</a></p>\n" +
                        "                                                <a href=\"#\" class=\"btn btn-default add-to-cart\"><i class=\"fa fa-shopping-cart\"></i>Add to cart</a>\n" +
                        "                                        <div  class=\" choose nav nav-pills nav-justified "+hidden+"\">\n" +
                        "                                                    <li class=\"product_id_"+data.products.id+" choose\"><a class=\"wishlist link_text_color \" href=\"javascript:void(0)\" data-id="+data.products.id+"><i class=\"fa fa-plus-square \"  ></i> Add to wishlist</a></li>\n" +
                        "                                                </div>\n" +
                        "</div>\n" +
                        "</div>\n" +
                        "                                    </div>\n" +
                        "                            </div>";
                });

              $('#category_product').html(html);
                addToWishlist();
            }
        });
    });

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
                    //  console.log(data);exit;
                    if (data == "true") {
                        var html = "";
                        html = "<a class=\"link_text_color\"><i class=\" glyphicon glyphicon-ok\"  ></i>Added to Wishlist</a>";
                        $('.product_id_' + product_id).html(html);
                    }
                }

            });

        });
    }
});
