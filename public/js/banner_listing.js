
$(function () {
    $('#banner').DataTable({
        "ajax":{
            "url": dataTableBannerUrl,
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        "paging": true,
        "ordering": true,
        "info": true,
        "lengthMenu": [[2, 5, 10, 25, -1], [2, 5, 10, 25, "All"]],
        "pageLength": 10,
        "order": [[1, "asc"]],
        "processing": true,
        "serverSide": true,
        "columnDefs": [
            {"orderable": false, "targets": [0]},
            {"orderable": true , "orderSequence": ["asc" ,"desc"], "targets": [1]},
            {"orderable":false,"targets": [2] , "data": "banner_image",
                "render" : function ( url, type, full) {
                //console.log(url);
                    return '<img class="index_img" src="'+base_url+'/img/banner/'+url+'"   />';
                }},
            {"orderable":false,"targets": [3]},
            {"orderable":false,"targets": [4]},



        ],
        "columns": [
            {data: 'id'},
            {data: 'banner_name'},
            {data: 'banner_image'},
            {data:'status'},
            {data: 'id'}
        ],

        /*"data": "img",
        "render" : function ( url, type, full) {

            console.log(full);
            return '<img height="50px" width="50px" src="'+full[7]+'"/>';
        },
*/

        "rowCallback": function( row, data, index ) {

            $('td:eq(0)' , row).html(
                index+1
            );
            $('td:eq(3)' , row).html(
                (data.status == 0) ? 'Inactive':'Active'
            );

            var reExp = /id/;
            var showUrl = dataTableBannerViewUrl;
            var ViewUrl = showUrl.replace(reExp, data.id);

            var editUrl = dataTableBannerEditUrl;
            var EditUrl = editUrl.replace(reExp,data.id);

            var deleteUrl = dataTableBannerDeleteUrl;
            var DeleteUrl = deleteUrl.replace(reExp,data.id);

            $('td:eq(4)', row).html(

                '<a href="'+ViewUrl+'" title="View banner"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>&nbsp;' +

                '<a href="'+EditUrl+'" title="Edit banner"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>&nbsp;' +

                '<a href="'+DeleteUrl+'"   title="Delete banner"><button type="submit" class="btn btn-danger btn-xs" title="Delete User" onclick="return confirm(&quot;Are you sure you want to delete this banner ?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></a>');
        }
    });
})

