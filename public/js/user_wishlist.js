$(document).ready(function(){
    $('.wishlist').on('click',function() {
        addToWishlist($(this));
    });

    function addToWishlist(thisVar) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = (thisVar.attr("data-id"));
        //console.log(product_id);
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
                    html = "<a class=\"added\"><i class=\" fa fa-heart \"></i></a>";
                    $('#product_id_' + product_id).html(html);

                }

            }

        });
    }
})