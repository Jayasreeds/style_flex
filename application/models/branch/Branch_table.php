<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_table extends CI_Model {

    var $table = 'category c';

    //set column field database for datatable orderable
    var $column_order = array('c.category_id','c.category_name','c.status','');
    //set column field database for datatable searchable
    var $column_search = array('c.category_id','c.category_name','c.status');
    var $order = array('c.category_id' => 'desc'); // default order

    public function __construct() {
        parent::__construct();
        //$this->load->database();
    }

    private function _get_datatables_query() {
        $created_by =$this->session->userdata('user_id');

        $this->db->from($this->table);
        $this->db->where('status!=',3);
        $this->db->where('created_by',$created_by);
       
        $i = 0;

        foreach ($this->column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables() {


        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
        //echo $this->db->last_query();
    }

    public function count_filtered() {

        $this->_get_datatables_query();
       
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $created_by =$this->session->userdata('user_id');

        $this->db->from($this->table);
        $this->db->where('created_by',$created_by);

        $query = $this->db->get();
        return $query->num_rows();
    }

}
