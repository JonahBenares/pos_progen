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
                        <span></span>Inventory Range of Date &nbsp;
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
                                <h4 class="m-0">Inventory Range of Date</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>report/print_monthly_report" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </a>                            
                                    <a href="<?php echo base_url(); ?>reports/export_inventory_rangedate/<?php echo $from; ?>/<?php echo $to; ?>/<?php echo $cat; ?>/<?php echo $subcat; ?>" class="btn btn-gradient-warning btn-sm btn-rounded">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body"> 
                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-2">
                                    <input style="padding:10px " type="text" name="from" id="from" onfocus="(this.type='date')" placeholder="From" class="form-control" name="">
                                </div>
                                <div class="col-lg-2">
                                    <input style="padding:10px " type="text" name="to" id="to" onfocus="(this.type='date')" placeholder="To" class="form-control" name="">
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-control select2" name="category" id="category" onchange="chooseSubcat_range();">
                                        <option value="">-- Select Category --</option>
                                        <?php foreach($category AS $c){ ?>
                                            <option value="<?php echo $c->cat_id; ?>"><?php echo $c->cat_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-control select2" name="subcat" id="subcat"></select>
                                </div>
                                <div class="col-lg-2">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <input type="button" class="btn btn-md btn-gradient-success btn-block" id="filter_range" name="filter_range" value="Filter" onclick="filter_rangereport()">
                                </div>
                            </div>  
                        </form>  
                        <hr> 
                        <table class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <td class="td-head" width="10%">Part Number</td>
                                    <td class="td-head" width="40%">Item Description</td>
                                    <td class="td-head" width="10%">Avail Qty</td>    
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($head)){ foreach($head AS $h){ ?>
                                <tr>
                                    <td><?php echo $h['pn'];?></td>
                                    <td><?php echo $h['item'];?></td>
                                    <td><?php echo $h['total'];?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        




