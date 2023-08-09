<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Location_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
       
    }

  

    /**
     * This function used to check the login credentials of the user
     * @param string $username : This is username of the user
     * @param string $password : This is encrypted password of the user
     */
    function getCountry(){
        $this->db->from('country');
        $this->db->where('country_status',1);

        return $this->db->get();

    }
    function getState(){
        $this->db->from('state');
        $this->db->where('status',1);

        return $this->db->get();

    }
    function getCity(){
        $this->db->from('city');
        $this->db->where('status',1);

        return $this->db->get();

    }
    function getZone(){
        $this->db->from('zone');
        $this->db->where('status',1);

        return $this->db->get();

    }
    function getCityByStateId($id){
        $this->db->select('city_id,city_name');
        $this->db->from('city');
        $this->db->where('state_id', $id);
        $this->db->where('status !=',3);

        $result =  $this->db->get()->result_array();

        return $result;

    }

    public function getStateRow($condition)
    {
        $this->db->select('*');
        $this->db->from('state');
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function getCityRow($condition)
    {
        $this->db->select('*');
        $this->db->from('city');
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }
}
    