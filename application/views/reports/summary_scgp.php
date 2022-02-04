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
                        <span></span>Summary of Sales, Costs, and Gross Profit &nbsp;
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
                                <h4 class="m-0">Summary of Sales, Costs, and Gross Profit</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-gradient-success btn-sm btn-rounded" data-toggle="modal" data-target="#filterSales">
                                        <b><span class="mdi mdi-filter"></span> Filter</b>
                                    </button>
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
                        <table class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <td class="td-head" width="1%">#</td>
                                    <td class="td-head">Date</td>
                                    <td class="td-head">Item Code</td>
                                    <td class="td-head">Item Description</td>
                                    <td class="td-head">Customer</td>
                                    <td class="td-head">PO/JO No.</td>
                                    <td class="td-head">Billing Statement No</td>        
                                    <td class="td-head">Qty</td>        
                                    <td class="td-head">UoM</td>        
                                    <td class="td-head">Total Sales</td>        
                                    <td class="td-head">Total Cost</td>        
                                    <td class="td-head">Gross Profit </td>   
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
                                </tr>
                                <tr>
                                    <td class="td-head" colspan="9">
                                        <p class="pull-right m-0"><b>TOTAL</b></p>
                                    </td>
                                    <td class="td-head"></td>
                                    <td class="td-head"></td>
                                    <td class="td-head"></td>
                                </tr>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- //Filter Sales// -->
<div class="modal fade" id="filterSales" tabindex="-1" role="dialog" aria-labelledby="filterSales" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header success-modalhead">
                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="forms-sample">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date from</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date To</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Item Code</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Item Description</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>PO/JO No</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Billing Statement No</label>
                        <input type="text" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Filter</button>
            </div>
        </div>
    </div>
</div>
        




