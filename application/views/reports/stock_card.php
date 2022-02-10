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
                        <span></span>Stock Card &nbsp;
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
                                <h4 class="m-0">Stock Card</h4>
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
                            <div class="col-lg-4 offset-lg-3">
                                <!-- <input type="" class="form-control" name="" placeholder="Customer"> -->
                                <select class="form-control">
                                    <option>--Select Customer--</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" name="" value="Filter">
                            </div>
                        </div>
                        <hr>   
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="mb-0 font-weight-medium">
                                    Tape, Fiber Glass,  1" 013 mills, 30mtrs lengths, without adhesive 
                                </h3>
                            </div>
                            <div class="col-lg-6">
                                <div style="display: flex;" class="pull-right">
                                    <button type="button" class="btn btn-inverse-info btn-fw">
                                        <small>Running Balance</small>
                                        <h3 class="m-0">10029</h3>
                                    </button>
                                </div>
                            </div>
                        </div>     
                        <br>
                        <table class="table table-bordered table-hover" width="100%" id="myTdable">
                            <thead>
                                <tr>
                                    <td width="10%" class="td-head">Date</td>
                                    <td width="20%" class="td-head">Supplier </td>
                                    <td width="15%" class="td-head">PR #</td>
                                    <td width="15%" class="td-head">PO #</td>
                                    <td width="15%" class="td-head">Catalog No. </td>
                                    <td width="15%" class="td-head">Brand </td>
                                    <td width="10%" class="td-head">Method</td>
                                    <td width="10%" class="td-head">Total Unit Cost</td>
                                    <td width="5%" class="td-head">Qty</td>
                                    <td width="10%" class="td-head">Running Balance</td>
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
                                    <td>
                                        <!-- <div class="badge badge-primary badge-pill">Receive</div> -->
                                    </td>
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
                                    <td>
                                        <!-- <div class="badge badge-info badge-pill">Sales</div> -->
                                    </td>
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
        

