        <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Purpose</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_purpose">
                            <?php foreach($update_purpose AS $p){ ?>
                            <div class="form-group">
                                <label >Purpose Name</label>
                                <input type="text" class="form-control" name="purpose_desc" value = "<?php echo $p->purpose_desc; ?>">
                            </div>
                    </div>
                     <input type = "hidden" name = "purpose_id" value="<?php echo $id; ?>">
                        <center><button type="submit" class="btn btn-primary">Update</button></center>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>