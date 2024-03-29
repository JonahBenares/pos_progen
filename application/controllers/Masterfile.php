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

function dateDifference($date_1 , $date_2)
{
    $datetime2 = date_create($date_2);
    $datetime1 = date_create($date_1 );
    $interval = date_diff($datetime2, $datetime1);
   
    return $interval->format('%R%a');
   
}

    public function get_expected_qty_goods($dr,$item){
        $expected_qty = $this->super_model->select_sum_join("expected_qty","sales_good_details","sales_good_head", "dr_no = '$dr' AND bo='0'","sales_good_head_id");
        return $expected_qty;
    }

     public function get_received_qty_goods($dr,$item){
        $received_qty = $this->super_model->select_sum_join("quantity","sales_good_details","sales_good_head", "dr_no = '$dr' AND bo='0'","sales_good_head_id");
        return $received_qty;
    }

    public function get_expected_qty_services($dr,$item){
        $expected_qty = $this->super_model->select_sum_join("expected_qty","sales_serv_items","sales_services_head", "dr_no = '$dr' AND bo='0'","sales_serv_head_id");
        return $expected_qty;
    }

     public function get_received_qty_services($dr,$item){
        $received_qty = $this->super_model->select_sum_join("quantity","sales_serv_items","sales_services_head", "dr_no = '$dr' AND bo='0'","sales_serv_head_id");
        return $received_qty;
    }

    public function dashboard(){
        $today = date("Y-m-d");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $start_date = strtotime($today);
        $end_date = strtotime("+3 months", $start_date);
        $week = date('Y-m-d', $end_date);
        $data['expired'] = $this->super_model->count_custom_where("receive_items", "expiration_date <= '$week' AND expiration_date >= '$today'");
        foreach($this->super_model->custom_query("SELECT DISTINCT dr_no, item_id,  sd.sales_good_head_id FROM sales_good_details sd INNER JOIN sales_good_head sh ON sd.sales_good_head_id = sh.sales_good_head_id WHERE saved='1' AND bo='0' GROUP BY dr_no") AS $dr){
                $expected_qty_goods= $this->get_expected_qty_goods($dr->dr_no,$dr->item_id);
                $received_qty_goods= $this->get_received_qty_goods($dr->dr_no,$dr->item_id);
                if($expected_qty_goods>$received_qty_goods){
                $goods_count = $this->super_model->count_custom_query("SELECT DISTINCT dr_no, item_id,  sd.sales_good_head_id FROM sales_good_details sd INNER JOIN sales_good_head sh ON sd.sales_good_head_id = sh.sales_good_head_id WHERE saved='1' AND bo='0' GROUP BY dr_no");
            }
        }
        //$goods_count = $this->super_model->count_custom_where("sales_good_details", "'$received_qty_goods' < '$expected_qty_goods'");
        foreach($this->super_model->custom_query("SELECT DISTINCT dr_no, item_id, si.sales_serv_head_id FROM sales_serv_items si INNER JOIN sales_services_head sh ON si.sales_serv_head_id = sh.sales_serv_head_id WHERE saved='1' AND bo='0' GROUP BY dr_no") AS $drs){
                $expected_qty_services= $this->get_expected_qty_services($dr->dr_no,$dr->item_id);
                $received_qty_services= $this->get_received_qty_services($dr->dr_no,$dr->item_id);
                if($expected_qty_services>$received_qty_services){
                $service_count = $this->super_model->count_custom_query("SELECT DISTINCT dr_no, item_id, si.sales_serv_head_id FROM sales_serv_items si INNER JOIN sales_services_head sh ON si.sales_serv_head_id = sh.sales_serv_head_id WHERE saved='1' AND bo='0' GROUP BY dr_no");
            }
            //$services_count = $this->super_model->count_custom_where("sales_serv_items", "'$received_qty_services' < '$expected_qty_services'");
        }       
        if(!empty($goods_count)){
            $data['sales_backorder'] = $goods_count;
        }elseif (!empty($service_count)) {
            $data['sales_backorder'] = $service_count;
        }elseif (!empty($goods_count) && !empty($service_count)) {
            $data['sales_backorder'] = $goods_count + $service_count;
        }
        $this->load->view('masterfile/dashboard', $data);
        $this->load->view('template/footer');
    }

    public function graphic_goods($client, $month){
        $mo = sprintf("%02d", $month);
        $date_ym = date('Y')."-".$mo;
        $sales_goods=$this->super_model->select_sum_join("total","sales_good_head","sales_good_details", "client_id='$client' AND saved='1' AND sales_date LIKE '$date_ym%'","sales_good_head_id");
        return $sales_goods;
    }

    public function graphic_services($client, $month){
        $mo = sprintf("%02d", $month);
        $date_ym = date('Y')."-".$mo;
        $sales_goods=$this->super_model->select_sum_join("total","sales_services_head","sales_serv_items", "client_id='$client' AND saved='1' AND sales_date LIKE '$date_ym%'","sales_serv_head_id");
        return $sales_goods;
    }

    public function login_process(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $count=$this->super_model->login_user($username,$password);
        if($count>0){   
            $password1 =md5($this->input->post('password'));
            $fetch=$this->super_model->select_custom_where("users", "username = '$username' AND (password = '$password' OR password = '$password1')");
            foreach($fetch AS $d){
                $userid = $d->user_id;
                //$usertype = $d->usertype_id;
                $username = $d->username;
                $fullname = $d->fullname;
                $position = $d->position;
            }
            $newdata = array(
               'user_id'=> $userid,
               //'usertype'=> $usertype,
               'username'=> $username,
               'fullname'=> $fullname,
               'position'=> $position,
               'logged_in'=> TRUE
            );
            $this->session->set_userdata($newdata);
            redirect(base_url().'index.php/masterfile/dashboard/');
        }
        else{
            $this->session->set_flashdata('error_msg', 'Username And Password Do not Exist!');
            //$this->load->view('template/header_login');
            $this->load->view('masterfile/login');
            $this->load->view('template/footer');       
        }
    }

        public function user_logout(){
        $this->session->sess_destroy();
        $this->load->view('template/header');
        $this->load->view('masterfile/login');
        $this->load->view('template/footer');
        echo "<script>alert('You have successfully logged out.'); 
        window.location ='".base_url()."index.php/masterfile/index'; </script>";
    }

    public function bin_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['bin']=$this->super_model->select_all_order_by("bin","bin_name","ASC");
        $this->load->view('masterfile/bin_list',$data);
        $this->load->view('template/footer');
    }

    public function add_bin(){
        $bin_name = trim($this->input->post('bin_name')," ");
        $data = array(
            'bin_name'=>$bin_name,
        );
        if($this->super_model->insert_into("bin", $data)){
            echo "<script>alert('Bin Successfully Added!'); 
                window.location ='".base_url()."masterfile/bin_list'; </script>";
        }
    }

    public function update_bin(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_bin'] = $this->super_model->select_row_where('bin', 'bin_id', $id);
        $this->load->view('masterfile/update_bin',$data);
        $this->load->view('template/footer');
    }

    public function edit_bin(){
        $data = array(
            'bin_name'=>$this->input->post('bin_name'),
        );
        $bin_id = $this->input->post('bin_id');
        if($this->super_model->update_where('bin', $data, 'bin_id', $bin_id)){
            echo "<script>alert('Bin Successfully Updated!'); 
                window.location ='".base_url()."masterfile/bin_list'; </script>";
        }
    }

    public function delete_bin(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('bin', 'bin_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/bin_list'; </script>";
        }
    }


    public function client_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['buyer']=$this->super_model->select_all_order_by("client","buyer_name","ASC");
        $this->load->view('masterfile/client_list',$data);
        $this->load->view('template/footer');
    }

    public function add_client(){
        $buyer_name = $this->input->post('buyer_name');
        $address = $this->input->post('address');
        $contact_person = $this->input->post('contact_person');
        $contact_no = $this->input->post('contact_no');
        $tin = $this->input->post('tin');
        $wht = $this->input->post('wht');
        $data = array(
            'buyer_name'=>$buyer_name,
            'address'=>$address,
            'contact_person'=>$contact_person,
            'contact_no'=>$contact_no,
            'tin'=>$tin,
            'wht'=>$wht
        );
        if($this->super_model->insert_into("client", $data)){
            echo "<script>alert('Client Successfully Added!'); 
                window.location ='".base_url()."masterfile/client_list'; </script>";
        }
    }

    public function update_client(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_client'] = $this->super_model->select_row_where('client', 'client_id', $id);
        $this->load->view('masterfile/update_client',$data);
        $this->load->view('template/footer');
    }

    public function edit_client(){
        $data = array(
            'buyer_name'=>$this->input->post('buyer_name'),
            'address'=>$this->input->post('address'),
            'contact_person'=>$this->input->post('contact_person'),
            'contact_no'=>$this->input->post('contact_no'),
            'tin'=>$this->input->post('tin'),
            'wht'=>$this->input->post('wht'),
        );
        $client_id = $this->input->post('client_id');
        if($this->super_model->update_where('client', $data, 'client_id', $client_id)){
            echo "<script>alert('Client Successfully Updated!'); 
                window.location ='".base_url()."masterfile/client_list/$client_id'; </script>";
        }
    }

    public function delete_client(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('client', 'client_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/client_list'; </script>";
        }
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
                window.location ='".base_url()."masterfile/department_list'; </script>";
        }
    }

    public function update_department(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
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
            echo "<script>alert('Department Successfully Updated!'); 
                window.location ='".base_url()."masterfile/department_list'; </script>";
        }
    }

    public function delete_department(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('department', 'department_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/department_list'; </script>";
        }
    }

    public function employee_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['department'] = $this->super_model->select_all('department');
        foreach($this->super_model->select_all_order_by('employees','employee_name','ASC') AS $emp){
            $department =$this->super_model->select_column_where("department", "department_name", "department_id", $emp->department_id);
            $data['employee'][] = array(
                'employee_id'=>$emp->employee_id,
                'employee'=>$emp->employee_name,
                'department'=>$department,
                'position'=>$emp->position,
                'contact_no'=>$emp->contact_no,
                'email'=>$emp->email
            );
        }
        $this->load->view('masterfile/employee_list',$data);
        $this->load->view('template/footer');
    }

    public function add_employee(){
        $employee_name = $this->input->post('employee_name');
        $department_id = $this->input->post('department_id');
        $position = $this->input->post('position');
        $contact_no = $this->input->post('contact_no');
        $email = $this->input->post('email');
        $data = array(
            'employee_name'=>$employee_name,
            'department_id'=>$department_id,
            'position'=>$position,
            'contact_no'=>$contact_no,
            'email'=>$email,
        );
        if($this->super_model->insert_into("employees", $data)){
            echo "<script>alert('Employee Successfully Added!'); 
                window.location ='".base_url()."masterfile/employee_list'; </script>";
        }
    }

    public function update_employee(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['department'] = $this->super_model->select_all('department');
        $data['update_employee'] = $this->super_model->select_row_where('employees', 'employee_id', $id);
        $this->load->view('masterfile/update_employee',$data);
        $this->load->view('template/footer');
    }

    public function edit_employee(){
        $data = array(
            'employee_name'=>$this->input->post('employee_name'),
            'department_id'=>$this->input->post('department_id'),
            'position'=>$this->input->post('position'),
            'contact_no'=>$this->input->post('contact_no'),
            'email'=>$this->input->post('email'),
        );
        $employee_id = $this->input->post('employee_id');
        if($this->super_model->update_where('employees', $data, 'employee_id', $employee_id)){
            echo "<script>alert('Employee Successfully Updated!'); 
                window.location ='".base_url()."masterfile/employee_list'; </script>";
        }
    }

    public function delete_employee(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('employees', 'employee_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/employee_list'; </script>";
        }
    }

   public function equipment_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['equipment']=$this->super_model->select_all_order_by("equipment","equipment_name","ASC");
        $this->load->view('masterfile/equipment_list',$data);
        $this->load->view('template/footer');
    }

    public function add_equipment(){
        $equipment_name = $this->input->post('equipment_name');
        $acquisition_cost = $this->input->post('acquisition_cost');
        $daily_rate = $this->input->post('daily_rate');
        $hourly_rate = $this->input->post('hourly_rate');
        $data = array(
            'equipment_name'=>$equipment_name,
            'acquisition_cost'=>$acquisition_cost,
            'daily_rate'=>$daily_rate,
            'hourly_rate'=>$hourly_rate,
        );
        if($this->super_model->insert_into("equipment", $data)){
            echo "<script>alert('Equipment Successfully Added!'); 
                window.location ='".base_url()."masterfile/equipment_list'; </script>";
        }
    }

    public function update_equipment(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_equipment'] = $this->super_model->select_row_where('equipment', 'equipment_id', $id);
        $this->load->view('masterfile/update_equipment',$data);
        $this->load->view('template/footer');
    }

    public function edit_equipment(){
        $data = array(
            'equipment_name'=>$this->input->post('equipment_name'),
            'acquisition_cost'=>$this->input->post('acquisition_cost'),
            'daily_rate'=>$this->input->post('daily_rate'),
            'hourly_rate'=>$this->input->post('hourly_rate'),
        );
        $equipment_id = $this->input->post('equipment_id');
        if($this->super_model->update_where('equipment', $data, 'equipment_id', $equipment_id)){
            echo "<script>alert('Equipment Successfully Updated!'); 
                window.location ='".base_url()."masterfile/equipment_list'; </script>";
        }
    }

    public function delete_equipment(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('equipment', 'equipment_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/equipment_list'; </script>";
        }
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
                window.location ='".base_url()."masterfile/group_list'; </script>";
        }
    }

    public function update_group(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
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
            echo "<script>alert('Group Successfully Updated!'); 
                window.location ='".base_url()."masterfile/group_list'; </script>";
        }
    }

    public function delete_group(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('groups', 'group_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/group_list'; </script>";
        }
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
                window.location ='".base_url()."masterfile/category_list'; </script>";
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
           echo "<script>alert('Sub Category Successfully Added!'); 
                window.location ='".base_url()."masterfile/category_list'; </script>";
        }
    }

    public function view_subcat(){
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['cat'] = $this->super_model->select_row_where('item_categories', 'cat_id', $id);
        //$data['access']=$this->access;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/view_subcat',$data);
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
                window.location ='".base_url()."masterfile/category_list'; </script>";
        }
    }

    public function update_category(){
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_category'] = $this->super_model->select_row_where('item_categories', 'cat_id', $id);
        //$data['access']=$this->access;
        $this->load->view('template/header');
        $this->load->view('template/navbar');
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
                window.location ='".base_url()."masterfile/category_list'; </script>";
        }
    }

    public function delete_category(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('item_categories', 'cat_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/category_list'; </script>";
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
                window.location ='".base_url()."masterfile/location_list'; </script>";
        }
    }

    public function update_location(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
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
            echo "<script>alert('Location Successfully Updated!'); 
                window.location ='".base_url()."masterfile/location_list'; </script>";
        }
    }

    public function delete_location(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('location', 'location_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/location_list'; </script>";
        }
    }

   public function manpower_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['manpower']=$this->super_model->select_all_order_by("manpower","employee_name","ASC");
        $this->load->view('masterfile/manpower_list',$data);
        $this->load->view('template/footer');
    }

    public function add_manpower(){
        $employee_name = $this->input->post('employee_name');
        $position = $this->input->post('position');
        $daily_rate = $this->input->post('daily_rate');
        $data = array(
            'employee_name'=>$employee_name,
            'position'=>$position,
            'daily_rate'=>$daily_rate,
        );
        if($this->super_model->insert_into("manpower", $data)){
            echo "<script>alert('Manpower Successfully Added!'); 
                window.location ='".base_url()."masterfile/manpower_list'; </script>";
        }
    }

    public function update_manpower(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_manpower'] = $this->super_model->select_row_where('manpower', 'manpower_id', $id);
        $this->load->view('masterfile/update_manpower',$data);
        $this->load->view('template/footer');
    }

    public function edit_manpower(){
        $data = array(
            'employee_name'=>$this->input->post('employee_name'),
            'position'=>$this->input->post('position'),
            'daily_rate'=>$this->input->post('daily_rate'),
        );
        $manpower_id = $this->input->post('manpower_id');
        if($this->super_model->update_where('manpower', $data, 'manpower_id', $manpower_id)){
            echo "<script>alert('Manpower Successfully Updated!'); 
                window.location ='".base_url()."masterfile/manpower_list'; </script>";
        }
    }

    public function delete_manpower(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('manpower', 'manpower_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/manpower_list'; </script>";
        }
    }

