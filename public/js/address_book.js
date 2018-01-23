$(document).ready(function() {



    /*Function For Saving New Address*/

        $( "form" ).on( "submit", function() {

            console.log('hello');
            console.log( $( this ).serialize() );

        });




    /*function for making address primary*/
    $('.primary_address').click(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = $(this).attr('data-id');
        var checkboxValue = $(this).prop("checked");
       // console.log(id);
        //console.log(checkboxValue);

        $.ajax({

            type: "POST",
            url: makeAddressPrimary,
            data: {'id': id , 'checkboxValue' : checkboxValue},
            dataType: 'json',
            success: function (data) {
               console.log(data);




            }
        });

    });
});