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
        $row_avail=$this->super_model->count_rows('damage_details');
        //echo $row_avail;
        if($row_avail!=0){
            foreach($this->super_model->select_all('damage_details') AS $repair){
                $item_id=$this->super_model->select_column_where("fifo_in","item_id","in_id",$repair->in_id);
                $pdr_no=$this->super_model->select_column_where("damage_head","pdr_no","damage_id",$repair->damage_id);
                $in_id=$this->super_model->select_column_where("fifo_in","in_id","in_id",$repair->in_id);
                $receive_date=$this->super_model->select_column_where("fifo_in","receive_date","in_id",$repair->in_id);
                $pr_no=$this->super_model->select_column_where("fifo_in","pr_no","in_id",$repair->in_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
                $repair_qty= $this->super_model->select_sum_where("repair_details", "quantity", "damage_det_id='$repair->damage_det_id' AND saved='1' AND (assessment='1' OR assessment='2')");
                $damageqty= $repair->damage_qty-$repair_qty;
              // echo $damageqty . " ";
                if($damageqty!=0){
                    $data['repair_items'][] = array(
                        'damage_det_id'=>$repair->damage_det_id,
                        'in_id'=>$repair->in_id,
                        'item_id'=>$item_id,
                        'receive_date'=>$receive_date,
                        'qty'=>$damageqty,
                        'pr_no'=>$pr_no,
                        'pdr_no'=>$pdr_no,
                        'category'=>$this->super_model->select_column_where('item_categories', 'cat_name', 'cat_id', $item_id),
                        'subcategory'=>$this->super_model->select_column_where('item_subcat', 'subcat_name', 'subcat_id', $item_id),
                        'item_name'=>$item_name,

                    );
                }
            }
        } else {
                $data['repair_items']=array();
            }
        $this->load->view('repair/repair_item',$data);
        $this->load->view('template/footer');
    }

    public function insert_redirect(){  
        $count = $this->input->post('count');
        $damagedetid = $this->input->post('damagedetid');
        /*$in_id = $this->input->post('in_id');
        $item_id = $this->input->post('item_id');*/
        $checked =count($damagedetid);
        for($x=0;$x<$checked;$x++){
            $dam_exp=explode('-',$damagedetid[$x]);
            $damage_details_id=$dam_exp[0];
            $in_id=$dam_exp[1];
            $item_id=$dam_exp[2];
            $rep_data = array(
                'damage_det_id'=>$damage_details_id,
                'in_id'=>$in_id,
                'repaired_item_id'=>$item_id,
                "user_id"=>$_SESSION['user_id'],
                //'unsaved'=>1,
            );
            $this->super_model->insert_into("repair_details", $rep_data);
            /*foreach($this->super_model->select_row_where('damage_details', 'damage_det_id', $damagedetid[$x]) AS $rep){
                $rep_data = array(
                    'damage_det_id'=>$damagedetid[$x],
                    'in_id'=>$in_id[$x],
                    'repaired_item_id'=>$item_id[$x],
                    "user_id"=>$_SESSION['user_id'],
                    'unsaved'=>1,
                );
                $this->super_model->insert_into("repair_details", $rep_data);
            }*/
        }   
    }

    public function insert_repair(){
        $count = $this->input->post('count');
        for($x=1;$x<$count;$x++){
            $repair_id = $this->input->post('repair_id'.$x);
            $inid = $this->input->post('in_id'.$x);
            $repaired_by = $this->input->post('repaired_by'.$x);
            $damagedetid = $this->input->post('damage_det_id'.$x);
            $date = $this->input->post('date'.$x)." ".date("H:i:s");
            $price = $this->input->post('price'.$x);
            $jopr = $this->input->post('jopr'.$x);
            $radio = $this->input->post('repair'.$x);
            $quantity = $this->input->post('qty'.$x);
            $remarks = $this->input->post('remarks'.$x);
            $received_by = $this->input->post('rec_id'.$x);
            $new_pn = $this->input->post('new_pn'.$x);
            $serial = $this->input->post('serial'.$x);
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
                /*'unsaved'=>0,*/
            );
            $this->super_model->update_where("repair_details", $rep_data, "repair_id", $repair_id);
            //echo $radio;
            if($radio == 1){
  
                

                $repaired_item = $this->super_model->select_column_custom_where("fifo_in", "item_id", "in_id ='$inid'");
               
                $count_existing_repaired = $this->super_model->count_custom_where("repair_details", "repaired_item_id='$repaired_item' AND item_id!='0'");
                //echo $count_existing_repaired;
               if($count_existing_repaired == 0){

                    $item_id = $this->super_model->select_column_where("fifo_in", "item_id", "in_id", $inid);

                    foreach($this->super_model->select_row_where("items", "item_id", $item_id) AS $it){
                        $dataitem = array(
                            "category_id"=>$it->category_id,
                            "subcat_id"=>$it->subcat_id,
                            "original_pn"=>$new_pn,
                            "item_name"=>$it->item_name . ' - Refurbished',
                            "unit_id"=>$it->unit_id,
                            "group_id"=>$it->group_id,
                            "location_id"=>$it->location_id,
                            "bin_id"=>$it->bin_id,
                            "warehouse_id"=>$it->warehouse_id,
                            "rack_id"=>$it->rack_id,
                            "barcode"=>$it->barcode,
                            "picture1"=>$it->picture1,
                            "picture2"=>$it->picture2,
                            "picture3"=>$it->picture3,
                            "nkk_no"=>$it->nkk_no,
                            "semt_no"=>$it->semt_no,
                            "weight"=>$it->weight
                        );

                        $new_item_id = $this->super_model->insert_return_id("items", $dataitem);

                       
                        foreach($this->super_model->select_row_where('fifo_in', 'in_id', $inid) AS $in){
                            $datafifo_in = array(
                                "receive_date"=>$in->receive_date,
                                "pr_no"=>$in->pr_no,
                                "item_id"=>$new_item_id,
                                "supplier_id"=>$in->supplier_id,
                                "brand"=>$in->brand,
                                "catalog_no"=>$in->catalog_no,
                                "serial_no"=>$serial,
                                "expiry_date"=>$in->expiry_date,
                                "item_cost"=>$in->item_cost,
                                "quantity"=>'1',
                                "remaining_qty"=>'1',
                            );

                            $new_inid = $this->super_model->insert_return_id("fifo_in", $datafifo_in);

                             $update_item_id = array(
                                "item_id"=>$new_item_id,
                                "in_id"=>$new_inid,
                                );

                            $this->super_model->update_where("repair_details", $update_item_id, "repair_id", $repair_id);

                        }
                    }
                 } else if($count_existing_repaired != 0) {

                    $existing_id = $this->super_model->custom_query_single("item_id", "SELECT item_id FROM repair_details WHERE repaired_item_id='$repaired_item' ORDER BY repair_id ASC LIMIT 1");
                   
                     $in_id_fifo = $this->super_model->select_column_where("fifo_in", "in_id", "item_id",$existing_id);
                    $exist_qty = $this->super_model->select_column_where("fifo_in", "quantity", "item_id",$existing_id);
                    
                    $exist_rem_qty = $this->super_model->select_column_where("fifo_in", "remaining_qty", "item_id", $existing_id);

                    $new_qty=$exist_qty + 1;
                    $new_rem_qty=$exist_rem_qty + 1;
                    $dataqty = array(
                        "quantity"=>$new_qty,
                        "remaining_qty"=>$new_rem_qty
                    ); 

                     $this->super_model->update_where("fifo_in", $dataqty, "item_id", $existing_id);

                      $update_item_id = array(
                        "item_id"=>$existing_id,
                        "in_id"=>$in_id_fifo,
                        );

                    $this->super_model->update_where("repair_details", $update_item_id, "repair_id", $repair_id);
                 }



                $damage_data = array(
                        'repaired'=>1,
                ); 
                $this->super_model->update_custom_where("damage_details", $damage_data, "in_id='$inid' AND damage_det_id ='$damagedetid'"); 
              
               // echo "in_id='$inid' AND damage_det_id ='$damagedetid'";
            }
           
        }
    }


    public function repair_form(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['receive'] = $this->super_model->select_all('employees');
        foreach($this->super_model->custom_query("SELECT * FROM repair_details WHERE saved = '0'") AS $repair){
            $item_id=$this->super_model->select_column_where("fifo_in","item_id","in_id",$repair->in_id);
            $receive_date=$this->super_model->select_column_where("fifo_in","receive_date","in_id",$repair->in_id);
            $pr_no=$this->super_model->select_column_where("fifo_in","pr_no","in_id",$repair->in_id);
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
            $damage_det_id=$this->super_model->select_column_where("damage_details","damage_det_id","damage_det_id",$repair->damage_det_id);
            $damage_qty= $this->super_model->select_column_where("damage_details","damage_qty","damage_det_id",$damage_det_id);
            $repair_qty= $this->super_model->select_sum_where("repair_details", "quantity", "damage_det_id='$damage_det_id' AND saved='1' AND assessment='1'");
            $cat_id = $this->super_model->select_column_where("items","category_id","item_id",$repair->repaired_item_id);
            $subcat_id = $this->super_model->select_column_where("items","subcat_id","item_id",$repair->repaired_item_id);
            $avail_qty= $damage_qty-$repair_qty;
           // if($repair->saved == 0 AND $repair->unsaved==1){
                /*$data['rep'][]=array(
                    'repair_id'=>$repair->repair_id,
                    'damage_det_id'=>$repair->damage_det_id,
                    'in_id'=>$repair->in_id,
                    'avail_qty'=>$avail_qty,
                );*/
           // }
            $data['details'][]=array(
                 'repair_id'=>$repair->repair_id,
                'in_id'=>$repair->in_id,
                'damage_det_id'=>$repair->damage_det_id,
                'receive_date'=>$receive_date,
                'avail_qty'=>$avail_qty,
                'pr_no'=>$pr_no,
                'item_name'=>$item_name,
                'category'=>$this->super_model->select_column_where('item_categories', 'cat_name', 'cat_id', $cat_id),
                'subcategory'=>$this->super_model->select_column_where('item_subcat', 'subcat_name', 'subcat_id', $subcat_id),
            );
        }
        $this->load->view('repair/repair_form', $data);
        $this->load->view('template/footer');
    }


}