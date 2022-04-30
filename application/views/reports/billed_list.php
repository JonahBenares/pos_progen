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
                                <h4>BILLED <br> <small>Billing Statement</small></h4><!-- 
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
                                   <select class="form-control" id='client'>
                                    <option value="">--Select Client--</option>
                                    <?php foreach($clients AS $c){ ?>
                                        <option value='<?php echo $c->client_id; ?>'><?php echo $c->buyer_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                          
                            <div class="col-lg-2">
                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" name="billedFilter" value="Filter" id='billedFilter'>
                            </div>
                             <?php if(!empty($client)){ ?>
                            <div class="col-lg-3 offset-lg-1">
                                    <small class="pull-right">Overall Total Amount</small><br>
                                    <h2 class="pull-right">P <?php echo number_format($grand_total,2); ?></h2>
                                </div>
                            <?php } ?>
                        </div>
                        <hr>  
                         <?php if(!empty($client)){ ?> 
                        <form>     
                            <table class=" table-hover table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="4%"> 
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </th>
                                        <th width="20%"><label class="label-table">Billing Date</label></th>
                                        <th width="20%"><label class="label-table">Billing Statement #</label></th>
                                        <th width="10%"><label class="label-table">Adjustments</label></th>
                                        <th width="21"><label class="label-table pull-right">Total Amount &nbsp;</label></th>
                                        <th width="5%" align="center">
                                            <center><span class="mdi mdi-menu"></span></center>
                                        </th>                                                                
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!empty($billed)){
                                    foreach($billed AS $b){ ?>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" name="billing_id" value="<?php echo $b['billing_id']; ?>" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; <?php echo date('F d, Y', strtotime($b['billing_date'])); ?></td>
                                        <td> &nbsp; <a href="<?php echo base_url(); ?>reports/print_billing/<?php echo $b['billing_id']; ?>" target="_blank"><?php echo $b['billing_no']; ?></a></td>
                                        <td> &nbsp; 
                                            <a onclick="adjust_all('<?php echo base_url(); ?>','<?php echo $b['billing_no']; ?>')" class="btn btn-link"><?php echo $b['counter']; ?></a>
                                        </td>
                                        <td align="right">P <?php echo number_format($b['total_amount'],2); ?> &nbsp;</td>
                                        <?php if($b['count_adjust']!= 0 ){ ?>
                                        <td align="center"><a href="<?php echo base_url(); ?>reports/adjustment_list/<?php echo $b['billing_id']; ?>" target="_blank" class="btn btn-primary btn-xs btn-rounded">Adjust</a></td>
                                    <?php } ?>
                                    </tr>
                                        <?php }
                                        } ?>
                                   
                                </tbody>
                            </table>
                            <br> 
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                    <input type='hidden' name='client_id' id='client_id' value='<?php echo $client; ?>'>
                                    <input type='button' onclick="bill_pay('<?php echo base_url(); ?>')" class="btn btn-gradient-success btn-md btn-block" value='Pay'>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                        </form>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
     <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reports.js"></script>    
