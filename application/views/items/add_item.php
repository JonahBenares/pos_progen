<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Item List
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>items/item_list">Item list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Item</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class=" m-0">Add New Item</h4>
                        <p class=" m-0"> Fill in the following fields </p>
                    </div>
                    <div class="card-body">
                        
                        <form class="form-sample">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Sub Category</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" style="max-width: 12.5%">Item Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">PR Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Warehouse (Kg)</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" id="exampleFormControlSelect3">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Unit</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" id="exampleFormControlSelect3">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Location</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" id="exampleFormControlSelect3">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Group</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" id="exampleFormControlSelect3">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Bin</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Barcode</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Rack</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" id="exampleFormControlSelect3">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Weight</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" />
                                        </div>
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Current Price</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text bg-gradient-primary text-white">₱</span>
                                                </div>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">
                                                  <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <hr>
                            <h4 class="card-title">Add Image</h4>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text bg-gradient-primary text-white"><i class="mdi mdi-image"></i></span>
                                        </div>
                                        <input class="form-control" type="file" name="pic3" id="img3">
                                    </div>
                                    <div class="thumbnail">
                                        <img id="pic3" class="addImage" src="<?php echo base_url() ?>assets/images/default-img.jpg" alt="your image" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text bg-gradient-primary text-white"><i class="mdi mdi-image"></i></span>
                                        </div>
                                        <input class="form-control" type="file" name="pic3" id="img3">
                                    </div>
                                    <div class="thumbnail">
                                        <img id="pic3" class="addImage" src="<?php echo base_url() ?>assets/images/default-img.jpg" alt="your image" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text bg-gradient-primary text-white"><i class="mdi mdi-image"></i></span>
                                        </div>
                                        <input class="form-control" type="file" name="pic3" id="img3">
                                    </div>
                                    <div class="thumbnail">
                                        <img id="pic3" class="addImage" src="<?php echo base_url() ?>assets/images/default-img.jpg" alt="your image" />
                                    </div>
                                </div>
                            </div>
                            <hr> 
                            <div class="row">
                                <div class="col-lg-12">
                                    <center>
                                        <input style="width:100%" type="button" class="btn btn-gradient-primary pull right" value="Save Item">
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        




