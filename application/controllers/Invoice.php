<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
 	
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
            $this->load->model('Quality_model');
            $this->load->model('Size_model');
            $this->load->model('Invoice_model');
            $this->load->model('Settings_model');

        } 
 		 
 	}

 	public function index()
	{

		$page_data['page_title'] = 'Manage Invoice';
		$page_data['page_title1'] = 'Manage Invoice Details';
		$page_data['page_path'] = 'manage_invoice';	
		$page_data['paymentalldata'] = $this->Invoice_model->getBillbaseResultsOrder("status='1'");	
		$page_data['invoicepaiddata'] = $this->Invoice_model->getBillbaseResultsOrder("paid_status='1' AND status='1'");		
		$page_data['paymentpendingdata'] = $this->Invoice_model->getBillbaseResultsOrder("paid_status='2' AND status='1'");		
		$page_data['paymentpartiallydata'] = $this->Invoice_model->getBillbaseResultsOrder("paid_status='3' AND status='1'");		
		$this->load->view('template',$page_data);
		
	}

	 
}


