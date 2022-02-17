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
                        <span></span>Item PR Report &nbsp;
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
                                <h4 class="m-0">Item PR Report</h4>
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
                            <div class="col-lg-2">
                                <input style="padding:10px " type="text" onfocus="(this.type='date')" placeholder="From" class="form-control" name="">
                            </div>
                            <div class="col-lg-2">
                                <input style="padding:10px " type="text" onfocus="(this.type='date')" placeholder="To" class="form-control" name="">
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control">
                                    <option>-- Select Category --</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control">
                                    <option>-- Select Sub Category --</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" name="" value="Filter">
                            </div>
                        </div>    
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
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
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
        




