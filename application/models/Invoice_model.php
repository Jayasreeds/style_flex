<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Invoice_model extends CI_Model
{
    public $base_table = "invoice_base";
    public $sub_table = "invoice_sub";
    public $temp_table = "temp_billing";
    public $payment_table = "invoice_payment";

    public function __construct()
    {
        parent::__construct();
       
    }

    public function insert_payment($data){
        $this->db->insert($this->payment_table,$data);
        return $this->db->insert_id();
    }
 
    public function insert_base($data){
        $this->db->insert($this->base_table,$data);
        return $this->db->insert_id();
    }

    public function insert_sub($data){
        $this->db->insert($this->sub_table,$data);
        return $this->db->insert_id();
    }

    public function insert_temp($data){
        $this->db->insert($this->temp_table,$data);
        return $this->db->insert_id();
    }

    // public function getEdit_base($id){
    //     $this->db->from($this->base_table);
    //     $this->db->where('customer_id', $id);
    //     return $this->db->get()->row_array();

    // }

    // public function getEdit_sub($id){
    //     $this->db->from($this->sub_table);
    //     $this->db->where('customer_id', $id);
    //     return $this->db->get()->row_array();

    // }

    public function update_base($bill_no, $data) {
        $this->db->where('bill_no', $bill_no);
        $this->db->update($this->base_table, $data);
        return true;
    }

    public function update_sub($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->sub_table, $data);
        return true;
    }

    public function delete_base($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->base_table);
        return true;
    }

    public function delete_sub($bill_no,$cus_id) {
        $this->db->where('bill_no', $bill_no);
        $this->db->where('cus_id', $cus_id);
        $this->db->delete($this->sub_table);
        return true;
    }

    public function delete_temp($bill_no,$cus_id) {
        $this->db->where('bill_no', $bill_no);
        $this->db->where('cus_id', $cus_id);
        $this->db->delete($this->temp_table);
        return true;
    }

    public function delete_temp1($condition) {
        $this->db->where($condition);
        $this->db->delete($this->temp_table);
        return true;
    }

    public function getBillbaseResultsOrder($condition)
    {
        $this->db->select('*');
        $this->db->from($this->base_table);
        if($condition)
            $this->db->where($condition);
        $this->db->order_by('id','DESC');
        return $this->db->get()->result_array();
        
    }

    public function getBillSubResultsCount($condition)
    {
        $this->db->select('*');
        $this->db->from($this->sub_table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->num_rows();
        
    }

    public function getBillsubRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->sub_table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function invoice_num ($input, $pad_len = 7, $prefix = null) {
        if ($pad_len <= strlen($input))
          trigger_error('<strong>$pad_len</strong> cannot be less than or equal to the length of <strong>$input</strong> to generate invoice number', E_USER_ERROR);

        if (is_string($prefix))
          return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));

        return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
    }


    public function getBillbaseLastRow()
    {
        $this->db->select('*');
        $this->db->from($this->base_table);
        $this->db->limit(1);
        $this->db->order_by('id','DESC');
        return $this->db->get()->row_array();
        
    }

    public function getBillsubResults($condition)
    {
        $this->db->select('*');
        $this->db->from($this->sub_table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();
        
    }

    public function getBillPaymentResults($condition)
    {
        $this->db->select('*');
        $this->db->from($this->payment_table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->result_array();
        
    }

    public function getBillPaymentResultsCount($condition)
    {
        $this->db->select('*');
        $this->db->from($this->payment_table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->num_rows();
        
    }

    public function getBillbaseRow($condition)
    {
        $this->db->select('*');
        $this->db->from($this->base_table);
        if($condition)
            $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function checkExistTempBill($condition)
    {
        $this->db->select('*');
        $this->db->from($this->temp_table);
        $this->db->where($condition);
        return $this->db->get()->row_array();
        
    }

    public function getTempDataResults($condition){
        $this->db->from($this->temp_table);
        $this->db->where($condition);
        $this->db->order_by('id','DESC');
        return $this->db->get()->row_array();

    }

    function generate_string($input, $strength) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     
        return $random_string;
    }

    function getIndianCurrency(float $number)
    {

        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
            $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ? " " . $words[$point / 10] . " " . $words[$point = $point % 10] : '';
        $points = ($points=='') ? 'ZERO' : $points;
        return $result . "Rupees  " . $points . " Paise";
    }

  
}
    