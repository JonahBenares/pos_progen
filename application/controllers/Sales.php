<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

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


    public function goods_sales_list()
    {
        $data['list'] = $this->super_model->select_row_where("sales_good_head", "saved", "1");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_sales_list', $data);
        $this->load->view('template/footer');

    }

    public function export_salesgood(){
        $df= $this->uri->segment(3);
        $dt= $this->uri->segment(4);
        
        
        $date_from =$df. " 00:00:00";

        $date_to = $dt . " 00:00:00";
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Sales Good.xlsx";
        $objPHPExcel = new PHPExcel();
        $gdImage = imagecreatefrompng('assets/images/progen_logow.png');
       
        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        $objDrawing->setName('Sample image');
        $objDrawing->setDescription('Sample image');
        $objDrawing->setImageResource($gdImage);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setHeight(75);
        $objDrawing->setOffsetX(25);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "PROGEN Dieseltech Services Corp.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Purok San Jose, Brgy. Calumangan, Bago City");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "Negros Occidental, Philippines 6101");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', "Tel. No. 476 - 7382");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "SALES GOOD REPORT");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', "Date From:");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B5', $df);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', "Date To:");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D5', $dt);


        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', "Sales Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', "Client");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G7', "DR No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I7', "PGC PR No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K7', "PR Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M7', "PGC PO No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O7', "PO Date");
        $num=8;
         foreach($this->super_model->select_custom_where("sales_good_head","saved='1' AND sales_date between '$date_from' AND '$date_to' ORDER BY sales_date ASC") AS $re){
            $client=$this->super_model->select_column_where('client','buyer_name',"client_id",$re->client_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $re->sales_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $client);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $re->dr_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$num, $re->pr_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$num, $re->pr_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$num, $re->po_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$num, $re->po_date);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":P".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":F".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('G'.$num.":H".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('I'.$num.":J".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('K'.$num.":L".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('M'.$num.":N".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('O'.$num.":P".$num);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('H2:P2');
        $objPHPExcel->getActiveSheet()->getStyle('H2:P2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2:P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->mergeCells('A6:B6');
        $objPHPExcel->getActiveSheet()->mergeCells('C6:F6');
        $objPHPExcel->getActiveSheet()->mergeCells('G6:H6');
        $objPHPExcel->getActiveSheet()->mergeCells('I6:J6');
        $objPHPExcel->getActiveSheet()->mergeCells('K6:L6');
        $objPHPExcel->getActiveSheet()->mergeCells('M6:N6');
        $objPHPExcel->getActiveSheet()->mergeCells('O6:P6');
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A6:P6")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A4:P4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:P2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:P3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:P4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:P2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:P3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:P4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('P1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('P2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('P3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('P4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Sales Good.xlsx"');
        readfile($exportfilename);
    }

    public function get_name($table, $name, $column, $value){
        $val = $this->super_model->select_column_where($table, $name, $column, $value);
        return $val;
    }
    public function goods_add_sales_head(){
        $sales_good_head_id = $this->uri->segment(3);
        $data['sales_good_head_id'] = $this->uri->segment(3);
        $data['buyer']=$this->super_model->select_all_order_by("client","buyer_name","ASC");
        /*$year_series=date('Y');
        $rows=$this->super_model->count_custom_where("sales_good_head","create_date LIKE '$year_series%'");
        if($rows==0){
             $data['dr_no'] = "PROBCD-".$year_series."-DR-0001";
        } else {
            $maxdr_no=$this->super_model->get_max_where("sales_good_head", "dr_no","create_date LIKE '$year_series%'");
            $drno = explode('-',$maxdr_no);
            $series = $drno[3]+1;
            if(strlen($series)==1){
                $data['dr_no'] = "PROBCD-".$year_series."-DR-000".$series;
            } else if(strlen($series)==2){
                 $data['dr_no'] = "PROBCD-".$year_series."-DR-00".$series;
            } else if(strlen($series)==3){
                 $data['dr_no'] = "PROBCD-".$year_series."-DR-0".$series;
            } else if(strlen($series)==4){
                 $data['dr_no'] = "PROBCD-".$year_series."-DR-".$series;
            }
        }*/
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_add_sales_head',$data);
        $this->load->view('template/footer');
    }

    public function goods_sales_update(){
        $sales_good_head_id = $this->uri->segment(3);
        $data['sales_good_head_id'] = $this->uri->segment(3);
        $data['buyer']=$this->super_model->select_all_order_by("client","buyer_name","ASC");
        foreach($this->super_model->select_custom_where("sales_good_head","saved='1' AND sales_good_head_id='$sales_good_head_id'") AS $sgh){
            $address=$this->super_model->select_column_where("client","address","client_id",$sgh->client_id);
            $tin=$this->super_model->select_column_where("client","tin","client_id",$sgh->client_id);
            $contact_person=$this->super_model->select_column_where("client","contact_person","client_id",$sgh->client_id);
            $contact_no=$this->super_model->select_column_where("client","contact_no","client_id",$sgh->client_id);
            $data['head'][]=array(
                "sales_good_head_id"=>$sgh->sales_good_head_id,
                "client_id"=>$sgh->client_id,
                "address"=>$address,
                "tin"=>$tin,
                "contact_person"=>$contact_person,
                "contact_no"=>$contact_no,
                "sales_date"=>$sgh->sales_date,
                "pr_no"=>$sgh->pr_no,
                "po_no"=>$sgh->po_no,
                "pr_date"=>$sgh->pr_date,
                "po_date"=>$sgh->po_date,
                "dr_no"=>$sgh->dr_no,
                "vat"=>$sgh->vat,
                "remarks"=>$sgh->remarks,
            );
            foreach($this->super_model->select_row_where("sales_good_details","sales_good_head_id",$sgh->sales_good_head_id) AS $sd){
                $serial_no = $this->get_serial($sd->sales_good_det_id, 'final');
                $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$sd->item_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$sd->item_id);
                $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$sd->item_id);
                $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                $data['sales_det'][]=array(
                    "sales_good_det_id"=>$sd->sales_good_det_id,
                    "original_pn"=>$original_pn,
                    "item_name"=>$item_name,
                    "serial_no"=>$serial_no,
                    "unit"=>$unit,
                    "qty"=>$sd->quantity,
                    "expected_qty"=>$sd->expected_qty,
                    "selling_price"=>$sd->selling_price,
                    "discount"=>$sd->discount_amount,
                    "total"=>$sd->total,
                );
            }
        }
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_sales_update',$data);
        $this->load->view('template/footer');
    }

    public function add_sales_head_process(){
        $data=array(
            "client_id"=>$this->input->post('client'),
            "sales_date"=>$this->input->post('sales_date')." ".date("H:i:s"),
            "pr_no"=>$this->input->post('pr_no'),
            "pr_date"=>$this->input->post('pr_date'),
            "po_no"=>$this->input->post('po_no'),
            "po_date"=>$this->input->post('po_date'),
            "dr_no"=>$this->input->post('dr_no'),
            "vat"=>$this->input->post('vat'),
            "remarks"=>$this->input->post('remarks'),
            "create_date"=>date("Y-m-d H:i:s"),
            "user_id"=>$_SESSION['user_id'],
        );
        $id= $this->super_model->insert_return_id("sales_good_head", $data);
        $return = array('sales_good_head_id'=>$id);
        echo json_encode($return);
    }

    public function update_sales(){
        $sales_good_head_id=$this->input->post('sales_good_head_id');
        $data=array(
            "client_id"=>$this->input->post('client'),
            "sales_date"=>$this->input->post('sales_date')." ".date("H:i:s"),
            "pr_no"=>$this->input->post('pr_no'),
            "pr_date"=>$this->input->post('pr_date'),
            "po_no"=>$this->input->post('po_no'),
            "po_date"=>$this->input->post('po_date'),
            "dr_no"=>$this->input->post('dr_no'),
            "vat"=>$this->input->post('vat'),
            "remarks"=>$this->input->post('remarks'),
        );
        if($this->super_model->update_where("sales_good_head", $data, "sales_good_head_id", $sales_good_head_id)){
            $return = array('status'=>'success');
            echo json_encode($return);
        }
    }

    public function update_selling(){
        $sales_good_head_id=$this->input->post('sales_good_head_id');
        $counter=count($this->input->post('selling_price'));
        for($x=0;$x<$counter;$x++){
            $sales_good_det_id=$this->input->post('sales_good_det_id['.$x.']');
            $total=($this->input->post('quantity['.$x.']') * $this->input->post('selling_price['.$x.']')) - $this->input->post('discount['.$x.']');
            $data=array(
                "selling_price"=>$this->input->post('selling_price['.$x.']'),
                "total"=>$total,
            );
            $save=$this->super_model->update_where("sales_good_details", $data, "sales_good_det_id", $sales_good_det_id);
        }
        echo $sales_good_head_id;
    }

    public function update_discount(){
        $sales_good_head_id=$this->input->post('sales_good_head_id');
        $counter=count($this->input->post('discount'));
        for($x=0;$x<$counter;$x++){
            $sales_good_det_id=$this->input->post('sales_good_det_id['.$x.']');
            $total=($this->input->post('quantity['.$x.']') * $this->input->post('selling_price['.$x.']')) - $this->input->post('discount['.$x.']');
            $data=array(
                "discount_amount"=>$this->input->post('discount['.$x.']'),
                "total"=>$total,
            );
            $save=$this->super_model->update_where("sales_good_details", $data, "sales_good_det_id", $sales_good_det_id);
        }
        echo $sales_good_head_id;
    }

    public function cancel_sales(){
        $id = $this->input->post('id');
        $this->super_model->delete_where("sales_good_head", "sales_good_head_id", $id);
        foreach($this->super_model->select_custom_where("sales_good_details","sales_good_head_id='$id'") AS $del){
            $this->super_model->delete_where("temp_sales_out", "sales_details_id", $del->sales_good_det_id);
            $this->super_model->delete_where("sales_good_details", "sales_good_head_id", $id);
        }
    }

    public function client_info(){
        $client_id=$this->input->post('client_id');
        foreach($this->super_model->select_row_where("client","client_id",$client_id) AS $cli){
            $return = array('address'=>$cli->address, 'tin'=>$cli->tin, 'buyer_name'=>$cli->buyer_name, 'contact_person'=>$cli->contact_person, 'contact_no'=>$cli->contact_no);
        }
        echo json_encode($return);
    }

    public function goods_add_sales_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_add_sales_itemlist');
        $this->load->view('template/footer');
    }
   
    public function goods_add_sales_item(){
        $data['sales_good_head_id']=$this->uri->segment(3);
        $today = date("Y-m-d");
        foreach($this->super_model->select_custom_where("fifo_in","remaining_qty!='0' AND (expiry_date ='' OR expiry_date >= '$today') GROUP BY item_id") AS $fi){
            $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$fi->item_id);
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$fi->item_id);
            $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$fi->item_id);
            $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            //$expire = date("Y-m-d",strtotime($fi->expiry_date));
            //if($expire > $today || $fi->expiry_date==''){
                $data['fifo_in'][]= array(
                    'item_id'=>$fi->item_id,
                    'in_id'=>$fi->in_id,
                    'original_pn'=>$original_pn,
                    'item_name'=>$item_name,
                    'unit_cost'=>$fi->item_cost,
                    'unit'=>$unit,
                    'serial_no'=>$fi->serial_no,
                    'remaining_qty'=>$fi->remaining_qty,
                );
            //}
        }
        $this->load->view('template/header');
        $this->load->view('sales/goods_add_sales_item',$data);
        $this->load->view('template/footer');
    }

    public function item_info(){
        $in_id=$this->input->post('in_id');
        $item_id=$this->input->post('item_id');
        $today = date("Y-m-d");
        foreach($this->super_model->select_row_where("fifo_in","in_id",$in_id) AS $itm){
            $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$itm->item_id);
            $group_id = $this->super_model->select_column_where("items","group_id","item_id",$itm->item_id);
            $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $remaining_qty_disp = $this->super_model->select_sum_where("fifo_in","remaining_qty","item_id='$itm->item_id' AND remaining_qty!='0' AND (expiry_date ='' OR expiry_date > '$today')");
            $return = array('serial_no'=>$itm->serial_no, 'unit_cost'=>$itm->item_cost, 'quantity'=>$itm->remaining_qty, 'unit'=>$unit, 'group_id'=>$group_id, 'item_id'=>$item_id,'remaining_qty'=>$remaining_qty_disp);
        }
        echo json_encode($return);
    }

    public function qty_info(){
        $item_id=$this->input->post('item_id');
        $qty=$this->input->post('qty');
        $now =date("Y-m-d");
        $fifo=array();
        $deduct_temp=0;
        $temp_qty=$qty;
        $trigger=1;
        $in_qty = $this->super_model->select_sum_where("fifo_in", "remaining_qty", "item_id = '$item_id' AND (expiry_date ='' or expiry_date > '$now')"); 
        $deduct_temp = $this->super_model->select_sum_where("temp_sales_out", "quantity", "item_id = '$item_id'");
        $total_qty = $in_qty - $deduct_temp;
        $serial="";
        if($total_qty >= $qty){
            foreach($this->super_model->select_custom_where("fifo_in","item_id = '$item_id' AND (expiry_date ='' or expiry_date > '$now') AND remaining_qty !='0' ORDER BY receive_date ASC") AS $itm){
                  
                if($temp_qty > 0){
                    $temp_qty = $temp_qty - $itm->remaining_qty;
                    if($temp_qty>0){
                        $quantity = $itm->remaining_qty;
                    } else {
                        $quantity = $itm->remaining_qty + $temp_qty;
                    }
                      $fifo[] = array(
                        'in_id'=>$itm->in_id,
                        'cost'=>$itm->item_cost,
                        'temp_qty'=>$quantity
                    );
                    $serial.=$itm->serial_no . ", ";

                }
            }
            $highest_cost = max(array_column($fifo, 'cost'));
            $serial = substr($serial, 0, -2);
            //echo $highest_cost;
            $return = array('status'=>'success','serial_no'=>$serial, 'cost'=>$highest_cost);
        } else {
             $return = array('status'=>'error','serial_no'=>'', 'cost'=>'');
        }
        echo json_encode($return);
        //print_r($fifo);
    }

    public function goods_dr_series(){
        $sales_date=$this->input->post('sales_date');
        $year_series=date('Y', strtotime($sales_date));
        $rows=$this->super_model->count_custom_where("sales_good_head","YEAR(sales_date)='$year_series'");
        //$rows=$this->super_model->count_custom_where("sales_good_head","sales_date LIKE '$year_series%'");
        if($rows==0){
             $dr_no = "PROBCD-".$year_series."-DR-0001";
        } else {
            $maxdr_no=$this->super_model->get_max_where("sales_good_head", "dr_no","YEAR(sales_date)='$year_series'");
            //$maxdr_no=$this->super_model->get_max_where("sales_good_head", "dr_no","sales_date LIKE '$year_series%'");
            $drno = explode('-',$maxdr_no);
            $series = $drno[3]+1;
            if(strlen($series)==1){
                $dr_no = "PROBCD-".$year_series."-DR-000".$series;
            } else if(strlen($series)==2){
                 $dr_no = "PROBCD-".$year_series."-DR-00".$series;
            } else if(strlen($series)==3){
                 $dr_no = "PROBCD-".$year_series."-DR-0".$series;
            } else if(strlen($series)==4){
                 $dr_no = "PROBCD-".$year_series."-DR-".$series;
            }
        }

        $return = array('dr_no'=>$dr_no);
        echo json_encode($return);
    }

    public function services_dr_series(){
        $sales_date=$this->input->post('sales_date');
        $year_series=date('Y', strtotime($sales_date));
        $rows=$this->super_model->count_custom_where("sales_services_head","sales_date LIKE '$year_series%'");
        if($rows==0){
             $dr_no = "PROBCD-".$year_series."-AR-0001";
        } else {
            $maxdr_no=$this->super_model->get_max_where("sales_services_head", "dr_no","sales_date LIKE '$year_series%'");
            $drno = explode('-',$maxdr_no);
            $series = $drno[3]+1;
            if(strlen($series)==1){
                $dr_no = "PROBCD-".$year_series."-AR-000".$series;
            } else if(strlen($series)==2){
                 $dr_no = "PROBCD-".$year_series."-AR-00".$series;
            } else if(strlen($series)==3){
                 $dr_no = "PROBCD-".$year_series."-AR-0".$series;
            } else if(strlen($series)==4){
                 $dr_no = "PROBCD-".$year_series."-AR-".$series;
            }
        }

        $return = array('dr_no'=>$dr_no);
        echo json_encode($return);
    }

    public function insert_items(){
        $sales_good_head_id = $this->input->post('sales_good_head_id');
        $quantity = $this->input->post('quantity');
        $now =date("Y-m-d");
         $in_id = $this->input->post('item');
        /*$sales_good_head_id = 1;
        $in_id = 1;
        $quantity = 7;*/
        $temp_qty=$quantity;
        $item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$in_id);
        //$new_qty = $remaining_qty - $quantity;
        $data=array(
            "sales_good_head_id"=>$sales_good_head_id,
            "unit_cost"=>$this->input->post('unit_cost'),
            "selling_price"=>$this->input->post('selling_price'),
            "item_id"=>$item_id,
            /*"discount_percent"=>$this->input->post('discount'),*/
            "discount_amount"=>$this->input->post('discount'),
            "total"=>$this->input->post('total_cost'),
            "quantity"=>$this->input->post('quantity'),
            "expected_qty"=>$this->input->post('exp_qty'),
        );
        $details_id = $this->super_model->insert_return_id("sales_good_details", $data);



           foreach($this->super_model->select_custom_where("fifo_in","item_id = '$item_id' AND (expiry_date ='' or expiry_date > '$now') ORDER BY receive_date ASC") AS $itm){
                  
               
                   if($temp_qty > 0){

                        $temp_qty = $temp_qty - $itm->remaining_qty;
                
                        if($temp_qty>0){
                            $q = $itm->remaining_qty;
                        } else {
                            $q = $itm->remaining_qty + $temp_qty;
                        }
                     
                              $data_temp = array(
                                'user_id'=>$_SESSION['user_id'],
                                'sales_id'=>$sales_good_head_id,
                                'sales_details_id'=>$details_id,
                                'item_id'=>$item_id,
                                'in_id'=>$itm->in_id,
                                'quantity'=>$q
                            );
                          
                        if($q!=0){
                          $this->super_model->insert_into("temp_sales_out", $data_temp);
                        }
                   
                  }
                     
            }

            
            $count_item = $this->super_model->count_rows_where("sales_good_details","sales_good_head_id",$sales_good_head_id);
            foreach($this->super_model->custom_query("SELECT * FROM sales_good_details WHERE sales_good_head_id='$sales_good_head_id' ORDER BY sales_good_det_id DESC LIMIT 1") AS $app){
                $item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$in_id);
               // $item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$app->in_id);
                $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$item_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
                $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$item_id);
                $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                

                $serial_no = $this->get_serial($app->sales_good_det_id, 'temp');
                echo '<tr id="load_data'.$count_item.'"><td>'.$count_item.'</td><td>'.$original_pn.'</td><td>'.$item_name.'</td><td>'.$serial_no.'</td><td>'.$app->quantity.'</td><td>'.$app->expected_qty.'</td><td>'.$unit.'</td><td>'.number_format($app->selling_price,2).'</td><td>'.number_format($app->discount_amount,2).'</td><td>'.number_format($app->total,2).'</td>  <td><a onclick="delete_sales_item('.$app->sales_good_det_id.','.$count_item.')" class="btn btn-danger btn-xs btn-rounded"><span class="mdi mdi-window-close"></span></a></td> </tr>';
                $count_item++;
        } 
      /*  $count_item = $this->super_model->count_rows_where("sales_good_details","sales_good_head_id",$sales_good_head_id);
        foreach($this->super_model->custom_query("SELECT * FROM sales_good_details WHERE sales_good_head_id='$sales_good_head_id' ORDER BY sales_good_det_id DESC LIMIT 1") AS $app){
            $item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$app->in_id);
            $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$item_id);
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
            $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$item_id);
            $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $serial_no = $this->super_model->select_column_where("fifo_in","serial_no","in_id",$app->in_id);
            echo '<tr id="load_data'.$count_item.'"><td>'.$count_item.'</td><td>'.$original_pn.'</td><td>'.$item_name.'</td><td>'.$serial_no.'</td><td>'.$app->quantity.'</td><td>'.$unit.'</td><td>'.number_format($app->selling_price,2).'</td><td>'.number_format($app->discount_percent,0)."%".'</td><td>'.number_format($app->total,2).'</td>  <td><a onclick="delete_sales_item('.$app->sales_good_det_id.','.$count_item.','.$app->quantity.','.$app->in_id.')" class="btn btn-danger btn-xs btn-rounded"><span class="mdi mdi-window-close"></span></a></td> </tr>';
            $count_item++;
        } 

        foreach($this->super_model->select_custom_where("fifo_in","item_id = '$item_id' AND (expiry_date ='' or expiry_date >= '$now') ORDER BY receive_date ASC") AS $itm){
            if($temp_qty > 0){
                $temp_qty = $temp_qty - $itm->remaining_qty;
                if($temp_qty>0){
                    $q = $itm->remaining_qty;
                } else {
                    $q = $itm->remaining_qty + $temp_qty;
                }
                $data_temp = array(
                    'user_id'=>$_SESSION['user_id'],
                    'sales_id'=>$sales_good_head_id,
                    'sales_details_id'=>$details_id,
                    'item_id'=>$item_id,
                    'in_id'=>$itm->in_id,
                    'quantity'=>$q
                );
                if($q!=0){
                  $this->super_model->insert_into("temp_sales_out", $data_temp);
                }
            }        
        }   */

    }

    public function save_sales(){
        $sales_good_head_id = $this->input->post('sales_good_head_id');
        $user_id = $_SESSION['user_id'];
        foreach($this->super_model->select_custom_where("temp_sales_out","sales_id = '$sales_good_head_id' AND user_id = '$user_id'") AS $tmp){
           /* $sumcost = $this->super_model->select_sum_where("fifo_in", "item_cost", "item_id = '$tmp->item_id'");
            $rowcount=$this->super_model->count_custom_where("fifo_in","item_id = '$tmp->item_id'");
            $count_item=$rowcount;
            $ave = $sumcost/$count_item;
            $dataup=array(
                "ave_cost"=>$ave,
            );
            $this->super_model->update_where("sales_good_details", $dataup, "sales_good_det_id", $tmp->sales_details_id);
*/  
            $unit_cost = $this->super_model->select_column_where("fifo_in", "item_cost", "in_id", $tmp->in_id);
            $selling_price = $this->super_model->select_column_where("sales_good_details", "selling_price", "sales_good_det_id", $tmp->sales_details_id);
            $data = array(
                'in_id'=>$tmp->in_id,
                'item_id'=>$tmp->item_id,
                'transaction_type'=>'Sales Goods',
                'sales_id'=>$sales_good_head_id,
                'sales_details_id'=>$tmp->sales_details_id,
                'unit_cost'=>$unit_cost,
                'selling_price'=>$selling_price,
                'damage_id'=>0,
                'quantity'=>$tmp->quantity,
                'remaining_qty'=>$tmp->quantity
            );   

            $this->super_model->insert_into("fifo_out",$data);

            $rem_qty = $this->super_model->select_column_where("fifo_in", "remaining_qty", "in_id", $tmp->in_id);

            $new_rem_qty = $rem_qty- $tmp->quantity;

            $data_update = array(
                'remaining_qty'=>$new_rem_qty
            );
            $this->super_model->update_where("fifo_in",$data_update, "in_id", $tmp->in_id);

            $data_head = array(
                'saved'=>1
            );
            $this->super_model->update_where("sales_good_head",$data_head, "sales_good_head_id", $sales_good_head_id);
        }

        $this->super_model->delete_custom_where("temp_sales_out","sales_id = '$sales_good_head_id' AND user_id = '$user_id'");
        echo $sales_good_head_id;
    }

    public function delete_item(){
        $sales_good_det_id = $this->input->post('sales_good_det_id');
        $this->super_model->delete_where("sales_good_details", "sales_good_det_id", $sales_good_det_id);
        $this->super_model->delete_where("temp_sales_out", "sales_details_id", $sales_good_det_id);
        /*$in_id = $this->input->post('in_id');
        $quantity = $this->input->post('quantity');
        $remaining_qty = $this->super_model->select_column_where("fifo_in","remaining_qty","in_id",$in_id);
        $new_qty = $remaining_qty + $quantity;
        $dataup=array(
            "remaining_qty"=>$new_qty,
        );
        if($this->super_model->update_where("fifo_in", $dataup, "in_id", $in_id)){
            $this->super_model->delete_where("sales_good_details", "sales_good_det_id", $sales_good_det_id);
        }*/
    }

     public function goods_update_sales_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_update_sales_head');
        $this->load->view('template/footer');
    }

    public function goods_update_sales_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/goods_update_sales_itemlist');
        $this->load->view('template/footer');
    }
   
    public function goods_update_sales_item()
    {
        $this->load->view('template/header');
        $this->load->view('sales/goods_update_sales_item');
        $this->load->view('template/footer');
    }

    public function goods_print_sales(){
        $sales_good_head_id = $this->uri->segment(3);
        $data['sales_good_head_id']=$sales_good_head_id;
        foreach($this->super_model->select_custom_where("sales_good_head","sales_good_head_id = '$sales_good_head_id'") AS $sh){
            $client = $this->super_model->select_column_where("client","buyer_name","client_id",$sh->client_id);
            $address = $this->super_model->select_column_where("client","address","client_id",$sh->client_id);
            $contact_person = $this->super_model->select_column_where("client","contact_person","client_id",$sh->client_id);
            $contact_no = $this->super_model->select_column_where("client","contact_no","client_id",$sh->client_id);
            $tin = $this->super_model->select_column_where("client","tin","client_id",$sh->client_id);
            $data['employee']=$this->super_model->select_all_order_by("employees","employee_name","ASC");
            $data['prepared_by']=$sh->user_id;
            $data['prepared']=$this->super_model->select_column_where("users","fullname","user_id",$sh->user_id);
            $data['position']=$this->super_model->select_column_where("users","position","user_id",$sh->user_id);
            $data['released_by']=$sh->released_by;
            $data['released']=$this->super_model->select_column_where("employees","employee_name","employee_id",$sh->released_by);
            $data['released_position']=$this->super_model->select_column_where("employees","position","employee_id",$sh->released_by);
            $data['approved_by']=$sh->approved_by;
            $data['approved']=$this->super_model->select_column_where("employees","employee_name","employee_id",$sh->approved_by);
            $data['approved_position']=$this->super_model->select_column_where("employees","position","employee_id",$sh->approved_by);
            $data['noted_by']=$sh->noted_by;
            $data['noted']=$this->super_model->select_column_where("employees","employee_name","employee_id",$sh->noted_by);
            $data['noted_position']=$this->super_model->select_column_where("employees","position","employee_id",$sh->noted_by);
            $data['sales_head'][]=array(
                'client'=>$client,
                'address'=>$address,
                'contact_person'=>$contact_person,
                'contact_no'=>$contact_no,
                'tin'=>$tin,
                'sales_date'=>$sh->sales_date,
                'vat'=>$sh->vat,
                'pr_no'=>$sh->pr_no,
                'pr_date'=>$sh->pr_date,
                'po_no'=>$sh->po_no,
                'po_date'=>$sh->po_date,
                'dr_no'=>$sh->dr_no,
                'remarks'=>$sh->remarks,
            );
            foreach($this->super_model->select_custom_where("sales_good_details","sales_good_head_id='$sh->sales_good_head_id'") AS $sd){
                $serial_no = $this->get_serial($sd->sales_good_det_id, 'final');
                $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$sd->item_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$sd->item_id);
                $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$sd->item_id);
                $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                //$serial_no = $this->super_model->select_column_where("fifo_in","serial_no","in_id",$sd->in_id);
               
                $data['sales_details'][]=array(
                    'original_pn'=>$original_pn,
                    'item'=>$item_name,
                    'serial_no'=>$serial_no,
                    'expected_qty'=>$sd->expected_qty,
                    'quantity'=>$sd->quantity,
                    'uom'=>$unit,
                    'selling_price'=>$sd->selling_price,
                    'discount'=>$sd->discount_amount,
                    'total'=>$sd->total,
                );
            }
        }
        $this->load->view('template/print_head');
        $this->load->view('sales/goods_print_sales',$data);
    }

    public function release_change(){
        $released_by=$this->input->post('released_by');
        foreach($this->super_model->select_row_where("employees","employee_id",$released_by) AS $emp){
            $return = array('position'=>$emp->position);
        }
        echo json_encode($return);
    }

    public function approve_change(){
        $approved_by=$this->input->post('approved_by');
        foreach($this->super_model->select_row_where("employees","employee_id",$approved_by) AS $emp){
            $return = array('position'=>$emp->position);
        }
        echo json_encode($return);
    }

    public function noted_change(){
        $noted_by=$this->input->post('noted_by');
        foreach($this->super_model->select_row_where("employees","employee_id",$noted_by) AS $emp){
            $return = array('position'=>$emp->position);
        }
        echo json_encode($return);
    }

    public function print_deliver_goods(){
        $id=$this->input->post('sales_good_head_id');
        $data = array(
            "released_by"=>$this->input->post('released_by'),
            "approved_by"=>$this->input->post('approved_by'),
            "noted_by"=>$this->input->post('noted_by')
        );

        $this->super_model->update_where("sales_good_head", $data, "sales_good_head_id", $id);
        echo "success";
    }

    public function get_serial($sales_details_id, $status){
      /*  $sales_details_id='13';
        $status='temp';*/
        $serial="";
        if($status=='final') {
            foreach($this->super_model->select_row_where("fifo_out", "sales_details_id", $sales_details_id) AS $out){
                $serial.=$this->super_model->select_column_where("fifo_in", "serial_no", "in_id", $out->in_id) . ", ";
             }
        } else if($status =='temp') {
            
           foreach($this->super_model->select_row_where("temp_sales_out", "sales_details_id", $sales_details_id) AS $out){
                $serial.=$this->super_model->select_column_where("fifo_in", "serial_no", "in_id", $out->in_id) . ", ";
            }
        }
        //return $table;
      
       return substr($serial,0,-2);
    }

    public function get_serial_services($sales_serv_items_id,$status){
        $serial="";
        if($status=='final') {
            foreach($this->super_model->select_row_where("fifo_out", "sales_serv_items_id", $sales_serv_items_id) AS $out){
                $serial.=$this->super_model->select_column_where("fifo_in", "serial_no", "in_id", $out->in_id) . ", ";
            }
        }else if($status =='temp') {
           foreach($this->super_model->select_row_where("temp_sales_out", "sales_serv_items_id", $sales_serv_items_id) AS $out){
                $serial.=$this->super_model->select_column_where("fifo_in", "serial_no", "in_id", $out->in_id) . ", ";
            }
        }
        return substr($serial,0,-2);
    }

    public function services_add_sales_head(){
        $data['buyer']=$this->super_model->select_all_order_by("client","buyer_name","ASC");
        $data['shipping']=$this->super_model->select_all_order_by("shipping_company","company_name","ASC");
        /*$year_series=date('Y');
        $rows=$this->super_model->count_custom_where("sales_services_head","create_date LIKE '$year_series%'");
        if($rows==0){
             $data['dr_no'] = "PROBCD-".$year_series."-AR-0001";
        } else {
            $maxdr_no=$this->super_model->get_max_where("sales_services_head", "dr_no","create_date LIKE '$year_series%'");
            $drno = explode('-',$maxdr_no);
            $series = $drno[3]+1;
            if(strlen($series)==1){
                $data['dr_no'] = "PROBCD-".$year_series."-AR-000".$series;
            } else if(strlen($series)==2){
                 $data['dr_no'] = "PROBCD-".$year_series."-AR-00".$series;
            } else if(strlen($series)==3){
                 $data['dr_no'] = "PROBCD-".$year_series."-AR-0".$series;
            } else if(strlen($series)==4){
                 $data['dr_no'] = "PROBCD-".$year_series."-AR-".$series;
            }
        }*/
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/services_add_sales_head',$data);
        $this->load->view('template/footer');
    }

    public function add_sales_service_process(){
        $data=array(
            "client_id"=>$this->input->post('client'),
            "sales_date"=>$this->input->post('sales_date')." ".date("H:i:s"),
            "jor_no"=>$this->input->post('jor_no'),
            "jor_date"=>$this->input->post('jor_date'),
            "joi_no"=>$this->input->post('joi_no'),
            "joi_date"=>$this->input->post('joi_date'),
            "date_started"=>$this->input->post('date_started'),
            "date_completed"=>$this->input->post('date_completed'),
            "duration"=>$this->input->post('duration'),
            "overall_remarks"=>$this->input->post('overall_remarks'),
            "dr_no"=>$this->input->post('dr_no'),
            "vat"=>$this->input->post('vat'),
            "remarks"=>$this->input->post('remarks'),
            "waybill_no"=>$this->input->post('waybill_no'),
            "ar_description"=>$this->input->post('ar_description'),
            "shipped_via"=>$this->input->post('shipped_via'),
            "purpose"=>$this->input->post('purpose'),
            "create_date"=>date("Y-m-d H:i:s"),
            "user_id"=>$_SESSION['user_id'],
            "administrative_fee"=>$this->input->post('administrative_fee'),
        );
        $id= $this->super_model->insert_return_id("sales_services_head", $data);
        $return = array('sales_serv_head_id'=>$id);
        echo json_encode($return);
    }

    public function cancel_service(){
        $id = $this->input->post('id');
        $this->super_model->delete_where("sales_services_head", "sales_serv_head_id", $id);
        foreach($this->super_model->select_custom_where("sales_serv_items","sales_serv_head_id='$id'") AS $del){
            $this->super_model->delete_where("temp_sales_out", "sales_serv_items_id", $del->sales_serv_items_id);
            $this->super_model->delete_where("sales_serv_items", "sales_serv_head_id", $id);
            $this->super_model->delete_where("sales_serv_equipment", "sales_serv_head_id", $id);
            $this->super_model->delete_where("sales_serv_manpower", "sales_serv_head_id", $id);
            $this->super_model->delete_where("sales_serv_material", "sales_serv_head_id", $id);
        }
    }

    public function services_add_sales_item(){
        $this->load->view('template/header');
        $data['sales_serv_head_id']=$this->uri->segment(3);
        $today = date("Y-m-d");
        foreach($this->super_model->select_custom_where("fifo_in","remaining_qty!='0' AND (expiry_date ='' OR expiry_date > '$today') GROUP BY item_id") AS $fi){
            $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$fi->item_id);
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$fi->item_id);
            $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$fi->item_id);
            $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            //$expire = date("Y-m-d",strtotime($fi->expiry_date));
            //if($expire > $today || $fi->expiry_date==''){
                $data['fifo_in'][]= array(
                    'item_id'=>$fi->item_id,
                    'in_id'=>$fi->in_id,
                    'original_pn'=>$original_pn,
                    'item_name'=>$item_name,
                    'unit_cost'=>$fi->item_cost,
                    'unit'=>$unit,
                    'serial_no'=>$fi->serial_no,
                    'remaining_qty'=>$fi->remaining_qty,
                );
            //}
        }
        $this->load->view('sales/services_add_sales_item',$data);
        $this->load->view('template/footer');
    }

    public function insert_service_items(){
        $sales_serv_head_id = $this->input->post('sales_serv_head_id');
        $in_id = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $now =date("Y-m-d");
        $temp_qty=$quantity;
        $item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$in_id);
        $data=array(
            "sales_serv_head_id"=>$sales_serv_head_id,
            "item_id"=>$item_id,
            "unit_cost"=>$this->input->post('unit_cost'),
            "selling_price"=>$this->input->post('selling_price'),
            /*"discount_percent"=>$this->input->post('discount'),*/
            "discount_amount"=>$this->input->post('discount_amount'),
            "group_id"=>$this->input->post('group_id'),
            "total"=>$this->input->post('total_cost'),
            "quantity"=>$this->input->post('quantity'),
            "expected_qty"=>$this->input->post('exp_quantity'),
            "remarks"=>$this->input->post('remarks'),
        );
        $details_id = $this->super_model->insert_return_id("sales_serv_items", $data);
        $count_item = $this->super_model->count_rows_where("sales_serv_items","sales_serv_head_id",$sales_serv_head_id);

        foreach($this->super_model->select_custom_where("fifo_in","item_id = '$item_id' AND (expiry_date ='' or expiry_date > '$now') ORDER BY receive_date ASC") AS $itm){
            if($temp_qty > 0){
                $temp_qty = $temp_qty - $itm->remaining_qty;
                if($temp_qty>0){
                    $q = $itm->remaining_qty;
                } else {
                    $q = $itm->remaining_qty + $temp_qty;
                }
                $data_temp = array(
                    'user_id'=>$_SESSION['user_id'],
                    'sales_id'=>$sales_serv_head_id,
                    'sales_serv_items_id'=>$details_id,
                    'item_id'=>$item_id,
                    'in_id'=>$itm->in_id,
                    'quantity'=>$q
                );
                if($q!=0){
                  $this->super_model->insert_into("temp_sales_out", $data_temp);
                }
            }        
        }
        
        foreach($this->super_model->custom_query("SELECT * FROM sales_serv_items WHERE sales_serv_head_id='$sales_serv_head_id' ORDER BY sales_serv_items_id DESC LIMIT 1") AS $app){
            $item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$in_id);
            $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$item_id);
            $item_name = $this->super_model->select_column_where("items","item_name","item_id",$item_id);
            $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$item_id);
            $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $serial_no = $this->get_serial_services($app->sales_serv_items_id,'temp');
            //$serial_no = $this->super_model->select_column_where("fifo_in","serial_no","in_id",$in_id);
            echo '<tr id="load_data'.$count_item.'"><td>'.$count_item.'</td><td>'.$original_pn.'</td><td>'.$item_name.'</td><td>'.$serial_no.'</td><td>'.$app->quantity.'</td><td>'.$app->expected_qty.'</td><td>'.$unit.'</td><td>'.number_format($app->selling_price,2).'</td><td>'.number_format($app->discount_amount,2).'</td><td>'.number_format($app->total,2).'</td><td>'.$app->remarks.'</td>  <td><a onclick="delete_service_item('.$app->sales_serv_items_id.','.$count_item.')" class="btn btn-danger btn-xxs btn-rounded"><span class="mdi mdi-window-close"></span></a></td> </tr>';
            $count_item++;
        }    
    }

    public function sum_serv_price(){
        $sales_serv_head_id = $this->input->post('sales_serv_head_id');
        $total=$this->super_model->select_sum_where("sales_serv_items", "total", "sales_serv_head_id='$sales_serv_head_id'");
        echo $total;
    }

    public function sum_materials_price(){
        $sales_serv_head_id = $this->input->post('sales_serv_head_id');
        $total=$this->super_model->select_sum_where("sales_serv_material", "total_cost", "sales_serv_head_id='$sales_serv_head_id'");
        echo $total;
    }

    public function sum_manpower_price(){
        $sales_serv_head_id = $this->input->post('sales_serv_head_id');
        $total=$this->super_model->select_sum_where("sales_serv_manpower", "total_cost", "sales_serv_head_id='$sales_serv_head_id'");
        echo $total;
    }

    public function sum_equipment_price(){
        $sales_serv_head_id = $this->input->post('sales_serv_head_id');
        $total=$this->super_model->select_sum_where("sales_serv_equipment", "total_cost", "sales_serv_head_id='$sales_serv_head_id'");
        echo $total;
    }

    public function delete_service_item(){
        $sales_serv_items_id = $this->input->post('sales_serv_items_id');
        $this->super_model->delete_where("sales_serv_items", "sales_serv_items_id", $sales_serv_items_id);
        $this->super_model->delete_where("temp_sales_out", "sales_serv_items_id", $sales_serv_items_id);
    }

    public function services_add_consumable(){
        $data['sales_serv_head_id']=$this->uri->segment(3);
        $this->load->view('template/header');
        $this->load->view('sales/services_add_consumable',$data);
        $this->load->view('template/footer');
    }

    public function insert_service_materials(){
        $sales_serv_head_id = $this->input->post('sales_serv_head_id');
        $data=array(
            "sales_serv_head_id"=>$this->input->post('sales_serv_head_id'),
            "item_description"=>$this->input->post('item'),
            "quantity"=>$this->input->post('quantity'),
            "uom"=>$this->input->post('uom'),
            "unit_cost"=>$this->input->post('unit_cost'),
            "total_cost"=>$this->input->post('total_cost'),
            "remarks"=>$this->input->post('remarks'),
        );
        $details_id = $this->super_model->insert_return_id("sales_serv_material", $data);
        $count_item = $this->super_model->count_rows_where("sales_serv_material","sales_serv_head_id",$sales_serv_head_id);
        foreach($this->super_model->custom_query("SELECT * FROM sales_serv_material WHERE sales_serv_head_id='$sales_serv_head_id' ORDER BY sales_serv_mat_id DESC LIMIT 1") AS $app){
            echo '<tr id="load_material'.$count_item.'"><td>'.$count_item.'</td><td>'.$app->item_description.'</td><td>'.$app->quantity.'</td><td>'.$app->uom.'</td><td>'.number_format($app->unit_cost,2).'</td><td>'.number_format($app->total_cost,2).'</td><td>'.$app->remarks.'</td><td><a onclick="delete_service_materials('.$app->sales_serv_mat_id.','.$count_item.')" class="btn btn-danger btn-xxs btn-rounded"><span class="mdi mdi-window-close"></span></a></td> </tr>';
            $count_item++;
        }    
    }

    public function delete_service_materials(){
        $sales_serv_mat_id = $this->input->post('sales_serv_mat_id');
        $this->super_model->delete_where("sales_serv_material", "sales_serv_mat_id", $sales_serv_mat_id);
    }

    public function services_add_manpower(){
        $data['sales_serv_head_id']=$this->uri->segment(3);
        $data['manpower']=$this->super_model->select_all_order_by("manpower","employee_name","ASC");
        $this->load->view('template/header');
        $this->load->view('sales/services_add_manpower',$data);
        $this->load->view('template/footer');
    }

    public function insert_service_manpower(){
        $sales_serv_head_id = $this->input->post('sales_serv_head_id');
        $data=array(
            "sales_serv_head_id"=>$this->input->post('sales_serv_head_id'),
            "manpower_id"=>$this->input->post('manpower'),
            "days"=>$this->input->post('days'),
            "rate"=>$this->input->post('rate'),
            "overtime"=>$this->input->post('overtime'),
            "total_cost"=>$this->input->post('total_cost'),
            "remarks"=>$this->input->post('remarks'),
        );
        $details_id = $this->super_model->insert_return_id("sales_serv_manpower", $data);
        $count_item = $this->super_model->count_rows_where("sales_serv_manpower","sales_serv_head_id",$sales_serv_head_id);
        foreach($this->super_model->custom_query("SELECT * FROM sales_serv_manpower WHERE sales_serv_head_id='$sales_serv_head_id' ORDER BY sales_serv_manpower_id DESC LIMIT 1") AS $app){
            $employee_name=$this->super_model->select_column_where("manpower","employee_name","manpower_id",$app->manpower_id);
            echo '<tr id="load_manpower'.$count_item.'"><td>'.$count_item.'</td><td>'.$employee_name.'</td><td>'.$app->days.'</td><td>'.number_format($app->rate,2).'</td><td>'.number_format($app->overtime,2).'</td><td>'.number_format($app->total_cost,2).'</td><td>'.$app->remarks.'</td><td><a onclick="delete_service_manpower('.$app->sales_serv_manpower_id.','.$count_item.')" class="btn btn-danger btn-xxs btn-rounded"><span class="mdi mdi-window-close"></span></a></td> </tr>';
            $count_item++;
        }    
    }

    public function delete_service_manpower(){
        $sales_serv_manpower_id = $this->input->post('sales_serv_manpower_id');
        $this->super_model->delete_where("sales_serv_manpower", "sales_serv_manpower_id", $sales_serv_manpower_id);
    }

    public function manpower_info(){
        $manpower_id=$this->input->post('manpower_id');
        foreach($this->super_model->select_row_where("manpower","manpower_id",$manpower_id) AS $man){
            $return = array('rate'=>$man->daily_rate);
        }
        echo json_encode($return);
    }

    public function services_add_rental(){
        $data['sales_serv_head_id']=$this->uri->segment(3);
        $data['equipment']=$this->super_model->select_all_order_by("equipment","equipment_name","ASC");
        $this->load->view('template/header');
        $this->load->view('sales/services_add_rental',$data);
        $this->load->view('template/footer');
    }

    public function insert_service_equipment(){
        $sales_serv_head_id = $this->input->post('sales_serv_head_id');
        $data=array(
            "sales_serv_head_id"=>$this->input->post('sales_serv_head_id'),
            "equipment_id"=>$this->input->post('equipment'),
            "quantity"=>$this->input->post('quantity'),
            "rate"=>$this->input->post('rate'),
            "uom"=>$this->input->post('uom'),
            "days"=>$this->input->post('days'),
            "total_cost"=>$this->input->post('total_cost'),
            "rate_flag"=>$this->input->post('rate_selection'),
            "remarks"=>$this->input->post('remarks'),
        );
        $details_id = $this->super_model->insert_return_id("sales_serv_equipment", $data);
        $count_item = $this->super_model->count_rows_where("sales_serv_equipment","sales_serv_head_id",$sales_serv_head_id);
        foreach($this->super_model->custom_query("SELECT * FROM sales_serv_equipment WHERE sales_serv_head_id='$sales_serv_head_id' ORDER BY sales_serv_equipment_id DESC LIMIT 1") AS $app){
            $equipment_name=$this->super_model->select_column_where("equipment","equipment_name","equipment_id",$app->equipment_id);
            echo '<tr id="load_equipment'.$count_item.'"><td>'.$count_item.'</td><td>'.$equipment_name.'</td><td>'.$app->quantity.'</td><td>'.number_format($app->rate,2).'</td><td>'.$app->uom.'</td><td>'.$app->days.'</td><td>'.number_format($app->total_cost,2).'</td><td>'.$app->remarks.'</td><td><a onclick="delete_service_equipment('.$app->sales_serv_equipment_id.','.$count_item.')" class="btn btn-danger btn-xxs btn-rounded"><span class="mdi mdi-window-close"></span></a></td> </tr>';
            $count_item++;
        }    
    }

    public function delete_service_equipment(){
        $sales_serv_equipment_id = $this->input->post('sales_serv_equipment_id');
        $this->super_model->delete_where("sales_serv_equipment", "sales_serv_equipment_id", $sales_serv_equipment_id);
    }

    public function equipment_info(){
        $equipment_id=$this->input->post('equipment_id');
        foreach($this->super_model->select_row_where("equipment","equipment_id",$equipment_id) AS $man){
            $return = array('rate'=>$man->daily_rate);
        }
        echo json_encode($return);
    }

    public function rate_selection(){
        $rate_selection=$this->input->post('rate_selection');
        $equipment_id=$this->input->post('equipment_id');
        $quantity=$this->input->post('quantity');
        foreach($this->super_model->select_row_where("equipment","equipment_id",$equipment_id) AS $man){
            if($rate_selection=='1'){
                $total = $quantity * $man->daily_rate;
                $return = array('rate'=>$total,'rate_selection'=>$rate_selection);
            }else{
                $total = $quantity * $man->hourly_rate;
                $return = array('rate'=>$total,'rate_selection'=>$rate_selection);
            }
        }
        echo json_encode($return);
    }

    public function save_services(){
        $sales_serv_head_id = $this->input->post('sales_serv_head_id');
        $user_id = $_SESSION['user_id'];
        foreach($this->super_model->select_custom_where("temp_sales_out","sales_id = '$sales_serv_head_id' AND user_id = '$user_id'") AS $tmp){
            /*$sumcost = $this->super_model->select_sum_where("fifo_in", "item_cost", "item_id = '$tmp->item_id'");
            $rowcount=$this->super_model->count_custom_where("fifo_in","item_id = '$tmp->item_id'");
            $count_item=$rowcount;
            $ave = $sumcost/$count_item;
            $dataup=array(
                "ave_cost"=>$ave,
            );
            $this->super_model->update_where("sales_serv_items", $dataup, "sales_serv_items_id", $tmp->sales_serv_items_id);*/

            $data = array(
                'in_id'=>$tmp->in_id,
                'item_id'=>$tmp->item_id,
                'transaction_type'=>'Sales Services',
                'sales_id'=>$sales_serv_head_id,
                'sales_serv_items_id'=>$tmp->sales_serv_items_id,
                'damage_id'=>0,
                'quantity'=>$tmp->quantity,
                'remaining_qty'=>$tmp->quantity,
            );   

            $this->super_model->insert_into("fifo_out",$data);

            $rem_qty = $this->super_model->select_column_where("fifo_in", "remaining_qty", "in_id", $tmp->in_id);

            $new_rem_qty = $rem_qty- $tmp->quantity;

            $data_update = array(
                'remaining_qty'=>$new_rem_qty
            );
            $this->super_model->update_where("fifo_in",$data_update, "in_id", $tmp->in_id);

            $data_head = array(
                'saved'=>1
            );
            $this->super_model->update_where("sales_services_head",$data_head, "sales_serv_head_id", $sales_serv_head_id);
        }

        $this->super_model->delete_custom_where("temp_sales_out","sales_id = '$sales_serv_head_id' AND user_id = '$user_id'");
        echo $sales_serv_head_id;
    }

    public function services_print_sales(){
        $sales_serv_head_id = $this->uri->segment(3);
        $data['sales_serv_head_id']=$sales_serv_head_id;
        foreach($this->super_model->select_custom_where("sales_services_head","sales_serv_head_id = '$sales_serv_head_id'") AS $sh){
            $client = $this->super_model->select_column_where("client","buyer_name","client_id",$sh->client_id);
            $address = $this->super_model->select_column_where("client","address","client_id",$sh->client_id);
            $contact_person = $this->super_model->select_column_where("client","contact_person","client_id",$sh->client_id);
            $contact_no = $this->super_model->select_column_where("client","contact_no","client_id",$sh->client_id);
            $tin = $this->super_model->select_column_where("client","tin","client_id",$sh->client_id);
            $wht = $this->super_model->select_column_where("client","wht","client_id",$sh->client_id);
            $data['employee']=$this->super_model->select_all_order_by("employees","employee_name","ASC");
            $data['prepared_by']=$sh->user_id;
            $data['prepared']=$this->super_model->select_column_where("users","fullname","user_id",$sh->user_id);
            $data['checked_by']=$sh->checked_by;
            $data['checked']=$this->super_model->select_column_where("employees","employee_name","employee_id",$sh->checked_by);
            $data['approved_by']=$sh->approved_by;
            $data['approved']=$this->super_model->select_column_where("employees","employee_name","employee_id",$sh->approved_by);
            $data['noted_by']=$sh->noted_by;
            $data['noted']=$this->super_model->select_column_where("employees","employee_name","employee_id",$sh->noted_by);
            $data['service_head'][]=array(
                'sales_serv_head_id'=>$sh->sales_serv_head_id,
                'client'=>$client,
                'address'=>$address,
                'contact_person'=>$contact_person,
                'contact_no'=>$contact_no,
                'tin'=>$tin,
                'wht'=>$wht,
                'sales_date'=>$sh->sales_date,
                'vat'=>$sh->vat,
                'jor_no'=>$sh->jor_no,
                'jor_date'=>$sh->jor_date,
                'joi_no'=>$sh->joi_no,
                'joi_date'=>$sh->joi_date,
                'date_started'=>$sh->date_started,
                'date_completed'=>$sh->date_completed,
                'duration'=>$sh->duration,
                'dr_no'=>$sh->dr_no,
                'remarks'=>$sh->remarks,
                'overall_remarks'=>$sh->overall_remarks,
                'administrative_fee'=>$sh->administrative_fee,
            );

            $count_itm = $this->super_model->count_rows_where("sales_serv_items","sales_serv_head_id",$sh->sales_serv_head_id);
            if($count_itm!=0){
                foreach($this->super_model->select_custom_where("sales_serv_items","sales_serv_head_id='$sh->sales_serv_head_id'") AS $sd){
                    //$item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$sd->in_id);
                    $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$sd->item_id);
                    $item_name = $this->super_model->select_column_where("items","item_name","item_id",$sd->item_id);
                    $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$sd->item_id);
                    $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                    $serial_no = $this->get_serial_services($sd->sales_serv_items_id,"final");
                    //$serial_no = $this->super_model->select_column_where("fifo_in","serial_no","in_id",$sd->in_id);
                    $data['service_details'][]=array(
                        'original_pn'=>$original_pn,
                        'item'=>$item_name,
                        'serial_no'=>$serial_no,
                        'expected_qty'=>$sd->expected_qty,
                        'quantity'=>$sd->quantity,
                        'uom'=>$unit,
                        'selling_price'=>$sd->selling_price,
                        'discount'=>$sd->discount_amount,
                        'total'=>$sd->total,
                        'i_remarks'=>$sd->remarks,
                    );
                }
            }else{
                $data['service_details']=array();
            }


            $count_mat = $this->super_model->count_rows_where("sales_serv_material","sales_serv_head_id",$sh->sales_serv_head_id);
            if($count_mat!=0){
                foreach($this->super_model->select_custom_where("sales_serv_material","sales_serv_head_id='$sh->sales_serv_head_id'") AS $sm){
                    $data['service_materials'][]=array(
                        'item_description'=>$sm->item_description,
                        'quantity'=>$sm->quantity,
                        'uom'=>$sm->uom,
                        'unit_cost'=>$sm->unit_cost,
                        'total_cost'=>$sm->total_cost,
                        'mat_remarks'=>$sm->remarks,
                    );
                }
            }else{
                $data['service_materials']=array();
            }

            $count_man = $this->super_model->count_rows_where("sales_serv_manpower","sales_serv_head_id",$sh->sales_serv_head_id);
            if($count_man!=0){
                foreach($this->super_model->select_custom_where("sales_serv_manpower","sales_serv_head_id='$sh->sales_serv_head_id'") AS $sman){
                    $employee_name=$this->super_model->select_column_where("manpower","employee_name","manpower_id",$sman->manpower_id);
                    $data['service_manpower'][]=array(
                        'employee_name'=>$employee_name,
                        'days'=>$sman->days,
                        'rate'=>$sman->rate,
                        'overtime'=>$sman->overtime,
                        'total_cost'=>$sman->total_cost,
                        'man_remarks'=>$sman->remarks,
                    );
                }
            }else{
                $data['service_manpower']=array();
            }

            $count_equ = $this->super_model->count_rows_where("sales_serv_equipment","sales_serv_head_id",$sh->sales_serv_head_id);
            if($count_equ!=0){
                foreach($this->super_model->select_custom_where("sales_serv_equipment","sales_serv_head_id='$sh->sales_serv_head_id'") AS $seq){
                    $equipment_name=$this->super_model->select_column_where("equipment","equipment_name","equipment_id",$seq->equipment_id);
                    $data['service_equipment'][]=array(
                        'equipment_name'=>$equipment_name,
                        'rate'=>$seq->rate,
                        'quantity'=>$seq->quantity,
                        'uom'=>$seq->uom,
                        'days'=>$seq->days,
                        'total_cost'=>$seq->total_cost,
                        'e_remarks'=>$seq->remarks,
                    );
                }
            }else{
                $data['service_equipment']=array();
            }
        }
        $this->load->view('template/print_head');
        $this->load->view('sales/services_print_sales',$data);
    }

    public function print_deliver_services(){
        $id=$this->input->post('sales_serv_head_id');
        $data = array(
            "checked_by"=>$this->input->post('checked_by'),
            "approved_by"=>$this->input->post('approved_by'),
            "noted_by"=>$this->input->post('noted_by')
        );

        $this->super_model->update_where("sales_services_head", $data, "sales_serv_head_id", $id);
        echo "success";
    }

    public function services_acknow_print(){
        $sales_serv_head_id = $this->uri->segment(3);
        $data['sales_serv_head_id']=$sales_serv_head_id;
        $data['shipping']=$this->super_model->select_all_order_by("shipping_company","company_name","ASC");
        $data['client_id'] = $this->super_model->select_column_where("sales_services_head","client_id","sales_serv_head_id",$sales_serv_head_id);
        foreach($this->super_model->select_custom_where("sales_services_head","sales_serv_head_id = '$sales_serv_head_id'") AS $sh){
            $client = $this->super_model->select_column_where("client","buyer_name","client_id",$sh->client_id);
            $shipping = $this->super_model->select_column_where("shipping_company","company_name","ship_comp_id",$sh->shipped_via);
            $address = $this->super_model->select_column_where("client","address","client_id",$sh->client_id);
            $contact_person = $this->super_model->select_column_where("client","contact_person","client_id",$sh->client_id);
            $contact_no = $this->super_model->select_column_where("client","contact_no","client_id",$sh->client_id);
            $tin = $this->super_model->select_column_where("client","tin","client_id",$sh->client_id);
            $wht = $this->super_model->select_column_where("client","wht","client_id",$sh->client_id);
            $data['employee']=$this->super_model->select_all_order_by("employees","employee_name","ASC");
            $data['prepared_by']=$sh->user_id;
            $data['prepared']=$this->super_model->select_column_where("users","fullname","user_id",$sh->user_id);
            $data['position']=$this->super_model->select_column_where("users","position","user_id",$sh->user_id);
            $data['verified_by']=$sh->verified_by;
            $data['verified']=$this->super_model->select_column_where("employees","employee_name","employee_id",$sh->verified_by);
            $data['verified_position']=$this->super_model->select_column_where("employees","position","employee_id",$sh->verified_by);
            $data['recomm_approval']=$sh->recomm_approval;
            $data['recomm']=$this->super_model->select_column_where("employees","employee_name","employee_id",$sh->recomm_approval);
            $data['recomm_position']=$this->super_model->select_column_where("employees","position","employee_id",$sh->recomm_approval);
            $data['ack_approved_by']=$sh->ack_approved_by;
            $data['ack_approved']=$this->super_model->select_column_where("employees","employee_name","employee_id",$sh->ack_approved_by);
            $data['ack_approved_position']=$this->super_model->select_column_where("employees","position","employee_id",$sh->ack_approved_by);
            $data['service_head'][]=array(
                'client'=>$client,
                'address'=>$address,
                'contact_person'=>$contact_person,
                'contact_no'=>$contact_no,
                'tin'=>$tin,
                'wht'=>$wht,
                'sales_date'=>$sh->sales_date,
                'shipped_via'=>$shipping,
                'waybill_no'=>$sh->waybill_no,
                'ar_description'=>$sh->ar_description,
                'vat'=>$sh->vat,
                'jor_no'=>$sh->jor_no,
                'jor_date'=>$sh->jor_date,
                'joi_no'=>$sh->joi_no,
                'joi_date'=>$sh->joi_date,
                'dr_no'=>$sh->dr_no,
                'remarks'=>$sh->remarks,
            );

            $count_itm = $this->super_model->count_rows_where("sales_serv_items","sales_serv_head_id",$sh->sales_serv_head_id);
            if($count_itm!=0){
                foreach($this->super_model->select_custom_where("sales_serv_items","sales_serv_head_id='$sh->sales_serv_head_id'") AS $sd){
                    //$item_id = $this->super_model->select_column_where("fifo_in","item_id","in_id",$sd->in_id);
                    $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$sd->item_id);
                    $item_name = $this->super_model->select_column_where("items","item_name","item_id",$sd->item_id);
                    $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$sd->item_id);
                    $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                    $serial_no = $this->get_serial_services($sd->sales_serv_items_id,"final");
                    //$serial_no = $this->super_model->select_column_where("fifo_in","serial_no","in_id",$sd->in_id);
                    $data['service_details'][]=array(
                        'original_pn'=>$original_pn,
                        'item'=>$item_name,
                        'serial_no'=>$serial_no,
                        'quantity'=>$sd->quantity,
                        'uom'=>$unit,
                        'selling_price'=>$sd->selling_price,
                        'discount'=>$sd->discount_amount,
                        'total'=>$sd->total,
                    );
                }
            }else{
                $data['service_details']=array();
            }


            $count_mat = $this->super_model->count_rows_where("sales_serv_material","sales_serv_head_id",$sh->sales_serv_head_id);
            if($count_mat!=0){
                foreach($this->super_model->select_custom_where("sales_serv_material","sales_serv_head_id='$sh->sales_serv_head_id'") AS $sm){
                    $data['service_materials'][]=array(
                        'item_description'=>$sm->item_description,
                        'quantity'=>$sm->quantity,
                        'uom'=>$sm->uom,
                        'unit_cost'=>$sm->unit_cost,
                        'total_cost'=>$sm->total_cost,
                    );
                }
            }else{
                $data['service_materials']=array();
            }

            $count_man = $this->super_model->count_rows_where("sales_serv_manpower","sales_serv_head_id",$sh->sales_serv_head_id);
            if($count_man!=0){
                foreach($this->super_model->select_custom_where("sales_serv_manpower","sales_serv_head_id='$sh->sales_serv_head_id'") AS $sman){
                    $employee_name=$this->super_model->select_column_where("manpower","employee_name","manpower_id",$sman->manpower_id);
                    $data['service_manpower'][]=array(
                        'employee_name'=>$employee_name,
                        'days'=>$sman->days,
                        'rate'=>$sman->rate,
                        'overtime'=>$sman->overtime,
                        'total_cost'=>$sman->total_cost,
                    );
                }
            }else{
                $data['service_manpower']=array();
            }

            $count_equ = $this->super_model->count_rows_where("sales_serv_equipment","sales_serv_head_id",$sh->sales_serv_head_id);
            if($count_equ!=0){
                foreach($this->super_model->select_custom_where("sales_serv_equipment","sales_serv_head_id='$sh->sales_serv_head_id'") AS $seq){
                    $equipment_name=$this->super_model->select_column_where("equipment","equipment_name","equipment_id",$seq->equipment_id);
                    $data['service_equipment'][]=array(
                        'equipment_name'=>$equipment_name,
                        'rate'=>$seq->rate,
                        'quantity'=>$seq->quantity,
                        'uom'=>$seq->uom,
                        'days'=>$seq->days,
                        'total_cost'=>$seq->total_cost,
                    );
                }
            }else{
                $data['service_equipment']=array();
            }
        }
        $this->load->view('template/print_head');
        $this->load->view('sales/services_acknow_print', $data);
    }

    public function verified_change(){
        $verified_by=$this->input->post('verified_by');
        foreach($this->super_model->select_row_where("employees","employee_id",$verified_by) AS $emp){
            $return = array('position'=>$emp->position);
        }
        echo json_encode($return);
    }

    public function recomm_change(){
        $recomm_approval=$this->input->post('recomm_approval');
        foreach($this->super_model->select_row_where("employees","employee_id",$recomm_approval) AS $emp){
            $return = array('position'=>$emp->position);
        }
        echo json_encode($return);
    }

    public function ack_approved_change(){
        $ack_approved_by=$this->input->post('ack_approved_by');
        foreach($this->super_model->select_row_where("employees","employee_id",$ack_approved_by) AS $emp){
            $return = array('position'=>$emp->position);
        }
        echo json_encode($return);
    }

    public function print_acknow(){
        $id=$this->input->post('sales_serv_head_id');
        $client_id=$this->input->post('client_id');
        if($client_id==1){
            $data = array(
                "verified_by"=>$this->input->post('verified_by'),
                "recomm_approval"=>$this->input->post('recomm_approval'),
                "ack_approved_by"=>$this->input->post('ack_approved_by')
            );
        }else{
            $data = array(
                "verified_by"=>$this->input->post('verified_by'),
                "ack_approved_by"=>$this->input->post('ack_approved_by')
            );
        }

        $this->super_model->update_where("sales_services_head", $data, "sales_serv_head_id", $id);
        echo "success";
    }

    public function save_ar(){
        $sales_serv_head_id = $this->input->post('sales_serv_head_id');
        $datains=array(
            "shipping_company"=>$this->input->post('shipping'),
            "waybill_no"=>$this->input->post('waybill_no'),
        );
        $this->super_model->update_where("sales_services_head",$datains, "sales_serv_head_id", $sales_serv_head_id);
    }

    public function services_sales_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $row_count=$this->super_model->count_rows("sales_services_head");
        if($row_count!=0){
            foreach($this->super_model->select_all_order_by("sales_services_head","sales_date","DESC") AS $sh){
                $client = $this->super_model->select_column_where("client","buyer_name","client_id",$sh->client_id);
                $address = $this->super_model->select_column_where("client","address","client_id",$sh->client_id);
                $contact_person = $this->super_model->select_column_where("client","contact_person","client_id",$sh->client_id);
                $contact_no = $this->super_model->select_column_where("client","contact_no","client_id",$sh->client_id);
                $tin = $this->super_model->select_column_where("client","tin","client_id",$sh->client_id);
                $data['service_head'][]=array(
                    'sales_serv_head_id'=>$sh->sales_serv_head_id,
                    'client'=>$client,
                    'address'=>$address,
                    'contact_person'=>$contact_person,
                    'contact_no'=>$contact_no,
                    'tin'=>$tin,
                    'sales_date'=>$sh->sales_date,
                    'service_date'=>$sh->service_date,
                    'service_no'=>$sh->service_no,
                    'vat'=>$sh->vat,
                    'jor_no'=>$sh->jor_no,
                    'jor_date'=>$sh->jor_date,
                    'joi_no'=>$sh->joi_no,
                    'joi_date'=>$sh->joi_date,
                    'dr_no'=>$sh->dr_no,
                    'remarks'=>$sh->remarks,
                );
            }
        }else{
            $data['service_head']=array();
        }
        $this->load->view('sales/services_sales_list',$data);
        $this->load->view('template/footer');
    }

    public function insert_servicenumber(){
        $service_date=$this->input->post('service_date');
        $service_no=$this->input->post('service_no');
        $sales_serv_head_id=$this->input->post('sales_serv_head_id');
        $data=array(
            'service_date'=>$service_date,
            'service_no'=>$service_no,
        );
        $this->super_model->update_where("sales_services_head",$data, "sales_serv_head_id", $sales_serv_head_id);
    }

    public function export_salesserv(){
         $df= $this->uri->segment(3);
        $dt= $this->uri->segment(4);
        
        
        $date_from =$df. " 00:00:00";

        $date_to = $dt . " 00:00:00";
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Sales Service.xlsx";
        $objPHPExcel = new PHPExcel();
        $gdImage = imagecreatefrompng('assets/images/progen_logow.png');
        // Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        $objDrawing->setName('Sample image');
        $objDrawing->setDescription('Sample image');
        $objDrawing->setImageResource($gdImage);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setHeight(75);
        $objDrawing->setOffsetX(25);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "PROGEN Dieseltech Services Corp.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Purok San Jose, Brgy. Calumangan, Bago City");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "Negros Occidental, Philippines 6101");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', "Tel. No. 476 - 7382");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "SALES SERVICES REPORT");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', "Date From:");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B5', $df);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', "Date To:");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D5', $dt);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', "Sales Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', "Client");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G7', "DR No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I7', "PGC JOR No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K7', "JOR Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M7', "PGC JOI No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O7', "JOI Date");
        $num=8;
         foreach($this->super_model->select_custom_where("sales_services_head","saved='1' and sales_date between '$date_from' AND '$date_to' ORDER BY sales_date ASC") AS $re){
            $client=$this->super_model->select_column_where('client','buyer_name',"client_id",$re->client_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $re->sales_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $client);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $re->dr_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$num, $re->jor_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$num, $re->jor_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$num, $re->joi_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$num, $re->joi_date);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":P".$num)->applyFromArray($styleArray);
            
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":F".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('G'.$num.":H".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('I'.$num.":J".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('K'.$num.":L".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('M'.$num.":N".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('O'.$num.":P".$num);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('H2:P2');
        $objPHPExcel->getActiveSheet()->getStyle('H2:P2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2:P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->mergeCells('A6:B6');
        $objPHPExcel->getActiveSheet()->mergeCells('C6:F6');
        $objPHPExcel->getActiveSheet()->mergeCells('G6:H6');
        $objPHPExcel->getActiveSheet()->mergeCells('I6:J6');
        $objPHPExcel->getActiveSheet()->mergeCells('K6:L6');
        $objPHPExcel->getActiveSheet()->mergeCells('M6:N6');
        $objPHPExcel->getActiveSheet()->mergeCells('O6:P6');
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A6:P6")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A4:P4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:P2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:P3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:P4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:P2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:P3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:P4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('P1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('P2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('P3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('P4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Sales Service.xlsx"');
        readfile($exportfilename);
    }

    public function services_add_sales_itemlist(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/services_add_sales_itemlist');
        $this->load->view('template/footer');
    }

     public function services_update_sales_head()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/services_update_sales_head');
        $this->load->view('template/footer');
    }

    public function services_update_sales_itemlist()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/services_update_sales_itemlist');
        $this->load->view('template/footer');
    }
   
    public function services_update_sales_item()
    {
        $this->load->view('template/header');
        $this->load->view('sales/services_update_sales_item');
        $this->load->view('template/footer');
    }

    public function return_form()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/return_form');
        $this->load->view('template/footer');
    }

    public function print_return()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('sales/print_return');
        $this->load->view('template/footer');
    }


    public function print_sample(){
        $sales_good_head_id = $this->uri->segment(3);
        $this->load->view('template/print_head');
        foreach($this->super_model->select_custom_where("sales_good_head","sales_good_head_id = '$sales_good_head_id'") AS $sh){
            $client = $this->super_model->select_column_where("client","buyer_name","client_id",$sh->client_id);
            $address = $this->super_model->select_column_where("client","address","client_id",$sh->client_id);
            $contact_person = $this->super_model->select_column_where("client","contact_person","client_id",$sh->client_id);
            $contact_no = $this->super_model->select_column_where("client","contact_no","client_id",$sh->client_id);
            $tin = $this->super_model->select_column_where("client","tin","client_id",$sh->client_id);
            $data['sales_head'][]=array(
                'client'=>$client,
                'address'=>$address,
                'contact_person'=>$contact_person,
                'contact_no'=>$contact_no,
                'tin'=>$tin,
                'sales_date'=>$sh->sales_date,
                'vat'=>$sh->vat,
                'pr_no'=>$sh->pr_no,
                'pr_date'=>$sh->pr_date,
                'po_no'=>$sh->po_no,
                'po_date'=>$sh->po_date,
                'dr_no'=>$sh->dr_no,
                'remarks'=>$sh->remarks,
            );
            foreach($this->super_model->select_custom_where("sales_good_details","sales_good_head_id='$sh->sales_good_head_id'") AS $sd){
                $serial_no = $this->get_serial($sd->sales_good_det_id, 'final');
                $original_pn = $this->super_model->select_column_where("items","original_pn","item_id",$sd->item_id);
                $item_name = $this->super_model->select_column_where("items","item_name","item_id",$sd->item_id);
                $unit_id = $this->super_model->select_column_where("items","unit_id","item_id",$sd->item_id);
                $unit = $this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
                //$serial_no = $this->super_model->select_column_where("fifo_in","serial_no","in_id",$sd->in_id);
               
                $data['sales_details'][]=array(
                    'original_pn'=>$original_pn,
                    'item'=>$item_name,
                    'serial_no'=>$serial_no,
                    'quantity'=>$sd->quantity,
                    'uom'=>$unit,
                    'selling_price'=>$sd->selling_price,
                    'discount'=>$sd->discount_amount,
                    'total'=>$sd->total,
                );
            }
        }
        $this->load->view('sales/print_sample',$data);
    }


}