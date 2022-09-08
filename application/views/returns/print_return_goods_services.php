<script>
    function goBack() {
      window.history.back();
    }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/return.js"></script>
<form method="POST" id="return_sign">
<?php if($adjustment_qty>0){ ?>
    <div class="alert alert-warning" role="alert"> <span class="mdi mdi-alert-outline"></span> &nbsp; This transaction has affected a Billing Statement. Kindly process adjustment <a href="<?php echo base_url(); ?>reports/billed_list/<?php echo $client_id; ?>"  target='_blank'>here</a>.  </div>
    <?php } if($damage_qty>0){ ?>
    <div class="alert alert-danger" role="alert"> <span class="mdi mdi-alert-outline"></span> &nbsp; This return transaction has damaged item/s. Click <a href="<?php echo base_url(); ?>returns/return_damage/<?php echo $return_id; ?>" target='_blank'>here</a> to fill out damage form/s. </div>
<?php } ?>

<div class="animated " id="printbutton" style="margin-top: 40px;">
    <center>
        <a class="btn btn-warning btn-sm btn-rounded" onclick="goBack()" ><b>Back</b></a> 
        <!-- <a class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a> -->
        <?php if(($checked_by==0) || ($approved_by==0)){ ?> 
            <a type="button" class="btn btn-success btn-sm btn-rounded" onclick="printReturn()"><b>Save & Print</b></a>
        <?php }else{ ?>
            <a class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a>
        <?php } ?>
    </center>
    <br>
