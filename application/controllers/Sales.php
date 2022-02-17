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


    public function goods_sales_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_sales_list');
        $this->load->view('template/footer');
    }

    public function goods_add_sales_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_add_sales_head');
        $this->load->view('template/footer');
    }

    public function goods_add_sales_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_add_sales_itemlist');
        $this->load->view('template/footer');
    }
   
    public function goods_add_sales_item()
    {
        $this->load->view('template/header');
        $this->load->view('sales/goods_add_sales_item');
        $this->load->view('template/footer');
    }

     public function goods_update_sales_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_update_sales_head');
        $this->load->view('template/footer');
    }

    public function goods_update_sales_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_update_sales_itemlist');
        $this->load->view('template/footer');
    }
   
    public function goods_update_sales_item()
    {
        $this->load->view('template/header');
        $this->load->view('sales/goods_update_sales_item');
        $this->load->view('template/footer');
    }

    public function goods_print_sales()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_print_sales');
        $this->load->view('template/footer');
    }










    public function services_sales_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/services_sales_list');
        $this->load->view('template/footer');
    }

    public function services_add_sales_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/services_add_sales_head');
        $this->load->view('template/footer');
    }

    public function services_add_sales_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/services_add_sales_itemlist');
        $this->load->view('template/footer');
    }
   
    public function services_add_sales_item()
    {
        $this->load->view('template/header');
        $this->load->view('sales/services_add_sales_item');
        $this->load->view('template/footer');
    }

     public function services_update_sales_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/services_update_sales_head');
        $this->load->view('template/footer');
    }

    public function services_update_sales_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/services_update_sales_itemlist');
        $this->load->view('template/footer');
    }
   
    public function services_update_sales_item()
    {
        $this->load->view('template/header');
        $this->load->view('sales/services_update_sales_item');
        $this->load->view('template/footer');
    }

    public function services_print_sales()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/services_print_sales');
        $this->load->view('template/footer');
    }

    public function return_form()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/return_form');
        $this->load->view('template/footer');
    }

    public function print_return()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/print_return');
        $this->load->view('template/footer');
    }



}