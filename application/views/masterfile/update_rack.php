        <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Rack</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_rack">
                            <?php foreach($update_rack AS $r){ ?>
                            <div class="form-group">
                                <label >Rack Name</label>
                                <input type="text" class="form-control" name="rack_name" value = "<?php echo $r->rack_name; ?>">
                            </div>
                    </div>
                     <input type = "hidden" name = "rack_id" value="<?php echo $id; ?>">
                        <center><button type="submit" class="btn btn-primary">Update</button></center>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>