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
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <center>
                    <a href="#" class="btn btn-gradient-success btn-md btn-rounded">
                        <b><span class="mdi mdi-printer"></span> Print</b>
                    </a>
                </center>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <br>
        <style type="text/css">
            
        </style>
        <page size="A4">
            <table class="page-A4 table-borsdered" width="100%">
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
                        <b>DELIVERY RECEIPT - SERVICES</b>
                        <br>
                    </td>
                </tr>
                <?php foreach($service_head AS $sh){ ?>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="11" class=""></td>
                    <td colspan="6" align="right"><h5 style="color:blue"><b><?php echo $sh['dr_no'];?></b></h5></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="10"></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">Date: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['sales_date'];?></td>
                </tr> 
                <tr>
                    <td colspan="3">Client:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['client'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">TIN: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['tin'];?></td>
                </tr>               
                <tr>
                    <td colspan="3">Address:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['address'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">VAT: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo ($sh['vat']==1) ? 'Vatable' : 'Non-Vatable';?></td>
                </tr>
                <tr>
                    <td colspan="3">Contact Person:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['contact_person'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">Contact No: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['contact_no'];?></td>
                </tr>
                <tr>
                    <td colspan="3">PGC <b>JOR </b>No:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['jor_no'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">JOR Date: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['jor_date'];?></td>
                </tr>
                <tr>
                    <td colspan="3">PGC <b>JOI </b>No:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['joi_no'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">JOI Date: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['joi_date'];?></td>
                </tr>
                <?php } ?>
               <!--  <tr>
                    <td colspan="3"></td>
                    <td colspan="11" class="bor-btm1"></td>
                    <td colspan="2" align="right"></td>
                    <td colspan="4" class="bor-btm1"></td>
                </tr> -->
                <tr>
                    <td colspan="20" align="center"><br><br></td>
                </tr>
                <tr style="border-top:1px solid #aeaeae">
                    <td colspan="20">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td style="background:#efefef" width="7%">Part No.</td>
                                <td style="background:#efefef" width="30%">Item Description</td>
                                <td style="background:#efefef" width="15%">Serial No.</td>
                                <td style="background:#efefef" width="5%">Qty</td>
                                <td style="background:#efefef" width="5%">UOM</td>
                                <td style="background:#efefef" width="10%">Selling Price</td>
                                <td style="background:#efefef" width="8%">Discount</td>
                                <td style="background:#efefef" width="12%">Total Price</td>
                            </tr>
                             <?php foreach($service_details AS $sd){ ?>
                            <tr>
                                <td><?php echo $sd['original_pn'];?></td>
                                <td><?php echo $sd['item'];?></td>
                                <td><?php echo $sd['serial_no'];?></td>
                                <td><?php echo $sd['quantity'];?></td>
                                <td><?php echo $sd['uom'];?></td>
                                <td align="center"><?php echo number_format($sd['selling_price'],2);?></td>
                                <td align="center"><?php echo number_format($sd['discount'],0)."%";?></td>
                                <td><?php echo number_format($sd['total'],2);?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td style="background:#efefef" colspan="2" align="center"><b>Sub-Total</b></td>
                                <td style="background:#efefef" colspan="5" align="center"><b>Engine Parts Cost Incurred</b></td>
                                <td style="background:#efefef" align="right"><b></b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20" align="center"><br></td>
                </tr>
                <tr style="border-top:1px solid #aeaeae">
                    <td colspan="20" align="center" style="background:#efefef"><b>Consumables and Other Materials</b></td>
                </tr>
                <tr>
                    <td colspan="20">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td style="background:#efefef" width="5%">No.</td>
                                <td style="background:#efefef" width="45%">Item Description</td>
                                <td style="background:#efefef" width="8%">Qty</td>
                                <td style="background:#efefef" width="8%">UOM</td>
                                <td style="background:#efefef" width="14%">Unit Cost</td>
                                <td style="background:#efefef" width="12%">Total Cost</td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="background:#efefef" colspan="2" align="center"><b>Sub-Total</b></td>
                                <td style="background:#efefef" colspan="3" align="center"><b>Material Cost Incurred</b></td>
                                <td style="background:#efefef" align="right"><b></b></td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20" align="center"><br></td>
                </tr>
                <tr style="border-top:1px solid #aeaeae">
                    <td colspan="20" align="center" style="background:#efefef"><b>Manpower</b></td>
                </tr>
                <tr>
                    <td colspan="20">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td style="background:#efefef" width="5%">No.</td>
                                <td style="background:#efefef" width="45%">Employee</td>
                                <td style="background:#efefef" width="8%">Days</td>
                                <td style="background:#efefef" width="8%">Rate</td>
                                <td style="background:#efefef" width="14%">Overtime</td>
                                <td style="background:#efefef" width="12%">Total</td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="background:#efefef" colspan="2" align="center"><b>Sub-Total</b></td>
                                <td style="background:#efefef" colspan="3" align="center"><b>Labor Cost Incurred</b></td>
                                <td style="background:#efefef" align="right"><b></b></td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20" align="center"><br></td>
                </tr>
                <tr style="border-top:1px solid #aeaeae">
                    <td colspan="20" align="center" style="background:#efefef"><b>Actual Rental Cost</b></td>
                </tr>
                <tr>
                    <td colspan="20">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td style="background:#efefef" width="5%">No.</td>
                                <td style="background:#efefef" width="45%">Equipment</td>
                                <td style="background:#efefef" width="8%">Rate</td>
                                <td style="background:#efefef" width="8%">Unit</td>
                                <td style="background:#efefef" width="14%">Days</td>
                                <td style="background:#efefef" width="12%">Total Cost</td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="background:#efefef" colspan="2" align="center"><b>Sub-Total</b></td>
                                <td style="background:#efefef" colspan="3" align="center"><b>Rental Cost</b></td>
                                <td style="background:#efefef" align="right"><b></b></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="background:#efefef"><br></td>
                            </tr>
                            <tr>
                                <td style="background:#fff700" colspan="2" align="center"><b>GRAND TOTAL</b></td>
                                <td style="background:#fff700" colspan="3" align="center"><b>Actual Project Cost</b></td>
                                <td style="background:#fff700" align="right"><b></b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="5"></td>  
                    <td colspan="10">
                        <table class="table-bordered" width="100%">
                            <tr>
                                <td style="background:#efefef" colspan="2"><center><b>SUMMARY</b></center></td>
                            </tr>
                            <tr> 
                                <td width="60%">Engine Parts</td>
                                <td width="40%"></td>
                            </tr>
                            <tr>
                                <td>Material</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Manpower</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Equipment</td>
                                <td></td>
                            </tr>
                            <tr style="background:#fff700">
                                <td>TOTAL</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Add: Service Fee</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Add: Vat 12%</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Withholding Tax 1%</td>
                                <td></td>
                            </tr>
                            <tr style="background:#00ff2b">
                                <td>TOTAL</td>
                                <td></td>
                            </tr>
                        </table>
                    </td>  
                    <td colspan="5"></td>  
                </tr>
                
                <!-- <tr>
                    <td colspan="2">Remarks:</td>
                    <td colspan="18" class="bor-btm1"></td>
                </tr> -->
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
            </table>
        </page>
    </div>
</div>
        




