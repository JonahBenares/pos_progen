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

    public function stock_card(){
        $item_id = $this->uri->segment(3);
        $now = date("Y-m-d");
        $data['item_name']=$this->super_model->select_column_where('items',"item_name","item_id",$item_id);
        $data['items']=$this->super_model->select_all_order_by("items","item_name","ASC");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->custom_query("SELECT rh.receive_id,rh.receive_date, ri.supplier_id, ri.brand, ri.catalog_no, ri.received_qty, ri.item_cost, ri.rd_id, ri.ri_id, rh.create_date, ri.shipping_fee, rh.po_no FROM receive_head rh INNER JOIN receive_items ri ON rh.receive_id = ri.receive_id WHERE item_id = '$item_id' AND saved='1'") AS $stk){
            $pr_no = $this->super_model->select_column_where("receive_details", "pr_no", "rd_id", $stk->rd_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $stk->supplier_id);
            $total_cost = $stk->received_qty*$stk->item_cost;
            $data['stockcard'][]=array(
                'date'=>$stk->receive_date,
                'create_date'=>$stk->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$stk->po_no,
                'catalog_no'=>$stk->catalog_no,
                'brand'=>$stk->brand,
                'item_cost'=>$total_cost,
                'quantity'=>$stk->received_qty,
                'series'=>'1',
                'method'=>'Receive',
            );

            $data['balance'][] = array(
                'series'=>'1',
                'method'=>'Receive',
                'quantity'=>$stk->received_qty,
                'date'=>$stk->receive_date,
                'create_date'=>$stk->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT rh.receive_id,rh.receive_date, ri.supplier_id, ri.brand, ri.catalog_no, ri.received_qty, ri.item_cost, ri.rd_id, ri.ri_id, rh.create_date, ri.shipping_fee, rh.po_no FROM receive_head rh INNER JOIN receive_items ri ON rh.receive_id = ri.receive_id WHERE item_id = '$item_id' AND expiration_date <= '$now' AND saved='1'") AS $stk){
            $pr_no = $this->super_model->select_column_where("receive_details", "pr_no", "rd_id", $stk->rd_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $stk->supplier_id);
            $total_cost = $stk->received_qty*$stk->item_cost;
            $data['stockcard'][]=array(
                'date'=>$stk->receive_date,
                'create_date'=>$stk->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$stk->po_no,
                'catalog_no'=>$stk->catalog_no,
                'brand'=>$stk->brand,
                'item_cost'=>$total_cost,
                'quantity'=>$stk->received_qty,
                'series'=>'2',
                'method'=>'Expired',
            );

            $data['balance'][] = array(
                'series'=>'2',
                'method'=>'Expired',
                'quantity'=>$stk->received_qty,
                'date'=>$stk->receive_date,
                'create_date'=>$stk->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM sales_good_head sh INNER JOIN sales_good_details sd ON sh.sales_good_head_id = sd.sales_good_head_id WHERE item_id = '$item_id' AND saved='1'") AS $sal){
            $client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $sal->client_id);
            $total_cost = $sal->quantity*$sal->unit_cost;
            $data['stockcard'][]=array(
                'date'=>$sal->sales_date,
                'create_date'=>$sal->create_date,
                'supplier'=>$client,
                'pr_no'=>$sal->pr_no,
                'po_no'=>$sal->po_no,
                'catalog_no'=>'',
                'brand'=>'',
                'item_cost'=>$total_cost,
                'quantity'=>$sal->quantity,
                'series'=>'3',
                'method'=>'Sales Good',
            );

            $data['balance'][] = array(
                'series'=>'3',
                'method'=>'Sales Good',
                'quantity'=>$sal->quantity,
                'date'=>$sal->sales_date,
                'create_date'=>$sal->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM sales_services_head sh INNER JOIN sales_serv_items si ON sh.sales_serv_head_id = si.sales_serv_head_id WHERE item_id = '$item_id' AND saved='1'") AS $sas){
            $client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $sas->client_id);
            $total_cost = $sas->quantity*$sas->unit_cost;
            $data['stockcard'][]=array(
                'date'=>$sas->sales_date,
                'create_date'=>$sas->create_date,
                'supplier'=>$client,
                'pr_no'=>$sas->jor_no,
                'po_no'=>$sas->joi_no,
                'catalog_no'=>'',
                'brand'=>'',
                'item_cost'=>$total_cost,
                'quantity'=>$sas->quantity,
                'series'=>'4',
                'method'=>'Sales Services',
            );

            $data['balance'][] = array(
                'series'=>'4',
                'method'=>'Sales Services',
                'quantity'=>$sas->quantity,
                'date'=>$sas->sales_date,
                'create_date'=>$sas->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM damage_head dh INNER JOIN damage_details dd ON dh.damage_id = dd.damage_id WHERE item_id = '$item_id'") AS $dam){
            $receive_id = $this->super_model->select_column_where("fifo_in","receive_id","in_id",$dam->in_id);
            $brand = $this->super_model->select_column_where("receive_items","brand","receive_id",$receive_id);
            $catalog_no = $this->super_model->select_column_where("receive_items","catalog_no","receive_id",$receive_id);
            $supplier_id = $this->super_model->select_column_where("receive_items","supplier_id","receive_id",$receive_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id);
            $pr_no = $this->super_model->select_column_where("receive_details","pr_no","receive_id",$receive_id);
            $po_no = $this->super_model->select_column_where("receive_head","po_no","receive_id",$receive_id);
            $item_cost = $this->super_model->select_column_where("receive_items","item_cost","receive_id",$receive_id);
            $total_cost = $dam->damage_qty*$item_cost;
            $data['stockcard'][]=array(
                'date'=>$dam->damage_date,
                'create_date'=>$dam->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$dam->damage_qty,
                'series'=>'5',
                'method'=>'Damaged',
            );

            $data['balance'][] = array(
                'series'=>'5',
                'method'=>'Damaged',
                'quantity'=>$dam->damage_qty,
                'date'=>$dam->damage_date,
                'create_date'=>$dam->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM repair_details WHERE item_id = '$item_id' AND assessment='1'") AS $rep){
            //$client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $rep->client_id);
            $receive_id = $this->super_model->select_column_where("fifo_in","receive_id","in_id",$rep->in_id);
            $brand = $this->super_model->select_column_where("receive_items","brand","receive_id",$receive_id);
            $catalog_no = $this->super_model->select_column_where("receive_items","catalog_no","receive_id",$receive_id);
            $supplier_id = $this->super_model->select_column_where("receive_items","supplier_id","receive_id",$receive_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id);
            $pr_no = $this->super_model->select_column_where("receive_details","pr_no","receive_id",$receive_id);
            $po_no = $this->super_model->select_column_where("receive_head","po_no","receive_id",$receive_id);
            $total_cost = $rep->quantity*$rep->repair_price;
            $data['stockcard'][]=array(
                'date'=>$rep->repair_date,
                'create_date'=>$rep->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$rep->quantity,
                'series'=>'6',
                'method'=>'Repaired',
            );

            $data['balance'][] = array(
                'series'=>'6',
                'method'=>'Repaired',
                'quantity'=>$rep->quantity,
                'date'=>$rep->repair_date,
                'create_date'=>$rep->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM return_head rh INNER JOIN return_details rd ON rh.return_id = rd.return_id WHERE item_id = '$item_id'") AS $ret){
            $receive_id = $this->super_model->select_column_where("fifo_in","receive_id","in_id",$ret->in_id);
            $brand = $this->super_model->select_column_where("receive_items","brand","receive_id",$receive_id);
            $catalog_no = $this->super_model->select_column_where("receive_items","catalog_no","receive_id",$receive_id);
            $supplier_id = $this->super_model->select_column_where("receive_items","supplier_id","receive_id",$receive_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id);
            $pr_no = $this->super_model->select_column_where("receive_details","pr_no","receive_id",$receive_id);
            $po_no = $this->super_model->select_column_where("receive_head","po_no","receive_id",$receive_id);
            $item_cost = $this->super_model->select_column_where("receive_items","item_cost","receive_id",$receive_id);
            $total_cost = $ret->return_qty*$item_cost;
            $data['stockcard'][]=array(
                'date'=>$ret->return_date,
                'create_date'=>$ret->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$ret->return_qty,
                'series'=>'7',
                'method'=>'Returned',
            );

            $data['balance'][] = array(
                'series'=>'7',
                'method'=>'Returned',
                'quantity'=>$ret->return_qty,
                'date'=>$ret->return_date,
                'create_date'=>$ret->create_date
            );
        }
        $this->load->view('reports/stock_card',$data);
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