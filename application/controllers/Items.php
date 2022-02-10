<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

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


    public function item_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('items/item_list');
        $this->load->view('template/footer');
    }

    public function add_item()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('items/add_item');
        $this->load->view('template/footer');
    }

    public function update_item()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('items/update_item');
        $this->load->view('template/footer');
    }

    public function damage_item()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('items/damage_item');
        $this->load->view('template/footer');
    }

    public function damage_item_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('items/damage_item_list');
        $this->load->view('template/footer');
    }

    public function view_item()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('items/view_item');
        $this->load->view('template/footer');
    }
   

}