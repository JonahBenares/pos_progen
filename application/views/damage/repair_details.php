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
                <span class="page-title-icon bg-gradient-danger text-white mr-2">
                  <i class="mdi mdi-image-broken-variant"></i>
                </span>Damage Item
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>damage/damage_list">Damage list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Repair Details</li>
                </ol>
            </nav>
        </div>
        <form id='InsertRepair'>
            <?php $x=1; foreach($repair AS $r){ ?>
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
                                                        <span ><b><h2  style="padding-top:20px"><?php echo $x; ?></h2></b></span>
                                                    </span>
                                                </h3>
                                            </td>
                                            <td width="2%" rowspan="4"></td>
                                            <td width="11%">Receive Date:</td>
                                            <td width="50%"> <?php echo date('F d,Y',strtotime($r['receive_date']));?></td>
                                            <td width="7%">PR No: </td>
                                            <td width="20%"><?php echo $r['pr_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Item Description:</td>
                                            <td><?php echo $r['item_name']; ?></td>
                                            <!-- <td>Serial No:</td>
                                            <td>2255414221</td> -->
                                        </tr>
                                        <tr>
                                            <td>Category:</td>
                                            <td><?php echo $r['category']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sub Category:</td>
                                            <td><?php echo $r['subcategory']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>  
                            <hr>
                            <table width="100%" class="table-bordsered">
                                <tr>
                                    <td width="10%">Repaired by</td>
                                    <td width="42%">: <?php echo $r['repaired_by']; ?></td>
                                    <td width="8%">JO/PR No.</td>
                                    <td width="42%">: <?php echo $r['jo_no']; ?></td>
                                </tr>
                                <tr>
                                    <td >Repair Date</td>
                                    <td >: <?php echo date("F d,Y",strtotime($r['repair_date'])); ?></td>
                                    <td >Received by</td>
                                    <td >: <?php echo $r['received_by']; ?></td>
                                </tr>
                                <tr>
                                    <td >Repair Price</td>
                                    <td >: <?php echo number_format($r['repair_price'],2); ?></td>
                                    <td >Quantity</td>
                                    <td >: <?php echo $r['quantity']; ?></td>
                                </tr>
                                    <td >Assestment</td>
                                    <td >: <?php echo ($r['assessment']==1) ? 'Repaired' : 'Beyond Repair';?></td>
                                    <td  rowspan="3" style="vertical-align:text-top;">Remarks</td>
                                    <td  rowspan="3" style="vertical-align:text-top;">: <?php echo $r['remarks']; ?></td>
                                </tr>
                                <tr>
                                    <td>Serial Number</td>
                                    <td>: <?php echo $r['serial_no'];?></td>
                                </tr>
                                <tr>
                                    <td>New PN</td>
                                    <td>: <?php echo $r['new_pn']; ?></td>
                                </tr>
                            </table>
                            <br>
                            <!-- <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label >Repaired by</label>
                                                <input type="text" class="form-control" data-trigger="" id = "" name="">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label >Repair Date</label>
                                                <input type="date" class="form-control" id="date" name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label >JO/PR No.</label>
                                                <input type="text" class="form-control" id="jopr" name="">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label >Qty</label>
                                                <input type="text" class="form-control" onkeyup="" id="" name="" placeholder="" value="" readonly> 
                                            </div> 
                                            <input type='hidden' name='avail_qty' id='' value=""> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label >Received by</label>
                                                <select class="form-control select2"  name="" id="">
                                                    <option value='' selected>-Choose Employee-</option>
                                                </select>
                                            </div>  
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label >Repair Price</label>
                                                <input type="text" class="form-control" id="price" name="" placeholder="00.00" onkeypress="return isNumberKey(event,this)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label >Remarks</label>
                                        <textarea class="form-control" rows="1" name="" id="remarks"></textarea>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label >Assessment</label>
                                                <div class="form-check m-0" >
                                                <label class="form-check-label">
                                                <input type="radio" class="form-check-input"  id="radio" name="" value="1" onclick=""> Repair <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label ><br></label>
                                            <div class="form-check m-0">
                                                <label class="form-check-label">
                                                <input type="radio" class="form-check-input"  id="radio" name="" value="2" checked="" onclick="">Beyond Repair <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label >Serial Number</label>
                                                <input type="text" class="form-control" name="">  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style='display: none;' id=''>
                                        <label >New Part Number</label>
                                        <input type="text" class="form-control" id="" name="">  
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <?php $x++; } ?>
        </form> 
    </div>
</div>

        





