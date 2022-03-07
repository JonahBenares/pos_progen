<script src="<?php echo base_url(); ?>assets/js/items.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-file-document-box"></i>
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
                                           <select class="form-control select2" name="subcat" id='subcat' onChange="chooseSubcat();">
                                                <option value='' selected>-Choose Sub Category-</option>
                                                <?php foreach($subcat as $sub) { ?>
                                                <option value='<?php echo $sub->subcat_id; ?>'><?php echo $sub->subcat_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="subcat_msg" class='img-check'></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <p class="pname pborder"  name="category" id="category"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" style="max-width: 12.5%">Item Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" name="item_name" id="item_name" autocomplete="off">
                                             <span id="item-check"></span>
                                             <span id="item_msg" class='img-check'></span>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">PN No</label>
                                        <div class="col-sm-9">
                                            <input class="form-control"  type="text" name="pn" id="pn">
                                            <span id="pn_msg" class='img-check'></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Warehouse</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2"  name="warehouse" id="warehouse">
                                                <option value='' selected>-Choose Warehouse-</option>
                                                <?php foreach($warehouse as $wh) { ?>
                                                <option value='<?php echo $wh->warehouse_id; ?>'><?php echo $wh->warehouse_name; ?></option>
                                                <?php } ?>
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
                                           <select class="form-control select2" name="unit" id="unit">
                                                <option value='' selected>-Choose Unit-</option>
                                                <?php foreach($unit AS $uom) { ?>
                                                <option value='<?php echo $uom->unit_id; ?>'><?php echo $uom->unit_name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Location</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2"  name="location" id="location">
                                                <option value='' selected>-Choose Location-</option>
                                                <?php foreach($location as $lc) { ?>
                                                <option value='<?php echo $lc->location_id; ?>'><?php echo $lc->location_name; ?></option>
                                                <?php } ?>
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
                                            <select class="form-control select2" name="group" id="group">
                                                <option value='' selected>-Choose Group-</option>
                                                <?php foreach($group as $gr) { ?>
                                                <option value='<?php echo $gr->group_id; ?>'><?php echo $gr->group_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="bin">Bin</label>
                                        <div class="col-sm-9">
                                        <select class="form-control select2" name="bin" id="bin">
                                                <option value='' selected>-Choose Bin-</option>
                                                <?php foreach($bin as $b) { ?>
                                                <option value='<?php echo $b->bin_id; ?>'><?php echo $b->bin_name; ?></option>
                                                <?php } ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Barcode</label>
                                        <div class="col-sm-9">
                                           <input class="form-control"  type="text" name="barcode" id="barcode">
                                        </div>
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Rack</label>
                                        <div class="col-sm-9">
                                           <select class="form-control select2" name="rack" id="rack">
                                                <option value='' selected>-Choose Rack-</option>
                                                <?php foreach($rack as $rack) { ?>
                                                <option value='<?php echo $rack->rack_id; ?>'><?php echo $rack->rack_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">NKK Number</label>
                                        <div class="col-sm-9">
                                            <input class="form-control"  type="text" name="nkk_no" id="nkk_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SEMT Number</label>
                                        <div class="col-sm-9">
                                            <input class="form-control"  type="text" name="semt_no" id="semt_no">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Weight</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="weight" id="weight" class="form-control">
                                        </div>
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Highest Cost</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text bg-gradient-primary text-white">₱</span>
                                                </div>
                                                <input type="text" name="selling_price" id="selling_price" class="form-control">
                                                <div class="input-group-append">
                                                  <!-- <span class="input-group-text">.00</span> -->
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
                                        <input class="form-control" type="file" name="pic1" id="img1" onchange="readPic1(this);">
                                    </div>
                                    <div class="thumbnail">
                                        <img id="pic1" class="addImage" src="<?php echo base_url() ?>assets/images/default-img.jpg" alt="your image" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text bg-gradient-primary text-white"><i class="mdi mdi-image"></i></span>
                                        </div>
                                        <input class="form-control" type="file" name="pic2" id="img2" onchange="readPic2(this);">
                                    </div>
                                    <div class="thumbnail">
                                        <img id="pic2" class="addImage" src="<?php echo base_url() ?>assets/images/default-img.jpg" alt="your image" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text bg-gradient-primary text-white"><i class="mdi mdi-image"></i></span>
                                        </div>
                                        <input class="form-control" type="file" name="pic3" id="img3" onchange="readPic3(this);">
                                    </div>
                                    <div class="thumbnail">
                                        <img id="pic3" class="addImage" src="<?php echo base_url() ?>assets/images/default-img.jpg" alt="your image" />
                                    </div>
                                </div>
                            </div>
                            <hr> 
                            <div class="row">
                                <div class="col-lg-12" id='alt'>
                                    <center>
                                        <input style="width:100%" type="button" class="btn btn-gradient-primary pull right" onclick='saveItem()' value="Save Item" id="next" name='nextitem'>
                                    </center>
                                </div>
                            </div>
                                    <input type="hidden" name="category_id" id="category_id">
                                    <input type="hidden" name="binid" id="binid">
                                    <input type="hidden" name="pn_format" id="pn_format">
                                    <!-- <input type="hidden" name="brandid" id="brandid"> -->
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        




