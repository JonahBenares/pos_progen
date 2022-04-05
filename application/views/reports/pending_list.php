<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
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
                                <h4>PENDING <br> <small>Billing Statement</small></h4><!-- 
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
                            <div class="col-lg-3">
                                <!-- <input type="" class="form-control" name="" placeholder="Customer"> -->
                                <form method="POST"> 
                                <select class="form-control" id='client'>
                                    <option value="">--Select Client--</option>
                                    <?php foreach($clients AS $c){ ?>
                                        <option value='<?php echo $c->client_id; ?>'><?php echo $c->buyer_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <!-- <input type="" class="form-control" name="" placeholder="Customer"> -->
                                <select class="form-control" id='type'>
                                    <option value="">--Type--</option>
                                    <option value='1'>Delivery Reciept - Goods</option>
                                    <option value='2'>Delivery Reciept - Services</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                 <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                <input type="button" class="btn btn-md btn-gradient-success btn-block" name="pending_filter" value="Filter" id='pendingFilter'>
                            </div>
                           </form>
                            <?php if(!empty($client)){ ?>
                                <div class="col-lg-3 offset-lg-1">
                                    <small class="pull-right">Overall Total Amount</small><br>
                                    <h2 class="pull-right">P <?php echo number_format($grand_total,2); ?></h2>
                                </div>
                            <?php } ?>
                        </div>
                        <hr>  
                         <?php if(!empty($client)){ ?>   
                        <form id='pendingTable'>   

                            <table class=" table-hover table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="4%"> 
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </th>
                                        <th width="30%"><label class="label-table">DR Date</label></th>
                                        <th width="30%"><label class="label-table">DR No</label></th>
                                        <th width="31"><label class="label-table pull-right">Total Amount &nbsp;</label></th>         
                                    </tr>
                                </thead>
                                 <tbody>
                                <?php if($type=='1'){ 
                                        if(!empty($sales_goods)){?>
                                    
                                    <?php foreach($sales_goods AS $sg){ ?>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" name="sales_id" value="<?php echo $sg['sales_id']; ?>" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; <?php echo date('F d, Y', strtotime($sg['dr_date'])); ?></td>
                                        <td> &nbsp; <?php echo $sg['dr_no']; ?></td>
                                        <td align="right">P <?php echo number_format($sg['total'],2); ?> &nbsp;</td>
                                    </tr>
                                    <?php } 
                                } ?>
                                
                                <?php } else if($type=='2') {
                                    if(!empty($sales_services)){ ?>
                                       <?php foreach($sales_services AS $ss){ ?>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" name="sales_id" value="<?php echo $ss['sales_id']; ?>" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; <?php echo date('F d, Y', strtotime($ss['dr_date'])); ?></td>
                                        <td> &nbsp; <?php echo $ss['dr_no']; ?></td>
                                        <td align="right">P <?php echo number_format($ss['total'],2); ?> &nbsp;</td>
                                    </tr>
                                    <?php } 
                                } ?>

                             
                            <?php } ?>
                                </tbody>
                            </table>
                            <br> 
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                    <input type='hidden' name='client_id' id='client_id' value='<?php echo $client; ?>'>
                                    <input type='hidden' name='salestype' id='salestype' value='<?php echo $type; ?>'>
                                    <input type='button' onclick="bill_pending('<?php echo base_url(); ?>')" class="btn btn-gradient-success btn-md btn-block" value='Bill'>
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
        
