<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_order extends CI_Controller {

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

    public function backorder_qty($riid){
        $expectedqty = $this->super_model->select_sum("receive_items", "expected_qty", "ri_id", $riid);
        $recqty = $this->super_model->select_column_where("receive_items", "received_qty", "ri_id", $riid);
        $bo_qty = $expectedqty-$recqty;
        return $bo_qty;
    }

    public function get_expected_qty($pr,$item){
        $expected_qty = $this->super_model->select_sum_join("expected_qty","receive_items","receive_details", "pr_no = '$pr' AND item_id='$item'","rd_id");
        return $expected_qty;
    }

     public function get_received_qty($pr,$item){
        $received_qty = $this->super_model->select_sum_join("received_qty","receive_items","receive_details", "pr_no = '$pr' AND item_id='$item'","rd_id");
        return $received_qty;
    }

      public function get_rdid($pr,$item){
        $rd_id = $this->super_model->custom_query_single("rd_id","SELECT ri.rd_id FROM receive_items ri INNER JOIN receive_details rd ON ri.rd_id = rd.rd_id WHERE rd.pr_no = '$pr' AND ri.item_id='$item' ORDER BY ri_id DESC LIMIT 1");
        return $rd_id;
    }


    public function backorder_form(){
        $today = date("Y-m-d");
        $id=$this->uri->segment(3);
        $data['id']=$id;

          foreach($this->super_model->select_row_where("receive_details", "rd_id", $id) AS $rd){
            
               
                 $data['details'][] = array(
                    "receiveid"=>$rd->receive_id,
                    "rdid"=>$rd->rd_id,
                    "prno"=>$rd->pr_no,
                    "department"=>$this->super_model->select_column_where("department", "department_name", "department_id", $rd->department_id),
                     "purpose"=>$this->super_model->select_column_where("purpose", "purpose_desc", "purpose_id", $rd->purpose_id),
                 );
             
        }

        foreach($this->super_model->select_row_where("receive_items", "rd_id", $id) AS $it){
            /* if($it->expected_qty > $it->received_qty){*/
                $boqty=$this->backorder_qty($it->ri_id);
                $total_cost=$boqty * $it->item_cost;
                 $data['items'][] = array(
                    "receiveid"=>$it->receive_id,
                    "rdid"=>$it->rd_id,
                    "riid"=>$it->ri_id,
                    "item"=>$this->super_model->select_column_where("items", "item_name", "item_id", $it->item_id),
                    "supplier"=>$this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $it->supplier_id),
                    "item_id"=>$it->item_id,
                    "supplier_id"=>$it->supplier_id,
                    "item_cost"=>$it->item_cost,
                    "total_cost"=>$total_cost,
                    "expected_qty"=>$it->expected_qty,
                    "received_qty"=>$it->received_qty,
                    "quantity"=>$boqty,
                    "catalog_no"=>$it->catalog_no,
                    "serial_no"=>$it->serial_no,
                    "brand"=>$it->brand,
                 );
             /*}*/
        }

        foreach($this->super_model->custom_query("SELECT DISTINCT pr_no, item_id FROM receive_details rd INNER JOIN receive_head rh ON rh.receive_id = rd.receive_id INNER JOIN receive_items ri ON rd.rd_id = ri.rd_id WHERE (ri.expiration_date ='' or ri.expiration_date > '$today') GROUP BY pr_no") AS $prlist){
            
            $expected_qty= $this->get_expected_qty($prlist->pr_no,$prlist->item_id);
            $received_qty= $this->get_received_qty($prlist->pr_no,$prlist->item_id);
            $rd_id= $this->get_rdid($prlist->pr_no,$prlist->item_id);
            $item=$this->super_model->select_column_where("items", "item_name", "item_id", $prlist->item_id);
            /*if($expected_qty>$received_qty){*/
                $data['prback'][] = array(
                    "rdid"=>$rd_id,
                    "pr_no"=>$prlist->pr_no,
                    "item"=>$item,
                    "expected"=>$expected_qty,
                    "received"=>$received_qty
                );
           /* }*/
        }

        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('back_order/backorder_form',$data);
        $this->load->view('template/footer');
    }

        public function saveBackorder(){
        $receive_id= $this->input->post('receive_id');
        $rdid= $this->input->post('rdid');
        $po_no= $this->input->post('po_no');
        $dr_no= $this->input->post('dr_no');
        $si_no= $this->input->post('si_no');
        $userid = $_SESSION['user_id'];
        $year=date('Y-m');
        $year_series=date('Y');
        $now=date('Y-m-d H:i:s');
        $receivedate=$this->input->post('receive_date');
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

        $head_rows = $this->super_model->count_rows("receive_head");
        if($head_rows==0){
            $receiveid=1;
        } else {
            $maxid=$this->super_model->get_max("receive_head", "receive_id");
            $receiveid=$maxid+1;
        }

        foreach($this->super_model->select_row_where("receive_head", "receive_id", $receive_id) AS $hd){
              
            $data = array(
                  'receive_id'=>$receiveid,
                   'pcf'=>$hd->pcf,
                   'create_date'=> $now,
                   'receive_date'=> $receivedate,
                   'mrecf_no'=> $newrec_no,
                   'dr_no'=> $dr_no,
                   'po_no'=> $po_no,
                   'si_no'=> $si_no,
                   'user_id'=> $userid,
                   'saved'=>'1'

            );
            $this->super_model->insert_into("receive_head", $data);
        }

           if($rows==0){
                $newrdid=1;
            } else {
                $maxid= $this->super_model->get_max("receive_details", "rd_id");
                $newrdid=$maxid+1;
            }


        foreach($this->super_model->select_row_where("receive_details", "rd_id", $rdid) AS $rd){
       
               $details = array(
                   'rd_id'=>$newrdid,
                   'receive_id'=> $receiveid,
                   'pr_no'=> $rd->pr_no,
                   'purpose_id'=> $rd->purpose_id,
                   'department_id'=> $rd->department_id,
                   'inspected_by'=> $rd->inspected_by,
                );

        
                $this->super_model->insert_into("receive_details", $details);
        }

        $counter = $this->input->post('count');
        for($a=0;$a<$counter;$a++){
             foreach($this->super_model->select_row_where("receive_items", "ri_id", $this->input->post('riid['.$a.']')) AS $rd){
           
                $items = array(
                'rd_id'=>$newrdid,
                'receive_id'=> $receiveid,
                'supplier_id'=> $rd->supplier_id,
                'item_id'=> $rd->item_id,
                'brand'=> $rd->brand,
                'expiration_date'=> $rd->expiration_date,
                'catalog_no'=> $rd->catalog_no,
                'local_mnl'=> $rd->local_mnl,
                'serial_no'=>$this->input->post('serial_no['.$a.']'),
                'item_cost'=> $this->input->post('item_cost['.$a.']'),
                'expected_qty'=>$this->input->post('expqty['.$a.']'),
                'received_qty'=>$this->input->post('quantity['.$a.']'),
                'remarks'=> $this->input->post('remarks['.$a.']'),
            );
            
            $this->super_model->insert_into("receive_items", $items);
            
                $fifo_items = array(
                'ri_id'=>$rd->ri_id,
                'rd_id'=>$newrdid,
                'receive_id'=> $receiveid,
                'receive_date'=> $receivedate,
                'supplier_id'=> $rd->supplier_id,
                'pr_no'=>$this->super_model->select_column_where("receive_details", "pr_no", "rd_id", $rd->rd_id),
                'item_id'=> $rd->item_id,
                'brand'=> $rd->brand,
                'expiry_date'=> $rd->expiration_date,
                'catalog_no'=> $rd->catalog_no,
                'serial_no'=>$this->input->post('serial_no['.$a.']'),
                'item_cost'=> $this->input->post('item_cost['.$a.']'),
                'quantity'=>$this->input->post('quantity['.$a.']'),
                'remaining_qty'=>$this->input->post('quantity['.$a.']'),
            );
            
            $this->super_model->insert_into("fifo_in", $fifo_items);

            }
        }

        echo $receiveid;
    }


    public function print_backorder(){
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $this->load->model('super_model');
        $data['heads'] = $this->super_model->select_row_where('receive_head', 'receive_id', $id);

        foreach($this->super_model->select_row_where('receive_details', 'receive_id', $id) AS $d){
            $purpose = $this->super_model->select_column_where('purpose', 'purpose_desc', 'purpose_id', $d->purpose_id);
            $deparment = $this->super_model->select_column_where('department', 'department_name', 'department_id', $d->department_id);
            $inspected = $this->super_model->select_column_where('employees', 'employee_name', 'employee_id', $d->inspected_by);
            $data['details'][] = array(
                'rdid'=>$d->rd_id,
                'prno'=>$d->pr_no,
                'purpose'=>$purpose,
                'department'=>$deparment,
                'inspected'=>$inspected
            );
            foreach($this->super_model->select_row_where("receive_items", "rd_id", $d->rd_id) AS $items){
                foreach($this->super_model->select_custom_where("items", "item_id = '$items->item_id'") AS $itema){
                    $unit = $this->super_model->select_column_where('uom', 'unit_name', 'unit_id', $itema->unit_id);
                }
                $supplier = $this->super_model->select_column_where('supplier', 'supplier_name', 'supplier_id', $items->supplier_id);
                $item = $this->super_model->select_column_where('items', 'item_name', 'item_id', $items->item_id);
                $total=$items->received_qty*$items->item_cost;
                $data['items'][] = array(
                    'rdid'=>$items->rd_id,
                    'supplier'=>$supplier,
                    'item'=>$item,
                    'unit'=>$unit,
                    'expqty'=>$items->expected_qty,
                    'recqty'=>$items->received_qty,
                    'remarks'=>$items->remarks,
                    'catno'=>$items->catalog_no,
                    'serial'=>$items->serial_no,
                    'shipping_fee'=>$items->shipping_fee,
                    'brand'=>$items->brand,
                    'unitcost'=>$items->item_cost,
                    'total'=>$total
                );
            }
            foreach($this->super_model->select_row_where("receive_items", "rd_id", $d->rd_id) AS $itm_rem){
                $item = $this->super_model->select_column_where('items', 'item_name', 'item_id', $itm_rem->item_id);
                $data['remarks_it'][] = array(
                    'rdid'=>$items->rd_id,
                    'item'=>$item,
                    'remarks'=>$itm_rem->remarks
                );
            }
        }
        $data['printed']=$this->super_model->select_column_where('users', 'fullname', 'user_id', $_SESSION['user_id']);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('back_order/print_backorder',$data);
        $this->load->view('template/footer');
    }




}