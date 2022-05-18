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
                        <span></span>Expired Inventory &nbsp;
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
                                <h4 class="m-0">Expired Inventory</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <button type="button" onclick="printDiv('printableArea')" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </button>                               
                                    <a href="<?php echo base_url(); ?>reports/export_expired/<?php echo $date; ?>" class="btn btn-gradient-warning btn-sm btn-rounded">
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
                                        <input type="date" class="form-control" type="text" name="date" id="date" onfocus="(this.type='date')">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <input type="submit" class="btn btn-md btn-gradient-success btn-block" value="Filter" onclick="LoadExpiredItems()">
                                </div>
                            </div>   
                        <hr>
                        <?php if(!empty($date)){ ?>    
                        <div id="printableArea">
                        <table class="table table-bordered table-hover" width="100%" id="expiredinventory">
                            <thead>
                                <tr>
                                    <td width="30%">Item Name</td>
                                    <td width="6%">Qty</td>
                                    <td width="10%">Expiration Date</td>
                                    <td width="15%">PR #</td>
                                    <td width="15%">Brand </td>
                                    <td width="15%">Catalog No. </td>
                                    <th width="5%"><center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
                                    if(!empty($expired)){
                                    foreach($expired AS $e){ ?>
                                <tr>
                                    <td><?php echo $e['item']; ?></td>
                                    <td><?php echo number_format($e['received_qty'],2); ?></td>
                                    <td><?php echo date('F d, Y', strtotime($e['expiration_date'])); ?></td>
                                    <td><?php echo $e['pr_no']; ?></td>
                                    <td><?php echo $e['brand']; ?></td>
                                    <td><?php echo $e['catalog_no']; ?></td>
                                    <?php if($e['dispose']=='0'){ ?>
                                        <td><a href="<?php echo base_url(); ?>index.php/reports/dispose_item/<?php echo $e['ri_id']; ?>" class="btn btn-gradient-danger btn-rounded btn-xs" style="font-size:12px" onclick="return confirm('Are you sure you want to Dispose this item?')">Dispose</a></td>
                                    <?php } else { ?>
                                    <td>Disposed</td>
                                    <?php } ?>
                                </tr>
                                <?php }
                                        } ?>
                            </tbody>
                        </table>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        

