<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/return.js"></script>
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
        <form id='ReturnDamage'>
            <?php 
            $x=1;
            foreach($details AS $d){ 
            for($y=1;$y<=$d['damage_qty'];$y++){    
            ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-danger card-img-holder text-white p-2"></div>
                    <div class="card-body">       
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                    <button class="btn btn-md btn-danger btn-block"><h3 class="m-3"><b><?php echo $x;?><br></b></h3></button>

                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Item</label>
                                        <h4><b><?php echo $d['item_name'] ?></b></h4>
                                        <label class="m-0">Brand: <b><?php echo $d['brand'] ?></b> </label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <br>
                                        <label >Serial No: <b><?php echo $d['serial_no'] ?></b> </label>
                                        <br>
                                        <label >Part No: <b><?php echo $d['part_no'] ?></b> </label>
                                    </div>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="date" class="form-control" placeholder="Date" name="damage_date<?php echo $x; ?>" id='damage_date'>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PDR No</label>
                                                <input type="text" class="form-control" name="pdr_no<?php echo $x; ?>" placeholder="PDR No">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Reported by</label>
                                                <input type="text" class="form-control" name="reported_by<?php echo $x; ?>" placeholder="Reported by">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Date/Time Reported</label>
                                                <input type="datetime-local" class="form-control" placeholder="Date/Time Reported" name="reported_date<?php echo $x; ?>" id=''>
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
                                        <select class="form-control select2" name="accounted_to<?php echo $x; ?>">
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
                                        <select class="form-control select2" name="person_using<?php echo $x; ?>">
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
                                        <textarea class="form-control" rows="3" placeholder="Description of the Damaged on the Item" name="damage_description<?php echo $x; ?>"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Reason of Damage</label>
                                        <textarea class="form-control" rows="3" name="damage_reason<?php echo $x; ?>" placeholder="Reason of Damage"></textarea>
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Inspected by</label>
                                        <select class="form-control select2" name="inspected_by<?php echo $x; ?>">
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
                                        <input type="date" class="form-control" placeholder="" name="date_inspected<?php echo $x; ?>" id=''>
                                    </div>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-lg-9">
                                  <div class="form-group">
                                        <label>Provide a recommendation on how the parts/equipment is going to be repaired or replaced</label>
                                        <textarea class="form-control" rows="1" placeholder="Provide a recommendation on how the parts/equipment is going to be repaired or replaced" name="recommendation<?php echo $x; ?>"></textarea>
                                    </div>  
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Prepared by</label>
                                        <select class="form-control select2" name="prepared_by<?php echo $x; ?>">
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
                                        <select class="form-control select2" name="checked_by<?php echo $x; ?>">
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
                                        <select class="form-control select2" name="noted_by<?php echo $x; ?>">
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
                                        <textarea class="form-control" rows="1" placeholder="" name="remarks<?php echo $x; ?>" id="notes"></textarea>
                                    </div>
                                </div>
                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                            <input type="hidden" name="in_id<?php echo $x;?>" value = "<?php echo $d['in_id'];?>">
                            <input type="hidden" name="return_id<?php echo $x;?>" value = "<?php echo $d['return_id'];?>">
                            <input type="hidden" name="item<?php echo $x;?>" value = "<?php echo $d['item_id'];?>">
                            <input type="hidden" name="brand<?php echo $x;?>" value = "<?php echo $d['brand'];?>">
                            <input type="hidden" name="serial_no<?php echo $x;?>" value = "<?php echo $d['serial_no'];?>">
                            <input type="hidden" name="part_no<?php echo $x;?>" value = "<?php echo $d['part_no'];?>">
                            <input type="hidden" name="receive_date<?php echo $x;?>" value = "<?php echo $d['receive_date'];?>">
                            <input type="hidden" name="item_cost<?php echo $x;?>" value = "<?php echo number_format($d['item_cost'],2);?>">
                            <input type="hidden" name="damage_qty<?php echo $x;?>" value = "<?php echo $d['damage_qty'];?>">
                            <input type="hidden" name="user_id" value = "<?php echo $_SESSION['user_id'];?>">
                            </div>
                    </div>
                </div>
            </div>
        </div>        
        <br>
        <?php $x++; } } //}?>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <input type="hidden" id="count" name="count" class="form-control" value = "<?php echo $x;?>">
                <input type="button" id="saved" name="submit" class="btn btn-gradient-success btn-md btn-block" value = "Save and Print" onclick="saveReturnDamage(this);return false;">
            </div>
            <div class="col-lg-4"></div>
        </div>
        </form> 
    </div>
</div>
        





