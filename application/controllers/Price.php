<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();
 		
 		if(empty($this->session->userdata('username')))
        {
            redirect('login');
        }
       
        else
        {
            $this->load->model('Price_model');
            $this->load->model('Quality_model');
            $this->load->model('Size_model');
        }
 		 
 	}

 	public function index()
	{
        $page_data['type'] = $this->session->userdata('type');
		$page_data['page_title'] = 'Manage Price';
		$page_data['page_title1'] = 'Manage Price Details';
		$page_data['page_path'] = 'manage_price';	
		$page_data['pricedata'] = $this->Price_model->getPriceResults("status != '3' order by price_id DESC");
		$page_data['qualitydata'] = $this->Quality_model->getQualityResults("status = '1'");
		$page_data['sizedata'] = $this->Size_model->getSizeResults("status = '1'");
		$this->load->view('template',$page_data);
		
	}

	public function addprice()
	{
		$error_type = '';
        $msg = '';
        $result = false;
        $price_id = 0;

        $this->form_validation->set_rules('quality_id', 'Quality Name', 'trim|required');
        $this->form_validation->set_rules('size_id', 'Size Name', 'trim|required');
        $this->form_validation->set_rules('price_val', 'Price', 'trim|required');
 

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

        	$note = $this->input->post('note');
        	$notes = ($note) ? $note : ' ';
            $condition = "size_id = '".$this->input->post('size_id')."' AND quality_id = '".$this->input->post('quality_id')."' AND status != '3'";
            $getsizedata = $this->Price_model->getPriceRow($condition);

            if($getsizedata)
            {
                $error = 'Given details already exist.';
            }
            else
            {
                $data = array(
                    'quality_id' 	=> $this->input->post('quality_id'),
                    'size_id' 		=> $this->input->post('size_id'),
                    'price_val' 	=> $this->input->post('price_val'),
                    'note' 			=> $notes,
                    'status' 		=> $this->input->post('status')
                );

                $price_id = $this->Price_model->insert($data);
            }

        }

       	$result = ($price_id > 0) ? true : false;

		($result) ? $this->session->set_flashdata('success','Price Details Added Successfully!'):$this->session->set_flashdata('error',$error);  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
	}

	public function changestatus()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $price_id = $this->input->post('price_id');
        $getdata = $this->Price_model->getPriceRow("price_id = '".$price_id."'");
        
        if($getdata['status'] == '1')
            $status = '2';
        else
            $status = '1';

        $data = array(
            'status'  => $status
        );

        $update = $this->Price_model->update($this->input->post('price_id'),$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Price status updated successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    public function geteditdetails() 
    {
        $price_id = $this->input->post('price_id');
        $getdata =   $this->Price_model->getPriceRow("price_id = '".$price_id."'");
        // $getqualityname = $this->Quality_model->getQualityRow("quality_id = '".$getdata['quality_id']."'");
        // $getsizedet = $this->Size_model->getSizeRow("size_id = '".$getdata['size_id']."'");
        // $gettypename = $this->Size_model->getSizeTypeRow("type_id = '".$getsizedet['type_id']."'");
        $data = array(
            "edt_quality_id"      	=> $getdata['quality_id'],
            "edt_size_id"			=> $getdata['size_id'],
            "edt_price_val"        	=> $getdata['price_val'],
            "edt_status"      		=> $getdata['status'],
            "edt_note"				=> $getdata['note'],
            "price_id"				=> $price_id
        );

        echo json_encode($data);
    }

    public function getdetails() 
    {
        $price_id = $this->input->post('price_id');
        $getdata =   $this->Price_model->getPriceRow("price_id = '".$price_id."'");
        $getqualityname = $this->Quality_model->getQualityRow("quality_id = '".$getdata['quality_id']."'");
        $getsizedet = $this->Size_model->getSizeRow("size_id = '".$getdata['size_id']."'");
        $gettypename = $this->Size_model->getSizeTypeRow("type_id = '".$getsizedet['type_id']."'");
        $data = array(
            "v_quality_id"      	=> ucfirst($getqualityname['quality_name']),
            "v_size_id"				=> $getsizedet['size_det']." ".ucfirst($gettypename['type_name']),
            "v_price_val"        	=> "Rs. ".$getdata['price_val']."/-",
            "v_status"      		=> ($getdata['status'] == '1') ? 'Active' : 'Inactive',
            "v_note"				=> ucwords($getdata['note']),
            "v_last_updated"		=> $getdata['last_updated']
        );

        echo json_encode($data);
    }

    public function editprice()
	{
		$error_type = '';
        $msg = '';
        $result = false;
        $price_id = 0;
        $update = '';

        $this->form_validation->set_rules('edt_quality_id', 'Quality Name', 'trim|required');
        $this->form_validation->set_rules('edt_size_id', 'Size Name', 'trim|required');
        $this->form_validation->set_rules('edt_price_val', 'Price', 'trim|required');
 

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

        	$note = $this->input->post('edt_note');
        	$notes = ($note) ? $note : ' ';
            $condition = "size_id = '".$this->input->post('edt_size_id')."' AND quality_id = '".$this->input->post('edt_quality_id')."' AND status != '3' AND price_id != '".$this->input->post('price_id')."'";
            $getsizedata = $this->Price_model->getPriceRow($condition);
         
            if($getsizedata)
            {
                $error = 'Given details already exist.';
            }
            else
            {
                $data = array(
                    'quality_id' 	=> $this->input->post('edt_quality_id'),
                    'size_id' 		=> $this->input->post('edt_size_id'),
                    'price_val' 	=> $this->input->post('edt_price_val'),
                    'note' 			=> $notes,
                    'status' 		=> $this->input->post('edt_status')
                );

                $update = $this->Price_model->update($this->input->post('price_id'),$data);
            }

        }

       	if($update)
       		$result = true;

		($result) ? $this->session->set_flashdata('success','Price Details Updated Successfully!'):$this->session->set_flashdata('error',$error);  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
	}

	public function deleteprice()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $price_id = $this->input->post('price_id');
        
        $data = array(
            'status'  => '3'
        );

        $update = $this->Price_model->update($this->input->post('price_id'),$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Price detail deleted successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }

    public function getSize()
    {
        $quality_id = $this->input->post('quality_id');
         
        $result = $this->Price_model->getSize($quality_id);

        $size = array();
        foreach ($result as $key) {
            $getsizename = $this->Size_model->getSizeRow("size_id = '".$key['size_id']."'");
            $data = array(
                'id' => trim($key['size_id']),
                'label' => trim($getsizename['size_det']),
                'value' => trim($key['size_id'])
            );
            $size[] = $data;
        }

        echo json_encode($size);

    }

    public function getsizedetails()
    {
        $quality_id = $this->input->post('quality_id');
        $getdata =   $this->Price_model->getDistinctSizeResults("price_details","quality_id = '".$quality_id."' and status!='3'");
        if($getdata)
        {
            $json = "<option value=' '>Select Size</option>";
            foreach ($getdata as $res) {
                $val1 = $res['size_id'];
                $getsizedet = $this->Size_model->getSizeRow("size_id = '".$res['size_id']."'");
                
                $typname = $this->Size_model->getSizeTypeRow("type_id = '".$getsizedet['type_id']."'");
                $val2 = $getsizedet['size_det']." ".strtoupper($typname['type_name']);
                $json.= "<option value='$val1'>$val2</option>";
                
            }
        }
        else
        {
            $json = "<option value=' '>Size Details Not Available</option>";
        }    

        echo json_encode($json);
       
    }

    public function getpricedetails()
    {
        $json = '';
        $quality_id = $this->input->post('quality_id');
        $size_id = $this->input->post('size_id');
        $getdata =   $this->Price_model->getPriceRow("quality_id = '".$quality_id."' and size_id = '".$size_id."' and status!='3' order by price_id");
        if($getdata)
        {
            $json = $getdata['price_val'];
        }  
        echo json_encode($json);
    }
}


