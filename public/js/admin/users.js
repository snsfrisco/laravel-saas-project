(function($){

    "use strict";

    //datatable
    var table=$('#reports_table').DataTable( {
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-4'i><'col-sm-8'p>>",
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fas fa-copy"></i> '+trans("Copy"),
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fas fa-file-excel"></i> '+trans("Excel"),
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fas fa-file-csv"></i> '+trans("CSV"),
                titleAttr: 'CSV'
            },
            /*{
                extend:    'pdfHtml5',
                text:      '<i class="fas fa-file-pdf"></i> '+trans("PDF"),
                titleAttr: 'PDF'
            },*/
            // {
            //   extend:    'colvis',
            //   text:      '<i class="fas fa-eye"></i>',
            //   titleAttr: 'PDF'
            // }
        ],
        "processing": true,
        "serverSide": true,
        "bSort" : false,
          "ajax": {
              url:url("admin/get_users")
          },
          // orderCellsTop: true,
          fixedHeader: true,
          "columns": [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
              {data:"name"},
              {data:"user_site.site", render:function(data, type, row){
                  return (row.user_site) ? (row.user_site.site ? row.user_site.site.name : '' ) : '';
              }, searchable:false },
              {data:"user_lab.lab", render:function(data, type, row){
                  return (row.user_lab) ? (row.user_lab.lab ? row.user_lab.lab.name : '' ) : '';
              }, searchable:false},
              {data:"email"},
              {data:"roles"},
              {data:"active_cb"},
              {data:"action",sortable:false,searchable:false,orderable:false}
          ],
          "language": {
            "sEmptyTable":     trans("No data available in table"),
            "sInfo":           trans("Showing")+" _START_ "+trans("to")+" _END_ "+trans("of")+" _TOTAL_ "+trans("records"),
            "sInfoEmpty":      trans("Showing")+" 0 "+trans("to")+" 0 "+trans("of")+" 0 "+trans("records"),
            "sInfoFiltered":   "("+trans("filtered")+" "+trans("from")+" _MAX_ "+trans("total")+" "+trans("records")+")",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     trans("Show")+" _MENU_ "+trans("records"),
            "sLoadingRecords": trans("Loading..."),
            "sProcessing":     trans("Processing..."),
            "sSearch":         trans("Search")+":",
            "sZeroRecords":    trans("No matching records found"),
            "oPaginate": {
                "sFirst":    trans("First"),
                "sLast":     trans("Last"),
                "sNext":     trans("Next"),
                "sPrevious": trans("Previous")
            },
          },
          "initComplete": function( settings, json){
            $('[data-toggle="tooltip"]').tooltip();
          }
    });

    //active
    $('#users').addClass('active');
    $('#users_roles_link').addClass('active');
    $('#users_roles').addClass('menu-open');

    //prepare edit user page
    var user_roles=$('#user_roles').val();

    if(user_roles!=null)
    {
        var user_roles= JSON.parse(user_roles);
        var roles=[];
        console.log('yes');
        user_roles.forEach(function(role){
            roles.push(parseInt(role.role_id));
        });
        console.log(roles);

        $('#roles_assign').val(roles).trigger('change');
    }

    $('.select2').select2();


    //delete user
    $(document).on('click','.delete_user',function(e){
        e.preventDefault();
        var el=$(this);
        swal({
            title: trans("Are you sure to delete user ?"),
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: trans("Delete"),
            cancelButtonText: trans("Cancel"),
            closeOnConfirm: false
        },
        function(){
            $(el).parent().submit();
        });
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })

})(jQuery);