/*    public function enduse_list(){
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
            window.location ='".base_url()."masterfile/enduse_list'; </script>";
        }
    }

    public function update_enduse(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
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
            echo "<script>alert('Enduse Successfully Updated!');
            window.location ='".base_url()."masterfile/enduse_list'; </script>";
        }
    }

    public function delete_enduse(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('enduse', 'enduse_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/enduse_list'; </script>";
        }
    }*/

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
                window.location ='".base_url()."masterfile/purpose_list'; </script>";
        }
    }

    public function update_purpose(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
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
            echo "<script>alert('Purpose Successfully Updated!'); 
                window.location ='".base_url()."masterfile/purpose_list'; </script>";
        }
    }

    public function delete_purpose(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('purpose', 'purpose_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/purpose_list'; </script>";
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
                window.location ='".base_url()."masterfile/rack_list'; </script>";
        }
    }

    public function update_rack(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
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
            echo "<script>alert('Rack Successfully Updated!'); 
                window.location ='".base_url()."masterfile/rack_list'; </script>";
        }
    }

    public function delete_rack(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('rack', 'rack_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/rack_list'; </script>";
        }
    }

        public function shipping_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['shipping']=$this->super_model->select_all_order_by("shipping_company","company_name","ASC");
        $this->load->view('masterfile/shipping_list',$data);
        $this->load->view('template/footer');
    }

    public function add_shipping(){
        $company_name = $this->input->post('company_name');
        $contact_no = $this->input->post('contact_no');
        $address = $this->input->post('address');
        $data = array(
            'company_name'=>$company_name,
            'contact_no'=>$contact_no,
            'address'=>$address,
        );
        if($this->super_model->insert_into("shipping_company", $data)){
            echo "<script>alert('Shipping Company Successfully Added!'); 
                window.location ='".base_url()."masterfile/shipping_list'; </script>";
        }
    }

    public function update_shipping(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $data['id']=$this->uri->segment(3);
        $id=$this->uri->segment(3);
        $data['update_shipping'] = $this->super_model->select_row_where('shipping_company', 'ship_comp_id', $id);
        $this->load->view('masterfile/update_shipping',$data);
        $this->load->view('template/footer');
    }

    public function edit_shipping(){
        $data = array(
            'company_name'=>$this->input->post('company_name'),
            'contact_no'=>$this->input->post('contact_no'),
            'address'=>$this->input->post('address'),
        );
        $ship_comp_id = $this->input->post('ship_comp_id');
        if($this->super_model->update_where('shipping_company', $data, 'ship_comp_id', $ship_comp_id)){
            echo "<script>alert('Shipping Company Successfully Updated!'); 
                window.location ='".base_url()."masterfile/shipping_list/$ship_comp_id'; </script>";
        }
    }

    public function delete_shipping(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('shipping_company', 'ship_comp_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/shipping_list'; </script>";
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
                window.location ='".base_url()."masterfile/supplier_list'; </script>";
        }
    }

    public function update_supplier(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
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
           echo "<script>alert('Supplier Successfully Updated!'); 
                window.location ='".base_url()."masterfile/supplier_list'; </script>";
        }
    }

    public function delete_supplier(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('supplier', 'supplier_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/supplier_list'; </script>";
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
                window.location ='".base_url()."masterfile/uom_list'; </script>";
        }
    }

    public function update_uom(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
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
            echo "<script>alert('Uom Successfully Updated!'); 
                window.location ='".base_url()."masterfile/uom_list'; </script>";
        }
    }

    public function delete_uom(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('uom', 'unit_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/uom_list'; </script>";
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
                window.location ='".base_url()."masterfile/warehouse_list'; </script>";
        }
    }

    public function update_warehouse(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
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
            echo "<script>alert('Warehouse Successfully Updated!'); 
                window.location ='".base_url()."masterfile/warehouse_list'; </script>";
        }
    }

    public function delete_warehouse(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('warehouse', 'warehouse_id', $id)){
            echo "<script>alert('Succesfully Deleted'); 
                window.location ='".base_url()."masterfile/warehouse_list'; </script>";
        }
    }

    public function upload_priceRef()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/upload_priceRef');
        $this->load->view('template/footer');
    }

    public function notif_list()
    {
        $data['adjustments'] = $this->super_model->select_row_where("billing_adjustment_history", "status", "0");
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/notif_list',$data);
        $this->load->view('template/footer');
    }


    public function delete_unsave(){
        $user_id=$_SESSION['user_id'];
        $curr_url = $this->input->post("url");
        $base = $this->input->post("base");

        

        $goods_url = $base.'sales/goods_add_sales_head';
        $services_url = $base.'sales/services_add_sales_head';
        $receive_url = $base.'receive/add_receive_head';
        $repair_url = $base.'repair/repair_form/';
        $damage_url = $base.'damage/damage_item';
       
       if($curr_url == $goods_url){
            $count_goods = $this->super_model->count_custom_where("sales_good_head", "user_id='$user_id' AND saved='0'");
          
            $id = $this->super_model->select_column_custom_where("sales_good_head", "sales_good_head_id", "user_id='$user_id' AND saved='0'");
                $this->super_model->delete_where("sales_good_head", "sales_good_head_id", $id);
                    foreach($this->super_model->select_custom_where("sales_good_details","sales_good_head_id='$id'") AS $del){
                        $this->super_model->delete_where("temp_sales_out", "sales_details_id", $del->sales_good_det_id);
                        $this->super_model->delete_where("sales_good_details", "sales_good_head_id", $id);
                    }
        }

        if($curr_url == $services_url){
            $count_sales = $this->super_model->count_custom_where("sales_services_head", "user_id='$user_id' AND saved='0'");
          
            $service_id = $this->super_model->select_column_custom_where("sales_services_head", "sales_serv_head_id", "user_id='$user_id' AND saved='0'");
               $this->super_model->delete_where("sales_services_head", "sales_serv_head_id", $service_id);
            foreach($this->super_model->select_custom_where("sales_serv_items","sales_serv_head_id='$service_id'") AS $del){
                $this->super_model->delete_where("temp_sales_out", "sales_serv_items_id", $del->sales_serv_items_id);
                $this->super_model->delete_where("sales_serv_items", "sales_serv_head_id", $service_id);
                $this->super_model->delete_where("sales_serv_equipment", "sales_serv_head_id", $service_id);
                $this->super_model->delete_where("sales_serv_manpower", "sales_serv_head_id", $service_id);
                $this->super_model->delete_where("sales_serv_material", "sales_serv_head_id", $service_id);
            }
        }

        if($curr_url == $receive_url){

            $receive_id = $this->super_model->select_column_custom_where("receive_head", "receive_id", "user_id='$user_id' AND saved='0'");
            $this->super_model->delete_where("receive_head", "receive_id", $receive_id);
            $this->super_model->delete_where("receive_details", "receive_id", $receive_id);
            $this->super_model->delete_where("receive_items", "receive_id", $receive_id);
        }

         if($curr_url == $repair_url){

             $repair_id = $this->super_model->select_column_custom_where("repair_details", "repair_id", "user_id='$user_id' AND saved='0'");
            $this->super_model->delete_where("repair_details", "repair_id", $repair_id);
         }

          if($curr_url == $damage_url){

             $damage_id = $this->super_model->select_column_custom_where("damage_head", "damage_id", "user_id='$user_id' AND saved='0'");
            $this->super_model->delete_where("damage_head", "damage_id", $damage_id);
         }
    
    }
        

    public function bulk_upload(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('masterfile/bulk_upload');
        $this->load->view('template/footer');
    } 

    public function export_inventory(){
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="inventory_format.xlsx";
       
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Item Description");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "Cat ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "Subcat ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "Subcat Prefix");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "Unit");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "PN No");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "Rack ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', "Group ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', "WH ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', "Location ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', "Instructions:");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L2', "Get Cat ID, Subcat CatID and Subcat Prefix in the reference sheet");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L3', "Leave PN No. column blank if there's none, system will generate if empty");
        $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);

        $Category = $objPHPExcel->createSheet();
        $Category->setTitle("Category");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A1', "Cat/Subcat ID");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B1', "Category/Subcategory Name");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C1', "Subcategory Prefix");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G1', "Instructions:");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G2', "Highlighted in yellow are the categories");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G3', "Below are its subcategories");
        $num = 2;
       // $num1=3;
        foreach($this->super_model->select_all("item_categories") AS $cat){
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('f4e542');
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$num, $cat->cat_id);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$num, $cat->cat_name);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$num)->getFont()->setBold(true);
            foreach($this->super_model->select_row_where("item_subcat","cat_id",$cat->cat_id) AS $sub){
                $num++;
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$num, $sub->subcat_id);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$num, $sub->subcat_name);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$num, $sub->subcat_prefix);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            } 
            $num++;
        }
        $Rack = $objPHPExcel->createSheet();
        $Rack->setTitle("Rack");
        $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A1', "Rack ID");
        $objPHPExcel->setActiveSheetIndex(2)->setCellValue('B1', "Rack Name");
        $num=2;
        foreach($this->super_model->select_all("rack") AS $rack){
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A'.$num, $rack->rack_id);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('B'.$num, $rack->rack_name);
            $num++;
        }

        $Group = $objPHPExcel->createSheet();
        $Group->setTitle("Group");
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('A1', "Group ID");
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('B1', "Group Name");
            $num=2;
            foreach($this->super_model->select_all("groups") AS $group){
                $objPHPExcel->setActiveSheetIndex(3)->setCellValue('A'.$num, $group->group_id);
                $objPHPExcel->setActiveSheetIndex(3)->setCellValue('B'.$num, $group->group_name);
                $num++;
            }
        $location = $objPHPExcel->createSheet();
        $location->setTitle("Location");
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('A1', "Location ID");
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('B1', "Location Name");
            $num=2;
            foreach($this->super_model->select_all("location") AS $location){
                $objPHPExcel->setActiveSheetIndex(4)->setCellValue('A'.$num, $location->location_id);
                $objPHPExcel->setActiveSheetIndex(4)->setCellValue('B'.$num, $location->location_name);
                $num++;
            }
        $warehouse = $objPHPExcel->createSheet();
        $warehouse->setTitle("Warehouse");
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('A1', "Warehouse ID");
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('B1', "Warehouse Name");
            $num=2;
            foreach($this->super_model->select_all("warehouse") AS $warehouse){
                $objPHPExcel->setActiveSheetIndex(5)->setCellValue('A'.$num, $warehouse->warehouse_id);
                $objPHPExcel->setActiveSheetIndex(5)->setCellValue('B'.$num, $warehouse->warehouse_name);
                $num++;
            }
        $unit = $objPHPExcel->createSheet();
        $unit->setTitle("UOM");
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('A1', "Unit ID");
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('B1', "Unit Name");
            $num=2;
            foreach($this->super_model->select_all("uom") AS $unit){
                $objPHPExcel->setActiveSheetIndex(6)->setCellValue('A'.$num, $unit->unit_id);
                $objPHPExcel->setActiveSheetIndex(6)->setCellValue('B'.$num, $unit->unit_name);
                $num++;
            }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="inventory_format.xlsx"');
        readfile($exportfilename);
        echo "<script>window.location = 'bulk_upload';</script>";
    }

    public function upload_excel(){
         $dest= realpath(APPPATH . '../uploads/excel/');
         $error_ext=0;
        if(!empty($_FILES['excelfile']['name'])){
            $exc= basename($_FILES['excelfile']['name']);
            $exc=explode('.',$exc);
            $ext1=$exc[1];
            if($ext1=='php' || $ext1!='xlsx'){
                $error_ext++;
            } 
            else {
                $filename1='item_inventory.'.$ext1;
                if(move_uploaded_file($_FILES["excelfile"]['tmp_name'], $dest.'/'.$filename1)){
                     $this->readExcel_inv();
                }        
            }
        }
    }

    public function readExcel_inv(){
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $inputFileName =realpath(APPPATH.'../uploads/excel/item_inventory.xlsx');
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } 
        catch(Exception $e) {
            die('Error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        $objPHPExcel->setActiveSheetIndex(0);
        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); 
        for($x=2;$x<=$highestRow;$x++){
            $timestamp = date('Y-m-d H:i:s');
            $desc = $objPHPExcel->getActiveSheet()->getCell('A'.$x)->getValue();
            $cat_id = trim($objPHPExcel->getActiveSheet()->getCell('B'.$x)->getValue());
            $subcat_id = trim($objPHPExcel->getActiveSheet()->getCell('C'.$x)->getValue());
            $prefix = trim($objPHPExcel->getActiveSheet()->getCell('D'.$x)->getValue());
            $unit = trim($objPHPExcel->getActiveSheet()->getCell('E'.$x)->getValue());
            $pn = trim($objPHPExcel->getActiveSheet()->getCell('F'.$x)->getValue());
            $rack_id = trim($objPHPExcel->getActiveSheet()->getCell('G'.$x)->getValue());
            $group_id = trim($objPHPExcel->getActiveSheet()->getCell('H'.$x)->getValue());
            $wh_id = trim($objPHPExcel->getActiveSheet()->getCell('I'.$x)->getValue());
            $location_id = trim($objPHPExcel->getActiveSheet()->getCell('J'.$x)->getValue());
            //echo $desc . "<br>";
            if(empty($pn)){
                $count=$this->super_model->count_rows_where("pn_series","subcat_prefix",$prefix);
                if($count==0){
                    $newpn='1001';
                    $orig_pn = $prefix."_".$newpn;
                } else {
                    $maxid=$this->super_model->get_max_where("pn_series", "series", "subcat_prefix = '$prefix'");
                    $newpn=$maxid+1;
                    $orig_pn = $prefix."_".$newpn;
                }
                $data_pn = array(
                    'subcat_prefix'=>$prefix,
                    'series'=>$newpn
                );
                //print_r($data_pn);//
                $this->super_model->insert_into("pn_series", $data_pn);
                $data_items = array(
                    'item_name'=>$desc,
                    'category_id'=>$cat_id,
                    'subcat_id'=>$subcat_id,
                    'unit_id'=>$unit,
                    'original_pn'=>$orig_pn,
                    'rack_id'=>$rack_id,
                    'group_id'=>$group_id,
                    'warehouse_id'=>$wh_id,
                    'location_id'=>$location_id,
                    'date_uploaded'=>$timestamp,
                    'uploaded_by'=>$_SESSION['user_id']
                );
                //print_r($data_items);//
                $this->super_model->insert_into("items", $data_items);
            } else {
                $data_items = array(
                    'item_name'=>$desc,
                    'category_id'=>$cat_id,
                    'subcat_id'=>$subcat_id,
                    'unit_id'=>$unit,
                    'original_pn'=>$pn,
                    'rack_id'=>$rack_id,
                    'group_id'=>$group_id,
                    'warehouse_id'=>$wh_id,
                    'location_id'=>$location_id,
                    'date_uploaded'=>$timestamp,
                    'uploaded_by'=>$_SESSION['user_id']
                );
              //  print_r($data_items);//
                $this->super_model->insert_into("items", $data_items);
            }
        }
        echo "<script>alert('Successfully uploaded!'); window.location = 'bulk_upload';</script>";
    }

    public function export_current(){
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="current_inventory_format.xlsx";
       
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Item Description");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "Item Description");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "Cat ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "Subcat ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "Subcat Prefix");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "Unit");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "PN No");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', "Rack ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', "Group ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', "WH ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', "Location ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', "Instructions:");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', "Get Cat ID, Subcat CatID and Subcat Prefix in the reference sheet");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M3', "Leave PN No. column blank if there's none, system will generate if empty");
        $num=2;
        foreach($this->super_model->select_all("items") AS $items){
            $prefix =$this->super_model->select_column_where("item_subcat","subcat_prefix", "subcat_id", $items->subcat_id);
            //$unit =$this->super_model->select_column_where("uom","unit_name", "unit_id", $items->unit_id);
            //$rack =$this->super_model->select_column_where("rack","rack_name", "rack_id", $items->rack_id);
            //$group =$this->super_model->select_column_where("groups","group_name", "group_id", $items->group_id);
            //$wh =$this->super_model->select_column_where("warehouse","warehouse_name", "warehouse_id", $items->warehouse_id);
            //$location =$this->super_model->select_column_where("location","location_name", "location_id", $items->location_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $items->item_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$num, $items->item_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $items->category_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$num, $items->subcat_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $prefix);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $items->unit_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$num, $items->original_pn);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$num, $items->rack_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$num, $items->group_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$num, $items->warehouse_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$num, $items->location_id);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);

        $Category = $objPHPExcel->createSheet();
        $Category->setTitle("Category");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A1', "Cat/Subcat ID");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B1', "Category/Subcategory Name");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C1', "Subcategory Prefix");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G1', "Instructions:");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G2', "Highlighted in yellow are the categories");
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G3', "Below are its subcategories");
        $num = 2;
       // $num1=3;
        foreach($this->super_model->select_all("item_categories") AS $cat){
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('f4e542');
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$num, $cat->cat_id);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$num, $cat->cat_name);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num.":C".$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$num)->getFont()->setBold(true);
            foreach($this->super_model->select_row_where("item_subcat","cat_id",$cat->cat_id) AS $sub){
                $num++;
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$num, $sub->subcat_id);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$num, $sub->subcat_name);
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$num, $sub->subcat_prefix);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            } 
            $num++;
        }
        $Rack = $objPHPExcel->createSheet();
        $Rack->setTitle("Rack");
        $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A1', "Rack ID");
        $objPHPExcel->setActiveSheetIndex(2)->setCellValue('B1', "Rack Name");
        $num=2;
        foreach($this->super_model->select_all("rack") AS $rack){
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A'.$num, $rack->rack_id);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('B'.$num, $rack->rack_name);
            $num++;
        }

        $Group = $objPHPExcel->createSheet();
        $Group->setTitle("Group");
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('A1', "Group ID");
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('B1', "Group Name");
            $num=2;
            foreach($this->super_model->select_all("groups") AS $group){
                $objPHPExcel->setActiveSheetIndex(3)->setCellValue('A'.$num, $group->group_id);
                $objPHPExcel->setActiveSheetIndex(3)->setCellValue('B'.$num, $group->group_name);
                $num++;
            }
        $location = $objPHPExcel->createSheet();
        $location->setTitle("Location");
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('A1', "Location ID");
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('B1', "Location Name");
            $num=2;
            foreach($this->super_model->select_all("location") AS $location){
                $objPHPExcel->setActiveSheetIndex(4)->setCellValue('A'.$num, $location->location_id);
                $objPHPExcel->setActiveSheetIndex(4)->setCellValue('B'.$num, $location->location_name);
                $num++;
            }
        $warehouse = $objPHPExcel->createSheet();
        $warehouse->setTitle("Warehouse");
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('A1', "Warehouse ID");
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('B1', "Warehouse Name");
            $num=2;
            foreach($this->super_model->select_all("warehouse") AS $warehouse){
                $objPHPExcel->setActiveSheetIndex(5)->setCellValue('A'.$num, $warehouse->warehouse_id);
                $objPHPExcel->setActiveSheetIndex(5)->setCellValue('B'.$num, $warehouse->warehouse_name);
                $num++;
            }
        $unit = $objPHPExcel->createSheet();
        $unit->setTitle("UOM");
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('A1', "Unit ID");
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('B1', "Unit Name");
            $num=2;
            foreach($this->super_model->select_all("uom") AS $unit){
                $objPHPExcel->setActiveSheetIndex(6)->setCellValue('A'.$num, $unit->unit_id);
                $objPHPExcel->setActiveSheetIndex(6)->setCellValue('B'.$num, $unit->unit_name);
                $num++;
            }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="current_inventory_format.xlsx"');
        readfile($exportfilename);
        echo "<script>window.location = 'bulk_upload';</script>";
    }

    public function upload_excel_current(){
         $dest= realpath(APPPATH . '../uploads/excel/');
         $error_ext=0;
        if(!empty($_FILES['excelfile_cur']['name'])){
             $exc= basename($_FILES['excelfile_cur']['name']);
             $exc=explode('.',$exc);
             $ext1=$exc[1];
            if($ext1=='php' || $ext1!='xlsx'){
                $error_ext++;
            } 
            else {
                 $filename1='current_inventory.'.$ext1;
                if(move_uploaded_file($_FILES["excelfile_cur"]['tmp_name'], $dest.'/'.$filename1)){
                    $this->readExcel_cur();
                }   
            }
        }
    }

    public function readExcel_cur(){
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $inputFileName =realpath(APPPATH.'../uploads/excel/current_inventory.xlsx');
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); 
        for($x=2;$x<=$highestRow;$x++){
            $itemid = trim($objPHPExcel->getActiveSheet()->getCell('A'.$x)->getValue());
            $itemdesc = trim($objPHPExcel->getActiveSheet()->getCell('B'.$x)->getValue());
            $cat = trim($objPHPExcel->getActiveSheet()->getCell('C'.$x)->getValue());
            $subcat = trim($objPHPExcel->getActiveSheet()->getCell('D'.$x)->getValue());
            $prefix = trim($objPHPExcel->getActiveSheet()->getCell('E'.$x)->getValue());
            $unit = trim($objPHPExcel->getActiveSheet()->getCell('F'.$x)->getValue());
            $pn = trim($objPHPExcel->getActiveSheet()->getCell('G'.$x)->getValue());
            $rack = trim($objPHPExcel->getActiveSheet()->getCell('H'.$x)->getValue());
            $group = trim($objPHPExcel->getActiveSheet()->getCell('I'.$x)->getValue());
            $wh = trim($objPHPExcel->getActiveSheet()->getCell('J'.$x)->getValue());
            $location = trim($objPHPExcel->getActiveSheet()->getCell('K'.$x)->getValue());
            $data_items = array(
                'item_name'=>$itemdesc,
                'category_id'=>$cat,
                'subcat_id'=>$subcat,
                'unit_id'=>$unit,
                'original_pn'=>$pn,
                'rack_id'=>$rack,
                'group_id'=>$group,
                'warehouse_id'=>$wh,
                'location_id'=>$location
            );
            $this->super_model->update_where("items", $data_items, "item_id", $itemid);
        }
        echo "<script>alert('Successfully Updated!'); window.location = 'bulk_upload';</script>";
    }

    public function export_begbal(){
        $date = date("Y-m-d");
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $exportfilename="begbal_format.xlsx";
       
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Item ID");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "Item Description");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "Remarks");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "Quantity");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "Part No");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', "Instructions:");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', "Just fill out quantity column. Do not edit other columns.");
        $num=2;
        foreach($this->super_model->select_all("items") AS $items){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $items->item_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$num, $items->item_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, 'begbal');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$num, '');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $items->original_pn);
            $num++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if (file_exists($exportfilename))
        unlink($exportfilename);
        $objWriter->save($exportfilename);
        unset($objPHPExcel);
        unset($objWriter);   
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="begbal_format.xlsx"');
        readfile($exportfilename);
        echo "<script>window.location = 'bulk_upload';</script>";
    }

    public function upload_excel_begbal(){
         $dest= realpath(APPPATH . '../uploads/excel/');
         $error_ext=0;
        if(!empty($_FILES['excelfile_begbal']['name'])){
             $exc= basename($_FILES['excelfile_begbal']['name']);
             $exc=explode('.',$exc);
             $ext1=$exc[1];
            if($ext1=='php' || $ext1!='xlsx'){
                $error_ext++;
            } 
            else {
                 $filename1='beginning_bal.'.$ext1;
                if(move_uploaded_file($_FILES["excelfile_begbal"]['tmp_name'], $dest.'/'.$filename1)){
                    $this->readExcel_begbal();
                }   
            }
        }
    }

    public function readExcel_begbal(){
        require_once(APPPATH.'../assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
        $objPHPExcel = new PHPExcel();
        $inputFileName =realpath(APPPATH.'../uploads/excel/beginning_bal.xlsx');
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); 
        for($x=2;$x<=$highestRow;$x++){
            $itemid = trim($objPHPExcel->getActiveSheet()->getCell('A'.$x)->getValue());
            $catalog = trim($objPHPExcel->getActiveSheet()->getCell('C'.$x)->getValue());
            $qty = trim($objPHPExcel->getActiveSheet()->getCell('D'.$x)->getValue());
            $begbal_date = trim($objPHPExcel->getActiveSheet()->getCell('E'.$x)->getValue());
        if($qty!=''){    
            $data_begbal = array(
                'item_id'=>$itemid,
                'catalog_no'=>$catalog,
                'quantity'=>$qty,
                'begbal_date'=>$begbal_date." ".date("H:i:s"),
                "date_uploaded"=>date("Y-m-d H:i:s"),
                "uploaded_by"=>$_SESSION['user_id'],
            );
            $id= $this->super_model->insert_return_id("begbal", $data_begbal);

            $data_items = array(
                'begbal_id'=>$id,
                'item_id'=>$itemid,
                'catalog_no'=>$catalog,
                'quantity'=>$qty,
                'remaining_qty'=>$qty,
                'expiry_date'=>'',
                'receive_date'=>$begbal_date." ".date("H:i:s"),
            );
            $this->super_model->insert_into("fifo_in", $data_items);
        }
    }
        echo "<script>alert('Successfully uploaded!'); window.location = 'bulk_upload';</script>";
    }

