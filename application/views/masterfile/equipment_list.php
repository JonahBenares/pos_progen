<script src="<?php echo base_url(); ?>assets/js/masterfile.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Equipment 
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Equipment List&nbsp;
                        <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                    <!--  <li class="breadcrumb-item"><a href="#">Editors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buyer List</li> -->
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="m-0">Equipment List</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-gradient-primary btn-sm btn-rounded" data-toggle="modal" data-target="#addEquipment">
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
                                    <th width="30%"> Equipment Name </th>
                                    <th width="20%"> Acquisition Cost</th>
                                    <th width="10%"> Daily Rate </th>
                                    <th width="15%"> Hourly Rate </th>
                                    <th width="10%"><center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!empty($equipment)){
                                foreach($equipment AS $eq){ ?>
                                    <tr>
                                        <td><?php echo $eq->equipment_name;?></td>
                                        <td><?php echo number_format(($eq->acquisition_cost),2);?></td>
                                        <td><?php echo number_format(($eq->daily_rate),2);?></td>
                                        <td><?php echo number_format(($eq->hourly_rate),2);?></td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>masterfile/update_equipment/<?php echo $eq->equipment_id; ?>" class="btn btn-gradient-info btn-rounded btn-xs" data-toggle="tooltip" data-placement="top" title="Update">
                                                <span class="mdi mdi-pencil"></span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>index.php/masterfile/delete_equipment/<?php echo $eq->equipment_id;?>" data-toggle="tooltip" data-placement="top" title="Delete" onclick="confirmationDelete(this);return false;" class = "btn btn-gradient-danger btn-rounded btn-xs">
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

        <!-- //Add Supplier// -->
        <div class="modal fade" id="addEquipment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Equipment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/add_equipment">
                            <div class="form-group">
                                <label>Equipment Name</label>
                                <input type="text" class="form-control" name="equipment_name" placeholder="Equipment Name">
                            </div>
                            <div class="form-group">
                                <label>Acquisition Cost</label>
                                <input type="Text" class="form-control" name="acquisition_cost" placeholder="Acquisition Cost">
                            </div>
                            <div class="form-group">
                                <label>Daily Rate</label>
                                <input type="text" class="form-control" name="daily_rate" placeholder="Daily Rate">
                            </div>
                            <div class="form-group">
                                <label>Hourly Rate</label>
                                <input type="text" class="form-control" name="hourly_rate" placeholder="Hourly Rate">
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
        




