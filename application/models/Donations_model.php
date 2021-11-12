<?php
class Donations_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_donations($columns='*',$data='')
	{
		$this->db->select($columns)->from('donations dnt');
		$this->db->join('cases c','c.case_id=dnt.case_id','left');
		$this->db->join('hospitals h','h.hospital_id=c.hospital_id','left');
		$this->db->join('donors dnr','dnt.donor_id=dnr.donor_id');
		$this->db->join('committee_members cm','dnt.member_id=cm.member_id');
		$this->db->join('committees co','cm.committee_id=co.committee_id');
		$this->db->join('users u','u.user_id=dnt.created_by');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');
		
		if(!empty($data)){
			$this->db->where($data);
		}

		$this->db->where('dnt.delete_status',0);
		// $this->db->where('c.delete_status',0);
		// $this->db->where('h.delete_status',0);
		$this->db->where('dnr.delete_status',0);
		$this->db->where('u.delete_status',0);

		$this->db->order_by('dnt.donation_id','desc');
		$query = $this->db->get();
		return $query;
	}

	public function create_donation($data)
	{
		$query = $this->db->insert('donations', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}

	public function update_donation($data){
		$this->db->where('donation_id', $data['donation_id']);
		$query = $this->db->update('donations', $data);
		return $query;
	}
	
	
	
}
?>
