<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();
 	
 		$this->load->model('login_model');
 		 
 	}

 	public function index()
	{

		$page_data['page_title'] = 'Login';
		$this->load->view('login',$page_data);
		
	}

	public function login_data()
	{
		$result = false;
		$error_type = '';
        $msg = '';

        $this->form_validation->set_rules('username','Username','trim|required|min_length[5]');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[5]');

        if($this->form_validation->run() == false)
        {
        	$error_type = 'error';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        }
      	else
        {
        	$username = $this->input->post('username');
	        $password = $this->input->post('password');

	        $condition = "username = '".$username."' and password = '".$password."'";
	        $getmasterdata = $this->login_model->masterlogin($condition);
	      
	        if(!empty($getmasterdata))
	        {
	        	$sessionArray = array(
                    'type'          => '1',
                    'branch_id'  	=> '1',
                    'username'      => $getmasterdata->username,
                    'email'		    => $getmasterdata->email
                );

                $this->session->set_userdata($sessionArray);
	        	$result = true;
	        	$msg = "Successfully Loggedin";
	        }
	        else
	        {
	        	$condition = "username = '".$username."' and password = '".$password."'";
	        	$getadmindata = $this->login_model->adminlogin($condition);

	        	if(!empty($getadmindata))
		        {
		        	$sessionArray = array(
	                    'type' => '2',
	                    'branch_id'	=> $getadmindata->branch_id,
	                    'branch_name'	=> $getadmindata->branch_name,
	                    'username' => $getadmindata->username,
	                    'email'		=> $getadmindata->email_id
	                );

	                $this->session->set_userdata($sessionArray);

		        	$result = true;
		        	$msg = "Successfully Loggedin";
		        }
		        else
		        {
		        	$result = false;
	        		$msg = "Invalid Login Details";
		        }
	        	
	        }
        }

        echo json_encode(array('result' => $result, 'errType' => $error_type, 'msg' => $msg));
	        
	}

	public function logout() {

		$this->session->sess_destroy();
		redirect('login');
	}

	public function forgot()
	{

		$page_data['page_title'] = 'Forgot Password';
		$this->load->view('forgot',$page_data);
		
	}

	public function forgot_data() { 

		$result = false;
		$error_type = '';
        $msg = '';
		
		$email = $this->input->post('email');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_check_mail');

		if($this->form_validation->run() == false)
		{
			$error_type = 'error';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
		}
		else
		{
			//Load email library 
			$this->load->library('email'); 

			$this->email->from('admin@gmail.com', 'Admin');
			$this->email->to('testuser@gmail.com');
			 
			$this->email->subject('Forgot Password');
			$message = 'Your Login Credentials.. Username : admin, Password : admin123';
			$this->email->message($message);

			//Send mail 
			if($this->email->send()) 
			{
				$result = true;
	        	$msg = "Successfully Loggedin"; 
			}
			else 
			{
				$result = false;
	        	$msg = "Successfully Loggedin";
			}
		}
 
 
        echo json_encode(array('result' => $result, 'errType' => $error_type, 'msg' => $msg));

  	}

  	public function check_mail($str){

    	if($str){
    		$condition = "email = '".$str."'";
    		$getmail1 = $this->login_model->masterlogin($condition);
    		if(!empty($getmail1))
    		{
    			return true;
    		}
    		else
    		{
    			$condition = "email_id = '".$str."'";
    			$getmail2 = $this->login_model->adminlogin($condition);
    			if(empty($getmail2))
	    		{
	    			$this->form_validation->set_message('check_mail', 'Invalid Email!');
	    			return false;
	    		}
	    		else
	    		{
	    			return true;
	    		}
    		}
      		
		}
    	else{
      		$this->form_validation->set_message('check_mail', 'Please enter Email!');
      		return false;
    	}
	} 

}


