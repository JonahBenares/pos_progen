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
                        <span></span>Sales Backorder &nbsp;
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
                                <h4 class="m-0">Sales Backorder</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <button type="button" onclick="printDiv('printableArea')" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </button>                               
                                    <a href="<?php echo base_url(); ?>reports/export_expired/" class="btn btn-gradient-warning btn-sm btn-rounded">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3"> 
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="date" class="form-control" type="text" name="sales_date" id="sales_date" onfocus="(this.type='date')">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <input type="submit" class="btn btn-md btn-gradient-success btn-block" value="Filter" onclick="LoadSalesBO()">
                                </div>
                            </div>   
                        <hr>
                        <?php 
                                if(!empty($date)){ 
                        ?>   
                        <div id="printableArea">
                        <table class="table table-bordered table-hover" width="100%" id="myTable">
                            <thead>
                                <tr>
                                    <th width="20%">Client</th>
                                    <th width="20%">Item Name</th>
                                    <th width="%">DR No</th>
                                    <th width="7%">Qty</th>
                                    <th width="7%">Expected qty </th>
                                    <th width="%">PO No</th>
                                    <th width="%">PR No</th>
                                    <th width="5%"><center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if(!empty($sales_backorder)){ 
                                    foreach($sales_backorder AS $sb) {
                            ?>
                                <tr>
                                    <td><?php echo $sb['client']; ?></td>
                                    <td><?php echo $sb['item']; ?></td>
                                    <td><?php echo $sb['dr_no']; ?></td>
                                    <td><?php echo $sb['quantity']; ?></td>
                                    <td><?php echo $sb['expected_qty']; ?></td>
                                    <td><?php echo $sb['po_no']; ?></td>
                                    <td><?php echo $sb['pr_no']; ?></td>
                                    <td></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        

