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

    public function summary_scgp(){
        $data['clients'] = $this->super_model->select_all("client");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $from = $this->uri->segment(3);
        $to = $this->uri->segment(4);
        $client = $this->uri->segment(5);
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
                $total_sales =  $this->super_model->select_sum_where("sales_serv_equipment", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'") + 
                $this->super_model->select_sum_where("sales_serv_items", "total", "sales_serv_head_id='$services->sales_serv_head_id'") +  $this->super_model->select_sum_where("sales_serv_manpower", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'") + $this->super_model->select_sum_where("sales_serv_material", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'");

                  $returned_amount =  $this->super_model->select_sum_join("total_amount","return_head","return_details", "return_id='$return_id' AND transaction_type='Services'","return_id");

                   $total_amount = $total_sales - $returned_amount;

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
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "DR Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "DR No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', "Total Amount");
        if($type=='1'){
            $grand_total =0;
            $num=4;
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
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "Overall Total Amount");
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', $grand_total);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $goods->sales_date);
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
            $num=4;
            foreach($this->super_model->select_custom_where("sales_services_head", "client_id='$client' AND billed='0'") AS $services){
                $total_sales =  $this->super_model->select_sum_where("sales_serv_equipment", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'") + $this->super_model->select_sum_where("sales_serv_items", "total", "sales_serv_head_id='$services->sales_serv_head_id'") +  $this->super_model->select_sum_where("sales_serv_manpower", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'") + $this->super_model->select_sum_where("sales_serv_material", "total_cost", "sales_serv_head_id='$services->sales_serv_head_id'");
                $returned_amount =  $this->super_model->select_sum_join("total_amount","return_head","return_details", "return_id='$return_id' AND transaction_type='Services'","return_id");
                $total_amount = $total_sales - $returned_amount;
                $grand_total += $total_amount;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "Overall Total Amount");
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', $grand_total);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $re->sales_date);
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
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $objPHPExcel->getActiveSheet()->mergeCells('A3:B3');
        $objPHPExcel->getActiveSheet()->mergeCells('C3:E3');
        $objPHPExcel->getActiveSheet()->mergeCells('F3:G3');
        $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A3:G3")->applyFromArray($styleArray);
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
                "billing_no"=>$bill->billing_no,
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
        $this->load->view('reports/paid_list',$data);
        $this->load->view('template/footer');
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
            $brand = $this->super_model->select_column_where("receive_items","brand","receive_id",$receive_id);
            $catalog_no = $this->super_model->select_column_where("receive_items","catalog_no","receive_id",$receive_id);
            $supplier_id = $this->super_model->select_column_where("receive_items","supplier_id","receive_id",$receive_id);
            $supplier = $this->super_model->select_column_where("supplier", "supplier_name", "supplier_id", $supplier_id);
            $pr_no = $this->super_model->select_column_where("receive_details","pr_no","receive_id",$receive_id);
            $po_no = $this->super_model->select_column_where("receive_head","po_no","receive_id",$receive_id);
            $total_cost = $rep->quantity*$rep->repair_price;
            $data['stockcard'][]=array(
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
        $data['pr']=$this->slash_unreplace(rawurldecode($pr));
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
        $purpose_id = $this->super_model->select_column_where("receive_details","purpose_id","pr_no",$pr_no);
        $purpose = $this->super_model->select_column_where("purpose", "purpose_desc", "purpose_id", $purpose_id);
        $sql="";
        if($pr!='null'){
           $sql.= " WHERE pr_no = '$pr' AND";
        }

        if($pr!=''){
            $query=substr($sql,0,-3);
        }else{
            $query='';
        }
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Overall PR Report.xlsx";

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "PROGEN");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "Overall PR Report");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "$pr");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', "$purpose");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', "#");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F5', "Item Description");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G5', "Received Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H5', "Sales Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K5', "Initial Balance");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M5', "Return Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P5', "Damage Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R5', "Repaired Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S5', "Expired Qty");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U5', "Final Balance");

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "PROGEN Dieseltech Services Corp.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Purok San Jose, Brgy. Calumangan, Bago City");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "Negros Occidental, Philippines 6101");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', "Tel. No. 476 - 7382");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', "FROM");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G5', "TO");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', "MATERIAL INVENTORY REPORT (Monthly) FOR ACCOUNTING");
        $num=6;

        $x = 1;
        $styleArray = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );
        foreach($this->super_model->custom_query("SELECT pr_no, quantity,item_id, remaining_qty,in_id,rd_id,supplier_id,brand FROM fifo_in ".$query." GROUP BY item_id") AS $head){
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

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $x);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $item);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $received_qty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $sales_all);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$num, $expired_qty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$num, $sales_ret);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$num, $damageqty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$num, $repairqty);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$num, $in_balance);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$num, $final_balance);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":Y".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$num.":J".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('K'.$num.":L".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
           
            $objPHPExcel->getActiveSheet()->mergeCells('A5:B5');
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('C5:E5');
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":E".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('H5:J5');
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$num.":J".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('K5:L5');
            $objPHPExcel->getActiveSheet()->mergeCells('K'.$num.":L".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('M5:O5');
            $objPHPExcel->getActiveSheet()->mergeCells('M'.$num.":O".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('P5:Q5');
            $objPHPExcel->getActiveSheet()->mergeCells('P'.$num.":Q".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('S5:T5');
            $objPHPExcel->getActiveSheet()->mergeCells('S'.$num.":T".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('U5:V5');
            $objPHPExcel->getActiveSheet()->mergeCells('U'.$num.":V".$num);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":V".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $num++;
            $x++;
            } 

        $objPHPExcel->getActiveSheet()->mergeCells('J10:K10');
        $objPHPExcel->getActiveSheet()->mergeCells('B10:C10');
        $objPHPExcel->getActiveSheet()->mergeCells('D10:G10');
        $objPHPExcel->getActiveSheet()->mergeCells('L10:N10');
        $objPHPExcel->getActiveSheet()->mergeCells('O10:Q10');
        $objPHPExcel->getActiveSheet()->mergeCells('R10:T10');
        $objPHPExcel->getActiveSheet()->getStyle('A10:G10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H10:T10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A10:W10')->applyFromArray($styleArray);
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
        $objPHPExcel->getActiveSheet()->getStyle('D5:E5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H5:I5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('H8:J8')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('C8:E8')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A10:W10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("M2")->getFont()->setBold(true)->setName('Arial Black');
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

    public function aging_report(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('reports/aging_report');
        $this->load->view('template/footer');
    }

    public function inventory_balance($itemid){
        $recqty= $this->super_model->select_sum_join("received_qty","receive_items","receive_head", "item_id='$itemid' AND saved='1'","receive_id");
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

}