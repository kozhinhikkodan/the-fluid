  <script type="text/javascript">
    
    <?php if(isset($group) && $group!=''){ ?>
      $('#table_filter_group').val('<?= $group ?>').trigger('change');
    <?php } ?>

    function GetStartDate() { return $('#table_filter_start_date').val();}
    function GetEndDate() { return $('#table_filter_end_date').val(); }
    function GetStatus() { return $('[name=table_filter_status]:checked').val(); }
    function GetGroup() { return $('#table_filter_group').val(); }
    function GetHospital() { return $('#table_filter_hospital').val(); }

    var cases_view_table = $('#cases_view_table').DataTable({

      "ajax":{
        url :"<?= base_url().'cases/select_cases' ?>",
        type: "post",
        data: function(d){
          d.start_date = GetStartDate();
          d.end_date = GetEndDate();
          d.status = GetStatus();
          d.group = GetGroup();
          <?php if($page=='hospital_profile') { ?>
            d.hospital = '<?= $hospital_data->hospital_id ?>';
          <?php } else { ?>
            d.hospital = GetHospital();
          <?php } ?>

        }
      },

    // serverSide: true,
    responsive: true,
    // searchDelay: 500,
    // processing: true,
    // scrollX:true,
    // dom: 'Bfrtip',
    // buttons: [
    // 'csv', 'excel', 'pdf', 'print'
    // ],
    // buttons:[
    // {
    //   extend: 'csv',
    //   exportOptions: {
    //     columns: [ "thead th:not(.noExport)" ]
    //   }
    // }
    // ,{
    //   extend: 'excel',
    //   exportOptions: {
    //     columns: [ "thead th:not(.noExport)" ]
    //   }
    // },
    // {
    //   extend: 'pdf',
    //   exportOptions: {
    //     columns: [ "thead th:not(.noExport)" ]
    //   }
    // },
    // {
    //   extend: 'print',
    //   exportOptions: {
    //     columns: [ "thead th:not(.noExport)" ]
    //   }
    // }
    // ],



    columnDefs: [
    { 
      orderable: false, 
      targets: [8],

    },
    {
      className:'d-none noExport',
      targets:[9,10,11,12,13<?php if($page=='hospital_profile') { echo ",4"; } ?>]
    }
    ]

  });

    $(".table_filters").on("change", function() {
      cases_view_table.ajax.reload();
    });


    $('#table_filter_start_date,#table_filter_end_date,#case_date').datepicker({
      format: 'dd-mm-yyyy'
    });

    $('#case_hospital,#case_hospital_edit,#table_filter_hospital').select2({
      placeholder: 'Select Hospital'
    });

    $('#table_filter_group,#case_group,#case_group_edit').select2({
      placeholder: 'Select Group'
    });


    $('body').on('click', '#case_edit_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#case_date_edit').val(row.eq(2).text());
      $('#case_group_edit').val(row.eq(9).text()).trigger('change');
      $('#units_edit').val(row.eq(10).text());
      $('#case_hospital_edit').val(row.eq(111).text()).trigger('change');
      $('#patient_name_edit').val(row.eq(12).text());
      $('#patient_contact_edit').val(row.eq(13).text());
      $('#case_id_edit').val(row.eq(1).text());
    });

    $('body').on('click', '#case_delete_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#case_id_delete').val(row.eq(1).text());
    });

    $('body').on('click', '#case_close_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#case_id_close').val(row.eq(1).text());
      var status = row.eq(6).text().toLowerCase();
      if(status=='open'){
        $('[name=status][value=0]').prop('checked',true);
      }else{
        $('[name=status][value=1]').prop('checked',true);
      }

    });

  </script>