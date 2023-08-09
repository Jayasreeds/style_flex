<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();
 		
        if(empty($this->session->userdata('username')))
        {
            redirect('login');
        }
        if($this->session->userdata('type')=='2')
        {
            redirect('login');
        }
        else
        {
            $this->load->model('branch/Branch_model');
            $this->load->model('Location_model');
        }    
 		 
 	}

 	public function index()
	{

		$page_data['page_title'] = 'Manage Branch';
		$page_data['page_title1'] = 'Branch Details';
        $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3' AND branch_id != '1' order by branch_id DESC");
		$page_data['page_path'] = 'branch/manage_branch';		
		$this->load->view('template',$page_data);
		
	}

	public function addbranch()
	{
        $state_list =   $this->Location_model->getState()->result_array();
        $city_list =   $this->Location_model->getCity()->result_array();
		$page_data['page_title'] = 'Add Branch';
		$page_data['page_title1'] = 'Add Admin Details';
		$page_data['page_title2'] = 'Add Branch Details';
		$page_data['page_path'] = 'branch/addbranch';		
		$page_data['state_list'] = $state_list;		
		$page_data['city_list'] = $city_list;		
		$this->load->view('template',$page_data);
		
	}

	public function editbranch($id)
	{

		$page_data['page_title'] = 'Edit Branch';
		$page_data['page_title1'] = 'Edit Admin Details';
		$page_data['page_title2'] = 'Edit Branch Details';
		$page_data['page_path'] = 'branch/editbranch';	
        $page_data['editbranchdata'] = $this->Branch_model->getBranchRow("branch_id = '".$id."'");
        $state_list =   $this->Location_model->getState()->result_array();
        $city_list =   $this->Location_model->getCity()->result_array();
        $page_data['state_list'] = $state_list;     
        $page_data['city_list'] = $city_list;   
		$this->load->view('template',$page_data);
		
	}

    public function getdetails() 
    {
        $branch_id = $this->input->post('branch_id');
        $getdata =   $this->Branch_model->getBranchRow("branch_id = '".$branch_id."'");
        
        $data = array(
            "branch_name"       => strtoupper($getdata['branch_name']),
            "first_name"        => ucfirst($getdata['first_name']),
            "last_name"         => ucfirst($getdata['last_name']),
            "username"          => $getdata['username'],
            "email_id"          => $getdata['email_id'],
            "mobile_number"     => $getdata['mobile_number'],
            "branch_address"    => ucwords($getdata['branch_address']),
            "status"            => ($getdata['status'] == '1') ? 'Active' : 'Inactive',
            "created_on"        => $getdata['created_on'] 
        );

        echo json_encode($data);
    }



	public function add_branch() {

        $error_type = '';
        $msg = '';
        $branchId = 0;
        $result = false;
      



        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('mobile_number', 'Mobilbe number', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('username', 'User Anme', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('branch_code', 'Branch code', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('state_id', 'State Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('city_id', 'City Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('branch_address', 'Branch Address', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('branch_mobile_number', 'Mobile number for branch', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('status', ' Status', 'required|max_length[1]|trim');

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {


            $logo_image_url = '';
            if ($_FILES['validatedCustomFile']['name']) {
                $path = './assets/images/branch';
                if (!is_dir($path)) {
                    mkdir($path, 0655, true);
                }
                $tempname = $_FILES['validatedCustomFile']['name'];
                $temfname = explode(".", $tempname);
                $ext = end($temfname);
                $filename = time();
                $filename = strtolower($filename . "." . $ext);
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'docx|gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
                $config['max_size'] = "*";
                $config['max_width'] = "*";
                $config['max_height'] = "*";
                $config['file_name'] = $filename;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('validatedCustomFile')) {
                    $error_type = 'v';
                    $msg = $this->upload->display_errors(); //upload errors();
                    $result = false;
                } else {
                    $image1 = $this->upload->data();
                    $logo_image_url = $image1['file_name'];
                }
            }


            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $mobile_number = $this->input->post('mobile_number');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $branch_name = $this->input->post('branch_name');
            $branch_code = $this->input->post('branch_code');
            $state_id = $this->input->post('state_id');
            $city_id = $this->input->post('city_id');
            $branch_address = $this->input->post('branch_address');
            $pincode = $this->input->post('pincode');
            $status = $this->input->post('status');
            $landline_number = $this->input->post('landline_number');
            $branch_mobile_number = $this->input->post('branch_mobile_number');
            $email_id = $this->input->post('email_id');
            $reg_no = $this->input->post('reg_no');
            $gst_no = $this->input->post('gst_no');
            $pan_no = $this->input->post('pan_no');
            $created_by =$this->session->userdata('user_id');

           

            $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'mobile_number' => $mobile_number,
                'username' => $username,
                'password' => $password,
                'branch_name' => $branch_name,
                'branch_code' => $branch_code,
                'state_id' => $state_id,
                'city_id' => $city_id,
                'branch_address' => $branch_address,
                'pincode' => $pincode,
                'landline_number' => $landline_number,
                'branch_mobile_number' => $branch_mobile_number,
                'email_id' => $email_id,
                'status' => $status,
                'created_by' => $created_by,
                'doct_img' => $logo_image_url,
                'reg_no' => $reg_no,
                'gst_no' => $gst_no,
                'pan_no' => $pan_no,
                'created_on' => date('Y-m-d H:i:s'),
            );


            $branchId = $this->Branch_model->insert($data);
            
                $result = true;
            }
                       $result = ($branchId > 0) ? true : false;
    ($result) ? $this->session->set_flashdata('success','Branch successfully added'):$this->session->set_flashdata('error','Something went wrong');  
                       


        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
    }

    public function edit_branch() {

        $error_type = '';
        $msg = '';
        $branchId = 0;
        $result = false;


        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('mobile_number', 'Mobilbe number', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('username', 'User Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('branch_code', 'Branch code', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('state_id', 'State Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('city_id', 'City Name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('branch_address', 'Branch Address', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('branch_mobile_number', 'Mobile number for branch', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('status', ' Status', 'required|max_length[1]|trim');

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {


            $logo_image_url = '';
            if ($_FILES['validatedCustomFile']['name']) {
                $path = './assets/images/branch';
                if (!is_dir($path)) {
                    mkdir($path, 0655, true);
                }
                $tempname = $_FILES['validatedCustomFile']['name'];
                $temfname = explode(".", $tempname);
                $ext = end($temfname);
                $filename = time();
                $filename = strtolower($filename . "." . $ext);
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'docx|gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
                $config['max_size'] = "*";
                $config['max_width'] = "*";
                $config['max_height'] = "*";
                $config['file_name'] = $filename;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('validatedCustomFile')) {
                    $error_type = 'v';
                    $msg = $this->upload->display_errors(); //upload errors();
                    $result = false;
                } else {
                    $image1 = $this->upload->data();
                    $logo_image_url = $image1['file_name'];
                }
            }


            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $mobile_number = $this->input->post('mobile_number');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $branch_name = $this->input->post('branch_name');
            $branch_code = $this->input->post('branch_code');
            $state_id = $this->input->post('state_id');
            $city_id = $this->input->post('city_id');
            $branch_address = $this->input->post('branch_address');
            $pincode = $this->input->post('pincode');
            $status = $this->input->post('status');
            $landline_number = $this->input->post('landline_number');
            $branch_mobile_number = $this->input->post('branch_mobile_number');
            $email_id = $this->input->post('email_id');
            $reg_no = $this->input->post('reg_no');
            $gst_no = $this->input->post('gst_no');
            $pan_no = $this->input->post('pan_no');
            $created_by =$this->session->userdata('user_id');

            $image_url = ($logo_image_url == '') ? $this->input->post('doct_img') : $logo_image_url;  

            $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'mobile_number' => $mobile_number,
                'username' => $username,
                'password' => $password,
                'branch_name' => $branch_name,
                'branch_code' => $branch_code,
                'state_id' => $state_id,
                'city_id' => $city_id,
                'branch_address' => $branch_address,
                'pincode' => $pincode,
                'landline_number' => $landline_number,
                'branch_mobile_number' => $branch_mobile_number,
                'email_id' => $email_id,
                'status' => $status,
                'created_by' => $created_by,
                'doct_img' => $image_url,
                'reg_no' => $reg_no,
                'gst_no' => $gst_no,
                'pan_no' => $pan_no,
                'created_on' => date('Y-m-d H:i:s')
            );

            $update = $this->Branch_model->update($this->input->post('branch_id'),$data);
             
        }
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Branch details successfully updated'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
    }

    public function checkUserNameAlredyExist()
    {

            $username = $this->input->post('username');
            $branch_id = $this->input->post('branch_id');
            $result = $this->Branch_model->checkUserNameAlredyExist($username,$branch_id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }
    public function checkBranchCodeAlredyExist()
    {

            $branch_code = $this->input->post('branch_code');
            $branch_id = $this->input->post('branch_id');
            $result = $this->Branch_model->checkBranchCodeAlredyExist($branch_code,$branch_id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }
      public function checknumberAlredyExist()
    {

            $mobile_number = $this->input->post('mobile_number');
            $branch_id = $this->input->post('branch_id');
            $result = $this->Branch_model->checknumberAlredyExist($mobile_number,$branch_id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }

    public function deletebranch()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $branch_id = $this->input->post('branch_id');
        
        $data = array(
            'status'  => '3'
        );

        $update = $this->Branch_model->update($this->input->post('branch_id'),$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Branch deleted successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    public function changestatus()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $branch_id = $this->input->post('branch_id');
        $getdata = $this->Branch_model->getBranchRow("branch_id = '".$branch_id."'");
        
        if($getdata['status'] == '1')
            $status = '2';
        else
            $status = '1';

        $data = array(
            'status'  => $status
        );

        $update = $this->Branch_model->update($this->input->post('branch_id'),$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Branch status updated successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }
}


