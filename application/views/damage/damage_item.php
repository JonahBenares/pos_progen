<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/damage.js"></script>
<script type="text/javascript">
   
function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
$(document).bind("keydown", disableF5);
$(document).on("keydown", disableF5);

</script>
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
                    <div class="card-header bg-gradient-danger card-img-holder text-white"></div>
                    <div class="card-body">       
                        <form id='damageHead'>     
                        <div class="row">
                        <?php
                            $pdrdate=date('Y-m');
                            $year=date('Y');
                            $series_rows = $this->super_model->count_custom_where("damage_head","damage_date LIKE '%$year%'");
                            if($series_rows==0){
                                $pdr_no= "PDR-".$pdrdate."-0001";
                            } else {
                                $pdr_max = $this->super_model->get_max_where("damage_head", "pdr_no","damage_date LIKE '%$year%'");
                                $pdr_exp=explode("-", $pdr_max);
                                $series = $pdr_exp[3]+1;
                                //echo $pdr_max;
                                //$nxts = str_pad($series, 4, "0", STR_PAD_LEFT);
                                if(strlen($series)==1){
                                    $pdr_no = "PDR-".$pdrdate."-000".$series;
                                } else if(strlen($series)==2){
                                     $pdr_no = "PDR-".$pdrdate."-00".$series;
                                } else if(strlen($series)==3){
                                     $pdr_no = "PDR-".$pdrdate."-0".$series;
                                } else if(strlen($series)==4){
                                     $pdr_no = "PDR-".$pdrdate."-".$series;
                                }
                                //$pdr_no = "PDR-".$pdrdate."-".$nxts;

                            }  ?>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>PDR No</label>
                                    <input type="text" class="form-control" name="pdr_no" id="pdr_no" placeholder="<?php echo $pdr_no; ?>" value="<?php echo $pdr_no; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" placeholder="Date" name='damage_date' id='damage_date'>
                                </div>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Item</label>
                                    <select class="form-control select2" name='item' id='item'>
                                        <option>-Select Item-</option>
                                        <?php foreach($item AS $i){ ?>
                                            <option value="<?php echo $i->item_id; ?>"><?php echo $i->original_pn." - ".$i->item_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Reported by</label>
                                            <input type="text" class="form-control" name="reported_by" id="reported_by" placeholder="Reported by">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date/Time Reported</label>
                                            <input type="datetime-local" class="form-control" placeholder="Date/Time Reported" name='reported_date' id='reported_date'>
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
                                    <select class="form-control select2" name="accounted_to" id="accounted_to">
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
                                    <select class="form-control select2" name="person_using" id="person_using">
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
                                    <textarea class="form-control" rows="3" placeholder="Description of the Damaged on the Item" name="damage_description" id="damage_description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Reason of Damage</label>
                                    <textarea class="form-control" rows="3" name="damage_reason" id="damage_reason" placeholder="Reason of Damage"></textarea>
                                </div>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Inspected by</label>
                                    <select class="form-control select2" name="inspected_by" id="inspected_by">
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
                                    <input type="date" class="form-control" placeholder="" name='date_inspected' id='date_inspected'>
                                </div>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-lg-9">
                              <div class="form-group">
                                    <label>Provide a recommendation on how the parts/equipment is going to be repaired or replaced</label>
                                    <textarea class="form-control" rows="1" placeholder="Provide a recommendation on how the parts/equipment is going to be repaired or replaced" name="recommendation" id="recommendation"></textarea>
                                </div>  
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Prepared by</label>
                                    <select class="form-control select2" name="prepared_by" id="prepared_by">
                                        <option value=''>--Select Prepared By--</option>
                                        <?php foreach($employees AS $e){ ?>
                                            <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Notes</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="2" placeholder=" Notes" name='notes' id='notes'></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="exampleTextarea1"></label>
                                        <div class="form-group">
                                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                            <input type='button' id="proceed_damage" class="btn btn-gradient-success btn-fw pull-right btn-sm" value="Proceed" onclick="loadTransactions()">
                                            <input type='button' class="btn btn-gradient-danger btn-fw pull-right btn-sm" id="cancel_damage" onclick="canceled_damage()" value="Cancel Transaction" style='display: none;font-size: 10px;'>
                                        </div>
                                    </div>
                                </div>  
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Checked/Verified by</label>
                                    <select class="form-control select2" name="checked_by" id="checked_by">
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
                                    <select class="form-control select2" name="noted_by" id="noted_by">
                                        <option value=''>--Select Noted By--</option>
                                        <?php foreach($employees AS $e){ ?>
                                            <option value="<?php echo $e->employee_id; ?>"><?php echo $e->employee_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea class="form-control" rows="1" placeholder="" name="notes" id="notes"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleTextarea1"></label>
                                <div class="form-group">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <input type='button' id="proceed_damage" class="btn btn-gradient-success btn-fw pull-right btn-sm btn-block" value="Proceed" onclick="loadTransactions()">
                                    <input type='button' class="btn btn-gradient-danger btn-fw pull-right btn-sm btn-block" id="cancel_damage" onclick="canceled_damage()" value="Cancel Transaction" style='display: none;'>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div id="loadTransactions">
                            <hr>
                            <br>
                            <form id='damageDetails'>
                            <div class="row">
                                <div class="col-lg-12">
                                   <!-- <div class="form-group">
                                        
                                        <a class="btn btn-gradient-danger btn-sm">
                                            <span class="mdi mdi-close"></span>
                                        </a>
                                    </div> -->
                                    <table width="100%" class="table-bordered" id='damage'>
                                        <tr>
                                            <td class="font14" width="30%">Transactions</td>
                                            <td class="font14" width="7%">Quantity</td>
                                            <td class="font14" width="10%">Brand</td>
                                            <td class="font14" width="10%">Serial No.</td>
                                            <td class="font14" width="10%">Part No.</td>
                                            <td class="font14" width="10%">Accquisition Date</td>
                                            <td class="font14" width="10%">Accquisition Cost</td>
                                            <td class="font14" width="1%" align="center">
                                                <a class="btn btn-gradient-info btn-xs" id='add' onclick="add_transaction()">
                                                    <span class="mdi mdi-plus"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>

                                    <input type='hidden' name='count' id='count' value='0'>
                                    <input type='hidden' name='damage_id' id='damage_id' >
                                    <input type='hidden' name='item_id' id='item_id' >
                                </div>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>        
        <br> 
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <input type='hidden' name='baseurl' id='baseurl' value='<?php echo base_url(); ?>'>
                <input type='button' id="savedamage" class="btn btn-gradient-success btn-md btn-block" value='Save Transaction' onclick='saveDamage()'>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</form>
</div>
        





