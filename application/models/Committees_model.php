<?php
class Committees_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_committees($columns='*',$data='')
	{
		$this->db->select($columns)->from('committees c');
		$this->db->join('users u','u.user_id=c.committee_user_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('c.delete_status',0);
		$this->db->where('u.delete_status',0);

		$this->db->order_by('c.committee_id','desc');
		$query = $this->db->get();
		return $query;
	}

	public function create_committee($data)
	{
		$query = $this->db->insert('committees', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}

	public function update_committee($data){
		$this->db->where('committee_id', $data['committee_id']);
		$query = $this->db->update('committees', $data);
		return $query;
	}
	


	public function select_committee_members($columns='*',$data='')
	{
		$this->db->select($columns)->from('committee_members cm');
		$this->db->join('committees c','c.committee_id=cm.committee_id');
		$this->db->join('users u','u.user_id=cm.created_by');
		$this->db->join('users u2','u2.user_id=cm.member_user_id');
		
		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('cm.delete_status',0);
		$this->db->where('c.delete_status',0);
		$this->db->where('u2.delete_status',0);

		$this->db->order_by('cm.member_id','desc');
		$query = $this->db->get();
		return $query;
	}

	public function create_committee_member($data)
	{
		$query = $this->db->insert('committee_members', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}

	public function update_committee_member($data){
		$this->db->where('member_id', $data['member_id']);
		$query = $this->db->update('committee_members', $data);
		return $query;
	}
	
	
	
}
?>
