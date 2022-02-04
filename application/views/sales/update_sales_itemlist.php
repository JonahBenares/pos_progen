<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-chart-areaspline"></i>
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
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Buyer</label>
                                    <input type="text" class="form-control" placeholder="Buyer Name">
                                </div>
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
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Source PR Number</label>
                                            <input type="text" class="form-control" placeholder="Source PR Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>PGC PR No./PO No.</label>
                                            <input type="text" class="form-control" placeholder="PGC PR No./PO No.">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" class="form-control" placeholder="Date">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>DR No.</label>
                                            <input type="text" class="form-control" placeholder="DR No">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>PR/PO Date</label>
                                            <input type="date" class="form-control" placeholder="PR/PO Date">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>VAT</label>
                                            <select class="form-control">
                                                <option>Vatable</option>
                                                <option>Non-Vatable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div> 
                        <hr> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div > <!-- style="width:100%;overflow-x: scroll;" -->
                                    <div class="col-lg-12">
                                        <button class="btn btn-gradient-primary btn-xs pull-right " onclick="add_sales_items('<?php echo base_url(); ?>')" name="">
                                            <span class="mdi mdi-plus"></span> Add Item
                                        </button>  
                                    </div>      
                                    <br>
                                    <br>                        
                                    <table id="table-alt" class="table-bordered" width="100%">
                                        <tr>
                                            <td class="td-head" width="1%">#</td>
                                            <td class="td-head" width="">Part No.</td>
                                            <td class="td-head" width="">Item Description</td>
                                            <td class="td-head" width="">Cross Reference</td>
                                            <td class="td-head" width="">Serial No.</td>
                                            <td class="td-head" width="5%">Qty</td>
                                            <td class="td-head" width="3%">UOM</td>
                                            <td class="td-head" width="">Selling Price</td>
                                            <td class="td-head" width="">Discount</td>
                                            <td class="td-head" width="">Shipping Fee</td>
                                            <td class="td-head" width="">Total Cost</td>
                                            <td class="td-head" width="2%">
                                                <span class="mdi mdi-menu"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>01</td>
                                            <td>sample</td>
                                            <td>sample</td>
                                            <td>sample</td>
                                            <td>sample</td>
                                            <td>282</td>
                                            <td>kg</td>
                                            <td>sample</td>
                                            <td>sample55</td>
                                            <td>sample</td>
                                            <td>sample</td>
                                            <td><a href="" class="btn btn-danger btn-xs btn-rounded"><span class="mdi mdi-window-close"></span></a></td>             
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>sample</td>
                                            <td>sample</td>
                                            <td>sample</td>
                                            <td>sample</td>
                                            <td>554</td>
                                            <td>kg</td>
                                            <td>sample</td>
                                            <td>sample</td>
                                            <td>sample</td>
                                            <td>sample</td>          
                                            <td><a href="" class="btn btn-danger btn-xs btn-rounded"><span class="mdi mdi-window-close"></span></a></td>    
                                        </tr>
                                    </table>
                                </div>  
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <br> 
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <a href="<?php echo base_url(); ?>sales/print_sales" class="btn btn-gradient-success btn-md btn-block">Save and Print</a>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
        




