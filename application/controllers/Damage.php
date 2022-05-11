<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Damage extends CI_Controller {

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


    public function damage_item(){
        $now = date("Y-m-d");

        $data['item'] = $this->super_model->select_all('items');
        $data['employees']=$this->super_model->select_all_order_by("employees",'employee_name',"ASC");
        //$item_id = $this->uri->segment(3);
        //$data['transactions'] = $this->super_model->select_custom_where('fifo_in','item_id = "'.$item_id.'" AND (expiry_date ="" or expiry_date >= "'.$now.'") AND remaining_qty != 0');
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('damage/damage_item',$data);
        $this->load->view('template/footer');
    }

    public function itemdam_info(){
        $in_id=$this->input->post('in_id');
        foreach($this->super_model->select_row_where("fifo_in","in_id",$in_id) AS $cli){
            $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$cli->item_id);
            $qty = 1;
            $total_cost = $qty * $cli->item_cost;
            //$total_cost = $cli->remaining_qty * $cli->item_cost;
            $return = array('qty'=>$cli->remaining_qty, 'brand'=>$cli->brand, 'serial_no'=>$cli->serial_no, 'original_pn'=>$original_pn, 'receive_date'=>$cli->receive_date, 'total_cost'=>$total_cost,'item_cost'=>$cli->item_cost);
        }
        echo json_encode($return);
    }

    public function add_transaction(){
        $item_id = $this->input->post('item_id');
        $count = $this->input->post('count');
        $now = date("Y-m-d");
    
        $str="";
        $str .= '<tr id="load_data'.$count.'">
            <td>
                <select class="alt-control" name="transaction'.$count.'" id="transaction'.$count.'" onchange="get_damitem_value('.$count.')">
                    <option>-Select Transaction-</option>';
                    foreach($this->super_model->select_custom_where('fifo_in','item_id = "'.$item_id.'" AND (expiry_date ="" or expiry_date >= "'.$now.'") AND remaining_qty != 0') AS $in){ 
                        $str.='<option value='.$in->in_id.' myTag='.$in->remaining_qty.'>'.date('Y-m-d', strtotime($in->receive_date)). ', '. $in->pr_no.', '.$in->brand.'</option>';
                    }
                $str.= '</select>
            </td>
            <td >
                <input type="number" class="alt-control" placeholder="00" name="qty'.$count.'" id="qty'.$count.'" readonly>
                <input type="hidden" id="total_cost'.$count.'" name="total_cost'.$count.'">
            </td>
            <td>
                <textarea class="alt-control" rows="1"  name="brand'.$count.'" id="brand'.$count.'" readonly></textarea>
            </td>
            <td><input type="text" class="alt-control" name="serial_no'.$count.'" id="serial_no'.$count.'"></td>
            <td><input type="text" class="alt-control" name="original_pn'.$count.'" id="original_pn'.$count.'" readonly></td>
            <td><input type="text" class="alt-control" name="receive_date'.$count.'" id="receive_date'.$count.'" readonly></td>
            <td><input type="text" class="alt-control" name="item_cost'.$count.'" id="item_cost'.$count.'" readonly></td>
            <td align="center">
                <a class="btn btn-gradient-danger btn-xs" id="remove_item'.$count.'" onclick="delete_damage_item('.$count.')">
                    <span class="mdi mdi-close"></span>
                </a>
            </td>
            </tr>';

        echo $str;                                   
    }

    public function cancel_damage(){
        $id = $this->input->post('id');
        $this->super_model->delete_where("damage_head", "damage_id", $id);
    }

    public function add_damage(){
         $data=array(
            "damage_date"=>$this->input->post('damage_date')." ".date("H:i:s"),
            "pdr_no"=>$this->input->post('pdr_no'),
            "item_id"=>$this->input->post('item'),
            "reported_by"=>$this->input->post('reported_by'),
            "reported_date"=>$this->input->post('reported_date'),
            "accounted_to"=>$this->input->post('accounted_to'),
            "person_using"=>$this->input->post('person_using'),
            "damage_description"=>$this->input->post('damage_description'),
            "damage_reason"=>$this->input->post('damage_reason'),
            "inspected_by"=>$this->input->post('inspected_by'),
            "date_inspected"=>$this->input->post('date_inspected'),
            "recommendation"=>$this->input->post('recommendation'),
            "prepared_by"=>$this->input->post('prepared_by'),
            "checked_by"=>$this->input->post('checked_by'),
            "noted_by"=>$this->input->post('noted_by'),
            "remarks"=>$this->input->post('notes'),
            "create_date"=>date("Y-m-d H:i:s"),
            "user_id"=>$_SESSION['user_id'],
        );
     

       $id= $this->super_model->insert_return_id("damage_head", $data);

       $return = array('damage_id'=>$id, 'item_id'=>$this->input->post('item'));
       echo json_encode($return);
       //echo $id;
    }

    public function save_damage(){
        $count = $this->input->post('count');
        $damage_id = $this->input->post('damage_id');
       // echo $damage_id;
        for($x=1;$x<=$count;$x++){
            $in_id = $this->input->post('transaction'.$x);
            $qty = $this->input->post('qty'.$x);
            $brand = $this->input->post('brand'.$x);
            $serial_no = $this->input->post('serial_no'.$x);
            $original_pn = $this->input->post('original_pn'.$x);
            $acquisition_date = $this->input->post('receive_date'.$x);
            $acquisition_cost = $this->input->post('item_cost'.$x);
            $remarks = $this->input->post('remarks'.$x);
           
            $data =array(
                "damage_id"=>$damage_id,
                "in_id"=>$in_id,
                "damage_qty"=>$qty,
                "brand"=>$brand,
                "serial_no"=>$serial_no,
                "part_no"=>$original_pn,
                "acquisition_date"=>$acquisition_date,
                "acquisition_cost"=>$acquisition_cost,
                "remarks"=>$remarks
            );

            $this->super_model->insert_into("damage_details", $data);
            
            $item_id = $this->super_model->select_column_where("fifo_in", "item_id", "in_id", $in_id);
            $data_out = array(
                "in_id"=>$in_id,
                "item_id"=>$item_id,
                "transaction_type"=>"Damage",
                "damage_id"=>$damage_id,
                "unit_cost"=>$acquisition_cost,
                "quantity"=>$qty,
                "remaining_qty"=>$qty
            );

            $this->super_model->insert_into("fifo_out", $data_out);


            $curr_qty = $this->super_model->select_column_where("fifo_in", "remaining_qty", "in_id", $in_id);
            $new_qty = $curr_qty - $qty;
            $data_in = array(
                "remaining_qty"=>$new_qty
            );

            $this->super_model->update_where("fifo_in", $data_in, "in_id", $in_id);

            $data_head = array(
                "saved"=>1
            );
            $this->super_model->update_where("damage_head", $data_head, "damage_id", $damage_id);
        }
        echo $damage_id;
    }

    public function damage_print(){
        $id=$this->uri->segment(3);
        $damage_det_id = $this->super_model->select_column_where("damage_details", "damage_det_id","damage_id",$id);
        foreach($this->super_model->select_row_where("damage_head", "damage_id", $id) AS $dam){
            $data['head'][] = array(
                "pdr_no"=>$dam->pdr_no,
                "date_reported"=>$dam->reported_date,
                "accounted_person"=>$this->super_model->select_column_where("employees", "employee_name", "employee_id", $dam->accounted_to),
                "remarks"=>$dam->remarks,
                "reported_by"=>$dam->reported_by,
                "person_using"=>$this->super_model->select_column_where("employees", "employee_name", "employee_id", $dam->person_using),
                "damage_description"=>$dam->damage_description,
                "damage_reason"=>$dam->damage_reason,
                "inspected_by"=>$this->super_model->select_column_where("employees", "employee_name", "employee_id", $dam->inspected_by),
                "date_inspected"=>$dam->date_inspected,
                "recommendation"=>$dam->recommendation,
                "prepared_by"=>$this->super_model->select_column_where("employees", "employee_name", "employee_id", $dam->prepared_by),
                "checked_by"=>$this->super_model->select_column_where("employees", "employee_name", "employee_id", $dam->checked_by),
                "noted_by"=>$this->super_model->select_column_where("employees", "employee_name", "employee_id", $dam->noted_by),
                "repaired"=>$this->super_model->select_column_where("damage_details", "repaired","damage_det_id",$damage_det_id),
                "assessment"=>$this->super_model->select_column_where("repair_details", "assessment","damage_det_id",$damage_det_id)

            );
        }

        foreach($this->super_model->select_row_where("damage_details", "damage_id", $id) AS $det){
            $item_id=$this->super_model->select_column_where("fifo_in", "item_id", "in_id", $det->in_id);
            $data['details'][] = array(
                
                "item"=>$this->super_model->select_column_where("items", "item_name", "item_id", $item_id),
                "brand"=>$det->brand,
                "serial_no"=>$det->serial_no,
                "part_no"=>$det->part_no,
                "acquisition_date"=>$det->acquisition_date,
                "acquisition_cost"=>$det->acquisition_cost
            );
        }
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('damage/damage_print', $data);
        $this->load->view('template/footer');
    }

    public function damage_list(){
        $data['damage']=array();
        foreach($this->super_model->select_all("damage_head") AS $dam){
            $damage_det_id=$this->super_model->select_column_where("damage_details","damage_det_id","damage_id",$dam->damage_id);
            $repaired=$this->super_model->select_column_where("damage_details","repaired","damage_det_id",$damage_det_id);
            $assessment=$this->super_model->select_column_where("repair_details","assessment","damage_det_id",$damage_det_id);
            $saved=$this->super_model->select_column_where("repair_details","saved","damage_det_id",$damage_det_id);

            if($repaired==0){
                $status='Pending';
            } elseif ($repaired==1 AND $assessment==1 AND $saved==1) {
                $status='Repaired';
            } elseif ($repaired==0 AND $assessment==2 AND $saved==1) {
                $status='Beyond Repair';
            }


            $data['damage'][] = array(
                "damage_id"=>$dam->damage_id,
                "pdr_no"=>$dam->pdr_no,
                "date_reported"=>$dam->reported_date,
                "status"=>$status,
                "item"=>$this->super_model->select_column_where("items", "item_name", "item_id", $dam->item_id),
                "accounted_person"=>$this->super_model->select_column_where("employees", "employee_name", "employee_id", $dam->accounted_to)
            );
        }
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('damage/damage_list',$data);
        $this->load->view('template/footer');
    }

   
}