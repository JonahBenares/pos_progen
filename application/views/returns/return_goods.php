<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script  type="text/javascript" src="<?php echo base_url(); ?>assets/js/return.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi mdi-sync"></i>
                </span> Return (Goods)
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Return (Goods) &nbsp;
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
                                <select class="form-control" id = "dr_no" name = "dr_no" onchange="dr_append()">
                                    <option value="">--Select DR No--</option>
                                    <?php foreach($dr_no AS $d){ ?>
                                        <option value="<?php echo $d->sales_good_head_id; ?>"><?php echo $d->dr_no; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type='hidden' name='sales_good_head_id' id='sales_good_head_id'>
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" name="" value="Search" onclick="loadReturn()">
                            </div>
                        </div>
                        <hr> 
                        <form id="returnSave">
                            <?php if(!empty($id)){ foreach($head AS $h){ ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <small>DR No. :</small>
                                    <h3><b><?php echo $h['dr_no']; ?></h3></b>
                                    <table class="table-borsdered" width="100%">
                                        <tr>
                                            <td>Returned by:</td>
                                            <td ><?php echo $h['client']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="10%">Sales Date:</td>
                                            <td width="40%" align='left'> <?php echo $h['sales_date']; ?></td>
                                            <td align="right">VAT:</td>
                                            <td>&nbsp; <?php echo (($h['vat'] == 1) ? 'Yes' : 'No'); ?></td>
                                           
                                        </tr>
                                        <tr>
                                            <td width="10%" >PR Date:</td>
                                            <td width="40%"  >&nbsp; <?php echo $h['pr_date']; ?></td>
                                            <td width="10%" align="right">PR No:</td>
                                            <td width="40%">&nbsp; <?php echo $h['pr_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="10%">PO Date:</td>
                                            <td>&nbsp; <?php echo $h['po_date']; ?></td>
                                            <td align="right">PO No:</td>
                                            <td>&nbsp; <?php echo $h['po_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Remarks:</td>
                                            <td ><?php echo $h['remarks']; ?></td>
                                            <td width="10%" align="right">Date Return:</td>
                                            <td width="40%" align="left"><input type="date" class="ml-2 form-control" name="return_date" id = "return_date" value="<?php echo date("Y-m-d");?>"style="width:50%;"></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Enduse:</td>
                                            <td> DG1</td>
                                        </tr> -->
                                        <input type="hidden" name="dr_save" id="dr_save" value="<?php echo $h['dr_no'];?>">
                                    </table>
                                </div>
                            </div>
                            <?php } ?>     
                            <br>
                            <table class="table table-bordered table-hover" width="100%" id="myTdable">
                                <thead>
                                    <tr>
                                        <th width="6%">Return Qty</th>
                                        <th width="20%">Item Description</th>
                                        <th width="20%">Supplier</th>
                                        <th width="5%">Unit Cost</th>
                                        <th width="5%">Selling Price</th>
                                        <th width="10%">Brand</th>
                                        <th width="10%">Part No.</th>
                                        <th width="10%">Serial No.</th>
                                        <th width="13%">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($item)){ $x=1; foreach($item AS $i){ ?>
                                    <tr>
                                        <td class="p-0">
                                            <input style="padding: 5px 10px;" type="text" onkeypress="return isNumberKey(this, event)" class="form-control" name="return_qty<?php echo $x; ?>" onkeyup="check_return_qty('<?php echo $x; ?>')" id = "retqty<?php echo $x; ?>" max="<?php echo $i['qty']; ?>" placeholder="<?php echo number_format($i['qty']); ?>">
                                        </td>
                                        <input type='hidden' name='qty<?php echo $x; ?>' id='qty<?php echo $x; ?>' value="<?php echo number_format($i['qty']); ?>">
                                        <td><?php echo $i['item'];?></td>
                                        <td><?php echo $i['supplier'];?></td>
                                        <td><?php echo number_format($i['unit_cost'],2);?></td>
                                        <td><?php echo number_format($i['selling_price'],2);?></td>
                                        <td><?php echo $i['brand'];?></td>
                                        <td><?php echo $i['catalog_no'];?></td>
                                        <td class="p-0"><?php echo $i['serial_no'];?></td>
                                        <td class="p-0">
                                            <textarea style="padding: 5px 10px;" rows="2" class="form-control" name="remarks<?php echo $x; ?>" id="remarks"></textarea>
                                        </td>
                                    </tr>
                                    <!-- <input type='hidden' name='returned_qty<?php echo $x; ?>' id='returned_qty<?php echo $x; ?>' value="<?php echo number_format($i['return_qty']); ?>"> -->
                                    <input type='hidden' name='unit_cost<?php echo $x; ?>' value="<?php echo $i['unit_cost']; ?>">
                                    <input type='hidden' name='selling_price<?php echo $x; ?>' value="<?php echo $i['selling_price']; ?>">
                                    <input type='hidden' name='in_id<?php echo $x; ?>' value="<?php echo $i['in_id']; ?>">
                                    <input type='hidden' name='item_id<?php echo $x; ?>' value="<?php echo $i['item_id']; ?>">
                                    <input type='hidden' name='sales_details_id<?php echo $x; ?>' value="<?php echo $i['sales_details_id']; ?>">
                                    <?php $x++; }  ?>
                                    <input type="hidden" name="count" id="count" value="<?php echo $x; ?>">
                                    <?php } ?>
                                   
                                </tbody>                            
                            </table>
                            <br> 
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                    <!-- <a href="<?php echo base_url(); ?>returns/print_return" class="btn btn-gradient-success btn-md btn-block">Save and Print</a> -->
                                    <input type="button" name="savedata" id="savedata" onclick="saveReturn()" class="btn btn-gradient-success btn-md btn-block" value="Save and Print">
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                            <?php } ?>
                             <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        

