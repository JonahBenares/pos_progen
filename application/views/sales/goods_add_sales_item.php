<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sales.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class="m-0">Add Item</h4>
                    </div>
                    <div class="card-body">  
                        <form id="sales_item">                      
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label >Item Description</label>
                                        <select class="form-control" name="item" id="item" onchange="item_append();">
                                            <option value="">-Select Item-</option>
                                            <?php foreach($fifo_in AS $fi){ ?>
                                                <option value="<?php echo $fi['in_id']; ?>" myTag='<?php echo $fi['item_id']; ?>'><?php echo $fi['item_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label >Qty</label>
                                                <input type="text" class="form-control amount-txt" onblur='qty_append();' name="quantity" id="quantity" placeholder="00">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Unit Cost</label>
                                                <input type="text" class="form-control" name="unit_cost" id="unit_cost" placeholder="Unit Cost" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>                             
                            </div>  
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label >Serial No.</label>
                                        <input type="text" class="form-control" name="serial_no" id="serial_no" placeholder="Serial No.">
                                    </div>
                                    <div class="form-group">
                                        <label >UOM</label>
                                        <input type="text" class="form-control" name="uom" id="uom" placeholder="Unit of Measurement">
                                    </div>                                
                                </div>
                                <div class="col-md-6 col-sm-6">                                
                                    <div class="form-group">
                                        <label >Selling Price</label>
                                        <input type="text" class="form-control amount-txt" name="selling_price" id="selling_price" placeholder="00.00" onkeypress="return isNumberKey(this, event)" onkeyup='changePrice()'>
                                    </div>
                                    <div class="form-group">
                                        <label >Discount Percentage</label>
                                        <input type="text" class="form-control amount-txt" name="discount" id="discount" placeholder="0%" onkeypress="return isNumberKey(this, event)" onkeyup='changePrice()'>
                                    </div>
                                    <div class="form-group">
                                        <label >Total Cost</label>
                                        <input type="text" class="form-control amount-txt total_cost" name="total_cost" id="grandtotal" placeholder="00.00" readonly="">
                                    </div>
                                </div>                            
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-lg-6"></div>
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <div class="pull-risght">
                                        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                        <input type="hidden" name="group_id" id="group_id">
                                        <input type="hidden" name="item_id" id="item_id">
                                        <input type="hidden" name="discount_amount" id="discount_amount">
                                        <input type="hidden" name="sales_good_head_id" value="<?php echo $sales_good_head_id; ?>">
                                        <input type="button" class="btn btn-gradient-primary btn-md btn-block" value="Add Item"  id='saveitem' onclick="save_item();">
                                        <!-- <button class="btn btn-gradient-primary btn-md" id="save_sales" onclick="save_item();">Add Item</button> -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
        
                     




