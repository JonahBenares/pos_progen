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
        $prc = $this->uri->segment(3);
        $count_pr = $prc+1;
        $data['count_pr'] = $count_pr;

        $data['department']= $this->super_model->select_all("department");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/add_receive_head',$data);
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

    public function update_receive_details(){
       $rd_id = $this->input->post('rd_id');
       $field = $this->input->post('field');
       if($field == 'department' || $field == 'purpose'){
            $field = $field."_id";
       }else if($field == 'inspected'){
            $field = $field."_by";
       } else{
            $field = $field;
       }


        $data=array(
            $field=>$this->input->post('val')
        );

        $this->super_model->update_where("receive_details", $data, "rd_id", $rd_id);
    }

    public function add_another_pr(){
        $receive_id = $this->input->post('receive_id');

        $data_details = array(
            "receive_id"=>$receive_id
        );
        $details_id= $this->super_model->insert_return_id("receive_details", $data_details);

        echo $details_id;
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
        $data['receive_id']= $this->uri->segment(3);
        $data['rd_id']= $this->uri->segment(4);
        $data['item'] = $this->super_model->select_all('items');
        $data['supplier'] = $this->super_model->select_all('supplier');

        $this->load->view('template/header');
        $this->load->view('receive/add_receive_item',$data);
        $this->load->view('template/footer');
    }

     public function insert_items(){
        
       $receive_id = $this->input->post('receive_id');
        $rd_id = $this->input->post('rd_id');

        
        if($this->input->post('local')=='1'){
            $mode = 1;
        } else {
            $mode =2;
        }

        
        $data=array(
            "rd_id"=>$rd_id,
            "receive_id"=>$receive_id,
            "supplier_id"=>$this->input->post('supplier'),
            "item_id"=>$this->input->post('item'),
            "brand"=>$this->input->post('brand'),
            "catalog_no"=>$this->input->post('catalog_no'),
            "serial_no"=>$this->input->post('serial_no'),
            "item_cost"=>$this->input->post('net_cost'),
            "expected_qty"=>$this->input->post('expected_qty'),
            "received_qty"=>$this->input->post('received_qty'),
            "local_mnl"=>$mode,
            "shipping_fee"=>$this->input->post('shipping'),
            "expiration_date"=>$this->input->post('expiry'),
           
        );

        if($this->super_model->insert_into("receive_items", $data)){
            

            $x=1;
            foreach($this->super_model->custom_query("SELECT * FROM receive_items WHERE rd_id='$rd_id' ORDER BY ri_id DESC LIMIT 1") AS $app){
                if($app->local_mnl == 1){
                    $mode = 'Local';
                } else {
                    $mode = 'MNL';
                }
                $item_id = $app->item_id;
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$app->item_id);
                $supplier = $this->super_model->select_column_where("supplier","supplier_name","supplier_id",$app->supplier_id);
                $brand = $app->brand;
                $serial_no = $app->serial_no;
                $catalog_no = $app->catalog_no;
                $net_cost = $app->item_cost;
                $expected_qty = $app->expected_qty;
                $received_qty = $app->received_qty;
                $shipping= $app->shipping_fee;
                $expiry =$app->expiration_date;
                $mode=$mode;
                echo '<tr><td>'.$item_name.'</td><td>'.$supplier.'</td><td>'.$app->brand.'</td><td>'.$app->serial_no.'</td><td>'.$app->catalog_no.'</td><td>'.$app->item_cost.'</td><td>'.$app->expected_qty.'</td><td>'.$app->received_qty.'</td><td>'.$app->shipping_fee.'</td><td>'.$app->expiration_date.'</td><td>'.$mode.'</td>  <td><a href="" class="btn btn-danger btn-xs btn-rounded"><span class="mdi mdi-window-close"></span></a></td> </tr>';
            }
        }
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