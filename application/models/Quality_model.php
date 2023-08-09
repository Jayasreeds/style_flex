<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Quality_model extends CI_Model
{
    public $table = "quality_details";

    public function __construct()
    {
        parent::__construct();
       
    }
 
    public function insert($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    public function getEdit($id){
        $this->db->from($this->table);
        $this->db->where('quality_id', $id);
        return $this->db->get()->row_array();

    }
    public function update($id, $data) {
        $this->db->where('quality_id', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function delete($id) {
        $this->db->where('quality_id', $id);
        $this->db->delete($this->table, $data);
        return true;
    }

   
    function checkQualityNameAlredyExist($name,$id=0){

        $this->db->from($this->table);
        if($id!=0){
            $this->db->where('quality_id !=', $id);
        }

        $this->db->where('quality_name', $name);
        $this->db->where('status !=',3);

        return $this->db->get()->result_array();
    }
     
    public function getQualityResults($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();
        
    }

    public function getQualityRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function getQualityResultsOrder($condition,$order)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        $this->db->order_by($order,'ASC');
        return $this->db->get()->result_array();
        
    }

    public function getDistinctQualityResults($condition)
    {
        $this->db->distinct();
        $this->db->select('quality_id');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition) ;
        
        return $this->db->get()->result_array();
         
    }
}
    