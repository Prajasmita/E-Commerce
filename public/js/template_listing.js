
$(function () {
    $('#template').DataTable({
        "ajax":{
            "url": dataTableEmailTemplateUrl,
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        "paging": true,
        "ordering": true,
        "info": true,
        "lengthMenu": [[2, 5, 10, 25, -1], [2, 5, 10, 25, "All"]],
        "pageLength": 5,
        "order": [[1, "asc"]],
        "processing": true,
        "serverSide": true,
        "columnDefs": [
            {"orderable": false, "targets": [0]},
            {"orderable": true , "orderSequence": ["asc" ,"desc"], "targets": [1]},
            {"orderable":true,"orderSequence": ["asc" ,"desc"],"targets": [2]},
            {"orderable":false,"targets": [3]},
        ],
        "columns": [
            {data: 'id'},
            {data: 'title'},
            {data:'subject'},
            {data:'id'}
        ],

        "rowCallback": function( row, data, index ) {

            console.log(data);
            $('td:eq(0)' , row).html(
                index+1
            );

            var reExp = /id/;
            var showUrl = dataTableEmailTemplateViewUrl;
            var ViewUrl = showUrl.replace(reExp, data.id);

            console.log(ViewUrl);
            var editUrl = dataTableEmailTemplateEditUrl;
            var EditUrl = editUrl.replace(reExp,data.id);


            $('td:eq(3)', row).html(

                '<a href="'+ViewUrl+'" title="View templates"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>&nbsp;' +

                '<a href="'+EditUrl+'" title="Edit templates"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>&nbsp;');

        }
    });
})



