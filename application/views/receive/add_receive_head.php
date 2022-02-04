<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-import"></i>
                </span> Receive
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>receive/receive_list">Receive List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Receive</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class="m-0">Add New Receive</h4>
                    </div>
                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Date</label>
                                            <input type="date" class="form-control" placeholder="Date">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">PO No.</label>
                                            <input type="text" class="form-control" placeholder="PO No">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">DR No.</label>
                                            <input type="text" class="form-control" placeholder="DR No">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">SI/OR</label>
                                            <input type="text" class="form-control" placeholder="SI/OR">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Overall Remarks</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="2" placeholder="Overall Remarks"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-check mx-sm-2">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" checked> PCF
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="exampleTextarea1"><br></label>
                                        <div class="form-group">
                                            <a  href="<?php echo base_url(); ?>receive/add_receive_pr"  class="btn btn-gradient-primary btn-sm btn-block btn-rounded">Proceed</a>
                                            <!-- <input type="submit" class="btn btn-gradient-primary btn-fw pull-right" value="Add PR" name=""> -->
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>        
        <div class="row">
            <div class="col-lg-5"><br><hr></div>
            <div class="col-lg-2"><center><br><span style="color:#aeaeae;font-size: 13px;">PURCHASE REQUESTS</span></center></div>
            <div class="col-lg-5"><br><hr></div>
        </div>
    </div>
</div>
        




