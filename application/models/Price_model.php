<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Price_model extends CI_Model
{
    public $table = "price_details";

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
        $this->db->where('price_id', $id);
        return $this->db->get()->row_array();

    }
    public function update($id, $data) {
        $this->db->where('price_id', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function delete($id) {
        $this->db->where('price_id', $id);
        $this->db->delete($this->table, $data);
        return true;
    }

    public function truncate() {
        $this->db->truncate($this->table);
        return true;
    }

    public function getPriceResults($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();
        
    }

    public function getPriceRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function getPriceResultsOrder($condition,$order)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        $this->db->order_by($order,'ASC');
        return $this->db->get()->result_array();
        
    }

    public function getDistinctSizeResults($table,$condition)
    {
        $this->db->distinct();
        $this->db->select('size_id');
        $this->db->from($table);
        $this->db->where($condition) ;
        
        return $this->db->get()->result_array();
         
    }

    public function getDistinctQualityResults($table,$condition)
    {
        $this->db->distinct();
        $this->db->select('quality_id');
        $this->db->from($table);
        $this->db->where($condition) ;
        
        return $this->db->get()->result_array();
         
    }

    public function getSize($id){
        $this->db->distinct();
        $this->db->select('size_id');
        $this->db->from($this->table);
        $this->db->where('quality_id',$id);
        $this->db->where('status',1);
     
        $result =  $this->db->get()->result_array();
        
        return $result;
    
    }
}
    