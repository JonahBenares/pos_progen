<div class="main-panel">
    <div class="content-wrapper">    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class="m-0">Add Rental Cost</h4>
                    </div>
                    <div class="card-body">   
                        <form id="service_equipment">                        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label >Equipment</label>
                                                <select class="form-control" name="equipment" id="equipment" onchange="equipment_append();">
                                                    <option value="">-Select Equipment-</option>
                                                    <?php foreach($equipment AS $e){ ?>
                                                        <option value="<?php echo $e->equipment_id; ?>"><?php echo $e->equipment_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                            <label >Quantity</label>
                                            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity"  onkeypress="return isNumberKey(this, event)" onkeyup="rental_rate_total();">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label >Rate</label>
                                                <input type="text" class="form-control amount-txt" name="rate" id="rate" placeholder="Rate" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <input type="text" class="form-control " name="uom" id="uom" placeholder="Unit">
                                            </div>
                                        </div>
                                    </div>
                                </div>                             
                            </div>  
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label >Days</label>
                                        <input type="text" class="form-control" name="days" id="days" placeholder="Days"  onkeypress="return isNumberKey(this, event)" onkeyup="equipment_total();">
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
                                <div class="col-lg-12">
                                    <div class="pull-right">
                                        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                        <input type="hidden" name="sales_serv_head_id" value="<?php echo $sales_serv_head_id; ?>">
                                        <input type="hidden" name="rate_solve" id="rate_solve">
                                        <input type="button" class="btn btn-gradient-primary btn-md" value="Add Rental" id='saveitem' onclick="save_service_equipment();">
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
        
                        




