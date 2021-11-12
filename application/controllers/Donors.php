<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donors extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->library('Management','management');

		$this->load->model('User_model','User');
		$this->load->model('Donors_model','Donors');
		$this->load->model('Committees_model','Committees');

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

		$this->data['folder']='donors';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$this->data['page']='donors_list';
		$this->load->view('Index',$this->data);
	}

	public function profile($id='')
	{
		if($id!=''){
			$donor_data = $this->Donors->select_donors('*',array('d.donor_id'=>$id));
			if($donor_data->num_rows()==1){

				$this->data['donor_data'] = $donor_data->row();
				$this->data['committees'] = $this->Committees->select_committees('*')->result();
				$this->data['hospitals'] = $this->Hospitals->select_hospitals('*')->result();

				$this->data['page']='donor_profile';
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
		$data['donor_contact'] = $this->security->xss_clean($this->input->post('contact'));
		$count = $this->Donors->select_donors('*',$data)->num_rows();
		if($count==0){ 
			$data['donor_name'] = $this->security->xss_clean($this->input->post('name'));
			$data['donor_group'] = $this->security->xss_clean($this->input->post('group'));

			$last_donated_date = $this->security->xss_clean($this->input->post('last_donated_date'));
			if(isset($last_donated_date)){
				$data['last_donated_date'] = date('Y-m-d',strtotime($last_donated_date));
			}else{
				$data['last_donated_date'] = '0000-00-00';
			}

			$next_donation_date = $this->security->xss_clean($this->input->post('next_donation_date'));
			if(isset($next_donation_date)){
				$data['next_donation_date'] = date('Y-m-d',strtotime($next_donation_date));
			}else{
				$data['next_donation_date'] = '0000-00-00';
			}

			if (strtotime($data['next_donation_date'])<strtotime(date('d-m-Y'))) {
				$data['eligible'] = 1;
			}else{
				$data['eligible'] = 0;
			}

			$data['availability'] = 1;

			$data['gender'] = $this->security->xss_clean($this->input->post('gender_add'));
			$data['no_of_donations'] = $this->security->xss_clean($this->input->post('no_of_donations'));
			$data['location'] = $this->security->xss_clean($this->input->post('location'));
			$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));

			$data['created_date'] = date('Y-m-d h:i:s');
			$data['created_by'] = $this->session->userdata('user_id');
			
			$result = $this->Donors->create_donor($data);
			
			if($result['status']==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Donor added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Contact Number already in use !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}

	public function update()
	{
		$data['donor_contact'] = $data2['donor_contact'] = $this->security->xss_clean($this->input->post('contact'));
		$data['donor_id'] = $data2['donor_id!='] = $this->security->xss_clean($this->input->post('donor_id'));
		$count = $this->Donors->select_donors('*',$data2)->num_rows();
		if($count==0){
			$data['donor_name'] = $this->security->xss_clean($this->input->post('name'));
			$data['donor_group'] = $this->security->xss_clean($this->input->post('group'));
			$last_donated_date = $this->security->xss_clean($this->input->post('last_donated_date'));
			$data['gender'] = $this->security->xss_clean($this->input->post('gender_edit'));
			$data['no_of_donations'] = $this->security->xss_clean($this->input->post('no_of_donations'));
			$data['location'] = $this->security->xss_clean($this->input->post('location'));
			$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));

			$last_donated_date = $this->security->xss_clean($this->input->post('last_donated_date'));
			if(isset($last_donated_date)){
				$data['last_donated_date'] = date('Y-m-d',strtotime($last_donated_date));
			}else{
				$data['last_donated_date'] = '0000-00-00';
			}
			
			$next_donation_date = $this->security->xss_clean($this->input->post('next_donation_date'));
			if(isset($next_donation_date)){
				$data['next_donation_date'] = date('Y-m-d',strtotime($next_donation_date));
			}else{
				$data['next_donation_date'] = '0000-00-00';
			}

			if (strtotime($data['next_donation_date'])<strtotime(date('d-m-Y'))) {
				$data['eligible'] = 1;
			}else{
				$data['eligible'] = 0;
			}

			$data['updated_date'] = date('Y-m-d h:i:s');
			$data['updated_by'] = $this->session->userdata('user_id');

			$result = $this->Donors->update_donor($data);
			if($result==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Donor updated Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}
		}else{
			$flash_data['flashdata_msg'] = 'Contact Number already in use !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}


	public function update_availability()
	{
		$data['donor_id'] = $this->security->xss_clean($this->input->post('donor_id'));
		$data['availability'] = $this->security->xss_clean($this->input->post('availability'));

		$availability_date = $this->security->xss_clean($this->input->post('availability_date'));
		$data['available_date'] = date('Y-m-d',strtotime($availability_date));
		$availability_time = $this->security->xss_clean($this->input->post('availability_time'));
		$data['available_time'] = date('h:i:s',strtotime($availability_time));

		$data['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Donors->update_donor($data);

		// %20 - space
		// %0a - new line

		$donor_name = $this->security->xss_clean($this->input->post('donor_name'));
		$donor_contact = $this->security->xss_clean($this->input->post('donor_contact'));
		if($data['availability']==1){
			$availability = 'Availabile%20after';
		}else{
			$availability = 'Not%20availabile%20until';
		}

		$available_date = date('d-F-Y',strtotime($availability_date));
		$available_date .= '%20'.date('h:i%20A',strtotime($availability_time));

		$message = "Dear%20".$donor_name.",%0aYour%20availability%20for%20Blood%20Donation%20is%20changed%20to%20-%20".$availability."%20".$available_date."%0a%0aFor%20any%20changes%20or%20contact%20us";
		$sms = $this->management->send_sms($donor_contact,$message);

		// exit(print_r($sms));

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Donor Availability updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		
		echo json_encode($flash_data);
	}


	public function select_donors(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['gender']) && $_POST['gender']!='' && $_POST['gender']!='all'){
			$data['d.gender'] = $_POST['gender'];
		}

		if(isset($_POST['status']) && $_POST['status']!='' && $_POST['status']!='all'){
			$data['d.eligible'] = $_POST['status'];
		}

		if(isset($_POST['availability']) && $_POST['availability']!='' && $_POST['availability']!='all'){
			$data['d.availability'] = $_POST['availability'];
		}

		if(isset($_POST['group']) && $_POST['group']!='' && $_POST['group']!='all'){
			$data['d.donor_group'] = $_POST['group'];
		}

		if($this->session->userdata('user_role')!='admin'){
			$data['d.created_by'] = $this->session->userdata('user_id');
		}

		$result	= $this->Donors->select_donors("*",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$btn_availability = '<button data-toggle="modal" data-target="#donor_availability_modal" id="donor_availability_btn" class="btn btn-sm btn-info m-1"> <i class="flaticon2 flaticon2-calendar-9"></i> </button>';

			$btn_profile = '<a href="'.base_url().'donors/'.$row->donor_id.'" class="btn btn-sm btn-warning m-1"> <i class="flaticon flaticon-eye"></i> </a>';

			$btn_edit = '<button data-toggle="modal" data-target="#donor_edit_modal" id="donor_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="donor_delete_btn" data-target="#donor_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			if($row->gender=='male'){
				$colour = 'primary';
			}else{
				$colour = 'info';
			}

			$donor = '
			<a href="'.base_url().'donors/'.$row->donor_id.'" ><span class="text-dark font-weight-bold text-hover-primary mb-1 font-size-lg">'.$row->donor_name.'</span></a><br>
			<span class="text-dark">#'.$row->donor_id.'</span><br>
			<span class="text-dark">'.$row->location.'</span><br>
			<span class="text-dark">'.$row->donor_contact.'</span><br>
			<div class="row ml-1">
			<span class="label label-sm label-'.$colour.' label-inline mr-2 mb-2" style=" width: 45px; ">'.ucfirst($row->gender).'</span>
			<span class="label label-sm label-danger label-inline mr-2" style=" width: 35px; ">'.$row->donor_group.'</span>
			</div>';

			if($row->eligible==1){
				$status = '<span class="label label-lg label-success label-inline mr-2">Elgible</span>';
			}else{
				$status = '<span class="label label-lg label-danger label-inline mr-2">Not&nbsp;Elgible</span>';
			}

			if($row->next_donation_date!='0000-00-00'){
				$next_donation_date = '<span class="text-danger font-weight-bold">'.date('d-m-Y',strtotime($row->next_donation_date)).'</span>';
			}else{
				$next_donation_date = 'NA'; 
			}

			if($row->last_donated_date!='0000-00-00'){
				$last_donated_date = date('d-m-Y',strtotime($row->last_donated_date));
			}else{
				$last_donated_date = 'NA'; 
			}


			if($row->availability==1){
				$status .= '<br><span class="label label-lg label-success label-inline mr-2 mt-2">Available</span>';
			}else{
				$status .= '<br><span class="label label-lg label-danger label-inline mr-2 mt-2">Not&nbsp;Available</span>';
			}

			if($row->available_date!='0000-00-00'){

				if($row->availability==1){
					$status .= '<br>From';
				}else{
					$status .= '<br>Until';
				}

				$status .= '<br><span class="text-danger font-weight-bold mt-5">'.date('d-m-Y',strtotime($row->available_date)).'</span>';
			}

			if($row->available_time!='00:00:00'){
				$status .= '<br><span class="text-danger font-weight-bold mt-5">'.date(' h:i A',strtotime($row->available_time)).'</span>';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date)).'<br>By '.$row->name.'<br>'.'<span class="label label-lg label-dark label-inline mr-2">'.str_replace(' ', '&nbsp;', $row->role_name).'</span>';

			$array[$j][]=$j+1;
			$array[$j][]=$donor;
			$array[$j][]=$last_donated_date;
			$array[$j][]=$next_donation_date;
			$array[$j][]=$row->no_of_donations;
			$array[$j][]=$status;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_availability.$btn_profile.$btn_edit.$btn_delete;
			$array[$j][]=$row->donor_name;
			$array[$j][]=$row->donor_group;
			$array[$j][]=$row->donor_contact;
			$array[$j][]=$row->location;
			$array[$j][]=$row->remarks;
			$array[$j][]=$row->donor_id;
			$array[$j][]=$row->gender;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['donor_id'] = $this->security->xss_clean($this->input->post('donor_id'));
		$data['delete_status'] = 1;

		$result = $this->Donors->update_donor($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Donor Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}

	public function fetch_donors()
	{
		$donor_group = $this->security->xss_clean($this->input->post('group'));

		if(isset($donor_group) && $donor_group!='' && $donor_group!='all'){
			$data['d.donor_group'] = $donor_group;
		}

		if($this->session->userdata('user_role')!='admin'){
			$data['d.created_by'] = $this->session->userdata('user_id');
		}

		$data['eligible'] = 1;
		$data['availability'] = 1;
		$data['available_date<='] = date('Y-m-d');

		$result['donors']	= $this->Donors->select_donors("*",$data)->result();
		echo json_encode($result);
	}

	public function fetch_summary_info()
	{
		$data['d.donor_id'] = $this->security->xss_clean($this->input->post('donor_id'));
		$donor_data = $this->Donors->select_donors('*',$data)->row();
		$result['eligibility_status'] = $donor_data->eligible;
		$result['last_donated_date'] = date('d-m-Y',strtotime($donor_data->last_donated_date));
		$result['next_donation_date'] = date('d-m-Y',strtotime($donor_data->next_donation_date));
		$result['donations_count'] = $donor_data->no_of_donations; 

		echo json_encode($result);

	}
	

}