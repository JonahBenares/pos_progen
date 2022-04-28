<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returns extends CI_Controller {

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

    public function return_goods_services(){
        $sales_id=$this->uri->segment(3);
        $transaction_type = $this->uri->segment(4);
        $data['id']=$sales_id;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->select_all_order_by("sales_good_head","dr_no","ASC") AS $dr){
            $data['dr_no'][]=array(
                    "sales_id"=>$dr->sales_good_head_id,
                    "dr_no"=>$dr->dr_no,
                    "transaction_type"=>"Goods"
            );
        }

        foreach($this->super_model->select_all_order_by("sales_services_head","dr_no","ASC") AS $drs){
            $data['dr_no'][]=array(
                    "sales_id"=>$drs->sales_serv_head_id,
                    "dr_no"=>$drs->dr_no,
                    "transaction_type"=>"Services"
            );
        }
        if($transaction_type=='Goods'){
        foreach($this->super_model->select_row_where("sales_good_head","sales_good_head_id",$sales_id) AS $sh){
         
            $data["head"][]=array(
                "pr_no"=>$sh->pr_no,
                "pr_date"=>$sh->pr_date,
                "client"=>$this->super_model->select_column_where("client","buyer_name","client_id",$sh->client_id),
                "po_no"=>$sh->po_no,
                "po_date"=>$sh->po_date,
                "sales_date"=>date('F d,Y',strtotime($sh->sales_date)),
                "dr_no"=>$sh->dr_no,
                "vat"=>$sh->vat,
                "type"=>$transaction_type,
                "remarks"=>$sh->remarks
            );
            foreach($this->super_model->select_custom_where("fifo_out","sales_id='$sh->sales_good_head_id' AND transaction_type='Sales Goods'") AS $itm){
                $supplier_id = $this->super_model->select_column_where("fifo_in","supplier_id","in_id",$itm->in_id);
                $unit_cost = $this->super_model->select_column_where("fifo_in", "item_cost", "in_id", $itm->in_id);
                $selling_price = $this->super_model->select_column_where("sales_good_details", "selling_price", "sales_good_det_id", $itm->sales_details_id);
                //$qty = $itm->quantity - $itm->remaining_qty;
                $data['item'][]=array(
                    "in_id"=>$itm->in_id,
                    "item"=>$this->super_model->select_column_where("items","item_name","item_id",$itm->item_id),
                    "item_id"=>$itm->item_id,
                    "sales_details_id"=>$itm->sales_details_id,
                    "qty"=>$itm->remaining_qty,
                    "unit_cost"=>$unit_cost,
                    "selling_price"=>$selling_price,
                    "transaction_type"=>$transaction_type,
                    "supplier"=>$this->super_model->select_column_where("supplier","supplier_name","supplier_id",$supplier_id),
                    "brand"=>$this->super_model->select_column_where("fifo_in","brand","in_id",$itm->in_id),
                    "catalog_no"=>$this->super_model->select_column_where("fifo_in","catalog_no","in_id",$itm->in_id),
                    "serial_no"=>$this->super_model->select_column_where("fifo_in","serial_no","in_id",$itm->in_id),
                );
            }
        }
    } else if($transaction_type=='Services'){
                foreach($this->super_model->select_row_where("sales_services_head","sales_serv_head_id",$sales_id) AS $sh){
         
            $data["head"][]=array(
                "pr_no"=>$sh->jor_no,
                "pr_date"=>$sh->jor_date,
                "client"=>$this->super_model->select_column_where("client","buyer_name","client_id",$sh->client_id),
                "po_no"=>$sh->joi_no,
                "po_date"=>$sh->joi_date,
                "sales_date"=>date('F d,Y',strtotime($sh->sales_date)),
                "dr_no"=>$sh->dr_no,
                "vat"=>$sh->vat,
                "type"=>$transaction_type,
                "remarks"=>$sh->remarks
            );
            foreach($this->super_model->select_custom_where("fifo_out","sales_id='$sh->sales_serv_head_id' AND transaction_type='Sales Services'") AS $itm){
                $supplier_id = $this->super_model->select_column_where("fifo_in","supplier_id","in_id",$itm->in_id);
                $unit_cost = $this->super_model->select_column_where("fifo_in", "item_cost", "in_id", $itm->in_id);
                $selling_price = $this->super_model->select_column_where("sales_serv_items", "selling_price", "sales_serv_items_id", $itm->sales_serv_items_id);
                $part_no=$this->super_model->select_column_where("items","item_name","item_id",$itm->item_id);
                $qty = $itm->quantity - $itm->remaining_qty;
                $data['item'][]=array(
                    "in_id"=>$itm->in_id,
                    "item"=>$this->super_model->select_column_where("items","item_name","item_id",$itm->item_id),
                    "item_id"=>$itm->item_id,
                    "sales_details_id"=>$itm->sales_serv_items_id,
                    "qty"=>$itm->remaining_qty,
                    "unit_cost"=>$unit_cost,
                    "selling_price"=>$selling_price,
                    "part_no"=>$part_no,
                    "transaction_type"=>$transaction_type,
                    "supplier"=>$this->super_model->select_column_where("supplier","supplier_name","supplier_id",$supplier_id),
                    "brand"=>$this->super_model->select_column_where("fifo_in","brand","in_id",$itm->in_id),
                    "catalog_no"=>$this->super_model->select_column_where("fifo_in","catalog_no","in_id",$itm->in_id),
                    "serial_no"=>$this->super_model->select_column_where("fifo_in","serial_no","in_id",$itm->in_id),
                );
            }
        }
    }
        $this->load->view('returns/return_goods_services',$data);
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

    public function save_return(){
        $transaction_type = $this->input->post('transaction_type');
        $head_rows = $this->super_model->count_rows("return_head");
          $count=$this->input->post('count');
        if($head_rows==0){
            $return_id=1;
        } else {
            $maxid=$this->super_model->get_max("return_head", "return_id");
            $return_id=$maxid+1;
        }
        $drno = $this->input->post('dr_save');

        $datains=array(
            "return_id"=>$return_id,
            "dr_no"=>$this->input->post('dr_save'),
            "return_date"=>$this->input->post('return_date')." ".date("H:i:s"),
            "transaction_type"=>$transaction_type,
            "create_date"=>date("Y-m-d H:i:s"),
            "user_id"=>$_SESSION['user_id'],
            "description"=>$this->input->post('desc_remarks'),
        );
        $this->super_model->insert_into("return_head",$datains);

          
            for($x=1;$x<$count;$x++){
                $in_id= $this->input->post('in_id'.$x);
                $qty =$this->input->post('return_qty'.$x);
                $dam_qty =$this->input->post('damage_qty'.$x);
                $ret_qty =$this->input->post('qty'.$x);
                $item_id =$this->input->post('item_id'.$x);
                $unit_cost =$this->input->post('unit_cost'.$x);
                $selling_price =$this->input->post('selling_price'.$x);

                //echo $qty . " - " . $dam_qty;
              
                if( $qty !=0 && $dam_qty ==""){
                    $total_cost =$selling_price * $qty;
                    $datadet=array(
                        "return_id"=>$return_id,
                        "item_id"=>$item_id,
                        "in_id"=>$in_id,
                        "return_qty"=>$qty,
                        "unit_cost"=>$unit_cost,
                        "selling_price"=>$selling_price,
                        "total_amount"=>$total_cost,
                        "remarks"=>$this->input->post('remarks'.$x)
                    );
                    if($this->super_model->insert_into("return_details",$datadet)){
                        $rem_qty = $this->super_model->select_column_where("fifo_in","remaining_qty","in_id",$in_id);
                        $new_qty = $rem_qty + $qty;
                        $dataup=array(
                            'remaining_qty'=>$new_qty
                        );
                        if($this->super_model->update_where("fifo_in", $dataup, "in_id", $in_id)){
                            $sales_details_id = $this->input->post('sales_details_id'.$x);
                            $new_qty_out = $ret_qty - $qty;

                            if ($transaction_type=='Goods') {
                            $dataout=array(
                                "remaining_qty"=>$new_qty_out
                            );
                            $this->super_model->update_custom_where("fifo_out", $dataout, "in_id='$in_id' AND sales_details_id='$sales_details_id'");

                            $dataret=array(
                                "return_id"=>$return_id,
                            );
                             $this->super_model->update_custom_where("sales_good_details", $dataret, "sales_good_det_id='$sales_details_id'");

                            }elseif ($transaction_type=='Services') {
                            $dataout=array(
                                "remaining_qty"=>$new_qty_out
                            );
                            $this->super_model->update_custom_where("fifo_out", $dataout, "in_id='$in_id' AND sales_serv_items_id='$sales_details_id'");

                            $dataret=array(
                                "return_id"=>$return_id,
                            );
                             $this->super_model->update_custom_where("sales_serv_items", $dataret, "sales_serv_items_id='$sales_details_id'");
                            }
                        }
                    }
                }

                else  if( $qty =="" && $dam_qty != 0){
                     $total_cost =$selling_price * $dam_qty;
                     $datadet=array(
                        "return_id"=>$return_id,
                        "item_id"=>$item_id,
                        "in_id"=>$in_id,
                        "damage_qty"=>$dam_qty,
                        "unit_cost"=>$unit_cost,
                        "selling_price"=>$selling_price,
                        "total_amount"=>$total_cost,
                        "remarks"=>$this->input->post('remarks'.$x)
                    );
                    if($this->super_model->insert_into("return_details",$datadet)){
                        $rem_qty = $this->super_model->select_column_where("fifo_in","remaining_qty","in_id",$in_id);
                        $new_qty = $rem_qty + $dam_qty;
                        $dataup=array(
                            'remaining_qty'=>$new_qty
                        );
                        if($this->super_model->update_where("fifo_in", $dataup, "in_id", $in_id)){
                            $sales_details_id = $this->input->post('sales_details_id'.$x);
                            $new_qty_out = $ret_qty - $dam_qty;

                            if ($transaction_type=='Goods') {
                            $dataout=array(
                                "remaining_qty"=>$new_qty_out
                            );
                            $this->super_model->update_custom_where("fifo_out", $dataout, "in_id='$in_id' AND sales_details_id='$sales_details_id'");

                            $dataret=array(
                                "return_id"=>$return_id,
                            );
                             $this->super_model->update_custom_where("sales_good_details", $dataret, "sales_good_det_id='$sales_details_id'");

                            }elseif ($transaction_type=='Services') {
                            $dataout=array(
                                "remaining_qty"=>$new_qty_out
                            );
                            $this->super_model->update_custom_where("fifo_out", $dataout, "in_id='$in_id' AND sales_serv_items_id='$sales_details_id'");

                            $dataret=array(
                                "return_id"=>$return_id,
                            );
                             $this->super_model->update_custom_where("sales_serv_items", $dataret, "sales_serv_items_id='$sales_details_id'");
                            }
                        }
                    }
                }

                else  if( $qty !=0 && $dam_qty != 0){
                    $totqty  =$qty*$dam_qty;
                     $total_cost =$selling_price * $totqty;
                     $datadet=array(
                        "return_id"=>$return_id,
                        "item_id"=>$item_id,
                        "in_id"=>$in_id,
                        "return_qty"=>$qty,
                        "damage_qty"=>$dam_qty,
                        "unit_cost"=>$unit_cost,
                        "selling_price"=>$selling_price,
                        "total_amount"=>$total_cost,
                        "remarks"=>$this->input->post('remarks'.$x)
                    );
                    if($this->super_model->insert_into("return_details",$datadet)){
                        $rem_qty = $this->super_model->select_column_where("fifo_in","remaining_qty","in_id",$in_id);
                        $new_qty = $rem_qty + $dam_qty + $qty;
                        $dataup=array(
                            'remaining_qty'=>$new_qty
                        );
                        if($this->super_model->update_where("fifo_in", $dataup, "in_id", $in_id)){
                            $sales_details_id = $this->input->post('sales_details_id'.$x);
                            $new_qty_out = $ret_qty - $dam_qty - $qty;

                            if ($transaction_type=='Goods') {
                            $dataout=array(
                                "remaining_qty"=>$new_qty_out
                            );
                            $this->super_model->update_custom_where("fifo_out", $dataout, "in_id='$in_id' AND sales_details_id='$sales_details_id'");

                            $dataret=array(
                                "return_id"=>$return_id,
                            );
                             $this->super_model->update_custom_where("sales_good_details", $dataret, "sales_good_det_id='$sales_details_id'");

                            }elseif ($transaction_type=='Services') {
                            $dataout=array(
                                "remaining_qty"=>$new_qty_out
                            );
                            $this->super_model->update_custom_where("fifo_out", $dataout, "in_id='$in_id' AND sales_serv_items_id='$sales_details_id'");

                            $dataret=array(
                                "return_id"=>$return_id,
                            );
                             $this->super_model->update_custom_where("sales_serv_items", $dataret, "sales_serv_items_id='$sales_details_id'");
                            }
                        }
                    }
                }
            
           
            }
             $this->billing_statement_adjustment($drno,$return_id);
             echo $return_id;
    }

    public function billing_statement_adjustment($drno,$return_id){
        $check_billing = $this->super_model->count_custom("SELECT bh.billing_id FROM billing_head bh INNER JOIN billing_details bd ON bh.billing_id = bd.billing_id WHERE status = '0' AND dr_no = '$drno'");
        if($check_billing!=0){
            $billing_id = $this->super_model->select_column_where("billing_details", "billing_id", "dr_no", $drno);
            $billing_no = $this->super_model->select_column_where("billing_head", "billing_no", "billing_id", $billing_id);
            $returned ='';
            $total_price=0;
            foreach($this->super_model->select_row_where("return_details","return_id",$return_id) AS $ret){
                $total = $ret->return_qty + $ret->damage_qty;
                $total_price += $ret->total_amount;
                $returned .= $total . " " . $this->super_model->select_column_where("items", "item_name", "item_id", $ret->item_id) . ", ";
            }
            $returned = substr($returned, 0, -2);
          
            $remarks = "Adjustment on Billing # ".$billing_no. " Returned " .$returned . " with total amount of ". number_format($total_price);
            $data=array(
                "adjustment_date"=>date("Y-m-d H:i:s"),
                "billing_id"=>$billing_id,
                "billing_no"=>$billing_no,
                "dr_no"=>$drno,
                "return_id"=>$return_id,
                "remarks"=>$remarks
            );

            $this->super_model->insert_into("billing_adjustment_history",$data);
        } 
    }

    public function print_return_goods_services(){
        $return_id=$this->uri->segment(3);
        $data['return_id']=$return_id;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->select_row_where("return_head","return_id",$return_id) AS $rh){
            $in_id = $this->super_model->select_column_where("return_details","in_id","return_id",$rh->return_id);
            $receive_id=$this->super_model->select_column_where("fifo_in","receive_id","in_id",$in_id);
            $department_id = $this->super_model->select_column_where("receive_details","department_id","receive_id",$receive_id);
            $department = $this->super_model->select_column_where("department","department_name","department_id",$department_id);
            $purpose_id = $this->super_model->select_column_where("receive_details","purpose_id","receive_id",$receive_id);
            $purpose = $this->super_model->select_column_where("purpose","purpose_desc","purpose_id",$purpose_id);


            if($rh->transaction_type=='Goods'){
                $dr_no = $this->super_model->select_column_where("sales_good_head","dr_no","dr_no",$rh->dr_no);
                $pr_no = $this->super_model->select_column_where("sales_good_head","pr_no","dr_no",$rh->dr_no);
                $client_id = $this->super_model->select_column_where("sales_good_head","client_id","dr_no",$rh->dr_no);
                $overall_remarks = $this->super_model->select_column_where("sales_good_head","remarks","dr_no",$rh->dr_no);
            }elseif ($rh->transaction_type=='Services') {
                $dr_no = $this->super_model->select_column_where("sales_services_head","dr_no","dr_no",$rh->dr_no);
                $pr_no = $this->super_model->select_column_where("sales_services_head","jor_no","dr_no",$rh->dr_no);
                $client_id = $this->super_model->select_column_where("sales_services_head","client_id","dr_no",$rh->dr_no);
                $overall_remarks = $this->super_model->select_column_where("sales_services_head","remarks","dr_no",$rh->dr_no);
            }

            $client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $client_id);

            $data['head'][]=array(
                "dr_no"=>$dr_no,
                "pr_no"=>$pr_no,
                "purpose"=>$purpose,
                "department"=>$department,
                "client"=>$client,
                "description"=>$rh->description,
                "type"=>$rh->transaction_type,
                "date"=>date("F d,Y",strtotime($rh->return_date))
            );
            foreach($this->super_model->select_row_where("return_details","return_id",$rh->return_id) AS $rd){
                $item_id=$this->super_model->select_column_where("fifo_in","item_id","in_id",$rd->in_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
                $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$item_id);
                $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$item_id);
                $brand=$this->super_model->select_column_where("fifo_in","brand","in_id",$rd->in_id);
                $supplier_id=$this->super_model->select_column_where("fifo_in","supplier_id","in_id",$rd->in_id);
                $supplier_name = $this->super_model->select_column_where("supplier","supplier_name","supplier_id",$supplier_id);
                $serial_no=$this->super_model->select_column_where("fifo_in","serial_no","in_id",$rd->in_id);
                $item_cost=$this->super_model->select_column_where("fifo_in","item_cost","in_id",$rd->in_id);
                $remaining_qty=$this->super_model->select_column_where("fifo_in","remaining_qty","in_id",$rd->in_id);
                $total=$rd->return_qty * $item_cost;
                $data["details"][]=array(
                    "quantity"=>$rd->return_qty + $rd->damage_qty,
                    "unit"=>$unit,
                    "original_pn"=>$original_pn,
                    "item"=>$item_name,
                    "brand"=>$brand,
                    "serial_no"=>$serial_no,
                    "unit_cost"=>$item_cost,
                    "total"=>$total,
                    "remaining_qty"=>$remaining_qty,
                    "remarks"=>$rd->remarks,
                    "remarks_head"=>$overall_remarks,
                );
            }
        }
        $data['client_id']=$client_id;
        $data['damage_qty'] = $this->super_model->select_sum_where("return_details", "damage_qty", "return_id = '$return_id'");
        $data['adjustment_qty'] = $this->super_model->count_custom_where("billing_adjustment_history", "return_id='$return_id' AND status='0'");
        $this->load->view('returns/print_return_goods_services',$data);
        $this->load->view('template/footer');
    }

    public function return_damage(){
        $return_id=$this->uri->segment(3);
        $data['employees']=$this->super_model->select_all_order_by("employees",'employee_name',"ASC");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
         foreach($this->super_model->select_row_where('return_details','return_id',$return_id) AS $ret_dam){
            $item_id=$this->super_model->select_column_where("fifo_in","item_id","in_id",$ret_dam->in_id);
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
            $part_no = $this->super_model->select_column_where("items","original_pn","item_id",$item_id);
            $brand = $this->super_model->select_column_where("fifo_in","brand","in_id",$ret_dam->in_id);
            $serial_no = $this->super_model->select_column_where("fifo_in","serial_no","in_id",$ret_dam->in_id);
            $acquisition_date = $this->super_model->select_column_where("fifo_in","receive_date","in_id",$ret_dam->in_id);
            $acquisition_cost = $this->super_model->select_column_where("fifo_in","item_cost","in_id",$ret_dam->in_id);
            $data['details'][]=array(
                'in_id'=>$ret_dam->in_id,
                'damage_qty'=>$ret_dam->damage_qty,
                'in_id'=>$ret_dam->in_id,
                'return_id'=>$return_id,
                'item_id'=>$item_id,
                'item_name'=>$item_name,
                'brand'=>$brand,
                'serial_no'=>$serial_no,
                'part_no'=>$part_no,
                'receive_date'=>$acquisition_date,
                'item_cost'=>$acquisition_cost,
            );
        }
        $this->load->view('returns/return_damage',$data);
        $this->load->view('template/footer');
    }

        public function save_return_damage(){
        $count = $this->input->post('count');
        for($x=1;$x<$count;$x++){
            $in_id = $this->input->post('in_id'.$x);
            $qty = 1;
            $return_id = $this->input->post('return_id'.$x);
            $acquisition_cost = $this->input->post('item_cost'.$x);
            $acquisition_date = $this->input->post('receive_date'.$x);
           
            $data=array(
                "damage_date"=>$this->input->post('damage_date'.$x)." ".date("H:i:s"),
                "pdr_no"=>$this->input->post('pdr_no'.$x),
                "item_id"=>$this->input->post('item'.$x),
                "reported_by"=>$this->input->post('reported_by'.$x),
                "reported_date"=>$this->input->post('reported_date'.$x),
                "accounted_to"=>$this->input->post('accounted_to'.$x),
                "person_using"=>$this->input->post('person_using'.$x),
                "damage_description"=>$this->input->post('damage_description'.$x),
                "damage_reason"=>$this->input->post('damage_reason'.$x),
                "inspected_by"=>$this->input->post('inspected_by'.$x),
                "date_inspected"=>$this->input->post('date_inspected'.$x),
                "recommendation"=>$this->input->post('recommendation'.$x),
                "prepared_by"=>$this->input->post('prepared_by'.$x),
                "checked_by"=>$this->input->post('checked_by'.$x),
                "noted_by"=>$this->input->post('noted_by'.$x),
                "remarks"=>$this->input->post('notes'),
                "create_date"=>date("Y-m-d H:i:s"),
                "user_id"=>$_SESSION['user_id'],
            );

            $id= $this->super_model->insert_return_id("damage_head", $data);

            $data =array(
                "damage_id"=>$id,
                "in_id"=>$in_id,
                "damage_qty"=>$qty,
                "brand"=>$this->input->post('brand'.$x),
                "serial_no"=>$this->input->post('serial_no'.$x),
                "part_no"=>$this->input->post('part_no'.$x),
                "acquisition_date"=>$acquisition_date,
                "acquisition_cost"=>$acquisition_cost,
                "return_id"=>$return_id,
            );

            $this->super_model->insert_into("damage_details", $data);

            $item_id = $this->super_model->select_column_where("fifo_in", "item_id", "in_id", $in_id);
            $data_out = array(
                "in_id"=>$in_id,
                "item_id"=>$item_id,
                "transaction_type"=>"Damage",
                "damage_id"=>$id,
                "unit_cost"=>$acquisition_cost,
                "quantity"=>$qty,
                "remaining_qty"=>$qty
            );

            $this->super_model->insert_into("fifo_out", $data_out);

            $curr_qty_out = $this->super_model->select_column_where("fifo_in", "remaining_qty", "in_id", $in_id);
            $new_qty_out = $curr_qty_out - $qty;
            $data_in = array(
                "remaining_qty"=>$new_qty_out
            );

            $this->super_model->update_where("fifo_in", $data_in, "in_id", $in_id);
        }
        echo $return_id;
    }

    public function return_damage_print(){
        $return_id=$this->uri->segment(3);
        $data['return_id']=$return_id;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->custom_query("SELECT * FROM damage_head dh INNER JOIN damage_details dd ON dh.damage_id=dd.damage_id AND dd.return_id='$return_id'") AS $dh){
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$dh->item_id);
            $accounted_to = $this->super_model->select_column_where('employees', 'employee_name', 'employee_id', $dh->accounted_to);
            $person_using = $this->super_model->select_column_where('employees', 'employee_name', 'employee_id', $dh->person_using);
            $inspected_by = $this->super_model->select_column_where('employees', 'employee_name', 'employee_id', $dh->inspected_by);
            $prepared_by = $this->super_model->select_column_where('employees', 'employee_name', 'employee_id', $dh->prepared_by);
            $noted_by = $this->super_model->select_column_where('employees', 'employee_name', 'employee_id', $dh->noted_by);
            $checked_by = $this->super_model->select_column_where('employees', 'employee_name', 'employee_id', $dh->checked_by);
            $data['head'][]=array(
                "pdr_no"=>$dh->pdr_no,
                "reported_by"=>$dh->reported_by,
                "reported_date"=>date("Y-m-d h:i:sa", strtotime($dh->reported_date)),
                "damage_description"=>$dh->damage_description,
                "damage_reason"=>$dh->damage_reason,
                "recommendation"=>$dh->recommendation,
                "remarks"=>$dh->remarks,
                "accounted_to"=>$accounted_to,
                "person_using"=>$person_using,
                "inspected_by"=>$inspected_by,
                "prepared_by"=>$prepared_by,
                "noted_by"=>$noted_by,
                "checked_by"=>$checked_by,
                "item_name"=>$item_name,
                "brand"=>$dh->brand,
                "serial_no"=>$dh->serial_no,
                "part_no"=>$dh->part_no,
                "acquisition_cost"=>$dh->acquisition_cost,
                "acquisition_date"=>date("F d,Y", strtotime($dh->acquisition_date)),
                "date_inspected"=>date("F d,Y", strtotime($dh->date_inspected)),
                "date"=>date("F d,Y", strtotime($dh->damage_date))
            );
        }
        $this->load->view('returns/return_damage_print',$data);
        $this->load->view('template/footer');
    }

    public function print_sample(){
        // $this->load->view('template/header');
        $this->load->view('returns/print_sample');
        // $this->load->view('template/footer');
    }


}