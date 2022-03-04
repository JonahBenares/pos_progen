<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receive extends CI_Controller {

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


    public function receive_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/receive_list');
        $this->load->view('template/footer');
    }

    public function add_receive()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/add_receive');
        $this->load->view('template/footer');
    }


    public function add_receive_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/add_receive_head');
        $this->load->view('template/footer');
    }

    public function add_receive_head_process(){
       
     
        $data=array(
            "receive_date"=>$this->input->post('receive_date'),
            "po_no"=>$this->input->post('po_no'),
            "dr_no"=>$this->input->post('dr_no'),
            "si_no"=>$this->input->post('si_no'),
            "pcf"=>$this->input->post('pcf'),
            "overall_remarks"=>$this->input->post('remarks')
        );
     

       $id= $this->super_model->insert_return_id("receive_head", $data);

       $data_details = array(
            "receive_id"=>$id
       );
       $details_id= $this->super_model->insert_return_id("receive_details", $data_details);

      
       $return = array('receive_id'=>$id, 'rd_id'=>$details_id);
       echo json_encode($return);
    }

    public function cancel_receive(){
        $id = $this->input->post('id');
        $this->super_model->delete_where("receive_head", "receive_id", $id);
        $this->super_model->delete_where("receive_details", "receive_id", $id);
        $this->super_model->delete_where("receive_items", "receive_id", $id);
    }

    public function add_receive_pr()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/add_receive_pr');
        $this->load->view('template/footer');
    }
   
    public function add_receive_item()
    {
        $this->load->view('template/header');
        $this->load->view('receive/add_receive_item');
        $this->load->view('template/footer');
    }

    public function update_receive_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/update_receive_head');
        $this->load->view('template/footer');
    }

    public function update_receive_pr()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/update_receive_pr');
        $this->load->view('template/footer');
    }
   
    public function update_receive_item()
    {
        $this->load->view('template/header');
        $this->load->view('receive/update_receive_item');
        $this->load->view('template/footer');
    }

    public function print_receive()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/print_receive');
        $this->load->view('template/footer');
    }

}