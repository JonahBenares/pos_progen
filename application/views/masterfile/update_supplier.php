        <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Supplier</h5>
                        </button>
                    </div>
                     <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_supplier">
                            <?php foreach($update_supplier AS $s){ ?>
                            <div class="form-group">
                                <label>Supplier Code</label>
                                <input type="text" class="form-control" name="supplier_code" value = "<?php echo $s->supplier_code; ?>">
                            </div>
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <input type="Text" class="form-control" name="supplier_name" value = "<?php echo $s->supplier_name; ?>">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" value = "<?php echo $s->address; ?>">
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="contact_number" value = "<?php echo $s->contact_number; ?>">
                            </div>
                            <div class="form-group">
                                <label>Term</label>
                                <input type="text" class="form-control" name="terms" value = "<?php echo $s->terms; ?>">
                            </div>
                            <div class>Status</label>
                                <select class="form-control" type="text" name="active">
                                    <option value = "1" <?php echo (($s->active == '1') ? 'selected' : '');?>>Acive</option>
                                    <option value = "0" <?php echo (($s->active == '0') ? 'selected' : '');?>>Inactive</option>
                                </select>
                            </div>
                    </div>
                     <input type = "hidden" name = "supplier_id" value="<?php echo $id; ?>">
                        <center><button type="submit" class="btn btn-primary">Update</button></center>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>