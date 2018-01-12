$(document).ready(function(){
    getCouponCodeAndTotal();
    removeCouponCode();
    function getCouponCodeAndTotal(){
        $('#apply_coupon').click(function(){

            var couponCode = ($('#coupon_input').val());
            //alert(couponCode);
            var total = ($(this).attr("data-total"));
            //alert(total);

            applyCouponCode(couponCode,total);

        });
    }

    function applyCouponCode(couponCode,total) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: couponApplyUrl,
            data:{'couponCode':couponCode,'total':total},
            dataType: 'json',
            success: function (data) {
                var html="";

                html+="<button class=\"btn btn-sm btn-danger\" type=\"button\" id=\"remove_code\"><header class=\"glyphicon glyphicon-remove \"></header></button>\n";

                $('#coupon_button').html(html);

                if (data) {
                    //console.log(data);
                    var html ="";
                    html += "<td>"+data+"</td>\n";
                    $('#discount').html(html);

                    removeCouponCode();

                }
                else{

                    alert("This Coupon Code is Invalid.");
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

        }
        getCouponCodeAndTotal();
    });
}



});
