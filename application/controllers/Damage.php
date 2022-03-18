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


    public function damage_item()
    {
        $now = date("Y-m-d");
        $data['item'] = $this->super_model->select_all('items');
        $item_id = $this->uri->segment(3);
        $data['transactions'] = $this->super_model->select_custom_where('fifo_in','item_id = "'.$item_id.'" AND (expiry_date ="" or expiry_date >= "'.$now.'") AND remaining_qty != 0');
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('damage/damage_item',$data);
        $this->load->view('template/footer');
    }

    public function add_transaction(){
        $item_id = $this->input->post('item_id');
        $count = $this->input->post('count');
        $now = date("Y-m-d");
    
        $str="";
        $str .= '<tr id="load_data'.$count.'">
            <td width="45%">
                <div class="form-group">
                    <select class="form-control" name="transaction'.$count.'" id="transaction'.$count.'">
                        <option>-Select Transaction-</option>';
                        foreach($this->super_model->select_custom_where('fifo_in','item_id = "'.$item_id.'" AND (expiry_date ="" or expiry_date >= "'.$now.'") AND remaining_qty != 0') AS $in){ 
                            $str.='<option value='.$in->in_id.' myTag='.$in->remaining_qty.'>'.$in->receive_date. ', '. $in->pr_no.'</option>';
                        }
                    $str.= '</select>
                </div>
            </td>
            <td width="2%"></td>
            <td width="15%">
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="00" name="qty'.$count.'" id="qty'.$count.'" onkeyup="check_rem_qty('.$count.')">
                </div>
            </td>
            <td width="2%"></td>
            <td width="34%">
                <div class="form-group">
                    <textarea class="form-control" rows="1"  name="remarks'.$count.'" id="remarks'.$count.'"></textarea>
                </div>
            </td>
                <td width="2%" style="vertical-align:top">
                    <a class="btn btn-gradient-danger btn-sm mt-2" id="remove_item'.$count.'" onclick="delete_damage_item('.$count.')">
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
            "damage_date"=>$this->input->post('damage_date'),
            "remarks"=>$this->input->post('notes'),
            "item_id"=>$this->input->post('item'),
            "create_date"=>date("Y-m-d H:i:s"),
            "user_id"=>$_SESSION['user_id'],
        );
     

       $id= $this->super_model->insert_return_id("damage_head", $data);

       echo $id;
    }

    public function save_damage(){
        $count = $this->input->post('count');
        $damage_id = $this->input->post('damage_id');
       // echo $damage_id;
        for($x=1;$x<=$count;$x++){
            $in_id = $this->input->post('transaction'.$x);
            $qty = $this->input->post('qty'.$x);
            $remarks = $this->input->post('remarks'.$x);
           
            $data =array(
                "damage_id"=>$damage_id,
                "in_id"=>$in_id,
                "damage_qty"=>$qty,
                "remarks"=>$remarks
            );

            $this->super_model->insert_into("damage_details", $data);
            
            $item_id = $this->super_model->select_column_where("fifo_in", "item_id", "in_id", $in_id);
            $data_out = array(
                "in_id"=>$in_id,
                "item_id"=>$item_id,
                "transaction_type"=>"Damage",
                "damage_id"=>$damage_id,
                "quantity"=>$qty,
            );

            $this->super_model->insert_into("fifo_out", $data_out);


            $curr_qty = $this->super_model->select_column_where("fifo_in", "remaining_qty", "in_id", $in_id);
            $new_qty = $curr_qty - $qty;
            $data_in = array(
                "remaining_qty"=>$new_qty
            );

            $this->super_model->update_where("fifo_in", $data_in, "in_id", $in_id);
        }
    }

}