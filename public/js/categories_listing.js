
$(function () {
    $('#categories').DataTable({
        "ajax":{
            "url": dataTableCatUrl,
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
            {"orderable":false,"targets": [2]},
            {"orderable":false,"targets": [3]},
        ],
        "columns": [
            {data: 'id'},
            {data: 'name'},
            {data:'category'},
            {data:'id'}
        ],

        "rowCallback": function( row, data, index ) {

            console.log(row);
            $('td:eq(0)' , row).html(
                index+1
            );

            var reExp = /id/;
            var showUrl = dataTableCatViewUrl;
            var ViewUrl = showUrl.replace(reExp, data.id);

            var editUrl = dataTableCatEditUrl;
            var EditUrl = editUrl.replace(reExp,data.id);

            var deleteUrl = dataTableCatDeleteUrl;
            var DeleteUrl = deleteUrl.replace(reExp,data.id);

            $('td:eq(3)', row).html(

                '<a href="'+ViewUrl+'" title="View category"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>&nbsp;' +

                '<a href="'+EditUrl+'" title="Edit category"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>&nbsp;' +

                '<a href="'+DeleteUrl+'"   title="Delete category"><button type="submit" class="btn btn-danger btn-xs" title="Delete User" onclick="return confirm(&quot;Confirmdelete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></a>');
        }
    });
})

