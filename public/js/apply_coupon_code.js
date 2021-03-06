$(document).ready(function(){
    getCouponCodeAndTotal();
    removeCouponCode();

    function getCouponCodeAndTotal(){
        $('#apply_coupon').click(function(){

            var couponCode = ($('#coupon_input').val());

            if(couponCode == ""){
                $.notify('Please Enter Coupon Code.','info');
            }
            else{
                var total = ($('#total').attr("data-total"));

                applyCouponCode(couponCode,total);
            }

        });
    }

    function applyCouponCode(couponCode,total) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var total = $('#total').attr("data-total");
        var shipping_cost = $('#shipping_cost').attr("data-shipping_cost");

        //alert(shipping_cost);
        if(shipping_cost == 0){
            shipping_cost = "Free";
        }
        $.ajax({
            type: "POST",
            url: couponApplyUrl,
            data:{'couponCode':couponCode,'total':total},
            dataType: 'json',
            success: function (data) {


                data1 = data[0];
                data2 = data[1];


                var html="";

                html+="<button class=\"btn btn-sm btn-danger\" type=\"button\" id=\"remove_code\"><header class=\"glyphicon glyphicon-remove \"></header></button>\n";

                $('#coupon_button').html(html);



                if (data !== "false") {

                    var finalTotal = parseInt(total ) + parseInt((shipping_cost == "Free") ? 0 : shipping_cost)- parseInt(data);


                    var html = "";
                    html = "   <table class=\"table table-condensed total-result order-amount\">\n" +
                        "                                    <tr>\n" +
                        "                                        <td>Cart Sub Total</td>\n" +
                        "                                        <td id=\"total\" data-total="+total+">$"+total+"</td>\n" +
                        "                                    </tr>\n" +
                        "                                    <tr>\n" +
                        "                                        <td>Discount</td>\n" +
                        "                                        <td id=\"discount\">$"+data1+"</td>\n" +
                        "                                    </tr>\n" +
                        "                                    <tr class=\"shipping-cost\">\n" +
                        "                                        <td>Shipping Cost</td>\n" +
                        "                                        <td id=\"shipping_cost\" data-shipping_cost="+shipping_cost+" >$"+shipping_cost+"</td>\n" +
                        "                                    </tr>\n" +
                        "                                    <tr>\n" +
                        "                                        <td>Total</td>\n" +
                        "                                        <td id=\"finalTotal\" data-finalTotal="+finalTotal+">$"+finalTotal+"</td>\n" +
                        "                                    </tr>\n" +
                        "                                </table>\n" +
                        "                                        <input type=\"text\"  name=\"shipping_charge\" class=\"hidden_field\" value="+shipping_cost+">\n"+
                        "                                        <input type=\"text\"  name=\"grand_total\" class=\"hidden_field\" value="+finalTotal+">\n"+
                        "                                        <input type=\"text\" id=\"disc\" name=\"discount\" class=\"hidden_field\" value="+data1+">\n"+
                        "                                        <input type=\"text\"  name=\"coupon\" class=\"hidden_field\" value="+data2+">\n";


                    $('.order-amount').html(html);

                    $.notify('Coupon code applied successfully.','success');

                    removeCouponCode();

                }
                else{

                    $.notify('Please Enter Valid Coupon code.','error');
                    removeCouponCode();
                }
            }

        });

    }

    function removeCouponCode() {
        $('#remove_code').click(function() {

            $('#coupon_input').val("");
            if($('#coupon_input').val("")){

                var html = "";
                html += "<button class=\"btn btn-sm\" type=\"button\" id=\"apply_coupon\"><header class=\"glyphicon glyphicon-ok \"></header></button>\n";

                $('#coupon_button').html(html);

                var html1 = "";
                html1 += "<td id=\"discount\">$0</td>";

                $('#discount').html(html1);

                var html2 = "";
                html2 += "<input type=\"text\" id=\"disc\" name=\"discount\" class=\"hidden_field\" value="+0+">\n";

                $('#disc').html(html2);

            }
            $.notify('Removed Coupon Code','warn');

            getCouponCodeAndTotal();

        });
    }


});
