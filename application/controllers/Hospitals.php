<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitals extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');

		$this->load->model('Hospitals_model','Hospitals');
		$this->load->model('Cases_model','Cases');
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

		$this->data['folder']='hospitals';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$this->data['page']='hospitals_list';
		$this->load->view('Index',$this->data);
	}

	public function profile($id='')
	{
		if($id!=''){
			$hospital_data = $this->Hospitals->select_hospitals('*',array('h.hospital_id'=>$id));
			if($hospital_data->num_rows()==1){

				$this->data['hospital_data'] = $hospital_data->row();

				$this->data['page']='hospital_profile';
				$this->load->view('Index',$this->data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function create()
	{

		$data['hospital_name'] = $this->security->xss_clean($this->input->post('name'));
		$data['location'] = $this->security->xss_clean($this->input->post('location'));
		$data['contact'] = $this->security->xss_clean($this->input->post('contact'));
		$data['address'] = $this->security->xss_clean($this->input->post('address'));
		$data['description'] = $this->security->xss_clean($this->input->post('description'));
		$data['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Hospitals->create_hospital($data);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Hospital Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function select_hospitals(){

		$json_data=array();
		$j=0;

		$data=array();

		$result	= $this->Hospitals->select_hospitals("*",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$btn_profile = '<a href="'.base_url().'hospitals/'.$row->hospital_id.'" class="btn btn-sm btn-warning m-1"> <i class="flaticon flaticon-eye"></i> </a>';
			$btn_edit = '<button data-toggle="modal" data-target="#hospital_edit_modal" id="hospital_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="hospital_delete_btn" data-target="#hospital_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			$hospital = '
			<a href="'.base_url().'hospitals/'.$row->hospital_id.'">
			<span class="text-dark font-weight-bold text-hover-primary mb-1 font-size-lg">'.$row->hospital_name.'</span>
			</a><br>
			<span class="text-dark">'.nl2br($row->address).'</span><br>
			<span class="text-dark">'.$row->contact.'</span>';

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date)).'<br>By '.$row->name.'<br>'.'<span class="label label-lg label-dark label-inline mr-2">'.str_replace(' ', '&nbsp;', $row->role_name).'</span>';

			$array[$j][]=$j+1;
			$array[$j][]=$hospital;
			$array[$j][]=nl2br($row->description);
			$array[$j][]=$added_info;
			$array[$j][]=$btn_profile.$btn_edit.$btn_delete;
			$array[$j][]=$row->hospital_id;
			$array[$j][]=$row->hospital_name;
			$array[$j][]=$row->location;
			$array[$j][]=$row->contact;
			$array[$j][]=nl2br($row->address);

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['hospital_id'] = $this->security->xss_clean($this->input->post('hospital_id'));
		$data['delete_status'] = 1;

		$result = $this->Hospitals->update_hospital($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Hospital Deleted Successfully!";
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
		$data['hospital_id'] = $this->security->xss_clean($this->input->post('hospital_id'));

		$data['hospital_name'] = $this->security->xss_clean($this->input->post('name'));
		$data['location'] = $this->security->xss_clean($this->input->post('location'));
		$data['contact'] = $this->security->xss_clean($this->input->post('contact'));
		$data['address'] = $this->security->xss_clean($this->input->post('address'));
		$data['description'] = $this->security->xss_clean($this->input->post('description'));
		$data['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Hospitals->update_hospital($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Hospital Updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}


	public function fetch_summary_info()
	{
		$data['c.hospital_id'] = $data1['c.hospital_id'] = $data2['c.hospital_id'] = $data3['dnt.dnt_hospital_id'] = $this->security->xss_clean($this->input->post('hospital_id'));
		$data['c.status'] = 0;
		$data1['c.status'] = 1;

		$result = array();

		$units = $this->Cases->select_cases('coalesce(sum(c.needed_units),0) as needed,coalesce(sum(c.donated_units),0) as donated',$data)->row();
		if($units->needed>0){
			$result['percentage'] = round((($units->donated)/($units->needed))*100);					
		}else{
			$result['percentage'] = 100;					
		}

		$cases_donation_count = $this->Donations->select_donations('dnt.donation_id',$data2)->num_rows();
		$voluntary_donation_count = $this->Donations->select_donations('dnt.donation_id',$data3)->num_rows();

		$result['open_cases_count'] = $this->Cases->select_cases('c.case_id',$data)->num_rows();
		$result['closed_cases_count'] = $this->Cases->select_cases('c.case_id',$data1)->num_rows();
		$result['donations_units_count'] = $cases_donation_count+$voluntary_donation_count;
		$result['needed_units'] = $units->needed - $units->donated; 

		echo json_encode($result);

	}
	


}