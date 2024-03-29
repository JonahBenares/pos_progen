<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Controller {

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


    public function billing_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('billing/billing_list');
        $this->load->view('template/footer');
    }

    public function add_billing_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('billing/add_billing_head');
        $this->load->view('template/footer');
    }

    public function add_billing_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('billing/add_billing_itemlist');
        $this->load->view('template/footer');
    }
   
    public function add_billing_item()
    {
        $this->load->view('template/header');
        $this->load->view('billing/add_billing_item');
        $this->load->view('template/footer');
    }

     public function update_billing_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('billing/update_billing_head');
        $this->load->view('template/footer');
    }

    public function update_billing_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('billing/update_billing_itemlist');
        $this->load->view('template/footer');
    }
   
    public function update_billing_item()
    {
        $this->load->view('template/header');
        $this->load->view('billing/update_billing_item');
        $this->load->view('template/footer');
    }
    public function print_billing()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('billing/print_billing');
        $this->load->view('template/footer');
    }




}