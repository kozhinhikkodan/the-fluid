<?php
class Donors_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_donors($columns='*',$data='')
	{
		$this->db->select($columns)->from('donors d');
		$this->db->join('users u','u.user_id=d.created_by');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('d.delete_status',0);
		$this->db->where('u.delete_status',0);

		$this->db->order_by('d.next_donation_date','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_donor($data)
	{
		$query = $this->db->insert('donors', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}

	public function update_donor($data){
		$this->db->where('donor_id', $data['donor_id']);
		$query = $this->db->update('donors', $data);
		return $query;
	}
	
	
	
}
?>
