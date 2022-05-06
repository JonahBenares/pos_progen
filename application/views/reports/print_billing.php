<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-file-document"></i>
                </span> Reports
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Billing Statement</li>
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
                    <a href="#" class="btn btn-gradient-success btn-md btn-rounded">
                        <b><span class="mdi mdi-printer"></span> Print</b>
                    </a>
                    <a href="<?php echo base_url(); ?>reports/bill_pay/<?php echo $billing_id; ?>" class="btn btn-gradient-info btn-md btn-rounded">
                        <b><span class="mdi mdi-cash"></span> Proceed Pay</b>
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
        <page size="A4">
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
                        <b>BILLING STATEMENT</b>
                        <br>
                        <br>
                    </td>
                </tr>
                <?php foreach($head AS $h){ ?>
                <tr>
                    <td></td>
                    <td colspan="2">No:</td>
                    <td colspan="4" class="bor-btm1"><?php echo $h['billing_no']; ?></td>
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
                    <td colspan="5">Mary Grace Bugna</td>
                    <td></td>
                    <td colspan="5">Jordan T. Yap</td>
                    <td></td>
                    <td colspan="6">Merry Michelle D. Dato</td>
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
        




