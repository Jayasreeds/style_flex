<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Model_name_model extends CI_Model
{
    public $table = "model";

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
        $this->db->where('model_id', $id);
        return $this->db->get()->row_array();

    }
    public function update($id, $data) {
        $this->db->where('model_id', $id);
        $this->db->update($this->table, $data);
        return true;
    }

    public function delete($id) {
        $this->db->where('model_id', $id);
        $this->db->delete($this->table, $data);
        return true;
    }
     
    public function getModelResults($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();
        
    }

    public function getModelRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function getModelLastRow()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->limit(1);
        $this->db->order_by('model_id','DESC');
        return $this->db->get()->row_array();
        
    }

    public function getModelResultsOrder($condition)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if($condition)
            $this->db->where($condition);
        $this->db->order_by('model_id','ASC');
        return $this->db->get()->result_array();
        
    }

    public function checkModelAlredyExist($name,$id=0){

        $this->db->from($this->table);
        if($id!=0){
            $this->db->where('model_id !=', $id);
        }

        $this->db->where('model_name', $name);
        $this->db->where('status !=',3);

        return $this->db->get()->result_array();
    }

    
}
    