<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> -->
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                       <!--  <h4 class="m-0">Add Item</h4> -->
                    </div>
                    <div class="card-body"> 
                        <form id='bs_table'>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label >Billing Statement No:</label>
                                    <input type="text" class="form-control" name="bs_no" id="bs_no" readonly value="<?php echo $bs_no; ?>">
                                </div>
                                 <div class="form-group">
                                    <label >Client:</label>
                                    <input type="text" class="form-control" name="client" id="client" readonly value="<?php echo $client; ?>">
                                </div>
                                <div class="form-group">
                                    <label >Date</label>
                                    <input type="date" class="form-control" name="bs_date" id="bs_date">
                                </div>                                                               
                            </div>                          
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pull-right">
                                    <input type='hidden' name='sales_id' id='sales_id' value='<?php echo $ids; ?>'>
                                    <input type='hidden' name='client_id' id='client_id' value='<?php echo $client_id; ?>'>
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                     <input type="hidden" name="salestype" id="salestype" value="<?php echo $type; ?>">
                                   <!--  <input onclick="parent.window.opener.location='<?php echo base_url(); ?>/reports/print_billing'; window.close();" type="submit" class="btn btn-gradient-primary btn-md" value="Proceed"> -->
                                    <input onclick="save_billing()" type="button" class="btn btn-gradient-primary btn-md" value="Proceed">
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
        
                        




