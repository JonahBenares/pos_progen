<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-import"></i>
                </span> Equipment
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>masterfile/equipment_list">Equipment List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Equipment</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-info card-img-holder text-white">
                        <h4 class="m-0">Update Equipment</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_equipment">
                            <?php foreach($update_equipment AS $e){ ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Equipment Name</label>
                                            <input type="Text" class="form-control" name="equipment_name" value = "<?php echo $e->equipment_name; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Acquisition Cost</label>
                                            <input type="text" class="form-control" name="acquisition_cost" value = "<?php echo $e->acquisition_cost; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Daily Rate</label>
                                            <input type="text" class="form-control" name="daily_rate" value = "<?php echo $e->daily_rate; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Hourly Rate</label>
                                            <input type="text" class="form-control" name="hourly_rate" value = "<?php echo $e->hourly_rate; ?>">
                                        </div>
                                        <input type = "hidden" name = "equipment_id" value="<?php echo $id; ?>">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
        