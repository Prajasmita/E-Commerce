
$(function () {
    $('#example1').DataTable({
        "ajax":{
            "url": dataTableUrl,
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
            {"orderable":true ,"orderSequence": ["asc" ,"desc"],"targets": [3]},
            {"orderable":true ,"orderSequence": ["asc" ,"desc"],"targets": [4]},
            {"orderable":false,"targets": [5]}
        ],
        "columns": [
            {data: 'id'},
            {data: 'first_name'},
            {data: 'last_name'},
            {data: 'email'},
            {data: 'role_id'},
            {data: 'id'}
        ],

        "rowCallback": function( row, data, index ) {

            $('td:eq(0)' , row).html(
                index+1
            );

            var reExp = /id/;
            var showUrl = dataTableViewUrl;
            var ViewUrl = showUrl.replace(reExp, data.id);

            var editUrl = dataTableEditUrl;
            var EditUrl = editUrl.replace(reExp,data.id);

            var deleteUrl = dataTableDeleteUrl;
            var DeleteUrl = deleteUrl.replace(reExp,data.id);

            $('td:eq(5)', row).html(

                '<a href="'+ViewUrl+'" title="View User"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>&nbsp;' +

                 '<a href="'+EditUrl+'" title="Edit User"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>&nbsp;' +

                '<a href="'+DeleteUrl+'"   title="Delete User"><button type="submit" class="btn btn-danger btn-xs" title="Delete User" onclick="return confirm(&quot;Are you sure you want to delete this user ?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></a>');
       }
    });
})

