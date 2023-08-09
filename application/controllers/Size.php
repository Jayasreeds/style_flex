<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Size extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();

 		if(empty($this->session->userdata('username')))
        {
            redirect('login');
        }
       
        else
        {
            $this->load->model('Size_model');
            $this->load->model('Price_model');
        }
 		 
 	}

 	public function index()
	{
        $page_data['type'] = $this->session->userdata('type');
		$page_data['page_title'] = 'Manage Size';
		$page_data['page_title1'] = 'Size Details';
		$page_data['page_path'] = 'manage_size';	
		$page_data['typedata'] = $this->Size_model->getSizeTypeResults("");	
		$page_data['sizedata'] = $this->Size_model->getSizeResults("status != '3' order by size_id DESC");	
		$this->load->view('template',$page_data);
		
	}

	public function addtype()
	{
		$page_data['page_title'] = 'Manage Size Type';
		$page_data['page_title1'] = 'Size Type Details';
		$page_data['page_path'] = 'addtype';	
		$page_data['typedata'] = $this->Size_model->getSizeTypeResults("");	
		$this->load->view('template',$page_data);
	}

	public function addtypedetails()
	{
		$error_type = '';
        $msg = '';
        $result = false;

        $type_name = $this->input->post('type_name');

    	$this->Size_model->truncate();	

        foreach ($type_name as $res) {

        	$data = array(
        		'type_name' => $res
        	);
        	$type_id = $this->Size_model->insert1($data);

        }

       	$result = ($type_id > 0) ? true : false;

		($result) ? $this->session->set_flashdata('success','Size type Details Added Successfully!'):$this->session->set_flashdata('error','Something went wrong!');  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
	}

	public function addsize()
	{
		$error_type = '';
        $msg = '';
        $result = false;
        $size_id = 0;
        $error = '';

        $this->form_validation->set_rules('sizetype', 'Size Type Name', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('lsize', 'Length', 'trim|required');
        $this->form_validation->set_rules('wsize', 'Width', 'trim|required');
 

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

        	$note = $this->input->post('note');
        	$notes = ($note) ? $note : ' ';
            $size_det = $this->input->post('lsize').'X'.$this->input->post('wsize');
            $condition = "size_det = '".$size_det."' AND type_id = '".$this->input->post('sizetype')."' AND status != '3'";
            $getsizedata = $this->Size_model->getSizeRow($condition);

            if($getsizedata)
            {
                $error = 'Given details already exist.';
            }
            else
            {
                $data = array(
                    'type_id'       => $this->input->post('sizetype'),
                    'size_det'      => $size_det,
                    'note'          => $notes,
                    'status'        => $this->input->post('status')
                );

                $size_id = $this->Size_model->insert($data);
            }
                
            
        }

       	$result = ($size_id > 0) ? true : false;
 
		($result) ? $this->session->set_flashdata('success','Size Details Added Successfully!'):$this->session->set_flashdata('error',$error);  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg, 'error' => $error));
	}

	  
    public function editsize()
	{
		$error_type = '';
        $msg = '';
        $result = false;
        $error = '';
        $update = '';

        $this->form_validation->set_rules('edt_sizetype', 'Size Type Name', 'trim|required');
        $this->form_validation->set_rules('edt_status', 'Status', 'required');
        $this->form_validation->set_rules('edt_lsize', 'Length', 'trim|required');
        $this->form_validation->set_rules('edt_wsize', 'Width', 'trim|required');
 

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

        	$note = $this->input->post('edt_note');
        	$notes = ($note) ? $note : ' ';
            $size_det = $this->input->post('edt_lsize').'X'.$this->input->post('edt_wsize');
            $condition = "size_det = '".$size_det."' AND type_id = '".$this->input->post('edt_sizetype')."' AND status != '3' AND size_id != '".$this->input->post('size_id')."'";
            $getsizedata = $this->Size_model->getSizeRow($condition);
            if($getsizedata)
            {
                $error = 'Given details already exist.';
            }
            else
            {
                $data = array(
                    'type_id' 		=> $this->input->post('edt_sizetype'),
                    'size_det' 		=> $size_det,
                    'note' 			=> $notes,
                    'status' 		=> $this->input->post('edt_status')
                );

                $update = $this->Size_model->update($this->input->post('size_id'),$data);
            }
            
        }

       	if($update)
       		$result = true;

		($result) ? $this->session->set_flashdata('success','Size Details Updated Successfully!'):$this->session->set_flashdata('error',$error);  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg, 'error' => $error));
	}

	public function getdetails() 
    {
        $size_id = $this->input->post('size_id');
        $getdata =   $this->Size_model->getSizeRow("size_id = '".$size_id."'");
        $gettypename = $this->Size_model->getSizeTypeRow("type_id = '".$getdata['type_id']."'");
        $data = array(
            "type_name"			=> strtoupper($gettypename['type_name']),
            "size"        		=> $getdata['size_det'],
            "note"     			=> ucwords($getdata['note']),
            "status"			=> ($getdata['status'] == '1') ? 'Active' : 'Inactive'
        );

        echo json_encode($data);
    }

	public function geteditdetails() 
    {
        $size_id = $this->input->post('size_id');
        $getdata =   $this->Size_model->getSizeRow("size_id = '".$size_id."'");
        $exp = explode('X', $getdata['size_det']);
        $lsize = $exp[0];
        $wsize = $exp[1];
        $data = array(
            "size_id"      		=> $size_id,
            "type_id"			=> $getdata['type_id'],
            "lsize"        		=> $lsize,
            "wsize"        		=> $wsize,
            "note"     			=> $getdata['note'],
            "status"			=> $getdata['status']
        );

        echo json_encode($data);
    }

	public function deletesize()
    {
        $error_type = '';
        $msg = '';
        $result = false;
        $update = '';
        $error = '';

        $size_id = $this->input->post('size_id');
        $getpricedata = $this->Price_model->getPriceRow("size_id = '".$size_id."'");
        if($getpricedata)
        {
            $error = 'This size details have the price value.';
        }
        else
        {
            $data = array(
                'status'  => '3'
            );

            $update = $this->Size_model->update($this->input->post('size_id'),$data);
        }
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Size details deleted successfully'):$this->session->set_flashdata('error',$error);  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    public function changestatus()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $size_id = $this->input->post('size_id');
        $getdata = $this->Size_model->getSizeRow("size_id = '".$size_id."'");
        
        if($getdata['status'] == '1')
            $status = '2';
        else
            $status = '1';

        $data = array(
            'status'  => $status
        );

        $update = $this->Size_model->update($this->input->post('size_id'),$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Size status updated successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    
}


