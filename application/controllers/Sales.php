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
        foreach($this->super_model->select_custom_where("sales_good_details","sales_good_head_id='$id'") AS $del){
            $remaining_qty = $this->super_model->select_column_where("fifo_in","remaining_qty","in_id",$del->in_id);
            $new_qty = $remaining_qty + $del->quantity;
            $dataup=array(
                "remaining_qty"=>$new_qty,
            );
            if($this->super_model->update_where("fifo_in", $dataup, "in_id", $del->in_id)){
                $this->super_model->delete_where("sales_good_head", "sales_good_head_id", $id);
                $this->super_model->delete_where("sales_good_details", "sales_good_head_id", $id);   
            }
        }
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
        foreach($this->super_model->select_custom_where("fifo_in","remaining_qty!='0' GROUP BY item_id ORDER BY receive_date ASC") AS $fi){
            $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$fi->item_id);
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$fi->item_id);
            $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$fi->item_id);
            $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $expire = date("Y-m-d",strtotime($fi->expiry_date));
            $today = date("Y-m-d");
            if($expire > $today || $fi->expiry_date==''){
                $data['fifo_in'][]= array(
                    'item_id'=>$fi->item_id,
                    'in_id'=>$fi->in_id,
                    'original_pn'=>$original_pn,
                    'item_name'=>$item_name,
                    'unit_cost'=>$fi->item_cost,
                    'unit'=>$unit,
                    'serial_no'=>$fi->serial_no,
                    'remaining_qty'=>$fi->remaining_qty,
                );
            }
        }
        $this->load->view('template/header');
        $this->load->view('sales/goods_add_sales_item',$data);
        $this->load->view('template/footer');
    }

    public function item_info(){
        $in_id=$this->input->post('in_id');
        $item_id=$this->input->post('item_id');
        foreach($this->super_model->select_row_where("fifo_in","in_id",$in_id) AS $itm){
            $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$itm->item_id);
            $group_id = $this->super_model->select_column_where("items","group_id","item_id",$itm->item_id);
            $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $return = array('serial_no'=>$itm->serial_no, 'unit_cost'=>$itm->item_cost, 'quantity'=>$itm->remaining_qty, 'unit'=>$unit, 'group_id'=>$group_id, 'item_id'=>$item_id);
        }
        echo json_encode($return);
    }

    public function qty_info(){
        $item_id=$this->input->post('item_id');
        $in_id=$this->input->post('in_id');
        foreach($this->super_model->select_custom_where("fifo_in","item_id = '$item_id' AND in_id='$in_id'") AS $itm){
            $max_cost = $this->super_model->get_max_where("fifo_in", "item_cost","item_id=$itm->item_id");;
            echo $max_cost;
        }
    }

    public function insert_items(){
        $sales_good_head_id = $this->input->post('sales_good_head_id');
        $in_id = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $remaining_qty = $this->super_model->select_column_where("fifo_in","remaining_qty","in_id",$in_id);
        $new_qty = $remaining_qty - $quantity;
        $data=array(
            "sales_good_head_id"=>$sales_good_head_id,
            "in_id"=>$in_id,
            "unit_cost"=>$this->input->post('unit_cost'),
            "selling_price"=>$this->input->post('selling_price'),
            "discount_percent"=>$this->input->post('discount'),
            "discount_amount"=>$this->input->post('discount_amount'),
            "group_id"=>$this->input->post('group_id'),
            "total"=>$this->input->post('total_cost'),
            "quantity"=>$this->input->post('quantity'),
        );
        if($this->super_model->insert_into("sales_good_details", $data)){
            $count_item = $this->super_model->count_rows_where("sales_good_details","sales_good_head_id",$sales_good_head_id);
            foreach($this->super_model->custom_query("SELECT * FROM sales_good_details WHERE sales_good_head_id='$sales_good_head_id' ORDER BY sales_good_det_id DESC LIMIT 1") AS $app){
                $item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$app->in_id);
                $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$item_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
                $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$item_id);
                $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                $serial_no = $this->super_model->select_column_where("fifo_in","serial_no","in_id",$app->in_id);
                echo '<tr id="load_data'.$count_item.'"><td>'.$count_item.'</td><td>'.$original_pn.'</td><td>'.$item_name.'</td><td>'.$serial_no.'</td><td>'.$app->quantity.'</td><td>'.$unit.'</td><td>'.number_format($app->selling_price,2).'</td><td>'.number_format($app->discount_percent,0)."%".'</td><td>'.number_format($app->total,2).'</td>  <td><a onclick="delete_sales_item('.$app->sales_good_det_id.','.$count_item.','.$app->quantity.','.$app->in_id.')" class="btn btn-danger btn-xs btn-rounded"><span class="mdi mdi-window-close"></span></a></td> </tr>';
                $count_item++;
            } 

            $dataup=array(
                "remaining_qty"=>$new_qty,
            );
            $this->super_model->update_where("fifo_in", $dataup, "in_id", $in_id);
        }
    }

    public function save_sales(){
        $sales_good_head_id = $this->input->post('sales_good_head_id');
        foreach($this->super_model->select_custom_where("sales_good_details","sales_good_head_id='$sales_good_head_id'") AS $av){
            $item_id = $this->super_model->select_column_where("fifo_in","item_id", "in_id", $av->in_id);
            $sumcost = $this->super_model->select_sum_where("fifo_in", "item_cost", "item_id = '$item_id'");
            $rowcount=$this->super_model->count_custom_where("fifo_in","item_id = '$item_id'");
            $count_item=$rowcount;
            $ave = $sumcost/$count_item;
            $dataup=array(
                "ave_cost"=>$ave,
            );
            if($this->super_model->update_where("sales_good_details", $dataup, "sales_good_det_id", $av->sales_good_det_id)){
                $datasave=array(
                    "saved"=>1,
                );
                if($this->super_model->update_where("sales_good_head", $datasave, "sales_good_head_id", $sales_good_head_id)){
                    $dataout=array(
                        'in_id'=>$av->in_id,
                        'transaction_type'=>'Goods',
                        'sales_id'=>$av->sales_good_head_id,
                        'damage_id'=>0,
                        'quantity'=>$av->quantity,
                    );
                    $this->super_model->insert_into("fifo_out", $dataout);
                }
            }
        }
        echo $sales_good_head_id;
    }

    public function delete_item(){
        $sales_good_det_id = $this->input->post('sales_good_det_id');
        $in_id = $this->input->post('in_id');
        $quantity = $this->input->post('quantity');
        $remaining_qty = $this->super_model->select_column_where("fifo_in","remaining_qty","in_id",$in_id);
        $new_qty = $remaining_qty + $quantity;
        $dataup=array(
            "remaining_qty"=>$new_qty,
        );
        if($this->super_model->update_where("fifo_in", $dataup, "in_id", $in_id)){
            $this->super_model->delete_where("sales_good_details", "sales_good_det_id", $sales_good_det_id);
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

    public function goods_print_sales(){
        $sales_good_head_id = $this->uri->segment(3);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->select_custom_where("sales_good_head","sales_good_head_id = '$sales_good_head_id'") AS $sh){
            $client = $this->super_model->select_column_where("client","buyer_name","client_id",$sh->client_id);
            $address = $this->super_model->select_column_where("client","address","client_id",$sh->client_id);
            $contact_person = $this->super_model->select_column_where("client","contact_person","client_id",$sh->client_id);
            $contact_no = $this->super_model->select_column_where("client","contact_no","client_id",$sh->client_id);
            $tin = $this->super_model->select_column_where("client","tin","client_id",$sh->client_id);
            $data['sales_head'][]=array(
                'client'=>$client,
                'address'=>$address,
                'contact_person'=>$contact_person,
                'contact_no'=>$contact_no,
                'tin'=>$tin,
                'sales_date'=>$sh->sales_date,
                'vat'=>$sh->vat,
                'pr_no'=>$sh->pr_no,
                'pr_date'=>$sh->pr_date,
                'po_no'=>$sh->po_no,
                'po_date'=>$sh->po_date,
                'dr_no'=>$sh->dr_no,
                'remarks'=>$sh->remarks,
            );
            foreach($this->super_model->select_custom_where("sales_good_details","sales_good_head_id='$sh->sales_good_head_id'") AS $sd){
                $item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$sd->in_id);
                $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$item_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
                $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$item_id);
                $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                $serial_no = $this->super_model->select_column_where("fifo_in","serial_no","in_id",$sd->in_id);
                $data['sales_details'][]=array(
                    'original_pn'=>$original_pn,
                    'item'=>$item_name,
                    'serial_no'=>$serial_no,
                    'quantity'=>$sd->quantity,
                    'uom'=>$unit,
                    'selling_price'=>$sd->selling_price,
                    'discount'=>$sd->discount_percent,
                    'total'=>$sd->total,
                );
            }
        }
        $this->load->view('sales/goods_print_sales',$data);
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