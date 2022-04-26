

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
                                <h4>TRANSACTION ADJUSTMENT <br> <small>Billing Statement</small></h4><!-- 
                                <h4 class="m-0">Billing Statement - <b>PENDING</b></h4> -->
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <!-- <button type="button" class="btn btn-gradient-success btn-sm btn-rounded" data-toggle="modal" data-target="#filterBillingState">
                                        <b><span class="mdi mdi-filter"></span> Filter</b>
                                    </button>  -->
                                   <!--  <a href="<?php echo base_url(); ?>report/print_monthly_report" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </a>                            
                                    <button type="button" class="btn btn-gradient-warning btn-sm btn-rounded" data-toggle="modal" data-target="#updateSales">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">   
                        <div class="row">
                            <div class="col-lg-12">
                                <table width="100%" class="table-bordered">
                                    <tr>
                                        <td style="background:#efefef" colspan="3">
                                            <h4 class="m-2"><b><?php echo "Billing #: " .$billing_no; ?></b></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Date</td>
                                        <td width="15%">DR No.</td>
                                        <td width="65%">Remarks</td>
                                    </tr>
                                    <?php foreach($adjustments AS $adj) { ?>
                                    <tr>
                                        <td class="p-0"><?php echo $adj->adjustment_date; ?></td>
                                        <td class="p-0"><?php echo $adj->dr_no; ?></td>
                                        <td class="p-0"><?php echo $adj->remarks; ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                               
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type='hidden' name='baseurl' id='baseurl' value ="<?php echo base_url(); ?>">
                                    <input type='hidden' name='billing_id' id='billing_id' value ="<?php echo $billing_id; ?>">
                                    <input type='hidden' name='billing_no' id='billing_no' value ="<?php echo $billing_no; ?>">
                                    <button class="btn btn-info btn-sm btn-block" onclick="generateAdjustment()">Generate Adjustment Form</button>
                                </div>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
     <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reports.js"></script>    
