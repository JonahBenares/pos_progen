<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-file-document"></i>
                </span> Billing
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>billing/billing_list">Billing List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Billing</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class="m-0">Add New Billing</h4>
                    </div>
                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <input type="text" class="form-control" placeholder="Buyer Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Address">
                                </div>                                
                            </div>
                        </div>                                 
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control">
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
                                    <label>PO/JO No</label>
                                    <input type="text" class="form-control" placeholder="PO/JO No">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>PO/JO Date</label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9"></div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label><br></label>
                                    <a  href="<?php echo base_url(); ?>billing/add_billing_itemlist"  class="btn btn-gradient-primary btn-sm btn-block btn-rounded">Proceed</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
        




