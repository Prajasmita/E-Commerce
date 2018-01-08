$(document).ready(function(){
    $('.wishlist').on('click',function() {
        addToWishlist($(this));
       /* console.log("hiii");
        exit;*/
        /*$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = ($(this).attr("data-id"));
       // console.log(product_id);
        $.ajax({
            type : "POST",
            url : wishlistUrl,
            dataType : 'json',
            data: { id: product_id },
            success: function (data) {
              //  console.log(data);exit;
               if(data == "true")
               {
                   var html = "";
                   html = "<a class=\"link_text_color\"><i class=\" glyphicon glyphicon-ok\"  ></i>Added to Wishlist</a>";
                   $('#product_id_' + product_id).html(html);

               }

            }

        });*/
    });

    function addToWishlist(thisVar) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = (thisVar.attr("data-id"));
        console.log(product_id);
        $.ajax({
            type : "POST",
            url : wishlistUrl,
            dataType : 'json',
            data: { id: product_id },
            success: function (data) {
                //  console.log(data);exit;
                if(data == "true")
                {
                    var html = "";
                    html = "<a class=\"link_text_color\"><i class=\" glyphicon glyphicon-ok\"  ></i>Added to Wishlist</a>";
                    $('#product_id_' + product_id).html(html);

                }

            }

        });
    }
})