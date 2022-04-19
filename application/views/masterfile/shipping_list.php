<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/masterfile.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Shipping Company
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Shipping Companyt List &nbsp;
                    <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="m-0">Shipping Company List</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <button type=   "button" class="btn btn-gradient-primary btn-sm btn-rounded" data-toggle="modal" data-target="#addShipping">
                                        <b><span class="mdi mdi-plus"></span> Add</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="myTable">
                             <thead>
                                <tr>
                                    <th width="40%"> Name </th>
                                    <th width="20%"> Contact Number</th>
                                    <th width="10%"> Address </th>
                                    <th width="8%"> <center><span class="mdi mdi-menu"></span> </center> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(!empty($shipping)){
                                    foreach($shipping AS $ship){ ?>
                                    <tr>
                                        <td><?php echo $ship->company_name;?></td>
                                        <td><?php echo $ship->contact_no;?></td>
                                        <td><?php echo $ship->address;?></td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>masterfile/update_shipping/<?php echo $ship->ship_comp_id; ?>" class="btn btn-gradient-info btn-rounded btn-xs" data-toggle="tooltip" data-placement="top" title="Update">
                                                <span class="mdi mdi-pencil"></span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>index.php/masterfile/delete_shipping/<?php echo $ship->ship_comp_id;?>" data-toggle="tooltip" data-placement="top" title="Delete" onclick="confirmationDelete(this);return false;" class = "btn btn-gradient-danger btn-rounded btn-xs">
                                                <span class="mdi mdi-delete"></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } } else { ?>
                                <tr>
                                    <td align="center" colspan='5'><center>No Data Available.</center></td>
                                </tr>
                                <?php } ?>                         
                        </table>
                    </div>
                </div>
            </div>
        </div>

             <div class="modal fade" id="addShipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Shipping Company</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/add_shipping">
                        <div class="modal-body">
                            <div class="form-group">
                                <label >Name</label>
                                <input type="text" class="form-control" name="company_name" placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <label >Contact Number</label>
                                <input type="Text" class="form-control" name="contact_no" placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <label >Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Address">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
        




