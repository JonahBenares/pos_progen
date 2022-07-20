<?php $ci =& get_instance(); ?>
<style type="text/css">
    
</style>
<div class="container-scroller">
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="<?php echo base_url(); ?>masterfile/dashboard" target="_blank"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="<?php echo base_url(); ?>masterfile/dashboard" target="_blank"><img src="<?php echo base_url(); ?>assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <div class="search-field d-none d-md-block">
                <form class="d-flex align-items-center h-100" action="#">
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                  </div>
                </form>
            </div>
            <ul class="navbar-nav navbar-nav-right">     
                <li class="nav-item d-none d-lg-block ">
                    <a href="<?php echo base_url(); ?>masterfile/bulk_upload" class="nav-link" data-toggle="tooltip" data-placement="left" data-custom-class="tooltip-info" title="" data-original-title="Bulk Upload">
                        <i class="mdi mdi-upload"></i>
                    </a>
                </li>           
                <li class="nav-item d-none d-lg-block full-screen-link">
                    <a class="nav-link">
                        <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        <?php  $count = $ci->super_model->count_rows_where("billing_adjustment_history", "status", 0); 
                        $count_damage=0;
                         foreach($this->super_model->custom_query("SELECT * FROM return_details rd INNER JOIN return_head rh ON rd.return_id=rh.return_id WHERE damage_qty!='0'") AS $rd){
                            $count_return_damage=$this->super_model->count_rows_where("damage_details","return_id",$rd->return_id);
                            if($count_return_damage==0){
                                $count_damage++;
                            }
                        }
                       // $count_damage = $ci->super_model->count_custom("SELECT * FROM return_details rd INNER JOIN return_head rh ON rd.return_id=rh.return_id WHERE damage_qty!='0'");
                        if($count!=0  || $count_damage!=0){ ?>
                        <span class="count-symbol bg-danger"></span>
                        <?php } ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        <h6 class="p-3 mb-0">Notifications</h6>

                        <?php foreach($this->super_model->select_row_where("billing_adjustment_history", "status", 0) AS $hist){ ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item" href='javascript:void(0)' onclick="bs_adjustment_redirect('<?php echo base_url(); ?>','<?php echo $hist->billing_id; ?>')">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-danger">
                                        <i class="mdi mdi-alert"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 style="color: #f36380;" class="preview-subject font-weight-normal mb-1">BS Adjustment</h6>
                                    <p class="text-gray ellipsis mb-0" > <?php echo $hist->remarks; ?> </p>
                                </div>
                            </a>
                        <?php } ?>
                        <?php 
                            foreach($this->super_model->custom_query("SELECT * FROM return_details rd INNER JOIN return_head rh ON rd.return_id=rh.return_id WHERE damage_qty!='0'") AS $rd){
                            $count_return_damage=$this->super_model->count_rows_where("damage_details","return_id",$rd->return_id);
                            if($count_return_damage==0){ 
                        ?>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="javascript:void(0)"  onclick="return_damage_redirect('<?php echo base_url(); ?>','<?php echo $rd->return_id; ?>')">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-danger">
                                    <i class="mdi mdi-alert"></i>
                                </div>
                            </div>
                            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 style="color: #f36380;" class="preview-subject font-weight-normal mb-1">Process Returned w/ Damage</h6>
                                <p class="text-gray ellipsis mb-0">Fill in <?php echo $rd->dr_no; ?> Return Damage Form </p>
                            </div>
                        </a>
                        <?php } } ?>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="<?php echo base_url(); ?>assets/images/faces/face1.jpg" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black"><?php echo $_SESSION['fullname'];?></p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/masterfile/user_logout">
                            <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="<?php echo base_url(); ?>masterfile/dashboard" class="nav-link">
                        <div class="nav-profile-image">
                            <img src="<?php echo base_url(); ?>assets/images/logo/progen_logo.png" alt="profile">
                            <span class="login-status online"></span>
                        </div>
                        <div class="nav-profile-text d-flex flex-column">
                            <span class="font-weight-bold mb-2">PROGEN</span>
                            <span class="text-secondary text-small">Bago Plant Site</span>
                        </div>
                        <!-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>masterfile/dashboard">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#masterfilelist" aria-expanded="false" aria-controls="masterfilelist">
                        <span class="menu-title">Masterfile</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-apps menu-icon"></i>
                    </a>
                    <div class="collapse" id="masterfilelist">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/bin_list')" >Bin</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/client_list')">Client</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/department_list')">Department</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/employee_list')" >Employees</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/equipment_list')" >Equipment</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/group_list')" >Group</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link"  href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/category_list')" >Item Category</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link"  href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/location_list')" >Location</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link"  href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/manpower_list')">Manpower</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link"  href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/purpose_list')" >Purpose</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link"  href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/rack_list')" >Rack</a>
                            </li>
                            <!-- <li class="nav-item"> 
                                <a class="nav-link"  href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/signatory_list')">Signatories</a>
                            </li> -->
                            <li class="nav-item"> 
                                <a class="nav-link"  href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/shipping_list')">Shipping Company</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link"  href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/supplier_list')" >Supplier</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link"  href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/uom_list')" >UOM</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link"  href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'masterfile/warehouse_list')" >Warehouse</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'items/item_list')" >
                        <span class="menu-title">Items</span>
                        <i class="mdi mdi-file-document-box menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'damage/damage_list')">
                        <span class="menu-title">Damage</span>
                        <i class="mdi mdi-image-broken-variant menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'repair/repair_item')" >
                        <span class="menu-title">Repair</span>
                        <i class="mdi mdi-wrench menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'receive/receive_list')" >
                        <span class="menu-title">Receive</span>
                        <i class="mdi mdi-import menu-icon"></i>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>sales/sales_list">
                        <span class="menu-title">Sales</span>
                        <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#sales_list" aria-expanded="false" aria-controls="sales_list">
                        <span class="menu-title">Sales</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    </a>
                    <div class="collapse" id="sales_list">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'sales/goods_sales_list')">Goods</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'sales/services_sales_list')">Services</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'sales_backorder/backorder_form')" >
                        <span class="menu-title">Sales Back Order</span>
                        <i class="mdi mdi-backup-restore menu-icon"></i>
                    </a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'returns/return_goods_services')" >
                        <span class="menu-title">Return</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-sync menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#reportlist" aria-expanded="false" aria-controls="reportlist">
                        <span class="menu-title">Reports</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-apps menu-icon"></i>
                    </a>
                    <div class="collapse" id="reportlist">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> 
                                <p class="nav-subtitle">Billing Statement</p>
                            </li>
                             <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/pending_list')" >Pending</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/billed_list')" >Billed</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/paid_list')" >Paid</a>
                            </li>
                            <li class="nav-item"> 
                                <hr>
                            </li>

                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/stock_card')" >Stock Card</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/monthly_report')" >Monthly Report</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/summary_scgp')" >Summary of SCGP</a>
                            </li>
                             <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/item_pr')" >Item PR</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/overallpr_report')" >Overall PR Report</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/aging_report')" >Aging Report</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/inventory_rangedate')" >Inventory (Per Range of Date)</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/expired_inventory')" >Expired Inventory</a>
                            </li>
                           <!--  <li class="nav-item"> 
                                <a class="nav-link" href="javascript:void(0)" onclick="checkURL('<?php echo base_url(); ?>', 'reports/sales_backorder')" >Sales Backorder</a>
                            </li> -->
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        