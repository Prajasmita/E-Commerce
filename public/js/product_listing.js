
$(function () {
    $('#product').DataTable({
        "ajax":{
            "url": dataTableProductUrl,
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
            {"orderable":false,"targets": [2] , "data": "product_image_name",
                "render" : function ( url, type, full) {
                    return '<img class="index_img" src="'+baseUrl+productPath+url+'"   />';
                }},
            {"orderable":false,"targets": [3]},
            {"orderable":false,"targets": [4]}



        ],
        "columns": [
            {data: 'id'},
            {data: 'product_name'},
            {data: 'image_name'},
            {data: 'price'},
            {data: 'id'},
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

            var reExp = /id/;
            var showUrl = dataTableProductViewUrl;
            var ViewUrl = showUrl.replace(reExp, data.id);

            var editUrl = dataTableProductEditUrl;
            var EditUrl = editUrl.replace(reExp,data.id);

            var deleteUrl = dataTableProductDeleteUrl;
            var DeleteUrl = deleteUrl.replace(reExp,data.id);

            $('td:eq(4)', row).html(

                '<a href="'+ViewUrl+'" title="View product"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>&nbsp;' +

                '<a href="'+EditUrl+'" title="Edit product"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>&nbsp;' +

                '<a href="'+DeleteUrl+'"   title="Delete product"><button type="submit" class="btn btn-danger btn-xs" title="Delete User" onclick="return confirm(&quot;Are you sure you want to delete this product ?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></a>');
        }
    });
})



