<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sales.js"></script> 
<script type="text/javascript">
   
function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
$(document).bind("keydown", disableF5);
$(document).on("keydown", disableF5);

$(document).ready(function() {
    window.history.pushState(null, "", window.location.href);        
    window.onpopstate = function() {
    window.history.pushState(null, "", window.location.href);

  };


</script>
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
                            <?php foreach($head AS $h){ ?>   
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Client</label>
                                        <!-- <input type="text" class="form-control" id="client" name = "client" placeholder="Client Name"> -->
                                        <select class="form-control" id="client" name = "client" onclick="client_append();" disabled>
                                            <option value="">--Select Client--</option>
                                            <?php foreach($buyer AS $b){ ?>
                                                <option value="<?php echo $b->client_id; ?>" <?php echo ($b->client_id==$h['client_id']) ? 'selected' : ''; ?>><?php echo $b->buyer_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control" id="sales_date" name = "sales_date" placeholder="Date" value="<?php echo date("Y-m-d",strtotime($h['sales_date'])); ?>" readonly>
                                    </div>
                                </div>                                    
                            </div>                  
                            <div class="row">
                                <div class="col-lg-6"> 
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" id="address" placeholder="Address" value="<?php echo $h['address'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>TIN</label>
                                                <input type="text" class="form-control"  id="tin" placeholder="TIN" value="<?php echo $h['tin'];?>" readonly>
                                            </div>
                                        </div>
                                    </div>                               
                                    
                                    
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="text" class="form-control"  id="contact_person" placeholder="Contact Person" value="<?php echo $h['contact_person'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control"  id="contact_no" placeholder="Contact Number" value="<?php echo $h['contact_no'];?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="remarks" id="remarks" rows="1" readonly><?php echo $h['remarks'];?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">                                    
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PGC <b>PR </b>No.</label>
                                                <input type="text" class="form-control" name="pr_no" id="pr_no" placeholder="PGC PR No." value="<?php echo $h['pr_no'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PGC <b>PO </b>No.</label>
                                                <input type="text" class="form-control" name="po_no" id="po_no" placeholder="PGC PO No." value="<?php echo $h['po_no'];?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PR Date</label>
                                                <input type="date" class="form-control" name="pr_date" id="pr_date" placeholder="PR Date" value="<?php echo $h['pr_date'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>PO Date</label>
                                                <input type="date" class="form-control" name="po_date" id="po_date" placeholder="PO Date" value="<?php echo $h['po_date'];?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>DR No.</label>
                                                <input type="text" class="form-control" name = "dr_no" placeholder="DR No" value="<?php echo $h['dr_no'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>VAT</label>
                                                <select class="form-control" id="vat" name = "vat" disabled>
                                                    <option value="1" <?php echo ($h['vat']==1) ? 'selected' : ''; ?>>Vatable</option>
                                                    <option value="2" <?php echo ($h['vat']==2) ? 'selected' : ''; ?>>Non-Vatable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label><br></label>
                                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                                <input type="hidden" name="sales_good_head_id" id="sales_good_head_id" form="salesHead" value="<?php echo $sales_good_head_id; ?>">
                                                <?php if(!isset($sales_good_head_id)){ ?>
                                                <input type='button' class="btn btn-gradient-primary btn-sm btn-block btn-rounded" id="proc" onclick="proceed_sales()" value="Proceed">
                                                <?php } ?>

                                                <?php if(!isset($sales_good_head_id)){ ?>
                                                    <input type='button' class="btn btn-gradient-primary btn-sm btn-block btn-rounded" id="open" onclick="open_fields()" value="Update Transaction" style='display: none;font-size: 10px;'>
                                                    <input type='button' class="btn btn-gradient-primary btn-sm btn-block btn-rounded" id="save" onclick="update_sales()" value="Save" style='display: none;font-size: 10px;'>
                                                    <input type='button' class="btn btn-gradient-danger btn-sm btn-block btn-rounded" id="cancel" onclick="cancel_sale()" value="Cancel Transaction" style='display: none;font-size: 10px;'>
                                                <?php } else{ ?>
                                                    <input type='button' class="btn btn-gradient-primary btn-sm btn-block btn-rounded" id="open" onclick="open_fields()" value="Update Transaction" style='font-size: 10px;'>
                                                    <input type='button' class="btn btn-gradient-primary btn-sm btn-block btn-rounded" id="save" onclick="update_sales()" value="Save" style='display: none;font-size: 10px;'>
                                                    <input type='hidden' class="btn btn-gradient-danger btn-sm btn-block btn-rounded" id="cancel" onclick="cancel_sale()" value="Cancel Transaction" style='font-size: 10px;'>
                                                <?php } ?>
                                                <input type="hidden" name="sales_good_head_id" id="sales_good_head_id" form="saveAll" value="<?php echo $sales_good_head_id; ?>">
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div> 
                            <?php } ?>
                        
                        <hr> 
                        <div class="row" id='myDIV'>
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
                                    <table id="table-alt" class="table-bordered table-alt" width="100%">
                                        <tr>
                                            <td class="td-head" width="1%" hidden></td>
                                            <td class="td-head" width="1%">#</td>
                                            <td class="td-head" width="">Part No.</td>
                                            <td class="td-head" width="">Item Description</td>
                                            <td class="td-head" width="">Serial No.</td>
                                            <td class="td-head" width="5%">Qty</td>
                                            <td class="td-head" width="5%">Expected Qty</td>
                                            <td class="td-head" width="3%">UOM</td>
                                            <td class="td-head" width="8%">Selling Price</td>
                                            <td class="td-head" width="8%">Discount</td>
                                            <td class="td-head" width="8%">Total Cost</td>
                                        </tr>
                                        <tbody id="append_data">
                                            <?php 
                                                if(!empty($sales_det)){ 
                                                    $x=1; 
                                                    foreach($sales_det AS $sd){ 
                                            ?>
                                            <tr id="load_data<?php echo $x; ?>">
                                                <td hidden>
                                                    <input type="text" name="quantity[]" value="<?php echo $sd['qty']; ?>"><input type="text" name="sales_good_det_id[]" id="sales_good_det_id" value='<?php echo $sd['sales_good_det_id'];?>'>
                                                </td>
                                                <td><?php echo $x++;?></td>
                                                <td><?php echo $sd['original_pn'];?></td>
                                                <td><?php echo $sd['item_name'];?></td>
                                                <td><?php echo $sd['serial_no'];?></td>
                                                <td><?php echo $sd['qty'];?></td>
                                                <td><?php echo $sd['expected_qty'];?></td>
                                                <td><?php echo $sd['unit'];?></td>
                                                <td><input type="text" onkeypress="return isNumberKey(this, event)" name="selling_price[]" class="update_selling" style="width:100%" value='<?php echo $sd['selling_price'];?>'></td>
                                                <td><input type="text" onkeypress="return isNumberKey(this, event)" name="discount[]" class="update_discount" style="width:100%" value='<?php echo $sd['discount'];?>'></td>  
                                                <td><?php echo number_format($sd['total'],2);?></td>           
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>  
                            </div>     
                        </div>
                    </form>
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
                <input type="button" id="submitdata" style="display:none;" class="btn btn-gradient-success btn-md btn-block" onclick="saveAll();" value="Save and Print">
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
        




