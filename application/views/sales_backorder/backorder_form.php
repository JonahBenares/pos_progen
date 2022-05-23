<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sales_backorder.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-backup-restore"></i>
                </span> Sales Back Order
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Sales Back Order &nbsp;
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
                                    <select class="form-control select2" id = "dr_no" name = "dr_no" onchange="dr_append()">
                                        <option value="">--Select DR No--</option>
                                        <?php foreach($dr_no AS $d){ ?>
                                            <option value="<?php echo $d['sales_id'];?>" myTag='<?php echo $d['transaction_type']; ?>'><?php echo $d['dr_no']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <input type='hidden' name='sales_id' id='sales_id'>
                                    <input type='hidden' name='transaction_type' id='transaction_type'>
                                    <input type="button" class="btn btn-md btn-gradient-success btn-block" name="" value="Search" onclick="loadSalesBO()">
                                </div>
                            </div>
                        <hr>
                        <form id='sales_bo'>
                       <?php if(!empty($sales_backorder)){ 
                            foreach($head AS $h){ ?>
                        <div class="row">
                            <div class="col-lg-8">
                                <table width="100%">
                                    <tr>
                                        <td width="15%"><h3>DR No.</h3></td>
                                        <td width="85%"><h3>: <?php echo $h['dr_no']; ?></h3></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">Client</td>
                                        <td>: <?php echo $h['client']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">Purpose</td>
                                        <td>: <?php echo $h['purpose']; ?></td>
                                    </tr>
                                </table>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <td width="40%" align="left"><input type="date" class="ml-2 form-control" name="salesbo_date" id = "salesbo_date" value="<?php echo date("Y-m-d");?>"style="width:50%;" required></td>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <?php if ($h['type']=='Goods') { ?>
                                    <table width="100%">
                                    <tr>
                                        <td width="30%" style="vertical-align: text-top;">PGC PR No.</td>
                                        <td width="70%">: <?php echo $h['pr_no']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">PGC PR Date</td>
                                        <td>: <?php echo $h['pr_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><br></td>
                                    </tr>
                                </table>
                                <?php } else { ?>
                                <table width="100%">
                                    <tr>
                                        <td width="30%" style="vertical-align: text-top;">PGC JOR No.</td>
                                        <td width="70%">: <?php echo $h['pr_no']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">PGC JOR Date</td>
                                        <td>: <?php echo $h['pr_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><br></td>
                                    </tr>
                                </table>
                               <?php } ?>
                            </div>
                        </div>
                        <?php } ?>     
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered" id="myTdable">
                                    <thead>
                                        <tr>
                                            <th width="5%">Sales Qty</th>
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
                                        if(!empty($sales_backorder)){
                                        foreach($sales_backorder AS $sb) {
                                        ?>
                                        <tr>
                                            <td class="p-0"><input type='number' class="form-control" name='quantity[]' id="quantity<?php echo $ct; ?>" value="<?php echo $sb['quantity']; ?>" style='width:90px' max="<?php echo $sb['quantity']; ?>"  onkeyup="changeQty(<?php echo $ct; ?>)"></td>
                                            <input type='hidden' name='avail_qty' id='avail_qty<?php echo $ct; ?>' value="<?php echo number_format($sb['quantity']); ?>">
                                            <td align="right"><?php echo $sb['quantity']; ?></td>
                                            <td class="p-0"><input type='text' class="form-control" name='item_cost[]' id="item_cost<?php echo $ct; ?>" value="<?php echo $sb['item_cost']; ?>" style='width:100px' onkeyup="changePrice(<?php echo $ct; ?>)"></td>
                                            <!-- <td class="p-0"><input type="text" class="form-control" name='serial_no[]' id="serial_no<?php echo $ct; ?>" value="<?php echo $sb['serial_no']; ?>"></td> -->
                                            <td><?php echo $sb['serial_no']; ?></td>
                                            <td><?php echo $sb['catalog_no']; ?></td>
                                            <td><?php echo $sb['supplier']; ?></td>
                                            <td><?php echo $sb['item']; ?></td>
                                            <td><?php echo $sb['brand']; ?></td>
                                            <!-- <td align="right"><span id="total_cost<?php echo $ct; ?>"><?php echo number_format($sb['total_cost'],2); ?></span></td> -->
                                            <td align="right"><input type="text" class="form-control amount-txt total_cost" name='total_cost[]' id="total_cost<?php echo $ct; ?>" placeholder="00.00" readonly=""></td>
                                            <td class="p-0"><textarea class="form-control" name='remarks[]' id='remarks[]'></textarea></td>
                                        </tr>
                                        <input type='hidden' name='expqty[]' value="<?php echo $sb['quantity']; ?>" style='width:50px' max="<?php echo $sb['quantity']; ?>">
                                        <!-- <input type='hidden' name='total_cost[]' value="<?php echo $sb['quantity']; ?>" style='width:50px'""> -->
                                    <?php 
                                        $ct++;
                                        }
                                    ?>
                                    </tbody>
                                </table>
                                <center><div id='alt' style="font-weight:bold"></div></center>
                                <input type="hidden" name="count" id="count" value="<?php echo $ct; ?>">
                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                <input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['user_id']; ?>">
                                <input type='hidden' name='sales_id' value="<?php echo $id; ?>">
                                <input type='hidden' name='transaction_type' value="<?php echo $type; ?>">
                                <input type='hidden' name='sales_item_id' value="<?php echo $sb['sales_item_id']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <input type='button' class="btn btn-gradient-success btn-md btn-block"  onclick='saveSalesBO()' value='Save and Print' id ="savebutton">
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
        

