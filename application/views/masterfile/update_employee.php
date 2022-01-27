        <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Employee/h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/edit_employee">
                            <?php foreach($update_employee AS $e){ ?>
                            <div class="form-group">
                                <label>Employee Name</label>
                                <input type="text" class="form-control" name="employee_name" value = "<?php echo $e->employee_name; ?>">
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="Text" class="form-control" name="position"value = "<?php echo $e->position; ?>">
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" class="form-control" name="department" value = "<?php echo $e->department; ?>">
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="contact_no" value = "<?php echo $e->contact_no; ?>">
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control" name="email" value = "<?php echo $e->email; ?>">
                            </div>
                    </div>
                     <input type = "hidden" name = "employee_id" value="<?php echo $id; ?>">
                        <center><button type="submit" class="btn btn-primary">Update</button></center>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>