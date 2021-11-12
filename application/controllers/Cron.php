<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->library('Management','management');

		$this->load->model('User_model','User');
		$this->load->model('Cases_model','Cases');
		$this->load->model('Hospitals_model','Hospitals');

		$this->load->model('Settings_model', 'Settings');
		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}

	}

	public function notify_donors()
	{
		
	}


}