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
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <select class="form-control">
                                        <option>-Choose Month-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <select class="form-control">
                                    <option>-Choose Buyer-</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-sm btn-success btn-rounded btn-block">submit</button>
                            </div>
                        </div>           
                        <table class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <td class="td-head" width="1%">#</td>
                                    <td class="td-head">Date</td>
                                    <td class="td-head">DR No</td>
                                    <td class="td-head">Part Number</td>
                                    <td class="td-head">Item Description</td>
                                    <td class="td-head">Serial No.</td>
                                    <td class="td-head">Qty</td>        
                                    <td class="td-head">UOM</td>        
                                    <td class="td-head">PGC PR No/ PO No</td>        
                                    <td class="td-head">Requestor</td>        
                                    <td class="td-head">Buyer</td>        
                                    <td class="td-head">Unit Cost </td>        
                                    <td class="td-head">Total Amt </td>        
                                    <td class="td-head">SI No.</td>     
                                    <td class="td-head">Remarks</td>     
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        




