<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-tag-multiple"></i>
                </span> Sales
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Sales List &nbsp;
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
                                <h4 class="m-0">Sales List</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-gradient-primary btn-sm btn-rounded" data-toggle="modal" data-target="#addSales">
                                        <b><span class="mdi mdi-plus"></span> Add</b>
                                    </button>
                                    <button type="button" class="btn btn-gradient-success btn-sm btn-rounded" data-toggle="modal" data-target="#filterSales">
                                        <b><span class="mdi mdi-filter"></span> Filter</b>
                                    </button>                            
                                    <button type="button" class="btn btn-gradient-warning btn-sm btn-rounded" data-toggle="modal" data-target="#updateSales">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">                        
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <td >DR Date</td>
                                    <td >DR No.</td>
                                    <td >Buyer</td>
                                    <td >Address</td>
                                    <td >Shipped Via</td>
                                    <td >Waybill No.</td>                                    
                                    <td >Source PR No.</td>
                                    <td >PGC PR No. /PO No.</td> 
                                    <th width="10%"><center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="center">
                                    <a href="<?php echo base_url(); ?>sales/update_sales" class="btn btn-xs btn-gradient-info btn-rounded" ><span class="mdi mdi-pencil"></span></a>
                                    <a href="" class="btn btn-xs btn-gradient-danger btn-rounded" data-toggle="modal" data-target="#deleteSales"><span class="mdi mdi-delete"></span></a>
                                </td>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Add Sales// -->
        <div class="modal fade" id="addSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Sales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" placeholder="Sales">
                            </div>
                            <div class="form-group">
                                <label>PO/PR Date</label>
                                <input type="Date" class="form-control" placeholder="Sales">
                            </div>
                            <div class="form-group">
                                <label>Source PR Number</label>
                                <select class="form-control"></select>
                            </div>
                            <div class="form-group">
                                <label>PGC PR No./PO No.</label>
                                <input type="Date" class="form-control" placeholder="Sales">
                            </div>
                            <div class="form-group">
                                <label>Buyer</label>
                                <select class="form-control"></select>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="Text" class="form-control" placeholder="Sales">
                            </div>
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="Text" class="form-control" placeholder="Sales">
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="Text" class="form-control" placeholder="Sales">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value=""> Vat <i class="input-helper"></i></label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked=""> Non-Vat <i class="input-helper"></i></label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Filter Sales// -->
        <div class="modal fade" id="filterSales" tabindex="-1" role="dialog" aria-labelledby="filterSales" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header success-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Sales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label>Sales</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Sales">
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

        <!-- //Update Sales// -->
        <div class="modal fade" id="updateSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header info-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Sales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label>Sales</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Sales">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Update Sales</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Delete Sales// -->
        <div class="modal fade" id="deleteSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content " >
                    <div class="modal-header danger-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Sales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <br>
                        <br>
                        <center>Do you want to delete _________?</center>
                        <br>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
        




