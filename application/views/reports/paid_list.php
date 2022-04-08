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
                                    <a href="<?php echo base_url(); ?>report/print_monthly_report" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </a>                            
                                    <button type="button" class="btn btn-gradient-warning btn-sm btn-rounded" data-toggle="modal" data-target="#updateSales">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">   
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- <input type="" class="form-control" name="" placeholder="Customer"> -->
                                <select class="form-control" name='client' id='client'>
                                     <option value="">--Select Client--</option>
                                    <?php foreach($clients AS $c){ ?>
                                        <option value='<?php echo $c->client_id; ?>'><?php echo $c->buyer_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                           
                            <div class="col-lg-2">
                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" name="paidFilter" value="Filter" id='paidFilter'>
                            </div>
                             <?php if(!empty($client)){ ?>
                            <div class="col-lg-3 offset-lg-1">
                                <small class="pull-right">Overall Total Paid</small><br>
                                <h2 class="pull-right">P <?php echo number_format($grand_total,2); ?></h2>
                            </div>
                        <?php } ?>
                        </div>
                        <hr>   
                      
                         <?php if(!empty($client)){ ?>  
                            <table class="table table-hover table-bordered" width="100%" id="myTable">
                                <thead>
                                    <tr>
                                        <th><label class="label-table">Payment Date</label></th>
                                        <th><label class="label-table">Billing Statement #</label></th>
                                        <th><label class="label-table">DR #</label></th>
                                        <th ><label class="label-table">Payment Type</label></th>
                                        <th ><label class="label-table">Check/Receipt #</label></th>
                                        <th ><label class="label-table">Amount Paid</label></th>
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
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        