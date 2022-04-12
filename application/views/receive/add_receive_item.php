<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/receive.js"></script> 
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> -->

<div class="main-panel">
    <div class="content-wrapper">    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class="m-0">Add Item</h4>
                    </div>
                    <div class="card-body">    
                     <form id='receive_item'>                    
                        <div class="row">
                           
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label >Item Description</label>
                                    <select class="form-control" name="item" id="item">
                                        <option value="">-Select Item-</option>
                                        <?php foreach($item AS $i){ ?>
                                                <option value="<?php echo $i->item_id; ?>"><?php echo $i->original_pn." - ".$i->item_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Supplier</label>
                                    <select class="form-control" name="supplier" id="supplier">
                                        <option value="">-Select Supplier-</option>
                                        <?php foreach($supplier AS $s){ ?>
                                                <option value="<?php echo $s->supplier_id; ?>"><?php echo $s->supplier_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Brand</label>
                                    <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand">
                                </div>
                            </div>                             
                        </div>  
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label >Serial No.</label>
                                    <input type="text" class="form-control" name="serial_no" placeholder="Serial No.">
                                </div>
                                <div class="form-group">
                                    <label >Net Cost</label>
                                    <input type="number" class="form-control" name="net_cost" id="net_cost">
                                </div>
                                <div class="form-group">
                                    <label >Delivered/ Received Qty</label>
                                    <input type="number" class="form-control" name="received_qty" id="received_qty" placeholder="Delivered/Received Qty">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label >Catalog No.</label>
                                    <input type="text" class="form-control" name="catalog_no" id="catalog_no" placeholder="Catalog No.">
                                </div>                                
                                <div class="form-group">
                                    <label >Shipping/U & other related cost</label>
                                    <input type="number" class="form-control" name="shipping" id="shipping" placeholder="Shipping/U & other related cost">
                                </div>
                                <div class="form-group">
                                    <label >Expected Qty</label>
                                    <input type="number" class="form-control" name="expected_qty" id="expected_qty" placeholder="Expected Qty">
                                </div>                                
                            </div>                            
                        </div>
                        <div class="row">                                 
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="local" value="1" checked=""> Local <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="local"  value="2" > Manila <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label >Expiry Date</label>
                                    <input type="date" class="form-control" name="expiry" id="expiry" placeholder="Expiry Date">
                                </div>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pull-right">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <input type='hidden' name='receive_id' id='receive_id' value="<?php echo $receive_id; ?>">
                                     <input type='hidden' name='counter' id='counter' value="<?php echo $counter; ?>">
                                    <input type='hidden' name='rd_id' id='rd_id' value="<?php echo $rd_id; ?>">
                                    <input type="button" class="btn btn-gradient-primary btn-md" value="Add Item" onclick="save_item_receive();">
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
        
                        




