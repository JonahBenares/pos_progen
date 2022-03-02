<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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


    public function monthly_report()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/monthly_report');
        $this->load->view('template/footer');
    }

    public function summary_scgp()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/summary_scgp');
        $this->load->view('template/footer');
    }

    public function pending_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/pending_list');
        $this->load->view('template/footer');
    }
    public function pending_popup()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/pending_popup');
        $this->load->view('template/footer');
    }
    public function billed_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/billed_list');
        $this->load->view('template/footer');
    }
    public function bill_pay()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/bill_pay');
        $this->load->view('template/footer');
    }
    public function paid_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/paid_list');
        $this->load->view('template/footer');
    }

    public function print_billing()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/print_billing');
        $this->load->view('template/footer');
    }

    public function stock_card()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/stock_card');
        $this->load->view('template/footer');
    }

    public function overallpr_report()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/overallpr_report');
        $this->load->view('template/footer');
    }

    public function item_pr()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/item_pr');
        $this->load->view('template/footer');
    }

    public function aging_report()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/aging_report');
        $this->load->view('template/footer');
    }
    public function inventory_rangedate()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/inventory_rangedate');
        $this->load->view('template/footer');
    }



}