<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/backorder.js"></script>
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
                                <select class="form-control select2" id = "pr_no" name = "pr_no">
                                    <option value='' selected>Choose DR</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <!-- <input type='hidden' name='sales_good_head_id' id='sales_good_head_id'> -->
                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" value="Search" onclick="loadBackorder()">
                            </div>
                        </div>
                        <hr>
                        <form id=''>
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <table width="100%">
                                    <tr>
                                        <td width="15%"><h3>DR No.</h3></td>
                                        <td width="85%"><h3>: </h3></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">Client</td>
                                        <td>: </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">Purpose</td>
                                        <td>: </td>
                                    </tr>
                                </table>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="receive_date" id="receive_date" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <table width="100%">
                                    <tr>
                                        <td width="30%" style="vertical-align: text-top;">PGC JOR No.</td>
                                        <td width="70%">: PO2029-928829-CNPR</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">PGC JOR Date</td>
                                        <td>: 09-09-29</td>
                                    </tr>
                                    <tr>
                                        <td><br></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">PGC JOI No.</td>
                                        <td>: PO2029-928829-CNPR</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">PGC JOI Date</td>
                                        <td>: 09-09-29</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
                                        <tr>
                                            <td class="p-0"><input type='number' class="form-control" name='quantity[]' id="" value="" style='width:90px' max=""  onkeyup=""></td>
                                            <input type='hidden' name='avail_qty' id='' value="; ?>">
                                            <td align="right"></td>
                                            <td class="p-0"><input type='text' class="form-control" name='item_cost[]' id="" value="" style='width:100px'></td>
                                            <td class="p-0"><input type="text" class="form-control" name='serial_no[]' id="" value=""></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right"><span id=""></span></td>
                                            <td class="p-0"><textarea class="form-control" name='remarks[]' id='remarks[]'></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        

