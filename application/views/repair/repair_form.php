<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/repair.js"></script>
<style type="text/css">
    .form-group label {
        font-size: 0.875rem;
        line-height: 1;
        vertical-align: top;
        margin-bottom: .3rem;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-wrench"></i>
                </span> Repair
            </h3>
            <nav aria-label="breadcrumb">
                <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>receive/receive_list">Receive List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Receive</li>
                </ol> -->
            </nav>
        </div>
        <form id='InsertRepair'>
        <?php 
            foreach($rep AS $d){  
                $z = 1;
                foreach($details AS $r){ 
                    switch($r){
                        case($d['in_id'] == $r['in_id']):       
        ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table-bosrdered" width="100%" style="font-size: 14px;">
                                        <tr>
                                            <td width="10%" rowspan="4">
                                                <h3 class="page-title">
                                                    <span class="page-title-icon bg-gradient-success text-white mr-2 item-block" style="height:90px">
                                                        <span ><b><h2  style="padding-top:20px"><?php echo $z;?></h2></b></span>
                                                    </span>
                                                </h3>
                                            </td>
                                            <td width="2%" rowspan="4"></td>
                                            <td width="11%">Receive Date:</td>
                                            <td width="50%"> <?php echo date("M j, Y",strtotime($r['receive_date']));?></td>
                                            <td width="7%">PR No: </td>
                                            <td width="20%"><?php echo $r['pr_no'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Item Description:</td>
                                            <td><?php echo $r['item_name'];?></td>
                                            <!-- <td>Serial No:</td>
                                            <td>2255414221</td> -->
                                        </tr>
                                        <tr>
                                            <td>Category:</td>
                                            <td><?php echo $r['category'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Sub Category:</td>
                                            <td><?php echo $r['subcategory'];?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>  
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label >Repaired by</label>
                                                <input type="text" class="form-control" data-trigger="repaired_by<?php echo $z;?>" id = "repaired_by<?php echo $z; ?>" name="repaired_by<?php echo $z; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label >Repair Date</label>
                                                <input type="date" class="form-control" id="date" name="date<?php echo $z;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label >JO/PR No.</label>
                                                <input type="text" class="form-control" id="jopr" name="jopr<?php echo $z;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label >Qty</label>
                                                <input type="text" class="form-control" onkeyup="check_repair_qty('<?php echo $z; ?>')" id="repqty<?php echo $z; ?>" name="qty<?php echo $z;?>" placeholder="<?php echo number_format($d['avail_qty'],2); ?>" value="<?php echo $d['avail_qty']?>" readonly> 
                                            </div> 
                                            <input type='hidden' name='avail_qty' id='avail_qty<?php echo $z; ?>' value="<?php echo number_format($d['avail_qty']); ?>"> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label >Received by</label>
                                                <select class="form-control select2"  name="rec_id<?php echo $z;?>" id="rec_id<?php echo $z;?>">
                                                    <option value='' selected>-Choose Employee-</option>
                                                    <?php foreach($receive as $e) { ?>
                                                    <option value='<?php echo $e->employee_id; ?>'><?php echo $e->employee_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>  
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label >Repair Price</label>
                                                <input type="text" class="form-control" id="price" name="price<?php echo $z;?>" placeholder="00.00" onkeypress="return isNumberKey(event,this)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label >Remarks</label>
                                        <textarea class="form-control" rows="1" name="remarks<?php echo $z;?>" id="remarks"></textarea>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label >Assessment</label>
                                                <div class="form-check m-0" >
                                                <label class="form-check-label">

                                                <input type="radio" class="form-check-input"  id="radio" name="repair<?php echo $z;?>" value="1" onclick="assessment(this.value, '<?php echo $z; ?>')"> Repair <i class="input-helper"></i></label>

                                              
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label ><br></label>
                                            <div class="form-check m-0">
                                                <label class="form-check-label">

                                                <input type="radio" class="form-check-input"  id="radio" name="repair<?php echo $z;?>" value="2" checked="" onclick="assessment(this.value, '<?php echo $z; ?>')">Beyond Repair <i class="input-helper"></i></label>


                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label >Serial Number</label>
                                                <input type="text" class="form-control" name="serial<?php echo $z; ?>">  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style='display: none;' id='new_pn<?php echo $z; ?>'>
                                        <label >New Part Number</label>
                                        <input type="text" class="form-control" id="new_pn<?php echo $z; ?>" name="new_pn<?php echo $z; ?>">  
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                            <input type="hidden" name="damage_det_id<?php echo $z;?>" value = "<?php echo $d['damage_det_id'];?>">
                            <input type="hidden" name="repair_id<?php echo $z;?>" value = "<?php echo $d['repair_id'];?>">
                            <input type="hidden" name="in_id<?php echo $z;?>" value = "<?php echo $d['in_id'];?>">
                            <input type="hidden" name="user_id" value = "<?php echo $_SESSION['user_id'];?>">     
                        </div>
                    </div>
                </div>
            </div>
        <?php break;
            default: 
        } $z++; } $counter = $z-1; }  ?>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <br>
                <input type="hidden" id="count" name="count" class="form-control" value = "<?php echo $z;?>">
                <input type="button" id="saved" name="submit" class="btn btn-success btn-block  btn-md" value = "Save" onclick="InsertRepair(this);return false;">
            </div>
            <div class="col-lg-3"></div>
        </div>
        </form> 
    </div>
</div>

        





