        <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Buyer</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_enduse">
                            <?php foreach($update_enduse AS $end){ ?>
                            <div class="form-group">
                                <label>End-User Code</label>
                                <input class="form-control" type="text" name="end_code" value="<?php echo $end->enduse_code; ?>">
                            </div>
                            <div class="form-group">
                               <label>End-User Name</label>
                                <input class="form-control" type="text" name="end_name" value="<?php echo $end->enduse_name; ?>">
                            </div>
                    </div>
                     <input type='hidden' name='enduse_id' value='<?php echo $id; ?>'>
                        <center><button type="submit" class="btn btn-primary">Update</button></center>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>