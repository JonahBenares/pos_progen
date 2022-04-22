<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/backorder.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-backup-restore"></i>
                </span> Back Order
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Back Order &nbsp;
                        <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-gradient-success card-img-holder text-white pt-2"></div>
                    <div class="card-body">   
                        <div class="row">
                            <div class="col-lg-4 offset-lg-3">
                                <select class="form-control select2" id = "pr_no" name = "pr_no">
                                    <option value='' selected>Choose PR</option>
                                    <?php 
                                        foreach($prback AS $pb){  
                                            if($pb['received']!=0){ ?>
                                            <option value="<?php echo $pb['rdid']; ?>"><?php echo $pb['pr_no']." - qty -".$pb['balance']; ?></option>
                                        <?php } 
                                     } ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <!-- <input type='hidden' name='sales_good_head_id' id='sales_good_head_id'> -->
                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" value="Search" onclick="loadBackorder()">
                            </div>
                        </div>
                        <hr>
                        <form id='backorder'>
                        <?php 
                        if(!empty($id)){ 
                            foreach($details AS $hd) {
                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <table width="100%">
                                    <tr>
                                        <td width="25%"><h3>JO/PR No.</h3></td>
                                        <td width="75%"><h3>: <?php echo $hd['prno']; ?></h3></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">Department</td>
                                        <td>: <?php echo $hd['department']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">Purpose</td>
                                        <td>: <?php echo $hd['purpose']; ?></td>
                                    </tr>
<!--                                     <tr>
                                        <td style="vertical-align: text-top;">Enduse</td>
                                        <td>: 12 Units ConnectingRod Assembly and 12 Units Piston Assembly asdas da asdd s </td>
                                    </tr> -->
                                </table>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="receive_date" id="receive_date" required>
                                </div>
                                <div class="form-group">
                                    <label>PO No.</label>
                                    <input type="text" class="form-control" name="po_no" id="po_no" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>DR No.</label>
                                    <input type="text" class="form-control" name="dr_no" id="dr_no" required>
                                </div>
                                <div class="form-group">
                                    <label>SI/OR No.</label>
                                    <input type="text" class="form-control" name="si_no" id="si_no" required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="receive_id" id="receive_id" value="<?php echo $hd['receiveid']; ?>">
                         <input type='hidden' name='rdid' id='rdid' value="<?php echo $hd['rdid']; ?>">
                        <?php } ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="5%">Receive Qty</th>
                                            <th width="5%">Back Order Qty</th>
                                            <th width="5%">Unit Price</th>
                                            <th width="10%">Serial Number</th>
                                            <th>Cat No.</th>
                                            <th>Supplier</th>
                                            <th width="15%">Item Description</th>
                                            <th width="15%">Brand</th>
                                            <th>Total Cost</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody id="item_body">
                                        <?php 
                                        $ct=0;
                                        if(!empty($items)){
                                        foreach($items AS $it) {
                                            /*if($it['backorder_qty']!=0){*/
                                        ?>
                                        <tr>
                                            <td class="p-0"><input type='number' class="form-control" name='quantity[]' id="quantity<?php echo $ct; ?>" value="<?php echo $it['received_qty']; ?>" style='width:90px' max="<?php echo $it['received_qty']; ?>"  onkeyup="changeQty(<?php echo $ct; ?>)"></td>
                                            <input type='hidden' name='avail_qty' id='avail_qty<?php echo $ct; ?>' value="<?php echo number_format($it['quantity']); ?>">
                                            <td align="right"><?php echo $it['quantity']; ?></td>
                                            <td class="p-0"><input type='text' class="form-control" name='item_cost[]' id="item_cost<?php echo $ct; ?>" value="<?php echo $it['item_cost']; ?>" style='width:100px' onkeyup="changePrice(<?php echo $ct; ?>)"></td>
                                            <td class="p-0"><input type="text" class="form-control" name='serial_no[]' id="serial_no<?php echo $ct; ?>" value="<?php echo $it['serial_no']; ?>"></td>
                                            <td><?php echo $it['catalog_no']; ?></td>
                                            <td><?php echo $it['supplier']; ?></td>
                                            <td><?php echo $it['item']; ?></td>
                                            <td><?php echo $it['brand']; ?></td>
                                            <td align="right"><span id="total_cost<?php echo $ct; ?>"><?php echo number_format($it['total_cost'],2); ?></span></td>
                                            <td class="p-0"><textarea class="form-control" name='remarks[]' id='remarks[]'></textarea></td>
                                        </tr>
                                        <input type='hidden' name='expqty[]' value="<?php echo $it['quantity']; ?>" style='width:50px' max="<?php echo $it['quantity']; ?>">
                                         <input type='hidden' name='riid[]' value="<?php echo $it['riid']; ?>">
                                    <?php 
                                        $ct++;
                                        }
                                    /*}*/
                                    ?>
                                    </tbody>
                                </table>
                                <center><div id='alt' style="font-weight:bold"></div></center>
                                <input type="hidden" name="count" id="count" value="<?php echo $ct; ?>">
                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                <input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['user_id']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <input type='button' class="btn btn-gradient-success btn-md btn-block"  onclick='saveBO()' value='Save and Print' id ="savebutton">
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                        <?php } }?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        

