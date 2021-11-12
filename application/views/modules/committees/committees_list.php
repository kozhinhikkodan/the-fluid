<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <!--begin::Card-->
      <div class="card card-custom">
        <div class="card-header">
          <div class="card-title">
            <span class="card-icon">

            </span>
            <h3 class="card-label">List of Committees</h3>
          </div>
          <div class="card-toolbar">

            <!--begin::Button-->
            <a data-toggle="modal" data-target="#committee_add_modal" class="btn btn-dark font-weight-bolder">
              <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>Add New Committee</a>
              <!--end::Button-->

            </div>
          </div>
          <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="committees_view_table" style="margin-top: 13px !important">
              <thead>
                <tr>
                  <th width="5%">SL</th>
                  <th width="30%">Committee Name</th>
                  <th width="5%">Members Count</th>
                  <th width="10%">Actions</th>
                  <th style="display: none;">id</th>
                  <th style="display: none;">user_id</th>
                  <th style="display: none;">copy</th>

                </tr>

              </thead>


            </table>


            <!--end: Datatable-->
          </div>
        </div>
        <!--end::Card-->
      </div>
    </div>
  </div>
  <!--end::Content-->

  <?php $this->load->view('include_modals/committees_modals') ?>

  <script type="text/javascript">
    $('.menu-item-active').removeClass('menu-item-active');
    $('#committees_menu').addClass('menu-item-open menu-item-here');
    $('#committees_menu_1').addClass('menu-item-active');

  </script>


  <script type="text/javascript">

   var committees_view_table = $('#committees_view_table').DataTable({

    "ajax":{
      url :"<?= base_url().'committees/select_committees' ?>",
      type: "post",
      data: function(d){

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
      targets: [3],

    },
    {
      className:'d-none noExport',
      targets:[4,5,6]
    }
    ]

  });

   $('body').on('click', '#committee_edit_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#committee_name_edit').val(row.eq(1).text());
    $('#committee_id_edit').val(row.eq(4).text());
    $('#committee_user_id_edit').val(row.eq(5).text());

  });

   $('body').on('click', '#copy_btn', function() {
    var row = $(this).closest('tr').children('td');
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(row.eq(6).text()).select();
    document.execCommand("copy");
    $temp.remove();
    toastr['info']('Login Details Copied to Clipboard !<br>Use Ctrl+V to Paste');
  });


</script>