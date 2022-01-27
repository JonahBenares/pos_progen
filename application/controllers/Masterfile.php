<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterfile extends CI_Controller {

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

    public function index()
    {
        $this->load->view('masterfile/login');
    }

    public function dashboard()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/dashboard');
        $this->load->view('template/footer');
    }


    public function buyer_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['buyer']=$this->super_model->select_all_order_by("buyer","buyer_name","ASC");
        $this->load->view('masterfile/buyer_list',$data);
        $this->load->view('template/footer');
    }

    public function add_buyer(){
        $buyer_name = $this->input->post('buyer_name');
        $address = $this->input->post('address');
        $contact_person = $this->input->post('contact_person');
        $contact_no = $this->input->post('contact_no');
        $data = array(
            'buyer_name'=>$buyer_name,
            'address'=>$address,
            'contact_person'=>$contact_person,
            'contact_no'=>$contact_no
        );
        if($this->super_model->insert_into("buyer", $data)){
            echo "<script>alert('Buyer Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/buyer_list'; </script>";
        }
    }

    public function update_buyer(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_buyer'] = $this->super_model->select_row_where('buyer', 'buyer_id', $id);
        $this->load->view('masterfile/update_buyer',$data);
        $this->load->view('template/footer');
    }

    public function edit_buyer(){
        $data = array(
            'buyer_name'=>$this->input->post('buyer_name'),
            'address'=>$this->input->post('address'),
            'contact_person'=>$this->input->post('contact_person'),
            'contact_no'=>$this->input->post('contact_no'),
        );
        $buyer_id = $this->input->post('buyer_id');
        if($this->super_model->update_where('buyer', $data, 'buyer_id', $buyer_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_buyer(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('buyer', 'buyer_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/buyer_list'; </script>";
        }
    }

    public function search_buyer(){
        if(!empty($this->input->post('buyer_name'))){
            $data['buyer_name'] = $this->input->post('buyer_name');
        } else {
            $data['buyer_name']= "null";
        }

        if(!empty($this->input->post('address'))){
            $data['address'] = $this->input->post('address');
        } else {
            $data['address']= "null";
        }

        if(!empty($this->input->post('contact_person'))){
            $data['contact_person'] = $this->input->post('contact_person');
        } else {
            $data['contact_person']= "null";
        }

        if(!empty($this->input->post('contact_no'))){
            $data['contact_no'] = $this->input->post('contact_no');
        } else {
            $data['contact_no']= "null";
        }

        $sql="";
        $filter = " ";

        if(!empty($this->input->post('buyer_name'))){
            $buyer_name = $this->input->post('buyer_name');
            $sql.=" buyer_name LIKE '%$buyer_name%' AND";
            $filter .= "Buyer - ".$buyer_name.", ";
        }

        if(!empty($this->input->post('address'))){
            $address = $this->input->post('address');
            $sql.=" address LIKE '%$address%' AND";
            $filter .= "Address - ".$address.", ";
        }

        if(!empty($this->input->post('contact_person'))){
            $contact_person = $this->input->post('contact_person');
            $sql.=" contact_person LIKE '%$contact_person%' AND";
            $filter .= "Contact Person - ".$contact_person.", ";
        }

        if(!empty($this->input->post('contact_no'))){
            $contact_no = $this->input->post('contact_no');
            $sql.=" contact_no LIKE '%$contact_no%' AND";
            $filter .= "Contact No - ".$contact_no.", ";
        }

        $query=substr($sql, 0, -3);
        $data['filt']=substr($filter, 0, -2);

        $data['buyer']=$this->super_model->custom_query("SELECT * FROM buyer WHERE ".$query); 
        $this->load->view('template/header'); 
        $this->load->view('template/navbar');      
        $this->load->view('masterfile/buyer_list',$data);
        $this->load->view('template/footer');
    }

        public function export_buyer_list(){
        $buyer_name=$this->uri->segment(3);
        $address=$this->uri->segment(4);
        $contact_person=$this->uri->segment(5);
        $contact_no=$this->uri->segment(6);

        $sql="";
        $filter = " ";

        if($buyer_name!='null'){
            $sql.=" buyer_name LIKE '%$buyer_name%' AND";
            $filter .= $buyer_name;
        }

        if($address!='null'){
            $sql.=" address LIKE '%$address%' AND";
            $filter .= $address;
        }

        if($contact_person!='null'){
            $sql.=" contact_person LIKE '%$contact_person%' AND";
            $filter .= $contact_person;
        }

        if($contact_no!='null'){
            $sql.=" contact_no LIKE '%$contact_no%' AND";
            $filter .= $contact_no;
        }

        $query=substr($sql, 0, -3);
        $filt=substr($filter, 0, -2);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Buyer Lists.xlsx";

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Buyer");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "Address");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "Contact Person");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', "Contact No");
        $num=2;

        $x = 1;
        $styleArray = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );
        if($filt!=''){
        foreach($this->super_model->custom_query("SELECT * FROM buyer WHERE ".$query) AS $buy){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $buy->buyer_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $buy->address);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$num, $buy->contact_person);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$num, $buy->contact_no);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":N".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":E".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('F1:J1');
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":J".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('K1:L1');
            $objPHPExcel->getActiveSheet()->mergeCells('K'.$num.":L".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('M1:N1');
            $objPHPExcel->getActiveSheet()->mergeCells('M'.$num.":N".$num);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":N".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $num++;
            }

        }else{
        foreach($this->super_model->select_all_order_by("buyer", "buyer_name", "ASC") AS $buy){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $buy->buyer_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $buy->address);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$num, $buy->contact_person);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$num, $buy->contact_no);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":N".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":E".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('F1:J1');
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$num.":J".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('K1:L1');
            $objPHPExcel->getActiveSheet()->mergeCells('K'.$num.":L".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('M1:N1');
            $objPHPExcel->getActiveSheet()->mergeCells('M'.$num.":N".$num);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":N".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $num++;
            }
        } 

        $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
        $objPHPExcel->getActiveSheet()->mergeCells('F1:J1');
        $objPHPExcel->getActiveSheet()->mergeCells('K1:L1');
        $objPHPExcel->getActiveSheet()->mergeCells('M1:N1');
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Buyer Lists.xlsx"');
        readfile($exportfilename);
    }

    public function department_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['department']=$this->super_model->select_all_order_by("department","department_name","ASC");
        $this->load->view('masterfile/department_list',$data);
        $this->load->view('template/footer');
    }

    public function add_department(){
        $department_name = trim($this->input->post('department_name')," ");
        $data = array(
            'department_name'=>$department_name,
        );
        if($this->super_model->insert_into("department", $data)){
            echo "<script>alert('Department Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/department_list'; </script>";
        }
    }

    public function update_department(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_department'] = $this->super_model->select_row_where('department', 'department_id', $id);
        $this->load->view('masterfile/update_department',$data);
        $this->load->view('template/footer');
    }

    public function edit_department(){
        $data = array(
            'department_name'=>$this->input->post('department_name'),
        );
        $department_id = $this->input->post('department_id');
        if($this->super_model->update_where('department', $data, 'department_id', $department_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_department(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('department', 'department_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/department_list'; </script>";
        }
    }

    public function search_department(){
        if(!empty($this->input->post('department_name'))){
            $data['department_name'] = $this->input->post('department_name');
        } else {
            $data['department_name']= "null";
        }

        $sql="";
        $filter = " ";

        if(!empty($this->input->post('department_name'))){
            $department_name = $this->input->post('department_name');
            $sql.=" department_name LIKE '%$department_name%' AND";
            $filter .= "Department - ".$department_name.", ";
        }

        $query=substr($sql, 0, -3);
        $data['filt']=substr($filter, 0, -2);

        $data['department']=$this->super_model->custom_query("SELECT * FROM department WHERE ".$query); 
        $this->load->view('template/header'); 
        $this->load->view('template/navbar');      
        $this->load->view('masterfile/department_list',$data);
        $this->load->view('template/footer');
    }

        public function export_department_list(){
        $department_name=$this->uri->segment(3);

        $sql="";
        $filter = " ";

        if($department_name!='null'){
            $sql.=" department_name LIKE '%$department_name%' AND";
            $filter .= $department_name;
        }

        $query=substr($sql, 0, -3);
        $filt=substr($filter, 0, -2);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Department Lists.xlsx";

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Department Name");
        $num=2;

        $x = 1;
        $styleArray = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );
        if($filt!=''){
        foreach($this->super_model->custom_query("SELECT * FROM department WHERE ".$query) AS $dept){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $dept->department_name);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":C".$num);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $num++;
            } 

        }else{
        foreach($this->super_model->select_all_order_by("department", "department_name", "ASC") AS $dept){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $dept->department_name);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":C".$num);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $num++;
            }
        }

        $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Department Lists.xlsx"');
        readfile($exportfilename);
    }

    public function employee_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['employees']=$this->super_model->select_all_order_by("employees","employee_name","ASC");
        $this->load->view('masterfile/employee_list',$data);
        $this->load->view('template/footer');
    }

    public function add_employee(){
        $employee_name = $this->input->post('employee_name');
        $department = $this->input->post('department');
        $position = $this->input->post('position');
        $contact_no = $this->input->post('contact_no');
        $email = $this->input->post('email');
        $data = array(
            'employee_name'=>$employee_name,
            'department'=>$department,
            'position'=>$position,
            'contact_no'=>$contact_no,
            'email'=>$email,
        );
        if($this->super_model->insert_into("employees", $data)){
            echo "<script>alert('Employee Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/employee_list'; </script>";
        }
    }

    public function update_employee(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_employee'] = $this->super_model->select_row_where('employees', 'employee_id', $id);
        $this->load->view('masterfile/update_employee',$data);
        $this->load->view('template/footer');
    }

    public function edit_employee(){
        $data = array(
            'employee_name'=>$this->input->post('employee_name'),
            'department'=>$this->input->post('department'),
            'position'=>$this->input->post('position'),
            'contact_no'=>$this->input->post('contact_no'),
            'email'=>$this->input->post('email'),
        );
        $employee_id = $this->input->post('employee_id');
        if($this->super_model->update_where('employees', $data, 'employee_id', $employee_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_employee(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('employees', 'employee_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/employee_list'; </script>";
        }
    }

    public function search_employee(){
        if(!empty($this->input->post('employee_name'))){
            $data['employee_name'] = $this->input->post('employee_name');
        } else {
            $data['employee_name']= "null";
        }

        if(!empty($this->input->post('position'))){
            $data['position'] = $this->input->post('position');
        } else {
            $data['position']= "null";
        }

        if(!empty($this->input->post('department'))){
            $data['department'] = $this->input->post('department');
        } else {
            $data['department']= "null";
        }

        if(!empty($this->input->post('contact_no'))){
            $data['contact_no'] = $this->input->post('contact_no');
        } else {
            $data['contact_no']= "null";
        }

        if(!empty($this->input->post('email'))){
            $data['email'] = $this->input->post('email');
        } else {
            $data['email']= "null";
        }

        $sql="";
        $filter = " ";

        if(!empty($this->input->post('employee_name'))){
            $employee_name = $this->input->post('employee_name');
            $sql.=" employee_name LIKE '%$employee_name%' AND";
            $filter .= "Employee - ".$employee_name.", ";
        }

        if(!empty($this->input->post('position'))){
            $position = $this->input->post('position');
            $sql.=" position LIKE '%$position%' AND";
            $filter .= "Position - ".$position.", ";
        }

        if(!empty($this->input->post('department'))){
            $department = $this->input->post('department');
            $sql.=" department LIKE '%$department%' AND";
            $filter .= "Department - ".$department.", ";
        }

        if(!empty($this->input->post('contact_no'))){
            $contact_no = $this->input->post('contact_no');
            $sql.=" contact_no LIKE '%$contact_no%' AND";
            $filter .= "Contact No - ".$contact_no.", ";
        }

        if(!empty($this->input->post('email'))){
            $email = $this->input->post('email');
            $sql.=" email LIKE '%$email%' AND";
            $filter .= "Email Address - ".$email.", ";
        }

        $query=substr($sql, 0, -3);
        $data['filt']=substr($filter, 0, -2);

        $data['employees']=$this->super_model->custom_query("SELECT * FROM employees WHERE ".$query); 
        $this->load->view('template/header'); 
        $this->load->view('template/navbar');      
        $this->load->view('masterfile/employee_list',$data);
        $this->load->view('template/footer');
    }

    public function export_employee_list(){
        $employee_name=urldecode($this->uri->segment(3));
        $position=$this->uri->segment(4);
        $department=$this->uri->segment(5);
        $contact_no=$this->uri->segment(6);
        $email=$this->uri->segment(7);

        $sql="";
        $filter = " ";

        if($employee_name!='null'){
            $sql.=" employee_name LIKE '%$employee_name%' AND";
            $filter .= $employee_name;
        }

        if($position!='null'){
            $sql.=" position LIKE '%$position%' AND";
            $filter .= $position;
        }

        if($department!='null'){
            $sql.=" department LIKE '%$department%' AND";
            $filter .= $department;
        }

        if($contact_no!='null'){
            $sql.=" contact_no LIKE '%$contact_no%' AND";
            $filter .= $contact_no;
        }

        if($email!='null'){
            $sql.=" email LIKE '%$email%' AND";
            $filter .= $email;
        }

        $query=substr($sql, 0, -3);
        $filt=substr($filter, 0, -2);

        echo $query;
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Employee Lists.xlsx";

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Employee Name");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "Position");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "Department");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', "Contact No");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', "Email Address");
        $num=2;

        $x = 1;
        $styleArray = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );
        if($filt!=''){
        
        foreach($this->super_model->custom_query("SELECT * FROM employees WHERE ".$query) AS $emp){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $emp->employee_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$num, $emp->position);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $emp->department);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $emp->contact_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$num, $emp->email);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":N".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":C".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('D1:F1');
            $objPHPExcel->getActiveSheet()->mergeCells('D'.$num.":F".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('G1:I1');
            $objPHPExcel->getActiveSheet()->mergeCells('G'.$num.":I".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('J1:K1');
            $objPHPExcel->getActiveSheet()->mergeCells('J'.$num.":K".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('L1:N1');
            $objPHPExcel->getActiveSheet()->mergeCells('L'.$num.":N".$num);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":N".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $num++;
            } 

        }else {
            foreach($this->super_model->select_all_order_by("employees","employee_name","ASC") AS $emp){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $emp->employee_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$num, $emp->position);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $emp->department);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $emp->contact_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$num, $emp->email);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":N".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":C".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('D1:F1');
            $objPHPExcel->getActiveSheet()->mergeCells('D'.$num.":F".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('G1:I1');
            $objPHPExcel->getActiveSheet()->mergeCells('G'.$num.":I".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('J1:K1');
            $objPHPExcel->getActiveSheet()->mergeCells('J'.$num.":K".$num);
            $objPHPExcel->getActiveSheet()->mergeCells('L1:N1');
            $objPHPExcel->getActiveSheet()->mergeCells('L'.$num.":N".$num);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":N".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $num++;
            } 
        }

        $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
        $objPHPExcel->getActiveSheet()->mergeCells('D1:F1');
        $objPHPExcel->getActiveSheet()->mergeCells('G1:I1');
        $objPHPExcel->getActiveSheet()->mergeCells('J1:K1');
        $objPHPExcel->getActiveSheet()->mergeCells('L1:N1');
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Employee Lists.xlsx"');
        readfile($exportfilename);
    }

   public function group_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['group']=$this->super_model->select_all_order_by("groups","group_name","ASC");
        $this->load->view('masterfile/group_list',$data);
        $this->load->view('template/footer');
    }

    public function add_group(){
        $group_name = $this->input->post('group_name');
        $data = array(
            'group_name'=>$group_name,
        );
        if($this->super_model->insert_into("groups", $data)){
            echo "<script>alert('Group Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/group_list'; </script>";
        }
    }

    public function update_group(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_group'] = $this->super_model->select_row_where('groups', 'group_id', $id);
        $this->load->view('masterfile/update_group',$data);
        $this->load->view('template/footer');
    }

    public function edit_group(){
        $data = array(
            'group_name'=>$this->input->post('group_name'),
        );
        $group_id = $this->input->post('group_id');
        if($this->super_model->update_where('groups', $data, 'group_id', $group_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_group(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('groups', 'group_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/group_list'; </script>";
        }
    }

    public function search_group(){
        if(!empty($this->input->post('group_name'))){
            $data['group_name'] = $this->input->post('group_name');
        } else {
            $data['group_name']= "null";
        }

        $sql="";
        $filter = " ";

        if(!empty($this->input->post('group_name'))){
            $group_name = $this->input->post('group_name');
            $sql.=" group_name LIKE '%$group_name%' AND";
            $filter .= "Group - ".$group_name.", ";
        }

        $query=substr($sql, 0, -3);
        $data['filt']=substr($filter, 0, -2);
        $data['group']=$this->super_model->custom_query("SELECT * FROM groups WHERE ".$query); 
        $this->load->view('template/header'); 
        $this->load->view('template/navbar');      
        $this->load->view('masterfile/group_list',$data);
        $this->load->view('template/footer');
    }

        public function export_group_list(){
        $group_name=urldecode($this->uri->segment(3));

        $sql="";
        $filter = " ";

        if($group_name!='null'){
            $sql.=" group_name LIKE '%$group_name%' AND";
            $filter .= $group_name;
        }

        $query=substr($sql, 0, -3);
        $filt=substr($filter, 0, -2);
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="Group Lists.xlsx";

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Group Name");
        $num=2;

        $x = 1;
        $styleArray = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );
        if($filt!=''){
        foreach($this->super_model->custom_query("SELECT * FROM groups WHERE ".$query) AS $group){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $group->group_name);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":C".$num);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $num++;
            } 

        }else{
        foreach($this->super_model->select_all_order_by("groups", "group_name", "ASC") AS $group){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $group->group_name);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);    
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$num.":C".$num);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $num++;
            }
        }

        $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Group Lists.xlsx"');
        readfile($exportfilename);
    }

    public function category_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['category'] = $this->super_model->select_all('item_categories'); 
        $data['subcat'] = $this->super_model->select_all('item_subcat'); 
        //$data['access']=$this->access;
        $this->load->view('masterfile/category_list',$data);
        $this->load->view('template/footer');
    }

    public function add_category(){
        $rows = $this->super_model->count_rows("item_categories");
        if($rows==0) {
            $cat_code = 'A';
            for ($n=0; $n<0; $n++) {
                echo $cat_code++;
            }
        }
        else{
             $cat_code = $this->super_model->get_max('item_categories', 'cat_code');
             $cat_code++;
        }
        $prefix = trim($this->input->post('prefix')," ");
        $cat_name = trim($this->input->post('category_name')," ");
        $data = array(
            'cat_code'=> $cat_code,
            'cat_prefix'=>$prefix,
            'cat_name'=>$cat_name
        );
        if($this->super_model->insert_into("item_categories", $data)){
           echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/category_list'; </script>";
        }
    }

    public function add_subcat(){
        $post = $this->input->post('id');
        $row = $this->super_model->count_rows_where("item_subcat", "cat_id", $post);
        if(empty($row)){
            $add = 1;
            $subcat_code = $this->input->post('cat_code')."-".$add;
        }   
        else {
            $subcat_code = $this->super_model->select_column_where("item_subcat", "subcat_code","cat_id = '$post' ORDER BY subcat_id DESC LIMIT 1");
            $array = explode("-", $subcat_code);
            $inc = $array[1]+1;
            $subcat_code = $array[0]."-".$inc;
        }
        $prefix = trim($this->input->post('prefix')," ");
        $sub_name = trim($this->input->post('subcategory_name')," ");
        $data = array(
            'cat_id'=>$this->input->post('id'),
            'subcat_code'=>$subcat_code,
            'subcat_prefix'=>$prefix,
            'subcat_name'=> $sub_name
        );
        if($this->super_model->insert_into("item_subcat", $data)){
           echo "<script>alert('Successfully Added!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function view_cat(){
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['cat'] = $this->super_model->select_row_where('item_categories', 'cat_id', $id);
        //$data['access']=$this->access;
        $this->load->view('template/header');
        $this->load->view('masterfile/view_cat',$data);
        $this->load->view('template/footer');
    }

    public function update_subcategory(){
        $data = array(
            'subcat_name'=>$this->input->post('subcat_name'),
            'subcat_prefix'=>$this->input->post('subcat_pref'),
        );
        $subid = $this->input->post('subcat_id');
            if($this->super_model->update_where('item_subcat', $data, 'subcat_id', $subid)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."index.php/masterfile/category_list'; </script>";
        }
    }

    public function update_category(){
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_category'] = $this->super_model->select_row_where('item_categories', 'cat_id', $id);
        //$data['access']=$this->access;
        $this->load->view('template/header');
        $this->load->view('masterfile/update_category',$data);
        $this->load->view('template/footer');
    }

    public function edit_category(){
        $data = array(
            'cat_prefix'=>$this->input->post('prefix'),
            'cat_name'=>$this->input->post('cat_name')
        );
        $catid = $this->input->post('cat_id');
            if($this->super_model->update_where('item_categories', $data, 'cat_id', $catid)){
            echo "<script>alert('Successfully Updated'); 
                window.location ='".base_url()."index.php/masterfile/category_list'; </script>";
        }
    }

    public function delete_category(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('item_categories', 'cat_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/category_list'; </script>";
        }
    }

public function location_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['location']=$this->super_model->select_all_order_by("location","location_name","ASC");
        $this->load->view('masterfile/location_list',$data);
        $this->load->view('template/footer');
    }

    public function add_location(){
        $location_name = trim($this->input->post('location_name')," ");
        $data = array(
            'location_name'=>$location_name,
        );
        if($this->super_model->insert_into("location", $data)){
            echo "<script>alert('Location Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/location_list'; </script>";
        }
    }

    public function update_location(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_location'] = $this->super_model->select_row_where('location', 'location_id', $id);
        $this->load->view('masterfile/update_location',$data);
        $this->load->view('template/footer');
    }

    public function edit_location(){
        $data = array(
            'location_name'=>$this->input->post('location_name'),
        );
        $location_id = $this->input->post('location_id');
        if($this->super_model->update_where('location', $data, 'location_id', $location_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_location(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('location', 'location_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/location_list'; </script>";
        }
    }

public function enduse_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['enduse']=$this->super_model->select_all_order_by("enduse","enduse_name","ASC");
        $this->load->view('masterfile/enduse_list',$data);
        $this->load->view('template/footer');
    }

    public function add_enduse(){
        $endc = trim($this->input->post('end_code')," ");
        $endn = trim($this->input->post('end_name')," ");
        $data = array(
            'enduse_code'=>$endc,
            'enduse_name'=>$endn
        );
        if($this->super_model->insert_into("enduse", $data)){
            echo "<script>alert('Enduse Successfully Added!');
            window.location ='".base_url()."index.php/masterfile/enduse_list'; </script>";
        }
    }

    public function update_enduse(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_enduse'] = $this->super_model->select_row_where('enduse', 'enduse_id', $id);
        $this->load->view('masterfile/update_enduse',$data);
        $this->load->view('template/footer');
    }

    public function edit_enduse(){
        $data = array(
            'enduse_code'=>$this->input->post('end_code'),
            'enduse_name'=>$this->input->post('end_name')
        );
        $enduse_id = $this->input->post('enduse_id');
        if($this->super_model->update_where('enduse', $data, 'enduse_id', $enduse_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_enduse(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('enduse', 'enduse_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/enduse_list'; </script>";
        }
    }

    public function purpose_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['purpose']=$this->super_model->select_all_order_by("purpose","purpose_desc","ASC");
        $this->load->view('masterfile/purpose_list',$data);
        $this->load->view('template/footer');
    }

    public function add_purpose(){
        $purpose_desc = trim($this->input->post('purpose_desc')," ");
        $data = array(
            'purpose_desc'=>$purpose_desc,
        );
        if($this->super_model->insert_into("purpose", $data)){
            echo "<script>alert('Purpose Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/purpose_list'; </script>";
        }
    }

    public function update_purpose(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_purpose'] = $this->super_model->select_row_where('purpose', 'purpose_id', $id);
        $this->load->view('masterfile/update_purpose',$data);
        $this->load->view('template/footer');
    }

    public function edit_purpose(){
        $data = array(
            'purpose_desc'=>$this->input->post('purpose_desc'),
        );
        $purpose_id = $this->input->post('purpose_id');
        if($this->super_model->update_where('purpose', $data, 'purpose_id', $purpose_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_purpose(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('purpose', 'purpose_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/purpose_list'; </script>";
        }
    }

    public function rack_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['rack']=$this->super_model->select_all_order_by("rack","rack_name","ASC");
        $this->load->view('masterfile/rack_list',$data);
        $this->load->view('template/footer');
    }

    public function add_rack(){
        $rack_name = trim($this->input->post('rack_name')," ");
        $data = array(
            'rack_name'=>$rack_name,
        );
        if($this->super_model->insert_into("rack", $data)){
            echo "<script>alert('Rack Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/rack_list'; </script>";
        }
    }

    public function update_rack(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_rack'] = $this->super_model->select_row_where('rack', 'rack_id', $id);
        $this->load->view('masterfile/update_rack',$data);
        $this->load->view('template/footer');
    }

    public function edit_rack(){
        $data = array(
            'rack_name'=>$this->input->post('rack_name'),
        );
        $rack_id = $this->input->post('rack_id');
        if($this->super_model->update_where('rack', $data, 'rack_id', $rack_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_rack(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('rack', 'rack_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/rack_list'; </script>";
        }
    }

    public function supplier_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['supplier']=$this->super_model->select_all_order_by("supplier","supplier_name","ASC");
        $this->load->view('masterfile/supplier_list',$data);
        $this->load->view('template/footer');
    }

    public function add_supplier(){
        $supplier_code = trim($this->input->post('supplier_code')," ");
        $supplier_name = trim($this->input->post('supplier_name')," ");
        $address = trim($this->input->post('address')," ");
        $contact_number = trim($this->input->post('contact_number')," ");
        $terms = trim($this->input->post('terms')," ");
        $active = trim($this->input->post('active')," ");
        $data = array(
            'supplier_code'=>$supplier_code,
            'supplier_name'=>$supplier_name,
            'address'=>$address,
            'contact_number'=>$contact_number,
            'terms'=>$terms,
            'active'=>$active,
        );
        if($this->super_model->insert_into("supplier", $data)){
            echo "<script>alert('Supplier Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/supplier_list'; </script>";
        }
    }

    public function update_supplier(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_supplier'] = $this->super_model->select_row_where('supplier', 'supplier_id', $id);
        $this->load->view('masterfile/update_supplier',$data);
        $this->load->view('template/footer');
    }

    public function edit_supplier(){
        $data = array(
            'supplier_code'=>$this->input->post('supplier_code'),
            'supplier_name'=>$this->input->post('supplier_name'),
            'address'=>$this->input->post('address'),
            'contact_number'=>$this->input->post('contact_number'),
            'terms'=>$this->input->post('terms'),
            'active'=>$this->input->post('active'),
        );
        $supplier_id = $this->input->post('supplier_id');
        if($this->super_model->update_where('supplier', $data, 'supplier_id', $supplier_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_supplier(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('supplier', 'supplier_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/supplier_list'; </script>";
        }
    }

    public function uom_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['uom']=$this->super_model->select_all_order_by("uom","unit_name","ASC");
        $this->load->view('masterfile/uom_list',$data);
        $this->load->view('template/footer');
    }

    public function add_uom(){
        $unit_name = trim($this->input->post('unit_name')," ");
        $data = array(
            'unit_name'=>$unit_name,
        );
        if($this->super_model->insert_into("uom", $data)){
            echo "<script>alert('Uom Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/uom_list'; </script>";
        }
    }

    public function update_uom(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_uom'] = $this->super_model->select_row_where('uom', 'unit_id', $id);
        $this->load->view('masterfile/update_uom',$data);
        $this->load->view('template/footer');
    }

    public function edit_uom(){
        $data = array(
            'unit_name'=>$this->input->post('unit_name'),
        );
        $unit_id = $this->input->post('unit_id');
        if($this->super_model->update_where('uom', $data, 'unit_id', $unit_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_uom(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('uom', 'unit_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/uom_list'; </script>";
        }
    }

    public function warehouse_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['warehouse']=$this->super_model->select_all_order_by("warehouse","warehouse_name","ASC");
        $this->load->view('masterfile/warehouse_list',$data);
        $this->load->view('template/footer');
    }

    public function add_warehouse(){
        $warehouse_name = trim($this->input->post('warehouse_name')," ");
        $data = array(
            'warehouse_name'=>$warehouse_name,
        );
        if($this->super_model->insert_into("warehouse", $data)){
            echo "<script>alert('Warehouse Successfully Added!'); 
                window.location ='".base_url()."index.php/masterfile/warehouse_list'; </script>";
        }
    }

    public function update_warehouse(){
        $this->load->view('template/header');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_warehouse'] = $this->super_model->select_row_where('warehouse', 'warehouse_id', $id);
        $this->load->view('masterfile/update_warehouse',$data);
        $this->load->view('template/footer');
    }

    public function edit_warehouse(){
        $data = array(
            'warehouse_name'=>$this->input->post('warehouse_name'),
        );
        $warehouse_id = $this->input->post('warehouse_id');
        if($this->super_model->update_where('warehouse', $data, 'warehouse_id', $warehouse_id)){
            echo "<script>alert('Successfully Updated!'); window.opener.location.reload(); window.close();</script>";
        }
    }

    public function delete_warehouse(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('warehouse', 'warehouse_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."index.php/masterfile/warehouse_list'; </script>";
        }
    }


}