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


    public function return_form(){
        $sales_good_head_id=$this->uri->segment(3);
        $data['id']=$sales_good_head_id;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['dr_no']=$this->super_model->select_all_order_by("sales_good_head","dr_no","ASC");
        foreach($this->super_model->select_row_where("sales_good_head","sales_good_head_id",$sales_good_head_id) AS $sh){
            $in_id = $this->super_model->select_column_where("sales_good_details","in_id","sales_good_head_id",$sh->sales_good_head_id);
            $receive_id=$this->super_model->select_column_where("fifo_in","receive_id","in_id",$in_id);
            $department_id = $this->super_model->select_column_where("receive_details","department_id","receive_id",$receive_id);
            $department = $this->super_model->select_column_where("department","department_name","department_id",$department_id);
            $purpose_id = $this->super_model->select_column_where("receive_details","purpose_id","receive_id",$receive_id);
            $purpose = $this->super_model->select_column_where("purpose","purpose_desc","purpose_id",$purpose_id);
            $data["head"][]=array(
                "dr_no"=>$sh->dr_no,
                "department"=>$department,
                "purpose"=>$purpose,
                "pr_no"=>$sh->sales_date,
                "date"=>date('F d,Y',strtotime($sh->sales_date)),
            );
            foreach($this->super_model->select_row_where("sales_good_details","sales_good_head_id",$sh->sales_good_head_id) AS $itm){
                $ri_id=$this->super_model->select_column_where("fifo_in","ri_id","in_id",$itm->in_id);
                $remaining_qty=$this->super_model->select_column_where("fifo_in","remaining_qty","in_id",$itm->in_id);
                $item_id=$this->super_model->select_column_where("fifo_in","item_id","in_id",$itm->in_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
                $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$item_id);
                $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$item_id);
                $brand=$this->super_model->select_column_where("fifo_in","brand","in_id",$itm->in_id);
                $supplier_id=$this->super_model->select_column_where("fifo_in","supplier_id","in_id",$itm->in_id);
                $supplier_name = $this->super_model->select_column_where("supplier","supplier_name","supplier_id",$supplier_id);
                $serial_no=$this->super_model->select_column_where("fifo_in","serial_no","in_id",$itm->in_id);
                $data['item'][]=array(
                    "ri_id"=>$ri_id,
                    "in_id"=>$itm->in_id,
                    "item"=>$item_name,
                    "remaining_qty"=>$remaining_qty,
                    "supplier"=>$supplier_name,
                    "brand"=>$brand,
                    "original_pn"=>$original_pn,
                    "serial_no"=>$serial_no,
                    "unit"=>$unit,
                );
            }
        }
        $this->load->view('returns/return_form',$data);
        $this->load->view('template/footer');
    }

    public function dr_append(){
        $sales_good_head_id = $this->input->post('sales_good_head_id');
        foreach($this->super_model->custom_query("SELECT sales_good_head_id FROM sales_good_head WHERE sales_good_head_id = '$sales_good_head_id' AND saved = '1'") AS $mr){ 
            $return = array('sales_good_head_id' => $mr->sales_good_head_id); 
            echo json_encode($return);   
        }
    }

    public function save_return(){
        $head_rows = $this->super_model->count_rows("return_head");
        if($head_rows==0){
            $return_id=1;
        } else {
            $maxid=$this->super_model->get_max("return_head", "return_id");
            $return_id=$maxid+1;
        }

        $datains=array(
            "return_id"=>$return_id,
            "dr_no"=>$this->input->post('dr_save'),
            "return_date"=>$this->input->post('return_date'),
            "create_date"=>date("Y-m-d H:i:s"),
            "user_id"=>$_SESSION['user_id'],
        );
        if($this->super_model->insert_into("return_head",$datains)){
            $count=$this->input->post('count');
            $in_id=$this->input->post('in_id');
            $ri_id=$this->input->post('ri_id');
            $remaining_qty=$this->input->post('remaining_qty');
            $return_qty=$this->input->post('return_qty');
            $remarks=$this->input->post('remarks');
            for($x=0;$x<$count;$x++){
                $datadet=array(
                    "return_id"=>$return_id,
                    "ri_id"=>$ri_id[$x],
                    "in_id"=>$in_id[$x],
                    "return_qty"=>$return_qty[$x],
                    "remarks"=>$remarks[$x],
                );
                if($this->super_model->insert_into("return_details",$datadet)){
                    $new_qty = $remaining_qty[$x]+$return_qty[$x];
                    $dataup=array(
                        'remaining_qty'=>$new_qty
                    );
                    $this->super_model->update_where("fifo_in", $dataup, "in_id", $in_id[$x]);
                }
            }
            echo $return_id;
        }
    }

    public function print_return(){
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
            $dr_no = $this->super_model->select_column_where("sales_good_head","dr_no","dr_no",$rh->dr_no);
            $pr_no = $this->super_model->select_column_where("sales_good_head","pr_no","dr_no",$rh->dr_no);
            $data['head'][]=array(
                "dr_no"=>$dr_no,
                "pr_no"=>$pr_no,
                "purpose"=>$purpose,
                "department"=>$department,
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
                    "quantity"=>$rd->return_qty,
                    "unit"=>$unit,
                    "original_pn"=>$original_pn,
                    "item"=>$item_name,
                    "brand"=>$brand,
                    "serial_no"=>$serial_no,
                    "unit_cost"=>$item_cost,
                    "total"=>$total,
                    "remaining_qty"=>$remaining_qty,
                    "remarks"=>$rd->remarks,
                );
            }
        }
        $this->load->view('returns/print_return',$data);
        $this->load->view('template/footer');
    }


}