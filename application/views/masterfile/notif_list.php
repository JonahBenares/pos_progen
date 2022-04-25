<script src="<?php echo base_url(); ?>assets/js/masterfile.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Notifications
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Notification List &nbsp;
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
                                <h4 class="m-0">Notification List</h4>
                            </div>
                            <div class="col-lg-6">
                               <!--  <div class="pull-right">
                                    <button type="button" class="btn btn-gradient-primary btn-sm btn-rounded" data-toggle="modal" data-target="#addBin">
                                        <b><span class="mdi mdi-plus"></span> Add</b>
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th width="7%"> Adjustment Date </th>
                                    <th width="7%"> Billing No </th>
                                    <th width="7%"> DR No </th>
                                    <th width="15%"> Remarks </th>
                                    <th width="1%"> <center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>
                             <tbody>
                                <?php foreach($adjustments AS $adj){  ?>
                                <tr>
                                    <td><?php echo $adj->adjustment_date; ?></td>
                                    <td><?php echo $adj->billing_no; ?></td>
                                    <td><?php echo $adj->dr_no; ?></td>
                                    <td><?php echo $adj->remarks; ?></td>
                                    <td><a style='font-size: 11px' href="<?php echo base_url(); ?>reports/adjustment_list/<?php echo $adj->billing_id; ?>" target="_blank" class="btn btn-primary btn-xs btn-rounded">Billing</a></td>
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


    </div>
</div>
        




