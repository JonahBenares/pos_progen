<script src="<?php echo base_url(); ?>assets/js/masterfile.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Enduse List
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <button type="button" class="btn btn-gradient-primary btn-sm" data-toggle="modal" data-target="#addEnduse">
                            <b><span class="mdi mdi-plus"></span> Add</b>
                        </button>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <button type="button" class="btn btn-gradient-success btn-sm" data-toggle="modal" data-target="#filterEnduse">
                            <b><span class="mdi mdi-filter"></span> Filter</b>
                        </button>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <button type="button" class="btn btn-gradient-warning btn-sm">
                            <b><span class="mdi mdi-export"></span> Export</b>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th width="20%"> Enduse Code</th>
                                    <th width="70%"> Enduse Name</th>
                                    <th width="10%" align="center"> <span class="mdi mdi-menu"></span> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!empty($enduse)){
                                foreach($enduse AS $end){ ?>
                                    <tr>
                                        <td><?php echo $end->enduse_code; ?></td>
                                        <td><?php echo $end->enduse_name; ?></td>
                                        <td width="1%">
                                         <center>
                                             <a onclick="updateEnduse('<?php echo base_url(); ?>','<?php echo $end->enduse_id; ?>')" class="btn btn-custon-three btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                                             <a href = "<?php echo base_url(); ?>index.php/masterfile/delete_enduse/<?php echo $end->enduse_id;?>" onclick="confirmationDelete(this);return false;" class = "btn btn-danger btn-sm" title="DELETE"><span class="fa fa-trash"></span></a>
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

        <!-- //Add Enduse// -->
        <div class="modal fade" id="addEnduse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Enduse</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/add_enduse">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Enduse Code</label>
                                <input type="text" class="form-control" name = "end_code" placeholder="Enduse Code">
                            </div>  
                            <div class="form-group">
                                <label for="exampleInputUsername1">Enduse Name</label>
                                <input type="text" class="form-control" name = "end_name" placeholder="Enduse Name">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- //Filter Enduse// -->
        <div class="modal fade" id="filterEnduse" tabindex="-1" role="dialog" aria-labelledby="filterEnduse" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header success-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Enduse</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Enduse Code</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enduse Code">
                            </div>  
                            <div class="form-group">
                                <label for="exampleInputUsername1">Enduse Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enduse Name">
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

        <!-- //Update Enduse// -->
        <div class="modal fade" id="updateEnduse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header info-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Enduse</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Enduse Code</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enduse Code">
                            </div>  
                            <div class="form-group">
                                <label for="exampleInputUsername1">Enduse Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enduse Name">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Update Enduse</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Delete Enduse// -->
        <div class="modal fade" id="deleteEnduse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content " >
                    <div class="modal-header danger-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Enduse</h5>
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
        




