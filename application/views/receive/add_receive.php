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
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Date</label>
                                    <input type="date" class="form-control" placeholder="Date">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">PO No.</label>
                                    <input type="text" class="form-control" placeholder="PO No">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">DR No.</label>
                                    <input type="text" class="form-control" placeholder="DR No">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">SI/OR</label>
                                    <input type="text" class="form-control" placeholder="SI/OR">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Overall Remarks</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="2" placeholder="Overall Remarks"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-check mx-sm-2">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" checked> PCF
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- <label for="exampleTextarea1"></label>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-gradient-primary btn-fw pull-right" name="">
                                        </div> -->
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1">
                                <h3 class="page-title">
                                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                        <span ><b><h4 class="m-0" style="padding-top:6px">01</h4></b></span>
                                    </span>
                                </h3>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputName1">PR/JO No.</label>
                                    <select class="form-control">
                                        <option>-Select PR/JO No-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Department</label>
                                    <select class="form-control">
                                        <option>-Select Department-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Inspected by</label>
                                    <select class="form-control">
                                        <option>-Select Inspected by-</option>
                                    </select>
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Enduse</label>
                                    <select class="form-control">
                                        <option>-Select Enduse-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Purpose</label>
                                    <select class="form-control">
                                        <option>-Select Purpose-</option>
                                    </select>
                                </div>
                            </div>                                
                        </div>
                        <div class="row">                                
                            <div class="col-lg-11">
                                <div style="width:100%;overflow-x: scroll;">
                                    <table class="table table-bordered" style="width: 300%;">
                                        <tr>
                                            <td width="15%">Item Description</td>
                                            <td width="15%">Supplier</td>
                                            <td width="15%">Brand</td>
                                            <td width="15%">Serial No.</td>
                                            <td width="15%">Net Cost</td>
                                            <td width="15%">Catalog No</td>
                                            <td width="15%">SEMT No</td>
                                            <td width="15%">NKK No</td>
                                            <td width="15%">Expected Qty</td>
                                            <td width="15%">Delivered/Received</td>
                                            <td width="15%">Shipping/U & other related cost</td>
                                            <td width="15%">Currency</td>
                                            <td width="15%">Local/Manila</td>
                                        </tr>
                                        <tr>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><select class="form-control"></select></td>             
                                        </tr>
                                        <tr>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><input class="form-control" type="" name=""></td>
                                            <td class="p-0"><select class="form-control"></select></td>             
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-gradient-primary btn-sm " name="">
                                    <span class="mdi mdi-plus"></span> Item
                                </button>  
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <br> 
        <div class="row">
            <div class="col-lg-6">
                <br>
                <a href="<?php echo base_url(); ?>receive/add_receive" class="btn btn-gradient-warning btn-sm">Receive New</a>
            </div>
                <div class="col-lg-6">
                    <div class="pull-right">
                    <button class="btn btn-gradient-primary btn-md">Add PR</button>
                    <button class="btn btn-gradient-success btn-md">Save All</button>
                </div>
            </div>
        </div>
    </div>
</div>
        




