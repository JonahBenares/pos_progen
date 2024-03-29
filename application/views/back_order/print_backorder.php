<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-backup-restore"></i>
                </span> Back Order
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>back_order/backorder_form">Back Order</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Print Back Order</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <center>
                    <a href="#" class="btn btn-gradient-success btn-md btn-rounded" onclick="printDiv('printableArea')">
                        <b><span class="mdi mdi-printer"></span> Print</b>
                    </a>
                </center>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <br>
        <page size="A4" id="printableArea">
            <?php 
               foreach($heads AS $hd){  
                    $date=$hd->receive_date;
                    $mrec=$hd->mrecf_no;
                    $dr= $hd->dr_no;
                    $po= $hd->po_no;
                    $pcf= $hd->pcf;
                    $si= $hd->si_no;
                    $delivered= $hd->delivered_by;
                    $received= $hd->received_by;
                    $acknowledged= $hd->acknowledged_by;
                    $noted= $hd->noted_by;
                    $overall_remarks= $hd->overall_remarks;
               }
            ?>
            <table class="page-A4 table-bsordered" width="100%">
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
                        <b>MATERIAL RECEIVING & INSPECTION FORM</b>
                        <br>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Date:</td>
                    <td colspan="8" class="bor-btm1"><?php echo ($date!='') ? date("M j, Y",strtotime($date)) : '' ;?></td>
                    <td colspan="2" align="right">MRF NO.:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $mrec; ?></td>
                </tr>
                <tr>
                    <td colspan="2">DR NO.:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $dr; ?></td>
                    <td colspan="2" align="right">PO:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $po; ?></td>
                </tr>
                <tr>
                    <td colspan="2">SI NO.:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $si; ?></td>
                    <td colspan="2" align="right">PCF:</td>
                    <td colspan="8" class="bor-btm1"><?php if ($pcf == 1) {echo 'Yes';};?></td>
                </tr>
               
                <tr>
                    <td colspan="3">Overall Remarks:</td>
                    <td colspan="17" class="bor-btm1"><?php echo $overall_remarks; ?></td>
                </tr>
                <tr>
                    <td colspan="20" align="center"><br><br></td>
                </tr>
            
                <tr>
                    <td colspan="20">
                        <fieldset>
                            <?php 

                                foreach($details AS $det){ 
                            ?>
                            <legend>PR/JO No.: <?php echo $det['prno'];?></legend>
                            <table width="100%">
                                <tr>
                                    <td width="10%">Department:</td>
                                    <td width="70%" class="bor-btm1"> <?php echo $det['department'];?></td>
                                    <td width="5%"></td>
                                </tr>
                                <tr>
                                    <td width="10%">Purpose:</td>
                                    <td width="70%" class="bor-btm1"><?php echo $det['purpose'];?></td>
                                    <td width="5%"></td>
                                </tr>
                                <tr>
                                    <td width="10%">Enduse:</td>
                                    <td width="70%" class="bor-btm1">Replacement Parts for Refurbishing / Reconditioning</td>
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
                                    <td align="center" width="10%">Total Cost </td>
                                </tr> 
                            <?php
                             $x =1; 
                                foreach($items AS $it){ 
                                    switch($it){
                                        case($det['rdid'] == $it['rdid']):
                                            if($it['recqty']!=0){
                            ?>
                            <tr>
                                <td class="main-tab" align="center"><?php echo $x; ?></td>
                                <td class="main-tab" align="center"><?php echo number_format($it['recqty'],2); ?></td>
                                <td class="main-tab" align="left">&nbsp;<?php echo $it['item']; ?></td>
                                <td class="main-tab" align="center"><?php echo $it['supplier'];?></td>
                                <td class="main-tab" align="center"><?php echo $it['serial'];?></td>
                                <td class="main-tab" align="center"><?php echo $it['catno'];?></td>
                                <td class="main-tab" align="center"><?php echo $it['brand'];?></td>
                                <td class="main-tab" align="center"><?php echo number_format($it['unitcost'],2);?></td>
                                <td class="main-tab" align="center"><?php echo number_format($it['shipping_fee'],2);?></td>
                                <td class="main-tab" align="center"><?php echo number_format($it['total'],2);?></td>
                            </tr>
                            <?php  
                                            }
                                $x++;
                                break;
                                default: 
                                }  }  

                            ?>                          
                            </table>
                            <br>
                           <!--  <table width="100%">
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
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5"><b>Prepared by:</b></td>
                    <td></td>
                    <td colspan="5"><b>Delivered by:</b></td>
                    <td></td>
                    <td colspan="6"><b>Received by:</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" class="bor-btm1" align="center">Mary Grace Bugna</td>
                    <td></td>
                    <td colspan="5" class="bor-btm1" align="center"></td>
                    <td></td>
                    <td colspan="6" class="bor-btm1" align="center">Merry Michelle D. Dato</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;">Sales Officer</td>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;">Supplier/Driver</td>
                    <td></td>
                    <td colspan="6" align="center" style="vertical-align:text-top;">Warehouse Assistant</td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5"><b>Acknowledged by:</b></td>
                    <td></td>
                    <td colspan="5"><b></b></td>
                    <td></td>
                    <td colspan="6"><b>Noted by:</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" class="bor-btm1" align="center">Mary Grace Bugna</td>
                    <td></td>
                    <td colspan="5"></td>
                    <td></td>
                    <td colspan="6" class="bor-btm1" align="center"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;">Warehouse Supervisor</td>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;"></td>
                    <td></td>
                    <td colspan="6" align="center" style="vertical-align:text-top;">Plant Director</td>
                    <td></td>
                </tr>
            </table>
        </page>
    </div>
</div>
        




