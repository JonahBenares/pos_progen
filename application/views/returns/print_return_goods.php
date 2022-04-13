<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi mdi-sync"></i>
                </span> Return (Goods)
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>returns/return_form">Return Form</a></li>
                    <li class="breadcrumb-item active" aria-current="page" onclick="printDiv('printableArea')">Print Return Goods</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <center>
                    <!-- <a href="<?php echo base_url(); ?>billing/add_billing_head" class="btn btn-gradient-primary btn-sm btn-rounded">
                        <b><span class="mdi mdi-plus"></span> Add New</b>
                    </a> -->
                    <a href="#" class="btn btn-gradient-success btn-md btn-rounded" onclick="printDiv('printableArea')">
                        <b><span class="mdi mdi-printer"></span> Print</b>
                    </a>
                    <!-- <a href="<?php echo base_url(); ?>billing/update_billing_head" class="btn btn-gradient-info btn-sm btn-rounded">
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
            <table class="page-A4 table-bordsered" width="100%">
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
                        <b>RETURN FORM <br>(Goods)</b>
                        <br>
                        <br>
                    </td>
                </tr>
                <?php foreach($head AS $h){ ?>
                <tr>
                    <td></td>
                    <td colspan="2">Returned by:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $h['client']; ?></td>
                    <td></td>
                    <td colspan="3">JOR/PR No:</td>
                    <td colspan="4" class="bor-btm1"><?php echo $h['pr_no']; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">Purpose:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $h['purpose']; ?></td>
                    <td></td>
                    <td colspan="3">Date:</td>
                    <td colspan="4" class="bor-btm1"><?php echo $h['date']; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">Department:</td>
                    <td colspan="8" class="bor-btm1"><?php echo $h['department']; ?></td>
                    <td></td>
                    <td colspan="3">DR No. :</td>
                    <td colspan="4" class="bor-btm1"><?php echo $h['dr_no']; ?></td>
                    <td></td>
                </tr>
                <?php } ?>
                <!-- <tr>
                    <td></td>
                    <td colspan="2">Enduse:</td>
                    <td colspan="8" class="bor-btm1"></td>
                    <td></td>
                    <td colspan="3"></td>
                    <td colspan="4" class=""></td>
                    <td></td>
                </tr> -->
                <tr>
                    <td colspan="20" align="center"><br><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="18">
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
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Remarks:</td>
                    <td colspan="17" class="bor-btm1"></td>
                    <td></td>
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
                    <td></td>
                    <td colspan="5"></td>
                    <td></td>
                    <td colspan="5"></td>
                    <td></td>
                    <td colspan="6"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5">Sales Officer</td>
                    <td></td>
                    <td colspan="5">Internal Auditor</td>
                    <td></td>
                    <td colspan="6">Assets & Projects Management Assistant</td>
                    <td></td>
                </tr>
            </table>
        </page>
    </div>
</div>
        




