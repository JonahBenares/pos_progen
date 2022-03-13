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
        $data['item'] = $this->super_model->select_all('items');
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('damage/damage_item',$data);
        $this->load->view('template/footer');
    }

    public function add_transaction(){
        $item_id = $this->input->post('item_id');
        $now = date("Y-m-d");
    
        $str="";
        $str .= '<tr>
            <td width="45%">
                <div class="form-group">
                    <label>All Transactions</label>
                    <select class="form-control">
                        <option>-Select Transaction-</option>';
                        foreach($this->super_model->select_custom_where('fifo_in','item_id = "'.$item_id.'" AND (expiry_date ="" or expiry_date >= "'.$now.'")') AS $in){ 
                            $str.='<option value='.$in->in_id.'>'.$in->receive_date. ', '. $in->pr_no.'</option>';
                        }
                    $str.= '</select>
                </div>
            </td>
            <td width="2%"></td>
            <td width="15%">
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" class="form-control" placeholder="00">
                </div>
            </td>
            <td width="2%"></td>
            <td width="25%">
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea class="form-control" rows="1"></textarea>
                </div>
            </td>
            <td width="2%"></td>
            <td width="9%">
                <label><br></label>
                <div class="form-group">
                    <a href="" class="btn btn-gradient-info btn-sm">
                        <span class="mdi mdi-plus"></span>
                    </a>
                    <a href="" class="btn btn-gradient-danger btn-sm">
                        <span class="mdi mdi-close"></span>
                    </a>
                </div>
            </td>
        </tr>';

        echo $str;
                                     
    }

}