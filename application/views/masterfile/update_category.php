        <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_category">
                            <?php foreach($update_category AS $c){ ?>
                            <div class="form-group">
                                <label >Prefix</label>
                                <input type="text" class="form-control" name="prefix" value = "<?php echo $c->cat_prefix; ?>">
                            </div>
                            <div class="form-group">
                                <label >Category Name</label>
                                <input type="text" class="form-control" name="cat_name" value = "<?php echo $c->cat_name; ?>">
                            </div>
                    </div>
                     <input type='hidden' name='cat_id' value='<?php echo $id; ?>'>
                        <center><button type="submit" class="btn btn-primary">Update</button></center>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>