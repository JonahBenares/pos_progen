<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receive extends CI_Controller {

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


    public function receive_list()
    {   
        $data['list'] = $this->super_model->select_row_where("receive_head", "saved", "1");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/receive_list',$data);
        $this->load->view('template/footer');
    }

    public function add_receive()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/add_receive');
        $this->load->view('template/footer');
    }


    public function add_receive_head()
    {
        $prc = $this->uri->segment(3);
        $count_pr = $prc+1;
        $data['count_pr'] = $count_pr;

        $data['department']= $this->super_model->select_all("department");
        $data['purpose']= $this->super_model->select_all("purpose");
        $data['employees']= $this->super_model->select_all("employees");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/add_receive_head',$data);
        $this->load->view('template/footer');
    }

    public function add_receive_head_process(){
       
        $year=date('Y-m');
        $year_series=date('Y');
        
        $rows=$this->super_model->count_custom_where("receive_head","create_date LIKE '$year_series%'");
        if($rows==0){
             $newrec_no = "MRIF-".$year."-0001";
        } else {
            $maxrecno=$this->super_model->get_max_where("receive_head", "mrecf_no","create_date LIKE '$year_series%'");
            $recno = explode('-',$maxrecno);
            $series = $recno[3]+1;
            if(strlen($series)==1){
                $newrec_no = "MRIF-".$year."-000".$series;
            } else if(strlen($series)==2){
                 $newrec_no = "MRIF-".$year."-00".$series;
            } else if(strlen($series)==3){
                 $newrec_no = "MRIF-".$year."-0".$series;
            } else if(strlen($series)==4){
                 $newrec_no = "MRIF-".$year."-".$series;
            }
        }

        $data=array(
            "receive_date"=>$this->input->post('receive_date'),
            "po_no"=>$this->input->post('po_no'),
            "dr_no"=>$this->input->post('dr_no'),
            "si_no"=>$this->input->post('si_no'),
            "pcf"=>$this->input->post('pcf'),
            "mrecf_no"=>$newrec_no,
            "create_date"=>date("Y-m-d H:i:s"),
            "user_id"=>$_SESSION['user_id'],
            "overall_remarks"=>$this->input->post('remarks')
        );
     

       $id= $this->super_model->insert_return_id("receive_head", $data);

       $data_details = array(
            "receive_id"=>$id
       );
       $details_id= $this->super_model->insert_return_id("receive_details", $data_details);

      
       $return = array('receive_id'=>$id, 'rd_id'=>$details_id);
       echo json_encode($return);
    }

    public function cancel_receive(){
        $id = $this->input->post('id');
        $this->super_model->delete_where("receive_head", "receive_id", $id);
        $this->super_model->delete_where("receive_details", "receive_id", $id);
        $this->super_model->delete_where("receive_items", "receive_id", $id);
    }

    public function update_receive_details(){
       $rd_id = $this->input->post('rd_id');
       $field = $this->input->post('field');
       if($field == 'department' || $field == 'purpose'){
            $field = $field."_id";
       }else if($field == 'inspected'){
            $field = $field."_by";
       } else{
            $field = $field;
       }


        $data=array(
            $field=>$this->input->post('val')
        );

        $this->super_model->update_where("receive_details", $data, "rd_id", $rd_id);
    }

    public function add_another_pr(){
        $receive_id = $this->input->post('receive_id');

        $data_details = array(
            "receive_id"=>$receive_id
        );
        $details_id= $this->super_model->insert_return_id("receive_details", $data_details);

        echo $details_id;
    }

    public function add_receive_pr()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/add_receive_pr');
        $this->load->view('template/footer');
    }
   
    public function add_receive_item()
    {
        $data['receive_id']= $this->uri->segment(3);
        $data['rd_id']= $this->uri->segment(4);
        $data['counter']= $this->uri->segment(5);
        $data['item'] = $this->super_model->select_all('items');
        $data['supplier'] = $this->super_model->select_all('supplier');

        $this->load->view('template/header');
        $this->load->view('receive/add_receive_item',$data);
        $this->load->view('template/footer');
    }

     public function insert_items(){
        
       $receive_id = $this->input->post('receive_id');
        $rd_id = $this->input->post('rd_id');

        
        if($this->input->post('local')=='1'){
            $mode = 1;
        } else {
            $mode =2;
        }

        
        $data=array(
            "rd_id"=>$rd_id,
            "receive_id"=>$receive_id,
            "supplier_id"=>$this->input->post('supplier'),
            "item_id"=>$this->input->post('item'),
            "brand"=>$this->input->post('brand'),
            "catalog_no"=>$this->input->post('catalog_no'),
            "serial_no"=>$this->input->post('serial_no'),
            "item_cost"=>$this->input->post('net_cost'),
            "expected_qty"=>$this->input->post('expected_qty'),
            "received_qty"=>$this->input->post('received_qty'),
            "local_mnl"=>$mode,
            "shipping_fee"=>$this->input->post('shipping'),
            "expiration_date"=>$this->input->post('expiry'),
           
        );

        $ri_id = $this->super_model->insert_return_id("receive_items", $data);
            
        
            $x=1;
            $count_item = $this->super_model->count_rows_where("receive_items","receive_id",$receive_id);
            foreach($this->super_model->custom_query("SELECT * FROM receive_items WHERE rd_id='$rd_id' ORDER BY ri_id DESC LIMIT 1") AS $app){
                if($app->local_mnl == 1){
                    $mode = 'Local';
                } else {
                    $mode = 'MNL';
                }
                $item_id = $app->item_id;
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$app->item_id);
                $supplier = $this->super_model->select_column_where("supplier","supplier_name","supplier_id",$app->supplier_id);
          
                echo '<tr id="load_data'.$count_item.'"><td>'.$item_name.'</td><td>'.$supplier.'</td><td>'.$app->brand.'</td><td>'.$app->serial_no.'</td><td>'.$app->catalog_no.'</td><td>'.$app->item_cost.'</td><td>'.$app->expected_qty.'</td><td>'.$app->received_qty.'</td><td>'.$app->shipping_fee.'</td><td>'.$app->expiration_date.'</td><td>'.$mode.'</td>  <td><a onclick="delete_receive_item('.$app->ri_id.','.$count_item.')" class="btn btn-danger btn-xs btn-rounded"><span class="mdi mdi-window-close"></span></a></td> </tr>';
                $count_item++;
            }
        
    }

    public function delete_item(){
        $ri_id = $this->input->post('ri_id');
        $this->super_model->delete_where("receive_items", "ri_id", $ri_id);
    }

    public function removePR(){
        $rd_id = $this->input->post('rd_id');
        $this->super_model->delete_where("receive_details", "rd_id", $rd_id);
        $this->super_model->delete_where("receive_items", "rd_id", $rd_id);
    }

    public function savePR(){
        $receive_id = $this->input->post('receive_id');
        $data =array(
            "saved"=>1
        );

        foreach($this->super_model->select_row_where("receive_items", "receive_id", $receive_id) AS $it){
            $data_fifo = array(
                "receive_id"=>$receive_id,
                "rd_id"=>$it->rd_id,
                "ri_id"=>$it->ri_id,
                "receive_date"=>$this->super_model->select_column_where("receive_head", "receive_date", "receive_id", $receive_id),
                "pr_no"=>$this->super_model->select_column_where("receive_details", "pr_no", "rd_id", $it->rd_id),
                "item_id"=>$it->item_id,
                "supplier_id"=>$it->supplier_id,
                "brand"=>$it->brand,
                "catalog_no"=>$it->catalog_no,
                "serial_no"=>$it->serial_no,
                "expiry_date"=>$it->expiration_date,
                "item_cost"=>$it->item_cost,
                "quantity"=>$it->received_qty,
                "remaining_qty"=>$it->received_qty
            );

            $this->super_model->insert_into("fifo_in", $data_fifo);

        }

        $this->super_model->update_where("receive_head", $data, "receive_id", $receive_id);
    }

    public function update_receive_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/update_receive_head');
        $this->load->view('template/footer');
    }

    public function update_receive_pr()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/update_receive_pr');
        $this->load->view('template/footer');
    }
   
    public function update_receive_item()
    {
        $this->load->view('template/header');
        $this->load->view('receive/update_receive_item');
        $this->load->view('template/footer');
    }

    public function print_receive()
    {
        $receive_id= $this->uri->segment(3);
        $data["head"] = $this->super_model->select_row_where("receive_head", "receive_id",$receive_id);


        foreach($this->super_model->select_row_where("receive_details", "receive_id", $receive_id) AS $det){
            $data['details'][]=array(
                "rd_id"=>$det->rd_id,
                "pr_no"=>$det->pr_no,
                "department"=>$this->super_model->select_column_where("department","department_name","department_id",$det->department_id),
                "purpose"=>$this->super_model->select_column_where("purpose","purpose_desc","purpose_id",$det->purpose_id),
                "inspected"=>$this->super_model->select_column_where("employees","employee_name","employee_id",$det->inspected_by)
            );

            foreach($this->super_model->select_row_where("receive_items", "rd_id", $det->rd_id) AS $it){
                if($it->local_mnl == 1){
                    $local = "Local";
                } else {
                    $local = "MNL";
                }
                $data['items'][]=array(
                    "rd_id"=>$det->rd_id,
                    "supplier"=>$this->super_model->select_column_where("supplier","supplier_name","supplier_id",$it->supplier_id),
                    "item"=>$this->super_model->select_column_where("items","item_name","item_id",$it->item_id),
                    "brand"=>$it->brand,
                    "catalog_no"=>$it->catalog_no,
                    "serial_no"=>$it->serial_no,
                    "item_cost"=>$it->item_cost,
                    "expected_qty"=>$it->expected_qty,
                    "received_qty"=>$it->received_qty,
                    "local"=>$local,
                    "shipping"=>$it->shipping_fee,
                    "expiry"=>$it->expiration_date

                );
            }

          // $data['items'][]=array();

        }
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('receive/print_receive',$data);
        $this->load->view('template/footer');
    }

}