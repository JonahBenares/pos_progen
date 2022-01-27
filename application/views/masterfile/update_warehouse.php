        <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Warehouse</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_warehouse">
                            <?php foreach($update_warehouse AS $wh){ ?>
                            <div class="form-group">
                                <label >Warehouse Name</label>
                                <input type="text" class="form-control" name="warehouse_name" value = "<?php echo $wh->warehouse_name; ?>">
                            </div>
                    </div>
                     <input type = "hidden" name = "warehouse_id" value="<?php echo $id; ?>">
                        <center><button type="submit" class="btn btn-primary">Update</button></center>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>