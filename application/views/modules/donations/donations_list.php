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
              <label>Start Date</label>
              <input autocomplete="off" type="text" name="" id="table_filter_start_date" class="form-control table_filters" value="<?= date('d-m-Y') ?>">
            </div>
          </div> 

          <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group ">
              <label>End Date</label>
              <input autocomplete="off" type="text" name="" id="table_filter_end_date" class="form-control table_filters" value="<?= date('t-m-Y') ?>">
            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group ">
              <label for="expense_head">Group</label>
              <select required style="width: 100%" class="form-control table_filters" id="table_filter_group">
                <option selected value="all">Select All</option>
                <?php foreach (config_item('blood_groups') as $key => $value) { ?>
                  <option><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
          </div> 

          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="form-group ">
              <label for="expense_head">Donor</label>
              <select required style="width: 100%" class="form-control table_filters" id="table_filter_donor">
                <option selected value="all">Select All</option>
                <?php foreach ($donors as $key => $value) { ?>
                  <option value="<?= $value->donor_id ?>"><?= $value->donor_name ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

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

    <!--begin::Card-->
    <div class="card card-custom">
      <div class="card-header">
        <div class="card-title">
          <span class="card-icon">

          </span>
          <h3 class="card-label">List of Donations</h3>
        </div>
        <div class="card-toolbar">

          <?php if($this->session->userdata('user_role')=='member') { ?>

            <!--begin::Button-->
            <a data-toggle="modal" data-target="#donation_add_modal" class="btn btn-dark font-weight-bolder">
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
              </span>Add New </a>
              <!--end::Button-->

            <?php } ?>

          </div>
        </div>
        <div class="card-body">
          <!--begin: Datatable-->

          <?php $this->load->view('include_tables/donations_table') ?>

          <!--end: Datatable-->
        </div>
      </div>
      <!--end::Card-->
    </div>
  </div>
</div>
<!--end::Content-->

<?php $this->load->view('include_modals/donations_modals') ?>

<script type="text/javascript">
  $('.menu-item-active').removeClass('menu-item-active');
  $('#donations_menu').addClass('menu-item-active');

</script>


<?php $this->load->view('include_scripts/donations_scripts') ?>
