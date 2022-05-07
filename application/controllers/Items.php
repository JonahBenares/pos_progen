<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

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


    public function item_list(){
        $original_pn=$this->uri->segment(3);
        $item=$this->uri->segment(4);
        $location=$this->uri->segment(5);
        $rack=$this->uri->segment(6);
        $data['original_pn']=$original_pn;
        $data['item']=$item;
        $data['locations']=$location;
        $data['racks']=$rack;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['item_drp'] = $this->super_model->select_all_order_by('items',"item_name","ASC");
        $data['category'] = $this->super_model->select_all('item_categories');
        $data['subcat'] = $this->super_model->select_all('item_subcat');
        $data['group'] = $this->super_model->select_all('groups');
        $data['location'] = $this->super_model->select_all('location');
        $data['warehouse'] = $this->super_model->select_all('warehouse');
        $data['bin'] = $this->super_model->select_all('bin');
        $data['rack'] = $this->super_model->select_all('rack');
        $now = date("Y-m-d");
        $sql="";
        $filter='';
        if($original_pn!='null' && $original_pn!=''){
            $sql.= " original_pn = '$original_pn' AND";
            $filter.=$original_pn.", ";
        }

        if($item!='null' && $item!=''){
            $sql.= " item_id = '$item' AND";
            $filter.=$this->super_model->select_column_where("items","item_name","item_id",$item).", ";
        }

        if($location!='null' && $location!=''){
            $sql.= " location_id = '$location' AND";
            $filter.=$this->super_model->select_column_where("location","location_name","location_id",$location).", ";
        }

        if($rack!='null' && $rack!=''){
            $sql.= " rack_id = '$rack' AND";
            $filter.=$this->super_model->select_column_where("rack","rack_name","rack_id",$rack).", ";
        }
        $query=substr($sql,0,-3);
        $filter=substr($filter, 0, -2);
        $data['filter']=$filter;
        if($filter==''){
            $row=$this->super_model->count_rows("items");
            if($row!=0){
                foreach($this->super_model->select_all('items') AS $itm){
                    $highest_cost=$this->super_model->get_max_where("fifo_in", "item_cost","item_id='$itm->item_id' AND (expiry_date='' OR expiry_date > '$now')");
                    $bin = $this->super_model->select_column_where('bin', 'bin_name', 'bin_id', $itm->bin_id);
                    $rack = $this->super_model->select_column_where('rack', 'rack_name', 'rack_id', $itm->rack_id);
                    $warehouse = $this->super_model->select_column_where('warehouse', 'warehouse_name', 
                        'warehouse_id', $itm->warehouse_id);
                    $location = $this->super_model->select_column_where('location', 'location_name', 
                        'location_id', $itm->location_id);
                    $unit = $this->super_model->select_column_where('uom', 'unit_name', 'unit_id', $itm->unit_id);
                    $totalqty= $this->super_model->select_sum_where("fifo_in", "remaining_qty", "item_id='$itm->item_id' AND (expiry_date='' OR expiry_date > '$now')");
                    $data['items'][] = array(
                        'item_id'=>$itm->item_id,
                        'original_pn'=>$itm->original_pn,
                        'item_name'=>$itm->item_name,
                        'category'=>$this->super_model->select_column_where('item_categories', 'cat_name', 
                        'cat_id', $itm->category_id),
                        'subcategory'=>$this->super_model->select_column_where('item_subcat', 'subcat_name', 
                        'subcat_id', $itm->subcat_id),
                        'bin'=>$bin,
                        'rack'=>$rack,
                        'quantity'=>$totalqty,
                        'warehouse'=>$warehouse,
                        'location'=>$location,                
                        'highest_cost'=>$highest_cost,
                        'uom'=>$unit
                    );
                }
            }else{
                $data['items'] = array();
            }
        }else{
            $row=$this->super_model->count_custom("SELECT * FROM items WHERE $query");
            if($row!=0){
                foreach($this->super_model->custom_query("SELECT * FROM items WHERE $query") AS $itm){
                    $highest_cost=$this->super_model->get_max_where("fifo_in", "item_cost","item_id='$itm->item_id' AND (expiry_date='' OR expiry_date > '$now')");
                    $bin = $this->super_model->select_column_where('bin', 'bin_name', 'bin_id', $itm->bin_id);
                    $rack = $this->super_model->select_column_where('rack', 'rack_name', 'rack_id', $itm->rack_id);
                    $warehouse = $this->super_model->select_column_where('warehouse', 'warehouse_name', 
                        'warehouse_id', $itm->warehouse_id);
                    $location = $this->super_model->select_column_where('location', 'location_name', 
                        'location_id', $itm->location_id);
                    $unit = $this->super_model->select_column_where('uom', 'unit_name', 'unit_id', $itm->unit_id);
                    $totalqty= $this->super_model->select_sum_where("fifo_in", "remaining_qty", "item_id='$itm->item_id' AND (expiry_date='' OR expiry_date > '$now')");
                    $data['items'][] = array(
                        'item_id'=>$itm->item_id,
                        'original_pn'=>$itm->original_pn,
                        'item_name'=>$itm->item_name,
                        'category'=>$this->super_model->select_column_where('item_categories', 'cat_name', 
                        'cat_id', $itm->category_id),
                        'subcategory'=>$this->super_model->select_column_where('item_subcat', 'subcat_name', 
                        'subcat_id', $itm->subcat_id),
                        'bin'=>$bin,
                        'rack'=>$rack,
                        'quantity'=>$totalqty,
                        'warehouse'=>$warehouse,
                        'location'=>$location,                
                        'highest_cost'=>$highest_cost,
                        'uom'=>$unit
                    );
                }
            }else{
                $data['items'] = array();
            }
        }
        $this->load->view('items/item_list', $data);
        $this->load->view('template/footer');
    }

    public function add_item(){
        $id=$this->uri->segment(3);
        $data['id'] = $id;
        $data['subcat'] = $this->super_model->select_all_order_by('item_subcat', 'subcat_name', 'ASC');
        $data['group'] = $this->super_model->select_all_order_by('groups','group_name','ASC');
        $data['location'] = $this->super_model->select_all_order_by('location','location_name','ASC');
        $data['warehouse'] = $this->super_model->select_all_order_by('warehouse','warehouse_name','ASC');
        $data['unit'] = $this->super_model->select_all_order_by('uom','unit_name','ASC');
        $data['rack'] = $this->super_model->select_all_order_by('rack','rack_name','ASC');
        $data['bin'] = $this->super_model->select_all_order_by('bin','bin_name','ASC');
        //$data['supplier'] = $this->super_model->select_all_order_by('supplier','supplier_name','ASC');
        //$data['serial_number'] = $this->super_model->select_all_order_by('serial_number','serial_no','ASC');
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('items/add_item', $data);
        $this->load->view('template/footer');
    }

    public function getcategory(){
        $subcat = $this->input->post('subcat');
        $cat_id= $this->super_model->select_column_where('item_subcat', 'cat_id', 'subcat_id', $subcat);

        $subcat_prefix= $this->super_model->select_column_where('item_subcat', 'subcat_prefix', 'subcat_id', $subcat);
        $cat = $this->super_model->select_column_where('item_categories', 'cat_name', 'cat_id', $cat_id);

        $rows=$this->super_model->count_custom_where("pn_series","subcat_prefix = '$subcat_prefix'");

        if($rows==0){
            $pn_no= $subcat_prefix."_1001";
        } else {
            $series = $this->super_model->get_max_where("pn_series", "series","subcat_prefix = '$subcat_prefix'");
            $next=$series+1;
            $pn_no = $subcat_prefix."_".$next;
        }
        
        
        $return = array('catid' => $cat_id, 'cat' => $cat, 'pn' => $pn_no);
        echo json_encode($return);
    }

    public function getsubcat(){  
        $postData = $this->input->post();
        $data = $this->super_model->getsubcat($postData);
        echo json_encode($data); 
    }

    public function search(){
        $type=$this->input->post('type');
        //echo "hi";
        if($type=='item'){
            $item_name=$this->input->post('itemname');   
            $this->load->model('item_model');
            return $this->item_model->select_item('items', "item_name = '$item_name'");
            //return 0;
        }
    } 

    public function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public function insert_item(){
        $timestamp = date('Y-m-d H:i:s');
        $itemdesc=$this->clean($this->input->post('item_name'));
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['img1']['name'])){
             $img1= basename($_FILES['img1']['name']);
             $img1=explode('.',$img1);
             $ext1=$img1[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename1=$itemdesc.'1.'.$ext1;
                 move_uploaded_file($_FILES["img1"]['tmp_name'], $dest.'/'.$filename1);
            }

        } else {
            $filename1="";
        }

        if(!empty($_FILES['img2']['name'])){
             $img2= basename($_FILES['img2']['name']);
             $img2=explode('.',$img2);
             $ext2=$img2[1];
             
            if($ext2=='php' || ($ext2!='png' && $ext2 != 'jpg' && $ext2!='jpeg')){
                $error_ext++;
            } else {
                $filename2=$itemdesc.'2.'.$ext2;
                move_uploaded_file($_FILES["img2"]['tmp_name'], $dest.'/'.$filename2);
            }
        } else {
            $filename2="";
        }

        if(!empty($_FILES['img3']['name'])){
             $img3= basename($_FILES['img3']['name']);
             $img3=explode('.',$img3);
             $ext3=$img3[1];
            
            if($ext3=='php' || ($ext3!='png' && $ext3 != 'jpg' && $ext3!='jpeg')){
                $error_ext++;
            } else {
                $filename3=$itemdesc.'3.'.$ext3;
                move_uploaded_file($_FILES["img3"]['tmp_name'], $dest.'/'.$filename3);
            }
        } else {
            $filename3="";
        }

        if($error_ext!=0){
            echo "ext";
        } else {
      
            $row_item=$this->super_model->count_rows("items");
            if($row_item==0){
                $item_id=1;
            } else {
                 $maxid=$this->super_model->get_max("items", "item_id");
                 $item_id=$maxid+1;
            }

            $pnformat=$this->input->post('pnformat');

            if($pnformat==1){
                $pndetails=explode("_", $this->input->post('pn'));
                $subcat_prefix=$pndetails[0];
                $series = $pndetails[1];

                $rows=$this->super_model->count_custom_where("pn_series","subcat_prefix = '$subcat_prefix'");
                if($rows==0){
                    $next= "1001";
                    $pn_no= $subcat_prefix."_1001";
                } else {
                    $series = $this->super_model->get_max_where("pn_series", "series","subcat_prefix = '$subcat_prefix'");
                    $next=$series+1;
                    $pn_no = $subcat_prefix."_".$next;
                }

                $pn_data= array(
                    'subcat_prefix'=>$subcat_prefix,
                    'series'=>$next
                );
                $this->super_model->insert_into("pn_series", $pn_data);
            } else {
                $pn_no = $this->input->post('pn');
            }

              $data = array(
                    'item_id' => $item_id,
                    'category_id' => $this->input->post('cat'),
                    'subcat_id' => $this->input->post('subcat'),
                    'original_pn' => $pn_no,
                    'item_name' => $this->input->post('item_name'),
                    'unit_id' => $this->input->post('unit'),
                    'group_id' => $this->input->post('group'),
                    'location_id' => $this->input->post('location'),
                    'warehouse_id' => $this->input->post('warehouse'),
                    'bin_id' => $this->input->post('bin'),
                    'rack_id' => $this->input->post('rack'),
                    'nkk_no' => $this->input->post('nkk_no'),
                    'semt_no' => $this->input->post('semt_no'),
                    'barcode' => $this->input->post('barcode'),
                    'weight' => $this->input->post('weight'),
                    'picture1' => $filename1,
                    'picture2' => $filename2,
                    'picture3' => $filename3,
                    'date_added'=>$timestamp,
                    'added_by'=>$_SESSION['user_id']
             );


              if($this->super_model->insert_into("items", $data)){
                echo $item_id;
              }
        }
    }  

    public function update_item(){   
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['items'] = $this->super_model->select_row_where('items', 'item_id', $id);

        $catid=$this->super_model->select_column_where("items", "category_id", "item_id", $id);
        $data['cat_name'] = $this->super_model->select_column_where("item_categories", "cat_name", "cat_id", $catid);

        $orig_pn=$this->super_model->select_column_where("items", "original_pn", "item_id", $id);
        $pn_details=explode("_",$orig_pn);
        if(count($pn_details)<2){
            $prefix=0;
            $series=0;
        } else {
            $prefix=$pn_details[0];
            $series=$pn_details[1];
        }

        $row_count = $this->super_model->count_custom_where("pn_series","subcat_prefix='$prefix' AND series = '$series'");
        if($row_count!=0){
            $data['pn_format']=1;
        } else {
            $data['pn_format']=0;
        }


        $data['subcat'] = $this->super_model->select_all_order_by('item_subcat', 'subcat_name', 'ASC');
        $data['group'] = $this->super_model->select_all_order_by('groups','group_name','ASC');
        $data['location'] = $this->super_model->select_all_order_by('location','location_name','ASC');
        $data['warehouse'] = $this->super_model->select_all_order_by('warehouse','warehouse_name','ASC');
        $data['unit'] = $this->super_model->select_all_order_by('uom','unit_name','ASC');
        $data['rack'] = $this->super_model->select_all_order_by('rack','rack_name','ASC');
        $data['bin'] = $this->super_model->select_all_order_by('bin','bin_name','ASC');
        $this->load->view('items/update_item',$data);
        $this->load->view('template/footer');
    }

        public function savechanges_item(){
        $itemdesc=$this->clean($this->input->post('item_name'));
        $item_id=$this->input->post('item_id');
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['img1']['name'])){
             $img1= basename($_FILES['img1']['name']);
             $img1=explode('.',$img1);
             $ext1=$img1[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename1=$item_id.'1.'.$ext1;
                 move_uploaded_file($_FILES["img1"]['tmp_name'], $dest.'\/'.$filename1);
                 $data_pic1 = array(
                    'picture1'=>$filename1
                 );
                 $this->super_model->update_where("items", $data_pic1, "item_id", $item_id);
            }

        }

        if(!empty($_FILES['img2']['name'])){
             $img2= basename($_FILES['img2']['name']);
             $img2=explode('.',$img2);
             $ext2=$img2[1];
             
            if($ext2=='php' || ($ext2!='png' && $ext2 != 'jpg' && $ext2!='jpeg')){
                $error_ext++;
            } else {
                $filename2=$item_id.'2.'.$ext2;
                move_uploaded_file($_FILES["img2"]['tmp_name'], $dest.'\/'.$filename2);
                 $data_pic2 = array(
                    'picture2'=>$filename2
                 );
                 $this->super_model->update_where("items", $data_pic2, "item_id", $item_id);
            }
        } 

        if(!empty($_FILES['img3']['name'])){
             $img3= basename($_FILES['img3']['name']);
             $img3=explode('.',$img3);
             $ext3=$img3[1];
            
            if($ext3=='php' || ($ext3!='png' && $ext3 != 'jpg' && $ext3!='jpeg')){
                $error_ext++;
            } else {
                $filename3=$item_id.'3.'.$ext3;
                move_uploaded_file($_FILES["img3"]['tmp_name'], $dest.'\/'.$filename3);
                $data_pic3 = array(
                    'picture3'=>$filename3
                 );
                 $this->super_model->update_where("items", $data_pic3, "item_id", $item_id);
            }
        } 

        if($error_ext!=0){
            echo "ext";
        } else {
            
            $orig_pn=$this->super_model->select_column_where("items", "original_pn", "item_id", $item_id);

            $pnformat=$this->input->post('pnformat');

            if($pnformat==1){
                $pndetails=explode("_", $this->input->post('pn'));
                $subcat_prefix=$pndetails[0];
                $series = $pndetails[1];

                $rows=$this->super_model->count_custom_where("pn_series","subcat_prefix = '$subcat_prefix'");
                if($rows==0){
                    $next= "1001";
                    $pn_no= $subcat_prefix."_1001";
                } else {
                    $pn_no=$this->input->post('pn');
                }

            }else {
                $pn_no=$this->input->post('pn');
            }

              $data = array(
                    'category_id' => $this->input->post('cat'),
                    'subcat_id' => $this->input->post('subcat'),
                    'original_pn' => $pn_no,
                    'item_name' => $this->input->post('item_name'),
                    'unit_id' => $this->input->post('unit'),
                    'group_id' => $this->input->post('group'),
                    'location_id' => $this->input->post('location'),
                    'warehouse_id' => $this->input->post('warehouse'),
                    'bin_id' => $this->input->post('bin'),
                    'rack_id' => $this->input->post('rack'),
                    'nkk_no' => $this->input->post('nkk_no'),
                    'semt_no' => $this->input->post('semt_no'),
                    'barcode' => $this->input->post('barcode'),
                    'weight' => $this->input->post('weight'),
             );
        
              if($this->super_model->update_where("items", $data, "item_id", $item_id)){
                echo $item_id;
              }
        }
    }

    public function damage_item()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('items/damage_item');
        $this->load->view('template/footer');
    }

    public function damage_item_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('items/damage_item_list');
        $this->load->view('template/footer');
    }

    public function delete_item(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('items', 'item_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."items/item_list'; </script>";
        }
    }

    public function deleteImage(){
         $dest= realpath(APPPATH . '../uploads/');
         $id=$this->input->post('id');
         $pic=$this->input->post('pic');
            
         if($pic=='picture1'){
          
            $pic=$dest."\/".$this->super_model->select_column_where('items', 'picture1', 'item_id', $id);
             if(unlink($pic)){
                $data = array(
                    'picture1'=>""
                );
                if($this->super_model->update_where("items", $data, "item_id", $id)){
                    echo $id;
                }
             }
         } else if($pic=='picture2'){
             $pic=$dest."\/".$this->super_model->select_column_where('items', 'picture2', 'item_id', $id);
             if(unlink($pic)){
                $data = array(
                    'picture2'=>""
                );
                 if($this->super_model->update_where("items", $data, "item_id", $id)){
                    echo $id;
                }
             }
         } else if($pic=='picture3'){
            $pic=$dest."\/".$this->super_model->select_column_where('items', 'picture3', 'item_id', $id);
             if(unlink($pic)){
                $data = array(
                    'picture3'=>""
                );
                 if($this->super_model->update_where("items", $data, "item_id", $id)){
                    echo $id;
                }
             }
         }
     }

    public function view_item(){
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $today = date("Y-m-d");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $row=$this->super_model->count_rows("items");
        $row1=$this->super_model->count_rows_where("fifo_in","item_id",$id);
        if($row1!=0){
          

            foreach($this->super_model->select_row_where('fifo_in','item_id', $id) AS $in){
                        $data['fifo_in'][] = array( 
                            'item_id'=>$in->item_id,
                            'receive_date'=>$in->receive_date,
                            'supplier_id'=>$in->supplier_id,
                            'pr_no'=>$in->pr_no,
                            'catalog_no'=>$in->catalog_no,
                            'brand'=>$in->brand,
                            'serial_no'=>$in->serial_no,
                            'expiry_date'=>$in->expiry_date,
                            'item_cost'=>$in->item_cost,
                            'quantity'=>$in->quantity,
                            'remaining_qty'=>$in->remaining_qty,
                            'supplier'=>$this->super_model->select_column_where('supplier', 'supplier_name','supplier_id', $in->supplier_id),
                        );
                } 
            } 
        else{
            $data['fifo_in'] = array();
        }

        if($row!=0){
            foreach($this->super_model->select_row_where('items', 'item_id', $id) AS $det){
                $highest_cost=$this->super_model->get_max_where("fifo_in", "item_cost","item_id=$det->item_id AND expiry_date <= '$today' AND expiry_date!=''");
                $totalqty= $this->super_model->select_sum_where("fifo_in", "remaining_qty", "item_id=$det->item_id AND (expiry_date > '$today' OR expiry_date = '')");
                $expired_qty= $this->super_model->select_sum_where("fifo_in", "remaining_qty", "item_id=$det->item_id AND expiry_date <= '$today' AND expiry_date!=''");
                $data['details'][] = array(
                    'item_id'=>$det->item_id,
                    'original_pn'=>$det->original_pn,
                    'item_name'=>$det->item_name,
                    'picture1'=>$det->picture1,
                    'picture2'=>$det->picture2,
                    'picture3'=>$det->picture3,
                    'unit'=>$this->super_model->select_column_where('uom', 'unit_name','unit_id', $det->unit_id),
                    'category'=>$this->super_model->select_column_where('item_categories', 'cat_name','cat_id', $det->category_id),
                    'subcategory'=>$this->super_model->select_column_where('item_subcat', 'subcat_name','subcat_id', $det->subcat_id),
                    'group'=>$this->super_model->select_column_where('groups', 'group_name','group_id', $det->group_id),
                    'location'=>$this->super_model->select_column_where('location', 'location_name', 'location_id', $det->location_id),
                    'bin'=>$this->super_model->select_column_where('bin', 'bin_name', 'bin_id', $det->bin_id),
                    'warehouse'=>$this->super_model->select_column_where('warehouse', 'warehouse_name', 'warehouse_id', $det->warehouse_id),
                    'rack'=>$this->super_model->select_column_where('rack', 'rack_name','rack_id', $det->rack_id),
                    'barcode'=>$det->barcode,
                    'highest_cost'=>$highest_cost,
                    'totalqty'=>$totalqty,
                    'expired_qty'=>$expired_qty,
                    'weight'=>$det->weight,
                    'nkk_no'=>$det->nkk_no,
                    'semt_no'=>$det->semt_no,
                );
            }
        }else{
            $data['details'] = array();
        }
        $this->load->view('items/view_item',$data);
        $this->load->view('template/footer');
    }
   
    public function export_item(){
        $date_from=$this->uri->segment(3);
        $date_to=$this->uri->segment(4);
        $now = date("Y-m-d");
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="items.xlsx";
        $objPHPExcel = new PHPExcel();
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Date From: ".date('F d,Y',strtotime($date_from)));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "Date To: ".date('F d,Y',strtotime($date_to)));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "Part Number");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', "Item Description");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', "Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', "UOM");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "Location");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', "Rack");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', "Highest Cost");
        $num=3;
        foreach($this->super_model->custom_query("SELECT * FROM fifo_in fi INNER JOIN items i ON i.item_id=fi.item_id WHERE receive_date BETWEEN '$date_from' AND '$date_to' GROUP BY fi.item_id") AS $itm){
            $totalqty= $this->super_model->select_sum_where("fifo_in", "remaining_qty", "receive_date BETWEEN '$date_from' AND '$date_to' AND item_id='$itm->item_id' AND (expiry_date='' OR expiry_date > '$now')");
            $highest_cost=$this->super_model->get_max_where("fifo_in", "item_cost","receive_date BETWEEN '$date_from' AND '$date_to' AND item_id='$itm->item_id' AND (expiry_date='' OR expiry_date > '$now')");
            $rack = $this->super_model->select_column_where('rack', 'rack_name', 'rack_id', $itm->rack_id);
            $location = $this->super_model->select_column_where('location', 'location_name','location_id', $itm->location_id);
            $unit = $this->super_model->select_column_where('uom', 'unit_name', 'unit_id', $itm->unit_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $itm->original_pn);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$num, $itm->item_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $totalqty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $unit);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $location);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$num, $rack);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $highest_cost);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":J".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$num.":G".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->mergeCells('B2:E2');
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$num.":E".$num);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A2:J2")->applyFromArray($styleArray);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="items.xlsx"');
        readfile($exportfilename);
    }

}