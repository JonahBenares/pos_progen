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
            }
            $newdata = array(
               'user_id'=> $userid,
               //'usertype'=> $usertype,
               'username'=> $username,
               'fullname'=> $fullname,
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
        $repair_url = $base.'repair/repair_form';
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
         


    

}