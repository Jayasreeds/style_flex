<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class EmailContent_model extends CI_Model {
 

    public function __construct()
    {
     	parent::__construct();
			
 	}
		
	
	function invoice_convert($cus_name, $bill_no, $total_amt){
			
		$body = '<tr> 
        <td colspan="2" style="width:640px"> <p style="font:18px Arial,sans-serif;color:#cc6600;margin:15px 20px 0 20px">Dear '.$cus_name.'</p>  
        <p style="margin:20px 20px 18px 50px;width:640px">
        Your Invoice has been successfully generated from Style Flex!!!!
        </p>
        <p style="margin:20px 20px 18px 50px;width:640px">
        Your Invoice No: <span style="font:14px Arial,sans-serif;color:#cc6600;">'.$bill_no.' </span>
        </p>
        <p style="margin:20px 20px 18px 50px;width:640px">
        Total Amount: <span style="font:14px Arial,sans-serif;color:#cc6600;">'.$total_amt.' </span> 
        </p>
        <p style="margin:20px 20px 18px 50px;width:640px">
        Have a great time!
        </p>
        <p style="margin:40px 20px 18px 50px;width:640px">
        Thank you
        </p>
        <p style="font:18px Arial,sans-serif;color:#cc6600;margin:0px 20px 18px 50px;width:640px">
        STYLE FLEX
        </p>
         </td> </tr>';
		return $body;
			
	}

	function send_invoice($bill_no){
			
		$body = '<tr> 
        <td colspan="2" style="width:640px"> <p style="font:18px Arial,sans-serif;color:#cc6600;margin:15px 20px 0 20px">Dear '.$cus_name.'</p>  
        <p style="margin:20px 20px 18px 50px;width:640px">
        Attached File
        </p>
        <p style="margin:40px 20px 18px 50px;width:640px">
        By
        </p>
        <p style="font:18px Arial,sans-serif;color:#cc6600;margin:0px 20px 18px 50px;width:640px">
        STYLE FLEX
        </p>
         </td> </tr>';
		return $body;
			
	}
	  
	
}