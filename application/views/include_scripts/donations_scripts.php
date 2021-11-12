<script type="text/javascript">

 function GetStartDate() { return $('#table_filter_start_date').val();}
 function GetEndDate() { return $('#table_filter_end_date').val(); }
 function GetGroup() { return $('#table_filter_group').val(); }
 function GetDonor() { return $('#table_filter_donor').val(); }
 function GetCommittee() { return $('#table_filter_committee').val(); }


 var donations_view_table = $('#donations_view_table').DataTable({

  "ajax":{
    url :"<?= base_url().'donations/select_donations' ?>",
    type: "post",
    data: function(d){
      d.start_date = GetStartDate();
      d.end_date = GetEndDate();
      d.group = GetGroup();
      d.committee = GetCommittee();
      <?php if($page=='hospital_profile') { ?>
        d.hospital = '<?= $hospital_data->hospital_id ?>';
      <?php } ?>
      <?php if($page=='donor_profile') { ?>
        d.donor = '<?= $donor_data->donor_id ?>';
      <?php } else { ?>
        d.donor = GetDonor();
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
      targets: [7],

    },
    {
      className:'d-none noExport',
      targets:[8,9,10 <?php if($page=='donor_profile') { echo ",2"; } ?>]
    }
    ]

  });

 $(".table_filters").on("change", function() {
  donations_view_table.ajax.reload();
});



 $('#committee_add,#committee_edit').select2({
  placeholder: 'Select Committee'
});

 $('#member_add,#member_edit').select2({
  placeholder: 'Select Member'
});
 

 $('#table_filter_start_date,#table_filter_end_date,#donated_date,#donated_date_edit').datepicker({
  format: 'dd-mm-yyyy'
});

 $('#table_filter_committee').select2({
  placeholder: 'Select Committee'
});

 $('#case_add,#donor_add,#case_edit,#donor_edit').select2({
  placeholder: 'Select '
});

  $('#hospital_add').select2({
  placeholder: 'Select Hospital'
});

 $('#table_filter_group,#table_filter_donor').select2({
  placeholder: 'Select '
});

 <?php if($page!='donor_profile') { ?>
   $('body').on('change', '#case_add', function() {
    fetch_donors('add');
  });
 <?php } ?>

 function fetch_cases() {

  <?php if($page=='hospital_profile') { ?>
    var hospital_id = '<?= $hospital_data->hospital_id ?>'
  <?php } else{ ?>
    var hospital_id = 'all';
  <?php } ?>

  <?php if($page=='donor_profile') { ?>
    var group = '<?= $donor_data->donor_group ?>'
  <?php } else{ ?>
    var group = 'all';
  <?php } ?>

  $.post("<?= base_url() ?>cases/fetch_cases",{hospital_id:hospital_id,group:group},function(data) {
    var obj = $.parseJSON(data);
    $('.cases_select').html('');
    var options = '<option selected disabled>Select Case</option>';
    var cases = obj.cases;
    if(cases.length>0){
      $.each(obj.cases, function(index, value) {
        options += '<option value="'+value.case_id+'" data-group="'+value.case_group+'" >#'+value.case_id+' - '+ value.hospital_name +' '+ value.location +' - '+ value.patient_name+' - '+value.patient_contact+' ( '+value.case_group+' )' +'</option>';
      });
      $('.cases_select').append(options);
    }else{
      <?php if($page!='donations_list') { ?>
        // toastr['warning']('No Cases found at the moment !', 'Not Found !');
      <?php } ?>
    }
  });
}

fetch_cases();

function fetch_donors(type) {
  var donation_type = $('input[name=donation_type_'+type+']:checked').val();
  if(donation_type=='replacement'){
    var group = $('#case_'+type+' :selected').data('group');
  }else{
    var group = 'all';
  }

  console.log(group);

  if(group!==undefined){
    $.post("<?= base_url() ?>donors/fetch_donors",{group:group},function(data) {
      var obj = $.parseJSON(data);
      
      console.log(obj);

      $('#donor_'+type).html('');
      var options = '<option selected disabled>Select Donor</option>';

      var donors = obj.donors;
      if(donors.length>0){

        $.each(obj.donors, function(index, value) {
          options += '<option value="'+value.donor_id+'">#'+value.donor_id+' - '+value.donor_name+' '+value.location+' - '+value.donor_contact+' ( '+ value.donor_group +' )</option>';
        });

      }else{
        toastr['warning']('No eligible donors available at the moment !', 'Not Available !');
      }

      $('#donor_'+type).append(options);

    });
  }else{
    $('#donor_'+type).html('');
    var options = '<option selected disabled>Select Donor</option>';
    $('#donor_'+type).append(options);
  }

}



$('body').on('change', '#committee_add', function() {
  fetch_members('add');
});


function fetch_members(type) {
  var committee_id = $('#committee_'+type+' :selected').val();
  if(committee_id!==undefined){
    $.post("<?= base_url() ?>committees/fetch_members",{committee_id:committee_id},function(data) {
      var obj = $.parseJSON(data);

      $('#member_'+type).html('');
      var options = '<option selected disabled>Select Member</option>';

      var members = obj.members;
      if(members.length>0){

        $.each(obj.members, function(index, value) {
          options += '<option value="'+value.member_id+'">'+value.member_name+' - '+value.member_contact+'</option>';
        });

      }else{
        toastr['warning']('Not Memmbers found !', 'Not found !');
      }

      $('#member_'+type).append(options);

    });
  }

}

$('body').on('click', '#donation_edit_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#donated_date_edit').val(row.eq(3).text().split('\n')[0]);
  $('#case_edit').val(row.eq(9).text()).trigger('change');
  $('#donor_edit').val(row.eq(10).text()).trigger('change');
  $('#remarks_edit').val(row.eq(4).text());
});

$('body').on('click', '#donation_delete_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#donation_id_delete').val(row.eq(8).text());
});


$('body').on('change', 'input[name=donation_type_add]', function() {
  donation_type_change('add');
});

donation_type_change('add');

function donation_type_change(type) {
  var donation_type = $('input[name=donation_type_'+type+']:checked').val();
  <?php if($page=='hospital_profile'){ ?>
    var donation_type = 'replacement';
  <?php } else{ ?>
    fetch_donors(type);
  <?php } ?>
  if(donation_type=='replacement'){
    $('.replacement_fields_'+type).show();
    $('.voluntary_fields_'+type).hide();
  }else{
    $('.replacement_fields_'+type).hide();
    $('.voluntary_fields_'+type).show();
  }

}


</script> 