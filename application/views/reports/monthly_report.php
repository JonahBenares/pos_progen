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
                        <span></span>Monthly Report &nbsp;
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
                                <h4 class="m-0">Monthly Report</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <button type="button" onclick="printDiv('printableArea')" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </button>                          
                                    <a href="<?php echo base_url(); ?>reports/export_monthlyreport/<?php echo $month; ?>/<?php echo $client_id; ?>" class="btn btn-gradient-warning btn-sm btn-rounded">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body"> 
                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-5">
                                     <select class="form-control" name="month" id="month">
                                        <option value='' selected="selected">-Select Month-</option>
                                        <option value='01'>January</option>
                                        <option value='02'>February</option>
                                        <option value='03'>March</option>
                                        <option value='04'>April</option>
                                        <option value='05'>May</option>
                                        <option value='06'>June</option>
                                        <option value='07'>July</option>
                                        <option value='08'>August</option>
                                        <option value='09'>September</option>
                                        <option value='10'>October</option>
                                        <option value='11'>November</option>
                                        <option value='12'>December</option>
                                    </select>
                                </div>
                                <div class="col-lg-5">
                                    <select class="form-control" id="client_id" name="client_id">
                                        <option value="">-Choose Buyer-</option>
                                        <?php foreach($client AS $c){ ?>
                                            <option value="<?php echo $c->client_id; ?>"><?php echo $c->buyer_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <input type="button" class="btn btn-md btn-gradient-success btn-block" name="save" id="filter_sales" value="Filter" onclick="filter_monthlyreports()">
                                </div>
                            </div>   
                        </form> 
                        <hr> 
                        <div id="printableArea">      
                        <table class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <td class="td-head" width="1%">#</td>
                                    <td class="td-head">Date</td>
                                    <td class="td-head">DR No. / AR No.</td>
                                    <td class="td-head">Part Number</td>
                                    <td class="td-head">Item Description</td>
                                    <td class="td-head">Serial No.</td>
                                    <td class="td-head">Qty</td>        
                                    <td class="td-head">UOM</td>        
                                    <td class="td-head">PGC PR No/ PO No</td>     
                                    <td class="td-head">Buyer</td>        
                                    <td class="td-head">Unit Cost </td>        
                                    <td class="td-head">Total Amt </td>        
                                    <td class="td-head">Remarks</td>     
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($sales)){ $x=1; foreach($sales AS $s){ ?>
                                <tr>
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $s['sales_date'];?></td>
                                    <td><?php echo $s['dr_no'];?></td>
                                    <td><?php echo $s['original_pn'];?></td>
                                    <td><?php echo $s['item'];?></td>
                                    <td><?php echo $s['serial_no'];?></td>
                                    <td><?php echo $s['quantity'];?></td>
                                    <td><?php echo $s['uom'];?></td>
                                    <td><?php echo $s['pr_no']." / ".$s['po_no'];?></td>
                                    <td><?php echo $s['client'];?></td>
                                    <td><?php echo number_format($s['unit_cost'],2);?></td>
                                    <td><?php echo number_format($s['total'],2);?></td>
                                    <td><?php echo $s['remarks'];?></td>
                                </tr>
                                <?php $x++; } } ?>
                            </tbody>                            
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        




