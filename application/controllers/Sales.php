<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        date_default_timezone_set("Asia/Manila");
        $this->load->model('super_model');
        $this->load->database();
 
       
        function arrayToObject($array){
            if(!is_array($array)) { return $array; }
            $object = new stdClass();
            if (is_array($array) && count($array) > 0) {
                foreach ($array as $name=>$value) {
                    $name = strtolower(trim($name));
                    if (!empty($name)) { $object->$name = arrayToObject($value); }
                }
                return $object;
            } 
            else {
                return false;
            }
        }
    } 


    public function sales_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/sales_list');
        $this->load->view('template/footer');
    }

    public function add_sales_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/add_sales_head');
        $this->load->view('template/footer');
    }

    public function add_sales_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/add_sales_itemlist');
        $this->load->view('template/footer');
    }
   
    public function add_sales_item()
    {
        $this->load->view('template/header');
        $this->load->view('sales/add_sales_item');
        $this->load->view('template/footer');
    }

     public function update_sales_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/update_sales_head');
        $this->load->view('template/footer');
    }

    public function update_sales_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/update_sales_itemlist');
        $this->load->view('template/footer');
    }
   
    public function update_sales_item()
    {
        $this->load->view('template/header');
        $this->load->view('sales/update_sales_item');
        $this->load->view('template/footer');
    }

    public function print_sales()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/print_sales');
        $this->load->view('template/footer');
    }


}