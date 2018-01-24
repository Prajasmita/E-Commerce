$(document).ready(function() {
    $(".select-country").change(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var selectedCountry = $(".select-country option:selected").val();
        //console.log(selectedCountry);

        $.ajax({
            type: "POST",
            url: selectStateUrl,
            data: {country: selectedCountry},
            success: function (data) {
                //console.log(data);
                data = $.parseJSON(data)
                var html = "";
                $.each(data, function (index, data) {
                    //console.log(index);
                    //console.log(data.name);

                    html += "<option value=" + data.id + ">" + data.name + "</option>\n";

                    $('.select-state').html(html);

                });


            }

        });

    });
});
