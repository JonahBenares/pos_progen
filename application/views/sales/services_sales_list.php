<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sales.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-chart-areaspline"></i>
                </span> Sales
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Sales List (Services) &nbsp;
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
                                <h4 class="m-0">Sales List (<b>Services</b>)</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>sales/services_add_sales_head" class="btn btn-gradient-primary btn-sm btn-rounded">
                                        <b><span class="mdi mdi-plus"></span> Add</b>
                                    </a>
                                    <!-- <button type="button" class="btn btn-gradient-success btn-sm btn-rounded" data-toggle="modal" data-target="#filterSales">
                                        <b><span class="mdi mdi-filter"></span> Filter</b>
                                    </button>   -->                          
                                    <button type="button" class="btn btn-gradient-warning btn-sm btn-rounded" onclick="exportSalesserv();">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </button>
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">                        
                        <table class="table table-bordered table-hover" id="myTable" width="100%">
                            <thead>
                                <tr>
                                    <td width="5%">DR Date</td>
                                    <td width="5%">DR No.</td>
                                    <td width="15%">Client</td>
                                    <td width="15%">Address</td>
                                    <td width="5%">PGC JOR No.</td>   
                                    <td width="5%">PGC JOI No.</td> 
                                    <td width="5%">Service Report No.</td> 
                                    <th width="5%"><center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($service_head)){ foreach($service_head AS $sh){ ?>
                                <tr>
                                    <td><?php echo $sh['sales_date'];?></td>
                                    <td><?php echo $sh['dr_no'];?></td>
                                    <td><?php echo $sh['client'];?></td>
                                    <td><?php echo $sh['address'];?></td>   
                                    <td><?php echo $sh['jor_no'];?></td>
                                    <td><?php echo $sh['joi_no'];?></td>
                                    <td><?php echo $sh['service_no'];?></td>
                                    <td align="center">
                                        <!-- <a href="<?php echo base_url(); ?>sales/services_update_sales_head" class="btn btn-xs btn-gradient-info btn-rounded" ><span class="mdi mdi-pencil"></span></a>
                                        <a href="" class="btn btn-xs btn-gradient-danger btn-rounded" data-toggle="modal" data-target="#deleteSales"><span class="mdi mdi-delete"></span></a> -->
                                        <a href="<?php echo base_url(); ?>sales/services_print_sales/<?php echo $sh['sales_serv_head_id']?>" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>
                                        <?php if($sh['service_no']==''){ ?>
                                        <span data-toggle="modal" data-target="#filterGroup">
                                            <a href="#" class="btn btn-xs btn-gradient-success btn-rounded"><span class="mdi mdi-textbox" data-toggle="tooltip" data-placement="right" id="serviceno" data-id="<?php echo $sh['sales_serv_head_id'];?>" data-original-title="Add Service Report Number" title="Add Service Report Number"></span></a>
                                        </span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        



<div class="modal fade" id="filterGroup" tabindex="-1" role="dialog" aria-labelledby="filterGroup" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header success-modalhead">
                <h5 class="modal-title" id="exampleModalLabel">Add Service Report Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="saveServicenumber">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="service_date" id="service_date">
                    </div>
                    <div class="form-group">
                        <label>Service Report Number</label>
                        <input type="text" class="form-control" name="service_no" id="service_no" placeholder="Service Report Number">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="sales_serv_head_id" name="sales_serv_head_id">
                    <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url();?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="saveServicenumber();">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
