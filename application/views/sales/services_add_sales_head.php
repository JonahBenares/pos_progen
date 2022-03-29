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
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>sales/services_sales_list">Sales List (Services)</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Sales</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class="m-0">Add New Sales (<b>Services</b>)</h4>
                    </div>
                    <div class="card-body">   
                        <form id="salesService">    
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Client</label>
                                        <select class="form-control" id="client" name = "client" onclick="client_append();">
                                            <option value="">--Select Client--</option>
                                            <?php foreach($buyer AS $b){ ?>
                                                <option value="<?php echo $b->client_id; ?>"><?php echo $b->buyer_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>DR No.</label>
                                        <input type="text" class="form-control" placeholder="DR No" name="dr_no" id="dr_no" value="<?php echo $dr_no; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control" placeholder="Date" name="sales_date" id="sales_date">
                                    </div>
                                </div>                                    
                            </div>                  
                            <div class="row">
                                <div class="col-lg-6">                                
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" placeholder="Address" name="address" id="address" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>TIN</label>
                                                <input type="text" class="form-control" placeholder="TIN" name="tin" id="tin" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="text" class="form-control" placeholder="Contact Person" name="contact_person" id="contact_person" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Contact Number" name="contact_no" id="contact_no" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Labor</label>
                                        <input type="text" class="form-control" placeholder="Labor">
                                    </div> -->
                                    <div class="form-group">
                                        <label>Purpose</label>
                                        <textarea class="form-control" rows="1" placeholder="Purpose" name="purpose" id="purpose"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">                                    
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PGC <b>JOR</b> No.</label>
                                                <input type="text" class="form-control" placeholder="PGC JOR No." name="jor_no" id="jor_no">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PGC <b>JOI</b> No.</label>
                                                <input type="text" class="form-control" placeholder="PGC JOI No." name="joi_no" id="joi_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>JOR Date</label>
                                                <input type="date" class="form-control"name="jor_date" id="jor_date">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>JOI Date</label>
                                                <input type="date" class="form-control" name="joi_date" id="joi_date">
                                            </div>
                                        </div>
                                    </div>
                                   <!--  <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Date Started</label>
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Date Completed</label>
                                                <input type="date" class="form-control" >
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <textarea class="form-control" rows="1" name="remarks" id="remarks"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>VAT</label>
                                                <select class="form-control" name="vat" id="vat">
                                                    <option value="1">Vatable</option>
                                                    <option value="2">Non-Vatable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label><br></label>
                                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                                <input type='button' class="btn btn-gradient-primary btn-sm btn-block btn-rounded" id="proc_service" onclick="proceed_sales_service()" value="Proceed">
                                                <input type='button' class="btn btn-gradient-danger btn-sm btn-block btn-rounded" id="cancel_service" onclick="cancel_sales_service()" value="Cancel Transaction" style='display: none;font-size: 10px;'>
                                                <input type="hidden" name="sales_serv_head_id" id="sales_serv_head_id" form="saveAllservice">
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div>  
                        </form>
                        <hr> 
                        <div class="row" id='myDIV2' style='display: none;'>
                            <div class="col-lg-12">
                                <div > <!-- style="width:100%;overflow-x: scroll;" -->
                                    <div class="col-lg-12">
                                        <!-- <button class="btn btn-gradient-primary btn-xs pull-right " onclick="goods_add_sales_items('<?php echo base_url(); ?>')" name="">
                                            <span class="mdi mdi-plus"></span> Add Item
                                        </button>   -->
                                        <center>
                                            <div id ="myButton2"></div>
                                        </center>
                                    </div>      
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
                                        <tbody id="append_data2"></tbody>
                                        <tr id = "total_cost">
                                            <td class="td-head" colspan="3" align="center"><b>Sub-Total</b></td>
                                            <td class="td-head" colspan="4" align="center"><b>Engine Parts Cost Incurred</b></td>
                                            <td class="td-head" colspan="2" align="right"><b><div id="subtotal"></div></b></td>
                                            <td class="td-head" align="right"><b></b></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <table id="table-alt"  class="table-bordered" width="100%">
                                        <tr>
                                            <td class="td-head" colspan="7"><center><b>Consumables and Other Materials</b></center></td> 
                                        </tr>
                                        <tr>
                                            <td class="td-head" width="5%">No.</td>
                                            <td class="td-head" width="45%">Item Description</td>
                                            <td class="td-head" width="8%">Qty</td>
                                            <td class="td-head" width="8%">UOM</td>
                                            <td class="td-head" width="14%">Unit Cost</td>
                                            <td class="td-head" width="12%">Total Cost</td>
                                            <td class="td-head" width="2%">
                                                <span class="mdi mdi-menu"></span>
                                            </td>
                                        </tr>
                                        <tbody id = "append_data3"></tbody>
                                        <tr>
                                            <td class="td-head" colspan="2" align="center"><b>Sub-Total</b></td>
                                            <td class="td-head" colspan="3" align="center"><b>Material Cost Incurred</b></td>
                                            <td class="td-head" align="right"><b><div id="subtotal2"></div></b></td>
                                            <td class="td-head" align="right"><b></b></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <table id="table-alt"  class="table-bordered" width="100%">
                                        <tr >
                                            <td class="td-head" colspan="7"><center><b>Manpower</b></center></td>
                                        </tr>
                                        <tr>
                                            <td class="td-head" width="5%">No.</td>
                                            <td class="td-head" width="45%">Employee</td>
                                            <td class="td-head" width="8%">Days</td>
                                            <td class="td-head" width="8%">Rate</td>
                                            <td class="td-head" width="14%">Overtime</td>
                                            <td class="td-head" width="12%">Total</td>
                                            <td class="td-head" width="2%">
                                                <span class="mdi mdi-menu"></span>
                                            </td>
                                        </tr>
                                        <tbody id="append_data4"></tbody>
                                        <tr>
                                            <td class="td-head" colspan="2" align="center"><b>Sub-Total</b></td>
                                            <td class="td-head" colspan="3" align="center"><b>Labor Cost Incurred</b></td>
                                            <td class="td-head" align="right"><b><div id="subtotal3"></div></b></td>
                                            <td class="td-head" align="right"><b></b></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <table id="table-alt"  class="table-bordered" width="100%">
                                        <tr>
                                            <td class="td-head" colspan="7"><center><b>Actual Rental Cost</b></center></td>
                                        </tr>
                                        <tr>
                                            <td class="td-head" width="5%">No.</td>
                                            <td class="td-head" width="45%">Equipment</td>
                                            <td class="td-head" width="8%">Qty</td>
                                            <td class="td-head" width="8%">Rate</td>
                                            <td class="td-head" width="8%">Unit</td>
                                            <td class="td-head" width="14%">Days/Hours</td>
                                            <td class="td-head" width="12%">Total Cost</td>
                                            <td class="td-head" width="2%">
                                                <span class="mdi mdi-menu"></span>
                                            </td>
                                        </tr>
                                        <tbody id="append_data5"></tbody>
                                        <tr>
                                            <td class="td-head" colspan="2" align="center"><b>Sub-Total</b></td>
                                            <td class="td-head" colspan="4" align="center"><b>Rental Cost</b></td>
                                            <td class="td-head" align="right"><b><div id="subtotal4"></div></b></td>
                                            <td class="td-head" align="right"><b></b></td>
                                        </tr>
                                    </table>
                                </div>  
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <form id="saveAllservice"></form>
        <br> 
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <!-- <a href="<?php echo base_url(); ?>sales/goods_print_sales" class="btn btn-gradient-success btn-md btn-block">Save and Print</a> -->
                <div id='alert' style="font-weight:bold"></div>
                <input type="button" id="submit_services" class="btn btn-gradient-success btn-md btn-block" onclick="saveAllservice();" value="Save and Print">

            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
        




