<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi mdi-sync"></i>
                </span> Return
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Return &nbsp;
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
                                <!-- <input type="" class="form-control" name="" placeholder="Customer"> -->
                                <select class="form-control">
                                    <option>--Select DR No--</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" name="" value="Search">
                            </div>
                        </div>
                        <hr> 
                        <div class="row">
                            <div class="col-lg-12">
                                <small>DR No. :</small>
                                <h3><b>DR2022-02-0001</h3></b>
                                <table width="100%">
                                    <tr>
                                        <td width="10%">Department:</td>
                                        <td width="40%"> Maintenance</td>
                                        <td width="10%" align="right">JO/PR No:</td>
                                        <td width="40%">&nbsp; PFLM-239993-3994-CNPR</td>
                                    </tr>
                                    <tr>
                                        <td>Purpose:</td>
                                        <td> Reconditioning</td>
                                        <td align="right"> Date:</td>
                                        <td>&nbsp; January 10, 2022</td>
                                    </tr>
                                    <tr>
                                        <td>Enduse:</td>
                                        <td> DG1</td>
                                    </tr>
                                </table>
                            </div>
                        </div>     
                        <br>
                        <table class="table table-bordered table-hover" width="100%" id="myTdable">
                            <thead>
                                <tr>
                                    <th width="6%">Return Qty</th>
                                    <th width="20%">Item Description</th>
                                    <th width="6%">PR Balance </th>
                                    <th width="20%">Supplier</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Part No.</th>
                                    <th width="10%">Serial No.</th>
                                    <th width="5%">UOM</th>
                                    <th width="13%">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" class="form-control" placeholder="00" name="">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="p-0">
                                        <select style="padding: 5px 10px;" class="form-control">
                                            <option>-- select serial number --</option>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td class="p-0">
                                        <textarea style="padding: 5px 10px;" rows="2" class="form-control"></textarea>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <input style="padding: 5px 10px;" type="text" class="form-control" placeholder="00" name="">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="p-0">
                                        <select style="padding: 5px 10px;" class="form-control">
                                            <option>-- select serial number --</option>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td class="p-0">
                                        <textarea style="padding: 5px 10px;" rows="2" class="form-control"></textarea>
                                    </td>
                                </tr>
                            </tbody>                            
                        </table>
                        <br> 
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <a href="<?php echo base_url(); ?>returns/print_return" class="btn btn-gradient-success btn-md btn-block">Save and Print</a>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        

