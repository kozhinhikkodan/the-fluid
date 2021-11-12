<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');
		$this->load->library('session');
		$this->load->model('User_model','User');
		$this->load->model('Committees_model','Committees');


		$this->load->model('Settings_model', 'Settings');
		// $maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		// if($maintanance_mode==1){
		// 	redirect(base_url().'maintanance', 'refresh');
		// }
	}

	public function index()
	{

		if(!empty($this->session->userdata('user_id'))){
			redirect(base_url().'dashboard', 'refresh');
		}
		else{
			$this->load->view('login');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}

	public function login_process()
	{
		
		$data['username'] = $this->security->xss_clean($this->input->post('username'));
		$data['password'] = $this->security->xss_clean($this->input->post('password'));
		
		$user_data =$this->User->select_user("*",$data);

		if($user_data->num_rows()==1){ 
			$row = $user_data->row(); 

			if($row->block_status==0){
				
				$session_data['user_name'] = $row->username;
				$session_data['password'] = $row->password;
				$session_data['user_full_name'] = $row->name;
				$session_data['user_id'] = $row->user_id;
				$session_data['user_role'] = $row->role;
				$session_data['role_name'] = $row->role_name;
				$session_data['user_role_id'] = $row->role_id;

				if($row->role=='committee'){
					$session_data['committee_data'] = $this->Committees->select_committees('*',array('c.committee_user_id'=>$row->user_id))->row();
				}elseif($row->role=='member'){
					$session_data['member_data'] = $this->Committees->select_committee_members('*',array('cm.member_user_id'=>$row->user_id))->row();
				}

				$this->session->set_userdata($session_data);

				$array['status'] = 1;

			}
			else{
				$array['status'] = 2;
			}
		}else{
			$array['status'] = 0;
		}

		echo json_encode($array);
	}

}
