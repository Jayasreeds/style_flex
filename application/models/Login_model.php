<?php


class Login_model extends CI_Model
{
	
	public $mtable = 'master_login';
	public $btable = 'branch';
	public function masterlogin($condition) {

		$this->db->select('*');
		$this->db->from($this->mtable);
		$this->db->where($condition);
		$get = $this->db->get();
		if($get->num_rows() > 0)
			return $get->row();
		else
			return false;
	}

	public function adminlogin($condition) {

		$this->db->select('*');
		$this->db->from($this->btable);
		$this->db->where($condition);
		$get = $this->db->get();
		if($get->num_rows() > 0)
			return $get->row();
		else
			return false;
	}

	 
}

?>