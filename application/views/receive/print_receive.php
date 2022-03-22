<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-import"></i>
                </span> Receive
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>receive/receive_list">Receive List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Print Receive</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <center>
                    <a href="<?php echo base_url(); ?>receive/add_receive_head" class="btn btn-gradient-primary btn-sm btn-rounded">
                        <b><span class="mdi mdi-plus"></span> Add New</b>
                    </a>
                    <a href="#" class="btn btn-gradient-success btn-md btn-rounded" onclick="printDiv('printableArea')">
                        <b><span class="mdi mdi-printer"></span> Print</b>
                    </a>
                  <!--   <a href="<?php echo base_url(); ?>receive/update_receive_head" class="btn btn-gradient-info btn-sm btn-rounded">
                        <b><span class="mdi mdi-pencil"></span> Update</b>
                    </a> -->
                </center>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <br>
        <style type="text/css">
            
        </style>
        <page size="A4" id="printableArea">
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
                <?php foreach($head AS $h){ 
                    if($h->pcf == '1') {
                        $pcf = 'Yes';
                    } else {
                        $pcf = 'No';
                    }?>
                    <tr>
                        <td colspan="2">Date:</td>
                        <td colspan="8" class="bor-btm1"><?php echo $h->receive_date; ?></td>
                        <td colspan="2" align="right">MRF NO.:</td>
                        <td colspan="8" class="bor-btm1"><?php echo $h->mrecf_no; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">DR NO.:</td>
                        <td colspan="8" class="bor-btm1"><?php echo $h->dr_no; ?></td>
                        <td colspan="2" align="right">PO:</td>
                        <td colspan="8" class="bor-btm1"><?php echo $h->po_no; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">SI NO.:</td>
                        <td colspan="8" class="bor-btm1"> <?php echo $h->si_no; ?></td>
                        <td colspan="2" align="right">PCF:</td>
                        <td colspan="8" class="bor-btm1"><?php echo $pcf; ?></td>
                    </tr>
                   
                    <tr>
                        <td colspan="3">Overall Remarks:</td>
                        <td colspan="17" class="bor-btm1"> <?php echo $h->overall_remarks; ?></td>
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
                <!-- <tr>
                    <td colspan="20">
                        <fieldset>
                            <legend>PR/JO No.: PFLM201022-00299-CNPR</legend>
                            <table width="100%">
                                <tr>
                                    <td width="10%">Department:</td>
                                    <td width="70%" class="bor-btm1"> Progen Warehouse</td>
                                    <td width="5%"></td>
                                </tr>
                                <tr>
                                    <td width="10%">Purpose:</td>
                                    <td width="70%" class="bor-btm1">Replacement Parts for Refurbishing / Reconditioning</td>
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
                                    <td align="center" width="8%">U/M</td>
                                    <td align="center" width="15%">Part No.</td>
                                    <td align="center" width="25%">Item Description</td>
                                    <td align="center" width="25%">Supplier</td>
                                    <td align="center" width="10%">Cat No. / NKK No. / SEMT No.</td>
                                    <td align="center" width="15%">Brand</td>
                                    <td align="center" width="10%">Cost</td>
                                    <td align="center" width="10%">Shipping Fee </td>
                                    <td align="center" width="10%">Total Cost</td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>                           
                            </table>
                            <br>
                            <table width="100%">
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
                            </table>
                        </fieldset>
                    </td>
                </tr>
 -->

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
        




