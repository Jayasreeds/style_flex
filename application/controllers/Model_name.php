<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_name extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();
      
        $this->load->model('Model_name_model');
        $this->load->model('branch/Branch_model');
            
 	}

    public function index()
    {
        $page_data['type'] = $this->session->userdata('type');
        $page_data['page_title'] = 'Manage Model';
        $page_data['page_title1'] = 'Model Details';
        $page_data['page_path'] = 'manage_model'; 
        if($page_data['type']!='1')
            $condition = "status != '3' AND branch_id = '".$this->session->userdata('branch_id')."'";
        else
            $condition = "status != '3'";
        $page_data['modeldata'] = $this->Model_name_model->getModelResultsOrder($condition);
        $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");  
        $this->load->view('template',$page_data);
    }

    public function addmodel()
    {
        $page_data['page_path'] = 'addmodel';
        $page_data['type'] = $this->session->userdata('type');
        $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");  
        $this->load->view('template',$page_data);
    }
    public function add_model()
    {
        $error_type = '';
        $msg = '';
       
        $result = false;

        $type=  $this->session->userdata('type');

        if ($type==1){

            $branch_id=$this->input->post('branch_id');
        }
        elseif ($type==2) {
            $branch_id= $this->session->userdata('branch_id');
        }
        $model = $this->input->post('model');
        $data = array(
            'branch_id'        => $branch_id,
            'model_name'       => $model
            
        );
        $enquiryId  =$this->Model_name_model->insert($data);
        if($enquiryId > 0)
            $result = true;

        ($result) ? $this->session->set_flashdata('success','Model Details Added Successfully!'):$this->session->set_flashdata('error','Something went wrong!');  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
       
    }

    public function checkModelAlredyExist()
    {

            $model = $this->input->post('model');
            $model_id = $this->input->post('model_id');
            $result = $this->Model_name_model->checkModelAlredyExist($model,$model_id);
            $result = (empty($result)) ? true: false;
            
            echo(json_encode($result)); 

    }

    public function editmodel()
    {
        $uri = $this->uri->segment(2);
        $page_data['edt_modeldata'] = $this->Model_name_model->getModelRow("model_id = '".$uri."'");
        $page_data['page_path'] = 'editmodel';
        $page_data['type'] = $this->session->userdata('type');
        $page_data['branchdata'] = $this->Branch_model->getBranchResults("status != '3'");  
        $this->load->view('template',$page_data);
    }

    public function updatemodel()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $this->form_validation->set_rules('model', 'Model Name', 'trim|required'); 

        if ($this->form_validation->run() == FALSE) {
            $error_type = 'v';
            $msg = validation_errors('<p class="error">', '</p>'); //validation_errors();
            $result = false;
        } else {

            $model_name = $this->input->post('model');
            $type=  $this->session->userdata('type');

            if ($type==1){

                $branch_id=$this->input->post('branch_id');
            }
            elseif ($type==2) {
                $branch_id= $this->session->userdata('branch_id');
            }
            $data = array(
                'branch_id'        => $branch_id,
                'model_name'       => $model_name
            );

            $update = $this->Model_name_model->update($this->input->post('model_id'),$data);
            
        }

        if($update)
            $result = true;

        ($result) ? $this->session->set_flashdata('success','Model Details Updated Successfully!'):$this->session->set_flashdata('error','Something went wrong!');  

        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));
    }

    public function deletemodel()
    {
        $error_type = '';
        $msg = '';
        $result = false;

        $model_id = $this->input->post('model_id');
        
        $data = array(
            'status'  => '3'
        );

        $update = $this->Model_name_model->update($this->input->post('model_id'),$data);
        
        if($update)
            $result = true;
        ($result) ? $this->session->set_flashdata('success','Model deleted successfully'):$this->session->set_flashdata('error','Something went wrong');  
                       
        echo json_encode(array('rs' => $result, 'errType' => $error_type, 'msg' => $msg));

    }
}
 