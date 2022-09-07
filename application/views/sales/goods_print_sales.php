<script>
    function goBack() {
      window.history.back();
    }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sales.js"></script>
<form method="POST" id="delivery_sign">
    <div class="animated " id="printbutton" style="margin-top: 40px;">
        <center>
            <a href="<?php echo base_url(); ?>sales/goods_sales_list" class="btn btn-warning btn-sm btn-rounded"  ><b>Back</b></a>
            <?php if(($released_by==0) || ($approved_by==0) || ($noted_by==0)){ ?> 
                <a type="button" class="btn btn-success btn-sm btn-rounded" onclick="printDeliverygoods()"><b>Save & Print</b></a>
            <?php }else{ ?>
                <a class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a>
            <?php } ?>
        </center>
        <br>
    </div>
    <page size="A4" > 
        <div style="padding:30px">
            <table class="page-A4 table-borsdered" width="100%">
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
                    <td colspan="2">
                        <img class="logo-print" src="<?php echo base_url().LOGO;?>">   
                    </td>
                    <td colspan="9" style="padding-left:10px;">
                        <b><?php echo COMPANY_NAME;?></b><br>
                        <?php echo ADDRESS;?> <br>
                        <?php echo TIN;?>
                        <br>
                    </td>
                    <td colspan="1"></td>
                    <td colspan="8" align="center" style="padding:10px;border-top: 2px solid #000;border-bottom: 2px solid #000;border-left: 2px solid #000;border-right: 2px solid #000">
                        <span style="font-size: 15px;line-height: 10px;"><b>DELIVERY RECEIPT <br> GOODS</b></span>
                    </td>
                </tr>
                <!-- <tr>
                    <td colspan="20">
                        <hr style="margin-top: 0.4rem;margin-bottom: 1rem;border: 0;border-top: 2px solid #000">
                    </td>
                </tr> -->
                <?php foreach($sales_head AS $sh){ ?>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="11" class=""></td>
                    <td colspan="6" align="right"><h6 style="color:blue"><b><?php echo $sh['dr_no'];?></b></h6></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="10"></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">Date:</td>
                    <td colspan="4" class="bor-btm1">&nbsp; <?php echo date("Y-m-d", strtotime($sh['sales_date']));?></td>
                </tr> 
                <tr>
                    <td colspan="3">Client:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['client'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">TIN:</td>
                    <td colspan="4" class="bor-btm1">&nbsp; <?php echo $sh['tin'];?></td>
                </tr>               
                <tr>
                    <td colspan="3"  style="vertical-align:top">Address:</td>
                    <td colspan="10" class="bor-btm1" style="vertical-align:top"><?php echo $sh['address'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right"  style="vertical-align:top">VAT:</td>
                    <td colspan="4" class="bor-btm1"  style="vertical-align:top">&nbsp; <?php echo ($sh['vat']==1) ? 'Vatable' : 'Non-Vatable';?></td>
                </tr>
                <tr>
                    <td colspan="3">Contact Person:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['contact_person'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">Contact No:</td>
                    <td colspan="4" class="bor-btm1">&nbsp; <?php echo $sh['contact_no'];?></td>
                </tr>
                <tr>
                    <td colspan="3">PGC <b>PR </b>No:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['pr_no'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">PR Date:</td>
                    <td colspan="4" class="bor-btm1">&nbsp; <?php echo $sh['pr_date'];?></td>
                </tr>
                <tr>
                    <td colspan="3">PGC <b>PO </b>No:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['po_no'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">PO Date: </td>
                    <td colspan="4" class="bor-btm1">&nbsp;<?php echo $sh['po_date'];?></td>
                </tr>
            <!--  <tr>
                    <td colspan="3"></td>
                    <td colspan="11" class="bor-btm1"></td>
                    <td colspan="2" align="right"></td>
                    <td colspan="4" class="bor-btm1"></td>
                </tr> -->
                <tr>
                    <td colspan="20" align="center"><br><br></td>
                </tr>
                <tr>
                    <td colspan="20">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td width="2%">#</td>
                                <td width="7%">Part No.</td>
                                <td width="30%">Item Description</td>
                                <td width="15%">Serial No.</td>
                                <td width="5%">Qty</td>
                                <td width="5%">Expected Qty</td>
                                <td width="5%">UOM</td>
                                <td width="10%">Selling Price</td>
                                <td width="8%">Discount</td>
                                <td width="12%">Total Price</td>
                            </tr>
                            <?php 
                                $x = 1;
                                foreach($sales_details AS $sd){ ?>
                            <tr>
                                <td><?php echo $x;?></td>
                                <td><?php echo $sd['original_pn'];?></td>
                                <td><?php echo $sd['item'];?></td>
                                <td><?php echo $sd['serial_no'];?></td>
                                <td><?php echo $sd['quantity'];?></td>
                                <td><?php echo $sd['expected_qty'];?></td>
                                <td><?php echo $sd['uom'];?></td>
                                <td align="center"><?php echo number_format($sd['selling_price'],2);?></td>
                                <td align="center"><?php echo number_format($sd['discount'],2);?></td>
                                <!-- <td align="center"><?php echo number_format($sd['discount'],0)."%";?></td> -->
                                <td><?php echo number_format($sd['total'],2);?></td>
                            </tr>
                            <?php $x++; } ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="2">Remarks:</td>
                    <td colspan="18" class="bor-btm1"><?php echo nl2br($sh['remarks']);?></td>
                </tr>
                <!-- <tr>
                    <td colspan="2">Shipped via:</td>
                    <td colspan="8" class="bor-btm1"></td>

                    <td colspan="2" align="center">Waybill No.:</td>
                    <td colspan="8" class="bor-btm1"></td>
                </tr> -->
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5"><b>Prepared by:</b></td>
                    <td></td>
                    <td colspan="5"><b>Released by:</b></td>
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
                    <td colspan="5" class="bor-btm1" align="center" id="changeTextrel">
                        <?php if($released_by==0){ ?>
                        <select name="released_by" id="released_by" class="form-control select2" style="border:transparent" onchange="releasedEmp()">
                            <option value="">--Select Employees--</option>
                            <?php foreach($employee AS $emp){ ?>
                                <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                            <?php } ?>
                        </select>
                        <?php }else{ echo $released; } ?>
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
                    <td colspan="5" align="center" style="vertical-align:text-top;" id="released_position"><?php echo $released_position; ?></td>
                    <td></td>
                    <td colspan="6" align="center" style="vertical-align:text-top;" id="approved_position"><?php echo $approved_position; ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5"><b>Noted by:</b></td>
                    <td></td>
                    <td colspan="5"><b></b></td>
                    <td></td>
                    <td colspan="6"><b>Received the above items in good condition:</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" class="bor-btm1" align="center" id="changeTextnote">
                        <?php if($noted_by==0){ ?>
                        <select name="noted_by" id="noted_by" class="form-control select2"  style="border:transparent"  onchange="notedEmp()">
                            <option value="">--Select Employees--</option>
                            <?php foreach($employee AS $emp){ ?>
                                <option value="<?php echo $emp->employee_id; ?>"><?php echo $emp->employee_name; ?></option>
                            <?php } ?>
                        </select>
                        <?php }else{ echo $noted; }?>
                    </td>
                    <td></td>
                    <td colspan="5"></td>
                    <td></td>
                    <td colspan="6" class="bor-btm1" align="center"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;" id="noted_position"><?php echo $noted_position; ?></td>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;"></td>
                    <td></td>
                    <td colspan="6" align="center" style="vertical-align:text-top;">Signature over Printed Name</td>
                    <td></td>
                </tr>
                <?php } ?>
            </table>
            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
            <input type="hidden" name="sales_good_head_id" id="sales_good_head_id" value="<?php echo $sales_good_head_id; ?>">
        </div>
    </page>
</form>
<link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>

