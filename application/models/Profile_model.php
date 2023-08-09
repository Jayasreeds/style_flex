<?php


class Profile_model extends CI_Model
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

	public function getEdit($id){
        $this->db->from($this->mtable);
        $this->db->where('id', $id);
        return $this->db->get()->row_array();

    }
    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->mtable, $data);
        return true;
    }

    public function getProfileResults($condition)
    {
        $this->db->select('*');
        $this->db->from($this->mtable);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();
        
    }

    public function getProfileRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->mtable);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function checkOldPassword($pass,$id){
		$this->db->from($this->mtable);
		if($id!=0){
		 	$this->db->where('id', $id);
		}
		
		$this->db->where('password', $pass);
		return $this->db->get()->result_array();
    }
}

?>