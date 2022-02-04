<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-file-document"></i>
                </span> Billing
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>billing/billing_list">Billing List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Billing</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-info card-img-holder text-white">
                        <h4 class="m-0">Update Billing</h4>
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
                                    <input type="date" class="form-control" >
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
                                    <input type="date" class="form-control" >
                                </div>
                            </div>
                        </div> 
                        <hr> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div > <!-- style="width:100%;overflow-x: scroll;" -->
                                    <div class="col-lg-12">
                                        <button class="btn btn-gradient-primary btn-xs pull-right " onclick="update_billing_items('<?php echo base_url(); ?>')" name="">
                                            <span class="mdi mdi-plus"></span> Add Item
                                        </button>  
                                    </div>      
                                    <br>
                                    <br>                        
                                    <table id="table-alt" class="table-bordered" width="100%">
                                        <tr>
                                            <td class="td-head" width="6%">Qty</td>
                                            <td class="td-head" width="8%">UOM</td>
                                            <td class="td-head" width="15%">Item Code</td>
                                            <td class="td-head" width="">Item Description</td>
                                            <td class="td-head" width="10%">Price per Unit</td>
                                            <td class="td-head" width="10%">Total Amount</td>
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
                                            <td>sample</td>
                                            <td><a href="" class="btn btn-danger btn-xs btn-rounded"><span class="mdi mdi-window-close"></span></a></td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>sample</td>
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
                <a href="<?php echo base_url(); ?>billing/print_billing" class="btn btn-gradient-success btn-md btn-block">Save and Print</a>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
        




