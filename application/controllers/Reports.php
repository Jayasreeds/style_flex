<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();
 		if(empty($this->session->userdata('username'))) 
 		{
 			redirect('login');
 		} 
 		 else
        {
            $this->load->model('Reports_model');
            $this->load->model('Customer_model');
            // $this->load->model('Location_model');
            $this->load->model('branch/Branch_model');
        }    
 	}

 	public function index()
	{
		$page_data['type'] = $this->session->userdata('type');
		$page_data['page_title'] = 'Customer Reports';
		$page_data['page_title1'] = 'Customer Reports';
		$page_data['page_path'] = 'manage_reports';
		$condition = "";
		if($page_data['type'] =='1')
		{	
			
			$page_data['branch'] = $this->Reports_model->getbranchResults("status = '1'");
			if($this->input->post())
			{
				$from_date = $this->input->post('from_date');
				$to_date = $this->input->post('to_date');
				$branch_id = $this->input->post('branch_id');
				$fromnewDate = date("Y-m-d", strtotime($from_date));  
				$tonewDate = date("Y-m-d", strtotime($to_date));

				
				if(!empty($from_date) && !empty($to_date))
				{
					$condition.= " last_updated BETWEEN '".$fromnewDate."' AND '".$tonewDate."' AND";
				}
				if($branch_id != 'all')
				{
					$condition.= " branch_id = '".$branch_id."' AND";
				}
				$condition = rtrim($condition,'AND');
				$page_data['cusloc'] = $this->Reports_model->getSearchResults($condition);
				
			}
			else
			{
				$page_data['cusloc'] = $this->Reports_model->getSearchResults($condition);
			}

		}
		else
		{
			if($this->input->post())
			{
				$from_date = $this->input->post('from_date');
				$to_date = $this->input->post('to_date');
				$branch_id = $this->session->userdata('branch_id');
				$fromnewDate = date("Y-m-d", strtotime($from_date));  
				$tonewDate = date("Y-m-d", strtotime($to_date));

				
				if(!empty($from_date) && !empty($to_date))
				{
					$condition.= " last_updated BETWEEN '".$fromnewDate."' AND '".$tonewDate."' AND";
				}
				if($branch_id != 'all')
				{
					$condition.= " branch_id = '".$branch_id."' AND";
				}
				
				$condition = rtrim($condition,'AND');
			 
				$page_data['cusloc'] = $this->Reports_model->getSearchResults($condition);
				
			}
			else
			{
				$condition = "branch_id = '".$this->session->userdata('branch_id')."'";
				$page_data['cusloc'] = $this->Reports_model->getSearchResults($condition);
			}
		}
		
			
	    
		$this->load->view('template',$page_data);
		
	}


	public function invoice()
	{

		$type = $this->session->userdata('type');
		$page_data['page_title'] = 'Billing Reports';
		$page_data['page_title1'] = 'Billing Reports';
		$page_data['page_path'] = 'invoice_reports';
		$condition = '';
		if($type =='1')
		{
			$page_data['branch'] = $this->Reports_model->getbranchResults("status = '1'");
			$page_data['cusdata'] = $this->Customer_model->getCustomerResults("status = '1'");	
			if($this->input->post())
			{
				$from_date = $this->input->post('from_date');
				$to_date = $this->input->post('to_date');
				$branch_id = $this->input->post('branch_id');
				$cus_id = $this->input->post('cus_id');
				$mobile = $this->input->post('mobile');
				$cus_name = $this->input->post('cus_name');
				$paid_status = $this->input->post('paid_status');
				$gst_type = $this->input->post('gst_type');
				$fromnewDate = date("Y-m-d", strtotime($from_date));  
				$tonewDate = date("Y-m-d", strtotime($to_date));

				if($gst_type == '1')
				{
					$gstval = " gst_type IN ('1','2') AND";
				}
				else
				{
					$gstval = " gst_type = '3' AND";
				}

				if(!empty($from_date) && !empty($to_date))
				{
					$condition.= " created_on BETWEEN '".$fromnewDate."' AND '".$tonewDate."' AND";
				}
				else
				{
					if(!empty($from_date)){
						$condition.= " created_on = '".$fromnewDate."' AND";
					}
					if(!empty($to_date)){
						$condition.= " created_on = '".$tonewDate."' AND";
					}
			    }
				if($branch_id != 'all')
				{
					$condition.= " branch_id = '".$branch_id."' AND";
				}
				if($cus_id != 'all' || $cus_name != 'all' || $mobile != 'all')
				{
					$condition.= " cus_id = '".$cus_id."' OR cus_id = '".$cus_name."' OR cus_id = '".$mobile."' AND";
				}
				if($paid_status != 'all')
				{
					$condition.= " paid_status = '".$paid_status."' AND";
				}
				if($gst_type != 'all')
				{
					$condition.= $gstval;
				}

				$condition = rtrim($condition,'AND');
			 

			}
			$page_data['billingdata'] = $this->Reports_model->getSearchInvoiceResults($condition);
		}
		else
		{
			$page_data['cusdata'] = $this->Customer_model->getCustomerResults("status = '1' AND branch_id = '".$this->session->userdata('branch_id')."'");	
			if($this->input->post())
			{
				$from_date = $this->input->post('from_date');
				$to_date = $this->input->post('to_date');
				$branch_id = $this->session->userdata('branch_id');
				$cus_id = $this->input->post('cus_id');
				$mobile = $this->input->post('mobile');
				$cus_name = $this->input->post('cus_name');
				$paid_status = $this->input->post('paid_status');
				$gst_type = $this->input->post('gst_type');
				$fromnewDate = date("Y-m-d", strtotime($from_date));  
				$tonewDate = date("Y-m-d", strtotime($to_date));
				if($gst_type == '1')
				{
					$gstval = " gst_type IN ('1','2') AND";
				}
				else
				{
					$gstval = " gst_type = '3' AND";
				}

				if(!empty($from_date) && !empty($to_date))
				{
					$condition.= " created_on BETWEEN '".$fromnewDate."' AND '".$tonewDate."' AND";
				}
				else
				{
					if(!empty($from_date)){
						$condition.= " created_on = '".$fromnewDate."' AND";
					}
					if(!empty($to_date)){
						$condition.= " created_on = '".$tonewDate."' AND";
					}
			    }
				if($branch_id != 'all')
				{
					$condition.= " branch_id = '".$branch_id."' AND";
				}
				if($cus_id != 'all' || $cus_name != 'all' || $mobile != 'all')
				{
					$condition.= " cus_id = '".$cus_id."' OR cus_id = '".$cus_name."' OR cus_id = '".$mobile."' AND";
				}
				if($paid_status != 'all')
				{
					$condition.= " paid_status = '".$paid_status."' AND";
				}
				if($gst_type != 'all')
				{
					$condition.= $gstval;
				}

				$condition = rtrim($condition,'AND');
			 
			}
			else
			{
				$condition = "branch_id = '".$this->session->userdata('branch_id')."'";
			}
			$page_data['billingdata'] = $this->Reports_model->getSearchInvoiceResults($condition);

		}
		 
		$this->load->view('template',$page_data);
		
	}
		
	

	public function quotation()
	{

		$type = $this->session->userdata('type');
		$page_data['page_title'] = 'Quotation Reports';
		$page_data['page_title1'] = 'Quotation Reports';
		$page_data['page_path'] = 'quotation_reports';
		$condition = '';
		if($type =='1')
		{
			$page_data['branch'] = $this->Reports_model->getbranchResults("status = '1'");
			$page_data['cusdata'] = $this->Customer_model->getCustomerResults("status = '1'");	
			if($this->input->post())
			{
				$from_date = $this->input->post('from_date');
				$to_date = $this->input->post('to_date');
				$branch_id = $this->input->post('branch_id');
				$cus_id = $this->input->post('cus_id');
				$fromnewDate = date("Y-m-d", strtotime($from_date));  
				$tonewDate = date("Y-m-d", strtotime($to_date));
		
				if(!empty($from_date) && !empty($to_date))
				{
					$condition.= " created_on BETWEEN '".$fromnewDate."' AND '".$tonewDate."' AND";
				}
				if(!empty($from_date) || !empty($to_date))
				{
					if(!empty($from_date)){
					$condition.= " created_on = '".$fromnewDate."' AND";
				}
						if(!empty($to_date)){
					$condition.= " created_on = '".$tonewDate."' AND";
				}
			    }
				if($branch_id != 'all')
				{
					$condition.= " branch_id = '".$branch_id."' AND";
				}
				if($cus_id != 'all')
				{
					$condition.= " cus_id = '".$cus_id."' AND";
				}
		  
				$condition = rtrim($condition,'AND');
			 

			}
			$page_data['billingdata'] = $this->Reports_model->getSearchQuotationResults($condition);
		}
		else
		{
			$page_data['cusdata'] = $this->Customer_model->getCustomerResults("status = '1' AND branch_id = '".$this->session->userdata('branch_id')."'");	
			if($this->input->post())
			{
				$from_date = $this->input->post('from_date');
				$to_date = $this->input->post('to_date');
				$branch_id = $this->session->userdata('branch_id');
				$cus_id = $this->input->post('cus_id');
				$fromnewDate = date("Y-m-d", strtotime($from_date));  
				$tonewDate = date("Y-m-d", strtotime($to_date));
			
				if(!empty($from_date) && !empty($to_date))
				{
					$condition.= " created_on BETWEEN '".$fromnewDate."' AND '".$tonewDate."' AND";
				}
				if($branch_id != 'all')
				{
					$condition.= " branch_id = '".$branch_id."' AND";
				}
				if($cus_id != 'all')
				{
					$condition.= " cus_id = '".$cus_id."' AND";
				}
				 

				$condition = rtrim($condition,'AND');
			 
			}
			else
			{
				$condition = "branch_id = '".$this->session->userdata('branch_id')."'";
			}
			$page_data['billingdata'] = $this->Reports_model->getSearchQuotationResults($condition);

		}
		 
		$this->load->view('template',$page_data);

		
	}
	 
}


