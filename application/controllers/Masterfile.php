<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterfile extends CI_Controller {

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

    public function index()
    {
        $this->load->view('masterfile/login');
    }

    public function dashboard()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/dashboard');
        $this->load->view('template/footer');
    }

    public function buyer_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/buyer_list');
        $this->load->view('template/footer');
    }

    public function employee_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/employee_list');
        $this->load->view('template/footer');
    }

    public function department_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/department_list');
        $this->load->view('template/footer');
    }

    public function group_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/group_list');
        $this->load->view('template/footer');
    }

    public function location_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/location_list');
        $this->load->view('template/footer');
    }

    public function enduse_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/enduse_list');
        $this->load->view('template/footer');
    }

    public function purpose_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/purpose_list');
        $this->load->view('template/footer');
    }

    public function rack_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/rack_list');
        $this->load->view('template/footer');
    }

    public function supplier_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/supplier_list');
        $this->load->view('template/footer');
    }

    public function uom_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/uom_list');
        $this->load->view('template/footer');
    }

    public function warehouse_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/warehouse_list');
        $this->load->view('template/footer');
    }


}