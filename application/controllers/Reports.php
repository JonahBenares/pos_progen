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


    public function monthly_report(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['client']=$this->super_model->select_all_order_by("client","buyer_name","buyer_name","ASC");
        $month = $this->uri->segment(3);
        $client_id = $this->uri->segment(4);
        $sql="";
        if($month!='null'){
            $sql.= " AND EXTRACT(MONTH from sales_date) = '$month' AND";
        }

        if($client_id!='null' && $month=='null'){
            $sql.= " AND client_id = '$client_id' AND";
        }else if($month!='null' && $client_id!='null'){
            $sql.= " client_id = '$client_id' AND";
        }

        $query=substr($sql,0,-3);
        foreach($this->super_model->custom_query("SELECT * FROM sales_good_head sh INNER JOIN sales_good_details sd ON sh.sales_good_head_id=sd.sales_good_head_id WHERE saved='1' ".$query) AS $sg){
            $item=$this->super_model->select_column_where("items","item_name","item_id",$sg->item_id);
            $original_pn=$this->super_model->select_column_where("items","original_pn","item_id",$sg->item_id);
            $unit_id=$this->super_model->select_column_where("items","unit_id","item_id",$sg->item_id);
            $uom=$this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $client=$this->super_model->select_column_where("client","buyer_name","client_id",$sg->client_id);
            $in_id=$this->super_model->select_column_where("fifo_out","in_id","sales_details_id",$sg->sales_good_det_id);
            $serial_no=$this->super_model->select_column_where("fifo_in","serial_no","in_id",$in_id);
            $data['sales'][]=array(
                "sales_date"=>$sg->sales_date,
                "dr_no"=>$sg->dr_no,
                "original_pn"=>$original_pn,
                "item"=>$item,
                "serial_no"=>$serial_no,
                "quantity"=>$sg->quantity,
                "uom"=>$uom,
                "pr_no"=>$sg->pr_no,
                "po_no"=>$sg->po_no,
                "client"=>$client,
                "unit_cost"=>$sg->unit_cost,
                "total"=>$sg->total,
                "remarks"=>$sg->remarks,
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM sales_services_head sh INNER JOIN sales_serv_items si ON sh.sales_serv_head_id=si.sales_serv_head_id WHERE saved='1' ".$query) AS $sid){
            $item=$this->super_model->select_column_where("items","item_name","item_id",$sid->item_id);
            $original_pn=$this->super_model->select_column_where("items","original_pn","item_id",$sid->item_id);
            $unit_id=$this->super_model->select_column_where("items","unit_id","item_id",$sid->item_id);
            $uom=$this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $client=$this->super_model->select_column_where("client","buyer_name","client_id",$sid->client_id);
            $in_id=$this->super_model->select_column_where("fifo_out","in_id","sales_serv_items_id",$sid->sales_serv_items_id);
            $serial_no=$this->super_model->select_column_where("fifo_in","serial_no","in_id",$in_id);
            $data['sales'][]=array(
                "sales_date"=>$sid->sales_date,
                "dr_no"=>$sid->dr_no,
                "original_pn"=>$original_pn,
                "item"=>$item,
                "serial_no"=>$serial_no,
                "quantity"=>$sid->quantity,
                "uom"=>$uom,
                "pr_no"=>$sid->jor_no,
                "po_no"=>$sid->joi_no,
                "client"=>$client,
                "unit_cost"=>$sid->unit_cost,
                "total"=>$sid->total,
                "remarks"=>$sid->remarks,
            );
        }
        $this->load->view('reports/monthly_report',$data);
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
        foreach($this->super_model->custom_query("SELECT rh.receive_id,rh.receive_date, ri.supplier_id, ri.brand, ri.catalog_no, ri.received_qty, ri.item_cost, ri.rd_id, ri.ri_id, rh.create_date, ri.shipping_fee, rh.po_no,ri.expiration_date FROM receive_head rh INNER JOIN receive_items ri ON rh.receive_id = ri.receive_id WHERE item_id = '$item_id' AND saved='1'") AS $stk){
            $pr_no = $this->super_model->select_column_where("receive_details", "pr_no", "rd_id", $stk->rd_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $stk->supplier_id);
            $total_cost = $stk->received_qty*$stk->item_cost;
            if($stk->expiration_date=='' || $stk->expiration_date > $now){
                $method = 'Receive';
            }else {
                $method = 'Expired';
            }
            //if($stk->expiration_date=='' || $stk->expiration_date >= $now){
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
                    'remaining_qty'=>'',
                    'series'=>'1',
                    'method'=>$method,
                );

                $data['balance'][] = array(
                    'series'=>'1',
                    'method'=>$method,
                    'quantity'=>$stk->received_qty,
                    'remaining_qty'=>'',
                    'date'=>$stk->receive_date,
                    'create_date'=>$stk->create_date
                );
            //}

            /*if($stk->expiration_date <= $now && $stk->expiration_date!=''){
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
            }*/
        }

        /*foreach($this->super_model->custom_query("SELECT rh.receive_id,rh.receive_date, ri.supplier_id, ri.brand, ri.catalog_no, ri.received_qty, ri.item_cost, ri.rd_id, ri.ri_id, rh.create_date, ri.shipping_fee, rh.po_no, ri.item_id,ri.serial_no FROM receive_head rh INNER JOIN receive_items ri ON rh.receive_id = ri.receive_id WHERE item_id = '$item_id' AND (expiration_date <= '$now' AND expiration_date!='') AND saved='1'") AS $rec){
            $pr_no = $this->super_model->select_column_where("receive_details", "pr_no", "rd_id", $rec->rd_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $rec->supplier_id);
            $remaining_qty = $this->super_model->select_column_custom_where("fifo_in",'remaining_qty',"item_id = '$rec->item_id' AND brand='$rec->brand' AND catalog_no='$rec->catalog_no' AND serial_no='$rec->serial_no' AND (expiry_date <= '$now' AND expiry_date!='')");
            $total_cost = $rec->received_qty*$rec->item_cost;
            $data['stockcard'][]=array(
                'date'=>$rec->receive_date,
                'create_date'=>$rec->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$rec->po_no,
                'catalog_no'=>$rec->catalog_no,
                'brand'=>$rec->brand,
                'item_cost'=>$total_cost,
                'quantity'=>$rec->received_qty,
                'remaining_qty'=>$remaining_qty,
                'series'=>'2',
                'method'=>'Expired',
            );

            $data['balance'][] = array(
                'series'=>'2',
                'method'=>'Expired',
                'quantity'=>$rec->received_qty,
                'remaining_qty'=>$remaining_qty,
                'date'=>$rec->receive_date,
                'create_date'=>$rec->create_date
            );
        }*/

        foreach($this->super_model->custom_query("SELECT * FROM sales_good_head sh INNER JOIN sales_good_details sd ON sh.sales_good_head_id = sd.sales_good_head_id WHERE item_id = '$item_id' AND saved='1'") AS $sal){
            $in_id = $this->super_model->select_column_where("fifo_out","in_id","sales_details_id",$sal->sales_good_det_id);
            $brand = $this->super_model->select_column_where("fifo_in","brand","in_id",$in_id);
            $catalog_no = $this->super_model->select_column_where("fifo_in","catalog_no","in_id",$in_id);
            $client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $sal->client_id);
            $total_cost = $sal->quantity*$sal->unit_cost;
            $data['stockcard'][]=array(
                'date'=>$sal->sales_date,
                'create_date'=>$sal->create_date,
                'supplier'=>$client,
                'pr_no'=>$sal->pr_no,
                'po_no'=>$sal->po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$sal->quantity,
                'remaining_qty'=>'',
                'series'=>'3',
                'method'=>'Sales Good',
            );

            $data['balance'][] = array(
                'series'=>'3',
                'method'=>'Sales Good',
                'quantity'=>$sal->quantity,
                'remaining_qty'=>'',
                'date'=>$sal->sales_date,
                'create_date'=>$sal->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM sales_services_head sh INNER JOIN sales_serv_items si ON sh.sales_serv_head_id = si.sales_serv_head_id WHERE item_id = '$item_id' AND saved='1'") AS $sas){
            $in_id = $this->super_model->select_column_where("fifo_out","in_id","sales_serv_items_id",$sas->sales_serv_items_id);
            $brand = $this->super_model->select_column_where("fifo_in","brand","in_id",$in_id);
            $catalog_no = $this->super_model->select_column_where("fifo_in","catalog_no","in_id",$in_id);
            $client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $sas->client_id);
            $total_cost = $sas->quantity*$sas->unit_cost;
            $data['stockcard'][]=array(
                'date'=>$sas->sales_date,
                'create_date'=>$sas->create_date,
                'supplier'=>$client,
                'pr_no'=>$sas->jor_no,
                'po_no'=>$sas->joi_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$sas->quantity,
                'remaining_qty'=>'',
                'series'=>'4',
                'method'=>'Sales Services',
            );

            $data['balance'][] = array(
                'series'=>'4',
                'method'=>'Sales Services',
                'quantity'=>$sas->quantity,
                'remaining_qty'=>'',
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
                'remaining_qty'=>'',
                'series'=>'5',
                'method'=>'Damaged',
            );

            $data['balance'][] = array(
                'series'=>'5',
                'method'=>'Damaged',
                'quantity'=>$dam->damage_qty,
                'remaining_qty'=>'',
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
                'remaining_qty'=>'',
                'series'=>'6',
                'method'=>'Repaired',
            );

            $data['balance'][] = array(
                'series'=>'6',
                'method'=>'Repaired',
                'quantity'=>$rep->quantity,
                'remaining_qty'=>'',
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
                'remaining_qty'=>'',
                'series'=>'7',
                'method'=>'Return',
            );

            $data['balance'][] = array(
                'series'=>'7',
                'method'=>'Return',
                'quantity'=>$ret->return_qty,
                'remaining_qty'=>'',
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

    public function item_pr(){
        $item_id = $this->uri->segment(3);
        $data['item_name']=$this->super_model->select_column_where("items","item_name","item_id",$item_id);
        $data['item']=$this->super_model->select_all_order_by("items","item_name","ASC");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->custom_query("SELECT pr_no, quantity,item_id, remaining_qty,in_id FROM fifo_in WHERE item_id = '$item_id' GROUP BY pr_no") AS $head){
            //$sales_serv_qty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND transaction_type='Sales Services'");
            $sales_qty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND (transaction_type = 'Sales Goods' OR transaction_type='Sales Services')");
            $return_qty= $this->super_model->select_sum_where("return_details","return_qty","in_id='$head->in_id'");
            $damageqty= $this->super_model->select_sum_where("damage_details","damage_qty","in_id='$head->in_id'");
            $in_balance = $head->quantity - $sales_qty;
            if($sales_qty ==0 && $return_qty==0 && $damageqty==0){
                $final_balance = $head->quantity;
            } else if($sales_qty!=0  && $return_qty==0 && $damageqty==0){
                $final_balance = $head->quantity - $sales_qty;
            } else if($sales_qty!=0  && $return_qty!=0 && $damageqty==0){
                $final_balance =  $in_balance + $return_qty; 
            }else if($sales_qty!=0 && $return_qty!=0 && $damageqty!=0){
                $final_balance =  $head->quantity - $damageqty; 
            } else if(($sales_qty!=0 && $return_qty!=0 && $damageqty==0) || ($sales_qty!=0 && $return_qty==0 && $damageqty==0)){
                $final_balance = ($head->quantity + $return_qty) - $sales_qty; 
            }
            $data['item_pr'][] = array(
                "prno"=>$head->pr_no,
                "recqty"=>$head->quantity,
                "sales_quantity"=>$sales_qty,
                "returnqty"=>$return_qty,
                "damageqty"=>$damageqty,
                "in_balance"=>$in_balance,
                "final_balance"=>$final_balance
            );
        }
        $this->load->view('reports/item_pr',$data);
        $this->load->view('template/footer');
    }

    public function aging_report()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/aging_report');
        $this->load->view('template/footer');
    }

    public function inventory_balance($itemid){
        $recqty= $this->super_model->select_sum_join("received_qty","receive_items","receive_head", "item_id='$itemid' AND saved='1'","receive_id");
        $sales_good_qty= $this->super_model->select_sum_join("quantity","sales_good_details","sales_good_head", "item_id='$itemid' AND saved='1'","sales_good_head_id");
        $sales_services_qty= $this->super_model->select_sum_join("quantity","sales_serv_items","sales_services_head", "item_id='$itemid' AND saved='1'","sales_serv_head_id");
        $return_qty= $this->super_model->select_sum_where("return_details","return_qty","item_id='$itemid'");
        $damage_qty= $this->super_model->select_sum_join("damage_qty","damage_details","damage_head", "item_id='$itemid'","damage_id");
        $balance=($recqty+$return_qty)-$sales_good_qty-$sales_services_qty-$damage_qty;
        return $balance;
    }

    public function inventory_rangedate(){
        $data['category']=$this->super_model->select_all_order_by("item_categories","cat_name","ASC");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $from = $this->uri->segment(3);
        $to = $this->uri->segment(4);
        $cat = $this->uri->segment(5);
        $subcat = $this->uri->segment(6);
        $sql="";
        if($from!='null' && $to!='null'){
           $sql.= " rh.receive_date BETWEEN '$from' AND '$to' AND";
        }

        if($cat!='null'){
            $sql.= " i.category_id = '$cat' AND";
        }

        if($subcat!='null'){
            $sql.= " i.subcat_id = '$subcat' AND";
        }

        $query=substr($sql,0,-3);
        $data['head']=array();
        foreach($this->super_model->custom_query("SELECT DISTINCT rh.*,i.item_id  FROM receive_head rh INNER JOIN receive_items ri ON rh.receive_id = ri.receive_id INNER JOIN items i ON ri.item_id = i.item_id WHERE rh.saved='1' AND ".$query." GROUP BY item_name ORDER BY i.item_name ASC") AS $head){
            $item = $this->super_model->select_column_where('items', 'item_name', 'item_id', $head->item_id);
            $pn = $this->super_model->select_column_where('items', 'original_pn', 'item_id', $head->item_id);
            $totalqty=$this->inventory_balance($head->item_id);
            $data['head'][] = array(
                'item'=>$item,
                'pn'=>$pn,
                'total'=>$totalqty
            );          
        }
        $this->load->view('reports/inventory_rangedate',$data);
        $this->load->view('template/footer');
    }

    public function get_subcat(){
        $cat = $this->input->post('category');
        echo '<option value="">-Select Sub Category-</option>';
        foreach($this->super_model->select_custom_where('item_subcat', "cat_id='$cat' ORDER BY subcat_name ASC") AS $row){
            echo '<option value="'. $row->subcat_id .'">'. $row->subcat_name .'</option>';
      
         }
    }

}