<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');
		$this->load->library('session');

		// $this->load->library('Management','management');	

		$this->load->model('Cases_model', 'Cases');
		$this->load->model('Donors_model', 'Donors');

		$this->load->model('Settings_model', 'Settings');
		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}

		if($this->session->userdata('user_role')=='developer'){
			redirect(base_url().'settings/config', 'refresh');
		}

		$this->data['folder']='dashboard';

	}

	public function index()
	{

		if(empty($this->session->userdata('user_id'))){
			redirect(base_url().'login', 'refresh');
		}
		else{

			// $this->data['products_count'] = $this->Products->select_products('p.product_id')->num_rows();
			// $this->data['blogs_count'] = $this->Blogs->select_blogs('b.blog_id')->num_rows();

			$group_count = array();
			foreach (config_item('blood_groups') as $key => $g) {
				$group_count[$g] = $this->Cases->select_cases('coalesce(sum(c.balance_units),0) as units',array('c.case_group'=>$g))->row()->units;
			}
			
			$this->data['group_count'] = $group_count;
			$this->data['open_cases_count'] = $this->Cases->select_cases('c.case_id',array('c.status'=>0))->num_rows();
			$this->data['eligible_donors_count'] = $this->Donors->select_donors('d.donor_id',array('d.eligible'=>1))->num_rows();



			$this->data['page']='home';
			$this->load->view('Index',$this->data);
		}
	}

	
}