<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation extends CI_Controller {
 	
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
            $this->load->model('Quotation_model');
            $this->load->model('Settings_model');

        } 
 	}

 	public function index()
	{
		$page_data['type'] = $this->session->userdata('type');
		$page_data['page_title'] = 'Quotation';
		$page_data['page_title1'] = 'Manage Quotation';
		$page_data['page_path'] = 'manage_quotation';	
		if($page_data['type'] == '1')
		 	$condition = "status = '1'";
		 else
		 	$condition = "status = '1' AND branch_id = '".$this->session->userdata('branch_id')."'";
		$page_data['quotationdata'] = $this->Quotation_model->getQuotebaseResultsOrder("status='1'");	
		$this->load->view('template',$page_data);
		
	}

	public function addquotation()
	{
		$page_data['type'] = $this->session->userdata('type');
		// $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		// $page_data['quoteno'] = $this->Quotation_model->generate_string($permitted_chars, 10);
		$cuslastdata = $this->Quotation_model->getQuotebaseLastRow(''); 	
		$autoid = $cuslastdata['id']+1;
		$len = strlen($autoid);
		if($len == '1')
			$quoteno = 'STYFLXINV0000';
		if($len == '2')
			$quoteno = 'STYFLXINV000';
		if($len == '3')
			$quoteno = 'STYFLXINV00';
		if($len == '4')
			$quoteno = 'STYFLXINV0';
		if($len == '5')
			$quoteno = 'STYFLXINV';
		$page_data['quoteno'] = $quoteno.$autoid;
		$state_list =  $this->Location_model->getState()->result_array();
        $city_list =   $this->Location_model->getCity()->result_array();
		$page_data['page_title'] = 'Add Quotation';
		$page_data['page_title1'] = 'Add Customer Details';
		$page_data['page_title2'] = 'Add Quotation Details';
		$page_data['page_path'] = 'addquotation';		
		$page_data['state_list'] = $state_list;		
		$page_data['city_list'] = $city_list;
		$page_data['branchdata'] = $this->Branch_model->getBranchResults("status = '1'");	
		if($page_data['type'] == '1')
		{
			$page_data['customerdata'] = $this->Customer_model->getCustomerResults("status = '1'");	
		}
		else
		{
			$page_data['customerdata'] = $this->Customer_model->getCustomerResults("status = '1' AND branch_id = '".$this->session->userdata('branch_id')."'");	
		}
		$page_data['qualitydata'] = $this->Quality_model->getDistinctQualityResults("status = '1'");
		$page_data['sizedata'] = $this->Size_model->getSizeResults("status = '1'");		
		$this->load->view('template',$page_data);
		
	}

	public function addquotationdetails()
	{
		$error_type = '';
        $msg = '';
        $cusId = 0;
        $baseId = 0;
        $subId = 0;
        $tempId = 0;
        $result = false;
        $data = '';
        $error = '';
        $type = $this->session->userdata('type');
        if($type == '1')
        {
            $branch_id = $this->input->post('branch_id');
        }
        else
        {
            $branch_id = $this->session->userdata('branch_id');
        }

        $branch_id = $this->input->post('branch_id');
        $customers = $this->input->post('customers');
        $cus_id = $this->input->post('cus_id');
        $cus_name = $this->input->post('cus_name');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $state_id = $this->input->post('state_id');
        $city_id = $this->input->post('city_id');
        $zip_code = $this->input->post('zip_code');
        $mobile = $this->input->post('mobile');
       // $status = $this->input->post('status');

        $subtotal = $this->input->post('subtotal');
        $gst = $this->input->post('gst');
        $gstamt = $this->input->post('gstamt');
        $totalgst = $this->input->post('totalgst');
        $gstprepost = $this->input->post('gstprepost');
        $discount = $this->input->post('discount');
        $gtotal = $this->input->post('gtotal');

        $quality_id1 = $this->input->post('quality_id1');
        $size1 = $this->input->post('size1');
        $price1 = $this->input->post('price1');
        $quantity1 = $this->input->post('quantity1');
        $total1 = $this->input->post('total1');

        $quote_no = $this->input->post('quoteid');

        if($this->input->post('temp_save') == '1')
        {
 
        	$quality_id = $this->input->post('quality_id');
	        $size = $this->input->post('size');
	        $price = $this->input->post('price');
	        $quantity = $this->input->post('quantity');
	        $total = $this->input->post('total');

	        if(empty($quality_id) || empty($size) || empty($price) || empty($quantity) || empty($total))
	        {
	        	$error = 'Please fill all the fields';
	        }
	        else
	        {
	        	$condition = "quality_id = '".$quality_id."' AND size_id = '".$size."' AND quote_no = '".$quote_no."'";
	        	$checkexist = $this->Quotation_model->checkExistTempQuote($condition);
	        	if($checkexist)
	        	{
	        		$error = 'Given details already exist.';
	        	}
	        	else
	        	{
		        	$tem_data = array(

		                'quote_no' => $quote_no,
		                'cus_id' => $cus_id,
		                'quality_id' => $quality_id,
		                'size_id' => $size,
		                'price' => $price,
		                'quantity' => $quantity,
		                'total' => $total
		            );

		            $tempId = $this->Quotation_model->insert_temp($tem_data);
		            if($tempId>0)
		            {
		            	
			        	$result = true;
			        	$condition = "quote_no = '".$quote_no."' and cus_id = '".$cus_id."'";
			        	$res = $this->Quotation_model->getTempDataResults($condition);

			        	$getquality = $this->Quality_model->getQualityRow("quality_id = '".$res['quality_id']."'");
			        	$getsize = $this->Size_model->getSizeRow("size_id = '".$res['size_id']."'");
			        	$gettypename = $this->Size_model->getSizeTypeRow("type_id = '".$getsize['type_id']."'");
			        	// foreach ($getres as $res) {
			        		$data= '<tr><td><input type="text" class="form-control quality_id1" name="quality_id1[]" value="'.ucwords($getquality["quality_name"]).'" readonly></td><td><input type="text" class="form-control size1" name="size1[]" value="'.$getsize["size_det"]." ".strtoupper($gettypename['type_name']).'" readonly></td><td><input type="text" class="form-control price1" name="price1[]" value="'.$res["price"].'" readonly></td><td><input type="text" class="form-control quantity1" name="quantity1[]" value="'.$res["quantity"].'" readonly></td><td><input type="text" class="form-control total1" name="total1[]" value="'.$res["total"].'" readonly></td><td><button class="btn btn-danger delete" id="removeRows" type="button">Delete</button></td></tr>';
			        	// }
		            }
		        }
		        
	        }
	        $msg = 'temp_save';
		        
        }
        else
        { 

        	$this->Quotation_model->delete_temp($quote_no,$cus_id);

        	if($customers == 'new')
	        {
	        	$newcusdata = array(
	                'cus_id' => $cus_id,
	                'cus_name' => $cus_name,
	                'email' => $email,
	                'address' => $address,
	                'branch_id' => $branch_id,
	                'state_id' => $state_id,
	                'city_id' => $city_id,
	                'zip_code' => $zip_code,
	                'mobile' => $mobile,
	                'status' => '1'
	            );

	            $cusId = $this->Customer_model->insert($newcusdata);
	            if($cusId)
	            	$result = true;
	        }
	        else
	        {
	        	$oldcusdata = array(

	                'address' => $address,
	                'state_id' => $state_id,
	                'city_id' => $city_id,
	                'zip_code' => $zip_code,
	                'mobile' => $mobile
	            );

	            $update = $this->Customer_model->updatebyCustomerId($cus_id,$oldcusdata);
	            if($update)
	    			$result = true;
	        }

	        
	        $date = date('Y-m-d');

	        $invoice_basedata = array(

	            'quote_no' => $quote_no,
	            'cus_id' => $cus_id,
	            'branch_id' => $branch_id,
	            'subtotal' => $subtotal,
	            'gst_type' => $gst,
	            'gst_val' => $gstamt,
	            'gst_total' => $totalgst,
	            'gst_prepost' => $gstprepost,
	            'discount' => $discount,
	            'grand_total' => $gtotal,
	            'created_on'  => $date
	        );

	        $baseId = $this->Quotation_model->insert_base($invoice_basedata);
	        if($baseId>0)
	        	$result = true;
	        if(!empty($quality_id1))
	        {
	        	for ($i=0; $i < count($quality_id1); $i++) { 

		        	$invoice_subdata = array(

		                'quote_no' => $quote_no,
		                'cus_id' => $cus_id,
		                'quality_id' => $quality_id1[$i],
		                'size_id' => $size1[$i],
		                'price' => $price1[$i],
		                'quantity' => $quantity1[$i],
		                'total' => $total1[$i],
		                'created_on' => $date
		            );

		            $subId = $this->Quotation_model->insert_sub($invoice_subdata);
		            if($subId>0)
		            	$result = true;
		        }
	        }
		        
			($result) ? $this->session->set_flashdata('success','Quotation Details successfully added'):$this->session->set_flashdata('error','Something went wrong');
        }
	          

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg, 'data' => $data, 'error' => $error));
	}

	public function editquotation($id)
	{

		$page_data['page_title'] = 'Edit Quotation';
		$page_data['page_title1'] = 'Edit Customer Details';
		$page_data['page_title2'] = 'Edit Quotation Details';
		$page_data['page_path'] = 'editquotation';
		$state_list =  $this->Location_model->getState()->result_array();
        $city_list =   $this->Location_model->getCity()->result_array();	
		$page_data['state_list'] = $state_list;		
		$page_data['city_list'] = $city_list;
		$page_data['branchdata'] = $this->Branch_model->getBranchResults("status = '1'");	
		$page_data['quotebasedata'] = $this->Quotation_model->getQuotebaseRow("id = '".$id."'");
		$page_data['quotesubdata'] = $this->Quotation_model->getQuotesubResults("quote_no = '".$page_data['quotebasedata']['quote_no']."'");
		$page_data['quotesubdatarow'] = $this->Quotation_model->getQuotesubRow("quote_no = '".$page_data['quotebasedata']['quote_no']."'");
        $page_data['cus_data'] = $this->Customer_model->getCustomerRow("cus_id = '".$page_data['quotesubdatarow']['cus_id']."'"); 	
        $page_data['qualitydata'] = $this->Quality_model->getDistinctQualityResults("status = '1'");
        $page_data['sizedata'] = $this->Size_model->getSizeResults("status = '1'");	
        // $page_data['paymentdata'] = $this->Quotation_model->getBillPaymentResults("invoice_base_id = '".$id."'");
        // $page_data['paymentdatacount'] = $this->Quotation_model->getBillPaymentResultsCount("invoice_base_id = '".$id."'");
		$this->load->view('template',$page_data);
		
	}

 
	public function editquotationdetails()
	{
		$error_type = '';
        $msg = '';
        $cusId = 0;
        $baseId = 0;
        $subId = 0;
        $tempId = 0;
        $result = false;
        $data = '';
        $error = '';
        $type = $this->session->userdata('type');
       // $status = $this->input->post('status');
        $cus_id = $this->input->post('cus_id');
        $subtotal = $this->input->post('subtotal');
        $gst = $this->input->post('gst');
        $gstamt = $this->input->post('gstamt');
        $totalgst = $this->input->post('totalgst');
        $gstprepost = $this->input->post('gstprepost');
        $discount = $this->input->post('discount');
        $gtotal = $this->input->post('gtotal');

        $quality_id1 = $this->input->post('quality_id1');
        $size1 = $this->input->post('size1');
        $price1 = $this->input->post('price1');
        $quantity1 = $this->input->post('quantity1');
        $total1 = $this->input->post('total1');

        $quote_no = $this->input->post('quoteid');

        if($this->input->post('temp_save') == '1')
        {
 
        	$quality_id = $this->input->post('quality_id');
	        $size = $this->input->post('size');
	        $price = $this->input->post('price');
	        $quantity = $this->input->post('quantity');
	        $total = $this->input->post('total');

	        if(empty($quality_id) || empty($size) || empty($price) || empty($quantity) || empty($total))
	        {
	        	$error = 'Please fill all the fields';
	        }
	        else
	        {
	        	$condition = "quality_id = '".$quality_id."' AND size_id = '".$size."' AND quote_no = '".$quote_no."'";
                $checkexist = $this->Quotation_model->checkExistTempQuote($condition);
                if($checkexist)
                {
                    $error = 'Given details already exist.';
                }
                else
                {
		        	$tem_data = array(

		                'quote_no' => $quote_no,
		                'cus_id' => $cus_id,
		                'quality_id' => $quality_id,
		                'size_id' => $size,
		                'price' => $price,
		                'quantity' => $quantity,
		                'total' => $total
		            );

		            $tempId = $this->Quotation_model->insert_temp($tem_data);
		            if($tempId>0)
		            {
		            	
			        	$result = true;
			        	$condition = "quote_no = '".$quote_no."' and cus_id = '".$cus_id."'";
			        	$res = $this->Quotation_model->getTempDataResults($condition);

			        	$getquality = $this->Quality_model->getQualityRow("quality_id = '".$res['quality_id']."'");
			        	$getsize = $this->Size_model->getSizeRow("size_id = '".$res['size_id']."'");
			        	$gettypename = $this->Size_model->getSizeTypeRow("type_id = '".$getsize['type_id']."'");
			        	// foreach ($getres as $res) {
			        		$data= '<tr><td><input type="text" class="form-control quality_id1" name="quality_id1[]" value="'.ucwords($getquality["quality_name"]).'" readonly></td><td><input type="text" class="form-control size1" name="size1[]" value="'.$getsize["size_det"]." ".strtoupper($gettypename['type_name']).'" readonly></td><td><input type="text" class="form-control price1" name="price1[]" value="'.$res["price"].'" readonly></td><td><input type="text" class="form-control quantity1" name="quantity1[]" value="'.$res["quantity"].'" readonly></td><td><input type="text" class="form-control total1" name="total1[]" value="'.$res["total"].'" readonly></td><td><button class="btn btn-danger delete" id="removeRows" type="button">Delete</button></td></tr>';
			        	// }
		            }
		        }
		        
	        }
	        $msg = 'temp_save';
		        
        }
        else
        { 

        	$this->Quotation_model->delete_temp($quote_no,$cus_id);
	        $this->Quotation_model->delete_sub($quote_no,$cus_id);
	        $date = date('Y-m-d');

	        $invoice_basedata = array(

	            'quote_no' => $quote_no,
	            'subtotal' => $subtotal,
	            'gst_type' => $gst,
	            'gst_val' => $gstamt,
	            'gst_total' => $totalgst,
	            'gst_prepost' => $gstprepost,
	            'discount' => $discount,
	            'grand_total' => $gtotal,
	            'created_on'  => $date
	        );

	        $baseId = $this->Quotation_model->update_base($quote_no,$invoice_basedata);
	        if($baseId)
	        	$result = true;
	        if(!empty($quality_id1))
	        {
	        	for ($i=0; $i < count($quality_id1); $i++) { 

		        	$invoice_subdata = array(

		                'quote_no' => $quote_no,
		                'cus_id' => $cus_id,
		                'quality_id' => $quality_id1[$i],
		                'size_id' => $size1[$i],
		                'price' => $price1[$i],
		                'quantity' => $quantity1[$i],
		                'total' => $total1[$i],
		                'created_on' => $date
		            );

		            $subId = $this->Quotation_model->insert_sub($invoice_subdata);
		            if($subId>0)
		            	$result = true;
		        }
	        }
		        
			($result) ? $this->session->set_flashdata('success','Quotation Details successfully updated'):$this->session->set_flashdata('error','Something went wrong');
        }
	          

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg, 'data' => $data, 'error' => $error));
	}

	public function viewquotation($quote_no)
	{

		$page_data['page_title'] = 'View Quotation';
		$page_data['page_title1'] = 'View Quotation Details';
		$page_data['page_title2'] = 'View Quotation Details';
		$page_data['page_path'] = 'viewquotation';	
		$page_data['quotebasedata'] =   $this->Quotation_model->getQuotebaseRow("quote_no = '".$quote_no."'");	
		$page_data['quotesubdata'] = $this->Quotation_model->getQuotesubResults("quote_no = '".$quote_no."'");
		$page_data['quotesubdatarow'] = $this->Quotation_model->getQuotesubRow("quote_no = '".$page_data['quotebasedata']['quote_no']."'");
		$page_data['cus_data'] = $this->Customer_model->getCustomerRow("cus_id = '".$page_data['quotesubdatarow']['cus_id']."'");
		$page_data['branchname'] =   $this->Branch_model->getBranchRow("branch_id = '".$page_data['cus_data']['branch_id']."'");  
		$this->load->view('template',$page_data);
		
	}

	public function sendmailForm($quote_no){

    	$mail = $this->input->post('cus_mail');
    	$cus_data = $this->Customer_model->getCustomerRow("email = '".$mail."'");
    	$file_name = 'Quotation.pdf';
	    $data = array(
	    	'quote_no' =>$quote_no
	    );
	    $src = base_url().'assets/pdf_bg.jpg';
	    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
		$mpdf->showWatermarkText = true;
	    $mpdf->WriteHTML('<watermarktext content="Style Flex" alpha="0.2" />');
	    $mpdf->SetWatermarkImage($src,'0.2','P');
	    $mpdf->showWatermarkImage = true;
	    $mpdf->SetFooter('Quotation');
	    $html=$this->load->view('printquote',$data,true);
	    $mpdf->WriteHTML($html);
	    $mpdf->WriteHTML('');
	    $file = $mpdf->Output();
  		file_put_contents($file_name, $file);
	    $result = true;

    	$msg = $this->EmailContent_model->send_invoice($quote_no);

    	$subject = "STYLE FLEX".$quote_no." - Quotation";
    	$sendmail = $this->SendMail_model->do_email($msg,$subject,$mail,$from = '',$file_name);
 		
    }
 
    public function quotation_delete()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $quote_no = $this->input->post('quote_no');
        
        $data = array(
            'status'  => '2'
        );

        $update = $this->Quotation_model->update_base($quote_no,$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Quotation deleted successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

	 
}


