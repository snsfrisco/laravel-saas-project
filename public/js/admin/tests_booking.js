(function($){

    "use strict";

    //active
    $('#tests_library').addClass('active');

    //tests datatable
    var table_tests=$('#analyses_table').DataTable( {
      dom: "<'row'<'col-sm-4'l><'col-sm-4 my-auto d-flex justify-content-center'B><'col-sm-4 text-right'f>>" +
      "<'row'<'col-sm-12 text-xs'tr>>" +
      "<'row'<'col-sm-4'i><'col-sm-8 d-flex justify-content-end'p>>",
      buttons: [
        {
            extend:    'copyHtml5',
            text:      '<i class="fas fa-copy"></i> '+trans('Copy'),
            titleAttr: 'Copy'
        },
        {
            extend:    'excelHtml5',
            text:      '<i class="fas fa-file-excel"></i> '+trans('Excel'),
            titleAttr: 'Excel'
        },
        {
            extend:    'csvHtml5',
            text:      '<i class="fas fa-file-csv"></i> '+trans('CSV'),
            titleAttr: 'CSV'
        },
        /*{
            extend:    'pdfHtml5',
            text:      '<i class="fas fa-file-pdf"></i> '+trans('PDF'),
            titleAttr: 'PDF'
        },*/
        /* {
          extend:    'colvis',
          text:      '<i class="fas fa-eye"></i>',
          titleAttr: 'colvis'
        } */

      ],
      "processing": true,
      "serverSide": true,
      "bSort" : false,
      //"searching" : false,
      //"paging" : false,
      //"info" : false,
      //"buttons" : false,
      scrollX: true,
      scrollY: 400,
      fixedHeader: true,
      stateSave: true,
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Show All"]],
      stateSaveParams: function( settings, d ) {
            d.patient_id        = $('#patient_id').val();
            d.patient_name      = $('#patient_name').val();
            d.from_booking_date = $('#from_booking_date').val();
            d.to_booking_date   = $('#to_booking_date').val();
            d.camp_id           = $('#camp_id').val();
            d.test_id           = $('#test_id').val();
            d.patient_status    = $('#patient_status').val();
            d.test_result       = $('#test_result').val();
      },
      stateLoadParams: function( settings, d ) {
        if (!current_url_has_parameter()){
            $('#patient_id').val(d.patient_id);
            $('#patient_name').val(d.patient_name);
            $('#from_booking_date').val(d.from_booking_date);
            $('#to_booking_date').val(d.to_booking_date);
            $('#camp_id').val(d.camp_id);
            $('#test_id').val(d.test_id);
            $('#patient_status').val(d.patient_status);
            $('#test_result').val(d.test_result);
        }
      },
        "ajax": {
            type: "POST",
            url: url("admin/get_patient_booking"),
            data: function (d) {
                d.patient_id        = $('#patient_id').val();
                d.patient_name      = $('#patient_name').val();
                d.from_booking_date = $('#from_booking_date').val();
                d.to_booking_date   = $('#to_booking_date').val();
                d.camp_id           = $('#camp_id').val();
                d.test_id           = $('#test_id').val();
                d.patient_status    = $('#patient_status').val();
                d.test_result       = $('#test_result').val();
                d._token            = $('meta[name="csrf-token"]').attr('content');
            }
        },
        "columns": [
           {data:"checkbox"},
           {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          { data: "patient_orm_id" },
		   {data:"patient_id"},
           {data:"id"},
		   {data:"barcode",className:'barcode'},
           {data:"patient.first_name"},
           {data:"patient.dob", searchable:false},
           {data:"ScheduleDate", searchable:false},
           {data:"tests.test.name"},
		   {data:"status",className:'editable',searchable:false,orderable:false,sortable:false},
		   {data:"test_result_value",className:'editable',searchable:false,orderable:false,sortable:false},
           {data:"action"}
        ],
		"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			$(nRow).children().each(function (index, td) {
				  var color=$(this).find('select').attr('data-color');
				  var font_color=$(this).find('select').attr('data-font_color');
				  $(nRow).css("background-color", color);
				  $(nRow).css("color", font_color);
			});


		},
        "initComplete": function( settings, json){
            $('[data-toggle="tooltip"]').tooltip();
        },
        "language": {
          "processing": datatable_processing_overlay,
          "sEmptyTable":     trans("No data available in table"),
          "sInfo":           trans("Showing")+" _START_ "+trans("to")+" _END_ "+trans("of")+" _TOTAL_ "+trans("records"),
          "sInfoEmpty":      trans("Showing")+" 0 "+trans("to")+" 0 "+trans("of")+" 0 "+trans("records"),
          "sInfoFiltered":   "("+trans("filtered")+" "+trans("from")+" _MAX_ "+trans("total")+" "+trans("records")+")",
          "sInfoPostFix":    "",
          "sInfoThousands":  ",",
          "sLengthMenu":     trans("Show")+" _MENU_ "+trans("records"),
          "sLoadingRecords": trans("Loading..."),
          // "sProcessing":     trans("Processing..."),
          "sSearch":         trans("Search")+":",
          "sZeroRecords":    trans("No matching records found"),
          "oPaginate": {
              "sFirst":    trans("First"),
              "sLast":     trans("Last"),
              "sNext":     trans("Next"),
              "sPrevious": trans("Previous")
          },
        }


    });


})(jQuery);


function current_url_has_parameter(){
    let searchParams = new URLSearchParams(window.location.search)
    // alert(searchParams.has("status"));
    return searchParams.has("status")
}
