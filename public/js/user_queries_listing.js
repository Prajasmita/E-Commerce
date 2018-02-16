
$(function () {

    //console.log(adminNoteUrl);exit;
    $('#queries').DataTable({
        "ajax":{
            "url": dataTableContactAdminUrl,
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
            {"orderable":false,"targets": [4]},

        ],
        "columns": [
            {data: 'id'},
            {data: 'name'},
            {data:'email'},
            {data:'contact_no'},
            {data: 'id'}

        ],

        "rowCallback": function( row, data, index ) {

            //console.log(data);
            $('td:eq(0)' , row).html(
                index+1
            );

            if(data.note_admin){
                $('td:eq(4)', row).html(

                    '<button type="button" id="reply" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Replied</button>'
                );
            }else{
                $('td:eq(4)', row).html(
                    '<a href="'+base_url+'/admin/admin_note/'+data.id+'"><button type="button" id="reply" class="btn btn-info btn-xs"><i class="fa fa-reply" aria-hidden="true"></i> Reply</button>'
                );
            }

        }

    });
});
