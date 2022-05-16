
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
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Billing Statement &nbsp;
                        <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>PAID <br> <small>Billing Statement</small></h4><!-- 
                                <h4 class="m-0">Billing Statement - <b>PENDING</b></h4> -->
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <!-- <button type="button" class="btn btn-gradient-success btn-sm btn-rounded" data-toggle="modal" data-target="#filterBillingState">
                                        <b><span class="mdi mdi-filter"></span> Filter</b>
                                    </button>  -->
                                    <button type="button" onclick="printDiv('printableArea')" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </button>                                
                                    <a href="<?php echo base_url(); ?>reports/export_billed/" class="btn btn-gradient-warning btn-sm btn-rounded">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">   
                    <div id="printableArea"> 
                        <table class="table table-hover table-bordered" width="100%" id="">
                            <tr>
                                <td colspan="5">
                                    <h4 class="m-0">
                                        <b><?php echo $billing_no; ?></b>  <br>             
                                        <!-- <small>Central Negros Power Reliability, Inc.</small> -->
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td>Payment Date</td>
                                <td>DR #</td>
                                <td>Payment Type</td>
                                <td>Check/Receipt #</td>
                                <td width="12%">Amount Paid</td>
                            </tr>
                           <?php 
                                    if(!empty($payment)){
                                        foreach($payment AS $p){ ?>
                                        <tr>
                                            <td> &nbsp; <?php echo date('F d, Y', strtotime($p['payment_date'])); ?></td>
                                            <td> &nbsp; <?php echo $p['dr_no']; ?></td>
                                            <td> &nbsp; <?php echo $p['payment_type']; ?> &nbsp;</td>
                                            <td> &nbsp; <?php echo $p['check_no']. " / " .$p['receipt_no']; ?> &nbsp;</td>
                                            <td align="right">P <?php echo number_format($p['amount'],2); ?> &nbsp;</td>
                                        </tr>
                                      <?php }
                                  } ?>
                            <tr>
                                <td colspan="4" align="right">Total:</td>
                                <td align="right"><?php echo number_format($grand_total,2); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
     <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reports.js"></script>    
