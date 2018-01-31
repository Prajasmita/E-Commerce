$(document).ready(function() {

    /*function for making address primary*/
    $('.primary_address').click(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var checked = $(this).prop('checked');

        if(checked){
                $(".primary_address").prop("checked", false);
        }


    var id = $(this).attr('data-id');

        $.ajax({

            type: "POST",
            url: makeAddressPrimary,
            data: {'id': id },
            dataType: 'json',
            success: function (data) {
                //console.log(data);i
                if (data == "true") {
                    $("#primary_"+id).prop("checked", true);
                   var html = "";
                    html += "<td class=\"primary_"+id+"\">Primary</td>\n";
                    $('.primary_'+id).html(html);
                }


            }
        });
    });
});