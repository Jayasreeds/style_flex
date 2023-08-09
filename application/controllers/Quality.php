<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quality extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();

 		if(empty($this->session->userdata('username')))
        {
            redirect('login');
        }
       
        else
        {
            $this->load->model('Quality_model');
        }
 		 
 	}

 	public function index()
	{
        $page_data['type'] = $this->session->userdata('type');
		$page_data['page_title'] = 'Manage Quality';
		$page_data['page_title1'] = 'Quality Details';
		$page_data['page_path'] = 'manage_quality';	
		$page_data['qualitydata'] = $this->Quality_model->getQualityResults("status != '3'");	
		$this->load->view('template',$page_data);
		
	}

	public function addquality()
	{
		$error_type = '';
        $msg = '';
        $result = false;

        $this->form_validation->set_rules('quality_name', 'Quality Name', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'required');
 

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

        	$note = $this->input->post('note');
        	$notes = ($note) ? $note : ' ';
            $data = array(
                'quality_name' 	=> $this->input->post('quality_name'),
                'status' 		=> $this->input->post('status'),
                'note' 			=> $notes
            );

            $quality_id = $this->Quality_model->insert($data);
            
        }

       	$result = ($quality_id > 0) ? true : false;

		($result) ? $this->session->set_flashdata('success','Quality Details Added Successfully!'):$this->session->set_flashdata('error','Something went wrong!');  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
	}

	public function checkQualityAlredyExist()
    {

            $quality_name = $this->input->post('quality_name');
            $quality_id = $this->input->post('quality_id');
            $result = $this->Quality_model->checkQualityNameAlredyExist($quality_name,$quality_id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }

    public function checkQualityAlredyExist1()
    {

            $quality_name = $this->input->post('edt_quality_name');
            $quality_id = $this->input->post('quality_id');
            $result = $this->Quality_model->checkQualityNameAlredyExist($quality_name,$quality_id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }
	
	public function getdetails() 
    {
        $quality_id = $this->input->post('quality_id');
        $getdata =   $this->Quality_model->getQualityRow("quality_id = '".$quality_id."'");
        
        $data = array(
            "quality_name"      => ucfirst($getdata['quality_name']),
            "note"			    => ucwords($getdata['note']),
            "status"        	=> ($getdata['status'] == '1') ? 'Active' : 'Inactive',
            "last_updated"      => $getdata['last_updated'] 
        );

        echo json_encode($data);
    }

    public function geteditdetails() 
    {
        $quality_id = $this->input->post('quality_id');
        $getdata =   $this->Quality_model->getQualityRow("quality_id = '".$quality_id."'");
        
        $data = array(
            "quality_name"      => ucfirst($getdata['quality_name']),
            "note"			    => ucwords($getdata['note']),
            "status"        	=> $getdata['status'],
            "last_updated"      => $getdata['last_updated'],
            "quality_id"		=> $quality_id
        );

        echo json_encode($data);
    }

    public function editquality()
	{
		$error_type = '';
        $msg = '';
        $branchId = 0;
        $result = false;

        $this->form_validation->set_rules('edt_quality_name', 'Quality Name', 'trim|required');
        $this->form_validation->set_rules('edt_status', 'Status', 'required');
 

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

        	$note = $this->input->post('edt_note');
        	$notes = ($note) ? $note : ' ';
            $data = array(
                'quality_name' 	=> $this->input->post('edt_quality_name'),
                'status' 		=> $this->input->post('edt_status'),
                'note' 			=> $notes
            );

            $update = $this->Quality_model->update($this->input->post('quality_id'),$data);
            
        }

       	if($update)
       		$result = true;

		($result) ? $this->session->set_flashdata('success','Quality Details Updated Successfully!'):$this->session->set_flashdata('error','Something went wrong!');  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
	}

	public function deletequality()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $quality_id = $this->input->post('quality_id');
        
        $data = array(
            'status'  => '3'
        );

        $update = $this->Quality_model->update($this->input->post('quality_id'),$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Quality deleted successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    public function changestatus()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $quality_id = $this->input->post('quality_id');
        $getdata = $this->Quality_model->getQualityRow("quality_id = '".$quality_id."'");
        
        if($getdata['status'] == '1')
            $status = '2';
        else
            $status = '1';

        $data = array(
            'status'  => $status
        );

        $update = $this->Quality_model->update($this->input->post('quality_id'),$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Quality status updated successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }
}


