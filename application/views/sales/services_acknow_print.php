<script>
    function goBack() {
      window.history.back();
    }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sales.js"></script>
<form method="POST" id="ack_sign">
<div class="animated " id="printbutton" style="margin-top: 40px;">
    <center>
        <a href="<?php echo base_url(); ?>sales/services_sales_list" class="btn btn-warning btn-sm btn-rounded"  ><b>Back</b></a> 
        <?php if(($verified_by==0) || ($ack_approved_by==0) || ($recomm_approval==0)){ ?> 
            <a type="button" class="btn btn-success btn-sm btn-rounded" onclick="printAcknowledge()"><b>Save & Print</b></a>
        <?php }else{ ?>
            <a class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a>
        <?php } ?>
        <!-- <a class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a> -->
    </center>
    <br>
</div>
<page size="A4" > 
    <div style="padding:30px">
        <table class="page-A4 table-bordersed" width="100%">
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
            <tr>
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
                <td colspan="5" align="right" >
                    <span style="font-size: 15px;line-height: 10px;"><b>ACKNOWLEDGMENT RECEIPT</b></span>
                </td>
            </tr>
            <tr>
                <td colspan="20">
                    <hr style="margin-top: 0.4rem;margin-bottom: 1rem;border: 0;border-top: 2px solid #000">
                </td>
            </tr>
            <?php foreach($service_head AS $sh){ ?>
            <tr>
                <td colspan="20" align="center"><br></td>
            </tr>
            <tr>
                <td colspan="3">Deliver To:</td>
                <td colspan="9" class="bor-btm1"><?php echo $sh['client'];?></td>
                <td colspan="1"></td>
                <td colspan="3" align="right">DR No: </td>
                <td colspan="4" class="bor-btm1"> <h7 style="color:blue"><b><?php echo $sh['dr_no'];?></b></h7></td>
            </tr>               
            <tr>
                <td colspan="3" style="vertical-align:text-top;">Address:</td>
                <td colspan="9" class="bor-btm1"><?php echo $sh['address'];?></td>
                <td colspan="1"></td>
                <td colspan="3" align="right" style="vertical-align:bottom">Delivery Date:</td>
                <td colspan="4" class="bor-btm1" style="vertical-align:bottom"><?php echo $sh['sales_date'];?></td>
            </tr>
            <tr>
                <td colspan="3">Contact Person:</td>
                <td colspan="9" class="bor-btm1"><?php echo $sh['contact_person'];?></td>
                <td colspan="1"></td>
                <td colspan="3" align="right">JOR </b>No: </td>
                <td colspan="4" class="bor-btm1"><?php echo $sh['jor_no'];?></td>
            </tr>
            <tr>
                <td colspan="3">Contact No:</td>
                <td colspan="9" class="bor-btm1"><?php echo $sh['contact_no'];?></td>
                <td colspan="1"></td>
                <td colspan="3" align="right">JOR Date:</td>
                <td colspan="4" class="bor-btm1"><?php echo $sh['jor_date'];?></td>
            </tr>
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
                                <!-- Reconditioning of the following:<br>
                                <br> -->
                                <?php echo  nl2br($sh['ar_description']);?><br> 
                                <br>                                                     
                                <br>                                                     
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="3">Remarks:</td>
                <td colspan="17" class="bor-btm1"><?php echo nl2br($sh['remarks']);?></td>
            </tr>
            <tr>
                <td colspan="3">Shipped Via:</td>
                <td colspan="9" class="bor-btm1"><?php echo $sh['shipped_via']; ?></td>
                <td colspan="1"></td>
                <td colspan="3" align="right">Waybill No:</td>
                <td colspan="4" class="bor-btm1"><?php echo $sh['waybill_no']; ?></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <?php } ?>
            <?php if($client_id == '1') {?>
            <tr>
                <td colspan="6"><b>Prepared and Released by:</b></td>
                <td></td>
                <td colspan="6"><b>Verified by: </b></td>
                <td></td>
                <td colspan="6"><b>Recommending Approval:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6" class="bor-btm1" align="center">
                    <?php echo $prepared; ?>
                </td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center" id="changeTextverified">
                    <?php if($verified_by==0){ ?>
                        <select name="verified_by" id="verified_by" class="form-control select2"  style="border:transparent" onchange="verifiedEmp()">
                            <option value="">--Select Employees--</option>
                            <?php foreach($employee AS $emp){ ?>
                                <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                            <?php } ?>
                        </select>
                    <?php } else{ echo $verified; }?>
                </td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center" id="changeTextrecomm">
                    <?php if($recomm_approval==0){ ?>
                        <select name="recomm_approval" id="recomm_approval" class="form-control select2"  style="border:transparent" onchange="recommEmp()">
                            <option value="">--Select Employees--</option>
                            <?php foreach($employee AS $emp){ ?>
                                <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                            <?php } ?>
                        </select>
                    <?php } else{ echo $recomm; }?>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;"><?php echo $position; ?></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;" id="verified_position"><?php echo $verified_position; ?></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;" id="recomm_position"><?php echo $recomm_position; ?></td>
            </tr>

            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>Approved by:</b></td>
                <td></td>
                <td colspan="6"><b></b></td>
                <td></td>
                <td colspan="6"><b>Received the above items in good condition:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6" class="bor-btm1" align="center" id="changeTextackapp">
                    <?php if($ack_approved_by==0){ ?>
                        <select name="ack_approved_by" id="ack_approved_by" class="form-control select2"  style="border:transparent" onchange="ackapprovedEmp()">
                            <option value="">--Select Employees--</option>
                            <?php foreach($employee AS $emp){ ?>
                                <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                            <?php } ?>
                        </select>
                    <?php } else{ echo $ack_approved; }?>
                </td>
                <td></td>
                <td colspan="6"></td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center">
                    <input style="width:100%;border:0px solid #fff;-webkit-appearance: none;text-align: center;">
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;" id="ack_position"><?php echo $ack_approved_position; ?></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Signature over Printed Name</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="2" align="left" style="vertical-align:text-top;">Date/Time:</td>
                <td colspan="4" align="right" style="vertical-align:text-top;"></td>
                <td></td>
            </tr>
        <?php }else{ ?>
                        <tr>
                <td colspan="6"><b>Prepared and Released by:</b></td>
                <td></td>
                <td colspan="6"><b></b></td>
                <td></td>
                <td colspan="6"><b>Verified by:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6" class="bor-btm1" align="center">
                    Marianne M. Vianña
                </td>
                <td></td>
                <td colspan="6" align="center">
                </td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center">
                    Claro Bolarde
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;">Commercial Asst for Sales/Billing</td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Quality Assurance (Q.A) Supervisor</td>
            </tr>

            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>Approved by:</b></td>
                <td></td>
                <td colspan="6"><b></b></td>
                <td></td>
                <td colspan="6"><b>Received the above items in good condition:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6" class="bor-btm1" align="center">
                    Raffy F. Ponce
                </td>
                <td></td>
                <td colspan="6"></td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center">
                    <input style="width:100%;border:0px solid #fff;-webkit-appearance: none;text-align: center;">
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;">Technical Director</td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Signature over Printed Name</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="2" align="left" style="vertical-align:text-top;">Date/Time:</td>
                <td colspan="4" align="right" style="vertical-align:text-top;"></td>
                <td></td>
            </tr>
        <?php } ?>
            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
            <input type="hidden" name="sales_serv_head_id" id="sales_serv_head_id" value="<?php echo $sales_serv_head_id; ?>">
        </table>
    </div>
</page>
</form>
<link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>

