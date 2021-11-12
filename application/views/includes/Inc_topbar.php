
<!--begin::Wrapper-->
<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
	<!--begin::Header-->
	<div id="kt_header" class="header header-fixed">
		<!--begin::Container-->
		<div class="container-fluid d-flex align-items-stretch justify-content-between">
			<!--begin::Header Menu Wrapper-->
			<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
				<!--begin::Header Menu-->
				<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
					<!--begin::Header Nav-->
					
					<!--end::Header Nav-->
				</div>
				<!--end::Header Menu-->
			</div>
			<!--end::Header Menu Wrapper-->

			<!--begin::Topbar-->
			<div class="topbar">

	

				<!--begin::User-->
				<div class="topbar-item">
					<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
						<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1"></span>
						<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?= $this->session->userdata('user_full_name') ?></span>
						<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
							<!-- <span class="symbol-label font-size-h5 font-weight-bold">S</span> -->

							<?php if($this->session->userdata('user_role')=='admin') { 
								$avatar = '001-boy.svg';
							}elseif ($this->session->userdata('user_role')=='committee') {
								$avatar = '007-boy-2.svg';
							}else{
								$avatar = '011-boy-5.svg';
							}
							?>

							<div class="symbol-label">
								<img src="<?= base_url() ?>assets/media/svg/avatars/<?= $avatar ?>" class="h-75 align-self-end" alt="" />
							</div>
						</span>
					</div>
				</div>
				<!--end::User-->
			</div>
			<!--end::Topbar-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Header-->


