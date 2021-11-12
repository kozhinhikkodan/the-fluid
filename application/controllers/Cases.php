<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends CI_Controller {

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
		else{
			$allowed_users = array('admin','committee','member');
			if(!in_array($this->session->userdata('user_role'),$allowed_users)){
				redirect(base_url(),'refresh');
			}
		}
		$this->data['folder']='cases';
	}

	public function index($group='')
	{

		$group = str_replace('-NEGATIVE', '-', str_replace('-POSITIVE', '+', strtoupper($this->security->xss_clean($group))));

		if(!in_array($group, config_item('blood_groups'))){
			$group = '';
		}
		
		$this->data['group']=$group;

		$this->data['hospitals']= $this->Hospitals->select_hospitals('*')->result();
		$this->data['page']='cases_list';

		$this->load->view('Index',$this->data);
	}

	public function create()
	{

		$data['case_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('case_date'))));
		$data['case_group'] = $this->security->xss_clean($this->input->post('group'));
		$data['needed_units'] = $data['balance_units'] = $this->security->xss_clean($this->input->post('units'));
		$data['hospital_id'] = $this->security->xss_clean($this->input->post('hospital'));
		$data['patient_name'] = $this->security->xss_clean($this->input->post('patient_name'));
		$data['patient_contact'] = $this->security->xss_clean($this->input->post('patient_contact'));

		$data['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $this->session->userdata('user_id');
		

		$result = $this->Cases->create_case($data);

		$this->management->notify_donors_on_case($result['insert_id']);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Case Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function update()
	{
		$data['case_id'] = $this->security->xss_clean($this->input->post('case_id'));

		$data['case_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('case_date'))));
		$data['case_group'] = $this->security->xss_clean($this->input->post('group'));
		$data['needed_units'] = $data['balance_units'] = $this->security->xss_clean($this->input->post('units'));
		$data['hospital_id'] = $this->security->xss_clean($this->input->post('hospital'));
		$data['patient_name'] = $this->security->xss_clean($this->input->post('patient_name'));
		$data['patient_contact'] = $this->security->xss_clean($this->input->post('patient_contact'));

		$data['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Cases->update_case($data);
		$this->management->notify_donors_on_case($data['case_id']);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Case updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function select_cases(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['hospital']) && $_POST['hospital']!='' && $_POST['hospital']!='all'){
			$data['c.hospital_id'] = $_POST['hospital'];
		}

		if(isset($_POST['start_date']) && $_POST['start_date']!='' && $_POST['start_date']!='all'){
			$data['c.case_date>='] = date('Y-m-d',strtotime($_POST['start_date']));
		}

		if(isset($_POST['end_date']) && $_POST['end_date']!='' && $_POST['end_date']!='all'){
			$data['c.case_date<='] = date('Y-m-d',strtotime($_POST['end_date']));
		}

		if(isset($_POST['status']) && $_POST['status']!='' && $_POST['status']!='all'){
			$data['c.status'] = $_POST['status'];
		}

		if(isset($_POST['group']) && $_POST['group']!='' && $_POST['group']!='all'){
			$data['c.case_group'] = $_POST['group'];
		}

		$result	= $this->Cases->select_cases("*,c.created_date as c_created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$btn_edit = '<button data-toggle="modal" data-target="#case_edit_modal" id="case_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="case_delete_btn" data-target="#case_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			$btn_close = '';
			if(config_item('manual_case_closing')==1){
				$btn_close = '<button class="btn btn-sm btn-info m-1" data-toggle="modal" id="case_close_btn" data-target="#case_close_modal"> <i class="flaticon2 flaticon2-reload"></i> </button>';
			}

			$hospital = '
			<a href="'.base_url().'hospitals/'.$row->hospital_id.'">
			<span class="text-dark font-weight-bold text-hover-primary mb-1 font-size-lg">'.$row->hospital_name.'</span>
			</a><br>
			<span class="text-dark">'.nl2br($row->address).'</span><br>
			<span class="text-dark">'.$row->contact.'</span>';

			$group = '<span class="font-weight-bold text-danger">'.$row->case_group.'</span><br>
			Need - '.$row->needed_units.'<br>
			Balance - '.$row->balance_units.'<br>';

			if($row->status==1){
				$status = '<span class="label label-lg label-success label-inline mr-2">Closed</span>';
			}else{
				$status = '<span class="label label-lg label-danger label-inline mr-2">Open</span>';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->c_created_date)).'<br>By '.$row->name.'<br>'.'<span class="label label-lg label-dark label-inline mr-2">'.str_replace(' ', '&nbsp;', $row->role_name).'</span>';

			if($row->patient_contact!=0){
				$patient_contact = $row->patient_contact;
			}else{
				$patient_contact = '';
			}

			$array[$j][]=$j+1;
			$array[$j][]=$row->case_id;
			$array[$j][]=date('d-m-Y',strtotime($row->case_date));
			$array[$j][]=$group;
			$array[$j][]=$hospital;
			$array[$j][]=$status;
			$array[$j][]=$row->patient_name.'<br>'.$patient_contact;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_close.$btn_edit.$btn_delete;
			$array[$j][]=$row->case_group;
			$array[$j][]=$row->needed_units;
			$array[$j][]=$row->hospital_id;
			$array[$j][]=$row->patient_name;
			$array[$j][]=$row->patient_contact;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['case_id'] = $this->security->xss_clean($this->input->post('case_id'));
		$data['delete_status'] = 1;

		$result = $this->Cases->update_case($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Case Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}

	public function update_status()
	{
		$data['case_id'] = $this->security->xss_clean($this->input->post('case_id'));
		$data['status'] = $this->security->xss_clean($this->input->post('status'));

		$result = $this->Cases->update_case($data);

		$this->management->evaluate_case_status($data['case_id']);
		
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Case Updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}

	public function fetch_cases()
	{
		$hospital_id = $this->security->xss_clean($this->input->post('hospital_id'));

		if(isset($hospital_id) && $hospital_id!='' && $hospital_id!='all'){
			$data['c.hospital_id'] = $hospital_id;
		}

		$group = $this->security->xss_clean($this->input->post('group'));

		if(isset($group) && $group!='' && $group!='all'){
			$data['c.case_group'] = $group;
		}

		$data['status'] = 0;
		$result['cases']	= $this->Cases->select_cases("*",$data)->result();
		echo json_encode($result);
	}

}