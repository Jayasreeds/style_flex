<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Stock_model extends CI_Model
{
    public $table = "temp_model";
    public $base_table = "model_base";
    public $sub_table = "model_sub";

    public function __construct()
    {
        parent::__construct();
       
    }
 
    public function insert($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    public function insert_base($data){
        $this->db->insert($this->base_table,$data);
        return $this->db->insert_id();
    }
    public function insert_sub($data){
        $this->db->insert($this->sub_table,$data);
        return $this->db->insert_id();
    }
    public function truncate_temp(){
        $this->db->truncate($this->table);
        return true;
    }
    public function getEdit($id){
        $this->db->from($this->table);
        $this->db->where('customer_id', $id);
        return $this->db->get()->row_array();

    }
    public function update($id, $data) {
        $this->db->where('category_id', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function updatebyCustomerId($id, $data) {
        $this->db->where('cus_id', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table, $data);
        return true;
    }

    public function checkCategoryNameAlredyExist($name,$id=0){

        $this->db->from($this->table);
        if($id!=0){
            $this->db->where('category_id !=', $id);
        }

        $this->db->where('category', $name);
        $this->db->where('status !=',3);

        return $this->db->get()->result_array();
    }

    public function checkSubCategoryNameAlredyExist($name,$id=0){

        $this->db->from($this->table);
        if($id!=0){
            $this->db->where('category_id !=', $id);
        }

        $this->db->where('sub_category', $name);
        $this->db->where('status !=',3);

        return $this->db->get()->result_array();
    }
     
    public function getCategoryResults()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        return $this->db->get()->result_array();
        
    }

    public function getCategoryRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function getCategoryLastRow()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->limit(1);
        $this->db->order_by('id','DESC');
        return $this->db->get()->row_array();
        
    }

    public function getCategoryResultsOrder($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        $this->db->order_by('category_id','DESC');
        return $this->db->get()->result_array();
        
    }

    public function getBranchCategoryResults($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
         $result =  $this->db->get()->result_array();

        return json_encode($result);
        
    }

    public function getBranchCategoryRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
         $result =  $this->db->get()->row_array();

        return json_encode($result);
        
    }
}
    