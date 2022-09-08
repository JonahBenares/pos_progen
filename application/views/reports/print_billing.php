<script>
    function goBack() {
      window.history.back();
    }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reports.js"></script>
<form method="POST" id="bs_sign">
<div class="animated " id="printbutton" style="margin-top: 40px;">
    <center>
        <a href="<?php echo base_url(); ?>reports/billed_list" class="btn btn-warning btn-sm btn-rounded"><b>Back</b></a> 
        <!-- <a href="" class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a> -->
        <?php if(($checked_by==0) || ($approved_by==0)){ ?> 
            <a type="button" class="btn btn-success btn-sm btn-rounded" onclick="printBS()"><b>Save & Print</b></a>
        <?php }else{ ?>
            <a class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a>
        <?php } ?>
        <a href="<?php echo base_url(); ?>reports/bill_pay/<?php echo $billing_id; ?>" class="btn btn-gradient-info btn-sm btn-rounded"><b>Proceed Pay</b></b>
        </a>
    </center>
    <br>
</div>
<page size="A4"> 
    <div style="padding:30px">
        <!-- <img src="<?php echo base_url(); ?>assets/images/adjusted.png" style="width: 100%; position: inherit;"> -->
        <table class="page-A4 table-bordsered" width="100%">
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
            <?php foreach($head AS $h){ ?>
            <tr style="padding:10px;border-top: 2px solid #000;border-bottom: 2px solid #000;border-left: 2px solid #000">
                <td colspan="2">
                    <img class="logo-print" src="<?php echo base_url().LOGO;?>">   
                </td>
                <td colspan="12" style="padding-left:10px">
                    <b><?php echo COMPANY_NAME;?></b><br>
                    <?php echo ADDRESS;?> <br>
                    <?php echo TIN;?>
                    <br>
                </td>
                <td colspan="1"></td>
                <td colspan="5" align="center" style="padding:10px;border-top: 2px solid #000;border-bottom: 2px solid #000;border-left: 2px solid #000;border-right: 2px solid #000">
                    <span style="font-size: 15px;line-height: 10px;">
                        <?php if ($h['adjustment_counter'] == 0) { ?>
                            <b>BILLING STATEMENT</b>
                        <?php } elseif ($h['adjustment_counter'] > 0) { ?>
                            <b>TRANSACTION ADJUSTMENT</b>
                        <?php } ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="20">
                    <br>
                    <!-- <hr style="margin-top: 0.4rem;margin-bottom: 1rem;border: 0;border-top: 2px solid #000"> -->
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">No:</td>
                <td colspan="4" class="bor-btm1"><?php echo $h['billing_no'].(($h['adjustment_counter'] == 0) ? '' : '.r'.$h['adjustment_counter']); ?></td>
                <td colspan="4"></td>
                <td></td>
                <td colspan="3"></td>
                <td colspan="4"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">Date:</td>
                <td colspan="4" class="bor-btm1"><?php echo $h['date']; ?></td>
                <td colspan="4"></td>
                <td></td>
                <td colspan="3">TIN:</td>
                <td colspan="4" class="bor-btm1"><?php echo $h['tin']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">Customer:</td>
                <td colspan="8" class="bor-btm1"><?php echo $h['client']; ?></td>
                <td></td>
                <td colspan="3">PO/JO No.:</td>
                <td colspan="4" class="bor-btm1"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">Address:</td>
                <td colspan="8" class="bor-btm1"><?php echo $h['address']; ?></td>
                <td></td>
                <td colspan="3">PO/JO Date:</td>
                <td colspan="4" class="bor-btm1"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="20" align="center"><br><br></td>
            </tr>
            <?php } ?>
            <tr>
                <td></td>
                <td colspan="18">
                    <table class="table-bordered" width="100%">
                        <tr>
                            <td width="30%" class="td-head">DR Date</td>
                            <td width="40%" class="td-head">DR No.</td>
                            <td width="30%" class="td-head" align="right">Total Amount</td>
                        </tr>
                        <?php 
                        $total=array();
                        foreach($details AS $d){ 
                            $total[] = $d->remaining_amount;?>
                        <tr>
                            <td><?php echo date("F d, Y", strtotime($d->dr_date)); ?></td>
                            <td><?php echo $d->dr_no; ?></td>
                            <td align="right"><?php echo number_format($d->remaining_amount,2); ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="2">
                                <span class="pull-right">Total Amount Due:</span>
                            </td>
                            <td class="bor-btm2" align="right"> <b><?php echo number_format(array_sum($total),2); ?></b></td>
                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
            <tr>
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
            </tr>
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
                <td></td>
                <td colspan="5" class="bor-btm1" align="center"><?php echo $prepared; ?></td>
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
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="5" align="center" style="vertical-align:text-top;"><?php echo $position; ?></td>
                <td></td>
                <td colspan="5" align="center" id="checked_position" style="vertical-align:text-top;"><?php echo $checked_position; ?></td>
                <td></td>
                <td colspan="6" align="center" id="approved_position" style="vertical-align:text-top;"><?php echo $approved_position; ?></td>
                <td></td>
            </tr>
        </table>
    </div>
</page>
<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
<input type="hidden" name="billing_id" id="billing_id" value="<?php echo $billing_id; ?>">
</form>
<link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>


