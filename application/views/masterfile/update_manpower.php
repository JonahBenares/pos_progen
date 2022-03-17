<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-import"></i>
                </span> Manpower
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">Manpower
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>masterfile/manpower_list">Manpower List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Manpower</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-info card-img-holder text-white">
                        <h4 class="m-0">Update Manpower</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_manpower">
                            <?php foreach($update_manpower AS $m){ ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Employee Name</label>
                                            <input type="text" class="form-control" name="employee_name" value = "<?php echo $m->employee_name; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Position</label>
                                            <input type="Text" class="form-control" name="position"value = "<?php echo $m->position; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Daily Rate</label>
                                            <input type="text" class="form-control" name="daily_rate" value = "<?php echo $m->daily_rate; ?>">
                                        </div>
                                        <input type = "hidden" name = "manpower_id" value="<?php echo $id; ?>">
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
        





     