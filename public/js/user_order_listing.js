
$(function () {
    $('#user_orders').DataTable({
        "ajax":{
            "url": dataTableUserOrderUrl,
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        "paging": true,
        //"ordering": true,
        "info": true,
        "lengthMenu": [[2, 5, 10, 25, -1], [2, 5, 10, 25, "All"]],
        "pageLength": 5,
        //"order": [[0, "asc"]],
        "processing": true,
        "serverSide": true,
        "columnDefs": [
            {"orderable": false, "targets": [0]},
            {"orderable": false , "targets": [1]},
            {"orderable":false,"targets": [2]},
            {"orderable":false,"targets": [3]},
            {"orderable": false, "targets": [4]},
            {"orderable": false, "targets": [5]},
            {"orderable": false, "targets": [6]},


        ],
        "columns": [
            {data: 'id'},
            {data: 'date'},
            {data: 'order_id'},
            {data:'total'},
            {data:'status'},
            {data:'payment'},
            {data:'id'}

        ],

        "rowCallback": function( row, data, index ) {

            $('td:eq(0)' , row).html(
                index+1
            );

            $('td:eq(3)' , row).html(
                '$'+data.total
            );

            var reExp = /id/;
            var showUrl = dataTableUserOrderDetail;
            var ViewUrl = showUrl.replace(reExp, data.id);

            //console.log(ViewUrl);


            $('td:eq(6)', row).html(

                '<a href="'+ViewUrl+'" title="View user_orders"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>&nbsp;');

        }
    });
})



