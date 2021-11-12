<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <div class="card card-custom mb-5">
        <div class="card-body">
          <div class="row">

            <div class="col-lg-2 col-md-2 col-sm-12">
              <div class="form-group ">
                <label for="expense_head">Group</label>
                <select required style="width: 100%" class="form-control table_filters" name="nearest_product" id="table_filter_group">
                  <option selected value="all">Select All</option>
                  <?php foreach (config_item('blood_groups') as $key => $value) { ?>
                    <option><?= $value ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                <label>Eligible</label>
                <div class="radio-inline">
                  <label class="radio radio-info">
                    <input type="radio" value="all" name="table_filter_status" class="table_filters"/>
                    <span></span>
                    All
                  </label>
                  <label class="radio radio-success">
                    <input type="radio" value="1" name="table_filter_status" checked class="table_filters" />
                    <span></span>
                    Yes
                  </label>
                  <label class="radio radio-danger">
                    <input type="radio" value="0" name="table_filter_status" class="table_filters" />
                    <span></span>
                    No
                  </label>
                </div>
                <!-- <span class="form-text text-muted">Some help text goes here</span> -->
              </div> 
            </div>  

            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                <label>Gender</label>
                <div class="radio-inline">
                  <label class="radio radio-info">
                    <input type="radio" value="all" name="table_filter_gender" checked class="table_filters"/>
                    <span></span>
                    All
                  </label>
                  <label class="radio radio-primary">
                    <input type="radio" value="male" name="table_filter_gender" class="table_filters" />
                    <span></span>
                    Male
                  </label>
                  <label class="radio radio-info">
                    <input type="radio" value="female" name="table_filter_gender" class="table_filters" />
                    <span></span>
                    Female
                  </label>
                </div>
                <!-- <span class="form-text text-muted">Some help text goes here</span> -->
              </div> 
            </div> 


            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label>Availability</label>
                <div class="radio-inline">
                  <label class="radio radio-info">
                    <input type="radio" value="all" name="table_filter_availability" checked class="table_filters"/>
                    <span></span>
                    All
                  </label>
                  <label class="radio radio-success">
                    <input type="radio" value="1" name="table_filter_availability" class="table_filters" />
                    <span></span>
                    Available
                  </label>
                  <label class="radio radio-danger">
                    <input type="radio" value="0" name="table_filter_availability" class="table_filters" />
                    <span></span>
                    Not Available
                  </label>
                </div>
                <!-- <span class="form-text text-muted">Some help text goes here</span> -->
              </div> 
            </div>  


          </div>
        </div>
      </div>

      <!--begin::Card-->
      <div class="card card-custom">
        <div class="card-header">
          <div class="card-title">
            <span class="card-icon">

            </span>
            <h3 class="card-label">List of Donors</h3>
          </div>
          <div class="card-toolbar">

            <!--begin::Button-->
            <a data-toggle="modal" data-target="#donor_add_modal" class="btn btn-dark font-weight-bolder">
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
              </span>Add New Donor</a>
              <!--end::Button-->

            </div>
          </div>
          <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="donors_view_table" style="margin-top: 13px !important">
              <thead>
                <tr>

                  <th width="5%">SL</th>
                  <th width="30%">Donor</th>
                  <th width="15%">Last Donated</th>
                  <th width="15%">Next Donation</th>
                  <th width="10%">No Of Donations</th>
                  <th width="15%">Status</th>
                  <th width="10%">Added On</th>
                  <th width="10%">Actions</th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>


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

  <?php $this->load->view('include_modals/donors_modals') ?>

  <script type="text/javascript">
    $('.menu-item-active').removeClass('menu-item-active');
    $('#donors_menu').addClass('menu-item-active');

  </script>


  <script type="text/javascript">

   function GetStatus() { return $('[name=table_filter_status]:checked').val(); }
   function GetAvailability() { return $('[name=table_filter_availability]:checked').val(); }
   function GetGroup() { return $('#table_filter_group').val(); }
   function GetGender() { return $('[name=table_filter_gender]:checked').val(); }

   var donors_view_table = $('#donors_view_table').DataTable({

    "ajax":{
      url :"<?= base_url().'donors/select_donors' ?>",
      type: "post",
      data: function(d){
        d.status = GetStatus();
        d.group = GetGroup();
        d.gender = GetGender();
        d.availability = GetAvailability();
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
      targets: [7],

    },
    {
      className:'d-none noExport',
      targets:[8,9,10,11,12,13,14]
    }
    ]

  });

   $(".table_filters").on("change", function() {
    donors_view_table.ajax.reload();
  });

   $('#table_filter_start_date,#table_filter_end_date,#last_donated_date_add,#last_donated_date_edit,#next_donation_date_add,#next_donation_date_edit,#availability_date').datepicker({
    format: 'dd-mm-yyyy'
  });

   $('#availability_time').timepicker({
    format: 'h:i A'
  });

   $('#hospital').select2({
    placeholder: 'Select Hospital'
  });

   $('#table_filter_group,#group,#donor_group_edit').select2({
    placeholder: 'Select Group'
  });

   $('body').on('change', '#last_donated_date_add', function() {
    last_donated_date_change('add');
  });

   $('body').on('change', '[name=gender_add]', function() {
    last_donated_date_change('add');
  });

   $('body').on('change', '#last_donated_date_edit', function() {
    last_donated_date_change('edit');
  });

   $('body').on('change', '[name=gender_edit]', function() {
    last_donated_date_change('edit');
  });

   function last_donated_date_change(type) {
    var date = $('#last_donated_date_'+type).val();
    if(date!=''){
      if($('[name=gender_'+type+']:checked').val()=='female'){
        var bleeding_gap = 4;
      }else{
        var bleeding_gap = 3;
      }
      var next_date = moment(date, "DD-MM-YYYY").add(bleeding_gap, 'months').format('DD-MM-YYYY');
      $('#next_donation_date_'+type).val(next_date);
    }
  }


  $('body').on('click', '#donor_edit_btn', function() {
    var row = $(this).closest('tr').children('td');
    if(row.eq(2).text()!='NA'){
      $('#last_donated_date_edit').val(row.eq(2).text());
    }
    if(row.eq(3).text()!='NA'){
      $('#next_donation_date_edit').val(row.eq(3).text());
    }
    $('#no_of_donations_edit').val(row.eq(4).text());
    $('#donor_name_edit').val(row.eq(8).text());
    $('#donor_group_edit').val(row.eq(9).text()).trigger('change');
    $('#donor_contact_edit').val(row.eq(10).text());
    $('#location_edit').val(row.eq(11).text());
    $('#remarks_edit').val(row.eq(12).text());

    $('#donor_id_edit').val(row.eq(13).text());
    $('[name=gender_edit][value='+row.eq(14).text()+']').prop('checked',true);


  });

  $('body').on('click', '#donor_delete_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#donor_id_delete').val(row.eq(13).text());
  });

  $('body').on('click', '#donor_availability_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#donor_id_availability').val(row.eq(13).text());

    $('#donor_name_availability').val(row.eq(8).text());
    $('#donor_contact_availability').val(row.eq(10).text());

  });

//   $('body').on('change', 'input[name=availability]', function() {
//     availability_change();
//   });

//   availability_change();

//   function availability_change() {
//    var availability = $('input[name=availability]:checked').val();
//    if(availability==1){
//     $('.availability_date_div').show();
//   }else{
//     $('.availability_date_div').hide();
//   }
// }


</script>