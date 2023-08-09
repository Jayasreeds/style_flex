<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Reports_model extends CI_Model
{
    public $table = "customer_details";

    public function __construct()
    {
        parent::__construct();
       
    }



 public function getCustomerCount() {
        
    $this->db->from($this->table);
    $this->db->where('status',1);
    return  $this->db->get()->num_rows(); 


    }




 public function getTodayCustomer() {
        $todayDate = date('Y-m-d');

        //print_r($todayDate);
         $this->db->from($this->table);
        

        
       // $this->db->where('status',1);
    

      $this->db->like('last_updated',$todayDate);

       return  $this->db->get()->num_rows(); 
      // echo $this->db->last_query()

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
    // public function update($id, $data) {
    //     $this->db->where('id', $id);
    //     $this->db->update($this->table, $data);
    //     return true;
    // }

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
      public function getcResults($condition)
    {
        $this->db->select('*');
        $this->db->from('invoice_base');
        $this->db->where($condition);
          
        return $this->db->get()->result_array();
        
    }

     public function getsubRow($condition)
    {
        $this->db->select('*');
        $this->db->from('invoice_sub');
       $this->db->where($condition);
          
        return $this->db->get()->row_array();
        
    }

     public function getQuotesubRow($condition)
    {
        $this->db->select('*');
        $this->db->from('quotation_sub');
       $this->db->where($condition);
          
        return $this->db->get()->row_array();
        
    }

     public function getnameRow($condition)
    {
        $this->db->select('*');
        $this->db->from('customer_details');
       $this->db->where($condition);
          
        return $this->db->get()->row_array();
        
    }

     
    public function getLocCustomer()
    {

        $this->db->select('c.*,b.branch_name');
        $this->db->from('customer_details c');
        $this->db->where('c.status',1);
        $this->db->order_by('c.id','desc');
        $this->db->join('branch b','b.branch_id=c.branch_id','left');
        return $this->db->get()->result_array();     
      // echo $this->db->last_query();   
    }

     public function getBranchResults($condition)
    {
        $this->db->select('*');
        $this->db->from('branch');
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();
        
    }

    public function getSearchResults($condition)
    {
        $this->db->select('*');
        $this->db->from('customer_details');
        $this->db->where('status',1);
        if($condition)
            $this->db->where($condition);
        $this->db->order_by('id','desc');
        return $this->db->get()->result_array();   

    }

    public function getSearchInvoiceResults($condition)
    {
        $this->db->select('*');
        $this->db->from('invoice_base');
        $this->db->where('status',1);
        if($condition)
            $this->db->where($condition);
        $this->db->order_by('id','desc');
        return $this->db->get()->result_array();   

    }

     public function getSearchQuotationResults($condition)
    {
        $this->db->select('*');
        $this->db->from('quotation_base');
        $this->db->where('status',1);
        if($condition)
            $this->db->where($condition);
        $this->db->order_by('id','desc');
        return $this->db->get()->result_array();   

    }

    public function getSearchRecords($condition)
    {
        $this->db->select('c.*,b.branch_name');
        $this->db->from('customer_details c');
        $this->db->where('c.status',1);
        $this->db->where($condition);
        $this->db->order_by('c.id','desc');
        $this->db->join('branch b','b.branch_id=c.branch_id','left');
        return $this->db->get()->result_array();   

    }

     public function getpdstatus($condition)
    {
         $this->db->select('*');
        $this->db->from('invoice_base');
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();

    }

    // public function getCustomerRow($condition)
    // {
    //     $this->db->select('*');
    //     $this->db->from($this->table);
    //     if($condition)
    //         $this->db->where($condition);
    //     return $this->db->get()->row_array();
        
    // }

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
    