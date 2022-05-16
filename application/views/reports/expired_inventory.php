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
                                    <a href="<?php echo base_url(); ?>" class="btn btn-gradient-warning btn-sm btn-rounded">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">   
                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-3">
                                     
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <input type="button" class="btn btn-md btn-gradient-success btn-block" name="save" id="filter_sales" value="Filter" onclick="filter_monthlyreports()">
                                </div>
                            </div>   
                        </form> 
                        <hr>
                        <div id="printableArea">
                        <table class="table table-bordered table-hover" width="100%" id="myTable">
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
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><a href="" class="btn btn-gradient-danger btn-rounded btn-xs" style="font-size:12px">Dispose</a></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        

