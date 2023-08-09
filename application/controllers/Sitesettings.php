<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitesettings extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();
        if(empty($this->session->userdata('username')) || $this->session->userdata('type') != '1') 
        {
            redirect('login');
        } 
        else
        {
	       $this->load->model('Settings_model');
        }
 		 
 	}

 	public function index()
	{

		$page_data['page_title'] = 'Site Settings';
		$page_data['page_title1'] = 'Site Settings Details';
		$page_data['page_path'] = 'viewsettings';
		$page_data['editsettingdata'] = $this->Settings_model->getSettingRow('1');		
		$this->load->view('template',$page_data);
		
	}

	public function updatesetting()
	{
		$error_type = '';
        $msg = '';
        $result = false;

        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        
 

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

            $logo_image_url = '';
            if ($_FILES['logo']['name']) {
                $path = './uploads/logo/';
                if (!is_dir($path)) {
                    mkdir($path, 0655, true);
                }
                $tempname = $_FILES['logo']['name'];
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
                if (!$this->upload->do_upload('logo')) {
                    $error_type = 'v';
                    $msg = $this->upload->display_errors(); //upload errors();
                    $result = false;
                } else {
                    $image1 = $this->upload->data();
                    $logo_image_url = $image1['file_name'];
                }
            }

            $icon_image_url = '';
            if ($_FILES['icon']['name']) {
                $path = './uploads/logo/';
                if (!is_dir($path)) {
                    mkdir($path, 0655, true);
                }
                $tempname = $_FILES['icon']['name'];
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
                if (!$this->upload->do_upload('icon')) {
                    $error_type = 'v';
                    $msg = $this->upload->display_errors(); //upload errors();
                    $result = false;
                } else {
                    $image1 = $this->upload->data();
                    $icon_image_url = $image1['file_name'];
                }
            }

            $title = $this->input->post('title');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $address = $this->input->post('address');
            $copyright = $this->input->post('copyright');
            $mail_username = $this->input->post('mail_username');
            $mail_pass = $this->input->post('mail_pass');
            $mail_port = $this->input->post('mail_port');
 
            $image_url = ($logo_image_url == '') ? $this->input->post('logofile') : $logo_image_url;  
            $icon_url = ($icon_image_url == '') ? $this->input->post('iconfile') : $icon_image_url; 
          
            $data = array(
                'title' 	=> $title,
                'email'		=> $email,
                'mobile' 	=> $mobile,
                'address' 	=> $address,
                'logo'      => $image_url,
                'icon'      => $icon_url,
                'copyright' => $copyright,
                'mail_username' => $mail_username,
                'mail_pass' => $mail_pass,
                'mail_port' => $mail_port
            );

            $update = $this->Settings_model->update('1',$data);
             
        }
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Site details successfully updated'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
	}

	 
 
}


