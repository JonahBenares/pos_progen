<script src="<?php echo base_url(); ?>assets/js/sales.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class="m-0">Add Consumables and Other Materials</h4>
                    </div>
                    <div class="card-body">   
                        <form id="service_materials">                        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label >Item Description</label>
                                        <input type="text" class="form-control" name="item" id="item">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label >Qty</label>
                                                <input type="text" class="form-control amount-txt" name="quantity" id="quantity" placeholder="00" onkeypress="return isNumberKey(this, event)" onkeyup='materials_price()'>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>UOM</label>
                                                <input type="text" class="form-control" name="uom" id="uom" placeholder="UOM" >
                                            </div>
                                        </div>
                                    </div>
                                </div>                             
                            </div>  
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label >Unit Cost</label>
                                        <input type="text" class="form-control" name="unit_cost" id="unit_cost" placeholder="Unit Cost" onkeypress="return isNumberKey(this, event)" onkeyup='materials_price()'>
                                    </div>                               
                                </div>
                                <div class="col-md-6 col-sm-6">   
                                    <div class="form-group">
                                        <label >Total Cost</label>
                                        <input type="text" class="form-control amount-txt" name="total_cost" id="grandtotal" placeholder="00.00" readonly="">
                                    </div>
                                </div>                            
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="form-group">
                                        <label >Remarks</label>
                                        <textarea class="form-control" name="remarks" id="remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pull-right">
                                        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                        <input type="hidden" name="sales_serv_head_id" value="<?php echo $sales_serv_head_id; ?>">
                                        <input type="button" class="btn btn-gradient-primary btn-md" value="Add Consumable" id='saveitem' onclick="save_service_materials();">
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
        
                        




