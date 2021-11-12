<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Committees extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Misc_model','Misc');

		$this->load->library('Management','management');	

		$this->load->model('User_model','User');
		$this->load->model('Committees_model','Committees');
		$this->load->model('Donations_model','Donations');


		$this->load->model('Settings_model', 'Settings');
		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}
		else{
			$allowed_users = array('admin','committee','member');
			if(!in_array($this->session->userdata('user_role'),$allowed_users)){
				redirect(base_url(),'refresh');
			}
		}

		$this->data['folder']='committees';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$allowed_users = array('admin','committee');
		if(!in_array($this->session->userdata('user_role'),$allowed_users)){
			redirect(base_url(),'refresh');
		}

		$this->data['page']='committees_list';
		$this->load->view('Index',$this->data);
	}

	public function members()
	{
		$allowed_users = array('admin','committee');
		if(!in_array($this->session->userdata('user_role'),$allowed_users)){
			redirect(base_url(),'refresh');
		}

		$this->data['committees'] = $this->Committees->select_committees("*")->result();

		$this->data['page']='committee_members_list';
		$this->load->view('Index',$this->data);
	}

	public function create()
	{

		$data2['name'] = $data['committee_name'] = $this->security->xss_clean($this->input->post('committee_name'));

		$count = $this->Committees->select_committees("*",$data)->num_rows();

		if($count==0){

			$data['created_date'] = date('Y-m-d h:i:s');

			$data2['user_role'] = 2;
			$data2['username'] = strtolower(str_replace(' ', '_', $data['committee_name']));
			$data2['password'] = $this->Misc->generate_password();
			$data2['created_date'] = date('Y-m-d h:i:s');
			$data2['created_by'] = $this->session->userdata('user_id');

			$add_user = $this->User->create_user($data2);

			$data['committee_user_id'] = $add_user['insert_id'];

			$result = $this->Committees->create_committee($data);

			if($result['status']==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Commitee added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Committee Name already exists !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);
	}

	public function update()
	{
		$data['committee_id'] = $data3['committee_id!='] = $this->security->xss_clean($this->input->post('committee_id'));
		$data['committee_name'] = $data3['committee_name'] = $this->security->xss_clean($this->input->post('committee_name'));

		$count = $this->Committees->select_committees("*",$data3)->num_rows();

		if($count==0){

			$data['updated_date'] = date('Y-m-d h:i:s');

			$data2['user_id'] = $this->security->xss_clean($this->input->post('user_id'));;
			$data2['user_role'] = 2;
			$data2['username'] = strtolower(str_replace(' ', '_', $data['committee_name']));
			$data2['password'] = $this->Misc->generate_password();
			$data2['created_date'] = date('Y-m-d h:i:s');
			$data2['created_by'] = $this->session->userdata('user_id');

			$add_user = $this->User->update_user($data2);

			$result = $this->Committees->update_committee($data);

			if($result==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Committee updated Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Committee Name already exists !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);
	}


	public function select_committees(){

		$json_data=array();
		$j=0;

		$data=array();


		$result	= $this->Committees->select_committees("*",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$whatsapp_message = 'Login to  :  '.config_item('app_name').' - '.base_url().' %0A username : '.$row->username.' %0A Password : '.$row->password;

			$copy = 'Login to  :  '.config_item('app_name').' - '.base_url().' , username : '.$row->username.' , Password : '.$row->password;


			$btn_whatsapp = '<a href="https://api.whatsapp.com/send?text='.$whatsapp_message.'" target="_blank" id="whatsapp_share_btn"  class="btn btn-sm btn-default m-1"> <i class="flaticon flaticon-whatsapp text-success icon-lg"></i> </a>';

			$btn_chart = '<a href="'.base_url().'committee_chart/'.$row->committee_id.'" class="btn btn-sm btn-info m-1"> <i class="flaticon2 flaticon2-graph-2"></i> </a>';

			$btn_copy = '<button id="copy_btn" class="btn btn-sm btn-warning m-1"> <i class="flaticon2 flaticon2-copy"></i> </button>';

			$btn_edit = '<button data-toggle="modal" data-target="#committee_edit_modal" id="committee_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="committee_delete_btn" data-target="#committee_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			$array[$j][]=$j+1;
			$array[$j][]=$row->committee_name;
			$array[$j][]=$row->members_count;
			$array[$j][]=$btn_copy.$btn_chart.$btn_whatsapp.$btn_edit.$btn_delete;
			$array[$j][]=$row->committee_id;
			$array[$j][]=$row->committee_user_id;
			$array[$j][]=$copy;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['committee_id'] = $this->security->xss_clean($this->input->post('committee_id'));
		$data['delete_status'] = $data2['delete_status'] = 1;

		$data2['user_id'] = $this->security->xss_clean($this->input->post('user_id'));
		$result = $this->User->update_user($data2);


		$result = $this->Committees->update_committee($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Committee Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}






	public function select_committee_members(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['committee']) && $_POST['committee']!='' && $_POST['committee']!='all'){
			$data['c.committee_id'] = $_POST['committee'];
		}

		$result	= $this->Committees->select_committee_members("*",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$whatsapp_message = 'Login to  :  '.config_item('app_name').' - '.base_url().' %0A username : '.$row->username.' %0A Password : '.$row->password;

			$copy = 'Login to  :  '.config_item('app_name').' - '.base_url().' , username : '.$row->username.' , Password : '.$row->password;


			$btn_whatsapp = '<a href="https://api.whatsapp.com/send?text='.$whatsapp_message.'" target="_blank" id="whatsapp_share_btn"  class="btn btn-sm btn-default m-1"> <i class="flaticon flaticon-whatsapp text-success icon-lg"></i> </a>';

			$btn_chart = '<a href="'.base_url().'chart/'.$row->member_id.'" class="btn btn-sm btn-info m-1"> <i class="flaticon2 flaticon2-graph-2"></i> </a>';

			$btn_copy = '<button id="copy_btn" class="btn btn-sm btn-warning m-1"> <i class="flaticon2 flaticon2-copy"></i> </button>';

			if($this->session->userdata('user_role')=='committee'){ 

				$btn_edit = '<button data-toggle="modal" data-target="#member_edit_modal" id="member_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="member_delete_btn" data-target="#member_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			}else{
				$btn_edit=$btn_delete='';
			}

			$committee_name = '<br><span class="label label-lg label-dark label-inline mr-2">'.$row->committee_name.'</span>';


			$array[$j][]=$j+1;
			$array[$j][]=$row->member_name.'<br>'.$row->member_contact;
			$array[$j][]=$committee_name;
			$array[$j][]=$btn_copy.$btn_chart.$btn_whatsapp.$btn_edit.$btn_delete;
			$array[$j][]=$row->committee_id;
			$array[$j][]=$row->member_id;
			$array[$j][]=$row->member_name;
			$array[$j][]=$row->member_contact;
			$array[$j][]=$row->member_user_id;
			$array[$j][]=$copy;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function create_member()
	{
		$data['member_contact'] = $this->security->xss_clean($this->input->post('member_contact'));

		$count = $this->Committees->select_committee_members('*',$data)->num_rows();

		if($count==0){

			$data['member_name'] = $this->security->xss_clean($this->input->post('member_name'));
			$data['committee_id'] = $data_1['committee_id'] = $this->security->xss_clean($this->input->post('committee'));
			$data['created_date'] = date('Y-m-d h:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			$data2['user_role'] = 3;
			$data2['username'] = strtolower(str_replace(' ', '', $data['member_contact']));
			$data2['name'] = $data['member_name'];
			$data2['password'] = $this->Misc->generate_password();
			$data2['created_date'] = date('Y-m-d h:i:s');
			$data2['created_by'] = $this->session->userdata('user_id');

			$add_user = $this->User->create_user($data2);
			$data['member_user_id'] = $add_user['insert_id'];

			$result = $this->Committees->create_committee_member($data);

			$this->management->evaluate_committee($data['committee_id']);

			if($result['status']==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Commitee Member added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Contact Number Already in use!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);
	}

	public function update_member()
	{
		$data['member_id'] = $data3['member_id!='] = $this->security->xss_clean($this->input->post('member_id'));
		$data['member_contact'] = $data3['member_contact'] = $this->security->xss_clean($this->input->post('member_contact'));

		$count = $this->Committees->select_committee_members('*',$data3)->num_rows();
		if($count==0){

			$data['member_name'] = $this->security->xss_clean($this->input->post('member_name'));
			$data['updated_date'] = date('Y-m-d h:i:s');
			$data['updated_by'] = $this->session->userdata('user_id');

			$data2['user_id'] = $this->security->xss_clean($this->input->post('user_id'));;
			$data2['user_role'] = 3;
			$data2['username'] = strtolower(str_replace(' ', '_', $data['member_contact']));
			$data2['password'] = $this->Misc->generate_password();
			$data2['created_date'] = date('Y-m-d h:i:s');
			$data2['created_by'] = $this->session->userdata('user_id');

			$add_user = $this->User->update_user($data2);

			$result = $this->Committees->update_committee_member($data);

			$data['committee_id'] = $this->security->xss_clean($this->input->post('committee_id'));
			$this->management->evaluate_committee($data['committee_id']);

			if($result==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Commitee Member Updated Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Contact Number Already in use!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);
	}

	public function delete_member()
	{
		$data['member_id'] = $this->security->xss_clean($this->input->post('member_id'));
		$data['delete_status'] = $data2['delete_status'] = 1;

		$data2['user_id'] = $this->security->xss_clean($this->input->post('user_id'));
		$result = $this->User->update_user($data2);

		$result = $this->Committees->update_committee_member($data);

		$data['committee_id'] = $this->security->xss_clean($this->input->post('committee_id'));
		$this->management->evaluate_committee($data['committee_id']);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Commitee Member Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);
	}


	public function chart($member_id='')
	{
		
		$chart_data = array();

		if($this->session->userdata('user_role')=='admin'){
			$this->data['committees'] = $this->Committees->select_committees('*',array('c.members_count>'=>0))->result();
		}
		$this->data['member_id'] = $member_id;
		$this->data['members'] = $this->Committees->select_committee_members('*')->result();

		$this->data['page']='chart';
		$this->load->view('Index',$this->data);

	}


	public function fetch_members()
	{
		$data['c.committee_id'] = $this->security->xss_clean($this->input->post('committee_id'));
		$result['members']	= $this->Committees->select_committee_members("*",$data)->result();
		echo json_encode($result);
	}

	public function fetch_chart_data()
	{
		// $type = $this->security->xss_clean($this->input->post('type'));
		$committee_id = $this->security->xss_clean($this->input->post('committee_id'));
		$id = $this->security->xss_clean($this->input->post('id'));
		$start = $this->security->xss_clean($this->input->post('start'));
		$end = $this->security->xss_clean($this->input->post('end'));

		$data = array();

		if($id!='all'){
			$data['cm.member_id'] = $id;
		}

		if($committee_id!='all'){
			$data['c.committee_id'] = $committee_id;
		}

		
		$start_date = date('Y-m-d',strtotime('-0 months',strtotime(date('Y-m-d',strtotime($start)))));
		$end_date = date('Y-m-d',strtotime('+1 months',strtotime(date('Y-m-d',strtotime($end)))));

		$interval = new DateInterval('P1M');
		$start = new DateTime($start_date);
		$end = new DateTime($end_date);
		$period = new DatePeriod($start, $interval, $end);

		$chart_data['members'] = array();
		$chart_data['values'] = array();



		$members=$this->Committees->select_committee_members('*',$data);
		// exit(print_r($members->num_rows()));
		foreach ($members->result() as $key => $member) {
			$chart_data['members'][] =  $member->member_name;
			foreach ($period as $dt) {

				$data2['dnt.member_id'] = $member->member_id;
				$data2['dnt.donated_date>='] = $dt->format('Y-m-01');
				$data2['dnt.donated_date<'] = $dt->format('Y-m-t');

				$count = $this->Donations->select_donations('*',$data2)->num_rows();

				$chart_data['values'][$dt->format('Y F')][] = $count;

			}
		}


		echo json_encode($chart_data);

	}
}