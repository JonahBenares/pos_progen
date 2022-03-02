<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-file-document"></i>
                </span> Reports
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Billing Statement &nbsp;
                        <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>BILLED <br> <small>Billing Statement</small></h4><!-- 
                                <h4 class="m-0">Billing Statement - <b>PENDING</b></h4> -->
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <!-- <button type="button" class="btn btn-gradient-success btn-sm btn-rounded" data-toggle="modal" data-target="#filterBillingState">
                                        <b><span class="mdi mdi-filter"></span> Filter</b>
                                    </button>  -->
                                    <a href="<?php echo base_url(); ?>report/print_monthly_report" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </a>                            
                                    <button type="button" class="btn btn-gradient-warning btn-sm btn-rounded" data-toggle="modal" data-target="#updateSales">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">   
                        <div class="row">
                            <div class="col-lg-3">
                                <!-- <input type="" class="form-control" name="" placeholder="Customer"> -->
                                <select class="form-control">
                                    <option>--Select Customer--</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <!-- <input type="" class="form-control" name="" placeholder="Customer"> -->
                                <select class="form-control">
                                    <option>--Type--</option>
                                    <option>Delivery Reciept - Goods</option>
                                    <option>Delivery Reciept - Services</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" name="" value="Filter">
                            </div>
                            <div class="col-lg-3 offset-lg-1">
                                <small class="pull-right">Overall Total Amount</small>
                                <h2 class="pull-right">P 225,545,555</h2>
                            </div>
                        </div>
                        <hr>   
                        <form>     
                            <table class=" table-hover table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="4%"> 
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </th>
                                        <th width="30%"><label class="label-table">DR Date</label></th>
                                        <th width="30%"><label class="label-table">DR No</label></th>
                                        <th width="31"><label class="label-table pull-right">Total Amount &nbsp;</label></th>                                                                
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; October 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 1255525 &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; October 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 45455 &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; October 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 6777 &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; July 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 67775 &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; November 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 688885 &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; January 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 67556 &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; December 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 567765 &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center>
                                                <input type="checkbox" class="form-control" style="width:25px">
                                            </center>
                                        </td>
                                        <td> &nbsp; November 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 56777 &nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br> 
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                    <a href="<?php echo base_url(); ?>reports/bill_pay" class="btn btn-gradient-success btn-md btn-block">Pay</a>
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
        
