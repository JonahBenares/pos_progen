<script>
    function goBack() {
      window.history.back();
    }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/receive.js"></script>
<form method="POST" id="receive_sign">
<div class="animated " id="printbutton" style="margin-top: 40px;">
    <center>
        <a href="<?php echo base_url(); ?>receive/receive_list" class="btn btn-warning btn-sm btn-rounded"><b>Back</b></a> 
        <a href="<?php echo base_url(); ?>receive/add_receive_head" class="btn btn-gradient-primary btn-sm btn-rounded">
                        <b><span class="mdi mdi-plus"></span> Add New</b>
                    </a>
            <?php if(($received_by==0) || ($acknowledged_by==0) || ($noted_by==0) || ($delivered_by==0)){ ?> 
                <a type="button" class="btn btn-success btn-sm btn-rounded" onclick="printReceive()"><b>Save & Print</b></a>
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
                <td colspan="2" >
                    <img class="logo-print" src="<?php echo base_url().LOGO;?>">   
                </td>
                <td colspan="12" style="padding-left:10px">
                    <b><?php echo COMPANY_NAME;?></b><br>
                    <?php echo ADDRESS;?> <br>
                    <?php echo TIN;?>
                    <br>
                </td>
                <td colspan="1"></td>
                <td colspan="5" align="right" style="padding:10px;border-top: 2px solid #000;border-bottom: 2px solid #000;border-left: 2px solid #000;border-right: 2px solid #000">
                    <span style="font-size: 15px;line-height: 10px;"><b>MATERIAL RECEIVING & INSPECTION FORM</b></span>
                </td>
            </tr>
            <tr>
                <td colspan="20">
                    <hr style="margin-top: 0.4rem;margin-bottom: 1rem;border: 0;border-top: 2px">
                </td>
            </tr>
            <?php foreach($head AS $h){ 
                if($h['pcf'] == '1') {
                    $pcf = 'Yes';
                } else {
                    $h['pcf'] = 'No';
                }?>
                <tr>
                    <td colspan="2">Date:</td>
                    <td colspan="8" class="bor-btm1"><?php echo date("Y-m-d", strtotime($h['receive_date'])); ?></td>
                    <td colspan="2" align="right">MRF NO.:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $h['mrecf_no']; ?></td>
                </tr>
                <tr>
                    <td colspan="2">DR NO.:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $h['dr_no']; ?></td>
                    <td colspan="2" align="right">PO:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $h{'po_no'}; ?></td>
                </tr>
                <tr>
                    <td colspan="2">SI NO.:</td>
                    <td colspan="8" class="bor-btm1"> <?php echo $h['si_no']; ?></td>
                    <td colspan="2" align="right">PCF:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $pcf; ?></td>
                </tr>
               
                <tr>
                    <td colspan="3">Overall Remarks:</td>
                    <td colspan="17" class="bor-btm1"> <?php echo $h['overall_remarks']; ?></td>
                </tr>
                <tr>
                    <td colspan="20" align="center"><br><br></td>
                </tr>
            <?php } ?>

            <?php foreach($details AS $det) { ?>
            <tr>
                <td colspan="20">
                    <fieldset>
                        <legend>PR/JO No.: <?php echo $det['pr_no']; ?></legend>
                        <table width="100%">
                            <tr>
                                <td width="10%">Department:</td>
                                <td width="70%" class="bor-btm1"> <?php echo $det['department']; ?></td>
                                <td width="5%"></td>
                            </tr>
                            <tr>
                                <td width="10%">Purpose:</td>
                                <td width="70%" class="bor-btm1"><?php echo $det['purpose']; ?></td>
                                <td width="5%"></td>
                            </tr>
                            <tr>
                                <td width="10%">Inspected by:</td>
                                <td width="70%" class="bor-btm1"><?php echo $det['inspected']; ?></td>
                                <td width="5%"></td>
                            </tr>
                        </table>
                        <br>
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td align="center" width="3%"> #</td>
                                <td align="center" width="5%">Qty</td>
                                <td align="center" width="25%">Item Description</td>
                                <td align="center" width="25%">Supplier</td>
                                <td align="center" width="10%">Serial No.</td>
                                <td align="center" width="10%">Cat No.</td>
                                <td align="center" width="15%">Brand</td>
                                <td align="center" width="10%">Cost</td>
                                <td align="center" width="10%">Shipping Fee </td>
                            </tr>
                            <?php
                            $count=1; 
                            foreach($items AS $it){
                               
                                if($det['rd_id'] == $it['rd_id']){  ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo number_format($it['received_qty']); ?></td>
                                        <td><?php echo $it['item']; ?></td>
                                        <td><?php echo $it['supplier']; ?></td>
                                        <td><?php echo $it['serial_no']; ?></td>
                                        <td><?php echo $it['catalog_no']; ?></td>
                                        <td><?php echo $it['brand']; ?></td>
                                        <td><?php echo number_format($it['item_cost'],2); ?></td>
                                        <td><?php echo number_format($it['shipping'],2); ?></td>
                                    </tr>
                        <?php $count++; }  } ?>
                                  
                        </table>
                        <br>
                     <!--    <table width="100%">
                            <tr>
                                <td width="10%" style="vertical-align:text-top;">Remarks:</td>
                                <td width="70%" style="vertical-align:text-top;" class="bor-btm1">   O-ring - This was accommodated by SIPC due to import permit. The reference Purchase Order number under SIPC is PO-CXPPO-2021-018(MD Trade Power GmbH ,</td>
                                <td width="5%"></td>
                            </tr>
                            <tr>
                                <td width="10%" style="vertical-align:text-top;">Inspected by:</td>
                                <td width="70%" style="vertical-align:text-top;" class="bor-btm1">Mary Grace Bugna</td>
                                <td width="5%"></td>
                            </tr> 
                        </table> -->
                    </fieldset>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>Prepared by:</b></td>
                <td></td>
                <td colspan="6"><b>Delivered by:</b></td>
                <td></td>
                <td colspan="6"><b>Received by:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6" class="bor-btm1" align="center"><?php echo $_SESSION['fullname'];?></td>
                <td></td>
                <td colspan="5" class="bor-btm1" align="center" id="changeTextdel">
                    <?php if($delivered_by==0){ ?>
                    <select name="delivered_by" id="delivered_by" class="form-control select2" style="border:transparent" onchange="deliveredEmp()">
                        <option value="">--Select Employees--</option>
                        <?php foreach($employee AS $emp){ ?>
                            <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                        <?php } ?>
                    </select>
                <?php }else{ echo $delivered; } ?>
                </td>
                <td></td>
                <td></td>
                <td colspan="5" class="bor-btm1" align="center" id="changeTextrec">
                    <?php if($received_by==0){ ?>
                    <select name="received_by" id="received_by" class="form-control select2" style="border:transparent" onchange="receivedEmp()">
                        <option value="">--Select Employees--</option>
                        <?php foreach($employee AS $emp){ ?>
                            <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                        <?php } ?>
                    </select>
                     <?php }else{ echo $received; } ?>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;">Sales Officer</td>
                <td></td>
                <td colspan="5" align="center" style="vertical-align:text-top;" id="delivered_position"><?php echo $delivered_position; ?></td>
                <td></td>
                <td colspan="7" align="center" style="vertical-align:text-top;" id="received_position"><?php echo $received_position; ?></td>
            </tr>

            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>Acknowledged by:</b></td>
                <td></td>
                <td colspan="6"><b></b></td>
                <td></td>
                <td colspan="6"><b>Noted by:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6" class="bor-btm1" align="center" id="changeTextack">
                <?php if($acknowledged_by==0){ ?>
                    <select name="acknowledged_by" id="acknowledged_by" class="form-control select2" style="border:transparent" onchange="acknowledgedEmp()">
                        <option value="">--Select Employees--</option>
                        <?php foreach($employee AS $emp){ ?>
                            <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                        <?php } ?>
                    </select>
                <?php }else{ echo $acknowledged; } ?>
                </td>
                <td></td>
                <td colspan="6"></td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center" id="changeTextnote">
                <?php if($noted_by==0){ ?>
                    <select name="noted_by" id="noted_by" class="form-control select2" style="border:transparent" onchange="notedEmp()">
                        <option value="">--Select Employees--</option>
                        <?php foreach($employee AS $emp){ ?>
                            <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                        <?php } ?>
                    </select>
                <?php }else{ echo $noted; } ?>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;" id="acknowledged_position"><?php echo $acknowledged_position; ?></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;" id="noted_position"><?php echo $noted_position; ?></td>
            </tr>
        </table>
        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
        <input type="hidden" name="receive_id" id="receive_id" value="<?php echo $receive_id; ?>">
    </div>
</page>
</form>
<link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>


