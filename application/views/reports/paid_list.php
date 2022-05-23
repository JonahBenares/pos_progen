<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reports.js"></script>
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
                                    <a href="<?php echo base_url(); ?>reports/export_paid/<?php echo $client; ?>" class="btn btn-gradient-warning btn-sm btn-rounded">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">   
                        <div id="printableArea">
                            <div class="row">
                                <div class="col-lg-3 offset-lg-9">
                                    <small class="pull-right">Overall Total Paid</small><br>
                                    <h2 class="pull-right">P <?php echo number_format($grand_total,2); ?></h2>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <table class="table table-hover table-bordered" width="100%" id="myTable">
                            <thead>           
                                <tr>
                                    <th>Payment Date</th>
                                    <th>Billing #</th>
                                    <th>DR #</th>
                                    <th>Payment Type</th>
                                    <th>Check/Receipt #</th>
                                    <th width="12%">Amount Paid</th>
                                </tr>
                            </thead>   
                            <tbody>     
                             <?php 
                            if(!empty($payment)){
                                foreach($payment AS $p){ ?>
                                <tr>
                                    <td> &nbsp; <?php echo date('F d, Y', strtotime($p['payment_date'])); ?></td>
                                    <td> &nbsp; <?php echo $p['billing_no']; ?></td>
                                    <td> &nbsp; <?php echo $p['dr_no']; ?></td>
                                    <td> &nbsp; <?php echo $p['payment_type']; ?> &nbsp;</td>
                                    <td> &nbsp; <?php echo $p['check_no']. " / " .$p['receipt_no']; ?> &nbsp;</td>
                                    <td align="right">P <?php echo number_format($p['amount'],2); ?> &nbsp;</td>
                                </tr>
                              <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reports.js"></script> 