</div>
<page size="A4" > 
    <div style="padding:30px">
        <table class="page-A4 table-bosrdered" width="100%">
            <tr>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
            </tr>
            <tr style="padding:10px;border-top: 2px solid #000;border-bottom: 2px solid #000;border-left: 2px solid #000">
                <td colspan="1">
                    <img class="logo-print" src="<?php echo base_url().LOGO;?>">   
                </td>
                <td colspan="13" style="padding-left:10px">
                    <b><?php echo COMPANY_NAME;?></b><br>
                    <?php echo ADDRESS;?> <br>
                    <?php echo TIN;?>
                    <br>
                </td>
                <td colspan="1"></td>
                <td colspan="5" align="center" style="padding:10px;border-top: 2px solid #000;border-bottom: 2px solid #000;border-left: 2px solid #000;border-right: 2px solid #000">
                    <span style="font-size: 15px;line-height: 10px;"><b>RETURN FORM</b></span>
                </td>
            </tr>
            <!-- <tr>
                <td colspan="20">
                    <hr style="margin-top: 0.4rem;margin-bottom: 1rem;border: 0;border-top: 2px solid #000">
                </td>
            </tr> -->
            <?php foreach($head AS $h){ ?>
            <tr>
                
                <td colspan="2">Returned by:</td>
                <td colspan="9" class="bor-btm1"><?php echo $h['client']; ?></td>
                <td></td>
                <td colspan="3">JOR/PR No:</td>
                <td colspan="5" class="bor-btm1"><?php echo $h['pr_no']; ?></td>
                
            </tr>
            <tr>
                
                <td colspan="2">Purpose:</td>
                <td colspan="9" class="bor-btm1"><?php echo $h['purpose']; ?></td>
                <td></td>
                <td colspan="3">Date:</td>
                <td colspan="5" class="bor-btm1"><?php echo $h['date']; ?></td>
                
            </tr>
            <tr>
                
                <td colspan="2">Department:</td>
                <td colspan="9" class="bor-btm1"><?php echo $h['department']; ?></td>
                <td></td>
                <td colspan="3">DR No. :</td>
                <td colspan="5" class="bor-btm1"><?php echo $h['dr_no']; ?></td>
                
            </tr>
            <!-- <tr>
                <td></td>
                <td colspan="2">Enduse:</td>
                <td colspan="8" class="bor-btm1"></td>
                <td></td>
                <td colspan="3"></td>
                <td colspan="4" class=""></td>
                <td></td>
            </tr> -->
            <?php if($h['type']=='Services'){ ?>
            <tr>
                <td colspan="20" align="center"><br><br></td>
            </tr>
            <tr style="border-top:1px solid #aeaeae">
                <td colspan="20">
                    <table class="table-bordered" width="100%">
                        <tr> 
                            <td style="background:#efefef" width="30%">Description</td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo nl2br($h['description']); ?>                                                   
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="20" align="center"><br><br></td>
            </tr>
            <tr>
                <td colspan="20">
                    <table class="table-bordered" width="100%">
                        <tr>
                            <td width="1%" align="center">#</td>
                            <td width="5%" align="center">Qty</td>
                            <td width="5%" align="center">U/M</td>
                            <td width="10%" align="center">Part No.</td>
                            <td width="30%" align="center">Item Description</td>                    
                            <td width="10%" align="center">Brand</td>
                            <td width="10%" align="center">Serial No.</td>
                            <td width="10%" align="center">Notes</td>
                            <td width="5%" align="center">Unit Cost</td>
                            <td width="5%" align="center">Total Cost</td>
                         
                        </tr>
                        <?php $x=1; foreach($details AS $d){ ?>
                        <tr>
                            <td align="center"><?php echo $x; ?></td>
                            <td align="center"><?php echo $d['quantity']; ?></td>
                            <td align="center"><?php echo $d['unit']; ?></td>
                            <td align="center"><?php echo $d['original_pn']; ?></td>
                            <td align="left">&nbsp;<?php echo $d['item']; ?></td>
                            <td align="center"><?php echo $d['brand']; ?></td>
                            <td align="center"><?php echo $d['serial_no']; ?></td>
                            <td align="center"><?php echo $d['remarks']; ?></td>
                            <td align="center"><?php echo number_format($d['unit_cost'],2); ?></td>
                            <td align="center"><?php echo number_format($d['total'],2); ?></td>
                          
                        </tr>
                        <?php $x++; } ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Remarks:</td>
                <td colspan="19" class="bor-btm1"><?php echo $d['remarks_head']; ?></td>
            </tr>
            <tr>
                <td colspan="20"><br><br><br></td>
            </tr>
            <!-- <tr>
                <td colspan="20" align="center">
                    <br>
                    <br>                        
                    <b style="color: red;">Please make all checks payable to PROGEN DIESELTECH SERVICES CORP.</b>
                    <br>
                    <br>
                    <i>This document is not valid for claiming input taxes.</i>
                    <br>
                    <br>
                </td>
            </tr> -->
            <tr>
                <td></td>
                <td colspan="5"><b>Prepared by:</b></td>
                <td></td>
                <td colspan="5"><b>Checked by:</b></td>
                <td></td>
                <td colspan="6"><b>Approved by:</b></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="5" class="bor-btm1" align="center">
                    <?php echo $prepared; ?>
                </td>
                <td></td>
                <td colspan="5" class="bor-btm1" align="center" id="changeTextchecked">
                    <?php if($checked_by==0){ ?>
                        <select name="checked_by" id="checked_by" class="form-control select2"  style="border:transparent" onchange="checkedEmp()">
                            <option value="">--Select Employees--</option>
                            <?php foreach($employee AS $emp){ ?>
                                <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                            <?php } ?>
                        </select>
                    <?php } else{ echo $checked; }?>
                </td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center" id="changeTextapp">
                    <?php if($approved_by==0){ ?>
                        <select name="approved_by" id="approved_by" class="form-control select2"  style="border:transparent" onchange="approvedEmp()">
                            <option value="">--Select Employees--</option>
                            <?php foreach($employee AS $emp){ ?>
                                <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                            <?php } ?>
                        </select>
                    <?php } else{ echo $approved; }?>
                </td>
            </tr>
            <tr>
                <td colspan="5" align="center" style="vertical-align:text-top;"><?php echo $position; ?></td>
                <td></td>
                <td colspan="5" align="center" id="checked_position" style="vertical-align:text-top;"><?php echo $checked_position; ?></td>
                <td></td>
                <td colspan="6" align="center" id="approved_position" style="vertical-align:text-top;"><?php echo $approved_position; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</page>
<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
<input type="hidden" name="return_id" id="return_id" value="<?php echo $return_id; ?>">
</form>
<link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>


