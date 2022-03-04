<?php
    $ci =& get_instance();
?>

<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-warning text-white mr-2">
                  <i class="mdi mdi-file-document-box"></i>
                </span> Items 
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>items/item_list">Item List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Item</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-header bg-gradient-warning card-img-holder text-white pt-3 " ></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php foreach($details AS $det) { ?>
                                <div class="form-group">
                                    <p class="text-muted mb-0">Item Description</p>
                                    <h3 class="mb-0 font-weight-medium"><?php echo $det['item_name'];?></h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Category</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"<?php echo $det['category'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 offset-lg-1">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Warehouse</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['warehouse'];?></p>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Unit</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['unit'];?></p>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Sub Category</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['subcategory'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 offset-lg-1">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Group</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['group'];?></p>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Location</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['location'];?></p>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">PN Number</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['original_pn'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 offset-lg-1">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Highest Cost</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['selling_price'];?></p>
                                        </div>                                         
                                    </div>
                                    <div class="col-lg-3 offset-lg-1">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Rack</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['rack'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Bin</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['bin'];?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">NKK Number</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['nkk_no'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 offset-lg-1">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">SEMT Number</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['semt_no'];?></p>
                                        </div>                                         
                                    </div>
                                    <div class="col-lg-3 offset-lg-1">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Barcode</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['barcode'];?></p>
                                        </div> 
                                    </div>
                                    <div class="col-lg-3">
                                         <div class="form-group">
                                            <p class="text-muted mb-0">Weight</p>
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo $det['weight'];?></p>
                                        </div>
                                    </div>
                                </div>
                                <hr> 
                                <div id="lightgallery-without-thumb" class="row lightGallery" >
                                    <a href="<?php if(!empty($det['picture1'])) { 
                                                    echo base_url(); ?>uploads/<?php echo $det['picture1']; 
                                                 } else { echo base_url(); ?>assets/images/default-img.jpg <?php } ?>" class="image-tile">
                                        <img src="<?php if(!empty($det['picture1'])) { 
                                                    echo base_url(); ?>uploads/<?php echo $det['picture1']; 
                                                 } else { echo base_url(); ?>assets/images/default-img.jpg <?php } ?>" class="image_size" alt="Image One">
                                        <span>Image One</span>
                                    </a>
                                    <a href="<?php if(!empty($det['picture2'])) { 
                                                    echo base_url(); ?>uploads/<?php echo $det['picture2']; 
                                                 } else { echo base_url(); ?>assets/images/default-img.jpg <?php } ?>" class="image-tile">
                                        <img src="<?php if(!empty($det['picture2'])) { 
                                                    echo base_url(); ?>uploads/<?php echo $det['picture2']; 
                                                 } else { echo base_url(); ?>assets/images/default-img.jpg <?php } ?>" class="image_size" alt="Image Two">
                                        <span>Image Two</span>
                                    </a>
                                    <a href="<?php if(!empty($det['picture3'])) { 
                                                    echo base_url(); ?>uploads/<?php echo $det['picture3']; 
                                                 } else { echo base_url(); ?>assets/images/default-img.jpg<?php } ?>" class="image-tile">
                                        <img src="<?php if(!empty($det['picture3'])) { 
                                                    echo base_url(); ?>uploads/<?php echo $det['picture3']; 
                                                 } else { echo base_url(); ?>assets/images/default-img.jpg<?php } ?>" class="image_size" alt="Image Three">
                                        <span>Image Three</span>
                                    </a>
                                </div>                                
                            </div>                            
                        </div>   
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5"><br><hr></div>
            <div class="col-lg-2"><center><br><span style="color:#aeaeae;font-size: 13px;">CROSS REFERENCE</span></center></div>
            <div class="col-lg-5"><br><hr></div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <h3 class="mb-0 font-weight-medium">
                                        <button type="button" class="btn btn-gradient-warning btn-icon">
                                            <i class="mdi mdi-swap-horizontal"></i>
                                        </button> 
                                        Cross Reference
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-hover" id="myTable">
                                            <thead>
                                                <tr>                               
                                                                          
                                                    <th width="25%"> Supplier </th>
                                                    <th width="10%"> Catalog No. </th>
                                                    <!-- <th width="5%"> NKK No. </th>
                                                    <th width="5%"> SEMT No. </th> -->
                                                    <th width="10%"> Brand </th>
                                                    <th width="10%"> Serial No </th>
                                                    <th width="10%"> Average Cost per Supplier </th>
                                                    <th width="5%"> Qty </th>
                                                    <th width="10%"> Last Item received </th>
                                                    <th width="5%">
                                                        <center><span class="mdi mdi-menu"></span></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <!-- <td></td>
                                                    <td></td> -->
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center">
                                                        <a href="<?php echo base_url(); ?>reports/stock_card" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <!-- <td></td>
                                                    <td></td> -->
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center">
                                                        <a href="<?php echo base_url(); ?>reports/stock_card" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                   <!--  <td></td>
                                                    <td></td> -->
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center">
                                                        <a href="<?php echo base_url(); ?>reports/stock_card" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <!-- <td></td>
                                                    <td></td> -->
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center">
                                                        <a href="<?php echo base_url(); ?>reports/stock_card" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <!-- <td></td>
                                                    <td></td> -->
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center">
                                                        <a href="<?php echo base_url(); ?>reports/stock_card" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <!-- <td></td>
                                                    <td></td> -->
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center">
                                                        <a href="<?php echo base_url(); ?>reports/stock_card" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>
                                                    </td>
                                                </tr>
                                            </tbody>                            
                                        </table>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>                            
                        </div>   
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body"></div>
                </div>
            </div> -->
        </div>
    </div>
</div>
        



