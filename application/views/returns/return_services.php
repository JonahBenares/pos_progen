<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi mdi-sync"></i>
                </span> Return (Services)
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Return (Services) &nbsp;
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
                                <select class="form-control" id = "dr_no" name = "dr_no">
                                    <option value="">--Select DR No--</option>
                                        <option value=""></option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type='hidden' name='sales_good_head_id' id='sales_good_head_id'>
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" name="" value="Search" onclick="loadReturn()">
                            </div>
                        </div>
                        <hr> 
                        <form id="returnSave">
                            <div class="row">
                                <div class="col-lg-12">
                                    <small>DR No. :</small>
                                    <h3><b>DR0109299</h3></b>
                                    <table class="table-borsdered" width="100%">
                                        <tr>
                                            <td>Returned by:</td>
                                            <td >Ma. Julyn Marie May Jalangalog</td>
                                        </tr>
                                        <tr>
                                            <td width="10%">Sales Date:</td>
                                            <td width="40%" align='left'> July 20, 1010</td>
                                            <td align="right">VAT:</td>
                                            <td>&nbsp; Yes</td>
                                           
                                        </tr>
                                        <tr>
                                            <td width="10%" >JOR Date:</td>
                                            <td width="40%" >July 19, 2020</td>
                                            <td width="10%" align="right">JOR No:</td>
                                            <td width="40%">&nbsp; JOR-00393</td>
                                        </tr>
                                        <tr>
                                            <td width="10%">JOI Date:</td>
                                            <td >July 19, 2020</td>
                                            <td align="right">JOI No:</td>
                                            <td >&nbsp; PR-00393</td>
                                        </tr>
                                        <tr>
                                            <td>Remarks:</td>
                                            <td >remark</td>
                                            <td width="10%" align="right">Date Return:</td>
                                            <td width="40%" align="left"><input type="date" class="ml-2 form-control" name="return_date" id = "return_date" value=""style="width:50%;"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <table class="table table-bordered table-hover" width="100%" id="myTdable">
                                <tr>
                                    <td class="td-head" width="6%">Return Qty</td>
                                    <td class="td-head" width="20%">Item Description</td>
                                    <td class="td-head" width="20%">Supplier</td>
                                    <td class="td-head" width="5%">Unit Cost</td>
                                    <td class="td-head" width="5%">Selling Price</td>
                                    <td class="td-head" width="10%">Brand</td>
                                    <td class="td-head" width="10%">Part No.</td>
                                    <td class="td-head" width="10%">Serial No.</td>
                                    <td class="td-head" width="13%">Remarks</td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" onkeypress="return isNumberKey(this, event)" class="form-control" name="12211" onkeyup="" id = "" max="999999" placeholder="99999">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="p-0">
                                        <textarea style="padding: 5px 10px;" rows="2" class="form-control" name="remarks" id="remarks"></textarea>
                                    </td>
                                </tr>                        
                            </table>
                            <br> 
                            <br>
                            <label>Consumables and Other Materials</label>
                            <table class="table table-bordered table-hover" width="100%">
                                <tr>
                                    <td class="td-head" width="6%">Qty</td>
                                    <td class="td-head" width="45%">Item Description</td>
                                    <td class="td-head" width="8%">UOM</td>
                                    <td class="td-head" width="14%">Unit Cost</td>
                                    <td class="td-head" width="13%">Remarks</td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" onkeypress="return isNumberKey(this, event)" class="form-control" name="12211" onkeyup="" id = "" max="999999" placeholder="99999">
                                    </td>
                                    <td>Rags</td>
                                    <td>pc/s</td>
                                    <td>233.00</td>
                                    <td class="p-0">
                                        <textarea style="padding: 5px 10px;" rows="2" class="form-control" name="remarks" id="remarks"></textarea>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <label>Manpower</label>
                            <table class="table table-bordered table-hover" width="100%">
                                <tr>
                                    <td class="td-head" width="45%">Employee</td>
                                    <td class="td-head" width="8%">Days</td>
                                    <td class="td-head" width="8%">Rate</td>
                                    <td class="td-head" width="14%">Overtime</td>
                                    <td class="td-head" width="13%">Remarks</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" onkeypress="return isNumberKey(this, event)" class="form-control" name="12211" onkeyup="" id = "" max="999999" placeholder="99999">
                                    </td>
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" onkeypress="return isNumberKey(this, event)" class="form-control" name="12211" onkeyup="" id = "" max="999999" placeholder="99999">
                                    </td>
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" onkeypress="return isNumberKey(this, event)" class="form-control" name="12211" onkeyup="" id = "" max="999999" placeholder="99999">
                                    </td>
                                    <td class="p-0">
                                        <textarea style="padding: 5px 10px;" rows="2" class="form-control" name="remarks" id="remarks"></textarea>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <label>Actual Rental Cost</label>
                            <table class="table table-bordered table-hover" width="100%">
                                <tr>
                                    <td class="td-head" width="8%">Qty</td>
                                    <td class="td-head" width="45%">Equipment</td>
                                    <td class="td-head" width="8%">Rate</td>
                                    <td class="td-head" width="8%">Unit</td>
                                    <td class="td-head" width="14%">Days/Hours</td>
                                    <td class="td-head" width="13%">Remarks</td>
                                </tr>
                                <tr >
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" onkeypress="return isNumberKey(this, event)" class="form-control" name="12211" onkeyup="" id = "" max="999999" placeholder="99999">
                                    </td>
                                    <td>equipment 1</td>
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" onkeypress="return isNumberKey(this, event)" class="form-control" name="12211" onkeyup="" id = "" max="999999" placeholder="99999">
                                    </td>
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" onkeypress="return isNumberKey(this, event)" class="form-control" name="12211" onkeyup="" id = "" max="999999" placeholder="99999">
                                    </td>
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" onkeypress="return isNumberKey(this, event)" class="form-control" name="12211" onkeyup="" id = "" max="999999" placeholder="99999">
                                    </td>
                                    <td class="p-0">
                                        <textarea style="padding: 5px 10px;" rows="2" class="form-control" name="remarks" id="remarks"></textarea>
                                    </td>
                                </tr>
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
                             <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        

