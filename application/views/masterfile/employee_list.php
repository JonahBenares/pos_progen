<script src="<?php echo base_url(); ?>assets/js/masterfile.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Employees List
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <button type="button" class="btn btn-gradient-primary btn-sm" data-toggle="modal" data-target="#addEmployee">
                            <b><span class="mdi mdi-plus"></span> Add</b>
                        </button>
                    </li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">
                        <button type="button" class="btn btn-gradient-success btn-sm" data-toggle="modal" data-target="#filterEmployee">
                            <b><span class="mdi mdi-filter"></span> Filter</b>
                        </button>
                    </li>
                    <?php if(!empty($filt)){ ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a type="button" class="btn btn-gradient-warning btn-sm" href="<?php echo base_url(); ?>index.php/Masterfile/export_employee_list/<?php echo $employee_name;?>/<?php echo $position;?>/<?php echo $department;?>/<?php echo $contact_no;?>/<?php echo $email;?>" >
                            <b><span class="mdi mdi-export"></span> Export</b>
                        </a>
                    </li>
                    <?php } else { ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a type="button" class="btn btn-gradient-warning btn-sm" href="<?php echo base_url(); ?>index.php/masterfile/export_employee_list">
                            <b><span class="mdi mdi-export"></span> Export</b>
                        </a>
                    </li> 
                    <?php } ?> -->
                </ul>
            </nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Employees &nbsp;
                        <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                    <!--  <li class="breadcrumb-item"><a href="#">Editors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buyer List</li> -->
                </ol>
            </nav>          
        </div>
        <!-- <?php if(!empty($filt)){ ?>     
        <span class='btn btn-success disabled'>Filter Applied</span><?php echo $filt ?>, <a href='<?php echo base_url(); ?>index.php/masterfile/employee_list/' class='remove_filter alert-link pull-right btn'><span class="fa fa-times"></span></a>
        <?php } ?> --> 
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="main-button-center">
                            <button type="button" class="btn btn-gradient-success btn-sm" data-toggle="modal" data-target="#filterEmployee">
                                <b><span class="mdi mdi-filter"></span> Filter</b>
                            </button>
                            <button type="button" class="btn btn-gradient-primary btn-md" data-toggle="modal" data-target="#addEmployee">
                                <b><span class="mdi mdi-plus"></span> Add</b>
                            </button>
                            <button type="button" class="btn btn-gradient-warning btn-sm">
                                <b><span class="mdi mdi-export"></span> Export</b>
                            </button>
                        </div>
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th width="30%"> Employee Name </th>
                                    <th width="20%"> Position</th>
                                    <th width="15%"> Department </th>
                                    <th width="10%"> Contact No. </th>
                                    <th width="15%"> Email Address</th>
                                    <th width="10%" align="center"> <span class="mdi mdi-menu"></span> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(!empty($employees)){
                                        foreach($employees AS $emp){ ?>
                                <td><?php echo $emp->employee_name;?></td>
                                <td><?php echo $emp->position;?></td>
                                <td><?php echo $emp->department;?></td>
                                <td><?php echo $emp->contact_no;?></td>
                                <td><?php echo $emp->email;?></td>
                                <td width="1%">
                                         <center>
                                             <a onclick="updateEmployee('<?php echo base_url(); ?>','<?php echo $emp->employee_id; ?>')" class="btn btn-custon-three btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                                             <a href = "<?php echo base_url(); ?>index.php/masterfile/delete_employee/<?php echo $emp->employee_id;?>" onclick="confirmationDelete(this);return false;" class = "btn btn-danger btn-sm" title="DELETE"><span class="fa fa-trash"></span></a>
                                         </center>
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                <tr>
                                    <td align="center" colspan='9'><center>No Data Available.</center></td>
                                </tr>
                                <?php } ?>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Add Employee Name// -->
        <div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/add_employee">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <input type="text" class="form-control" name="employee_name" placeholder="Employee Name">
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control" name="position" placeholder="Position">
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" class="form-control" name="department" placeholder="Department">
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="contact_no" placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control" name="email" placeholder="Email Address">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- //Filter Employee Name// -->
        <div class="modal fade" id="filterEmployee" tabindex="-1" role="dialog" aria-labelledby="filterEmployee Name" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header success-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/search_employee">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <input type="text" class="form-control" name="employee_name" placeholder="Employee Name">
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control" name="position" placeholder="Position">
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" class="form-control" name="department" placeholder="Department">
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="contact_no" placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control" name="email" placeholder="Email Address">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Filter</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                     </form>
                </div>
            </div>
        </div>

        <!-- //Update Employee Name// 
        <div class="modal fade" id="updateEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header info-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Employee Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Employee Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Position</label>
                                <input type="Text" class="form-control" id="exampleInputEmail1" placeholder="Position">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Department</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Contact Number</label>
                                <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Email Address</label>
                                <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Update Employee Name</button>
                    </div>
                </div>
            </div>
        </div>-->

        <!-- //Delete Employee Name// -->
        <div class="modal fade" id="deleteEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content " >
                    <div class="modal-header danger-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <br>
                        <br>
                        <center>Do you want to delete _________?</center>
                        <br>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
        




