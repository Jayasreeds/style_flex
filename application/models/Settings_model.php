<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Settings_model extends CI_Model
{
    public $table = "settings";

    public function __construct()
    {
        parent::__construct();
       
    }
 
    // public function insert($data){
    //     $this->db->insert($this->table,$data);
    //     return $this->db->insert_id();
    // }
    // public function getEdit($id){
    //     $this->db->from($this->table);
    //     $this->db->where('customer_id', $id);
    //     return $this->db->get()->row_array();

    // }
    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    // public function delete($id) {
    //     $this->db->where('id', $id);
    //     $this->db->delete($this->table, $data);
    //     return true;
    // }
 
    // function checkIdmodelAlredyExist($cus_id,$id){

    //     $this->db->from($this->table);
    //     if($id!=0){
    //         $this->db->where('id !=', $id);
    //     }

    //     $this->db->where('cus_id', $cus_id);
    //     $this->db->where('status !=',3);
        
    //     return $this->db->get()->result_array();
    // }
     
    // public function getCustomerResults($condition)
    // {
    //     $this->db->select('*');
    //     $this->db->from($this->table);
    //     if($condition)
    //         $this->db->where($condition);
    //     return $this->db->get()->result_array();
        
    // }

    public function getSettingRow($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($id)
            $this->db->where('id',$id);
        return $this->db->get()->row_array();
        
    }

    // public function getCustomerResultsOrder($condition,$order)
    // {
    //     $this->db->select('*');
    //     $this->db->from($this->table);
    //     if($condition)
    //         $this->db->where($condition);
    //     $this->db->order_by($order,'ASC');
    //     return $this->db->get()->result_array();
        
    // }

    // public function getBranchCustomerResults($condition)
    // {
    //     $this->db->select('*');
    //     $this->db->from($this->table);
    //     if($condition)
    //         $this->db->where($condition);
    //      $result =  $this->db->get()->result_array();

    //     return json_encode($result);
        
    // }

    // public function getBranchCustomerRow($condition)
    // {
    //     $this->db->select('*');
    //     $this->db->from($this->table);
    //     if($condition)
    //         $this->db->where($condition);
    //      $result =  $this->db->get()->row_array();

    //     return json_encode($result);
        
    // }
}
    