<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {
 	
 	function __construct() {

 		parent::__construct();
 		
 		 $this->load->model('Location_model');
 		 
 	}
	public function getStateById()
	{
		 $country_id = $this->input->post('country_id');
		
		 echo $this->Location_model->getStateById($country_id);
			 
 
 	}
 	public function getCityByStateId()
 	{
		$state_id = $this->input->post('state_id');
		
		$res = array();
        $result = $this->Location_model->getCityByStateId($state_id);
       
 		echo json_encode($result);
	 }
	 public function getzoneById()
	 {
		 $city_id = $this->input->post('city_id');
		
		 echo $this->Location_model->getCityById($city_id);
			 
 
	 }
	 
}


