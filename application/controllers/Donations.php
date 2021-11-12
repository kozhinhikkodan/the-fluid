<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donations extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->library('Management','management');	

		$this->load->model('User_model','User');
		$this->load->model('Cases_model','Cases');
		$this->load->model('Donations_model','Donations');
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

		$this->data['folder']='donations';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$this->data['open_cases'] = $this->Cases->select_cases('*',array('c.status'=>0))->result();
		// $this->data['donors'] = $this->Donors->select_donors('*')->result();
		$this->data['committees'] = $this->Committees->select_committees('*')->result();
		$this->data['hospitals'] = $this->Hospitals->select_hospitals('*')->result();
		
		$this->data['page']='donations_list';
		$this->load->view('Index',$this->data);
	}

	public function certificate($id='')
	{
		if($id!=''){

			$donation_data = $this->Donations->select_donations('*,dnr.location as donor_location, h.location as hospital_location',array('dnt.donation_id'=>$id));

			if($donation_data->num_rows()==1){

				$this->data['donation_data'] = $donation_data->row();
				$this->data['doner_name'] = $donation_data->row()->donor_name;

				$this->load->view('modules/donations/certificate_verify',$this->data);

			}else{
				show_404();
			}


		}else{
			show_404();
		}
	}

	public function create()
	{

		$data['case_id'] = $this->security->xss_clean($this->input->post('case_id'));
		$data['dnt_hospital_id'] = $this->security->xss_clean($this->input->post('hospital_id'));
		$data['donor_id'] = $this->security->xss_clean($this->input->post('donor_id'));
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['donated_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('donated_date'))));

		$data['donation_type'] = $this->security->xss_clean($this->input->post('donation_type_add'));

		if($this->session->userdata('user_role')=='admin'){
			$data['member_id'] = $this->security->xss_clean($this->input->post('member'));
		}else{
			$data['member_id'] = $this->session->userdata('member_data')->member_id;
		}

		$data['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Donations->create_donation($data);

		$this->management->evaluate_case_status($data['case_id']);
		// $this->management->evaluate_hospital($data['dnt_hospital_id']);
		$this->management->evaluate_donor_status($data['donor_id'],$result['insert_id']);
		$this->management->evaluate_committee_donations($data['member_id']);


		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Donation added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);
	}


	public function select_donations(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['hospital']) && $_POST['hospital']!='' && $_POST['hospital']!='all'){
			$data['dnt.dnt_hospital_id'] = $_POST['hospital'];
		}

		if(isset($_POST['start_date']) && $_POST['start_date']!='' && $_POST['start_date']!='all'){
			$data['dnt.donated_date>='] = date('Y-m-d',strtotime($_POST['start_date']));
		}

		if(isset($_POST['end_date']) && $_POST['end_date']!='' && $_POST['end_date']!='all'){
			$data['dnt.donated_date<='] = date('Y-m-d',strtotime($_POST['end_date']));
		}

		if(isset($_POST['group']) && $_POST['group']!='' && $_POST['group']!='all'){
			$data['dnr.donor_group'] = $_POST['group'];
		}

		if(isset($_POST['donor']) && $_POST['donor']!='' && $_POST['donor']!='all'){
			$data['dnt.donor_id'] = $_POST['donor'];
		}

		if(isset($_POST['committee']) && $_POST['committee']!='' && $_POST['committee']!='all'){
			$data['co.committee_id'] = $_POST['committee'];
		}

		$result	= $this->Donations->select_donations("*,u.user_id as created_by_user,dnt.created_date as dnt_created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$btn_certificate = '<a href="'.base_url().'certificate/'.$row->donation_id.'" class="btn btn-sm btn-success m-1  d-none d-md-inline-block d-lg-inline-block d-xl-inline-block"> <i class="flaticon flaticon-medal"></i> </a>';

			if($this->session->userdata('user_role')=='admin' || $this->session->userdata('user_role')=='committee' || $this->session->userdata('user_id')==$row->created_by_user ){
				$btn_edit = '<button data-toggle="modal" data-target="#donation_edit_modal" id="donation_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="donation_delete_btn" data-target="#donation_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';
			}else{
				$btn_edit = $btn_delete = '';
			}

			$btn_edit = '';

			if($row->gender=='male'){
				$colour = 'primary';
			}else{
				$colour = 'info';
			}

			$donor = '<a href="'.base_url().'donors/'.$row->donor_id.'">
			<span class="text-dark font-weight-bold text-hover-primary mb-1 font-size-lg">'.$row->donor_name.'</span></a><br>
			<span class="text-dark">#'.$row->donor_id.'</span><br>
			<span class="text-dark">'.$row->location.'</span><br>
			<span class="text-dark">'.$row->donor_contact.'</span><br>
			<div class="row ml-1">
			<span class="label label-sm label-'.$colour.' label-inline mr-2 mb-2" style=" width: 45px; ">'.ucfirst($row->gender).'</span>
			<span class="label label-sm label-danger label-inline mr-2" style=" width: 35px; ">'.$row->donor_group.'</span>
			</div>
			';

			$member = '
			<a href="'.base_url().'hospitals/'.$row->member_id.'">
			<span class="text-dark font-weight-bold text-hover-primary mb-1 font-size-lg">'.$row->member_name.'</span>
			</a><br>
			<span class="text-dark">'.$row->member_contact.'</span><br>
			<span class="label label-sm label-danger label-inline mr-2">'.$row->committee_name.'</span>
			';

			if(isset($row->case_id)){
				$case_info = '<span class="text-primary">#'.$row->case_id.'</span>
				<br>
				<span class="text-primary">'.date('d-m-Y',strtotime($row->case_date)).'</span>
				<br>
				<span class="label label-sm label-danger label-inline mr-2">'.$row->case_group.'</span>';
			}else{
				$case_info = 'NA';
			}

			if($row->donation_type=='replacement'){
				$donation_type = '<br><span class="label label-sm label-info label-inline mr-2">Replacement</span>';
			}else{
				$donation_type = '<br><span class="label label-sm label-primary label-inline mr-2">Voluntary</span>';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->dnt_created_date)).'<br>By '.$row->name.'<br>'.'<span class="label label-lg label-dark label-inline mr-2">'.str_replace(' ', '&nbsp;', $row->role_name).'</span>';

			$array[$j][]=$j+1;
			$array[$j][]=$case_info;
			$array[$j][]=$donor;
			$array[$j][]=date('d-m-Y',strtotime($row->donated_date)).$donation_type;
			$array[$j][]=$member;
			$array[$j][]=$row->remarks;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_certificate.$btn_edit.$btn_delete;
			$array[$j][]=$row->donation_id;
			$array[$j][]=$row->case_id;
			$array[$j][]=$row->donor_id;



			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{

		$data['donation_id'] = $this->security->xss_clean($this->input->post('donation_id'));
		$data['delete_status'] = 1;

		$result = $this->Donations->update_donation($data);

		$this->management->evaluate_case_status();
		$this->management->evaluate_donor_status();

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Donation deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);
	}



}