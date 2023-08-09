<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();
 		
            $this->load->model('Category_model');
            $this->load->model('Model_name_model');
            $this->load->model('Stock_model');
            $this->load->model('branch/Branch_model');
            
 	}

    public function index()
    {
        $page_data['type'] = $this->session->userdata('type');
        $page_data['page_title'] = 'Manage Category';
        $page_data['page_title2'] = 'Model Details';
        $page_data['page_path'] = 'manage_category'; 
        $page_data['categorydata'] = $this->Category_model->getCategoryResultsOrder("status != '3'");
        $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");  
        $this->load->view('template',$page_data);
    }

    public function addmodel()
    { 

        $page_data['page_path'] = 'addbilling';
         $page_data['page_title2'] = 'Add Model Details';
          $page_data['page_title1'] = 'Add Stock Details';
         $page_data['type'] = $this->session->userdata('type');
         $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");
         $page_data['categorydata'] = $this->Category_model->getCategoryResultsOrder("status != '3'");
         $page_data['modeldata'] = $this->Model_name_model->getModelResults("status != '3'");   
        $this->load->view('template',$page_data);
    }
    public function addstockdetails()
    {

        $type = $this->session->userdata('type');
        $error_type = '';
        $msg = '';
        $baseId = 0;
        $tempId = 0;
        $result = false;
        $data = '';
        $error = '';
        $model_id = $this->input->post('model_id');
        $model_number = $this->input->post('model_number');

        if($type == '1')
        {
            $branch_id = $this->input->post('branch_id');
        }
        else
        {
            $branch_id = $this->session->userdata('branch_id');
        }
        $stock_type = $this->input->post('stock_type');
        $category = $this->input->post('category');
        $sub_category = $this->input->post('sub_category');
        $product_name = $this->input->post('product_name');
        $price = $this->input->post('price');
        $model_id1 = $this->input->post('quality_id1');
        $model_no1 = $this->input->post('size1');
        $quantity = $this->input->post('quantity');
        $tax = $this->input->post('tax');
        $hsn_code = $this->input->post('hsn_code');
        $warrenty = $this->input->post('warrenty');
        $ahm = $this->input->post('ahm');
      

        if($this->input->post('temp_save') == '1')
        {
            $tem_data = array(
                
                'model_id' => $model_id,
                'model_no' => $model_number
            );

           $tempId = $this->Stock_model->insert($tem_data);
            if($tempId>0)
            {
                
                $result = true;
               
               $getmodel = $this->Model_name_model->getModelRow("model_id = '".$model_id."'");
                // foreach ($getres as $res) {
                    $data= '<tr><td><input type="text" class="form-control quality_id1" name="quality_id1[]" value="'.ucwords($getmodel["model_name"]).'" readonly></td><td><input type="text" class="form-control size1" name="size1[]" value="'.$model_number.'" readonly></td></tr>';
                // }
                
            }
            $msg = 'temp_save';

        }
        else
        {

            $this->Stock_model->truncate_temp();

            $stock_base = array(

                'branch_id' => $branch_id,
                'stock_type' => $stock_type,
                'category' => $category,
                'sub_category' => $sub_category,
                'product_name' => $product_name,
                'price' => $price,
                'quantity' => $quantity,
                'gst' => $tax,
                'hsn_code' => $hsn_code,
                'warrenty' => $warrenty,
                'ahm'  => $ahm
            );

            $baseId = $this->Stock_model->insert_base($stock_base);

            if($baseId > 0)
            {
                $result = true;
                if(!empty($model_id1))
                {
                    for ($i=0; $i < count($model_id1); $i++) { 

                        $stock_sub = array(

                            'model_base_id' => $baseId,
                            'model_no' => $model_no1[$i],
                            'model_id' => $model_id1[$i]
                             
                        );

                        $subId = $this->Stock_model->insert_sub($stock_sub);
                        if($subId>0)
                            $result = true;
                    }
                }
            }
            ($result) ? $this->session->set_flashdata('success','Stock Details successfully added'):$this->session->set_flashdata('error','Something went wrong');
        }

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg, 'data' => $data, 'error' => $error));

    }

    // public function editcategory()
    // {
    //     $uri = $this->uri->segment(2);
    //     $page_data['edt_categorydata'] = $this->Category_model->getCategoryRow("category_id = '".$uri."'");
    //     $page_data['page_path'] = 'editcategory';
    //     $page_data['type'] = $this->session->userdata('type');
    //     $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");  
    //     $this->load->view('template',$page_data);
    // }

    // public function add_category()
    // {
    //     $error_type = '';
    //     $msg = '';
       
    //     $result = false;

    //     $type=  $this->session->userdata('type');



    //     if ($type==1){

    //         $branch_id=$this->input->post('branch_id');
    //     }



    //     elseif ($type==2) {
    //         $branch_id= $this->session->userdata('branch_id');
    //     }
        

    //     $category = $this->input->post('category');
    //     $sub_category = $this->input->post('sub_category');
       

    //     $data = array(
    //         'branch_id'        => $branch_id,
    //         'category'         => $category,
    //         'sub_category'     => $sub_category
            
    //     );
    //     $enquiryId  =$this->Category_model->insert($data);
    //     if($enquiryId > 0)
    //     {
    //         $result = true;
    //         $msg = "Given details successfully inserted";
    //     }

    //     echo json_encode(array('rs' => $result, 'msg' => $msg));
        

       
    // }

    // public function getdetails() 
    // {
    //     $category_id = $this->input->post('category_id');
    //     $getdata =   $this->Category_model->getCategoryRow("category_id = '".$category_id."'");
        
    //     $data = array(
    //         "category"      => ucfirst($getdata['category']),
    //         "sub_category"  => ucwords($getdata['sub_category'])
    //     );

    //     echo json_encode($data);
    // }
}