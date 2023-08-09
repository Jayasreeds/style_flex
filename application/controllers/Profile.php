<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
 	
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
            $this->load->model('Profile_model');
        }
 		
 		 
 	}

 	public function index()
	{

		$page_data['page_title'] = 'Profile';
		$page_data['page_title1'] = 'Update Profile';
		$page_data['page_path'] = 'updateprofile';	
		$page_data['profiledata'] = $this->Profile_model->getEdit('1');
		$this->load->view('template',$page_data);
		
	}

	public function viewprofile()
	{
		$page_data['page_title'] = 'View Master Profile';
		$page_data['page_title1'] = 'View Profile Details';
		$page_data['profiledata'] = $this->Profile_model->getEdit('1');
		$page_data['page_path'] = 'viewprofile';		
		$this->load->view('template',$page_data);
	}

	public function changepass()
	{

		$page_data['page_title'] = 'Change Password';
		$page_data['page_title1'] = 'Change Password';
		$page_data['page_path'] = 'changepass';		
		$this->load->view('template',$page_data);
		
	}

	public function updateprofile()
	{
		$error_type = '';
        $msg = '';
        $result = false;

        $this->form_validation->set_rules('username', 'Username', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|max_length[10]|max_length[10]|trim');
 

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {


            $logo_image_url = '';
            if ($_FILES['logofile']['name']) {
                $path = './uploads/logo/';
                if (!is_dir($path)) {
                    mkdir($path, 0655, true);
                }
                $tempname = $_FILES['logofile']['name'];
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
                if (!$this->upload->do_upload('logofile')) {
                    $error_type = 'v';
                    $msg = $this->upload->display_errors(); //upload errors();
                    $result = false;
                } else {
                    $image1 = $this->upload->data();
                    $logo_image_url = $image1['file_name'];
                }
            }

            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
 
            $image_url = ($logo_image_url == '') ? $this->input->post('imagefile') : $logo_image_url;  
          
            $data = array(
                'username' 	=> $username,
                'email'		=> $email,
                'mobile' 	=> $mobile,
                'logo' 		=> $image_url
            );

            $update = $this->Profile_model->update('1',$data);
             
        }
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Profile details successfully updated'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
	}

	public function checkOldPassword()
    {

        $cpass = $this->input->post('cpass');
        $result = $this->Profile_model->checkOldPassword($cpass,'1');
        $result = (empty($result)) ? false: true;
        
        echo(json_encode($result)); 

    }

    public function updatepassword()
    {
    	$error_type = '';
        $msg = '';
        $result = false;

        $this->form_validation->set_rules('cpass', 'Current Password', 'required|min_length[5]|trim');
        $this->form_validation->set_rules('npass', 'New Password', 'required|min_length[5]|trim');
        $this->form_validation->set_rules('rpass', 'Retype New Password', 'required|min_length[5]|trim');

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

            $npass = $this->input->post('npass');

            $data = array(
                'password' 	=> $npass
            );

            $update = $this->Profile_model->update('1',$data);
             
        }
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Password successfully Changed!'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
    }
 
}