/*        public function insert_signatory(){
        $count = $this->input->post('count');
        for($x=1;$x<$count;$x++){
            $employee_id = $this->input->post('employee_id'.$x);
            $pre_rel = $this->input->post('pre_rel'.$x);
            $received = $this->input->post('received'.$x);
            $verified = $this->input->post('verified'.$x);
            $approved = $this->input->post('approved'.$x);
            if(!empty($pre_rel) || !empty($received) || !empty($verified) || !empty($approved)){
                if(empty($pre_rel)) $pre_rel = 0;
                else $pre_rel=1;
                if(empty($received)) $rec = 0;
                else $rec=1;
                if(empty($verified)) $ver = 0;
                else $ver=1;
                if(empty($approved)) $app = 0;
                else $app=1; 
                $data = array(
                    'employee_id' => $employee_id, 
                    'prepared_released' => $pre_rel,
                    'received' => $rec,
                    'verified' => $ver,
                    'approved' => $app,
                );
                foreach($this->super_model->select_row_where('employees', 'employee_id', $employee_id) AS $empa){   
                    $row=$this->super_model->count_custom_where('signatories',"employee_id = '$empa->employee_id'"); 
                    if($row>0){
                       if($this->super_model->update_where("signatories", $data,'employee_id',$employee_id)){
                            echo "<script>alert('Successfully Updated!'); 
                                window.location ='".base_url()."index.php/masterfile/signatory_list'; </script>"; 
                        }
                    }else{
                        if($this->super_model->insert_into("signatories", $data)){
                           echo "<script>alert('Successfully Added!'); 
                                window.location ='".base_url()."index.php/masterfile/signatory_list'; </script>";
                        }
                    }
                }
            }
        }
    }

    public function signatory_list()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $row=$this->super_model->count_rows("employees");
        if($row != 0){
            foreach($this->super_model->select_all_order_by('employees','employee_name','ASC') AS $sig){
                $employee = $this->super_model->select_column_where("employees", "employee_name", "employee_id", $sig->employee_id);
                $received =$this->super_model->select_column_where("signatories", "received", "employee_id", $sig->employee_id);
                $verified =$this->super_model->select_column_where("signatories", "verified", "employee_id", $sig->employee_id);
                $approved =$this->super_model->select_column_where("signatories", "approved", "employee_id", $sig->employee_id);
                $pre_rel =$this->super_model->select_column_where("signatories", "prepared_released", "employee_id", $sig->employee_id);
                $data['signatory'][] = array(
                    'employee'=>$employee,
                    'received'=>$received,
                    'verified'=>$verified,
                    'approved'=>$approved,
                    'pre_rel'=>$pre_rel,
                );
            }
        }else{
            $data['signatory'] = array();
        }
        $this->load->view('masterfile/signatory_list',$data);
        $this->load->view('template/footer');
    }

    public function signatory_add()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        foreach($this->super_model->select_all_order_by('employees','employee_name','ASC') AS $emp){
                $employee = $this->super_model->select_column_where("employees", "employee_name", "employee_id", $emp->employee_id);
                $pre_rel =$this->super_model->select_column_where("signatories", "prepared_released", "employee_id", $emp->employee_id);
                $received =$this->super_model->select_column_where("signatories", "received", "employee_id", $emp->employee_id);
                $verified =$this->super_model->select_column_where("signatories", "verified", "employee_id", $emp->employee_id);
                $approved =$this->super_model->select_column_where("signatories", "approved", "employee_id", $emp->employee_id);
            
            $data['employee'][] = array(
                'employeeid'=>$emp->employee_id,
                'employee'=>$emp->employee_name,
                'pre_rel'=>$pre_rel,
                'received'=>$received,
                'verified'=>$verified,
                'approved'=>$approved,
            );
        }
        $this->load->view('masterfile/signatory_add',$data);
        $this->load->view('template/footer');
    }*/


    

}