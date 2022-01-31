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
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>sales/sales_list">Sales List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Sales</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-info card-img-holder text-white">
                        <h4 class="m-0">Update Sales</h4>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample">
                            <div class="row">
                                <div class="col-lg-6">
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
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
        