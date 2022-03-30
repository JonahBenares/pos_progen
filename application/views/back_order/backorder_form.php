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
                                <select class="form-control" id = "dr_no" name = "dr_no" onchange="dr_append()">
                                    <option value="">--Select PR No--</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type='hidden' name='sales_good_head_id' id='sales_good_head_id'>
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" name="" value="Search" onclick="loadReturn()">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <table width="100%">
                                    <tr>
                                        <td width="20%"><h3>JO/PR No.</h3></td>
                                        <td width="80%"><h3>: IT2019-9989388-CNPR</h3></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">Department</td>
                                        <td>: ECMG</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">Purpose</td>
                                        <td>: Consumables for Refurbishing/ Reconditioning</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top;">Enduse</td>
                                        <td>: 12 Units ConnectingRod Assembly and 12 Units Piston Assembly asdas da asdd s </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="">
                                </div>
                                <div class="form-group">
                                    <label>PO No.</label>
                                    <input type="text" class="form-control" name="">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>DR No.</label>
                                    <input type="text" class="form-control" name="">
                                </div>
                                <div class="form-group">
                                    <label>SI/OR No.</label>
                                    <input type="text" class="form-control" name="">
                                </div>
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
                                    <tbody>
                                        <tr>
                                            <td align="right">552</td>
                                            <td align="right">552</td>
                                            <td align="right">2255.22</td>
                                            <td class="p-0"><input type="text" class="form-control" name="" placeholder="Insert Serial"></td>
                                            <td></td>
                                            <td>MF Computer Solutions </td>
                                            <td>Laptop</td>
                                            <td>Asus</td>
                                            <td align="right">2255.22</td>
                                            <td>Kulang na dzzae</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <a href="<?php echo base_url(); ?>back_order/print_backorder" class="btn btn-gradient-success btn-md btn-block">Save and Print</a>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        

