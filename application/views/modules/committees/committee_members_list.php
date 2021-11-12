<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <?php if($this->session->userdata('user_role')=='admin') { ?>

        <div class="card card-custom mb-5">
          <div class="card-body">
            <div class="row">

              <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="form-group ">
                  <label for="expense_head">Committee</label>
                  <select required style="width: 100%" class="form-control table_filters" id="table_filter_committee">
                    <option selected value="all">Select All</option>
                    <?php foreach ($committees as $key => $value) { ?>
                      <option value="<?= $value->committee_id ?>"><?= $value->committee_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> 

            </div>
          </div>
        </div>

      <?php } ?>
      <?php if($this->session->userdata('user_role')=='committee') { ?>
        <input type="hidden" id="table_filter_committee" value="<?= $this->session->userdata('committee_data')->committee_id ?>">
      <?php } ?>


      <!--begin::Card-->
      <div class="card card-custom">
        <div class="card-header">
          <div class="card-title">
            <span class="card-icon">

            </span>
            <h3 class="card-label">List of Committee Members</h3>
          </div>
          <div class="card-toolbar">

            <?php if($this->session->userdata('user_role')=='committee'){ ?>

              <!--begin::Button-->
              <a data-toggle="modal" data-target="#member_add_modal" class="btn btn-dark font-weight-bolder">
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
                </span>Add New Member</a>
                <!--end::Button-->

              <?php } ?>

            </div>
          </div>
          <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="committee_members_view_table" style="margin-top: 13px !important">
              <thead>
                <tr>
                  <th width="5%">SL</th>
                  <th width="30%">Member Info</th>
                  <th width="30%">Committee Name</th>
                  <th width="10%">Actions</th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th style="display: none;">Copy</th>

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

  <?php $this->load->view('include_modals/members_modals') ?>

  <script type="text/javascript">
    $('.menu-item-active').removeClass('menu-item-active');

    <?php if($this->session->userdata('user_role')=='committee') { ?>
      $('#committee_members_menu').addClass('menu-item-active');
    <?php } elseif($this->session->userdata('user_role')=='admin') { ?>
      $('#committees_menu').addClass('menu-item-open menu-item-here');
      $('#committees_menu_2').addClass('menu-item-active');
    <?php } ?>


  </script>


  <script type="text/javascript">
    function GetCommittee() { return $('#table_filter_committee').val(); }

    var committee_members_view_table = $('#committee_members_view_table').DataTable({

      "ajax":{
        url :"<?= base_url().'committees/select_committee_members' ?>",
        type: "post",
        data: function(d){
          d.committee = GetCommittee();
          console.log(d);
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
      targets:[<?php if($this->session->userdata('user_role')=='committee'){ echo "2,"; } ?>4,5,6,7,8,9]
    }
    ]

  });

    $('#committee_add,#committee_edit').select2({
      placeholder: 'Select Committee'
    });

    <?php if($this->session->userdata('user_role')=='admin') { ?>

      $('#table_filter_committee').select2({
        placeholder: 'Select Committee'
      });

    <?php } ?>

    $(".table_filters").on("change", function() {
      committee_members_view_table.ajax.reload();
    });


    $('body').on('click', '#member_edit_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#member_name_edit').val(row.eq(6).text());
      $('#member_contact_edit').val(row.eq(7).text());
      $('#committee_edit').val(row.eq(4).text()).trigger('change');
      $('#member_id_edit').val(row.eq(5).text());
      $('#committee_id_edit').val(row.eq(4).text());

      $('#committee_member_user_id_edit').val(row.eq(8).text());

    });

    $('body').on('click', '#member_delete_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#member_id_delete').val(row.eq(5).text());
      $('#committee_id_delete').val(row.eq(4).text());

      $('#committee_member_user_id_delete').val(row.eq(8).text());

    });

    $('body').on('click', '#copy_btn', function() {
      var row = $(this).closest('tr').children('td');
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val(row.eq(9).text()).select();
      document.execCommand("copy");
      $temp.remove();
      toastr['info']('Login Details Copied to Clipboard !<br>Use Ctrl+V to Paste');
    });


  </script>