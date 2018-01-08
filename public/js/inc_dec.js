$(document).ready(function() {

    $('.qty_plus').click(function () {


        var currentVal = parseInt($('#quantity').val());

        var maxVal = parseInt($('#quantity').attr("max"));
       // console.log(maxVal);

        if( currentVal < maxVal){
            currentVal= currentVal+1;
            $('#quantity').val(currentVal);
        }

    });
    $('.qty_minus').click(function () {

        //console.log('hii');

        var currentVal =parseInt($('#quantity').val());

        if(!currentVal || currentVal == NaN || currentVal == 0 || currentVal < 0)
            currentVal = 1;

        if(currentVal > 1)
        currentVal= currentVal-1;
        $('#quantity').val(currentVal);



    });
});









