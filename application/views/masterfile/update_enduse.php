<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-import"></i>
                </span> Enduse
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>masterfile/enduse_list">Enduse List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Enduse</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-info card-img-holder text-white">
                        <h4 class="m-0">Update Enduse</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_enduse">
                            <?php foreach($update_enduse AS $end){ ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>End-User Code</label>
                                            <input class="form-control" type="text" name="end_code" value="<?php echo $end->enduse_code; ?>">
                                        </div>
                                        <div class="form-group">
                                           <label>End-User Name</label>
                                            <input class="form-control" type="text" name="end_name" value="<?php echo $end->enduse_name; ?>">
                                        </div>
                                        <input type='hidden' name='enduse_id' value='<?php echo $id; ?>'>
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
        
