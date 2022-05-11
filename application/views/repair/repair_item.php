<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/repair.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-wrench"></i>
                </span>Repair Item
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item active" aria-current="page">Damage Item</li> -->
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-success card-img-holder text-white"></div>
                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-lg-12">
                                <form id='redirect'>
                                <table class=" table-hover table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="4%"> 
                                                <center>
                                                    <input type="checkbox" class="form-control" style="width:25px" onClick="toggle_multi(this)">
                                                </center>
                                            </th>
                                            <th><label class="label-table">PDR No</label></th>
                                            <th width="36%"><label class="label-table">Item Name</label></th>
                                            <th><label class="label-table">Quantity</label></th>
                                            <th><label class="label-table">Receive Date</label></th>
                                            <th><label class="label-table">PR No</label></th>
                                            <th><label class="label-table">Category</label></th>
                                            <th><label class="label-table">Sub Category</label></th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 

                                         $x=''; if(!empty($repair_items)){ $x=0; foreach($repair_items as $r){ ?>
                                        <tr>
                                            <td class="p-b-10 p-t-10" align="center"><input type="hidden" class="form-control"  style="width:25px" name="in_id[]" value="<?php echo $r['in_id']; ?>"><input type="hidden" class="form-control"  style="width:25px" name="item_id[]" value="<?php echo $r['item_id']; ?>"><input type="checkbox" class="form-control"  style="width:25px" name="damagedetid[]" value="<?php echo $r['damage_det_id']; ?>"></td>
                                            <td><label class="label-table"><?php echo $r['pdr_no'];?></label></td>
                                            <td><label class="label-table"><?php echo $r['item_name'];?></label></td>
                                            <td><label class="label-table"><?php echo number_format($r['qty'],2);?></label></td>
                                            <td><label class="label-table"><?php echo date("M j, Y",strtotime($r['receive_date']))?></label></td>
                                            <td><label class="label-table"><?php echo $r['pr_no'];?></label></td>
                                            <td><label class="label-table"><?php echo $r['category'];?></label></td>
                                            <td><label class="label-table"><?php echo $r['subcategory'];?></label></td>
                                        </tr>
                                        <?php $x++; } }?>
                                    </tbody>
                                </table>
                                <br>
                                <input type = "button" class="btn btn-gradient-success btn-md btn-block" value = "Repair" onclick="redirect_repair();">
                                <input type="hidden" id="count" name="count" class="form-control" value = "<?php echo $x;?>">
                                <input type="hidden" name="user_id" value = "<?php echo $_SESSION['user_id'];?>">
                                <input type="hidden" name="baseurl" id="baseurl" value = "<?php echo base_url();?>">
                        </form>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <br> 
    </div>
</div>




