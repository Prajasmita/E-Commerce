$(document).ready(function() {
    $('.cat_nav').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id =($(this).attr("data-id"));
        console.log(id);
        $.ajax({
            type:"POST",
            url:base_url_cat,
            data:{id:id},
            dataType: 'json',
            success: function (output) {
                //console.log(output);

                var html = "";
              /*  $.each(output ,function (vip,data) {
                    console.log(data.products.image.product_image_name);

                });*/
                $.each(output ,function (vip,data) {
                   //console.log(data.products);

                    html += "                                <div class=\"col-sm-3\">\n" +
                        "                                    <div class=\"product-image-wrapper\">\n" +
                        "                                        <div class=\"single-products\">\n" +
                        "                                            <div class=\"productinfo text-center\">\n" +
                        "                                                <img class=\"show_img\" src="+base_url+"img/product/"+data.products.image.product_image_name+"\>\n" +
                        "                                                <h2>$"+data.products.price+"</h2>\n" +
                        "                                                <a href=\"http://127.0.0.1:8000/product_details/"+data.products.id+"\" >"+data.products.product_name+"</a>\n" +
                        "                                                <a href=\"#\" class=\"btn btn-default add-to-cart\"><i class=\"fa fa-shopping-cart\"></i>Add to cart</a>\n" +
                        "                                            </div>\n" +
                        "                                        </div>\n" +
                        "                                    </div>\n" +
                        "                            </div>";

                });


              $('#category_product').html(html);

            }
        });
    });
});
