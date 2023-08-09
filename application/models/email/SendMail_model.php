<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class SendMail_model extends CI_Model {
 

    public function __construct()
    {
     	parent::__construct();
			
 	}
		
	
	function do_email($msg = NULL,$sub = NULL,$to = NULL, $from = NULL, $attachment=array()) {

        $config = array();
		
        $editsettingdata = $this->Settings_model->getSettingRow('1'); 

		$config['protocol'] 	= "smtp";
		$config['smtp_host'] 	= "smtp.googlemail.com"; 
		$config['smtp_port'] 	= $editsettingdata['mail_port'];
		$config['smtp_user'] 	= $editsettingdata['mail_username']; 
		$config['smtp_pass'] 	= $editsettingdata['mail_pass'];

		$config['charset'] 		= "utf-8";
		$config['mailtype'] 	= "html";
		$config['newline']  	= "\r\n";
		$config['wordwrap'] 	= TRUE;

        $this->email->initialize($config);
        $system_name = 'STYLE FLEX';
				
		$from = $editsettingdata['mail_username'];
	
       	$this->email->from($from, $system_name);
       
       	if($to!=''){}else{$to = $from;}
       
        $this->email->to($to);

        $this->email->subject($sub);	
	
        $this->email->message($msg);
		
        if (count($attachment) > 0) {
            foreach ($attachment as $attach) {
                
                $this->email->attach($attach['attachment'], 'attachment', $attach['filename']);
              
            }
        }

		return $this->email->send();
       
    }
	
}