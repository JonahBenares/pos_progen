<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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


    public function monthly_report(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['client']=$this->super_model->select_all_order_by("client","buyer_name","buyer_name","ASC");
        $month = $this->uri->segment(3);
        $client_id = $this->uri->segment(4);
        $data['month']=$month;
        $data['client_id']=$client_id;
        $sql="";
        if($month!='null'){
            $sql.= " AND EXTRACT(MONTH from sales_date) = '$month' AND";
        }

        if($client_id!='null' && $month=='null'){
            $sql.= " AND client_id = '$client_id' AND";
        }else if($month!='null' && $client_id!='null'){
            $sql.= " client_id = '$client_id' AND";
        }

        $query=substr($sql,0,-3);
        foreach($this->super_model->custom_query("SELECT * FROM sales_good_head sh INNER JOIN sales_good_details sd ON sh.sales_good_head_id=sd.sales_good_head_id WHERE saved='1' ".$query) AS $sg){
            $item=$this->super_model->select_column_where("items","item_name","item_id",$sg->item_id);
            $original_pn=$this->super_model->select_column_where("items","original_pn","item_id",$sg->item_id);
            $unit_id=$this->super_model->select_column_where("items","unit_id","item_id",$sg->item_id);
            $uom=$this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $client=$this->super_model->select_column_where("client","buyer_name","client_id",$sg->client_id);
            $in_id=$this->super_model->select_column_where("fifo_out","in_id","sales_details_id",$sg->sales_good_det_id);
            $serial_no=$this->super_model->select_column_where("fifo_in","serial_no","in_id",$in_id);

            $return_qty= $this->super_model->select_sum_join("return_qty","return_details","sales_good_details","return_details.item_id='$sg->item_id' AND sales_good_details.return_id!='0'","return_id");
            $return_qty_serv= $this->super_model->select_sum_join("return_qty","return_details","sales_serv_items","return_details.item_id='$sg->item_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageret_qty= $this->super_model->select_sum_join("damage_qty","return_details","sales_good_details","return_details.item_id='$sg->item_id' AND sales_good_details.return_id!='0'","return_id");
            $damageret_qty_serv= $this->super_model->select_sum_join("damage_qty","return_details","sales_serv_items","return_details.item_id='$sg->item_id' AND sales_serv_items.return_id!='0'","return_id");
            $sales_good_qty = $sg->quantity - $return_qty - $return_qty_serv - $damageret_qty - $damageret_qty_serv;
            $data['sales'][]=array(
                "sales_date"=>$sg->sales_date,
                "dr_no"=>$sg->dr_no,
                "original_pn"=>$original_pn,
                "item"=>$item,
                "serial_no"=>$serial_no,
                "quantity"=>$sales_good_qty,
                "uom"=>$uom,
                "pr_no"=>$sg->pr_no,
                "po_no"=>$sg->po_no,
                "client"=>$client,
                "unit_cost"=>$sg->unit_cost,
                "total"=>$sg->total,
                "remarks"=>$sg->remarks,
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM sales_services_head sh INNER JOIN sales_serv_items si ON sh.sales_serv_head_id=si.sales_serv_head_id WHERE saved='1' ".$query) AS $sid){
            $item=$this->super_model->select_column_where("items","item_name","item_id",$sid->item_id);
            $original_pn=$this->super_model->select_column_where("items","original_pn","item_id",$sid->item_id);
            $unit_id=$this->super_model->select_column_where("items","unit_id","item_id",$sid->item_id);
            $uom=$this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $client=$this->super_model->select_column_where("client","buyer_name","client_id",$sid->client_id);
            $in_id=$this->super_model->select_column_where("fifo_out","in_id","sales_serv_items_id",$sid->sales_serv_items_id);
            $serial_no=$this->super_model->select_column_where("fifo_in","serial_no","in_id",$in_id);
            $return_qty= $this->super_model->select_sum_join("return_qty","return_details","sales_good_details","return_details.item_id='$sid->item_id' AND sales_good_details.return_id!='0'","return_id");
            $return_qty_serv= $this->super_model->select_sum_join("return_qty","return_details","sales_serv_items","return_details.item_id='$sid->item_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageret_qty= $this->super_model->select_sum_join("damage_qty","return_details","sales_good_details","return_details.item_id='$sid->item_id' AND sales_good_details.return_id!='0'","return_id");
            $damageret_qty_serv= $this->super_model->select_sum_join("damage_qty","return_details","sales_serv_items","return_details.item_id='$sid->item_id' AND sales_serv_items.return_id!='0'","return_id");
            $sales_service_qty = $sid->quantity - $return_qty - $return_qty_serv - $damageret_qty - $damageret_qty_serv;
            $data['sales'][]=array(
                "sales_date"=>$sid->sales_date,
                "dr_no"=>$sid->dr_no,
                "original_pn"=>$original_pn,
                "item"=>$item,
                "serial_no"=>$serial_no,
                "quantity"=>$sales_service_qty,
                "uom"=>$uom,
                "pr_no"=>$sid->jor_no,
                "po_no"=>$sid->joi_no,
                "client"=>$client,
                "unit_cost"=>$sid->unit_cost,
                "total"=>$sid->total,
                "remarks"=>$sid->remarks,
            );
        }
        $this->load->view('reports/monthly_report',$data);
        $this->load->view('template/footer');
    }

    public function export_monthlyreport(){
        $month = $this->uri->segment(3);
        $client_id = $this->uri->segment(4);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Monthly Report.xlsx";
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "MONTHLY REPORT");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $sql="";
        if($month!='null'){
            $sql.= " AND EXTRACT(MONTH from sales_date) = '$month' AND";
        }

        if($client_id!='null' && $month=='null'){
            $sql.= " AND client_id = '$client_id' AND";
        }else if($month!='null' && $client_id!='null'){
            $sql.= " client_id = '$client_id' AND";
        }
        $query=substr($sql,0,-3);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', "#");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B6', "Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D6', "DR No./AR No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F6', "Part No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H6', "Item Description");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L6', "Serial No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N6', "Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O6', "UOM");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P6', "PGC PR No/PO No");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R6', "Buyer");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T6', "Unit Cost");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U6', "Total Amt");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V6', "Remarks");
        foreach($this->super_model->custom_query("SELECT * FROM sales_good_head sh INNER JOIN sales_good_details sd ON sh.sales_good_head_id=sd.sales_good_head_id WHERE saved='1' ".$query) AS $sg){
            $item=$this->super_model->select_column_where("items","item_name","item_id",$sg->item_id);
            $original_pn=$this->super_model->select_column_where("items","original_pn","item_id",$sg->item_id);
            $unit_id=$this->super_model->select_column_where("items","unit_id","item_id",$sg->item_id);
            $uom=$this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $client=$this->super_model->select_column_where("client","buyer_name","client_id",$sg->client_id);
            $in_id=$this->super_model->select_column_where("fifo_out","in_id","sales_details_id",$sg->sales_good_det_id);
            $serial_no=$this->super_model->select_column_where("fifo_in","serial_no","in_id",$in_id);

            $return_qty= $this->super_model->select_sum_join("return_qty","return_details","sales_good_details","return_details.item_id='$sg->item_id' AND sales_good_details.return_id!='0'","return_id");
            $return_qty_serv= $this->super_model->select_sum_join("return_qty","return_details","sales_serv_items","return_details.item_id='$sg->item_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageret_qty= $this->super_model->select_sum_join("damage_qty","return_details","sales_good_details","return_details.item_id='$sg->item_id' AND sales_good_details.return_id!='0'","return_id");
            $damageret_qty_serv= $this->super_model->select_sum_join("damage_qty","return_details","sales_serv_items","return_details.item_id='$sg->item_id' AND sales_serv_items.return_id!='0'","return_id");
            $sales_good_qty = $sg->quantity - $return_qty - $return_qty_serv - $damageret_qty - $damageret_qty_serv;
            $sales[]=array(
                "sales_date"=>$sg->sales_date,
                "dr_no"=>$sg->dr_no,
                "original_pn"=>$original_pn,
                "item"=>$item,
                "serial_no"=>$serial_no,
                "quantity"=>$sales_good_qty,
                "uom"=>$uom,
                "pr_no"=>$sg->pr_no,
                "po_no"=>$sg->po_no,
                "client"=>$client,
                "unit_cost"=>$sg->unit_cost,
                "total"=>$sg->total,
                "remarks"=>$sg->remarks,
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM sales_services_head sh INNER JOIN sales_serv_items si ON sh.sales_serv_head_id=si.sales_serv_head_id WHERE saved='1' ".$query) AS $sid){
            $item=$this->super_model->select_column_where("items","item_name","item_id",$sid->item_id);
            $original_pn=$this->super_model->select_column_where("items","original_pn","item_id",$sid->item_id);
            $unit_id=$this->super_model->select_column_where("items","unit_id","item_id",$sid->item_id);
            $uom=$this->super_model->select_column_where("uom","unit_name","unit_id",$unit_id);
            $client=$this->super_model->select_column_where("client","buyer_name","client_id",$sid->client_id);
            $in_id=$this->super_model->select_column_where("fifo_out","in_id","sales_serv_items_id",$sid->sales_serv_items_id);
            $serial_no=$this->super_model->select_column_where("fifo_in","serial_no","in_id",$in_id);
            $return_qty= $this->super_model->select_sum_join("return_qty","return_details","sales_good_details","return_details.item_id='$sid->item_id' AND sales_good_details.return_id!='0'","return_id");
            $return_qty_serv= $this->super_model->select_sum_join("return_qty","return_details","sales_serv_items","return_details.item_id='$sid->item_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageret_qty= $this->super_model->select_sum_join("damage_qty","return_details","sales_good_details","return_details.item_id='$sid->item_id' AND sales_good_details.return_id!='0'","return_id");
            $damageret_qty_serv= $this->super_model->select_sum_join("damage_qty","return_details","sales_serv_items","return_details.item_id='$sid->item_id' AND sales_serv_items.return_id!='0'","return_id");
            $sales_service_qty = $sid->quantity - $return_qty - $return_qty_serv - $damageret_qty - $damageret_qty_serv;
            $sales[]=array(
                "sales_date"=>$sid->sales_date,
                "dr_no"=>$sid->dr_no,
                "original_pn"=>$original_pn,
                "item"=>$item,
                "serial_no"=>$serial_no,
                "quantity"=>$sales_service_qty,
                "uom"=>$uom,
                "pr_no"=>$sid->jor_no,
                "po_no"=>$sid->joi_no,
                "client"=>$client,
                "unit_cost"=>$sid->unit_cost,
                "total"=>$sid->total,
                "remarks"=>$sid->remarks,
            );
        }
        $num=7;
        $x=1;
        foreach($sales AS $s){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $x);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$num, $s['sales_date']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$num, $s['dr_no']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $s['original_pn']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $s['item']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$num, $s['serial_no']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$num, $s['quantity']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$num, $s['uom']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$num, $s['pr_no']."/".$s['po_no']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$num, $s['client']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$num, $s['unit_cost']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$num, $s['total']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$num, $s['remarks']);
            $objPHPExcel->getActiveSheet()->getStyle("N".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle("T".$num.':U'.$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":X".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$num.":M".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$num.":C".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('D'.$num.":E".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":G".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$num.":K".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('L'.$num.":M".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('P'.$num.":Q".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('R'.$num.":S".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('V'.$num.":X".$num);
            $num++;
            $x++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('B6:C6');
        $objPHPExcel->getActiveSheet()->mergeCells('D6:E6');
        $objPHPExcel->getActiveSheet()->mergeCells('F6:G6');
        $objPHPExcel->getActiveSheet()->mergeCells('H6:K6');
        $objPHPExcel->getActiveSheet()->mergeCells('L6:M6');
        $objPHPExcel->getActiveSheet()->mergeCells('P6:Q6');
        $objPHPExcel->getActiveSheet()->mergeCells('R6:S6');
        $objPHPExcel->getActiveSheet()->mergeCells('V6:X6');
        $objPHPExcel->getActiveSheet()->getStyle('A6:X6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A6:X6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A6:X6")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->mergeCells('H2:X2');
        $objPHPExcel->getActiveSheet()->getStyle('H2:X2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2:X2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:X4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:X1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:X1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:X2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:X3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:X4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:X1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:X2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:X3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:X4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('X1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('X2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('X3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('X4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Monthly Report.xlsx"');
        readfile($exportfilename);
    }

    public function summary_scgp(){
        $data['clients'] = $this->super_model->select_all("client");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $from = $this->uri->segment(3);
        $to = $this->uri->segment(4);
        $client = $this->uri->segment(5);
        $data['from']=$from;
        $data['to']=$to;
        $data['client_id']=$client;
        $sql="";
        if($from!='null' && $to!='null'){
           $sql.= " bh.billing_date BETWEEN '$from' AND '$to' AND";
        }

        if($client!='null'){
            $sql.= " bh.client_id = '$client' AND";
        }

        $query=substr($sql,0,-3);
        $data['head']=array();
        foreach($this->super_model->custom_query("SELECT DISTINCT * FROM billing_head bh INNER JOIN billing_details bd ON bh.billing_id = bd.billing_id INNER JOIN fifo_out fo WHERE bh.client_id='$client' AND bh.status='1' AND ".$query."GROUP BY item_id ORDER BY bh.billing_date ASC") AS $head){
            $sales_good_head_id = $this->super_model->select_column_where('sales_good_head', 'sales_good_head_id', 'sales_good_head_id', $head->sales_id);
            $sales_serv_head_id = $this->super_model->select_column_where('sales_services_head', 'sales_serv_head_id', 'sales_serv_head_id', $head->sales_id);
            $unit_id = $this->super_model->select_column_where('items', 'unit_id', 'item_id', $head->item_id);
            $unit = $this->super_model->select_column_where('uom', 'unit_name', 'unit_id', $unit_id);

        foreach($this->super_model->select_custom_where("fifo_out","sales_id='$head->sales_id' AND item_id = '$head->item_id'") AS $sales){
            if($head->sales_type=='goods'){
                    $po_jo = $this->super_model->select_column_where('sales_good_head', 'po_no', 'sales_good_head_id', $sales_good_head_id);
                    $array_qty[] = $sales->quantity;
                    $total_qty = array_sum($array_qty);
                    $total_cost[] = $sales->quantity * $sales->unit_cost;
                    $array_cost = array($total_cost);
                    $total_unit_cost = array_sum($total_cost);
                    $sum_sales[] = $sales->quantity * $sales->selling_price;
                    $array_sales = array($sum_sales);
                    $total_sales = array_sum($sum_sales);
                    $gross_profit = $total_sales - $total_unit_cost;
            }else if($head->sales_type=='services'){
                    $po_jo = $this->super_model->select_column_where('sales_services_head', 'jor_no', 'sales_serv_head_id', $sales_serv_head_id);
                    $array_qty[] = $sales->quantity;
                    $total_qty = array_sum($array_qty);
                    $total_cost[] = $sales->quantity * $sales->unit_cost;
                    $array_cost = array($total_cost);
                    $total_unit_cost = array_sum($total_cost);
                    $sum_sales[] = $sales->quantity * $sales->selling_price;
                    $array_sales = array($sum_sales);
                    $total_sales = array_sum($sum_sales);
                    $gross_profit = $total_sales - $total_unit_cost;
            }
        }

            $data['head'][] = array(
                "billing_date"=>$head->billing_date,
                "billing_no"=>$head->billing_no,
                "quantity"=>$total_qty,
                "total_cost"=>$total_unit_cost,
                "total_sales"=>$total_sales,
                "gross_profit"=>$gross_profit,
                "po_jo"=>$po_jo,
                "uom"=>$unit,
                "client"=>$this->super_model->select_column_where("client", "buyer_name", "client_id", $head->client_id),
                "item"=>$this->super_model->select_column_where("items", "item_name", "item_id", $head->item_id),
            );          
        }
        $this->load->view('reports/summary_scgp',$data);
        $this->load->view('template/footer');
    }


    public function export_summary_scgp(){
        $from = $this->uri->segment(3);
        $to = $this->uri->segment(4);
        $client = $this->uri->segment(5);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Summary of Sales, Costs, And Gross Profit.xlsx";
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "SUMMARY OF SALES, COSTS, AND GROSS PROFIT REPORT");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $sql="";
        if($from!='null' && $to!='null'){
           $sql.= " bh.billing_date BETWEEN '$from' AND '$to' AND";
        }

        if($client!='null'){
            $sql.= " bh.client_id = '$client' AND";
        }

        $query=substr($sql,0,-3);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', "#");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B6', "Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D6', "Item Description");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G6', "Client");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K6', "PO/JO No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M6', "Billing Statement No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P6', "Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q6', "UOM");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R6', "Total Sales");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T6', "Total Cost");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V6', "Gross Profit");
        $num=7;
        $x=1;
        foreach($this->super_model->custom_query("SELECT DISTINCT * FROM billing_head bh INNER JOIN billing_details bd ON bh.billing_id = bd.billing_id INNER JOIN fifo_out fo WHERE bh.client_id='$client' AND bh.status='1' AND ".$query."GROUP BY item_id ORDER BY bh.billing_date ASC") AS $head){
            $sales_good_head_id = $this->super_model->select_column_where('sales_good_head', 'sales_good_head_id', 'sales_good_head_id', $head->sales_id);
            $sales_serv_head_id = $this->super_model->select_column_where('sales_services_head', 'sales_serv_head_id', 'sales_serv_head_id', $head->sales_id);
            $unit_id = $this->super_model->select_column_where('items', 'unit_id', 'item_id', $head->item_id);
            $unit = $this->super_model->select_column_where('uom', 'unit_name', 'unit_id', $unit_id);
            $client=$this->super_model->select_column_where("client", "buyer_name", "client_id", $head->client_id);
            $item=$this->super_model->select_column_where("items", "item_name", "item_id", $head->item_id);
            foreach($this->super_model->select_custom_where("fifo_out","sales_id='$head->sales_id' AND item_id = '$head->item_id'") AS $sales){
                if($head->sales_type=='goods'){
                        $po_jo = $this->super_model->select_column_where('sales_good_head', 'po_no', 'sales_good_head_id', $sales_good_head_id);
                        $array_qty[] = $sales->quantity;
                        $total_qty = array_sum($array_qty);
                        $total_cost[] = $sales->quantity * $sales->unit_cost;
                        $array_cost = array($total_cost);
                        $total_unit_cost = array_sum($total_cost);
                        $sum_sales[] = $sales->quantity * $sales->selling_price;
                        $array_sales = array($sum_sales);
                        $total_sales = array_sum($sum_sales);
                        $gross_profit = $total_sales - $total_unit_cost;
                }else if($head->sales_type=='services'){
                        $po_jo = $this->super_model->select_column_where('sales_services_head', 'jor_no', 'sales_serv_head_id', $sales_serv_head_id);
                        $array_qty[] = $sales->quantity;
                        $total_qty = array_sum($array_qty);
                        $total_cost[] = $sales->quantity * $sales->unit_cost;
                        $array_cost = array($total_cost);
                        $total_unit_cost = array_sum($total_cost);
                        $sum_sales[] = $sales->quantity * $sales->selling_price;
                        $array_sales = array($sum_sales);
                        $total_sales = array_sum($sum_sales);
                        $gross_profit = $total_sales - $total_unit_cost;
                }
            }
            $totalsales[] = $total_sales;
            $totalcost[] = $total_unit_cost;
            $grossprofit[] = $gross_profit;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $x);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$num, $head->billing_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$num, $item);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $client);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$num, $po_jo);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$num, $head->billing_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$num, $total_qty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$num, $unit);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$num, $total_sales);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$num, $total_unit_cost);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$num, $gross_profit);
            $objPHPExcel->getActiveSheet()->getStyle("P".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle("R".$num.':V'.$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":W".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('M'.$num.":V".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$num.":C".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('D'.$num.":F".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('G'.$num.":J".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('K'.$num.":L".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('M'.$num.":O".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('R'.$num.":S".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('T'.$num.":U".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('V'.$num.":W".$num);
            $num++;
            $x++;
        }
        $a = $num+1;
        $objPHPExcel->getActiveSheet()->getStyle('Q'.$a)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('R'.$a.":V".$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("R".$a.':V'.$a)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $objPHPExcel->getActiveSheet()->setCellValue('Q'.$a, "TOTAL: ");
        $objPHPExcel->getActiveSheet()->setCellValue('R'.$a, array_sum($totalsales));
        $objPHPExcel->getActiveSheet()->setCellValue('T'.$a, array_sum($totalcost));
        $objPHPExcel->getActiveSheet()->setCellValue('V'.$a, array_sum($grossprofit));
        $objPHPExcel->getActiveSheet()->mergeCells('R'.$a.":S".$a);
        $objPHPExcel->getActiveSheet()->mergeCells('T'.$a.":U".$a);
        $objPHPExcel->getActiveSheet()->mergeCells('V'.$a.":W".$a);
        $num--;
        $objPHPExcel->getActiveSheet()->mergeCells('B6:C6');
        $objPHPExcel->getActiveSheet()->mergeCells('D6:F6');
        $objPHPExcel->getActiveSheet()->mergeCells('G6:J6');
        $objPHPExcel->getActiveSheet()->mergeCells('K6:L6');
        $objPHPExcel->getActiveSheet()->mergeCells('M6:O6');
        $objPHPExcel->getActiveSheet()->mergeCells('R6:S6');
        $objPHPExcel->getActiveSheet()->mergeCells('T6:U6');
        $objPHPExcel->getActiveSheet()->mergeCells('V6:W6');
        $objPHPExcel->getActiveSheet()->getStyle('A6:W6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A6:W6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A6:W6")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->mergeCells('H2:W2');
        $objPHPExcel->getActiveSheet()->getStyle('H2:W2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2:W2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:W4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:W1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:W1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:W2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:W3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:W4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:W1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:W2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:W3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:W4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('W1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('W2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('W3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('W4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Summary of Sales, Costs, And Gross Profit.xlsx"');
        readfile($exportfilename);
    }

    public function pending_list(){
        $data['clients'] = $this->super_model->select_all("client");

        $client = $this->uri->segment(3);
        $type = $this->uri->segment(4);

        $data['client']=$client;
        $data['type']=$type;
        $data['sales_combined']=array();
           
        $data['grand_total'] =0;
        if($type=='1'){
             $grand_total =0;
            $goods_count = $this->super_model->count_custom_where("sales_good_head", "client_id = '$client'");
            if($goods_count != 0){
              foreach($this->super_model->select_custom_where("sales_good_head", "client_id='$client' AND billed='0'") AS $goods){

                if($this->super_model->count_custom_where("return_head","dr_no = '$goods->dr_no'") != 0){
                    $return_id = $this->super_model->select_column_where("return_head", "return_id", "dr_no", $goods->dr_no);
                    //$returned_amount = $this->super_model->select_sum_where("return_details", "total_amount", "return_id='$return_id'");
                       $returned_amount =  $this->super_model->select_sum_join("total_amount","return_head","return_details", "return_id='$return_id' AND transaction_type='Goods'","return_id");
                    $total_sales = $this->super_model->select_sum_where("sales_good_details", "total", "sales_good_head_id='$goods->sales_good_head_id'");

                    $total_amount = $total_sales - $returned_amount;
                } else {
                    $total_amount = $this->super_model->select_sum_where("sales_good_details", "total", "sales_good_head_id='$goods->sales_good_head_id'");
                }
                
                 $grand_total += $total_amount;
                $data['sales_goods'][]=array(
                    "sales_id"=>$goods->sales_good_head_id,
                    "client"=>$this->super_model->select_column_where("client","buyer_name","client_id",$goods->client_id),
                    "dr_no"=>$goods->dr_no,
                    "dr_date"=>$goods->sales_date,
                    "total"=>$total_amount,

                );
              }

              $data['grand_total'] = $grand_total;
            } else {
                $data['sales_goods']=array();
            }
        } else if($type=='2') {
             $grand_total =0;
            $service_count = $this->super_model->count_custom_where("sales_services_head", "client_id = '$client'");
            if($service_count != 0){
              foreach($this->super_model->select_custom_where("sales_services_head", "client_id='$client' AND billed='0'") AS $services){
               
                  if($this->super_model->count_custom_where("return_head","dr_no = '$services->dr_no'") != 0){
                     $return_id = $this->super_model->select_column_where("return_head", "return_id", "dr_no", $goods->dr_no);
                     $returned_amount =  $this->super_model->select_sum_join("total_amount","return_head","return_details", "return_id='$return_id' AND transaction_type='Services'","return_id");
                      
                       $total_sales =  $this->super_model->select_sum_where("sales_serv_equipment", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'") + 
                    $this->super_model->select_sum_where("sales_serv_items", "total", "sales_serv_head_id='$services->sales_serv_head_id'") +  $this->super_model->select_sum_where("sales_serv_manpower", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'") + $this->super_model->select_sum_where("sales_serv_material", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'");

                    $total_amount = $total_sales - $returned_amount;

                 } else {
                    $total_amount = $this->super_model->select_sum_where("sales_serv_equipment", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'") + 
                    $this->super_model->select_sum_where("sales_serv_items", "total", "sales_serv_head_id='$services->sales_serv_head_id'") +  $this->super_model->select_sum_where("sales_serv_manpower", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'") + $this->super_model->select_sum_where("sales_serv_material", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'");
                 }

                   //$total_amount = $total_sales - $returned_amount;

                $grand_total += $total_amount;
                $data['sales_services'][]=array(
                    "sales_id"=>$services->sales_serv_head_id,
                    "dr_no"=>$services->dr_no,
                    "dr_date"=>$services->sales_date,
                    "total"=>$total_amount
                );
              }
               $data['grand_total'] = $grand_total;
            } else {
                $data['sales_services']=array();
            }
        } 
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/pending_list', $data);
        $this->load->view('template/footer');
    }

    public function export_pendingbilling(){
        $client = $this->uri->segment(3);
        $type = $this->uri->segment(4);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Pending Bill.xlsx";
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "PENDING BILLING REPORT");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', "DR Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', "DR No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F8', "Total Amount");
        if($type=='1'){
            $grand_total =0;
            $num=9;
            foreach($this->super_model->select_custom_where("sales_good_head", "client_id='$client' AND billed='0'") AS $goods){
                if($this->super_model->count_custom_where("return_head","dr_no = '$goods->dr_no'") != 0){
                    $return_id = $this->super_model->select_column_where("return_head", "return_id", "dr_no", $goods->dr_no);
                    $returned_amount =  $this->super_model->select_sum_join("total_amount","return_head","return_details", "return_id='$return_id' AND transaction_type='Goods'","return_id");
                    $total_sales = $this->super_model->select_sum_where("sales_good_details", "total", "sales_good_head_id='$goods->sales_good_head_id'");
                    $total_amount = $total_sales - $returned_amount;
                } else {
                    $total_amount = $this->super_model->select_sum_where("sales_good_details", "total", "sales_good_head_id='$goods->sales_good_head_id'");
                }
                $grand_total += $total_amount;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F6', "Overall Total Amount");
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G7', $grand_total);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, date('F d,Y',strtotime($goods->sales_date)));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $goods->dr_no);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $total_amount);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$num.":G".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":G".$num)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":E".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":G".$num);
                $num++;
            }
        } else if($type=='2') {
            $grand_total =0;
            $num=9;
            foreach($this->super_model->select_custom_where("sales_services_head", "client_id='$client' AND billed='0'") AS $services){
                $total_sales =  $this->super_model->select_sum_where("sales_serv_equipment", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'") + $this->super_model->select_sum_where("sales_serv_items", "total", "sales_serv_head_id='$services->sales_serv_head_id'") +  $this->super_model->select_sum_where("sales_serv_manpower", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'") + $this->super_model->select_sum_where("sales_serv_material", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'");
                $returned_amount =  $this->super_model->select_sum_join("total_amount","return_head","return_details", "return_id='$return_id' AND transaction_type='Services'","return_id");
                $total_amount = $total_sales - $returned_amount;
                $grand_total += $total_amount;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F6', "Overall Total Amount");
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G7', $grand_total);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, date('F d,Y',strtotime($re->sales_date)));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $re->dr_no);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $total_amount);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$num.":G".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":G".$num)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":E".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":G".$num);
                $num++;
            }
        } 
        $objPHPExcel->getActiveSheet()->getStyle('F6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G7')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $objPHPExcel->getActiveSheet()->mergeCells('A8:B8');
        $objPHPExcel->getActiveSheet()->mergeCells('C8:E8');
        $objPHPExcel->getActiveSheet()->mergeCells('F8:G8');
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A8:G8")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->mergeCells('H2:J2');
        $objPHPExcel->getActiveSheet()->getStyle('H2:J2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('J2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('J3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('J4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Pending Bill.xlsx"');
        readfile($exportfilename);
    }

    public function pending_popup(){
        $ids = $this->uri->segment(3);
        $client_id = $this->uri->segment(4);
        $data['type'] = $this->uri->segment(5);
        $data['ids'] = urldecode($ids);
        $data['client'] = $this->super_model->select_column_where("client", "buyer_name", "client_id",$client_id);
        $data['client_id'] = $client_id;

        $year_series=date('Y');
        $rows=$this->super_model->count_custom_where("billing_head","create_date LIKE '$year_series%'");
        if($rows==0){
             $data['bs_no'] = "BS-".$year_series."-0001";
        } else {
            $maxbs_no=$this->super_model->get_max_where("billing_head", "billing_no","create_date LIKE '$year_series%'");
            $bsno = explode('-',$maxbs_no);
            $series = $bsno[2]+1;
            if(strlen($series)==1){
                $data['bs_no'] = "BS-".$year_series."-000".$series;
            } else if(strlen($series)==2){
                 $data['bs_no'] = "BS-".$year_series."-00".$series;
            } else if(strlen($series)==3){
                 $data['bs_no'] = "BS-".$year_series."-0".$series;
            } else if(strlen($series)==4){
                 $data['bs_no'] = "BS-".$year_series."-".$series;
            }
        }

        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/pending_popup',$data);
        $this->load->view('template/footer');
    }

    public function billed_list(){
        $data['clients'] = $this->super_model->select_all("client");

        $client = $this->uri->segment(3);
        $data['client']=$client;
        $grand_total =0;
        foreach($this->super_model->select_custom_where("billing_head", "client_id= '$client' AND status='0'") AS $bill){

            // echo $bill->billing_id;
            $total_amount = $this->super_model->select_sum_where("billing_details", "remaining_amount", "billing_id='$bill->billing_id'");
            $grand_total += $total_amount;
            $count_adjust = $this->check_adjustment($bill->billing_id);
            $data['billed'][]= array(
                "billing_id"=>$bill->billing_id,
                "client"=>$this->super_model->select_column_where("client", "buyer_name", "client_id", $bill->client_id),
                "billing_no"=>$bill->billing_no,
                "adjustment_counter"=>$bill->adjustment_counter,
                "billing_date"=>$bill->billing_date,
                "total_amount"=>$total_amount,
                "count_adjust"=>$count_adjust,
                "counter"=>$bill->adjustment_counter
            );
        }

        $data['grand_total'] = $grand_total;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/billed_list', $data);
        $this->load->view('template/footer');
    }

    public function export_billed(){
        $client = $this->uri->segment(3);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Billing Statement.xlsx";
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "BILLED REPORT");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', "Billing Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', "Billing Statement No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F8', "Adjustments");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H8', "Total Amount");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H6', "Overall Total Amount");
        $grand_total =0;
        $num=9;
        foreach($this->super_model->select_custom_where("billing_head", "client_id= '$client' AND status='0'") AS $bill){
            // echo $bill->billing_id;
            $total_amount = $this->super_model->select_sum_where("billing_details", "remaining_amount", "billing_id='$bill->billing_id'");
            $grand_total += $total_amount;
            $count_adjust = $this->check_adjustment($bill->billing_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I7', $grand_total);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $bill->billing_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $bill->billing_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $bill->adjustment_counter);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $total_amount);
            $objPHPExcel->getActiveSheet()->getStyle("H".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":I".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":F".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":E".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":G".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$num.":I".$num);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('H6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I7')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $objPHPExcel->getActiveSheet()->mergeCells('A8:B8');
        $objPHPExcel->getActiveSheet()->mergeCells('C8:E8');
        $objPHPExcel->getActiveSheet()->mergeCells('F8:G8');
        $objPHPExcel->getActiveSheet()->mergeCells('H8:I8');
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A8:I8")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->mergeCells('H2:J2');
        $objPHPExcel->getActiveSheet()->getStyle('H2:J2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('J2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('J3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('J4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Billing Statement.xlsx"');
        readfile($exportfilename);
    }

    public function check_adjustment($billing_id){
        $count =0;
       // echo "billing_id = '$billing_id' AND status ='0'";
        foreach($this->super_model->select_custom_where("billing_adjustment_history", "billing_id = '$billing_id' AND status ='0'") AS $r){
            $count++;
        }
        return $count;
    }


    public function bill_pay(){
        $billing = $this->uri->segment(3);
        $id = urldecode($billing);
        $data['ids']=$id;
        $bs = explode(",",$id);
        foreach($bs AS $b){
            $total_amount = $this->super_model->select_sum_where("billing_details", "remaining_amount", "billing_id='$b'");
            $data['statement'][] = array(
                "billing_id"=>$b,
                "billing_date"=>$this->super_model->select_column_where("billing_head", "billing_date", "billing_id",$b),
                "billing_no"=>$this->super_model->select_column_where("billing_head", "billing_no", "billing_id",$b),
                "total_amount"=>$total_amount
            );
        }
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/bill_pay',$data);
        $this->load->view('template/footer');
    }

    public function paid_list(){
        $data['clients'] = $this->super_model->select_all("client");

        $client = $this->uri->segment(3);
        $data['client']=$client;
        $gtotal=0;
       // $total_amount=0;

       /*  foreach($this->super_model->select_custom_where("billing_head", "client_id= '$client'") AS $bill){

             echo $bill->billing_id;
            $total_amount = $this->super_model->select_sum_where("billing_payment", "amount", "billing_id='$bill->billing_id'");

            foreach($this->super_model->custom_query("SELECT * FROM billing_payment WHERE FIND_IN_SET($bill->billing_id, billing_id)") AS $b){
                    $total_amount+=$b->amount;
            } 
            $grand_total += $total_amount;

            $count_adjust = $this->check_adjustment($bill->billing_id);
            $data['paid'][]= array(
                "billing_id"=>$bill->billing_id,
                "client"=>$this->super_model->select_column_where("client", "buyer_name", "client_id", $bill->client_id),
                "billing_no"=>$bill->billing_no,
                "billing_date"=>$bill->billing_date,
                "total_amount"=>$total_amount,
                "count_adjust"=>$count_adjust,
                "counter"=>$bill->adjustment_counter
            );
               $total_amount=0;
        }*/

       foreach($this->super_model->select_all("billing_payment") AS $p){

           $billing_id = explode(",",$p->billing_id);
          
           $billing_no = "";
           $dr_no = "";
           foreach($billing_id AS $bid){
           
                $billing_no .= $this->super_model->select_column_where("billing_head", "billing_no", "billing_id", $bid) . ", ";
                $dr_no .= $this->super_model->select_column_where("billing_details", "dr_no", "billing_id", $bid) . ", ";
                $adjustment_counter = $this->super_model->select_column_where("billing_head", "adjustment_counter", "billing_id", $bid);
           }

           $bill_no = substr($billing_no,0,-2);
           $dr_no = substr($dr_no,0,-2);
           $gtotal += $p->amount;

            $data['payment'][] = array(
                'payment_date'=>$p->payment_date,
                'billing_no'=>$bill_no,
                'adjustment_counter'=>$adjustment_counter,
                'payment_type'=>$p->payment_type,
                'check_no'=>$p->check_no,
                'dr_no'=>$dr_no,
                'receipt_no'=>$p->receipt_no,
                'amount'=>$p->amount
            );
        }
        $data['grand_total'] = $gtotal;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/paid_list',$data);
        $this->load->view('template/footer');
    }

    public function export_paid(){
        $client = $this->uri->segment(3);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Paid Billing Statement.xlsx";
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "PAID BILLING REPORT");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', "Payment Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', "Billing Statement No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F8', "DR No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H8', "Payment Type");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J8', "Check / Receipt No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L8', "Amount Paid");
        $num=9;
        $gtotal=0;
        foreach($this->super_model->select_all("billing_payment") AS $p){
            $billing_id = explode(",",$p->billing_id);
            $billing_no = "";
            $dr_no = "";
            foreach($billing_id AS $bid){
                $billing_no .= $this->super_model->select_column_where("billing_head", "billing_no", "billing_id", $bid) . ", ";
                $dr_no .= $this->super_model->select_column_where("billing_details", "dr_no", "billing_id", $bid) . ", ";
            }
            $bill_no = substr($billing_no,0,-2);
            $dr_no = substr($dr_no,0,-2);
            $gtotal += $p->amount;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L6', "Overall Total Paid");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M7', $gtotal);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $p->payment_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $bill_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $dr_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $p->payment_type);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $p->check_no." / ".$p->receipt_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$num, $p->amount);
            $objPHPExcel->getActiveSheet()->getStyle("L".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":M".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$num.":M".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":E".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":G".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$num.":I".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('J'.$num.":K".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('L'.$num.":M".$num);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('L6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('M7')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $objPHPExcel->getActiveSheet()->mergeCells('A8:B8');
        $objPHPExcel->getActiveSheet()->mergeCells('C8:E8');
        $objPHPExcel->getActiveSheet()->mergeCells('F8:G8');
        $objPHPExcel->getActiveSheet()->mergeCells('H8:I8');
        $objPHPExcel->getActiveSheet()->mergeCells('J8:K8');
        $objPHPExcel->getActiveSheet()->mergeCells('L8:M8');
        $objPHPExcel->getActiveSheet()->getStyle('A8:M8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A8:M8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A8:M8")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->mergeCells('H2:M2');
        $objPHPExcel->getActiveSheet()->getStyle('H2:M2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2:M2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:M4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:M4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:M4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('M2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('M3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('M4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Paid Billing Statement.xlsx"');
        readfile($exportfilename);
    }

    public function save_billing_statement(){
        $type = $this->input->post('salestype');
        $data = array(
            "billing_no"=>$this->input->post('bs_no'),
            "billing_date"=>$this->input->post('bs_date'),
            "client_id"=>$this->input->post('client_id'),
            "create_date"=>date("Y-m-d H:i:s"),
            "user_id"=>$_SESSION['user_id'],
        );
        $id= $this->super_model->insert_return_id("billing_head", $data);

        $sales_id = $this->input->post('sales_id');
        $sales = explode(",", $sales_id);
      
       if($type==1){
            $grand_total = 0;
            $grand_total_uc = 0;
            foreach($sales AS $sid){

                $dr_no =  $this->super_model->select_column_where("sales_good_head", "dr_no", "sales_good_head_id", $sid);
                if($this->super_model->count_custom_where("return_head","dr_no = '$dr_no'") != 0){
                    $return_id = $this->super_model->select_column_where("return_head", "return_id", "dr_no", $dr_no);
                    $returned_amount = $this->super_model->select_sum_where("return_details", "total_amount", "return_id='$return_id'");
                    $total_sales = $this->super_model->select_sum_where("sales_good_details", "total", "sales_good_head_id='$sid'");

                    $total_amount = $total_sales - $returned_amount;
                } else {
                     $total_amount = $this->super_model->select_sum_where("sales_good_details", "total", "sales_good_head_id='$sid'");
                }
                
                $grand_total +=$total_amount;

                $total_unit_cost=array();
                foreach($this->super_model->select_custom_where("fifo_out", "transaction_type='Sales Goods' AND sales_id = '$sid'") AS $uc){
                    $total_unit_cost[] = $uc->unit_cost * $uc->quantity;
                }

                $total_uc = array_sum($total_unit_cost);
                $grand_total_uc +=$total_uc;
               
                $data_details = array(
                    "billing_id"=>$id,
                    "sales_type"=>"goods",
                    "sales_id"=>$sid,
                    "dr_no"=>$this->super_model->select_column_where("sales_good_head", "dr_no", "sales_good_head_id", $sid),
                    "dr_date"=>$this->super_model->select_column_where("sales_good_head", "sales_date", "sales_good_head_id", $sid),
                    "total_unit_cost"=>$total_uc,
                    "total_amount"=>$total_amount,
                    "remaining_amount"=>$total_amount,
                );

                $this->super_model->insert_into("billing_details", $data_details);

                $data_sales = array(
                    "billed"=>'1'
                );
                $this->super_model->update_where("sales_good_head", $data_sales, "sales_good_head_id", $sid);
            }

            $data_total = array(
                "total_amount"=>$grand_total,
                "total_unit_cost"=>$grand_total_uc
            );
            $this->super_model->update_where("billing_head", $data_total, "billing_id", $id);

        }


       if($type==2){
            $grand_total = 0;
            foreach($sales AS $sid){
                $total_amount =  $this->super_model->select_sum_where("sales_serv_equipment", "total_cost", "sales_serv_head_id='$sid'") + 
                $this->super_model->select_sum_where("sales_serv_items", "total", "sales_serv_head_id='$sid'") +  $this->super_model->select_sum_where("sales_serv_manpower", "total_cost", "sales_serv_head_id='$sid'") + $this->super_model->select_sum_where("sales_serv_material", "total_cost", "sales_serv_head_id='$sid'");

                $grand_total +=$total_amount;
                $data_details = array(
                    "billing_id"=>$id,
                    "sales_type"=>"services",
                    "sales_id"=>$sid,
                    "dr_no"=>$this->super_model->select_column_where("sales_services_head", "dr_no", "sales_serv_head_id", $sid),
                    "dr_date"=>$this->super_model->select_column_where("sales_services_head", "sales_date", "sales_serv_head_id", $sid),
                    "total_amount"=>$total_amount,
                    "remaining_amount"=>$total_amount,
                );

                $this->super_model->insert_into("billing_details", $data_details);

                $data_sales = array(
                    "billed"=>'1'
                );
                $this->super_model->update_where("sales_services_head", $data_sales, "sales_serv_head_id", $sid);
            }

            $data_total = array(
                "total_amount"=>$grand_total
            );
            $this->super_model->update_where("billing_head", $data_total, "billing_id", $id);


        }

        echo $id;
    }

    public function print_billing(){
        $bsid = $this->uri->segment(3);

        foreach($this->super_model->select_row_where("billing_head", "billing_id", $bsid) AS $bs){
            $data['head'][] = array(
                "billing_no"=>$bs->billing_no,
                "date"=>$bs->billing_date,
                "adjustment_counter"=>$bs->adjustment_counter,
                "client"=>$this->super_model->select_column_where("client", "buyer_name", "client_id", $bs->client_id),
                "address"=>$this->super_model->select_column_where("client", "address", "client_id", $bs->client_id),
                "tin"=>$this->super_model->select_column_where("client", "tin", "client_id", $bs->client_id),
            );
        }

        $data['details']=$this->super_model->select_custom_where("billing_details", "billing_id='$bsid' AND remaining_amount != '0' ORDER BY dr_date DESC");
        $data['billing_id']=$bsid;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/print_billing',$data);
        $this->load->view('template/footer');
    }

    public function submit_payment(){
        $billing_id = $this->input->post('billing_id');
        $amount=$this->input->post('amount');
        $bill_id = explode(",",$billing_id);
        $data=array(
           "billing_id"=>$billing_id,
           "payment_date"=>$this->input->post('payment_date'),
           "payment_type"=>$this->input->post('payment_type'),
           "check_no"=>$this->input->post('check_no'),
           "receipt_no"=>$this->input->post('receipt_no'),
           "amount"=>$amount,
           "create_date"=>date("Y-m-d H:i:s"),
           "user_id"=>$_SESSION['user_id'],
        );

        $this->super_model->insert_into("billing_payment", $data);
        $query="";
        foreach($bill_id AS $bid){
            $query .= " billing_id = '$bid' OR";
        }

        $q=substr($query, 0, -3);
        $tmpamount=$amount;
        foreach($this->super_model->custom_query("SELECT * FROM billing_details WHERE $q ORDER BY dr_date ASC") AS $bill){
           
                   if($tmpamount > 0){

                        $tmpamount = $tmpamount - $bill->remaining_amount;
                
                        if($tmpamount>0){
                            $am = $bill->remaining_amount;

                            $data_rem= array(
                                'remaining_amount'=>0
                            );
                           $this->super_model->update_where("billing_details", $data_rem, 'billing_detail_id', $bill->billing_detail_id);

                        } else {
                            $am = $bill->remaining_amount + $tmpamount;
                            $newam = $bill->remaining_amount -  $am;

                            $data_rem= array(
                                'remaining_amount'=>$newam
                            );
                           $this->super_model->update_where("billing_details", $data_rem, 'billing_detail_id', $bill->billing_detail_id);
                        }     
                   
                  }

        }

        foreach($bill_id AS $bid){
            $check_full_paid = $this->super_model->select_sum_where("billing_details", "remaining_amount", "billing_id='$bid'");
                if($check_full_paid == 0){
                    $data_status=array(
                        "status"=>1
                    );
                    $this->super_model->update_where("billing_head", $data_status, 'billing_id', $bid);
                }
        }
    }

    public function stock_card(){
        $item_id = $this->uri->segment(3);
        $data['item_id']=$item_id;
        $now = date("Y-m-d");
        $data['item_name']=$this->super_model->select_column_where('items',"item_name","item_id",$item_id);
        $data['items']=$this->super_model->select_all_order_by("items","item_name","ASC");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->custom_query("SELECT rh.receive_id,rh.receive_date, ri.supplier_id, ri.brand, ri.catalog_no, ri.received_qty, ri.item_cost, ri.rd_id, ri.ri_id, rh.create_date, ri.shipping_fee, rh.po_no,ri.expiration_date FROM receive_head rh INNER JOIN receive_items ri ON rh.receive_id = ri.receive_id WHERE item_id = '$item_id' AND saved='1'") AS $stk){
            $pr_no = $this->super_model->select_column_where("receive_details", "pr_no", "rd_id", $stk->rd_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $stk->supplier_id);
            $total_cost = $stk->received_qty*$stk->item_cost;
            if($stk->expiration_date=='' || $stk->expiration_date > $now){
                $method = 'Receive';
            }else {
                $method = 'Expired';
            }
            //if($stk->expiration_date=='' || $stk->expiration_date >= $now){
                $data['stockcard'][]=array(
                    'date'=>$stk->receive_date,
                    'create_date'=>$stk->create_date,
                    'supplier'=>$supplier,
                    'pr_no'=>$pr_no,
                    'po_no'=>$stk->po_no,
                    'catalog_no'=>$stk->catalog_no,
                    'brand'=>$stk->brand,
                    'item_cost'=>$total_cost,
                    'quantity'=>$stk->received_qty,
                    'remaining_qty'=>'',
                    'series'=>'1',
                    'method'=>$method,
                );

                $data['balance'][] = array(
                    'series'=>'1',
                    'method'=>$method,
                    'quantity'=>$stk->received_qty,
                    'remaining_qty'=>'',
                    'date'=>$stk->receive_date,
                    'create_date'=>$stk->create_date
                );
            //}

            /*if($stk->expiration_date <= $now && $stk->expiration_date!=''){
                $data['stockcard'][]=array(
                    'date'=>$stk->receive_date,
                    'create_date'=>$stk->create_date,
                    'supplier'=>$supplier,
                    'pr_no'=>$pr_no,
                    'po_no'=>$stk->po_no,
                    'catalog_no'=>$stk->catalog_no,
                    'brand'=>$stk->brand,
                    'item_cost'=>$total_cost,
                    'quantity'=>$stk->received_qty,
                    'series'=>'2',
                    'method'=>'Expired',
                );

                $data['balance'][] = array(
                    'series'=>'2',
                    'method'=>'Expired',
                    'quantity'=>$stk->received_qty,
                    'date'=>$stk->receive_date,
                    'create_date'=>$stk->create_date
                );
            }*/
        }

        /*foreach($this->super_model->custom_query("SELECT rh.receive_id,rh.receive_date, ri.supplier_id, ri.brand, ri.catalog_no, ri.received_qty, ri.item_cost, ri.rd_id, ri.ri_id, rh.create_date, ri.shipping_fee, rh.po_no, ri.item_id,ri.serial_no FROM receive_head rh INNER JOIN receive_items ri ON rh.receive_id = ri.receive_id WHERE item_id = '$item_id' AND (expiration_date <= '$now' AND expiration_date!='') AND saved='1'") AS $rec){
            $pr_no = $this->super_model->select_column_where("receive_details", "pr_no", "rd_id", $rec->rd_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $rec->supplier_id);
            $remaining_qty = $this->super_model->select_column_custom_where("fifo_in",'remaining_qty',"item_id = '$rec->item_id' AND brand='$rec->brand' AND catalog_no='$rec->catalog_no' AND serial_no='$rec->serial_no' AND (expiry_date <= '$now' AND expiry_date!='')");
            $total_cost = $rec->received_qty*$rec->item_cost;
            $data['stockcard'][]=array(
                'date'=>$rec->receive_date,
                'create_date'=>$rec->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$rec->po_no,
                'catalog_no'=>$rec->catalog_no,
                'brand'=>$rec->brand,
                'item_cost'=>$total_cost,
                'quantity'=>$rec->received_qty,
                'remaining_qty'=>$remaining_qty,
                'series'=>'2',
                'method'=>'Expired',
            );

            $data['balance'][] = array(
                'series'=>'2',
                'method'=>'Expired',
                'quantity'=>$rec->received_qty,
                'remaining_qty'=>$remaining_qty,
                'date'=>$rec->receive_date,
                'create_date'=>$rec->create_date
            );
        }*/

        foreach($this->super_model->custom_query("SELECT * FROM sales_good_head sh INNER JOIN sales_good_details sd ON sh.sales_good_head_id = sd.sales_good_head_id WHERE item_id = '$item_id' AND saved='1'") AS $sal){
            $in_id = $this->super_model->select_column_where("fifo_out","in_id","sales_details_id",$sal->sales_good_det_id);
            $brand = $this->super_model->select_column_where("fifo_in","brand","in_id",$in_id);
            $catalog_no = $this->super_model->select_column_where("fifo_in","catalog_no","in_id",$in_id);
            $client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $sal->client_id);
            $total_cost = $sal->quantity*$sal->unit_cost;
            $data['stockcard'][]=array(
                'date'=>$sal->sales_date,
                'create_date'=>$sal->create_date,
                'supplier'=>$client,
                'pr_no'=>$sal->pr_no,
                'po_no'=>$sal->po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$sal->quantity,
                'remaining_qty'=>'',
                'series'=>'3',
                'method'=>'Sales Good',
            );

            $data['balance'][] = array(
                'series'=>'3',
                'method'=>'Sales Good',
                'quantity'=>$sal->quantity,
                'remaining_qty'=>'',
                'date'=>$sal->sales_date,
                'create_date'=>$sal->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM sales_services_head sh INNER JOIN sales_serv_items si ON sh.sales_serv_head_id = si.sales_serv_head_id WHERE item_id = '$item_id' AND saved='1'") AS $sas){
            $in_id = $this->super_model->select_column_where("fifo_out","in_id","sales_serv_items_id",$sas->sales_serv_items_id);
            $brand = $this->super_model->select_column_where("fifo_in","brand","in_id",$in_id);
            $catalog_no = $this->super_model->select_column_where("fifo_in","catalog_no","in_id",$in_id);
            $client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $sas->client_id);
            $total_cost = $sas->quantity*$sas->unit_cost;
            $data['stockcard'][]=array(
                'date'=>$sas->sales_date,
                'create_date'=>$sas->create_date,
                'supplier'=>$client,
                'pr_no'=>$sas->jor_no,
                'po_no'=>$sas->joi_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$sas->quantity,
                'remaining_qty'=>'',
                'series'=>'4',
                'method'=>'Sales Services',
            );

            $data['balance'][] = array(
                'series'=>'4',
                'method'=>'Sales Services',
                'quantity'=>$sas->quantity,
                'remaining_qty'=>'',
                'date'=>$sas->sales_date,
                'create_date'=>$sas->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM damage_head dh INNER JOIN damage_details dd ON dh.damage_id = dd.damage_id WHERE item_id = '$item_id'") AS $dam){
            $receive_id = $this->super_model->select_column_where("fifo_in","receive_id","in_id",$dam->in_id);
            $brand = $this->super_model->select_column_where("receive_items","brand","receive_id",$receive_id);
            $catalog_no = $this->super_model->select_column_where("receive_items","catalog_no","receive_id",$receive_id);
            $supplier_id = $this->super_model->select_column_where("receive_items","supplier_id","receive_id",$receive_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id);
            $pr_no = $this->super_model->select_column_where("receive_details","pr_no","receive_id",$receive_id);
            $po_no = $this->super_model->select_column_where("receive_head","po_no","receive_id",$receive_id);
            $item_cost = $this->super_model->select_column_where("receive_items","item_cost","receive_id",$receive_id);
            $total_cost = $dam->damage_qty*$item_cost;
            $data['stockcard'][]=array(
                'date'=>$dam->damage_date,
                'create_date'=>$dam->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$dam->damage_qty,
                'remaining_qty'=>'',
                'series'=>'5',
                'method'=>'Damaged',
            );

            $data['balance'][] = array(
                'series'=>'5',
                'method'=>'Damaged',
                'quantity'=>$dam->damage_qty,
                'remaining_qty'=>'',
                'date'=>$dam->damage_date,
                'create_date'=>$dam->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM repair_details WHERE item_id = '$item_id' AND assessment='1'") AS $rep){
            //$client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $rep->client_id);
            $receive_id = $this->super_model->select_column_where("fifo_in","receive_id","in_id",$rep->in_id);
            $brand = $this->super_model->select_column_where("fifo_in","brand","receive_id",$receive_id);
            $catalog_no = $this->super_model->select_column_where("fifo_in","catalog_no","receive_id",$receive_id);
            $supplier_id = $this->super_model->select_column_where("fifo_in","supplier_id","receive_id",$receive_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id);
            $pr_no = $this->super_model->select_column_where("fifo_in","pr_no","receive_id",$receive_id);
            //$po_no = $this->super_model->select_column_where("receive_head","po_no","receive_id",$receive_id);
            $total_cost = $rep->quantity*$rep->repair_price;
            $data['stockcard'][]=array(
                'date'=>$rep->repair_date,
                'create_date'=>$rep->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$rep->jo_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$rep->quantity,
                'remaining_qty'=>'',
                'series'=>'6',
                'method'=>'Repaired',
            );

            $data['balance'][] = array(
                'series'=>'6',
                'method'=>'Repaired',
                'quantity'=>$rep->quantity,
                'remaining_qty'=>'',
                'date'=>$rep->repair_date,
                'create_date'=>$rep->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM return_head rh INNER JOIN return_details rd ON rh.return_id = rd.return_id WHERE item_id = '$item_id'") AS $ret){
            $receive_id = $this->super_model->select_column_where("fifo_in","receive_id","in_id",$ret->in_id);
            $brand = $this->super_model->select_column_where("receive_items","brand","receive_id",$receive_id);
            $catalog_no = $this->super_model->select_column_where("receive_items","catalog_no","receive_id",$receive_id);
            $supplier_id = $this->super_model->select_column_where("receive_items","supplier_id","receive_id",$receive_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id);
            $pr_no = $this->super_model->select_column_where("receive_details","pr_no","receive_id",$receive_id);
            $po_no = $this->super_model->select_column_where("receive_head","po_no","receive_id",$receive_id);
            $item_cost = $this->super_model->select_column_where("receive_items","item_cost","receive_id",$receive_id);
            $total_cost = ($ret->return_qty + $ret->damage_qty) *$item_cost;
            $total_qty = $ret->return_qty + $ret->damage_qty;
            $data['stockcard'][]=array(
                'date'=>$ret->return_date,
                'create_date'=>$ret->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$total_qty,
                'remaining_qty'=>'',
                'series'=>'7',
                'method'=>'Return',
            );

            $data['balance'][] = array(
                'series'=>'7',
                'method'=>'Return',
                'quantity'=>$total_qty,
                'remaining_qty'=>'',
                'date'=>$ret->return_date,
                'create_date'=>$ret->create_date
            );
        }
        $this->load->view('reports/stock_card',$data);
        $this->load->view('template/footer');
    }

    public function export_stockcard(){
        $item_id = $this->uri->segment(3);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Stockcard.xlsx";
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L2', "STOCKCARD REPORT");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', "Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', "Supplier/Client");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F8', "PR No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H8', "PO No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J8', "Catalog No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L8', "Brand");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N8', "Method");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P8', "Total Unit Cost");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R8', "Quantity");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T8', "Running Balance");
        foreach($this->super_model->custom_query("SELECT rh.receive_id,rh.receive_date, ri.supplier_id, ri.brand, ri.catalog_no, ri.received_qty, ri.item_cost, ri.rd_id, ri.ri_id, rh.create_date, ri.shipping_fee, rh.po_no,ri.expiration_date FROM receive_head rh INNER JOIN receive_items ri ON rh.receive_id = ri.receive_id WHERE item_id = '$item_id' AND saved='1'") AS $stk){
            $pr_no = $this->super_model->select_column_where("receive_details", "pr_no", "rd_id", $stk->rd_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $stk->supplier_id);
            $total_cost = $stk->received_qty*$stk->item_cost;
            if($stk->expiration_date=='' || $stk->expiration_date > $now){
                $method = 'Receive';
            }else {
                $method = 'Expired';
            }
            $stockcard[]=array(
                'date'=>$stk->receive_date,
                'create_date'=>$stk->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$stk->po_no,
                'catalog_no'=>$stk->catalog_no,
                'brand'=>$stk->brand,
                'item_cost'=>$total_cost,
                'quantity'=>$stk->received_qty,
                'remaining_qty'=>'',
                'series'=>'1',
                'method'=>$method,
            );

            $balance[] = array(
                'series'=>'1',
                'method'=>$method,
                'quantity'=>$stk->received_qty,
                'remaining_qty'=>'',
                'date'=>$stk->receive_date,
                'create_date'=>$stk->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM sales_good_head sh INNER JOIN sales_good_details sd ON sh.sales_good_head_id = sd.sales_good_head_id WHERE item_id = '$item_id' AND saved='1'") AS $sal){
            $in_id = $this->super_model->select_column_where("fifo_out","in_id","sales_details_id",$sal->sales_good_det_id);
            $brand = $this->super_model->select_column_where("fifo_in","brand","in_id",$in_id);
            $catalog_no = $this->super_model->select_column_where("fifo_in","catalog_no","in_id",$in_id);
            $client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $sal->client_id);
            $total_cost = $sal->quantity*$sal->unit_cost;
            $stockcard[]=array(
                'date'=>$sal->sales_date,
                'create_date'=>$sal->create_date,
                'supplier'=>$client,
                'pr_no'=>$sal->pr_no,
                'po_no'=>$sal->po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$sal->quantity,
                'remaining_qty'=>'',
                'series'=>'3',
                'method'=>'Sales Good',
            );

            $balance[] = array(
                'series'=>'3',
                'method'=>'Sales Good',
                'quantity'=>$sal->quantity,
                'remaining_qty'=>'',
                'date'=>$sal->sales_date,
                'create_date'=>$sal->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM sales_services_head sh INNER JOIN sales_serv_items si ON sh.sales_serv_head_id = si.sales_serv_head_id WHERE item_id = '$item_id' AND saved='1'") AS $sas){
            $in_id = $this->super_model->select_column_where("fifo_out","in_id","sales_serv_items_id",$sas->sales_serv_items_id);
            $brand = $this->super_model->select_column_where("fifo_in","brand","in_id",$in_id);
            $catalog_no = $this->super_model->select_column_where("fifo_in","catalog_no","in_id",$in_id);
            $client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $sas->client_id);
            $total_cost = $sas->quantity*$sas->unit_cost;
            $stockcard[]=array(
                'date'=>$sas->sales_date,
                'create_date'=>$sas->create_date,
                'supplier'=>$client,
                'pr_no'=>$sas->jor_no,
                'po_no'=>$sas->joi_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$sas->quantity,
                'remaining_qty'=>'',
                'series'=>'4',
                'method'=>'Sales Services',
            );

            $balance[] = array(
                'series'=>'4',
                'method'=>'Sales Services',
                'quantity'=>$sas->quantity,
                'remaining_qty'=>'',
                'date'=>$sas->sales_date,
                'create_date'=>$sas->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM damage_head dh INNER JOIN damage_details dd ON dh.damage_id = dd.damage_id WHERE item_id = '$item_id'") AS $dam){
            $receive_id = $this->super_model->select_column_where("fifo_in","receive_id","in_id",$dam->in_id);
            $brand = $this->super_model->select_column_where("receive_items","brand","receive_id",$receive_id);
            $catalog_no = $this->super_model->select_column_where("receive_items","catalog_no","receive_id",$receive_id);
            $supplier_id = $this->super_model->select_column_where("receive_items","supplier_id","receive_id",$receive_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id);
            $pr_no = $this->super_model->select_column_where("receive_details","pr_no","receive_id",$receive_id);
            $po_no = $this->super_model->select_column_where("receive_head","po_no","receive_id",$receive_id);
            $item_cost = $this->super_model->select_column_where("receive_items","item_cost","receive_id",$receive_id);
            $total_cost = $dam->damage_qty*$item_cost;
            $stockcard[]=array(
                'date'=>$dam->damage_date,
                'create_date'=>$dam->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$dam->damage_qty,
                'remaining_qty'=>'',
                'series'=>'5',
                'method'=>'Damaged',
            );

            $balance[] = array(
                'series'=>'5',
                'method'=>'Damaged',
                'quantity'=>$dam->damage_qty,
                'remaining_qty'=>'',
                'date'=>$dam->damage_date,
                'create_date'=>$dam->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM repair_details WHERE item_id = '$item_id' AND assessment='1'") AS $rep){
            //$client = $this->super_model->select_column_where("client", "buyer_name", "client_id", $rep->client_id);
            $receive_id = $this->super_model->select_column_where("fifo_in","receive_id","in_id",$rep->in_id);
            $brand = $this->super_model->select_column_where("receive_items","brand","receive_id",$receive_id);
            $catalog_no = $this->super_model->select_column_where("receive_items","catalog_no","receive_id",$receive_id);
            $supplier_id = $this->super_model->select_column_where("receive_items","supplier_id","receive_id",$receive_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id);
            $pr_no = $this->super_model->select_column_where("receive_details","pr_no","receive_id",$receive_id);
            $po_no = $this->super_model->select_column_where("receive_head","po_no","receive_id",$receive_id);
            $total_cost = $rep->quantity*$rep->repair_price;
            $stockcard[]=array(
                'date'=>$rep->repair_date,
                'create_date'=>$rep->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$rep->quantity,
                'remaining_qty'=>'',
                'series'=>'6',
                'method'=>'Repaired',
            );

            $balance[] = array(
                'series'=>'6',
                'method'=>'Repaired',
                'quantity'=>$rep->quantity,
                'remaining_qty'=>'',
                'date'=>$rep->repair_date,
                'create_date'=>$rep->create_date
            );
        }

        foreach($this->super_model->custom_query("SELECT * FROM return_head rh INNER JOIN return_details rd ON rh.return_id = rd.return_id WHERE item_id = '$item_id'") AS $ret){
            $receive_id = $this->super_model->select_column_where("fifo_in","receive_id","in_id",$ret->in_id);
            $brand = $this->super_model->select_column_where("receive_items","brand","receive_id",$receive_id);
            $catalog_no = $this->super_model->select_column_where("receive_items","catalog_no","receive_id",$receive_id);
            $supplier_id = $this->super_model->select_column_where("receive_items","supplier_id","receive_id",$receive_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id);
            $pr_no = $this->super_model->select_column_where("receive_details","pr_no","receive_id",$receive_id);
            $po_no = $this->super_model->select_column_where("receive_head","po_no","receive_id",$receive_id);
            $item_cost = $this->super_model->select_column_where("receive_items","item_cost","receive_id",$receive_id);
            $total_cost = ($ret->return_qty + $ret->damage_qty) *$item_cost;
            $total_qty = $ret->return_qty + $ret->damage_qty;
            $stockcard[]=array(
                'date'=>$ret->return_date,
                'create_date'=>$ret->create_date,
                'supplier'=>$supplier,
                'pr_no'=>$pr_no,
                'po_no'=>$po_no,
                'catalog_no'=>$catalog_no,
                'brand'=>$brand,
                'item_cost'=>$total_cost,
                'quantity'=>$total_qty,
                'remaining_qty'=>'',
                'series'=>'7',
                'method'=>'Return',
            );

            $balance[] = array(
                'series'=>'7',
                'method'=>'Return',
                'quantity'=>$total_qty,
                'remaining_qty'=>'',
                'date'=>$ret->return_date,
                'create_date'=>$ret->create_date
            );
        }

        //DateTime//
        if(!empty($stockcard)){
            foreach ($stockcard as $key => $row) {
                $date[$key]  = $row['date'];
                $series[$key] = $row['series'];
                $cdate[$key] = $row['create_date'];
            }
            array_multisort($date, SORT_ASC,  $cdate, SORT_ASC, $stockcard);
        }
        if(!empty($stockcard)){
            foreach ($balance as $key => $row) {
                $date[$key]  = $row['date'];
                $series[$key] = $row['series'];
                $cdate[$key] = $row['create_date'];
            }

            array_multisort($date, SORT_ASC, $cdate, SORT_ASC, $balance);
            $total_bal=0;
            foreach($balance AS $sc){
                if($sc['method'] == 'Receive' || $sc['method'] == 'Repaired' || $sc['method'] == 'Return'){ 
                    $total_bal += $sc['quantity'];
                }else if($sc['method'] == 'Sales Good' || $sc['method'] == 'Sales Services' || $sc['method'] == 'Damaged') {
                    $total_bal -= $sc['quantity'];
                } 
            }
        }else {
            $total_bal=0;
        }
        //DateTime//

        //BALANCE//
        if(!empty($stockcard)){
            $run_bal=0;
            foreach($balance AS $s){
                if($s['method'] == 'Receive' || $s['method'] == 'Repaired' || $s['method'] == 'Return'){ 
                    $run_bal += $s['quantity'];
                }else if($s['method'] == 'Sales Good' || $s['method'] == 'Sales Services' || $s['method'] == 'Damaged') {
                    $run_bal -= $s['quantity'];
                } 
                $bal[] = $run_bal;
            }
        }
        //BALANCE//
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S6', 'Running Balance');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S7', $total_bal);
        if(!empty($stockcard)){
            $count = count($stockcard)-1;
            $run_bal=0;
            $num=9;
            for($x=$count; $x>=0;$x--){ 
                if($stockcard[$x]['method']=='Receive'){
                    $badge = 'badge-primary';
                }else if($stockcard[$x]['method']=='Sales Good'){
                    $badge = 'badge-warning';
                }else if($stockcard[$x]['method']=='Sales Services'){
                    $badge = 'badge-warning';
                }else if($stockcard[$x]['method']=='Return'){
                    $badge = 'badge-info';
                }else if($stockcard[$x]['method']=='Repaired'){
                    $badge = 'badge-success';
                }else if($stockcard[$x]['method']=='Damaged'){
                    $badge = 'badge-danger';
                }else if($stockcard[$x]['method']=='Expired'){
                    $badge = 'badge-danger';
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $stockcard[$x]['date']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $stockcard[$x]['supplier']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $stockcard[$x]['pr_no']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $stockcard[$x]['po_no']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $stockcard[$x]['catalog_no']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$num, $stockcard[$x]['brand']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$num, $stockcard[$x]['method']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$num, $stockcard[$x]['item_cost']);
                if($stockcard[$x]['method']== 'Sales Good' || $stockcard[$x]['method'] == 'Sales Services' || $stockcard[$x]['method'] == 'Damaged' || $stockcard[$x]['method'] == 'Expired'){
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$num, "-".$stockcard[$x]['quantity']);
                }else{
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$num, $stockcard[$x]['quantity']);
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$num, $bal[$x]);
                $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":E".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":G".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('H'.$num.":I".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('J'.$num.":K".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('L'.$num.":M".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('N'.$num.":O".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('P'.$num.":Q".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('R'.$num.":S".$num);
                $objPHPExcel->getActiveSheet()->mergeCells('T'.$num.":U".$num);
                $objPHPExcel->getActiveSheet()->getStyle('P'.$num.":T".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":U".$num)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('N'.$num.":T".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $num++;
            }
        }
        $objPHPExcel->getActiveSheet()->getStyle("S6")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle("S7")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle('S6:U6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('S7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->mergeCells('S6:U6');
        $objPHPExcel->getActiveSheet()->mergeCells('S7:U7');
        $objPHPExcel->getActiveSheet()->mergeCells('A8:B8');
        $objPHPExcel->getActiveSheet()->mergeCells('C8:E8');
        $objPHPExcel->getActiveSheet()->mergeCells('F8:G8');
        $objPHPExcel->getActiveSheet()->mergeCells('H8:I8');
        $objPHPExcel->getActiveSheet()->mergeCells('J8:K8');
        $objPHPExcel->getActiveSheet()->mergeCells('L8:M8');
        $objPHPExcel->getActiveSheet()->mergeCells('N8:O8');
        $objPHPExcel->getActiveSheet()->mergeCells('P8:Q8');
        $objPHPExcel->getActiveSheet()->mergeCells('R8:S8');
        $objPHPExcel->getActiveSheet()->mergeCells('T8:U8');
        $objPHPExcel->getActiveSheet()->getStyle('A8:U8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A8:U8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A8:U8")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->mergeCells('L2:P2');
        $objPHPExcel->getActiveSheet()->getStyle('L2:P2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('L2:P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:U4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:U2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:U4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:U2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:U4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Stockcard.xlsx"');
        readfile($exportfilename);
    }

    public function slash_replace($query){
        $search = ["/", " / "];
        $replace   = ["_"];
        return str_replace($search, $replace, $query);
    }

    public function slash_unreplace($query){
        $search = ["_"];
        $replace   = ["/", " / "];
        return str_replace($search, $replace, $query);
    }

    public function overallpr_report(){
        $pr = $this->uri->segment(3);
        $data['pr']=$pr;
        $data['pr_disp']=$this->slash_unreplace(rawurldecode($pr));
        $data['pr_list']=$this->super_model->custom_query("SELECT * FROM receive_details GROUP BY pr_no");
        $today = date("Y-m-d");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->custom_query("SELECT pr_no, quantity,item_id, remaining_qty,in_id,rd_id,supplier_id,brand FROM fifo_in WHERE pr_no = '$pr' GROUP BY item_id") AS $head){
            $purpose_id = $this->super_model->select_column_where("receive_details","purpose_id","rd_id",$head->rd_id);
            $data['purpose'] = $this->super_model->select_column_where("purpose", "purpose_desc", "purpose_id", $purpose_id);
            $sales_good_rem_qty = $this->super_model->select_sum_where("fifo_out","remaining_qty","in_id='$head->in_id' AND (transaction_type = 'Sales Goods' OR transaction_type='Sales Services')");
            $expired_qty = $this->super_model->select_sum_where("fifo_in","remaining_qty","in_id='$head->in_id' AND remaining_qty!='0' AND expiry_date <= '$today' AND expiry_date!=''");
            $return_qty= $this->super_model->select_sum_join("return_qty","return_details","sales_good_details","in_id='$head->in_id' AND sales_good_details.return_id!='0'","return_id");
            $return_qty_serv= $this->super_model->select_sum_join("return_qty","return_details","sales_serv_items","in_id='$head->in_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageret_qty= $this->super_model->select_sum_join("damage_qty","return_details","sales_good_details","in_id='$head->in_id' AND sales_good_details.return_id!='0'","return_id");
            $damageret_qty_serv= $this->super_model->select_sum_join("damage_qty","return_details","sales_serv_items","in_id='$head->in_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageqty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND transaction_type = 'Damage'");
            $repairqty= $this->super_model->select_sum_where("repair_details","quantity","in_id='$head->in_id' AND saved='1'");
            $count_sales_good = $this->super_model->count_custom_where("fifo_out","in_id = '$head->in_id' AND transaction_type = 'Sales Goods'");
            $count_sales_service = $this->super_model->count_custom_where("fifo_out","in_id = '$head->in_id' AND transaction_type = 'Sales Services'");
            $count_expired = $this->super_model->count_custom_where("fifo_in","in_id='$head->in_id' AND remaining_qty!='0' AND expiry_date <= '$today' AND expiry_date!=''");
            $count_return = $this->super_model->count_join_where("return_details","return_head","in_id='$head->in_id' AND (transaction_type = 'Goods' OR transaction_type='Services')","return_id");
            $count_damage = $this->super_model->count_custom_where("damage_details","in_id='$head->in_id'");
            $count_repair = $this->super_model->count_custom_where("repair_details","in_id='$head->in_id'");
            $sales_good_qty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND (transaction_type = 'Sales Goods' OR transaction_type='Sales Services')");
            $received_qty = $this->super_model->select_sum_where("fifo_in","quantity","item_id='$head->item_id' AND supplier_id='$head->supplier_id' AND brand='$head->brand'");
            $sales_ret = ($return_qty - $return_qty_serv) + ($damageret_qty - $damageret_qty_serv);
            $sales_all = $sales_good_qty - $return_qty - $return_qty_serv - $damageret_qty - $damageret_qty_serv;
            $in_balance = ($received_qty - $sales_good_qty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv;
            if($count_sales_good==0 && $count_sales_service==0 && $count_return==0 && $count_damage==0 && $count_expired==0){
                $final_balance = $received_qty;
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return==0 && $count_damage==0 && $count_expired==0){
                $final_balance = $received_qty - $sales_good_qty;
            }else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return==0 && $count_damage!=0 && $count_repair!=0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv + $repairqty; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0)  && $count_return!=0 && $count_damage==0 && $count_repair==0 && $count_expired==0){
                $final_balance =  $in_balance; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair!=0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv + $repairqty; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair==0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv; 
            }else if((($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair!=0 && $count_expired!=0) || (($count_sales_good==0 || $count_sales_service==0) && $count_return==0 && $count_damage==0 && $count_repair==0 && $count_expired!=0) || (($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage==0 && $count_repair==0 && $count_expired!=0) || (($count_sales_good==0 || $count_sales_service==0) && $count_return==0 && $count_damage!=0 && $count_repair==0 && $count_expired==0) || (($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair==0 && $count_expired!=0)){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty - $expired_qty) + $repairqty + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv;
            }

            $data['pr_no'][] = array(
                "recqty"=>$received_qty,
                "item"=>$this->super_model->select_column_where("items", "item_name", "item_id", $head->item_id),
                "sales_quantity"=>$sales_all,
                "expired_qty"=>$expired_qty,
                "returnqty"=>number_format($sales_ret,2),
                "damageqty"=>$damageqty,
                "repairqty"=>$repairqty,
                "in_balance"=>$in_balance,
                "final_balance"=>$final_balance
            );
        }
        $this->load->view('reports/overallpr_report',$data);
        $this->load->view('template/footer');
    }

    public function export_overallpr(){
        $pr = $this->uri->segment(3);
        $today = date("Y-m-d");
        $purpose_id = $this->super_model->select_column_where("receive_details","purpose_id","pr_no",$pr);
        $purpose = $this->super_model->select_column_where("purpose", "purpose_desc", "purpose_id", $purpose_id);

        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Overall PR Report.xlsx";

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
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', "PR:");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', "Purpose:");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A9', "No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B9', "Item Description");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F9', "Received Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H9', "Sales Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J9', "Initial Balance");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L9', "Return Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N9', "Damage Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P9', "Repaired Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R9', "Expired Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T9', "Final Balance");
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "PROGEN Dieseltech Services Corp.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Purok San Jose, Brgy. Calumangan, Bago City");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "Negros Occidental, Philippines 6101");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', "Tel. No. 476 - 7382");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', "OVERALL PR REPORT");
        $num=10;

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', $pr);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', $purpose);
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $x = 1;
        foreach($this->super_model->custom_query("SELECT pr_no, quantity,item_id, remaining_qty,in_id,rd_id,supplier_id,brand FROM fifo_in WHERE pr_no = '$pr' GROUP BY item_id") AS $head){
            $item = $this->super_model->select_column_where("items","item_name","item_id",$head->item_id);
            $sales_good_rem_qty = $this->super_model->select_sum_where("fifo_out","remaining_qty","in_id='$head->in_id' AND (transaction_type = 'Sales Goods' OR transaction_type='Sales Services')");
            $expired_qty = $this->super_model->select_sum_where("fifo_in","remaining_qty","in_id='$head->in_id' AND remaining_qty!='0' AND expiry_date <= '$today' AND expiry_date!=''");
            $return_qty= $this->super_model->select_sum_join("return_qty","return_details","sales_good_details","in_id='$head->in_id' AND sales_good_details.return_id!='0'","return_id");
            $return_qty_serv= $this->super_model->select_sum_join("return_qty","return_details","sales_serv_items","in_id='$head->in_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageret_qty= $this->super_model->select_sum_join("damage_qty","return_details","sales_good_details","in_id='$head->in_id' AND sales_good_details.return_id!='0'","return_id");
            $damageret_qty_serv= $this->super_model->select_sum_join("damage_qty","return_details","sales_serv_items","in_id='$head->in_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageqty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND transaction_type = 'Damage'");
            $repairqty= $this->super_model->select_sum_where("repair_details","quantity","in_id='$head->in_id' AND saved='1'");
            $count_sales_good = $this->super_model->count_custom_where("fifo_out","in_id = '$head->in_id' AND transaction_type = 'Sales Goods'");
            $count_sales_service = $this->super_model->count_custom_where("fifo_out","in_id = '$head->in_id' AND transaction_type = 'Sales Services'");
            $count_expired = $this->super_model->count_custom_where("fifo_in","in_id='$head->in_id' AND remaining_qty!='0' AND expiry_date <= '$today' AND expiry_date!=''");
            $count_return = $this->super_model->count_join_where("return_details","return_head","in_id='$head->in_id' AND (transaction_type = 'Goods' OR transaction_type='Services')","return_id");
            $count_damage = $this->super_model->count_custom_where("damage_details","in_id='$head->in_id'");
            $count_repair = $this->super_model->count_custom_where("repair_details","in_id='$head->in_id'");
            $sales_good_qty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND (transaction_type = 'Sales Goods' OR transaction_type='Sales Services')");
            $received_qty = $this->super_model->select_sum_where("fifo_in","quantity","item_id='$head->item_id' AND supplier_id='$head->supplier_id' AND brand='$head->brand'");
            $sales_ret = ($return_qty - $return_qty_serv) + ($damageret_qty - $damageret_qty_serv);
            $sales_all = $sales_good_qty - $return_qty - $return_qty_serv - $damageret_qty - $damageret_qty_serv;
            $in_balance = ($received_qty - $sales_good_qty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv;
            if($count_sales_good==0 && $count_sales_service==0 && $count_return==0 && $count_damage==0 && $count_expired==0){
                $final_balance = $received_qty;
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return==0 && $count_damage==0 && $count_expired==0){
                $final_balance = $received_qty - $sales_good_qty;
            }else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return==0 && $count_damage!=0 && $count_repair!=0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv + $repairqty; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0)  && $count_return!=0 && $count_damage==0 && $count_repair==0 && $count_expired==0){
                $final_balance =  $in_balance; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair!=0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv + $repairqty; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair==0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv; 
            }else if((($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair!=0 && $count_expired!=0) || (($count_sales_good==0 || $count_sales_service==0) && $count_return==0 && $count_damage==0 && $count_repair==0 && $count_expired!=0) || (($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage==0 && $count_repair==0 && $count_expired!=0) || (($count_sales_good==0 || $count_sales_service==0) && $count_return==0 && $count_damage!=0 && $count_repair==0 && $count_expired==0) || (($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair==0 && $count_expired!=0)){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty - $expired_qty) + $repairqty + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv;
            }


            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $x);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$num, $item);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $received_qty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $sales_all);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $in_balance);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$num, $sales_ret); 
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$num, $damageqty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$num, $repairqty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$num, $expired_qty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$num, $final_balance);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$num.":U".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->protectCells('A'.$num.":U".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('B9:E9');
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$num.":E".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('F9:G9');
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":G".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('H9:I9');
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$num.":I".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('J9:K9');
            $objPHPExcel->getActiveSheet()->mergeCells('J'.$num.":K".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('L9:M9');
            $objPHPExcel->getActiveSheet()->mergeCells('L'.$num.":M".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('N9:O9');
            $objPHPExcel->getActiveSheet()->mergeCells('N'.$num.":O".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('P9:Q9');
            $objPHPExcel->getActiveSheet()->mergeCells('P'.$num.":Q".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('R9:S9');
            $objPHPExcel->getActiveSheet()->mergeCells('R'.$num.":S".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('T9:U9');
            $objPHPExcel->getActiveSheet()->mergeCells('T'.$num.":U".$num);
            $objPHPExcel->getActiveSheet()->getStyle('F10:U10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$num.":U".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':U'.$num)->applyFromArray($styleArray);
            $num++;
            $x++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('B9:E9');
        $objPHPExcel->getActiveSheet()->mergeCells('F9:G9');
        $objPHPExcel->getActiveSheet()->mergeCells('H9:I9');
        $objPHPExcel->getActiveSheet()->mergeCells('J9:K9');
        $objPHPExcel->getActiveSheet()->mergeCells('L9:M9');
        $objPHPExcel->getActiveSheet()->mergeCells('N9:O9');
        $objPHPExcel->getActiveSheet()->mergeCells('P9:Q9');
        $objPHPExcel->getActiveSheet()->mergeCells('R9:S9');
        $objPHPExcel->getActiveSheet()->mergeCells('T9:U9');
        $objPHPExcel->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F9:U9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A9:U9')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A4:U4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:U2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:U4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:U2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:U4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A9:U9')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("M2")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle("A6")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle("A7")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle("C6")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle("C7")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle('M2:U2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Overall PR Report.xlsx"');
        readfile($exportfilename);
    }

    public function item_pr(){
        $item_id = $this->uri->segment(3);
        $data['item_id']=$item_id;
        $data['item_name']=$this->super_model->select_column_where("items","item_name","item_id",$item_id);
        $data['item']=$this->super_model->select_all_order_by("items","item_name","ASC");
        $today = date("Y-m-d");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $final_balance=0;
        foreach($this->super_model->custom_query("SELECT pr_no, quantity,item_id, remaining_qty,in_id,supplier_id,brand FROM fifo_in WHERE item_id = '$item_id' GROUP BY pr_no") AS $head){
            //$sales_serv_qty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND transaction_type='Sales Services'");

            //$sales_good_qty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND (transaction_type = 'Sales Goods' OR transaction_type='Sales Services')");
            $sales_good_rem_qty = $this->super_model->select_sum_where("fifo_out","remaining_qty","in_id='$head->in_id' AND (transaction_type = 'Sales Goods' OR transaction_type='Sales Services')");
            //$sales_service_qty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND transaction_type='Sales Services'");
            $expired_qty = $this->super_model->select_sum_where("fifo_in","remaining_qty","in_id='$head->in_id' AND remaining_qty!='0' AND expiry_date <= '$today' AND expiry_date!=''");
            $return_qty= $this->super_model->select_sum_join("return_qty","return_details","sales_good_details","in_id='$head->in_id' AND sales_good_details.return_id!='0'","return_id");
            $return_qty_serv= $this->super_model->select_sum_join("return_qty","return_details","sales_serv_items","in_id='$head->in_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageret_qty= $this->super_model->select_sum_join("damage_qty","return_details","sales_good_details","in_id='$head->in_id' AND sales_good_details.return_id!='0'","return_id");
            $damageret_qty_serv= $this->super_model->select_sum_join("damage_qty","return_details","sales_serv_items","in_id='$head->in_id' AND sales_serv_items.return_id!='0'","return_id");
            //$damageqty= $this->super_model->select_sum_where("damage_details","damage_qty","in_id='$head->in_id'");
            $damageqty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND transaction_type = 'Damage'");
            $repairqty= $this->super_model->select_sum_where("repair_details","quantity","in_id='$head->in_id' AND saved='1'");
            $count_sales_good = $this->super_model->count_custom_where("fifo_out","in_id = '$head->in_id' AND transaction_type = 'Sales Goods'");
            $count_sales_service = $this->super_model->count_custom_where("fifo_out","in_id = '$head->in_id' AND transaction_type = 'Sales Services'");
            $count_expired = $this->super_model->count_custom_where("fifo_in","in_id='$head->in_id' AND remaining_qty!='0' AND expiry_date <= '$today' AND expiry_date!=''");
            $count_return = $this->super_model->count_join_where("return_details","return_head","in_id='$head->in_id' AND (transaction_type = 'Goods' OR transaction_type='Services')","return_id");
            //$count_return_services = $this->super_model->count_join_where("return_details","in_id='$head->in_id' AND transaction_type = 'Services'");
            $count_damage = $this->super_model->count_custom_where("damage_details","in_id='$head->in_id'");
            $count_repair = $this->super_model->count_custom_where("repair_details","in_id='$head->in_id'");
            $sales_good_qty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND (transaction_type = 'Sales Goods' OR transaction_type='Sales Services')");
            $received_qty = $this->super_model->select_sum_where("fifo_in","quantity","item_id='$head->item_id' AND supplier_id='$head->supplier_id' AND brand='$head->brand'");
            $sales_ret = ($return_qty - $return_qty_serv) + ($damageret_qty - $damageret_qty_serv);
            $sales_all = $sales_good_qty - $return_qty - $return_qty_serv - $damageret_qty - $damageret_qty_serv;
            $in_balance = ($received_qty - $sales_good_qty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv;
            if($count_sales_good==0 && $count_sales_service==0 && $count_return==0 && $count_damage==0 && $count_expired==0){
                $final_balance = $received_qty;
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return==0 && $count_damage==0 && $count_expired==0){
                $final_balance = $received_qty - $sales_good_qty;
            }else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return==0 && $count_damage!=0 && $count_repair!=0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv + $repairqty; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0)  && $count_return!=0 && $count_damage==0 && $count_repair==0 && $count_expired==0){
                $final_balance =  $in_balance; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair!=0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv + $repairqty; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair==0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv; 
            }else if((($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair!=0 && $count_expired!=0) || (($count_sales_good==0 || $count_sales_service==0) && $count_return==0 && $count_damage==0 && $count_repair==0 && $count_expired!=0) || (($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage==0 && $count_repair==0 && $count_expired!=0) || (($count_sales_good==0 || $count_sales_service==0) && $count_return==0 && $count_damage!=0 && $count_repair==0 && $count_expired==0) || (($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair==0 && $count_expired!=0)){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty - $expired_qty) + $repairqty + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv;
            }
            $data['item_pr'][] = array(
                "prno"=>$head->pr_no,
                "recqty"=>$received_qty,
                "sales_quantity"=>$sales_all,
                "expired_qty"=>$expired_qty,
                "returnqty"=>number_format($sales_ret,2),
                "damageqty"=>$damageqty,
                "repairqty"=>$repairqty,
                "in_balance"=>$in_balance,
                "final_balance"=>$final_balance
            );
        }
        $this->load->view('reports/item_pr',$data);
        $this->load->view('template/footer');
    }

    public function export_itempr(){
        $item_id = $this->uri->segment(3);
        $today = date("Y-m-d");
        $item = $this->super_model->select_column_where("items", "item_name", "item_id", $item_id);

        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Item PR.xlsx";

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
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', "Item:");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A9', "No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B9', "PR No");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F9', "Received Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H9', "Sales Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J9', "Initial Balance");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L9', "Return Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N9', "Damage Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P9', "Repaired Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R9', "Expired Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T9', "Final Balance");
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "PROGEN Dieseltech Services Corp.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Purok San Jose, Brgy. Calumangan, Bago City");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "Negros Occidental, Philippines 6101");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', "Tel. No. 476 - 7382");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', "ITEM PR REPORT");
        $num=10;

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', $item);
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $x = 1;
        foreach($this->super_model->custom_query("SELECT pr_no, quantity,item_id, remaining_qty,in_id,supplier_id,brand FROM fifo_in WHERE item_id = '$item_id' GROUP BY pr_no") AS $head){
            $sales_good_rem_qty = $this->super_model->select_sum_where("fifo_out","remaining_qty","in_id='$head->in_id' AND (transaction_type = 'Sales Goods' OR transaction_type='Sales Services')");
            $expired_qty = $this->super_model->select_sum_where("fifo_in","remaining_qty","in_id='$head->in_id' AND remaining_qty!='0' AND expiry_date <= '$today' AND expiry_date!=''");
            $return_qty= $this->super_model->select_sum_join("return_qty","return_details","sales_good_details","in_id='$head->in_id' AND sales_good_details.return_id!='0'","return_id");
            $return_qty_serv= $this->super_model->select_sum_join("return_qty","return_details","sales_serv_items","in_id='$head->in_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageret_qty= $this->super_model->select_sum_join("damage_qty","return_details","sales_good_details","in_id='$head->in_id' AND sales_good_details.return_id!='0'","return_id");
            $damageret_qty_serv= $this->super_model->select_sum_join("damage_qty","return_details","sales_serv_items","in_id='$head->in_id' AND sales_serv_items.return_id!='0'","return_id");
            $damageqty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND transaction_type = 'Damage'");
            $repairqty= $this->super_model->select_sum_where("repair_details","quantity","in_id='$head->in_id' AND saved='1'");
            $count_sales_good = $this->super_model->count_custom_where("fifo_out","in_id = '$head->in_id' AND transaction_type = 'Sales Goods'");
            $count_sales_service = $this->super_model->count_custom_where("fifo_out","in_id = '$head->in_id' AND transaction_type = 'Sales Services'");
            $count_expired = $this->super_model->count_custom_where("fifo_in","in_id='$head->in_id' AND remaining_qty!='0' AND expiry_date <= '$today' AND expiry_date!=''");
            $count_return = $this->super_model->count_join_where("return_details","return_head","in_id='$head->in_id' AND (transaction_type = 'Goods' OR transaction_type='Services')","return_id");
            $count_damage = $this->super_model->count_custom_where("damage_details","in_id='$head->in_id'");
            $count_repair = $this->super_model->count_custom_where("repair_details","in_id='$head->in_id'");
            $sales_good_qty = $this->super_model->select_sum_where("fifo_out","quantity","in_id='$head->in_id' AND (transaction_type = 'Sales Goods' OR transaction_type='Sales Services')");
            $received_qty = $this->super_model->select_sum_where("fifo_in","quantity","item_id='$head->item_id' AND supplier_id='$head->supplier_id' AND brand='$head->brand'");
            $sales_ret = ($return_qty - $return_qty_serv) + ($damageret_qty - $damageret_qty_serv);
            $sales_all = $sales_good_qty - $return_qty - $return_qty_serv - $damageret_qty - $damageret_qty_serv;
            $in_balance = ($received_qty - $sales_good_qty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv;
            if($count_sales_good==0 && $count_sales_service==0 && $count_return==0 && $count_damage==0 && $count_expired==0){
                $final_balance = $received_qty;
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return==0 && $count_damage==0 && $count_expired==0){
                $final_balance = $received_qty - $sales_good_qty;
            }else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return==0 && $count_damage!=0 && $count_repair!=0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv + $repairqty; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0)  && $count_return!=0 && $count_damage==0 && $count_repair==0 && $count_expired==0){
                $final_balance =  $in_balance; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair!=0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv + $repairqty; 
            } else if(($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair==0 && $count_expired==0){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty) + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv; 
            }else if((($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair!=0 && $count_expired!=0) || (($count_sales_good==0 || $count_sales_service==0) && $count_return==0 && $count_damage==0 && $count_repair==0 && $count_expired!=0) || (($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage==0 && $count_repair==0 && $count_expired!=0) || (($count_sales_good==0 || $count_sales_service==0) && $count_return==0 && $count_damage!=0 && $count_repair==0 && $count_expired==0) || (($count_sales_good!=0 || $count_sales_service!=0) && $count_return!=0 && $count_damage!=0 && $count_repair==0 && $count_expired!=0)){
                $final_balance =  ($received_qty - $sales_good_qty - $damageqty - $expired_qty) + $repairqty + $return_qty + $return_qty_serv + $damageret_qty + $damageret_qty_serv;
            }


            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $x);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$num, $head->pr_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $received_qty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $sales_all);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $in_balance);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$num, $sales_ret); 
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$num, $damageqty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$num, $repairqty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$num, $expired_qty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$num, $final_balance);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$num.":U".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->protectCells('A'.$num.":U".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('B9:E9');
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$num.":E".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('F9:G9');
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":G".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('H9:I9');
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$num.":I".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('J9:K9');
            $objPHPExcel->getActiveSheet()->mergeCells('J'.$num.":K".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('L9:M9');
            $objPHPExcel->getActiveSheet()->mergeCells('L'.$num.":M".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('N9:O9');
            $objPHPExcel->getActiveSheet()->mergeCells('N'.$num.":O".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('P9:Q9');
            $objPHPExcel->getActiveSheet()->mergeCells('P'.$num.":Q".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('R9:S9');
            $objPHPExcel->getActiveSheet()->mergeCells('R'.$num.":S".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('T9:U9');
            $objPHPExcel->getActiveSheet()->mergeCells('T'.$num.":U".$num);
            $objPHPExcel->getActiveSheet()->getStyle('F10:U10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$num.":U".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':U'.$num)->applyFromArray($styleArray);
            $num++;
            $x++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('B9:E9');
        $objPHPExcel->getActiveSheet()->mergeCells('F9:G9');
        $objPHPExcel->getActiveSheet()->mergeCells('H9:I9');
        $objPHPExcel->getActiveSheet()->mergeCells('J9:K9');
        $objPHPExcel->getActiveSheet()->mergeCells('L9:M9');
        $objPHPExcel->getActiveSheet()->mergeCells('N9:O9');
        $objPHPExcel->getActiveSheet()->mergeCells('P9:Q9');
        $objPHPExcel->getActiveSheet()->mergeCells('R9:S9');
        $objPHPExcel->getActiveSheet()->mergeCells('T9:U9');
        $objPHPExcel->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F9:U9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A9:U9')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A4:U4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:U2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:U4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:U2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:U3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:U4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('U4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A9:U9')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("M2")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle("A6")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle("A7")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle("C6")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle("C7")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle('M2:U2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Item PR.xlsx"');
        readfile($exportfilename);
        
    }

    public function aging_report(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/aging_report');
        $this->load->view('template/footer');
    }

    public function inventory_balance($itemid){
        $now=date("Y-m-d");
        $recqty= $this->super_model->select_sum_join("received_qty","receive_items","receive_head", "item_id='$itemid' AND saved='1' AND (expiration_date='' OR expiration_date > '$now')","receive_id");
        $sales_good_qty= $this->super_model->select_sum_join("quantity","sales_good_details","sales_good_head", "item_id='$itemid' AND saved='1'","sales_good_head_id");
        $sales_services_qty= $this->super_model->select_sum_join("quantity","sales_serv_items","sales_services_head", "item_id='$itemid' AND saved='1'","sales_serv_head_id");
        $return_qty= $this->super_model->select_sum_where("return_details","return_qty","item_id='$itemid'");
        $damage_qty= $this->super_model->select_sum_join("damage_qty","damage_details","damage_head", "item_id='$itemid'","damage_id");
        $balance=($recqty+$return_qty)-$sales_good_qty-$sales_services_qty-$damage_qty;
        return $balance;
    }

    public function inventory_rangedate(){
        $data['category']=$this->super_model->select_all_order_by("item_categories","cat_name","ASC");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $from = $this->uri->segment(3);
        $to = $this->uri->segment(4);
        $cat = $this->uri->segment(5);
        $subcat = $this->uri->segment(6);
        $data['from']=$from;
        $data['to']=$to;
        $data['cat']=$cat;
        $data['subcat']=$subcat;
        $now=date("Y-m-d");
        $sql="";
        if($from!='null' && $to!='null'){
           $sql.= " rh.receive_date BETWEEN '$from' AND '$to' AND";
        }

        if($cat!='null'){
            $sql.= " i.category_id = '$cat' AND";
        }

        if($subcat!='null'){
            $sql.= " i.subcat_id = '$subcat' AND";
        }

        $query=substr($sql,0,-3);
        $data['head']=array();
        foreach($this->super_model->custom_query("SELECT DISTINCT rh.*,i.item_id  FROM receive_head rh INNER JOIN receive_items ri ON rh.receive_id = ri.receive_id INNER JOIN items i ON ri.item_id = i.item_id WHERE rh.saved='1' AND ".$query." GROUP BY item_name ORDER BY i.item_name ASC") AS $head){
            $item = $this->super_model->select_column_where('items', 'item_name', 'item_id', $head->item_id);
            $pn = $this->super_model->select_column_where('items', 'original_pn', 'item_id', $head->item_id);
            $totalqty=$this->inventory_balance($head->item_id);
            $data['head'][] = array(
                'item'=>$item,
                'pn'=>$pn,
                'total'=>$totalqty
            );          
        }
        $this->load->view('reports/inventory_rangedate',$data);
        $this->load->view('template/footer');
    }

    public function export_inventory_rangedate(){
        $from = $this->uri->segment(3);
        $to = $this->uri->segment(4);
        $cat = $this->uri->segment(5);
        $subcat = $this->uri->segment(6);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Inventory Range of Date.xlsx";
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
        $sql="";
        if($from!='null' && $to!='null'){
           $sql.= " rh.receive_date BETWEEN '$from' AND '$to' AND";
        }

        if($cat!='null'){
            $sql.= " i.category_id = '$cat' AND";
        }

        if($subcat!='null'){
            $sql.= " i.subcat_id = '$subcat' AND";
        }

        $query=substr($sql,0,-3);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Item PR.xlsx";

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
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', "Part Number");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D7', "Item Description");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J7', "Avail Qty");
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "PROGEN Dieseltech Services Corp.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Purok San Jose, Brgy. Calumangan, Bago City");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "Negros Occidental, Philippines 6101");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', "Tel. No. 476 - 7382");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', "INVENTORY RANGE OF DATE");
        $num=8;

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
         foreach($this->super_model->custom_query("SELECT DISTINCT rh.*,i.item_id  FROM receive_head rh INNER JOIN receive_items ri ON rh.receive_id = ri.receive_id INNER JOIN items i ON ri.item_id = i.item_id WHERE rh.saved='1' AND ".$query." GROUP BY item_name ORDER BY i.item_name ASC") AS $head){
            $item = $this->super_model->select_column_where('items', 'item_name', 'item_id', $head->item_id);
            $pn = $this->super_model->select_column_where('items', 'original_pn', 'item_id', $head->item_id);
            $totalqty=$this->inventory_balance($head->item_id);


            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $pn);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$num, $item);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $totalqty);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$num.":L".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->protectCells('A'.$num.":L".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":C".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('A7:C7');
            $objPHPExcel->getActiveSheet()->mergeCells('D'.$num.":I".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('D7:I7');
            $objPHPExcel->getActiveSheet()->mergeCells('J'.$num.":L".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('J7:L7');
            $objPHPExcel->getActiveSheet()->getStyle('A7:L7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$num.":L".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':L'.$num)->applyFromArray($styleArray);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('A7:C7');
        $objPHPExcel->getActiveSheet()->mergeCells('D7:I7');
        $objPHPExcel->getActiveSheet()->mergeCells('J7:L7');
        $objPHPExcel->getActiveSheet()->getStyle('A7:L7')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A4:L4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:L3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:L4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:L3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:L4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('L1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('L2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('L3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('L4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle("J2")->getFont()->setBold(true)->setName('Arial Black');
        $objPHPExcel->getActiveSheet()->getStyle('J2:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Inventory Range of Date.xlsx"');
        readfile($exportfilename);
        
    }

    public function get_subcat(){
        $cat = $this->input->post('category');
        echo '<option value="">-Select Sub Category-</option>';
        foreach($this->super_model->select_custom_where('item_subcat', "cat_id='$cat' ORDER BY subcat_name ASC") AS $row){
            echo '<option value="'. $row->subcat_id .'">'. $row->subcat_name .'</option>';
      
         }
    }

    public function adjustment_list(){
        $billing_id = $this->uri->segment(3);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['billing_id']=$billing_id;
        $data['billing_no'] = $this->super_model->select_column_where("billing_head","billing_no", "billing_id",$billing_id);
        $data['adjustment_counter'] = $this->super_model->select_column_where("billing_head","adjustment_counter", "billing_id",$billing_id);
        $data['adjustments'] = $this->super_model->select_custom_where("billing_adjustment_history", "billing_id = '$billing_id' AND status = '0'");
        $this->load->view('reports/adjustment_list', $data);
        $this->load->view('template/footer');
    }
    public function adjustment_print(){
        $bsid = $this->uri->segment(3);
        $data['status']=$this->super_model->select_column_where("billing_head","status","billing_id",$bsid);
        foreach($this->super_model->select_row_where("billing_head", "billing_id", $bsid) AS $bs){
            $data['head'][] = array(
                "billing_no"=>$bs->billing_no,
                "date"=>$bs->billing_date,
                "adjustment_counter"=>$bs->adjustment_counter,
                "client"=>$this->super_model->select_column_where("client", "buyer_name", "client_id", $bs->client_id),
                "address"=>$this->super_model->select_column_where("client", "address", "client_id", $bs->client_id),
                "tin"=>$this->super_model->select_column_where("client", "tin", "client_id", $bs->client_id),
            );
        }

        $data['details']=$this->super_model->select_custom_where("billing_details", "billing_id='$bsid' AND remaining_amount != '0' ORDER BY dr_date DESC");


        $this->load->view('template/print_head');
        $this->load->view('reports/adjustment_print',$data);
    }

     public function generateAdjustment(){
        $billing_id = $this->input->post('billing_id');
        $billing_no = $this->input->post('billing_no');

        $data=array(
            "status"=>"2",

        );
        $this->super_model->update_where("billing_head", $data, "billing_id", $billing_id);
        $sales_id = array();
        foreach($this->super_model->select_row_where("billing_details", "billing_id", $billing_id) AS $b){
            $sales_id[] = $b->sales_id;
        }   

        $client_id = $this->super_model->select_column_where("billing_head", "client_id", "billing_id",$billing_id);
        $get_max = $this->super_model->get_max_where("billing_head","adjustment_counter","billing_no = '$billing_no'");
        $counter = $get_max+1;

        $data = array(
            "billing_no"=>$billing_no,
            "billing_date"=>date("Y-m-d"),
            "client_id"=>$client_id,
            "create_date"=>date("Y-m-d H:i:s"),
            "user_id"=>$_SESSION['user_id'],
            "adjustment_counter"=>$counter
        );
        $id= $this->super_model->insert_return_id("billing_head", $data);

         $grand_total = 0;
            $grand_total_uc = 0;
            foreach($sales_id AS $sid){

                $dr_no =  $this->super_model->select_column_where("sales_good_head", "dr_no", "sales_good_head_id", $sid);
                if($this->super_model->count_custom_where("return_head","dr_no = '$dr_no'") != 0){
                    $return_id = $this->super_model->select_column_where("return_head", "return_id", "dr_no", $dr_no);
                    $returned_amount = $this->super_model->select_sum_where("return_details", "total_amount", "return_id='$return_id'");
                    $total_sales = $this->super_model->select_sum_where("sales_good_details", "total", "sales_good_head_id='$sid'");

                    $total_amount = $total_sales - $returned_amount;
                } else {
                     $total_amount = $this->super_model->select_sum_where("sales_good_details", "total", "sales_good_head_id='$sid'");
                }
                
                $grand_total +=$total_amount;

                $total_unit_cost=array();
                foreach($this->super_model->select_custom_where("fifo_out", "transaction_type='Sales Goods' AND sales_id = '$sid'") AS $uc){
                    $total_unit_cost[] = $uc->unit_cost * $uc->quantity;
                }

                $total_uc = array_sum($total_unit_cost);
                $grand_total_uc +=$total_uc;
               
                $data_details = array(
                    "billing_id"=>$id,
                    "sales_type"=>"goods",
                    "sales_id"=>$sid,
                    "dr_no"=>$this->super_model->select_column_where("sales_good_head", "dr_no", "sales_good_head_id", $sid),
                    "dr_date"=>$this->super_model->select_column_where("sales_good_head", "sales_date", "sales_good_head_id", $sid),
                    "total_unit_cost"=>$total_uc,
                    "total_amount"=>$total_amount,
                    "remaining_amount"=>$total_amount,
                );

                $this->super_model->insert_into("billing_details", $data_details);

                $data_adj = array(
                    "status"=>'1'
                );
                $this->super_model->update_where("billing_adjustment_history", $data_adj, "billing_id", $billing_id);
            }

            $data_total = array(
                "total_amount"=>$grand_total,
                "total_unit_cost"=>$grand_total_uc
            );
            $this->super_model->update_where("billing_head", $data_total, "billing_id", $id);

            echo $id;
    }
    public function adjust_all(){
        $billing_no = $this->uri->segment(3);
        $this->load->view('template/header'); 
        $rows=$this->super_model->count_custom_where("billing_head","billing_no='$billing_no' AND status='2'");
        if($rows!=0){
            foreach($this->super_model->select_custom_where("billing_head","billing_no='$billing_no' AND status='2'") AS $bi){
                $data['adjust'][]=array(
                    "billing_id"=>$bi->billing_id,
                    "billing_no"=>$bi->billing_no,
                    "adjustment_counter"=>$bi->adjustment_counter,
                );
            }
        }else{
            $data['adjust']=array();
        }
        $this->load->view('reports/adjust_all',$data);
        $this->load->view('template/footer');
    }
    public function paid_details(){
        $billing_id = $this->uri->segment(3);
        $data['billing_no']= $this->super_model->select_column_where("billing_head", "billing_no","billing_id",$billing_id);
     
         $gtotal=0;

         

        foreach($this->super_model->custom_query("SELECT * FROM billing_payment WHERE FIND_IN_SET($billing_id, billing_id)") AS $p){

           $billing_id = explode(",",$p->billing_id);
          
           $billing_no = "";
           $dr_no = "";
           foreach($billing_id AS $bid){

                $billing_no .= $this->super_model->select_column_where("billing_head", "billing_no", "billing_id", $bid) . ", ";
                $dr_no .= $this->super_model->select_column_where("billing_details", "dr_no", "billing_id", $bid) . ", ";
           }
           $bill_no = substr($billing_no,0,-2);
           $dr_no = substr($dr_no,0,-2);
           $gtotal += $p->amount;
            $data['payment'][] = array(
                'payment_date'=>$p->payment_date,
                'billing_no'=>$bill_no,
                'payment_type'=>$p->payment_type,
                'check_no'=>$p->check_no,
                'dr_no'=>$dr_no,
                'receipt_no'=>$p->receipt_no,
                'amount'=>$p->amount
            );
        }
        $data['grand_total'] = $gtotal;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/paid_details',$data);
        $this->load->view('template/footer');
    }

    public function expired_inventory(){
        $today = date("Y-m-d");
        $date = $this->uri->segment(3);
        $data['date']=$date;
        foreach($this->super_model->custom_query("SELECT * FROM receive_items WHERE (expiration_date <= '$today' OR  expiration_date <= '$date') AND (expiration_date = '$date' OR expiration_date !='') AND dispose!='1'  ORDER BY expiration_date ASC") AS $expired){
            /*foreach($this->super_model->custom_query("SELECT * FROM receive_items WHERE expiration_date BETWEEN '$date' AND '$today' AND expiration_date !='' ORDER BY expiration_date ASC") AS $expired){*/
            $receive_id = $this->super_model->select_column_where('receive_head', 'receive_id', 'receive_id', $expired->receive_id);
            $data['expired'][]= array(
                "ri_id"=>$expired->ri_id,
                "item"=>$this->super_model->select_column_where("items", "item_name", "item_id", $expired->item_id),
                "pr_no"=>$this->super_model->select_column_where("receive_details", "pr_no", "receive_id", $receive_id),
                "expiration_date"=>$expired->expiration_date,
                "brand"=>$expired->brand,
                "dispose"=>$expired->dispose,
                "received_qty"=>$expired->received_qty,
                "catalog_no"=>$expired->catalog_no,
            );
        }
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/expired_inventory', $data);
        $this->load->view('template/footer');
    }

    public function dispose_item(){
        $data = array(
            'dispose'=>1,
        );
        $ri_id = $this->uri->segment(3);
        if($this->super_model->update_where('receive_items', $data, 'ri_id', $ri_id)){
            echo "<script>alert('Successfully Dispose!'); 
                window.location ='".base_url()."reports/expired_inventory'; </script>";
        }
    }

    public function export_expired(){
        $today = date("Y-m-d");
        $date = $this->uri->segment(3);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Expired Inventory.xlsx";
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "EXPIRED INVENTORY");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', "Item Name");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E8', "Quantity");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F8', "Expiration Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H8', "PR No");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J8', "Brand");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L8', "Catalog No");
        $num=9;
        foreach($this->super_model->custom_query("SELECT * FROM receive_items WHERE (expiration_date <= '$today' OR  expiration_date <= '$date') AND (expiration_date = '$date' OR expiration_date !='') AND dispose!='1'  ORDER BY expiration_date ASC") AS $expired){
            $receive_id = $this->super_model->select_column_where('receive_head', 'receive_id', 'receive_id', $expired->receive_id);
            $item = $this->super_model->select_column_where("items", "item_name", "item_id", $expired->item_id);
            $pr_no = $this->super_model->select_column_where("receive_details", "pr_no", "receive_id", $receive_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $item);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $expired->received_qty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, date('Y-m-d', strtotime($expired->expiration_date)));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $pr_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $expired->brand);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$num, $expired->catalog_no);
            $objPHPExcel->getActiveSheet()->getStyle("E".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":M".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":M".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":D".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":G".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$num.":I".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('J'.$num.":K".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('L'.$num.":M".$num);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('A8:D8');
        $objPHPExcel->getActiveSheet()->mergeCells('F8:G8');
        $objPHPExcel->getActiveSheet()->mergeCells('H8:I8');
        $objPHPExcel->getActiveSheet()->mergeCells('J8:K8');
        $objPHPExcel->getActiveSheet()->mergeCells('L8:M8');
        $objPHPExcel->getActiveSheet()->getStyle('A8:M8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A8:M8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A8:M8")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->mergeCells('H2:M2');
        $objPHPExcel->getActiveSheet()->getStyle('H2:M2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2:M2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:M4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:M4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:M4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('M2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('M3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('M4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Expired Inventory.xlsx"');
        readfile($exportfilename);
    }

    public function sales_backorder(){
        $data['clients'] = $this->super_model->select_all("client");
        $client = $this->uri->segment(3);
        $data['client']=$client;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->select_custom_where("sales_good_head","client_id = '$client' AND saved='1'") AS $bo){
            $quantity = $this->super_model->select_column_where("sales_good_details", "quantity", "sales_good_head_id", $bo->sales_good_head_id);
            $expected_qty = $this->super_model->select_column_where("sales_good_details", "expected_qty", "sales_good_head_id", $bo->sales_good_head_id);
            $item_id = $this->super_model->select_column_where("sales_good_details", "item_id", "sales_good_head_id", $bo->sales_good_head_id);
             if($quantity<$expected_qty && $quantity!=$expected_qty){
                $data['sales_backorder'][]=array(
                        "client"=>$this->super_model->select_column_where("client","buyer_name","client_id",$bo->client_id),
                        "item"=>$this->super_model->select_column_where("items","item_name","item_id",$item_id),
                        "dr_no"=>$bo->dr_no,
                        "po_no"=>$bo->po_no,
                        "pr_no"=>$bo->pr_no,
                        "expected_qty"=>$expected_qty,
                        "quantity"=>$quantity,
                );
            }
        }

        foreach($this->super_model->select_custom_where("sales_services_head","client_id = '$client' AND saved='1'") AS $bos){
            $quantity = $this->super_model->select_column_where("sales_serv_items", "quantity", "sales_serv_head_id", $bos->sales_serv_head_id);
            $expected_qty = $this->super_model->select_column_where("sales_serv_items", "expected_qty", "sales_serv_head_id", $bos->sales_serv_head_id);
            $item_id = $this->super_model->select_column_where("sales_serv_items", "item_id", "sales_serv_head_id", $bos->sales_serv_head_id);
            if($quantity<$expected_qty && $quantity!=$expected_qty){
                $data['sales_backorder'][]=array(
                        "client"=>$this->super_model->select_column_where("client","buyer_name","client_id",$bos->client_id),
                        "item"=>$this->super_model->select_column_where("items","item_name","item_id",$item_id),
                        "dr_no"=>$bos->dr_no,
                        "po_no"=>$bos->joi_no,
                        "pr_no"=>$bos->jor_no,
                        "expected_qty"=>$expected_qty,
                        "quantity"=>$quantity,
                );
            }
        }
        $this->load->view('reports/sales_backorder', $data);
        $this->load->view('template/footer');
    }

        public function sales_backorder_dash(){
        $data['clients'] = $this->super_model->select_all("client");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->select_custom_where("sales_good_head","saved='1'") AS $bo){
            $quantity = $this->super_model->select_column_where("sales_good_details", "quantity", "sales_good_head_id", $bo->sales_good_head_id);
            $expected_qty = $this->super_model->select_column_where("sales_good_details", "expected_qty", "sales_good_head_id", $bo->sales_good_head_id);
            $item_id = $this->super_model->select_column_where("sales_good_details", "item_id", "sales_good_head_id", $bo->sales_good_head_id);
             if($quantity<$expected_qty && $quantity!=$expected_qty){
                $data['sales_backorder'][]=array(
                        "client"=>$this->super_model->select_column_where("client","buyer_name","client_id",$bo->client_id),
                        "item"=>$this->super_model->select_column_where("items","item_name","item_id",$item_id),
                        "dr_no"=>$bo->dr_no,
                        "po_no"=>$bo->po_no,
                        "pr_no"=>$bo->pr_no,
                        "expected_qty"=>$expected_qty,
                        "quantity"=>$quantity,
                );
            }
        }

        foreach($this->super_model->select_custom_where("sales_services_head","saved='1'") AS $bos){
            $quantity = $this->super_model->select_column_where("sales_serv_items", "quantity", "sales_serv_head_id", $bos->sales_serv_head_id);
            $expected_qty = $this->super_model->select_column_where("sales_serv_items", "expected_qty", "sales_serv_head_id", $bos->sales_serv_head_id);
            $item_id = $this->super_model->select_column_where("sales_serv_items", "item_id", "sales_serv_head_id", $bos->sales_serv_head_id);
            if($quantity<$expected_qty && $quantity!=$expected_qty){
                $data['sales_backorder'][]=array(
                        "client"=>$this->super_model->select_column_where("client","buyer_name","client_id",$bos->client_id),
                        "item"=>$this->super_model->select_column_where("items","item_name","item_id",$item_id),
                        "dr_no"=>$bos->dr_no,
                        "po_no"=>$bos->joi_no,
                        "pr_no"=>$bos->jor_no,
                        "expected_qty"=>$expected_qty,
                        "quantity"=>$quantity,
                );
            }
        }
        $this->load->view('reports/sales_backorder', $data);
        $this->load->view('template/footer');
    }

    public function near_expiry(){
        $today = date("Y-m-d");
        $start_date = strtotime($today);
        $end_date = strtotime("+3 months", $start_date);
        $week = date('Y-m-d', $end_date);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $count_row = $this->super_model->count_custom_query("SELECT * FROM receive_items WHERE expiration_date <= '$week' AND expiration_date >= '$today' AND expiration_date !='' ORDER BY expiration_date ASC");
        if($count_row != 0){
            foreach($this->super_model->custom_query("SELECT * FROM receive_items WHERE expiration_date <= '$week' AND expiration_date >= '$today' AND expiration_date !='' ORDER BY expiration_date ASC") AS $expired){
            $receive_id = $this->super_model->select_column_where('receive_head', 'receive_id', 'receive_id', $expired->receive_id);
            $future = strtotime($expired->expiration_date);
            $now = time();
            $timeleft = $future-$now;
            $daysleft = round((($timeleft/24)/60)/60);
            $data['expired'][]= array(
                "ri_id"=>$expired->ri_id,
                "item"=>$this->super_model->select_column_where("items", "item_name", "item_id", $expired->item_id),
                "pr_no"=>$this->super_model->select_column_where("receive_details", "pr_no", "receive_id", $receive_id),
                "expiration_date"=>$expired->expiration_date,
                "brand"=>$expired->brand,
                "dispose"=>$expired->dispose,
                "received_qty"=>$expired->received_qty,
                "catalog_no"=>$expired->catalog_no,
                "daysleft"=>$daysleft,
            );
        }
            } else {
                $data['expired']=array();
            }
        $this->load->view('reports/near_expiry', $data);
        $this->load->view('template/footer');
    }

        public function export_near_expiry(){
        $today = date("Y-m-d");
        $start_date = strtotime($today);
        $end_date = strtotime("+3 months", $start_date);
        $week = date('Y-m-d', $end_date);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Near Expiry Products.xlsx";
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "NEAR EXPIRY PRODUCTS");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', "Item Name");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E8', "Quantity");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F8', "Expiration Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H8', "PR No");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J8', "Brand");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L8', "Catalog No");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N8', "Day/s Left");
        $num=9;
        foreach($this->super_model->custom_query("SELECT * FROM receive_items WHERE expiration_date <= '$week' AND expiration_date >= '$today' AND expiration_date !='' ORDER BY expiration_date ASC") AS $expired){
            $receive_id = $this->super_model->select_column_where('receive_head', 'receive_id', 'receive_id', $expired->receive_id);
            $item = $this->super_model->select_column_where("items", "item_name", "item_id", $expired->item_id);
            $pr_no = $this->super_model->select_column_where("receive_details", "pr_no", "receive_id", $receive_id);
            $future = strtotime($expired->expiration_date);
            $now = time();
            $timeleft = $future-$now;
            $daysleft = round((($timeleft/24)/60)/60);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $item);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $expired->received_qty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, date('Y-m-d', strtotime($expired->expiration_date)));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $pr_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $expired->brand);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$num, $expired->catalog_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$num, $daysleft. " day/s");
            $objPHPExcel->getActiveSheet()->getStyle("E".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":O".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":O".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":D".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":G".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$num.":I".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('J'.$num.":K".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('L'.$num.":M".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('N'.$num.":O".$num);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('A8:D8');
        $objPHPExcel->getActiveSheet()->mergeCells('F8:G8');
        $objPHPExcel->getActiveSheet()->mergeCells('H8:I8');
        $objPHPExcel->getActiveSheet()->mergeCells('J8:K8');
        $objPHPExcel->getActiveSheet()->mergeCells('L8:M8');
        $objPHPExcel->getActiveSheet()->mergeCells('N8:O8');
        $objPHPExcel->getActiveSheet()->getStyle('A8:O8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A8:O8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A8:O8")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->mergeCells('H2:O2');
        $objPHPExcel->getActiveSheet()->getStyle('H2:O2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2:O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:O4')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:O2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:O3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:O4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A2:O2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A3:O3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A4:O4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('O1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('O2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('O3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('O4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Near Expiry Products.xlsx"');
        readfile($exportfilename);
    }

}

