<?php
class Hospitals_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_hospitals($columns='*',$data='')
	{
		$this->db->select($columns)->from('hospitals h');
		$this->db->join('users u','u.user_id=h.created_by');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');
	 
		if(!empty($data)){
			$this->db->where($data);
		}
		$this->db->where('h.delete_status',0);
		$this->db->where('u.delete_status',0);

		$this->db->order_by('h.hospital_id','desc');
		$query = $this->db->get();
		return $query;
	}

	public function create_hospital($data)
	{
		$query = $this->db->insert('hospitals', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_hospital($data){
		$this->db->where('hospital_id', $data['hospital_id']);
		$query = $this->db->update('hospitals', $data);
		return $query;
	}
	
	
	
}
?>
