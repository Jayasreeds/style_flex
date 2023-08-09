<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();
 		
        $this->load->model('Category_model');
        $this->load->model('branch/Branch_model');
            
 	}

    public function index()
    {
        $page_data['type'] = $this->session->userdata('type');
        $page_data['page_title'] = 'Manage Category';
        $page_data['page_title1'] = 'Category Details';
        $page_data['page_path'] = 'manage_category';
       
       
        $condition = "status = '1'"; 
        $page_data['categorydata'] = $this->Category_model->getCategoryResultsOrder($condition);

        $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");  
        $this->load->view('template',$page_data);
    }

    public function addcategory()
    {
        $page_data['page_path'] = 'addcategory';
        $page_data['type'] = $this->session->userdata('type');
        // $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");  
        $this->load->view('template',$page_data);
    }
     public function addsubcategory()
    {
        $page_data['page_path'] = 'addsubcategory';
        $page_data['type'] = $this->session->userdata('type');
         $condition = "status = '1'"; 
        $page_data['categorydata'] = $this->Category_model->getCategoryResultsOrder($condition);
        // $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");  
        $this->load->view('template',$page_data);
    }

    public function editcategory()
    {
        $uri = $this->uri->segment(2);
        $page_data['edt_categorydata'] = $this->Category_model->getCategoryRow("category_id = '".$uri."'");
        $page_data['page_path'] = 'editcategory';
        $page_data['type'] = $this->session->userdata('type');
        $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");  
        $this->load->view('template',$page_data);
    }

    public function add_category()
    {
        $error_type = '';
        $msg = '';
       
        $result = false;

        $type=  $this->session->userdata('type');



        // if ($type==1){

        //     $branch_id=$this->input->post('branch_id');
        // }



        // elseif ($type==2) {
        //     $branch_id= $this->session->userdata('branch_id');
        // }
        

        $category = $this->input->post('category');
        $status = $this->input->post('status');
        $created_by = $this->session->userdata('branch_id');
       

        $data = array(
            // 'branch_id'        => $branch_id,
            'category'         => $category,
            'status'     => $status,
            'created_by'  =>$created_by
            
        );
        $enquiryId  =$this->Category_model->insert($data);
        if($enquiryId > 0)
            $result = true;
       

        ($result) ? $this->session->set_flashdata('success','Category Details Added Successfully!'):$this->session->set_flashdata('error','Something went wrong!');  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
       
    }

    public function getdetails() 
    {
        $category_id = $this->input->post('category_id');
        $getdata =   $this->Category_model->getCategoryRow("category_id = '".$category_id."'");
        
        $data = array(
            "category"      => ucfirst($getdata['category']),
            "sub_category"  => ucwords($getdata['sub_category'])
        );

        echo json_encode($data);
    }

    public function checkCategoryAlredyExist()
    {

            $category = $this->input->post('category');
            $category_id = $this->input->post('category_id');
            $result = $this->Category_model->checkCategoryNameAlredyExist($category,$category_id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }

    public function checkSubCategoryAlredyExist()
    {

            $sub_category = $this->input->post('sub_category');
            $category_id = $this->input->post('category_id');
            $result = $this->Category_model->checkSubCategoryNameAlredyExist($sub_category,$category_id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }

    public function updatecategory()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $this->form_validation->set_rules('category', 'Category Name', 'trim|required');
       
 

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

           $category = $this->input->post('category');
           $status = $this->input->post('status');
           $created_by = $this->session->userdata('branch_id');
            
           

           
            $data = array(
                
                'category'  => $category,
                'status'     => $status,
                'created_by'  =>$created_by
            );

            $update = $this->Category_model->update($this->input->post('category_id'),$data);
            
        }

        if($update)
            $result = true;

        ($result) ? $this->session->set_flashdata('success','Category Details Updated Successfully!'):$this->session->set_flashdata('error','Something went wrong!');  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
    }

    public function deletecategory()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $category_id = $this->input->post('category_id');
        
        $data = array(
            'status'  => '3'
        );

        $update = $this->Category_model->update($this->input->post('category_id'),$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Category deleted successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    public function getSubcategory()
    {
        $category_id = $this->input->post('category_id');
        
        $res = array();
        $result = $this->Category_model->getSubcategory($category_id);
       
        echo json_encode($result);
     }
}
