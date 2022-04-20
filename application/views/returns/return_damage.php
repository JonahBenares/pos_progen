<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/damage.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-danger text-white mr-2">
                  <i class="mdi mdi-image-broken-variant"></i>
                </span>Damage Item
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>damage/damage_list">Damage list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Damage Item</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-danger card-img-holder text-white p-2"></div>
                    <div class="card-body">       
                        <form id='damageHead'>     
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                    <button class="btn btn-md btn-danger btn-block"><h3 class="m-0"><b>01</b></h3></button>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control" placeholder="Date" name='damage_date' id='damage_date'>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>PDR No</label>
                                        <input type="text" class="form-control" name="pdr_no" placeholder="PDR No">
                                    </div>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Item</label>
                                        <h4><b>Sample Name</b></h4>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Reported by</label>
                                                <input type="text" class="form-control" name="reported_by" placeholder="Reported by">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Date/Time Reported</label>
                                                <input type="datetime-local" class="form-control" placeholder="Date/Time Reported" name='reported_date' id=''>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Accounted to</label>
                                        <!-- <input type="text" class="form-control" name="accounted_to" placeholder="Accounted to"> -->
                                        <select class="form-control select2" name="accounted_to">
                                            <option value=''>--Select Accounted--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Person using upon damage</label>
                                        <!--  <input type="text" class="form-control" name="person_using" placeholder="Person using upon damage"> -->
                                        <select class="form-control select2" name="person_using">
                                            <option value=''>--Select Person Using--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Description of the Damaged on the Item</label>
                                        <textarea class="form-control" rows="3" placeholder="Description of the Damaged on the Item" name="damage_description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Reason of Damage</label>
                                        <textarea class="form-control" rows="3" name="damage_reason" placeholder="Reason of Damage"></textarea>
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Inspected by</label>
                                        <select class="form-control select2" name="inspected_by">
                                            <option value=''>--Select Person Using--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date Inspected</label>
                                        <input type="date" class="form-control" placeholder="" name='date_inspected' id=''>
                                    </div>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-lg-9">
                                  <div class="form-group">
                                        <label>Provide a recommendation on how the parts/equipment is going to be repaired or replaced</label>
                                        <textarea class="form-control" rows="1" placeholder="Provide a recommendation on how the parts/equipment is going to be repaired or replaced" name="recommendation"></textarea>
                                    </div>  
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Prepared by</label>
                                        <select class="form-control select2" name="prepared_by">
                                            <option value=''>--Select Prepared By--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Checked/Verified by</label>
                                        <select class="form-control select2" name="checked_by">
                                            <option value=''>--Select Checked/Verified By--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Noted by</label>
                                        <select class="form-control select2" name="noted_by">
                                            <option value=''>--Select Noted By--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea class="form-control" rows="1" placeholder="" name="notes"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
        <br> 
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-danger card-img-holder text-white p-2"></div>
                    <div class="card-body">       
                        <form id='damageHead'>     
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                    <button class="btn btn-md btn-danger btn-block"><h3 class="m-0"><b>02</b></h3></button>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control" placeholder="Date" name='damage_date' id='damage_date'>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>PDR No</label>
                                        <input type="text" class="form-control" name="pdr_no" placeholder="PDR No">
                                    </div>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Item</label>
                                        <h4><b>Sample Name</b></h4>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Reported by</label>
                                                <input type="text" class="form-control" name="reported_by" placeholder="Reported by">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Date/Time Reported</label>
                                                <input type="datetime-local" class="form-control" placeholder="Date/Time Reported" name='reported_date' id=''>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Accounted to</label>
                                        <!-- <input type="text" class="form-control" name="accounted_to" placeholder="Accounted to"> -->
                                        <select class="form-control select2" name="accounted_to">
                                            <option value=''>--Select Accounted--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Person using upon damage</label>
                                        <!--  <input type="text" class="form-control" name="person_using" placeholder="Person using upon damage"> -->
                                        <select class="form-control select2" name="person_using">
                                            <option value=''>--Select Person Using--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Description of the Damaged on the Item</label>
                                        <textarea class="form-control" rows="3" placeholder="Description of the Damaged on the Item" name="damage_description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Reason of Damage</label>
                                        <textarea class="form-control" rows="3" name="damage_reason" placeholder="Reason of Damage"></textarea>
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Inspected by</label>
                                        <select class="form-control select2" name="inspected_by">
                                            <option value=''>--Select Person Using--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date Inspected</label>
                                        <input type="date" class="form-control" placeholder="" name='date_inspected' id=''>
                                    </div>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-lg-9">
                                  <div class="form-group">
                                        <label>Provide a recommendation on how the parts/equipment is going to be repaired or replaced</label>
                                        <textarea class="form-control" rows="1" placeholder="Provide a recommendation on how the parts/equipment is going to be repaired or replaced" name="recommendation"></textarea>
                                    </div>  
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Prepared by</label>
                                        <select class="form-control select2" name="prepared_by">
                                            <option value=''>--Select Prepared By--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Checked/Verified by</label>
                                        <select class="form-control select2" name="checked_by">
                                            <option value=''>--Select Checked/Verified By--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Noted by</label>
                                        <select class="form-control select2" name="noted_by">
                                            <option value=''>--Select Noted By--</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea class="form-control" rows="1" placeholder="" name="notes"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <input type='hidden' name='baseurl' id='baseurl' value='<?php echo base_url(); ?>'>
                <a href="<?php echo base_url(); ?>returns/return_damage_print" class="btn btn-gradient-success btn-md btn-block">Save and Print</a>
                <!-- <input type='button' id="savedamage" class="btn btn-gradient-success btn-md btn-block" value='Save Transaction' onclick='saveDamage()'> -->
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</form>
</div>
        





