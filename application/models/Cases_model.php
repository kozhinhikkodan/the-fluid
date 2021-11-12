<?php
class Cases_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_cases($columns='*',$data='')
	{
		$this->db->select($columns)->from('cases c');
		$this->db->join('hospitals h','h.hospital_id=c.hospital_id');
		$this->db->join('users u','u.user_id=c.created_by');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('c.delete_status',0);
		$this->db->where('h.delete_status',0);
		$this->db->where('u.delete_status',0);

		$this->db->order_by('c.case_id','desc');
		$query = $this->db->get();
		return $query;
	}

	public function create_case($data)
	{
		$query = $this->db->insert('cases', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}

	public function update_case($data){
		$this->db->where('case_id', $data['case_id']);
		$query = $this->db->update('cases', $data);
		return $query;
	}
	
	
}
?>
