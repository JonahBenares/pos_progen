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
                                <h4>PAID <br> <small>Billing Statement</small></h4><!-- 
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
                            <div class="col-lg-3 offset-lg-2">
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
                        </div>
                        <hr>   
                        <form>     
                            <table class="table table-hover table-bordered" width="100%" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="30%"><label class="label-table">DR Date</label></th>
                                        <th width="30%"><label class="label-table">DR No</label></th>
                                        <th width="31"><label class="label-table pull-right">Total Amount &nbsp;</label></th>
                                        <th width="5%">
                                            <center>
                                                <label class="label-table"><span class="mdi mdi-menu"></span></label>
                                            </center>
                                        </th>                                                                 
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> &nbsp; October 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 1255525 &nbsp;</td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>reports/print_billing" class="btn btn-xs btn-gradient-warning btn-rounded">
                                                <span class="mdi mdi-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> &nbsp; October 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 45455 &nbsp;</td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>reports/print_billing" class="btn btn-xs btn-gradient-warning btn-rounded">
                                                <span class="mdi mdi-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> &nbsp; October 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 6777 &nbsp;</td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>reports/print_billing" class="btn btn-xs btn-gradient-warning btn-rounded">
                                                <span class="mdi mdi-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> &nbsp; July 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 67775 &nbsp;</td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>reports/print_billing" class="btn btn-xs btn-gradient-warning btn-rounded">
                                                <span class="mdi mdi-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> &nbsp; November 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 688885 &nbsp;</td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>reports/print_billing" class="btn btn-xs btn-gradient-warning btn-rounded">
                                                <span class="mdi mdi-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> &nbsp; January 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 67556 &nbsp;</td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>reports/print_billing" class="btn btn-xs btn-gradient-warning btn-rounded">
                                                <span class="mdi mdi-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> &nbsp; December 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 567765 &nbsp;</td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>reports/print_billing" class="btn btn-xs btn-gradient-warning btn-rounded">
                                                <span class="mdi mdi-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> &nbsp; November 20, 2022</td>
                                        <td> &nbsp; DR-29938773-8882</td>
                                        <td align="right">P 56777 &nbsp;</td>
                                        <td align="center">
                                            <a href="<?php echo base_url(); ?>reports/print_billing" class="btn btn-xs btn-gradient-warning btn-rounded">
                                                <span class="mdi mdi-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        