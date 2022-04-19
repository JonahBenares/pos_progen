<script src="<?php echo base_url(); ?>assets/js/sales.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class="m-0">Add Manpower</h4>
                    </div>
                    <div class="card-body">   
                        <form id="service_manpower">                        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label >Employee</label>
                                        <select class="form-control" name="manpower" id="manpower" onchange="manpower_append();">
                                            <option value="">-Select Employee-</option>
                                            <?php foreach($manpower AS $m){ ?>
                                                <option value="<?php echo $m->manpower_id; ?>"><?php echo $m->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label >Days</label>
                                                <input type="number" class="form-control " name="days" id="days" placeholder="00" onkeypress="return isNumberKey(this, event)" onkeyup='manpower_total();'>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Rate</label>
                                                <input type="text" class="form-control amount-txt" name="rate" id="rate" placeholder="00" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>                             
                            </div>  
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label >Overtime</label>
                                        <input type="text" class="form-control" name="overtime" id="overtime" placeholder="Overtime" onkeypress="return isNumberKey(this, event)" onkeyup='manpower_total();'>
                                    </div>                               
                                </div>
                                <div class="col-md-6 col-sm-6">   
                                    <div class="form-group">
                                        <label >Total</label>
                                        <input type="text" class="form-control amount-txt" name="total_cost" id="grandtotal" placeholder="00.00" readonly="">
                                    </div>
                                </div>                            
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pull-right">
                                        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                        <input type="hidden" name="sales_serv_head_id" value="<?php echo $sales_serv_head_id; ?>">
                                        <input type="button" class="btn btn-gradient-primary btn-md" value="Add Manpower" id='saveitem' onclick="save_service_manpower();">
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
        
                        




