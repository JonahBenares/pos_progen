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

    public function export_receive(){
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Receive.xlsx";
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', "RECEIVE REPORT");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', "Receive Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', "Mrecf No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E6', "DR No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G6', "PO No.");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I6', "SI No.");
        $num=7;
        foreach($this->super_model->select_custom_where("receive_head","saved='1' ORDER BY receive_date ASC") AS $re){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $re->receive_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $re->mrecf_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $re->dr_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $re->po_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$num, $re->si_no);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":J".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":B".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$num.":D".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('E'.$num.":F".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('G'.$num.":H".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('I'.$num.":J".$num);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('H2:J2');
        $objPHPExcel->getActiveSheet()->getStyle('H2:J2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->mergeCells('A6:B6');
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->mergeCells('E6:F6');
        $objPHPExcel->getActiveSheet()->mergeCells('G6:H6');
        $objPHPExcel->getActiveSheet()->mergeCells('I6:J6');
        $objPHPExcel->getActiveSheet()->getStyle('A6:J6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A6:J6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A6:J6")->applyFromArray($styleArray);
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
        header('Content-Disposition: attachment; filename="Receive.xlsx"');
        readfile($exportfilename);
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
            "receive_date"=>$this->input->post('receive_date')." ".date("H:i:s"),
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
        $data['receive_id']=$receive_id;
        // $data["head"] = $this->super_model->select_row_where("receive_head", "receive_id",$receive_id);
        // $data['employee']=$this->super_model->select_all_order_by("employees","employee_name","ASC");
        foreach($this->super_model->select_custom_where("receive_head","receive_id = '$receive_id'") AS $rec){
            $data['employee']=$this->super_model->select_all_order_by("employees","employee_name","ASC");
            $data['received_by']=$rec->received_by;
            $data['received']=$this->super_model->select_column_where("employees","employee_name","employee_id",$rec->received_by);
            $data['received_position']=$this->super_model->select_column_where("employees","position","employee_id",$rec->received_by);
            $data['delivered_by']=$rec->delivered_by;
            $data['delivered']=$this->super_model->select_column_where("employees","employee_name","employee_id",$rec->delivered_by);
            $data['delivered_position']=$this->super_model->select_column_where("employees","position","employee_id",$rec->delivered_by);
            $data['acknowledged_by']=$rec->acknowledged_by;
            $data['acknowledged']=$this->super_model->select_column_where("employees","employee_name","employee_id",$rec->acknowledged_by);
            $data['acknowledged_position']=$this->super_model->select_column_where("employees","position","employee_id",$rec->acknowledged_by);
            $data['noted_by']=$rec->noted_by;
            $data['noted']=$this->super_model->select_column_where("employees","employee_name","employee_id",$rec->noted_by);
            $data['noted_position']=$this->super_model->select_column_where("employees","position","employee_id",$rec->noted_by);
            $data['head'][]=array(
                'pcf'=>$rec->pcf,
                'receive_date'=>$rec->receive_date,
                'mrecf_no'=>$rec->mrecf_no,
                'dr_no'=>$rec->dr_no,
                'po_no'=>$rec->po_no,
                'si_no'=>$rec->si_no,
                'overall_remarks'=>$rec->overall_remarks,
            );
        }


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
        $this->load->view('template/print_head');
        $this->load->view('receive/print_receive',$data);
    }

    public function receive_print(){
        $id=$this->input->post('receive_id');
        $data = array(
            "delivered_by"=>$this->input->post('delivered_by'),
            "received_by"=>$this->input->post('received_by'),
            "acknowledged_by"=>$this->input->post('acknowledged_by'),
            "noted_by"=>$this->input->post('noted_by')
        );

        $this->super_model->update_where("receive_head", $data, "receive_id", $id);
        echo "success";
    }

    public function delivered_change(){
        $delivered_by=$this->input->post('delivered_by');
        foreach($this->super_model->select_row_where("employees","employee_id",$delivered_by) AS $emp){
            $return = array('position'=>$emp->position);
        }
        echo json_encode($return);
    }

    public function received_change(){
        $received_by=$this->input->post('received_by');
        foreach($this->super_model->select_row_where("employees","employee_id",$received_by) AS $emp){
            $return = array('position'=>$emp->position);
        }
        echo json_encode($return);
    }

    public function acknowledged_change(){
        $acknowledged_by=$this->input->post('acknowledged_by');
        foreach($this->super_model->select_row_where("employees","employee_id",$acknowledged_by) AS $emp){
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

}