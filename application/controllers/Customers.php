<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();

 		if(empty($this->session->userdata('username')))
        {
            redirect('login');
        }
        
        else
        {
            $this->load->model('Customer_model');
            $this->load->model('Location_model');
            $this->load->model('branch/Branch_model');
        }    
 	}

 	public function index()
	{
        $page_data['type'] = $this->session->userdata('type');
		$page_data['page_title'] = 'Manage Customers';
		$page_data['page_title1'] = 'Customer Details';
		$page_data['page_path'] = 'manage_customers';	
        if($this->session->userdata('type')=='1')
        {
            $condition = "status != '3' order by id DESC";
        }
        else
        {
            $condition = "branch_id = '".$this->session->userdata('branch_id')."' AND status != '3' order by id DESC";
        }
		$page_data['cusdata'] = $this->Customer_model->getCustomerResults($condition);	
		$this->load->view('template',$page_data);
		
	}

	public function addcustomer()
	{
        $page_data['type'] = $this->session->userdata('type');
        $state_list =   $this->Location_model->getState()->result_array();
        $city_list =   $this->Location_model->getCity()->result_array();
		$page_data['page_title'] = 'Add Customer';
		$page_data['page_title1'] = 'Add Customer Details';
		$page_data['page_path'] = 'addcustomer';	
		$page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");	
		$page_data['state_list'] = $state_list;		
		$page_data['city_list'] = $city_list;		
		$this->load->view('template',$page_data);
		
	}

	public function editcustomer($id)
	{
        $page_data['type'] = $this->session->userdata('type');
		$state_list =   $this->Location_model->getState()->result_array();
        $city_list =   $this->Location_model->getCity()->result_array();
		$page_data['page_title'] = 'Edit Customer';
		$page_data['page_title1'] = 'Edit Customer Details';
		$page_data['page_title2'] = 'Edit Customer Details';
		$page_data['page_path'] = 'editcustomer';	
		$page_data['state_list'] = $state_list;		
		$page_data['city_list'] = $city_list;	
		$page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");
		$page_data['editcustomerdata'] = $this->Customer_model->getCustomerRow("id = '".$id."'");	
		$this->load->view('template',$page_data);
		
	}
	public function checkIdAlredyExist()
    {
            $cus_id = $this->input->post('cus_id');
            $id = $this->input->post('id');
            $result = $this->Customer_model->checkIdmodelAlredyExist($cus_id,$id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }
    public function checknameAlredyExist()
    {
            $cus_name = $this->input->post('cus_name');
            $id = $this->input->post('id');
            $result = $this->Customer_model->checknamemodelAlredyExist($cus_name,$id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }
    public function checkmobileAlredyExist()
    {
            $mobile = $this->input->post('mobile');
            $id = $this->input->post('id');
            $result = $this->Customer_model->checkmobileAlredyExist($mobile,$id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }
    public function add_customer() {

        $error_type = '';
        $msg = '';
        $cusId = 0;
        $result = false;
        $type = $this->session->userdata('type');
        $this->form_validation->set_rules('cus_id', 'Customer Id', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('cus_name', 'Customer Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|max_length[128]|trim');
        //$this->form_validation->set_rules('branch_id', 'Branch Id', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('state_id', 'State', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('city_id', 'City', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('zip', 'State Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('mobile', 'City Name', 'required|max_length[128]|trim');             
       $this->form_validation->set_rules('status', ' Status', 'required|max_length[1]|trim');

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

            $cus_id = $this->input->post('cus_id');
            $cus_name = $this->input->post('cus_name');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            if($type == '1')
            {
                $branch_id = $this->input->post('branch_id');
            }
            else
            {
                $branch_id = $this->session->userdata('branch_id');
            }
            
            $state_id = $this->input->post('state_id');
            $city_id = $this->input->post('city_id');
            $zip = $this->input->post('zip');
            $mobile = $this->input->post('mobile');
            $status = $this->input->post('status');
           
            $data = array(
                'cus_id' => $cus_id,
                'cus_name' => $cus_name,
                'email' => $email,
                'address' => $address,
                'branch_id' => $branch_id,
                'state_id' => $state_id,
                'city_id' => $city_id,
                'zip_code' => $zip,
                'mobile' => $mobile,
                'status' => $status
            );


            $cusId = $this->Customer_model->insert($data);
            
            $result = true;
        }
       	$result = ($cusId > 0) ? true : false;
		($result) ? $this->session->set_flashdata('success','Customer successfully added'):$this->session->set_flashdata('error','Something went wrong');  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
    }

    public function updatecustomer() {

        $error_type = '';
        $msg = '';
        $result = false;
        $type = $this->session->userdata('type');
        $this->form_validation->set_rules('cus_id', 'Customer Id', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('cus_name', 'Customer Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|max_length[128]|trim');
        //$this->form_validation->set_rules('branch_id', 'Branch Id', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('state_id', 'State', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('city_id', 'City', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('zip', 'State Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('mobile', 'City Name', 'required|max_length[128]|trim');             
       $this->form_validation->set_rules('status', ' Status', 'required|max_length[1]|trim');

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

            $cus_id = $this->input->post('cus_id');
            $cus_name = $this->input->post('cus_name');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            if($type == '1')
            {
                $branch_id = $this->input->post('branch_id');
            }
            else
            {
                $branch_id = $this->session->userdata('branch_id');
            }
            $state_id = $this->input->post('state_id');
            $city_id = $this->input->post('city_id');
            $zip = $this->input->post('zip');
            $mobile = $this->input->post('mobile');
            $status = $this->input->post('status');
           
            $data = array(
                'cus_id' => $cus_id,
                'cus_name' => $cus_name,
                'email' => $email,
                'address' => $address,
                'branch_id' => $branch_id,
                'state_id' => $state_id,
                'city_id' => $city_id,
                'zip_code' => $zip,
                'mobile' => $mobile,
                'status' => $status
            );


            $update = $this->Customer_model->update($this->input->post('id'),$data);
            
        }
        if($update)
        	$result = true;
		($result) ? $this->session->set_flashdata('success','Customer Details successfully updated'):$this->session->set_flashdata('error','Something went wrong');  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
    }
    public function deletecustomer()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $customer_id = $this->input->post('customer_id');
        
        $data = array(
            'status'  => '3'
        );

        $update = $this->Customer_model->update($customer_id,$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Customer deleted successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    public function changestatus()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $customer_id = $this->input->post('customer_id');
        $getdata = $this->Customer_model->getCustomerRow("id = '".$customer_id."'");
        
        if($getdata['status'] == '1')
            $status = '2';
        else
            $status = '1';

        $data = array(
            'status'  => $status
        );

        $update = $this->Customer_model->update($customer_id,$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Customer status updated successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    public function getdetails() 
    {
        $id = $this->input->post('id');
        $getdata    =   $this->Customer_model->getCustomerRow("id = '".$id."'");
        $branchname =   $this->Branch_model->getBranchRow("branch_id = '".$getdata['branch_id']."'");  
        $statename  =   $this->Location_model->getStateRow("state_id = '".$getdata['state_id']."'");  
        $cityname   =   $this->Location_model->getCityRow("city_id = '".$getdata['city_id']."'");  

        $data = array(
            "cus_id"            => strtoupper($getdata['cus_id']),
            "cus_name"          => ucwords($getdata['cus_name']),
            "email"             => $getdata['email'],
            "address"           => ucwords($getdata['address']),
            "branch_id"         => strtoupper($branchname['branch_name']),
            "state_id"          => ucwords($statename['state_name']),
            "city_id"           => ucwords($cityname['city_name']),
            "zip_code"          => $getdata['zip_code'],
            "mobile"            => $getdata['mobile'],
            "status"            => ($getdata['status'] == '1') ? 'Active' : 'Inactive',
            "last_updated"      => $getdata['last_updated']
        );

        echo json_encode($data);
    }

    public function getCustomers()
    {
        $branch_id = $this->input->post('branch_id');
        
        echo $this->Customer_model->getBranchCustomerResults("branch_id = '".$branch_id."' and status != '3'");
    }

    public function getCustomerRow()
    {
        $customer_id = $this->input->post('customer_id');
        
        echo $this->Customer_model->getBranchCustomerRow("id = '".$customer_id."'");
    }
}


