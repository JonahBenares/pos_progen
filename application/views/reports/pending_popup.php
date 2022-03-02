<div class="main-panel">
    <div class="content-wrapper">    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                       <!--  <h4 class="m-0">Add Item</h4> -->
                    </div>
                    <div class="card-body"> 
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label >Client</label>
                                    <select class="form-control">
                                        <option>-- SELECT CLIENT --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Date</label>
                                    <input type="date" class="form-control" name="">
                                </div>                                                               
                            </div>                          
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pull-right">
                                    <input onclick="parent.window.opener.location='<?php echo base_url(); ?>/reports/print_billing'; window.close();" type="submit" class="btn btn-gradient-primary btn-md" value="Proceed">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
        
                        




