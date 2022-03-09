<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/items.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-file-document-box"></i>
                </span> Item
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>items/item_list">Item list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Item</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-info card-img-holder text-white">
                        <h4 class=" m-0">Update Item</h4>
                        <p class=" m-0"> Update the following fields </p>
                    </div>
                    <div class="card-body">
                        <form class="form-sample">
                            <?php foreach($items AS $i) { ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Sub Category</label>
                                        <select class="form-control select2" name="subcat" id='subcat' onChange="chooseSubcat();">
                                                <option value='' selected>-Choose Sub Category-</option>
                                                <?php foreach($subcat as $sub) { ?>
                                                <option value='<?php echo $sub->subcat_id; ?>' <?php echo (($sub->subcat_id == $i->subcat_id) ? ' selected' : ''); ?>><?php echo $sub->subcat_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="subcat_msg" class='img-check'></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <p class="pname pborder"  name="category" id="category"><?php echo $cat_name; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" style="max-width: 12.5%">Item Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" name="item_name" id="item_name" autocomplete="off" value='<?php echo $i->item_name; ?>'>
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
                                            <input class="form-control"  type="text" name="pn" id="pn" value='<?php echo $i->original_pn; ?>'>
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
                                                <option value='<?php echo $wh->warehouse_id; ?>' <?php echo (($wh->warehouse_id == $i->warehouse_id) ? ' selected' : ''); ?>><?php echo $wh->warehouse_name; ?></option>
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
                                                <option value='<?php echo $uom->unit_id; ?>' <?php echo (($uom->unit_id == $i->unit_id) ? ' selected' : ''); ?>><?php echo $uom->unit_name; ?></option>
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
                                                <option value='<?php echo $lc->location_id; ?>' <?php echo (($lc->location_id == $i->location_id) ? ' selected' : ''); ?>><?php echo $lc->location_name; ?></option>
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
                                                <option value='<?php echo $gr->group_id; ?>' <?php echo (($gr->group_id == $i->group_id) ? ' selected' : ''); ?>><?php echo $gr->group_name; ?></option>
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
                                                <option value='<?php echo $b->bin_id; ?>' <?php echo (($b->bin_id == $i->bin_id) ? ' selected' : ''); ?>><?php echo $b->bin_name; ?></option>
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
                                            <input class="form-control"  type="text" name="barcode" id="barcode" value='<?php echo $i->barcode; ?>'>
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
                                                <option value='<?php echo $rack->rack_id;?>' <?php echo (($rack->rack_id == $i->rack_id) ? ' selected' : ''); ?>><?php echo $rack->rack_name; ?></option>
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
                                            <input class="form-control"  type="text" name="barcode" id="nkk_no" value='<?php echo $i->nkk_no; ?>'>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SEMT Number</label>
                                        <div class="col-sm-9">
                                            <input class="form-control"  type="text" name="barcode" id="semt_no" value='<?php echo $i->semt_no; ?>'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Weight</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="weight" id="weight" class="form-control" value='<?php echo $i->weight; ?>'> 
                                        </div>
                                    </div>
                                </div>                            
                                <!-- <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Highest Cost</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text bg-gradient-info text-white">₱</span>
                                                </div>
                                                <input type="text" name="selling_price" id="selling_price" class="form-control" value='<?php echo $i->selling_price; ?>'>
                                                <div class="input-group-append">
                                                  <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>  
                            <hr>
                            <h4 class="card-title">Add Image</h4>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-gradient-info text-white"><i class="mdi mdi-image"></i></span>
                                        </div>
                                        <input class="form-control" type="file" name="pic1" id="img1" onchange="readPic1(this);">
                                    </div>
                                    <div class="thumbnail">
                                        <?php if(!empty($i->picture1)) { ?>
                                            <button type='button' class="btn btn-secondary btn-rounded btn-xs delete_but" onclick="deleteImage('<?php echo $id; ?>','picture1','<?php echo base_url(); ?>')" > <span class="mdi mdi-close"></span> </button>
                                        <?php } ?>
                                        <img id="pic1" class="pictures" src="<?php echo (empty($i->picture1) ? base_url().'assets/default/default-img.jpg' : base_url().'uploads/'.$i->picture1); ?>" alt="your image" />
                                    </div>
                                    <span id="img1-check" class='img-check'></span>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text bg-gradient-info text-white"><i class="mdi mdi-image"></i></span>
                                        </div>
                                        <input class="form-control" type="file" name="pic2" id="img2" onchange="readPic2(this);">
                                    </div>
                                    <div class="thumbnail">
                                        <?php if(!empty($i->picture2)) { ?>
                                            <button class="btn btn-secondary btn-rounded btn-xs delete_but" onclick="deleteImage('<?php echo $id; ?>','picture2','<?php echo base_url(); ?>')"> <span class="mdi mdi-close"></span> </button>
                                        <?php } ?>
                                        <img id="pic2" class="pictures" src="<?php echo (empty($i->picture2) ? base_url().'assets/default/default-img.jpg' : base_url().'uploads/'.$i->picture2); ?>" alt="your image" />
                                    </div>
                                    <span id="img2-check" class='img-check'></span>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text bg-gradient-info text-white"><i class="mdi mdi-image"></i></span>
                                        </div>
                                        <input class="form-control" type="file" name="pic3" id="img3" onchange="readPic3(this);">
                                    </div>
                                    <div class="thumbnail">
                                        <?php if(!empty($i->picture3)) { ?>
                                            <button class="btn btn-secondary btn-rounded btn-xs delete_but" onclick="deleteImage('<?php echo $id; ?>','picture3','<?php echo base_url(); ?>')"><span class="mdi mdi-close"></span> </button>
                                        <?php } ?>
                                        <img id="pic3" class="pictures" src="<?php echo (empty($i->picture3) ? base_url().'assets/default/default-img.jpg' : base_url().'uploads/'.$i->picture3); ?>" alt="your image" />
                                    </div>
                                    <span id="img3-check" class='img-check'></span>
                                </div>
                            </div>
                            <hr> 
                            <div class="row">
                                <div class="col-lg-12" id='alt'>
                                    <center>
                                        <input style="width:100%" type="button" class="btn btn-gradient-info pull right" onclick='saveChangesItem()' value="Update Item" id="next" name='nextitem'>
                                    </center>
                                </div>
                                    <input type="hidden" name="category_id" id="category_id">
                                    <input type="hidden" name="binid" id="binid">
                                    <input type="hidden" name="pn_format" id="pn_format">
                                    <input type="hidden" name="itemid" id="itemid" value="<?php echo $id; ?>">
                                <?php } ?>
                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        




