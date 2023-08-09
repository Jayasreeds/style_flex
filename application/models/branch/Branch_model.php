<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Branch_model extends CI_Model
{
    public $table = "branch";

    public function __construct()
    {
        parent::__construct();
       
    }

  
    function insert($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    function getEdit($id){
        $this->db->from($this->table);
        $this->db->where('branch_id', $id);
        return $this->db->get()->row_array();

    }
    public function update($id, $data) {
        $this->db->where('branch_id', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function delete($id) {
        $this->db->where('branch_id', $id);
        $this->db->delete($this->table, $data);
        return true;
    }

   
    function checkUserNameAlredyExist($name,$id=0){
       // $created_by = $this->session->userdata('user_id');

        $this->db->from($this->table);
        if($id!=0){
            $this->db->where('branch_id !=', $id);

        }

        $this->db->where('username', $name);
        $this->db->where('status !=',3);
       // $this->db->where('created_by',$created_by);

         return $this->db->get()->result_array();
        //  echo $this->db->last_query();
    }

    function checknumberAlredyExist($mobile,$id=0){
       // $created_by = $this->session->userdata('user_id');

        $this->db->from($this->table);
        if($id!=0){
            $this->db->where('branch_id !=', $id);

        }

        $this->db->where('mobile_number', $mobile);
        $this->db->where('status !=',3);
       // $this->db->where('created_by',$created_by);

         return $this->db->get()->result_array();
        //  echo $this->db->last_query();
    }

    function checkBranchCodeAlredyExist($name,$id=0){
         $this->db->from($this->table);
         if($id!=0){
             $this->db->where('branch_id !=', $id);
         }
         $this->db->where('branch_code', $name);
         $this->db->where('status !=',3);
          return $this->db->get()->result_array();
    }

    public function getBranchResults($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();
        
    }

    public function getBranchRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function getBranchResultsOrder($condition,$order)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        $this->db->order_by($order,'ASC');
        return $this->db->get()->result_array();
        
    }
}
    