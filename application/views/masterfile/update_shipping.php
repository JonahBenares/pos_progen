<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-import"></i>
                </span> Shipping Company
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>masterfile/client_list">Shipping Company List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Shipping Company</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-info card-img-holder text-white">
                        <h4 class="m-0">Update Shipping Company</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action = "<?php echo base_url();?>masterfile/edit_shipping">
                            <?php foreach($update_shipping AS $ship){ ?>
                            <div class="form-group">
                                <label >Client</label>
                                <input type="text" class="form-control" name="company_name" value = "<?php echo $ship->company_name; ?>">
                            </div>
                            <div class="form-group">
                                <label >Contact Number</label>
                                <input type="text" class="form-control" name="contact_no" value = "<?php echo $ship->contact_no; ?>">
                            </div>
                            <div class="form-group">
                                <label >Address</label>
                                <input type="Text" class="form-control" name="address"value = "<?php echo $ship->address; ?>">
                            </div>
                            <input type = "hidden" name = "ship_comp_id" value="<?php echo $id; ?>">
                            <center><button type="submit" class="btn btn-primary">Update</button></center>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
        

