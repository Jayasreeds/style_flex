<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();
 		if(empty($this->session->userdata('username'))) 
 		{
 			redirect('login');
 		} 
 		else
        {
            $this->load->model('Dash_model');
            $this->load->model('branch/Branch_model');
            // $this->load->model('Location_model');
            // $this->load->model('branch/Branch_model');
        }    
 	}

 	public function index()
	{
		$type = $this->session->userdata('type');
		$page_data['page_title'] = 'Dashboard';
		$page_data['page_path'] = 'dashboard';
		if($type == '1')	
		{
			$page_data['custotal'] = $this->Dash_model->getCustomerCount($condition = '');	
			$page_data['cusdate'] = $this->Dash_model->getTodayCustomer($condition = '');
			$page_data['billtotal'] = $this->Dash_model->getbillingCount($condition = '');	
			$page_data['billdate'] = $this->Dash_model->getTodaybilling($condition = '');
			$page_data['billtodayamt'] = $this->Dash_model->getTodaybillingamt($condition = '');
			$page_data['billtotalamt'] = $this->Dash_model->getTotalbillingamt($condition = '');
	        $page_data['cusloc'] = $this->Dash_model->getLocCustomer($condition = '');
			$page_data['cus'] = $this->Dash_model->getLocCustomer($condition = '');
			$page_data['recentbillingdata'] = $this->Dash_model->getRecentBillingData($condition = '');
			$page_data['branchdata'] = $this->Branch_model->getBranchResults("status = '1'");	
		}
		else
		{
			$condition = "branch_id = '".$this->session->userdata('branch_id')."'";
			$condition1 = "c.branch_id = '".$this->session->userdata('branch_id')."'";
			$page_data['custotal'] = $this->Dash_model->getCustomerCount($condition);	
			$page_data['cusdate'] = $this->Dash_model->getTodayCustomer($condition);
			$page_data['billtotal'] = $this->Dash_model->getbillingCount($condition);	
			$page_data['billdate'] = $this->Dash_model->getTodaybilling($condition);
			$page_data['billtodayamt'] = $this->Dash_model->getTodaybillingamt($condition);
			$page_data['billtotalamt'] = $this->Dash_model->getTotalbillingamt($condition);
	        $page_data['cusloc'] = $this->Dash_model->getLocCustomer($condition1);
			$page_data['cus'] = $this->Dash_model->getLocCustomer($condition1);
			$page_data['recentbillingdata'] = $this->Dash_model->getRecentBillingData($condition);
		}
		$page_data['type'] = $type;

		$this->load->view('template',$page_data);
		
	}

	public function getdashboarddetails()
	{
 		
 		$branch_id = $this->input->post('branch_id');
		if($branch_id!='all')
		{
			$condition = "branch_id = '".$branch_id."'";
			$condition1 = "c.branch_id = '".$branch_id."'";
			$custotal = $this->Dash_model->getCustomerCount($condition);	
			$cusdate = $this->Dash_model->getTodayCustomer($condition);
			$billtotal = $this->Dash_model->getbillingCount($condition);	
			$billdate = $this->Dash_model->getTodaybilling($condition);
			$billtodayamt = $this->Dash_model->getTodaybillingamt($condition);
			$billtotalamt = $this->Dash_model->getTotalbillingamt($condition);
			$billtodayamt = $billtodayamt['grand_total'];
			$billtotalamt = $billtotalamt['grand_total'];
	        $page_data['cusloc'] = $this->Dash_model->getLocCustomer($condition1);
			$page_data['cus'] = $this->Dash_model->getLocCustomer($condition1);
			$page_data['recentbillingdata'] = $this->Dash_model->getRecentBillingData($condition);
		}
		else
		{

			$custotal = $this->Dash_model->getCustomerCount($condition = '');	
			$cusdate = $this->Dash_model->getTodayCustomer($condition = '');
			$billtotal = $this->Dash_model->getbillingCount($condition = '');	
			$billdate = $this->Dash_model->getTodaybilling($condition = '');
			$billtodayamt = $this->Dash_model->getTodaybillingamt($condition = '');
			$billtotalamt = $this->Dash_model->getTotalbillingamt($condition = '');
			$billtodayamt = $billtodayamt['grand_total'];
			$billtotalamt = $billtotalamt['grand_total'];
	        $page_data['cusloc'] = $this->Dash_model->getLocCustomer($condition1 = '');
			$page_data['cus'] = $this->Dash_model->getLocCustomer($condition1 = '');
			$page_data['recentbillingdata'] = $this->Dash_model->getRecentBillingData($condition = '');
		}
			

		$data = array(
            "custotal"      => ($custotal) ? $custotal : '0',
            "cusdate"	    => ($cusdate) ? $cusdate : '0',
            "billtotal"     => ($billtotal) ? $billtotal : '0',
            "billdate"		=> ($billdate) ? $billdate : '0',
            "billtodayamt"	=> ($billtodayamt) ? 'Rs. '.$billtodayamt : 'Rs. 0.00',
            "billtotalamt"	=> ($billtotalamt) ? 'Rs. '.$billtotalamt : 'Rs. 0.00'
        );

        echo json_encode($data);
		
	}
}


