<?php
    $ci =& get_instance();
    $now = date("Y-m-d");

      if(!empty($fifo_in)){
        foreach ($fifo_in as $key => $row) {
            $date[$key]  = $row['receive_date'];
         
        }
        array_multisort($date, SORT_DESC,  $date, SORT_DESC, $fifo_in);
    }
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
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Item Description</p>
                                            <h3 class="mb-0 font-weight-medium"><?php echo $det['item_name'];?></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 offset-lg-1">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Available Quantity</p>
                                            <p class="mb-0 font-weight-medium"><?php echo number_format($det['totalqty'],2);?></p>
                                        </div> 
                                    </div>
                                    <div class="col-lg-2 offset-lg-1">
                                        <div class="form-group">
                                            <p class="text-muted mb-0">Expired Quantity</p>
                                            <p class="mb-0 font-weight-medium"><?php echo number_format($det['expired_qty'],2);?></p>
                                        </div> 
                                    </div>
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
                                            <p class="mb-0 mr-3 font-weight-semibold"><?php echo number_format($det['highest_cost'],2);?></p>
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
            <div class="col-lg-2"><center><br><span style="color:#aeaeae;font-size: 13px;">RECEIVE TRANSACTIONS</span></center></div>
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
                                        Receive Transactions
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-hover" id="viewitem">
                                            <thead>
                                                <tr>                               
                                                                          
                                                    <th width="10%"> Receive Date </th>
                                                    <th width="25%"> Supplier </th>
                                                    <th width="15%"> PR No. </th>
                                                    <th width="10%"> Catalog No. </th>
                                                    <!-- <th width="5%"> NKK No. </th>
                                                    <th width="5%"> SEMT No. </th> -->
                                                    <th width="10%"> Brand </th>
                                                    <th width="10%"> Serial No </th>
                                                    <th width="10%"> Expiration Date </th>
                                                    <th width="10%"> Item Cost</th>
                                                    <th width="5%"> Orig Qty </th>
                                                    <th width="15%"> Remaining Qty </th>
                                                    <!-- <th width="5%">
                                                        <center><span class="mdi mdi-menu"></span></center>
                                                    </th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                if(!empty($fifo_in)) {
                                                foreach($fifo_in AS $in){ 
                                                    if($in['expiry_date'] != "" && $in['expiry_date'] <= $now){
                                                        $background = " style='background-color:#f1948a'";
                                                    } else {
                                                        $background ="";
                                                    } ?>
                                                <tr <?php echo $background; ?>>
                                                    <td><?php echo date("Y-m-d",strtotime($in['receive_date']));?></td>
                                                    <td><?php echo $in['supplier'];?></td>
                                                    <td><?php echo $in['pr_no'];?></td>
                                                    <td><?php echo $in['catalog_no'];?></td>
                                                    <td><?php echo $in['brand'];?></td>
                                                    <td><?php echo $in['serial_no'];?></td>
                                                    <td><?php echo ($in['expiry_date']!='') ? date("Y-m-d",strtotime($in['expiry_date'])) : '' ;?></td>
                                                    <td><?php echo number_format($in['item_cost'],2);?></td>
                                                    <td><?php echo number_format($in['quantity'],2);?></td>
                                                    <td><?php echo number_format($in['remaining_qty'],2);?></td>
                                                    <!-- <td align="center">
                                                        <a href="<?php echo base_url(); ?>reports/stock_card" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>
                                                    </td> -->
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                <td colspan='10'><center>No data available.</center></td>
                                                </tr>
                                            <?php } ?>
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
        




