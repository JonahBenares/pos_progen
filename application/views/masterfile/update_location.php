        <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_location">
                            <?php foreach($update_location AS $l){ ?>
                            <div class="form-group">
                                <label >Location Name</label>
                                <input type="text" class="form-control" name="location_name" value = "<?php echo $l->location_name; ?>">
                            </div>
                    </div>
                     <input type = "hidden" name = "location_id" value="<?php echo $id; ?>">
                        <center><button type="submit" class="btn btn-primary">Update</button></center>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>