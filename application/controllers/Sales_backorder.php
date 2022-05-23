<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_backorder extends CI_Controller {

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
    public function backorder_qty_goods($sales_id){
        $expectedqty = $this->super_model->select_sum("sales_good_details", "expected_qty", "sales_good_head_id", $sales_id);
        $recqty = $this->super_model->select_column_where("sales_good_details", "quantity", "sales_good_head_id", $sales_id);
        $bo_qty = $expectedqty-$recqty;
        return $bo_qty;
    }

    public function backorder_qty_services($sales_id){
        $expectedqty = $this->super_model->select_sum("sales_serv_items", "expected_qty", "sales_serv_head_id", $sales_id);
        $recqty = $this->super_model->select_column_where("sales_serv_items", "quantity", "sales_serv_head_id", $sales_id);
        $bo_qty = $expectedqty-$recqty;
        return $bo_qty;
    }

    public function get_expected_qty_goods($dr,$item){
        $expected_qty = $this->super_model->select_sum_join("expected_qty","sales_good_details","sales_good_head", "dr_no = '$dr' AND bo='0'","sales_good_head_id");
        return $expected_qty;
    }

     public function get_received_qty_goods($dr,$item){
        $received_qty = $this->super_model->select_sum_join("quantity","sales_good_details","sales_good_head", "dr_no = '$dr' AND bo='0'","sales_good_head_id");
        return $received_qty;
    }

    public function get_expected_qty_services($dr,$item){
        $expected_qty = $this->super_model->select_sum_join("expected_qty","sales_serv_items","sales_services_head", "dr_no = '$dr' AND bo='0'","sales_serv_head_id");
        return $expected_qty;
    }

     public function get_received_qty_services($dr,$item){
        $received_qty = $this->super_model->select_sum_join("quantity","sales_serv_items","sales_services_head", "dr_no = '$dr' AND bo='0'","sales_serv_head_id");
        return $received_qty;
    }

    public function backorder_form(){
        $sales_id=$this->uri->segment(3);
        $transaction_type = $this->uri->segment(4);
        $data['id']=$sales_id;
        $data['type']=$transaction_type;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        //foreach($this->super_model->select_all_order_by("sales_good_head","dr_no","ASC") AS $dr){
        foreach($this->super_model->custom_query("SELECT DISTINCT dr_no, item_id,  sd.sales_good_head_id FROM sales_good_details sd INNER JOIN sales_good_head sh ON sd.sales_good_head_id = sh.sales_good_head_id WHERE saved='1' AND bo='0' GROUP BY dr_no") AS $dr){
            //$quantity = $this->super_model->select_column_where("sales_good_details", "quantity", "sales_good_head_id", $dr->sales_good_head_id);
            //$expected_qty = $this->super_model->select_column_where("sales_good_details", "expected_qty", "sales_good_head_id", $dr->sales_good_head_id);
             //if($quantity<$expected_qty && $quantity!=$expected_qty){
            $expected_qty= $this->get_expected_qty_goods($dr->dr_no,$dr->item_id);
            $received_qty= $this->get_received_qty_goods($dr->dr_no,$dr->item_id);
            if($expected_qty>$received_qty){
                $data['dr_no'][]=array(
                        "sales_id"=>$dr->sales_good_head_id,
                        "dr_no"=>$dr->dr_no,
                        "transaction_type"=>"Goods"
                );
            }   
        }

        //foreach($this->super_model->select_all_order_by("sales_services_head","dr_no","ASC") AS $drs){
        foreach($this->super_model->custom_query("SELECT DISTINCT dr_no, item_id, si.sales_serv_head_id FROM sales_serv_items si INNER JOIN sales_services_head sh ON si.sales_serv_head_id = sh.sales_serv_head_id WHERE saved='1' AND bo='0' GROUP BY dr_no") AS $drs){
            //$quantity = $this->super_model->select_column_where("sales_serv_items", "quantity", "sales_serv_head_id", $drs->sales_serv_head_id);
            //$expected_qty = $this->super_model->select_column_where("sales_serv_items", "expected_qty", "sales_serv_head_id", $drs->sales_serv_head_id);
             /*if($quantity<$expected_qty && $quantity!=$expected_qty){*/
            $expected_qty= $this->get_expected_qty_services($drs->dr_no,$drs->item_id);
            $received_qty= $this->get_received_qty_services($drs->dr_no,$drs->item_id);
            if($expected_qty>$received_qty){
                $data['dr_no'][]=array(
                        "sales_id"=>$drs->sales_serv_head_id,
                        "dr_no"=>$drs->dr_no,
                        "transaction_type"=>"Services"
                );
            }
        }
        if($transaction_type=='Goods'){
        foreach($this->super_model->select_row_where("sales_good_head","sales_good_head_id",$sales_id) AS $sh){
         $in_id = $this->super_model->select_column_where("fifo_out", "in_id", "sales_id", $sh->sales_good_head_id);
         $receive_id = $this->super_model->select_column_where("fifo_in", "receive_id", "in_id", $in_id);
         $purpose_id = $this->super_model->select_column_where("receive_details", "purpose_id", "receive_id", $receive_id);
            $data["head"][]=array(
                "pr_no"=>$sh->pr_no,
                "pr_date"=>$sh->pr_date,
                "client"=>$this->super_model->select_column_where("client","buyer_name","client_id",$sh->client_id),
                "purpose"=>$this->super_model->select_column_where("purpose","purpose_desc","purpose_id",$purpose_id),
                "po_no"=>$sh->po_no,
                "po_date"=>$sh->po_date,
                "sales_date"=>date('F d,Y',strtotime($sh->sales_date)),
                "dr_no"=>$sh->dr_no,
                "vat"=>$sh->vat,
                "type"=>$transaction_type,
                "remarks"=>$sh->remarks,
                "type"=>$transaction_type,
            );
        }
        foreach($this->super_model->select_custom_where("sales_good_head","sales_good_head_id = '$sales_id' AND saved='1'") AS $bo){
            $quantity = $this->super_model->select_column_where("sales_good_details", "quantity", "sales_good_head_id", $bo->sales_good_head_id);
            $expected_qty = $this->super_model->select_column_where("sales_good_details", "expected_qty", "sales_good_head_id", $bo->sales_good_head_id);
            $sales_good_det_id = $this->super_model->select_column_where("sales_good_details", "sales_good_det_id", "sales_good_head_id", $bo->sales_good_head_id);
            $item_id = $this->super_model->select_column_where("sales_good_details", "item_id", "sales_good_head_id", $bo->sales_good_head_id);
            $receive_id = $this->super_model->select_column_where("fifo_in", "receive_id", "in_id", $in_id);
            $supplier_id = $this->super_model->select_column_where("receive_items", "supplier_id", "receive_id", $receive_id);
            $item_cost = $this->super_model->select_column_where("sales_serv_items", "unit_cost", "sales_serv_head_id", $bo->sales_good_head_id);
            if($expected_qty > $quantity){
            $boqty=$this->backorder_qty_goods($bo->sales_good_head_id);
            $total_cost=$boqty * $item_cost;
             //if($quantity<$expected_qty && $quantity!=$expected_qty){
                $data['sales_backorder'][]=array(
                        "item"=>$this->super_model->select_column_where("items","item_name","item_id",$item_id),
                        "supplier"=>$this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id),
                        "serial_no"=>$this->super_model->select_column_where("receive_items", "serial_no", "receive_id", $receive_id),
                        "catalog_no"=>$this->super_model->select_column_where("receive_items", "catalog_no", "receive_id", $receive_id),
                        "brand"=>$this->super_model->select_column_where("receive_items", "brand", "receive_id", $receive_id),
                        "dr_no"=>$bo->dr_no,
                        "sales_item_id"=>$sales_good_det_id,
                        "po_no"=>$bo->po_no,
                        "pr_no"=>$bo->pr_no,
                        "item_cost"=>$item_cost,
                        "expected_qty"=>$expected_qty,
                        "quantity"=>$quantity,
                        "total_cost"=>$total_cost,
                );
            }
        }
    } else if($transaction_type=='Services'){
                foreach($this->super_model->select_row_where("sales_services_head","sales_serv_head_id", $sales_id) AS $sh){
                $in_id = $this->super_model->select_column_where("fifo_out", "in_id", "sales_id", $sh->sales_serv_head_id);
                $receive_id = $this->super_model->select_column_where("fifo_in", "receive_id", "in_id", $in_id);
                $purpose_id = $this->super_model->select_column_where("receive_details", "purpose_id", "receive_id", $receive_id);
            $data["head"][]=array(
                "pr_no"=>$sh->jor_no,
                "pr_date"=>$sh->jor_date,
                "client"=>$this->super_model->select_column_where("client","buyer_name","client_id",$sh->client_id),
                "purpose"=>$this->super_model->select_column_where("purpose","purpose_desc","purpose_id",$purpose_id),
                "po_no"=>$sh->joi_no,
                "po_date"=>$sh->joi_date,
                "sales_date"=>date('F d,Y',strtotime($sh->sales_date)),
                "dr_no"=>$sh->dr_no,
                "vat"=>$sh->vat,
                "type"=>$transaction_type,
                "remarks"=>$sh->remarks,
                "type"=>$transaction_type,
            );
        }
        foreach($this->super_model->select_custom_where("sales_services_head","sales_serv_head_id = '$sales_id' AND saved='1'") AS $bos){
            $quantity = $this->super_model->select_column_where("sales_serv_items", "quantity", "sales_serv_head_id", $bos->sales_serv_head_id);
            $expected_qty = $this->super_model->select_column_where("sales_serv_items", "expected_qty", "sales_serv_head_id", $bos->sales_serv_head_id);
            $sales_serv_head_id = $this->super_model->select_column_where("sales_serv_items", "sales_serv_head_id", "sales_serv_head_id", $bos->sales_serv_head_id);
            $item_id = $this->super_model->select_column_where("sales_serv_items", "item_id", "sales_serv_head_id", $bos->sales_serv_head_id);
            $receive_id = $this->super_model->select_column_where("fifo_in", "receive_id", "in_id", $in_id);
            $supplier_id = $this->super_model->select_column_where("receive_items", "supplier_id", "receive_id", $receive_id);
            $item_cost = $this->super_model->select_column_where("sales_serv_items", "unit_cost", "sales_serv_head_id", $bos->sales_serv_head_id);
            if($expected_qty > $quantity){
            $boqty=$this->backorder_qty_services($bos->sales_serv_head_id);
            $total_cost=$boqty * $item_cost;
            //if($quantity<$expected_qty && $quantity!=$expected_qty){
                $data['sales_backorder'][]=array(
                        "item"=>$this->super_model->select_column_where("items","item_name","item_id",$item_id),
                        "supplier"=>$this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id),
                        "serial_no"=>$this->super_model->select_column_where("receive_items", "serial_no", "receive_id", $receive_id),
                        "catalog_no"=>$this->super_model->select_column_where("receive_items", "catalog_no", "receive_id", $receive_id),
                        "brand"=>$this->super_model->select_column_where("receive_items", "brand", "receive_id", $receive_id),
                        "dr_no"=>$bos->dr_no,
                        "sales_item_id"=>$sales_serv_head_id,
                        "po_no"=>$bos->joi_no,
                        "pr_no"=>$bos->jor_no,
                        "item_cost"=>$item_cost,
                        "expected_qty"=>$expected_qty,
                        "quantity"=>$quantity,
                        "total_cost"=>$total_cost,
                );
            }
        }
    }
        $this->load->view('sales_backorder/backorder_form',$data);
        $this->load->view('template/footer');
    }

    public function dr_append(){
        $sales_id = $this->input->post('sales_id');
        $transaction_type = $this->input->post('transaction_type');
        if($transaction_type='Goods'){
            foreach($this->super_model->custom_query("SELECT sales_good_head_id FROM sales_good_head WHERE sales_good_head_id = '$sales_id' AND saved = '1'") AS $mr){ 
                $return = array('sales_id' => $mr->sales_good_head_id); 
                echo json_encode($return);   
            }
        }else if($transaction_type='Services'){
            foreach($this->super_model->custom_query("SELECT sales_serv_head_id FROM sales_services_head WHERE sales_serv_head_id = '$sales_id' AND saved = '1'") AS $mr){ 
                $return = array('sales_id' => $mr->sales_serv_head_id); 
                echo json_encode($return);   
            }
        }
    }

    public function saveBackorder(){
        $sales_id= $this->input->post('sales_id');
        $type= $this->input->post('transaction_type');
        $sales_item_id= $this->input->post('sales_item_id');
        $userid = $_SESSION['user_id'];
        $now=date('Y-m-d H:i:s');
        $year_series=date('Y');
        $salesbodate=$this->input->post('salesbo_date')." ".date("H:i:s");

        if($type=='Goods'){

        $rows=$this->super_model->count_custom_where("sales_good_head","create_date LIKE '$year_series%'");
        if($rows==0){
             $dr_no = "PROBCD-".$year_series."-DR-0001";
        } else {
            $maxdr_no=$this->super_model->get_max_where("sales_good_head", "dr_no","create_date LIKE '$year_series%'");
            $drno = explode('-',$maxdr_no);
            $series = $drno[3]+1;
            if(strlen($series)==1){
                $dr_no = "PROBCD-".$year_series."-DR-000".$series;
            } else if(strlen($series)==2){
                 $dr_no = "PROBCD-".$year_series."-DR-00".$series;
            } else if(strlen($series)==3){
                 $dr_no = "PROBCD-".$year_series."-DR-0".$series;
            } else if(strlen($series)==4){
                 $dr_no = "PROBCD-".$year_series."-DR-".$series;
            }
        }

        $head_rows = $this->super_model->count_rows("sales_good_head");
        if($head_rows==0){
            $salesid=1;
        } else {
            $maxid=$this->super_model->get_max("sales_good_head", "sales_good_head_id");
            $salesid=$maxid+1;
        }

        foreach($this->super_model->select_row_where("sales_good_head", "sales_good_head_id", $sales_id) AS $sg){
              
            $data = array(
                  'sales_good_head_id'=>$salesid,
                   'create_date'=> $now,
                   'sales_date'=> $salesbodate,
                   'dr_no'=> $dr_no,
                   'pr_no'=>$sg->pr_no,
                   'pr_date'=>$sg->pr_date,
                   'client_id'=>$sg->client_id,
                   'po_no'=>$sg->po_no,
                   'po_date'=>$sg->po_date,
                   'vat'=>$sg->vat,
                   'remarks'=>$sg->remarks,
                   'user_id'=> $userid,
                   'saved'=>'1',
                   'backorder'=>'1'

            );
            $this->super_model->insert_into("sales_good_head", $data);
        }

        $counter = $this->input->post('count');
        for($a=0;$a<$counter;$a++){
            $quantity=$this->input->post('quantity['.$a.']');
            $unit_cost= $this->input->post('item_cost['.$a.']');
            //$total=$quantity*$unit_cost;
             foreach($this->super_model->select_row_where("sales_good_details", "sales_good_det_id", $this->input->post('sales_item_id['.$a.']')) AS $sd){
           
                $items = array(
                'sales_good_head_id'=> $salesid,
                'item_id'=> $sd->item_id,
                'selling_price'=> $sd->selling_price,
                'discount_percent'=> $sd->discount_percent,
                'discount_amount'=> $sd->discount_amount,
                //'serial_no'=>$this->input->post('serial_no['.$a.']'),
                'unit_cost'=> $unit_cost,
                'expected_qty'=>$this->input->post('expqty['.$a.']'),
                'quantity'=>$quantity,
                'remarks'=> $this->input->post('remarks['.$a.']'),
                'total'=> $this->input->post('total_cost['.$a.']'),
            );
            
           $sales_item_id = $this->super_model->insert_return_id("sales_good_details", $items);

                $bo_data = array(
                    'bo'=>1
                ); 
                $this->super_model->update_where("sales_good_details", $bo_data, "sales_good_det_id", $sd->sales_good_det_id);
                
                }
            foreach($this->super_model->select_row_where("fifo_out", "sales_id", $sales_id) AS $so){
                $fifo_items = array(
                'in_id'=>$so->in_id,
                'item_id'=>$so->item_id,
                'selling_price'=>$so->selling_price,
                'unit_cost'=>$unit_cost,
                'transaction_type'=>'Sales Goods',
                'sales_id'=>$salesid,
                'sales_details_id'=>$sales_item_id,
                'damage_id'=>0,
                'quantity'=>$quantity,
                'remaining_qty'=>$quantity,
            );
            
            $this->super_model->insert_into("fifo_out",$fifo_items);

            }
    }
    } else if($type=='Services') {
        $rows=$this->super_model->count_custom_where("sales_services_head","create_date LIKE '$year_series%'");
        if($rows==0){
             $data['dr_no'] = "PROBCD-".$year_series."-AR-0001";
        } else {
            $maxdr_no=$this->super_model->get_max_where("sales_services_head", "dr_no","create_date LIKE '$year_series%'");
            $drno = explode('-',$maxdr_no);
            $series = $drno[3]+1;
            if(strlen($series)==1){
                $dr_no = "PROBCD-".$year_series."-AR-000".$series;
            } else if(strlen($series)==2){
                 $dr_no = "PROBCD-".$year_series."-AR-00".$series;
            } else if(strlen($series)==3){
                 $dr_no = "PROBCD-".$year_series."-AR-0".$series;
            } else if(strlen($series)==4){
                 $dr_no = "PROBCD-".$year_series."-AR-".$series;
            }
        }

        $head_rows = $this->super_model->count_rows("sales_services_head");
        if($head_rows==0){
            $salesid=1;
        } else {
            $maxid=$this->super_model->get_max("sales_services_head", "sales_serv_head_id");
            $salesid=$maxid+1;
        }

        foreach($this->super_model->select_row_where("sales_services_head", "sales_serv_head_id", $sales_id) AS $sg){
              
            $data = array(
                  'sales_serv_head_id'=>$salesid,
                   'create_date'=> $now,
                   'sales_date'=> $salesbodate,
                   'dr_no'=> $dr_no,
                   'jor_no'=>$sg->jor_no,
                   'jor_date'=>$sg->jor_date,
                   'joi_no'=>$sg->joi_no,
                   'joi_date'=>$sg->joi_date,
                   'vat'=>$sg->vat,
                   'purpose'=>$sg->purpose,
                   'ar_description'=>$sg->ar_description,
                   'shipped_via'=>$sg->shipped_via,
                   'waybill_no'=>$sg->waybill_no,
                   'remarks'=>$sg->remarks,
                   'user_id'=> $userid,
                   'saved'=>'1',
                   'backorder'=>'1'

            );
            $this->super_model->insert_into("sales_services_head", $data);
        }

        $counter = $this->input->post('count');
        for($a=0;$a<$counter;$a++){
            $quantity=$this->input->post('quantity['.$a.']');
            $unit_cost= $this->input->post('item_cost['.$a.']');
            //$total=$quantity*$unit_cost;
             foreach($this->super_model->select_row_where("sales_serv_items", "sales_serv_items_id", $this->input->post('sales_item_id['.$a.']')) AS $sd){
           
                $items = array(
                'sales_serv_head_id'=> $salesid,
                'item_id'=> $sd->item_id,
                'selling_price'=> $sd->selling_price,
                'discount_percent'=> $sd->discount_percent,
                'discount_amount'=> $sd->discount_amount,
                'group_id'=> $sd->group_id,
                //'serial_no'=>$this->input->post('serial_no['.$a.']'),
                'unit_cost'=> $this->input->post('item_cost['.$a.']'),
                'expected_qty'=>$this->input->post('expqty['.$a.']'),
                'quantity'=>$quantity,
                'remarks'=> $this->input->post('remarks['.$a.']'),
                'total'=> $this->input->post('total_cost['.$a.']'),
            );
            
           $sales_item_id = $this->super_model->insert_return_id("sales_serv_items", $items);

                $bo_data = array(
                    'bo'=>1
                ); 
                $this->super_model->update_where("sales_serv_items", $bo_data, "sales_serv_items_id", $sd->sales_serv_items_id);
                
            }
            foreach($this->super_model->select_row_where("fifo_out", "sales_id", $sales_id) AS $so){
                $fifo_items = array(
                'in_id'=>$so->in_id,
                'item_id'=>$so->item_id,
                'selling_price'=>$so->selling_price,
                'unit_cost'=>$unit_cost,
                'transaction_type'=>'Sales Services',
                'sales_id'=>$salesid,
                'sales_serv_items_id'=>$sales_item_id,
                'damage_id'=>0,
                'quantity'=>$quantity,
                'remaining_qty'=>$quantity,
            );
            
            $this->super_model->insert_into("fifo_out",$fifo_items);
            }
        }
    }

        echo $salesid;

    }

    public function print_backorder(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales_backorder/print_backorder');
        $this->load->view('template/footer');
    }




}