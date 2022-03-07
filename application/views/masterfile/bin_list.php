<script src="<?php echo base_url(); ?>assets/js/masterfile.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Bin
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Bin List &nbsp;
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
                                <h4 class="m-0">Bin List</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-gradient-primary btn-sm btn-rounded" data-toggle="modal" data-target="#addBin">
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
                                    <th width="90%"> Bin Name </th>
                                    <th width="10%"> <center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>
                             <tbody>
                                <?php 
                                if(!empty($bin)){
                                foreach($bin AS $b){ ?>
                                    <tr>
                                        <td><?php echo $b->bin_name;?></td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>masterfile/update_bin/<?php echo $b->bin_id; ?>" class="btn btn-gradient-info btn-rounded btn-xs" data-toggle="tooltip" data-placement="top" title="Update">
                                                <span class="mdi mdi-pencil"></span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>index.php/masterfile/delete_bin/<?php echo $b->bin_id;?>" data-toggle="tooltip" data-placement="top" title="Delete" onclick="confirmationDelete(this);return false;" class = "btn btn-gradient-danger btn-rounded btn-xs">
                                                <span class="mdi mdi-delete"></span>
                                            </a>
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

        <!-- //Add UOM// -->
        <div class="modal fade" id="addBin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Bin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/add_bin">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Bin Name</label>
                                <input type="text" class="form-control" name="bin_name" placeholder="Bin">
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

        <!-- //Filter UOM// -->
        <div class="modal fade" id="filterBin" tabindex="-1" role="dialog" aria-labelledby="filterBin" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header success-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Bin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Bin</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Bin">
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

        <!-- //Update UOM// -->
        <div class="modal fade" id="updateBin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header info-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Bin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Bin Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Bin">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Update Bin</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Delete UOM// -->
        <div class="modal fade" id="deleteBin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content " >
                    <div class="modal-header danger-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Bin</h5>
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
        




