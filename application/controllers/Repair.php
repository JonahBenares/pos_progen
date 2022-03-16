<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Repair extends CI_Controller {

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


    public function repair_item()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $row_avail=$this->super_model->count_custom_query("SELECT * FROM damage_details where repair='0'");
        if($row_avail!=0){
             foreach($this->super_model->custom_query("SELECT * FROM damage_details where repair='0'") AS $repair){ 
                $item_id=$this->super_model->select_column_where("fifo_in","item_id","in_id",$repair->in_id);
                $in_id=$this->super_model->select_column_where("fifo_in","in_id","in_id",$repair->in_id);
                $receive_date=$this->super_model->select_column_where("fifo_in","receive_date","in_id",$repair->in_id);
                $pr_no=$this->super_model->select_column_where("fifo_in","pr_no","in_id",$repair->in_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
                $data['repair_items'][] = array(
                    'damage_det_id'=>$repair->damage_det_id,
                    'in_id'=>$repair->in_id,
                    'receive_date'=>$receive_date,
                    'pr_no'=>$pr_no,
                    'category'=>$this->super_model->select_column_where('item_categories', 'cat_name', 'cat_id', $item_id),
                    'subcategory'=>$this->super_model->select_column_where('item_subcat', 'subcat_name', 'subcat_id', $item_id),
                    'item_name'=>$item_name,

                );
            }
 
        } else {
            $data['repair_items']=array();
    }
        $this->load->view('repair/repair_item', $data);
        $this->load->view('template/footer');
    }

    public function insert_redirect(){  
        $count = $this->input->post('count');
        $damagedetid = $this->input->post('damagedetid');
        $in_id = $this->input->post('in_id');
        $checked =count($damagedetid);
        for($x=0;$x<$checked;$x++){
            foreach($this->super_model->select_row_where('damage_details', 'damage_det_id', $damagedetid[$x]) AS $rep){
                $rep_data = array(
                    'damage_det_id'=>$damagedetid[$x],
                    'in_id'=>$in_id[$x],
                    "user_id"=>$_SESSION['user_id'],
                    'unsaved'=>1,
                );
                $this->super_model->insert_into("repair_details", $rep_data);
            }
        }   
    }

    public function insert_repair(){
        $count = $this->input->post('count');
        for($x=0;$x<$count;$x++){
            $repair_id = $this->input->post('repair_id'.$x);
            $inid = $this->input->post('in_id'.$x);
            $repaired_by = $this->input->post('repaired_by'.$x);
            $damagedetid = $this->input->post('damage_det_id'.$x);
            $date = $this->input->post('date'.$x);
            $price = $this->input->post('price'.$x);
            $jopr = $this->input->post('jopr'.$x);
            $radio = $this->input->post('repair'.$x);
            $quantity = $this->input->post('qty'.$x);
            $remarks = $this->input->post('remarks'.$x);
            $received_by = $this->input->post('rec_id'.$x);
            $rep_data = array(
                'repaired_by'=>$repaired_by,
                'repair_date'=>$date,
                'repair_price'=>$price,
                'jo_no'=>$jopr,
                'assessment'=>$radio,
                'quantity'=>$quantity,
                'received_by'=>$received_by,
                'remarks'=>$remarks,
                'create_date'=>date("Y-m-d H:i:s"),
                'user_id'=>$_SESSION['user_id'],
                'saved'=>1,
                'unsaved'=>0,
            );
            if($this->super_model->update_where("repair_details", $rep_data, "repair_id", $repair_id)){
                foreach($this->super_model->select_row_where('fifo_in', 'in_id', $inid) AS $in){
                    if($radio=='1'){
                        $qty=$in->remaining_qty+$quantity;
                        $in_data = array(
                            'remaining_qty'=>$qty,
                        ); 
                    }
                    $this->super_model->update_where("fifo_in", $in_data, "in_id", $inid);
                    $damage_data = array(
                        'repair'=>1,
                    ); 
                    $this->super_model->update_where("damage_details", $damage_data, "damage_det_id", $inid);
                }
            }
        }
    }


    public function repair_form(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['receive'] = $this->super_model->select_all('employees');
        foreach($this->super_model->custom_query("SELECT * FROM repair_details") AS $repair){
            $item_id=$this->super_model->select_column_where("fifo_in","item_id","in_id",$repair->in_id);
            $receive_date=$this->super_model->select_column_where("fifo_in","receive_date","in_id",$repair->in_id);
            $pr_no=$this->super_model->select_column_where("fifo_in","pr_no","in_id",$repair->in_id);
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
            if($repair->saved == 0 AND $repair->unsaved==1){
                $data['rep'][]=array(
                    'repair_id'=>$repair->repair_id,
                    'damage_det_id'=>$repair->damage_det_id,
                    'in_id'=>$repair->in_id,
                );
            }
            $data['details'][]=array(
                'in_id'=>$repair->in_id,
                'damage_det_id'=>$repair->damage_det_id,
                'receive_date'=>$receive_date,
                'pr_no'=>$pr_no,
                'item_name'=>$item_name,
                'category'=>$this->super_model->select_column_where('item_categories', 'cat_name', 'cat_id', $item_id),
                'subcategory'=>$this->super_model->select_column_where('item_subcat', 'subcat_name', 'subcat_id', $item_id),
            );
        }
        $this->load->view('repair/repair_form', $data);
        $this->load->view('template/footer');
    }


}