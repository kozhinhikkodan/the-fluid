<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->


      <style type="text/css">
        .form-control[readonly] {
          background-color: #ffffff !important;
        }
      </style>

      <div class="card card-custom mb-5">
        <div class="card-body">
          <div class="row">


            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group ">
                <label for="expense_head">Committee</label>
                <select required style="width: 100%" class="form-control chart_filters" id="table_filter_committee">
                  <option selected value="all">Select All</option>
                  <?php foreach ($committees as $key => $value) { ?>
                    <option value="<?= $value->committee_id ?>"><?= $value->committee_name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div> 


            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group ">
                <label for="expense_head">Member</label>
                <select required style="width: 100%" class="form-control chart_filters" id="table_filter_member">
                  <option selected value="all">Select All</option>
                  <?php foreach ($members as $key => $value) { ?>
                    <option value="<?= $value->member_id ?>"><?= $value->member_name.' - '.$value->member_contact ?></option>
                  <?php } ?>
                </select>
              </div>
            </div> 

            <div class="col-lg-2 col-md-2 col-sm-12">
              <div class="form-group ">
                <label>Start Month</label>
                <input readonly autocomplete="off" type="text" name="" id="chart_filter_start_month" class="form-control chart_filters" value="<?=  date('F Y',strtotime('-5 months',strtotime(date('Y-m-d')))) ?>">
              </div>
            </div> 

            <div class="col-lg-2 col-md-2 col-sm-12">
              <div class="form-group ">
                <label>End Month</label>
                <input readonly autocomplete="off" type="text" name="" id="chart_filter_end_month" class="form-control chart_filters" value="<?= date('F Y') ?>">
              </div>
            </div>

          </div>
        </div>
      </div>

      <!--begin::Card-->
      <div class="card card-custom">
        <!-- <div class="card-header">
          <div class="card-title">
            <span class="card-icon">

            </span>
            <h3 class="card-label">List of Committee Members</h3>
          </div>
          <div class="card-toolbar">



            </div>
          </div> -->
          <div class="card-body">
            <!--begin: Datatable-->
            <div id="kt_gchart_5" style="height:500px;"></div>
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

    $('#chart_menu').addClass('menu-item-active');
    
    $('#table_filter_committee').select2({
      placeholder: 'Select Committee'
    });
    $('#table_filter_member').select2({
      placeholder: 'Select Member'
    });
  </script>

  <script src="//www.google.com/jsapi"></script>
  <script type="text/javascript">

    <?php  if($member_id!=''){ ?>
      $('#table_filter_member').val('<?= $member_id ?>').trigger('change');
    <?php } ?>

    <?php  if($this->session->userdata('user_role')=='member' ){ ?>
      $('#table_filter_member').val('<?= $this->session->userdata('member_data')->member_id ?>').trigger('change');
    <?php } ?>

    <?php  if($this->session->userdata('user_role')=='committee' ){ ?>
      $('#table_filter_committee').val('<?= $this->session->userdata('committee_data')->committee_id ?>').trigger('change');
    <?php } ?>

    google.load('visualization', '1', {
      packages: ['corechart', 'bar', 'line']
    });

    google.setOnLoadCallback(fetch_chart_data);

    function fetch_chart_data() {
      // var type = 'member';
      var id = $('#table_filter_member').val();
      var committee_id = $('#table_filter_committee').val();
      var member_name = $('#table_filter_member :selected').html().split('-')[0];
      var committee_name = $('#table_filter_committee :selected').html();


      var start_month = $('#chart_filter_start_month').val();
      var end_month = $('#chart_filter_end_month').val();

      var start_month_object = new Date(start_month);
      var end_month_object = new Date(end_month);

      if(start_month_object<end_month_object){

        $.post("<?= base_url() ?>committees/fetch_chart_data",{committee_id:committee_id,id:id,start:start_month,end:end_month},function(data) {
          var obj = $.parseJSON(data);



        // console.log(obj);

        var dataArray = [['Month']];
        $.each(obj.members, function(index, value) {
          dataArray[0].push(value);
        });
        // console.log(dataArray);


        var j = 1
        $.each(obj.values, function(index, value) {
          // console.log(value.length);
          // console.log([index,value[0],value[1]]);

          // dataArray.push([index,value[0],value[1],value[2]]);

          dataArray[j] = []; 
          dataArray[j][0] = index; 
          for (var i = 1; i <= value.length; i++) {
            dataArray[j][i] = value[i-1];
          }

          j++;
        });


        console.log(dataArray);



        var data = new google.visualization.arrayToDataTable(dataArray);

        var title_end = 'All Members in All Committees';

        if(committee_name!='Select All'){
          title_end = committee_name;
        }

        if(member_name!='Select All'){
          title_end = member_name;
        }


        var options = {
          chart: {
            title: 'Donations on period between '+start_month+' and '+end_month+' - '+title_end,
            subtitle: 'in units',
          },
          vAxis: { format:'long'},
          legend: { position: 'none' },
          curveType: 'function',
          // colors: ['#ED0838']
        };

        var chart = new google.charts.Line(document.getElementById('kt_gchart_5'));
        chart.draw(data, options);

      });

      }else{
        toastr['warning']('Please Check Start and End Months selected !', 'Month Selection Error !');
      }

    }

   // fetch_chart_data('member',1);

   $(".chart_filters").on("change", function() {
    fetch_chart_data();
  });

   $('#chart_filter_start_month,#chart_filter_end_month').datepicker({
    format: "MM yyyy",
    viewMode: "months", 
    minViewMode: "months"
  });

</script>