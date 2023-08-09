<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Size_model extends CI_Model
{
    public $table = "size_details";
    public $t_table = "size_type";

    public function __construct()
    {
        parent::__construct();
       
    }
 
    public function insert($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }

    public function insert1($data){
        $this->db->insert($this->t_table,$data);
        return $this->db->insert_id();
    }

    public function getEdit($id){
        $this->db->from($this->table);
        $this->db->where('size_id', $id);
        return $this->db->get()->row_array();

    }
    public function update($id, $data) {
        $this->db->where('size_id', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function delete($id) {
        $this->db->where('size_id', $id);
        $this->db->delete($this->table, $data);
        return true;
    }

    public function truncate() {
        $this->db->truncate($this->t_table);
        return true;
    }

    public function getSizeTypeResults($condition)
    {
        $this->db->select('*');
        $this->db->from($this->t_table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();
        
    }

    public function getSizeResults($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();
        
    }

    public function getSizeRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function getSizeTypeRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->t_table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function getSizeResultsOrder($condition,$order)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        $this->db->order_by($order,'ASC');
        return $this->db->get()->result_array();
        
    }
}
    