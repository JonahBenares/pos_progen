<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sales.js"></script> 
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-chart-areaspline"></i>
                </span> Sales
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>sales/services_sales_list">Sales List (Services)</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Print Sales</li>
                </ol>
            </nav>
        </div>
        <form id="saveAR">
         <?php foreach($service_head AS $sh){ ?>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <center>
                    <a href="#" class="btn btn-gradient-success btn-md btn-block" onclick="printDiv('printableArea')">
                        <b><span class="mdi mdi-printer"></span> Print</b>
                    </a>
                </center>
<!--                 <center>
                <?php if($sh['shipped_via']!='0') {?>
                    <a href="#" class="btn btn-gradient-success btn-md btn-block" onclick="printDiv('printableArea')">
                        <b><span class="mdi mdi-printer"></span> Print</b>
                    </a>
                <?php } else if($sh['shipped_via']=='0') {?> 
                    <button type="button" name="savedata" id="savedata" class="btn btn-gradient-success btn-md btn-rounded" onclick="saveAR()">
                        <b><span class="mdi mdi-printer"></span> Save and Print</b>
                    </button>
                <?php } ?>
                </center> -->
            </div>
            <div class="col-lg-3"></div>
        </div>
        <br>
        <page size="A4" id="printableArea">
            <table class="page-A4 table-bordersed" width="100%">
                <tr>
                    <td width="5%"><br></td>
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
                    <td colspan="20" align="center">                        
                        <b>PROGEN DIESELTECH SERVICES CORP.</b><br>
                        Prk. San Jose, Brgy. Calumangan, Bago City, Neg. Occ. <br>
                        VAT Reg. TIN: 008-726-170-001  
                        <br>
                        <br>
                        <b>ACKNOWLEDGMENTS RECEIPT</b>
                        <br>
                    </td>
                </tr>
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
<!--                 <?php if($sh['shipped_via']!='0') {?> 
                <tr>
                    <td colspan="3">Shipped Via:</td>
                    <td colspan="9" class="bor-btm1"><?php echo $sh['shipped_via']; ?></td>
                    <td colspan="1"></td>
                    <td colspan="3" align="right">Waybill No:</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['waybill_no']; ?></td>
                </tr>
                <?php } else { ?>
                <tr>
                    <td colspan="3">Shipped Via:</td>
                    <td colspan="9" class="bor-btm1">
                        <select class="bor-btm1" id="shipping" name = "shipping" style="width:100%">
                            <option value="">--Select Shpping Company--</option>
                            <?php foreach($shipping AS $s){ ?>
                                <option value="<?php echo $s->ship_comp_id; ?>"><?php echo $s->company_name; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td colspan="1"></td>
                    <td colspan="3" align="right">Waybill No:</td>
                    <td colspan="4" class="bor-btm1"><input type="text" class="bor-btm1" name="waybill_no" placeholder="Waybill No"></td>
                </tr> 
            <?php } ?> -->
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td colspan="5"><b>Prepared and Released by:</b></td>
                    <td></td>
                    <td colspan="5"><b>Recommending Approval:</b></td>
                    <td></td>
                    <td colspan="6"><b>Verified by:</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" class="bor-btm1" align="center"></td>
                    <td></td>
                    <td colspan="5" class="bor-btm1" align="center"></td>
                    <td></td>
                    <td colspan="6" class="bor-btm1" align="center"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;">Sales Officer</td>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;">Warehouse Assistant</td>
                    <td></td>
                    <td colspan="6" align="center" style="vertical-align:text-top;">Warehouse Supervisor</td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5"><b>Approved by:</b></td>
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
                    <td colspan="5" class="bor-btm1" align="center"></td>
                    <td></td>
                    <td colspan="5"></td>
                    <td></td>
                    <td colspan="6" class="bor-btm1" align="center"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;">Projects and Assets Management</td>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;"></td>
                    <td></td>
                    <td colspan="6" align="center" style="vertical-align:text-top;">Signature over Printed Name</td>
                    <td></td>
                </tr>
                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                <input type="hidden" name="sales_serv_head_id" id="sales_serv_head_id" value="<?php echo $sales_serv_head_id; ?>">
            </table>
        </page>
    </form>
    </div>
</div>
        




