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

    public function goods_add_sales_head(){
        $sales_good_head_id = $this->uri->segment(3);
        $data['sales_good_head_id'] = $this->uri->segment(3);
        $data['buyer']=$this->super_model->select_all_order_by("client","buyer_name","ASC");
        /*foreach($this->super_model->select_custom_where("sales_good_details","") AS $fi){
            $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$fi->item_id);
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$fi->item_id);
            $selling_price = $this->super_model->select_column_where("items","selling_price","item_id",$fi->item_id);
            $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$fi->item_id);
            $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $data['fifo_in'][]= array(
                'in_id'=>$fi->in_id,
                'original_pn'=>$original_pn,
                'item_name'=>$item_name,
                'selling_price'=>$selling_price,
                'unit'=>$unit,
                'serial_no'=>$fi->serial_no,
                'remaining_qty'=>$fi->remaining_qty,
            );
        }*/
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_add_sales_head',$data);
        $this->load->view('template/footer');
    }

    public function add_sales_head_process(){
        $data=array(
            "client_id"=>$this->input->post('client'),
            "sales_date"=>$this->input->post('sales_date'),
            "pr_no"=>$this->input->post('pr_no'),
            "pr_date"=>$this->input->post('pr_date'),
            "po_no"=>$this->input->post('po_no'),
            "po_date"=>$this->input->post('po_date'),
            "dr_no"=>$this->input->post('dr_no'),
            "vat"=>$this->input->post('vat'),
            "remarks"=>$this->input->post('remarks'),
            "create_date"=>date("Y-m-d H:i:s"),
            "user_id"=>$_SESSION['user_id'],
        );
        $id= $this->super_model->insert_return_id("sales_good_head", $data);
        $return = array('sales_good_head_id'=>$id);
        echo json_encode($return);
    }

    public function cancel_sales(){
        $id = $this->input->post('id');
        $this->super_model->delete_where("sales_good_head", "sales_good_head_id", $id);
        $this->super_model->delete_where("sales_good_details", "sales_good_head_id", $id);
    }

    public function client_info(){
        $client_id=$this->input->post('client_id');
        foreach($this->super_model->select_row_where("client","client_id",$client_id) AS $cli){
            $return = array('address'=>$cli->address, 'tin'=>$cli->tin, 'buyer_name'=>$cli->buyer_name, 'contact_person'=>$cli->contact_person, 'contact_no'=>$cli->contact_no);
        }
        echo json_encode($return);
    }

    public function goods_add_sales_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_add_sales_itemlist');
        $this->load->view('template/footer');
    }
   
    public function goods_add_sales_item(){
        $data['sales_good_head_id']=$this->uri->segment(3);
        foreach($this->super_model->select_custom_where("fifo_in","remaining_qty!='0' ORDER BY receive_date DESC") AS $fi){
            $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$fi->item_id);
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$fi->item_id);
            $selling_price = $this->super_model->select_column_where("items","selling_price","item_id",$fi->item_id);
            $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$fi->item_id);
            $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $data['fifo_in'][]= array(
                'in_id'=>$fi->in_id,
                'original_pn'=>$original_pn,
                'item_name'=>$item_name,
                'selling_price'=>$selling_price,
                'unit'=>$unit,
                'serial_no'=>$fi->serial_no,
                'remaining_qty'=>$fi->remaining_qty,
            );
        }
        $this->load->view('template/header');
        $this->load->view('sales/goods_add_sales_item',$data);
        $this->load->view('template/footer');
    }

    public function item_info(){
        $item_id=$this->input->post('item_id');
        foreach($this->super_model->select_row_where("fifo_in","in_id",$item_id) AS $itm){
            $selling_price = $this->super_model->select_column_where("items","selling_price","item_id",$itm->item_id);
            $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$itm->item_id);
            $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $return = array('serial_no'=>$itm->serial_no, 'selling_price'=>$selling_price, 'quantity'=>$itm->remaining_qty, 'unit'=>$unit);
        }
        echo json_encode($return);
    }

    public function insert_items(){
        $sales_good_head_id = $this->input->post('sales_good_head_id');
        $data=array(
            "sales_good_head_id"=>$sales_good_head_id,
            "in_id"=>$this->input->post('item'),
            "unit_cost"=>$this->input->post('unit_cost'),
            "selling_price"=>$this->input->post('selling_price'),
            "discount_percent"=>$this->input->post('discount'),
            //"total"=>$this->input->post('total'),
        );
        if($this->super_model->insert_into("sales_good_details", $data)){
            $x=1;
            foreach($this->super_model->select_custom_where("sales_good_details","sales_good_head_id='$sales_good_head_id'") AS $app){
                $item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$app->in_id);
                $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$item_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
                $selling_price = $this->super_model->select_column_where("items","selling_price","item_id",$item_id);
                $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$item_id);
                $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                $serial_no = $this->super_model->select_column_where("fifo_in","serial_no","in_id",$app->in_id);
                $qty = $this->super_model->select_column_where("fifo_in","remaining_qty","in_id",$app->in_id);
                echo '<tr><td>'.$x++.'</td><td>'.$original_pn.'</td><td>'.$item_name.'</td><td>'.$serial_no.'</td><td>'.$qty.'</td><td>'.$unit.'</td><td>'.$app->selling_price.'</td><td>'.$app->discount_percent.'</td><td></td>  <td><a href="" class="btn btn-danger btn-xs btn-rounded"><span class="mdi mdi-window-close"></span></a></td> </tr>';
            }
        }
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