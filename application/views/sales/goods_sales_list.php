<?php $ci =& get_instance(); ?>
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
                        <span></span>Sales List (Goods) &nbsp;
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
                                <h4 class="m-0">Sales List (<b>Goods</b>)</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>sales/goods_add_sales_head" class="btn btn-gradient-primary btn-sm btn-rounded">
                                        <b><span class="mdi mdi-plus"></span> Add</b>
                                    </a>                         
                                    <button type="button" class="btn btn-gradient-warning btn-sm btn-rounded"  data-toggle="modal" data-target="#exportGoodsFilter" >
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </button>
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">                        
                        <table class="table table-bordered table-hover" id="saleslist" width="100%">
                            <thead>
                                <tr>
                                    <td width="10%">Sales Date</td>
                                    <td width="10%">DR No.</td>
                                    <td width="10%">Client</td>
                                    <td width="10%">PGC PR No.</td>   
                                    <td width="10%">PGC PO No.</td> 
                                    <th width="8%"><center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($list AS $l){ ?>
                                <tr>
                                    <td><?php echo date('M j, Y', strtotime($l->sales_date)); ?></td>
                                    <td><?php echo $l->dr_no; ?></td>
                                    <td><?php echo $ci->get_name("client", "buyer_name", "client_id", $l->client_id); ?></td> 
                                    <td><?php echo $l->pr_no; ?></td>
                                    <td><?php echo $l->po_no; ?></td>
                                    <td align="center">
                                        <a href="<?php echo base_url(); ?>sales/goods_sales_update/<?php echo $l->sales_good_head_id; ?>" class="btn btn-xs btn-gradient-info btn-rounded"><span class="mdi mdi-pencil"></span></a>
                                        <a href="<?php echo base_url(); ?>sales/goods_print_sales/<?php echo $l->sales_good_head_id; ?>" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
<div class="modal fade" id="exportGoodsFilter" tabindex="-1" role="dialog" aria-labelledby="exportGoodsFilter" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="saveServicenumber">
                <div class="modal-body">
                    <!-- <div class="form-group">
                        <label>Date To</label>
                        <input type="date" class="form-control" name="service_date" id="service_date">
                    </div> -->
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label>Date From</label>
                                <input type="date" class="form-control" name="service_date" id="service_date">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label>Date To</label>
                                <input type="date" class="form-control" name="service_date" id="service_date">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="sales_serv_head_id" name="sales_serv_head_id">
                    <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url();?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning"  onclick="exportSalesgood();">Export</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!--   <a href="<?php echo base_url(); ?>sales/goods_update_sales_head" class="btn btn-xs btn-gradient-info btn-rounded" ><span class="mdi mdi-pencil"></span></a> -->
<!--  <a href="" class="btn btn-xs btn-gradient-danger btn-rounded" data-toggle="modal" data-target="#deleteSales"><span class="mdi mdi-delete"></span></a> -->