<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();

 		if(empty($this->session->userdata('username')))
        {
            redirect('login');
        }
       
        else
        {
           
            $this->load->model('branch/Branch_model');
            $this->load->model('Model_name_model');
            
        } 
 	}

 	public function index()
	{
		$page_data['type'] = $this->session->userdata('type');
		$page_data['page_title'] = 'Billing';
		$page_data['page_title1'] = 'Manage Billing';
		$page_data['page_path'] = 'manage_billing';	
		if($page_data['type'] == '1')
		 	$condition = "status = '1'";
		 else
		 	$condition = "status = '1' AND branch_id = '".$this->session->userdata('branch_id')."'";
		$page_data['billingdata'] = $this->Invoice_model->getBillbaseResultsOrder($condition);	
		$this->load->view('template',$page_data);
		
	}

	public function addbilling()
	{

		$page_data['type'] = $this->session->userdata('type');
		$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$page_data['tempbillno'] = $this->Invoice_model->generate_string($permitted_chars, 10);
		$cuslastdata = $this->Invoice_model->getBillbaseLastRow(''); 	
		$autoid = $cuslastdata['id']+1;
		$len = strlen($autoid);
		if($len == '1')
			$invoiceno = 'STYFLXINV0000';
		if($len == '2')
			$invoiceno = 'STYFLXINV000';
		if($len == '3')
			$invoiceno = 'STYFLXINV00';
		if($len == '4')
			$invoiceno = 'STYFLXINV0';
		if($len == '5')
			$invoiceno = 'STYFLXINV';
		$page_data['billno'] = $invoiceno.$autoid;
		$state_list =  $this->Location_model->getState()->result_array();
        $city_list =   $this->Location_model->getCity()->result_array();
		$page_data['page_title'] = 'Add Billing';
		$page_data['page_title1'] = 'Add Customer Details';
		$page_data['page_title2'] = 'Add Billing Details';
		$page_data['page_path'] = 'addbilling';		
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
		
		//$page_data['billingdata'] = $this->Invoice_model->getTempDataResults("bill_no = 'STYL56898'");	
		$page_data['modeldata'] = $this->Quality_model->getCustomerResults("model_id = '1'");
		$page_data['sizedata'] = $this->Size_model->getSizeResults("status = '1'");		
		$this->load->view('template',$page_data);
		
	}

	public function addbillingdetails()
	{
		$type = $this->session->userdata('type');
		$error_type = '';
        $msg = '';
        $cusId = 0;
        $baseId = 0;
        $subId = 0;
        $tempId = 0;
        $result = false;
        $data = '';
        $error = '';

        if($type == '1')
        {
            $branch_id = $this->input->post('branch_id');
        }
        else
        {
            $branch_id = $this->session->userdata('branch_id');
        }
        $customers = $this->input->post('customers');
        $cus_id = strtolower($this->input->post('cus_id'));
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

     
        $bill_no = $this->input->post('billid');
        $tempbillno = $this->input->post('tempbillno');

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
	        	$condition = "quality_id = '".$quality_id."' AND size_id = '".$size."' AND tempbillno = '".$tempbillno."'";
	        	$checkexist = $this->Invoice_model->checkExistTempBill($condition);
	        	if($checkexist)
	        	{
	        		$error = 'Given details already exist.';
	        	}
	        	else
	        	{
	        		$tem_data = array(
	        			'tempbillno' => $tempbillno,
		                'bill_no' => $bill_no,
		                'cus_id' => $cus_id,
		                'quality_id' => $quality_id,
		                'size_id' => $size,
		                'price' => $price,
		                'quantity' => $quantity,
		                'total' => $total
		            );

		            $tempId = $this->Invoice_model->insert_temp($tem_data);
		            if($tempId>0)
		            {
		            	
			        	$result = true;
			        	$condition = "bill_no = '".$bill_no."' and cus_id = '".$cus_id."'";
			        	$res = $this->Invoice_model->getTempDataResults($condition);

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

        	$this->Invoice_model->delete_temp($bill_no,$cus_id);

	        
	        $date = date('Y-m-d');

	        $invoice_basedata = array(

	            'bill_no' => $bill_no,
	            'cus_id' => $cus_id,
	            'branch_id' => $branch_id,
	            'subtotal' => $subtotal,
	            'gst_type' => $gst,
	            'gst_val' => $gstamt,
	            'gst_total' => $totalgst,
	            'gst_prepost' => $gstprepost,
	            'discount' => $discount,
	            'grand_total' => $gtotal,
	            'balance'  => $gtotal,
	            'created_on'  => $date
	        );

	        $baseId = $this->Invoice_model->insert_base($invoice_basedata);
	        if($baseId>0)
	        	$result = true;
	        if(!empty($quality_id1))
	        {
	        	for ($i=0; $i < count($quality_id1); $i++) { 

		        	$invoice_subdata = array(

		                'bill_no' => $bill_no,
		                'cus_id' => $cus_id,
		                'quality_id' => $quality_id1[$i],
		                'size_id' => $size1[$i],
		                'price' => $price1[$i],
		                'quantity' => $quantity1[$i],
		                'total' => $total1[$i],
		                'created_on' => $date
		            );

		            $subId = $this->Invoice_model->insert_sub($invoice_subdata);
		            if($subId>0)
		            	$result = true;
		        }
	        }
		        
			($result) ? $this->session->set_flashdata('success','Billing Details successfully added'):$this->session->set_flashdata('error','Something went wrong');
        }
	          

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg, 'data' => $data, 'error' => $error));
	}

	public function editbilling($id)
	{

		$page_data['page_title'] = 'Edit Billing';
		$page_data['page_title1'] = 'Edit Customer Details';
		$page_data['page_title2'] = 'Edit Billing Details';
		$page_data['page_path'] = 'editbilling';
		$state_list =  $this->Location_model->getState()->result_array();
        $city_list =   $this->Location_model->getCity()->result_array();	
		$page_data['state_list'] = $state_list;		
		$page_data['city_list'] = $city_list;
		$page_data['branchdata'] = $this->Branch_model->getBranchResults("status = '1'");	
		$page_data['billbasedata'] = $this->Invoice_model->getBillbaseRow("id = '".$id."'");
		$page_data['billsubdata'] = $this->Invoice_model->getBillsubResults("bill_no = '".$page_data['billbasedata']['bill_no']."'");
		$page_data['billsubdatarow'] = $this->Invoice_model->getBillsubRow("bill_no = '".$page_data['billbasedata']['bill_no']."'");
        $page_data['cus_data'] = $this->Customer_model->getCustomerRow("cus_id = '".$page_data['billsubdatarow']['cus_id']."'"); 	
        $page_data['qualitydata'] = $this->Quality_model->getDistinctQualityResults("status = '1'");
        $page_data['sizedata'] = $this->Size_model->getSizeResults("status = '1'");	
        $page_data['paymentdata'] = $this->Invoice_model->getBillPaymentResults("invoice_base_id = '".$id."' AND bill_no = '".$page_data['billbasedata']['bill_no']."'");
        $page_data['paymentdatacount'] = $this->Invoice_model->getBillPaymentResultsCount("invoice_base_id = '".$id."'");
		$this->load->view('template',$page_data);
		
	}

	public function geteditdetails() 
    {
        $bill_no = $this->input->post('bill_no');
        $getdata =   $this->Invoice_model->getBillbaseRow("bill_no = '".$bill_no."'");
        
        $data = array(
            "grand_total1"      => $getdata['grand_total'],
            "paid_amount1"	    => $getdata['paid_amount'],
            "balance1"          => $getdata['balance'],
            "billid1"			=> $getdata['bill_no'],
            "id1"				=> $getdata['id']
        );

        echo json_encode($data);
    }

	public function editbillingdetails()
	{
		$type = $this->session->userdata('type');
		$error_type = '';
        $msg = '';
        $cusId = 0;
        $baseId = 0;
        $subId = 0;
        $tempId = 0;
        $result = false;
        $data = '';
        $error = '';
 
        $cus_id = strtolower($this->input->post('cus_id'));
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

        $bill_no = $this->input->post('billid');

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
	        	$condition = "quality_id = '".$quality_id."' AND size_id = '".$size."' AND bill_no = '".$bill_no."'";
                $checkexist = $this->Invoice_model->checkExistTempBill($condition);
                if($checkexist)
                {
                    $error = 'Given details already exist.';
                }
                else
                {
		        	$tem_data = array(

		                'bill_no' => $bill_no,
		                'cus_id' => $cus_id,
		                'quality_id' => $quality_id,
		                'size_id' => $size,
		                'price' => $price,
		                'quantity' => $quantity,
		                'total' => $total
		            );

		            $tempId = $this->Invoice_model->insert_temp($tem_data);
		            if($tempId>0)
		            {
		            	
			        	$result = true;
			        	$condition = "bill_no = '".$bill_no."' and cus_id = '".$cus_id."'";
			        	$res = $this->Invoice_model->getTempDataResults($condition);

			        	$getquality = $this->Quality_model->getQualityRow("quality_id = '".$res['quality_id']."'");
			        	$getsize = $this->Size_model->getSizeRow("size_id = '".$res['size_id']."'");
			        	$gettypename = $this->Size_model->getSizeTypeRow("type_id = '".$getsize['type_id']."'");
			        	// foreach ($getres as $res) {
			        		$data= '<tr><td><input type="text" class="form-control quality_id1" name="quality_id1[]" value="'.ucwords($getquality["quality_name"]).'" readonly></td><td><input type="text" class="form-control size1" name="size1[]" value="'.$getsize["size_det"]." ".strtoupper($gettypename['type_name']).'" readonly></td><td><input type="text" class="form-control price1" name="price1[]" value="'.$res["price"].'" readonly></td><td><input type="text" class="form-control quantity1" name="quantity1[]" value="'.$res["quantity"].'" ></td><td><input type="text" class="form-control total1" name="total1[]" value="'.$res["total"].'" readonly></td><td><button class="btn btn-danger delete" id="removeRows" type="button">Delete</button></td></tr>';
			        	// }
		            }
		        }
		        
	        }
	        $msg = 'temp_save';
		        
        }
        else
        { 

        	$this->Invoice_model->delete_temp($bill_no,$cus_id);
	        $this->Invoice_model->delete_sub($bill_no,$cus_id);
	        $date = date('Y-m-d');

	        $invoice_basedata = array(

	            'subtotal' => $subtotal,
	            'gst_type' => $gst,
	            'gst_val' => $gstamt,
	            'gst_total' => $totalgst,
	            'gst_prepost' => $gstprepost,
	            'discount' => $discount,
	            'grand_total' => $gtotal,
	            'balance'  => $gtotal,
	            'created_on'  => $date
	        );

	        $baseId = $this->Invoice_model->update_base($bill_no,$invoice_basedata);
	        if($baseId)
	        	$result = true;
	        if(!empty($quality_id1))
	        {
	        	for ($i=0; $i < count($quality_id1); $i++) { 

		        	$invoice_subdata = array(

		                'bill_no' => $bill_no,
		                'cus_id' => $cus_id,
		                'quality_id' => $quality_id1[$i],
		                'size_id' => $size1[$i],
		                'price' => $price1[$i],
		                'quantity' => $quantity1[$i],
		                'total' => $total1[$i],
		                'created_on' => $date
		            );

		            $subId = $this->Invoice_model->insert_sub($invoice_subdata);
		            if($subId>0)
		            	$result = true;
		        }
	        }
		        
			($result) ? $this->session->set_flashdata('success','Billing Details successfully updated'):$this->session->set_flashdata('error','Something went wrong');
        }
	          

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg, 'data' => $data, 'error' => $error));
	}

	public function editpaiddetails()
	{
		$error_type = '';
        $msg = '';
        $result = false;
        $paid_status = 0;
        $paymentId = 0;
        $error = '';
        $grand_total = number_format($this->input->post('grand_total1'),'2');
        $balance1 = number_format($this->input->post('balance1'),'2');
        $paid_amount1 = number_format($this->input->post('paid_amount1'),'2');
 
        $fromnewDate = date("Y-m-d", strtotime($this->input->post('from_date'))); 
        if($this->input->post('paid_amount1') > $this->input->post('grand_total1'))
        {
        	 
        	$error = 'Payable Amount must be lesser than the Bill Amount!';
        }
        else
        {
        	 
        	$data = array(
	            'paid_amount' 		=> $this->input->post('paid_amount1'),
	            'pay_now' 			=> $this->input->post('pay_now1'),
	            'paid_date' 		=> $fromnewDate,
	            'balance' 			=> $this->input->post('balance1')
	        );

	        $update = $this->Invoice_model->update_base($this->input->post('billid1'),$data);  
	    
	       	if($update)
	       	{
	       		$result = true;
	       		if($balance1 == '0')
	       			$paid_status = '1';
	       		else if($balance1 == $grand_total)
	       			$paid_status = '2';
	       		else
	       			$paid_status = '3';
	 
	       		$data1 = array(
	       			'paid_status' => $paid_status
	       		);

	       		$update1 = $this->Invoice_model->update_base($this->input->post('billid1'),$data1);

	       		if($update1)
	       		{
	       			$payment_data = array(
			            'invoice_base_id' 	=> $this->input->post('id1'),
			            'bill_no' 			=> $this->input->post('billid1'),
			            'paid_amount' 		=> $this->input->post('pay_now1'),
			            'paid_date'			=> $fromnewDate
			        );
	       			$paymentId = $this->Invoice_model->insert_payment($payment_data);
	       		}

	       	}

			($result) ? $this->session->set_flashdata('success','Paid Status Updated Successfully!'):$this->session->set_flashdata('error','Something went wrong!');  
        }	        

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg, 'error' => $error));
	}

	public function viewbill($bill_no)
	{

		$page_data['page_title'] = 'View Billing';
		$page_data['page_title1'] = 'View Billing Details';
		$page_data['page_title2'] = 'View Billing Details';
		$page_data['page_path'] = 'viewbill';	
		$page_data['bill_no'] = $bill_no;
		$page_data['billbasedata'] =   $this->Invoice_model->getBillbaseRow("bill_no = '".$bill_no."'");	
		$page_data['billsubdata'] = $this->Invoice_model->getBillsubResults("bill_no = '".$bill_no."'");
		$page_data['billsubdatarow'] = $this->Invoice_model->getBillsubRow("bill_no = '".$page_data['billbasedata']['bill_no']."'");  
		$page_data['cus_data'] = $this->Customer_model->getCustomerRow("cus_id = '".$page_data['billsubdatarow']['cus_id']."'");
		$page_data['branchname'] =   $this->Branch_model->getBranchRow("branch_id = '".$page_data['cus_data']['branch_id']."'");

		$this->load->view('template',$page_data);
		
	}

	public function change_paidstatus()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $bill_no = $this->input->post('bill_no');
       	$getdata =   $this->Invoice_model->getBillbaseRow("bill_no = '".$bill_no."'");
       	$pay_now = $getdata['grand_total'] - $getdata['paid_amount'];

        $data = array(
        	'paid_amount' 		=> $getdata['grand_total'],
            'paid_date' 		=> date('Y-m-d'),
            'pay_now' 			=> $pay_now,
            'balance' 			=> '0.00',
            'paid_status'  		=> '1'
        );

        $update = $this->Invoice_model->update_base($bill_no,$data);

        if($update)
   		{
   			
   			$payment_data = array(
	            'invoice_base_id' 	=> $getdata['id'],
	            'bill_no' 			=> $bill_no,
	            'paid_amount' 		=> $pay_now,
	            'paid_date'			=> date('Y-m-d')
	        );
   			$update1 = $this->Invoice_model->insert_payment($payment_data);
   		}
        
        if($update1)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Paid status updated successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    public function change_invoicestatus()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $bill_no = $this->input->post('bill_no');

        $data = array(
            'invoice_status'  		=> '1',
            'paid_date'				=> date('Y-m-d')
        );

        $update = $this->Invoice_model->update_base($bill_no,$data);
        
        if($update)
        {
            $result = true;
            $billbasedata =   $this->Invoice_model->getBillbaseRow("bill_no = '".$bill_no."'");	
            $cus_data = $this->Customer_model->getCustomerRow("cus_id = '".$billbasedata['cus_id']."'");
           	$msg = $this->EmailContent_model->invoice_convert($cus_data['cus_name'], $bill_no, $billbasedata['grand_total']);

	    	$subject = "STYLE FLEX - Invoice Converted";
	    	$sendmail = $this->SendMail_model->do_email($msg,$subject,$cus_data['email']);
        }
        ($result) ? $this->session->set_flashdata('success','Created Invoice Successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    public function sendmailForm($bill_no){

    	$mail = $this->input->post('cus_mail');
    	$cus_data = $this->Customer_model->getCustomerRow("email = '".$mail."'");
    	$file_name = 'Invoice.pdf';
	    $data = array(
	    	'bill_no' =>$bill_no
	    );
	    $src = base_url().'assets/pdf_bg.jpg';
	    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
		$mpdf->showWatermarkText = true;
	    $mpdf->WriteHTML('<watermarktext content="Style Flex" alpha="0.2" />');
	    $mpdf->SetWatermarkImage($src,'0.2','P');
	    $mpdf->showWatermarkImage = true;
	    $mpdf->SetFooter('Invoice');
	    $html=$this->load->view('printbill',$data,true);
	    $mpdf->WriteHTML($html);
	    $mpdf->WriteHTML('');
	    $file = $mpdf->Output();
  		file_put_contents($file_name, $file);
	    $result = true;

    	$msg = $this->EmailContent_model->send_invoice($bill_no);

    	$subject = "STYLE FLEX".$bill_no." - Invoice";
    	$sendmail = $this->SendMail_model->do_email($msg,$subject,$mail,$from = '',$file_name);
 		
    }

    public function getinvoicedet($bill_no)
    {
    	$invoicedata = '';
    	$billbasedata =   $this->Invoice_model->getBillbaseRow("bill_no = '".$bill_no."'");	
		$billsubdata = $this->Invoice_model->getBillsubResults("bill_no = '".$bill_no."'");
		$billsubdatarow = $this->Invoice_model->getBillsubRow("bill_no = '".$billbasedata['bill_no']."'");
		$cus_data = $this->Customer_model->getCustomerRow("cus_id = '".$billsubdatarow['cus_id']."'");
		$editsettingdata = $this->Settings_model->getSettingRow("1");
		$invoice_date = date("Y-m-d", strtotime($billbasedata['paid_date']));
    	 
    }

    public function invoice_delete()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $bill_no = $this->input->post('bill_no');
        
        $data = array(
            'status'  => '2'
        );

        $update = $this->Invoice_model->update_base($bill_no,$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Invoice deleted successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

  //   function sendmail($tomail,$subject,$message)
  //   {

		// $editsettingdata = $this->Settings_model->getSettingRow('1'); 
  //   	$config = Array(

		// 	'protocol'  => 'smtp',
		// 	'smtp_port' => $editsettingdata['mail_port'],
		// 	'smtp_user' => $editsettingdata['mail_username'],
		// 	'smtp_pass' => $editsettingdata['mail_pass'],
		// 	'mailtype'  => 'html',
		// 	'starttls'  => true,
		// 	'newline'   => "\r\n"
		// );


		// $config['smtp_host']='smtp.googlemail.com';

		// $this->load->library('email', $config);

		// $this->email->from($editsettingdata['mail_username'], 'Style Flex');
		// $this->email->to($tomail);
 
		// $this->email->subject($subject);
		// $this->email->message($message);
		
		// $result = $this->email->send();
  //   }

    public function viewtransaction($cus_id)
    {
    	$page_data['page_title'] = 'View Transactions';
		$page_data['page_title1'] = 'View Transaction Details';
		$page_data['page_path'] = 'viewtransaction';	
		$page_data['billbaseresults'] =   $this->Invoice_model->getBillbaseResultsOrder("cus_id = '".$cus_id."'");	
		 
		$page_data['cus_data'] = $this->Customer_model->getCustomerRow("cus_id = '".$cus_id."'");

		$this->load->view('template',$page_data);	
    }

	 
}


