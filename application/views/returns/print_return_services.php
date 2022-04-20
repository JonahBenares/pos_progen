<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi mdi-sync"></i>
                </span> Return (Services)
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>returns/return_services">Return Form Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page" onclick="printDiv('printableArea')">Print Return Services</li>
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
                        <b>RETURN FORM <br>(Services)</b>
                        <br>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Returned by:</td>
                    <td colspan="9" class="bor-btm1">Client Name</td>
                    <td></td>
                    <td colspan="3" align="right">JOR/PR No:</td>
                    <td colspan="5" class="bor-btm1">&nbsp; JOR288828</td>
                </tr>
                <tr>
                    <td colspan="2">Purpose:</td>
                    <td colspan="9" class="bor-btm1">sample</td>
                    <td></td>
                    <td colspan="3" align="right">Date:</td>
                    <td colspan="5" class="bor-btm1">&nbsp; July 12, 2002</td>
                </tr>
                <tr>
                    <td colspan="2">Department:</td>
                    <td colspan="9" class="bor-btm1">IT Department</td>
                    <td></td>
                    <td colspan="3" align="right">DR No. :</td>
                    <td colspan="5" class="bor-btm1">&nbsp; DR-92883</td>
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
                                    Reconditioning of the following:<br>
                                    <br>
                                    1. Cylinder Head - 5 units (SN:_____,____,...)<br>
                                    2. Piston - 6 units (SN:_____,______,...)  
                                    <br>                                                     
                                    <br>                                                     
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
               <!--  <tr>
                    <td></td>
                    <td colspan="18">
                        <table class="table-bordered" width="100%">
                            <tr>
                                <td class="td-head" width="6%">Return Qty</td>
                                <td class="td-head" width="20%">Item Description</td>
                                <td class="td-head" width="20%">Supplier</td>
                                <td class="td-head" width="5%">Unit Cost</td>
                                <td class="td-head" width="5%">Selling Price</td>
                                <td class="td-head" width="10%">Brand</td>
                                <td class="td-head" width="10%">Part No.</td>
                                <td class="td-head" width="10%">Serial No.</td>
                                <td class="td-head" width="10%">Total Cost</td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="left">&nbsp;</td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                            </tr>
                        </table>
                        <br> 
                        Consumables and Other Materials   
                        <table class="table-bordered" width="100%">
                            <tr>
                                <td class="td-head" width="6%">Qty</td>
                                <td class="td-head" width="45%">Item Description</td>
                                <td class="td-head" width="8%">UOM</td>
                                <td class="td-head" width="14%">Unit Cost</td>
                                <td class="td-head" width="10%">Total Cost</td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="left">&nbsp;</td>
                            </tr>
                        </table>

                        <br> 
                        Manpower
                        <table class="table-bordered" width="100%">
                            <tr>
                                <td class="td-head" width="45%">Employee</td>
                                <td class="td-head" width="8%">Days</td>
                                <td class="td-head" width="8%">Rate</td>
                                <td class="td-head" width="14%">Overtime</td>
                                <td class="td-head" width="10%">Total</td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="left">&nbsp;</td>
                            </tr>
                        </table>

                        <br> 
                        Actual Rental Cost
                        <table class="table-bordered" width="100%">
                            <tr>
                                <td class="td-head" width="8%">Qty</td>
                                <td class="td-head" width="45%">Equipment</td>
                                <td class="td-head" width="8%">Rate</td>
                                <td class="td-head" width="8%">Unit</td>
                                <td class="td-head" width="14%">Days/Hours</td>
                                <td class="td-head" width="11%">Total</td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="left">&nbsp;</td>
                            </tr>
                        </table>
                        <br>
                    </td>
                    <td></td>
                </tr> -->
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="2">Remarks:</td>
                    <td colspan="18" class="bor-btm1"></td>
                </tr>
                <tr>
                    <td colspan="20"><br><br><br></td>
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
        




