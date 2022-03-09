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
                        <form id="salesHead" >       
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Client</label>
                                        <!-- <input type="text" class="form-control" id="client" name = "client" placeholder="Client Name"> -->
                                        <select class="form-control" id="client" name = "client" onclick="client_append();">
                                            <option value="">--Select Client--</option>
                                            <?php foreach($buyer AS $b){ ?>
                                                <option value="<?php echo $b->client_id; ?>"><?php echo $b->buyer_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control" name = "sales_date" placeholder="Date">
                                    </div>
                                </div>                                    
                            </div>                  
                            <div class="row">
                                <div class="col-lg-6"> 
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" id="address" placeholder="Address" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>TIN</label>
                                                <input type="text" class="form-control"  id="tin" placeholder="TIN" readonly>
                                            </div>
                                        </div>
                                    </div>                               
                                    
                                    
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="text" class="form-control"  id="contact_person" placeholder="Contact Person" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control"  id="contact_no" placeholder="Contact Number" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="remarks" rows="1"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">                                    
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PGC <b>PR </b>No.</label>
                                                <input type="text" class="form-control" name="pr_no" placeholder="PGC PR No.">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PGC <b>PO </b>No.</label>
                                                <input type="text" class="form-control" name="po_no" placeholder="PGC PO No.">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PR Date</label>
                                                <input type="date" class="form-control" name="pr_date" placeholder="PR Date">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PO Date</label>
                                                <input type="date" class="form-control" name="po_date" placeholder="PO Date">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>DR No.</label>
                                                <input type="text" class="form-control" name = "dr_no" placeholder="DR No">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>VAT</label>
                                                <select class="form-control" name = "vat">
                                                    <option value="1">Vatable</option>
                                                    <option value="2">Non-Vatable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label><br></label>
                                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                                <input type='button' class="btn btn-gradient-primary btn-sm btn-block btn-rounded" id="proc" onclick="proceed_sales()" value="Proceed">
                                                <input type='button' class="btn btn-gradient-danger btn-sm btn-block btn-rounded" id="cancel" onclick="cancel_sale()" value="Cancel Transaction" style='display: none;font-size: 10px;'>
                                                <input type="hidden" name="sales_good_head_id" id="sales_good_head_id" form="saveAll">
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div> 
                        </form>
                        <hr> 
                        <div class="row" id='myDIV' style='display: none;'>
                            <div class="col-lg-12">
                                <div > <!-- style="width:100%;overflow-x: scroll;" -->
                                    <div class="col-lg-12">
                                        <!-- <button class="btn btn-gradient-primary btn-xs pull-right " onclick="goods_add_sales_items('<?php echo base_url(); ?>')" name="">
                                            <span class="mdi mdi-plus"></span> Add Item
                                        </button>   -->
                                        <div id ="myButton"></div>
                                    </div>      
                                    <br>
                                    <br>                        
                                    <table id="table-alt" class="table-bordered" width="100%">
                                        <tr>
                                            <td class="td-head" width="1%">#</td>
                                            <td class="td-head" width="">Part No.</td>
                                            <td class="td-head" width="">Item Description</td>
                                            <td class="td-head" width="">Serial No.</td>
                                            <td class="td-head" width="5%">Qty</td>
                                            <td class="td-head" width="3%">UOM</td>
                                            <td class="td-head" width="8%">Selling Price</td>
                                            <td class="td-head" width="8%">Discount</td>
                                            <td class="td-head" width="8%">Total Cost</td>
                                            <td class="td-head" width="2%">
                                                <span class="mdi mdi-menu"></span>
                                            </td>
                                        </tr>
                                        <tbody id="append_data">
                                           <!--  <?php if(!empty($sales_det)){ $x=1; foreach($sales_det AS $sd){ ?>
                                            <tr>
                                                <td><?php echo $x++;?></td>
                                                <td><?php echo $sd[''];?></td>
                                                <td><?php echo $sd[''];?></td>
                                                <td><?php echo $sd[''];?></td>
                                                <td><?php echo $sd[''];?></td>
                                                <td><?php echo $sd[''];?></td>
                                                <td><?php echo $sd[''];?></td>
                                                <td><?php echo $sd[''];?></td>
                                                <td><?php echo $sd[''];?></td>  
                                                <td><a href="" class="btn btn-danger btn-xs btn-rounded"><span class="mdi mdi-window-close"></span></a></td>           
                                            </tr>
                                            <?php } } ?> -->
                                        </tbody>
                                    </table>
                                </div>  
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="saveAll"></form>
        <br> 
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <!-- <a href="<?php echo base_url(); ?>sales/goods_print_sales" class="btn btn-gradient-success btn-md btn-block">Save and Print</a> -->
                <div id='alt' style="font-weight:bold"></div>
                <input type="button" id="submitdata" class="btn btn-gradient-success btn-md btn-block" onclick="saveAll();" value="Save and Print">
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
        




