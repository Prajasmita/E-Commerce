$(document).ready(function() {
    SelectState();
    $('.plus').click(function () {

        var price = ($(this).parent().attr("data-price"));
        var id = ($(this).parent().attr("data-id"));
        var rowId = ($(this).parent().attr("data-rowid"));
        var currentCartQty = ($(this).parent().attr("data-quantity"));
        var updatedCartQty = parseInt(currentCartQty) + parseInt(1);
        var subtotal = parseInt(updatedCartQty) * parseInt(price);
        updateCart(id, rowId, updatedCartQty,subtotal);

    });

    $('.minus').click(function () {

        var price = ($(this).parent().attr("data-price"));
        var id = ($(this).parent().attr("data-id"));
        var rowId = ($(this).parent().attr("data-rowid"));
        var currentCartQty = ($(this).parent().attr("data-quantity"));
        var updatedCartQty = parseInt(currentCartQty) - parseInt(1);
        var subtotal = parseInt(updatedCartQty) * parseInt(price);
        updateCart(id , rowId ,updatedCartQty,subtotal);

    });

    function updateCart(id, rowId, updatedCartQty,subtotal) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: cartUpdateUrl,
            data: {id: id, rowId: rowId, quantity: updatedCartQty,subtotal :subtotal},
            dataType: 'json',
            success: function (data) {
                if (data !== "false"){

                    $('#qty_' + id).attr("data-quantity",updatedCartQty);

                    $('#qty_' + id).children().val(updatedCartQty);

                    $('#subtotal_' + id).text("$"+subtotal);

                    var html = "";
                    html = "<li><a href="+base_url+"cart\><i class=\"fa fa-shopping-cart cart-count\"></i>Cart("+data+")</a></li>\n";
                    $('.cart-count').html(html);

                }
                else{
                    if(updatedCartQty < 1){
                        alert("You cannot decrease quantity below 1 ");
                    }
                    else{
                        alert("Sorry, We do not have more quantity");
                    }
                }
            },
        });
    }

    $('.cart_quantity_delete').click(function () {
        var id = ($(this).attr("data-id"));
        var rowId = ($(this).attr("data-rowid"));
        var presentCartCount = ($(this).attr("data-count"));

        var changedCartCount = parseInt(presentCartCount) - parseInt(1);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "Delete",
            url: cartDeleteUrl,
            data: {id: id, rowId: rowId},
            dataType: 'json',
            success: function (data) {
                if (data == "true") {

                    $('.cart_quantity_delete').attr("data-count",changedCartCount);

                    $('#cart_product_' + id).animate({backgroundColor: "#fbc7c7"}, "fast")
                        .animate({opacity: "hide"}, "slow");

                    var html2 = "";
                    html2 = "<li><a href="+base_url+"cart\><i class=\"fa fa-shopping-cart cart-count\"></i>Cart("+changedCartCount+")</a></li>\n";
                    $('.cart-count').html(html2);

                    if(changedCartCount == 0){
                        var html = "";

                        html += "<br/><p class=\"text-center\"><strong>You have no items in the shopping cart</strong></p><br/>\n";
                        $('.no-item').html(html);

                        var html1 = "";
                        html1 += "<a class=\"btn btn-default check_out hidden_field\" href=\"\" >Check Out</a>\n";
                        $('.no-item-checkbox').html(html1);


                    }


                }
            }
        });



    });




    function SelectState(){

        $(".select-country").change(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var selectedCountry = $(".select-country option:selected").val();
            //console.log(selectedCountry);

            $.ajax({
                type: "POST",
                url: selectStateUrl ,
                data: { country : selectedCountry },
                success:function (data) {
                    //console.log(data);
                    data = $.parseJSON(data)
                    var html = "";
                    $.each(data ,function (index,data) {
                        //console.log(index);
                        //console.log(data.name);

                        html += "<option value="+data.id+">"+data.name+"</option>\n";

                        $('.select-state').html(html);

                    });


                }

            });

        });

    }






});











