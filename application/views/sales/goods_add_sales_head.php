<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-chart-areaspline"></i>
                </span> Sales
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>sales/goods_sales_list">Sales List (Goods)</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Sales</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class="m-0">Add New Sales (<b>Goods</b>)</h4>
                    </div>
                    <div class="card-body">      
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Client</label>
                                    <input type="text" class="form-control" placeholder="Client Name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>TIN</label>
                                    <input type="text" class="form-control" placeholder="TIN">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" placeholder="Date">
                                </div>
                            </div>                                    
                        </div>                  
                        <div class="row">
                            <div class="col-lg-6">                                
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Address">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Contact Person</label>
                                            <input type="text" class="form-control" placeholder="Contact Person">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" class="form-control" placeholder="Contact Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>PGC <b>PR </b>No.</label>
                                            <input type="text" class="form-control" placeholder="PGC PR No.">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>PGC <b>PO </b>No.</label>
                                            <input type="text" class="form-control" placeholder="PGC PO No.">
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>PR Date</label>
                                            <input type="date" class="form-control" placeholder="Date">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>PO Date</label>
                                            <input type="date" class="form-control" placeholder="DR No">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>DR No.</label>
                                            <input type="text" class="form-control" placeholder="DR No">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>VAT</label>
                                            <select class="form-control">
                                                <option>Vatable</option>
                                                <option>Non-Vatable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label><br></label>
                                            <a  href="<?php echo base_url(); ?>sales/goods_add_sales_itemlist"  class="btn btn-gradient-primary btn-sm btn-block btn-rounded">Proceed</a>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
        




