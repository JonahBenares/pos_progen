<script src="<?php echo base_url(); ?>assets/js/repair.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-file-document-box"></i>
                </span> Items 
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Item List&nbsp;
                        <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="m-0">Item List</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>items/add_item" type="button" class="btn btn-gradient-primary btn-sm btn-rounded">
                                        <b><span class="mdi mdi-plus"></span> Add</b>
                                    </a>
                                    <button type="button" class="btn btn-gradient-success btn-sm btn-rounded" data-toggle="modal" data-target="#filterBuyer">
                                        <b><span class="mdi mdi-filter"></span> Filter</b>
                                    </button>                            
                                    <button type="button" class="btn btn-gradient-warning btn-sm btn-rounded" data-toggle="modal" data-target="#updateBuyer">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th width="10%"> OPN </th>
                                    <th width="35%"> Item Description </th>
                                    <th width="5%"> Qty</th>
                                    <th width="5%"> UOM </th>
                                    <th width="10%"> Locationn </th>
                                    <th width="10%"> Rack </th>
                                    <th width="10%"> Highest Cost </th>
                                    <th width="7%"><center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>    
                            <tbody>
                                <?php 
                                
                                foreach($items AS $itm) { ?>
                                <tr>
                                    <td><?php echo $itm['original_pn'];  ?></td>
                                    <td><?php echo $itm['item_name']?></td>
                                    <td><?php echo $itm['quantity']?></td>
                                    <td><?php echo $itm['uom']?></td>
                                    <td><?php echo $itm['location'];?></td>
                                    <td><?php echo $itm['rack'];?></td>
                                    <td><?php echo number_format($itm['highest_cost'],2);?></td>
                                    <td align="center">
                                        <a href="<?php echo base_url(); ?>index.php/items/update_item/<?php echo $itm['item_id'];?>" class="btn btn-xs btn-gradient-info btn-rounded" data-toggle="tooltip" data-placement="top" title="Update"><span class="mdi mdi-pencil"></span></a>
                                        <!-- <a href="<?php echo base_url(); ?>index.php/items/delete_item/<?php echo $itm['item_id'];?>" class="btn btn-xs btn-gradient-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete" onclick="confirmationDelete(this);return false;"><span class="mdi mdi-delete"></span></a> -->
                                        <a  href="<?php echo base_url(); ?>index.php/items/view_item/<?php echo $itm['item_id'];?>" class="btn btn-xs btn-gradient-warning btn-rounded" data-toggle="tooltip" data-placement="top" title="View"><span class="mdi mdi-eye"></span></a>
                                        <!-- <a href="<?php echo base_url(); ?>items/damage_item" class="btn btn-xs btn-gradient-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Damage"><span class="mdi mdi-playlist-remove"></span></a> -->
                                    </td>
                                </tr> 
                                <?php } ?>
                            </tbody>                        
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- //Add Buyer// -->
        <div class="modal fade" id="addBuyer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Buyer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Buyer</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Buyer">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="Text" class="form-control" id="exampleInputEmail1" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact Person</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Contact Person">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Contact Number</label>
                                <input type="text" class="form-control" id="exampleInputConfirmPassword1" placeholder="Contact Number">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Filter Buyer// -->
        <div class="modal fade" id="filterBuyer" tabindex="-1" role="dialog" aria-labelledby="filterBuyer" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header success-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Buyer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Buyer</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Buyer">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="Text" class="form-control" id="exampleInputEmail1" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact Person</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Contact Person">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Contact Number</label>
                                <input type="text" class="form-control" id="exampleInputConfirmPassword1" placeholder="Contact Number">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Update Buyer// -->
        <div class="modal fade" id="updateBuyer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header info-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Buyer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Buyer</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Buyer">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="Text" class="form-control" id="exampleInputEmail1" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact Person</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Contact Person">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Contact Number</label>
                                <input type="text" class="form-control" id="exampleInputConfirmPassword1" placeholder="Contact Number">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Update Buyer</button>
                    </div>
                </div>
            </div>
        </div>

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
        




