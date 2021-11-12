
<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
  <meta charset="utf-8" />
  <title><?= config_item('app_name') ?> | <?= config_item('company_name') ?> | Certificate of <?= $doner_name ?> </title>
  <meta name="description" content="<?= config_item('app_name') ?> | Certificate of <?= $doner_name ?> " />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="canonical" href="<?= base_url() ?>" />
  <meta name="theme-color" content="#ed0838">

  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <!--end::Fonts-->
  <!--begin::Page Custom Styles(used by this page)-->
  <link href="<?= base_url() ?>assets/css/pages/login/classic/login-5.css" rel="stylesheet" type="text/css" />
  <!--end::Page Custom Styles-->
  <!--begin::Global Theme Styles(used by all pages)-->
  <link href="<?= base_url() ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
  <!--end::Global Theme Styles-->
  <!--begin::Layout Themes(used by all pages)-->
  <link href="<?= base_url() ?>assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
  <!--end::Layout Themes-->
  <link rel="shortcut icon" href="<?= base_url()?>assets/media/logos/bloodbank20.ico" />

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Josefin+Sans&display=swap" rel="stylesheet">

  <style type="text/css">
    .verify_string{
      position: absolute;
      left: 88%;
      top: 18%;
      transform: rotate(90deg);
      font-size: 9px;
    }

    .powered_by{
      position: absolute;
      left: -13%;
      bottom: 1%;
      /*transform: rotate(-90deg);*/
      font-size: 13px;
    }


  </style>

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading" style="background-color: #ffffff">
  <!--begin::Main-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <!--begin::Card-->
    <div class="card card-custom overflow-hidden " id="certificate_div">

      <div class="verify_string">verify certificate at <a style="text-decoration: none" class="text-dark" href="<?= base_url() ?>certificate/<?= $donation_data->donation_id ?>"><?= preg_replace('#^https?://#', '', base_url()); ?>certificate/<?= $donation_data->donation_id ?></a></div>                            

      <div class="card-body p-0">


        <!-- begin: Invoice-->
        <!-- begin: Invoice header-->
        <div class="row justify-content-center py-24 px-8 px-md-0 mt-10 pt-5">

          <span style="position: absolute;top: 2%;left: 86%" >Certificate No : <span><?= str_pad($donation_data->donation_id, 6, "0", STR_PAD_LEFT); ?></span></span>

          <div class="col-md-9">
            <div class="d-flex justify-content-center flex-column flex-md-row">
              <h1 class="display-4 font-weight-boldest justify-content-center" style="font-family: 'Josefin Sans' ">Certificate</h1>
            </div>
            <div class="d-flex justify-content-center pb-10 pb-md-20 flex-column flex-md-row">
              <h4 class="display-6 font-weight-bold mb-10 justify-content-center" style="font-family: 'Josefin Sans' ">of Appreciation</h4>
            </div>

            <div class="d-flex justify-content-center flex-column flex-md-row">
              <h4 class="display-6 font-weight-bold mb-2 justify-content-center" style="font-family: 'Josefin Sans', cursive;">This is to certify that </h4>
            </div>

            <div class="d-flex justify-content-center flex-column flex-md-row">
              <h1 class="display-2 font-weight-boldest justify-content-center" style="font-family: 'Great Vibes', cursive;" id="volunteer_name"><?= $donation_data->donor_name ?></h1><br>
            </div>

            <div class="d-flex justify-content-center pb-10 pb-md-20 flex-column flex-md-row">
              <h3 class="display-6 font-weight-boldest mb-10 justify-content-center" style="font-family: 'Josefin Sans', cursive;" id="institution_name"><?= $donation_data->donor_location ?></h3>
            </div>
            
            <?php $his_her = 'His'; 

            if($donation_data->gender=='male'){
              $his_her = 'His';
            }else{
              $his_her = 'Her';
            }

            ?>

            <?php 
            $ends = array('th','st','nd','rd','th','th','th','th','th','th');
            $number = $donation_data->donation_rank;
            if (($number %100) >= 11 && ($number%100) <= 13)
             $no = $number. 'th';
           else
             $no = $number. $ends[$number % 10];
           ?>



           <div class="d-flex justify-content-center pb-10  pb-md-20 flex-column flex-md-row">
            <!-- <h4 class="display-6 font-weight-bold mb-10 justify-content-center" style="font-family: 'Josefin Sans', cursive;">Awarded appreciation For <?= $his_her ?> <span id="date"><?= date('d-m-Y',strtotime($donation_data->donated_date)) ?></span> in <span class="font-weight-boldest"><?= $donation_data->hospital_name.' '.$donation_data->hospital_location ?>  </span>. <span class="pronoun text-capitalize "></span>.</h4> -->


            <h4 class="display-6 font-weight-bold mb-10 justify-content-center" style="font-family: 'Josefin Sans', cursive;">Awarded appreciation For <?= $his_her ?> <?= $no ?> Blood Donation at <?= $donation_data->hospital_name ?></h4>

          </div>



        </div>
      </div>


      <!-- end: Invoice header-->
      <!-- begin: Invoice body-->
      <div class="row justify-content-center px-8 py-md-6 px-md-0">
        <div class="col-md-9">

          <div class="center_logo" style=" position: absolute; left: 42%; bottom: 112%; ">
            <img src="<?= base_url() ?>assets/media/logos/sample.png" width="20%">
          </div>


          <div class="row" style="font-family: 'Josefin Sans', cursive;margin-top: -3%;">

            <?php 

            $signatures = explode('#', config_item('company_signatures'));

            foreach ($signatures as $key => $s) { 

              $s = explode('-', $s);

              ?>


              <div class="col text-center">
                <img class="font-weight-boldest" src="<?= base_url() ?>assets/media/logos/<?= $s[2] ?>" width="25%">
                <h6 class="font-weight-boldest"><?= $s[0] ?></h6>
                <h6><?= $s[1] ?></h6>
              </div>
            <?php } ?>

            <div class="powered_by">
              <span>Powered by </span>
              <img src="<?= base_url() ?>assets/media/logos/logo-nbrt.png" width="8%">
            </div>



             <!-- <div class="col text-center">
               <img class="font-weight-boldest" src="<?= base_url() ?>assets/media/logos/sign_2.png" width="25%">
               <h6 class="font-weight-boldest">Mr. Y</h6>
               <h6>Convenor</h6>
             </div> -->



           </div>
         </div>
       </div>



       <!-- end: Invoice body-->


       <!-- begin: Invoice action-->

       <?php if(!empty($this->session->userdata('user_name'))){ ?>

         <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 no-print">
          <div class="col-md-9">
            <div class="d-flex justify-content-between float-right">
              <button type="button" class="btn btn-dark font-weight-bold" onclick="window.print();"><i class="flaticon2 flaticon2-printer"> </i> Print</button>
            </div>
          </div>
        </div>

      <?php } ?>


      <!-- end: Invoice action-->
      <!-- end: Invoice-->
    </div>
  </div>
  <!--end::Card-->
  <!--end::Login-->
</div>
<!--end::Main-->
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="<?= base_url() ?>assets/plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url() ?>assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="<?= base_url() ?>assets/js/scripts.bundle.js"></script>

<!-- <script src="https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/js/scripts.bundle.js?v=7.1.7"></script> -->

<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<!-- <script src="<?= base_url() ?>assets/js/pages/custom/login/login-general.js"></script> -->


<style type="text/css">
  .hidden{
    display: none !important;
  }


  #certificate_div {
    background: url(<?= base_url() ?>assets/media/bg/certificate_bg.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;

  }

  @media print
  {    
    .no-print, .no-print *
    {
      display: none !important;
    }

    @page
    {
      size: 148mm 105mm ;
      size: landscape;
    }
  }

  .invoice-logo{
    width: 16%;
    position: absolute;
    top: 16%;
    left: 0;
  }
</style>

<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>