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
                                    <!-- <button type="button" class="btn btn-gradient-success btn-sm btn-rounded" data-toggle="modal" data-target="#filterSales">
                                        <b><span class="mdi mdi-filter"></span> Filter</b>
                                    </button>   -->                          
                                    <button type="button" class="btn btn-gradient-warning btn-sm btn-rounded" data-toggle="modal" data-target="#updateSales">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">                        
                        <table class="table table-bordered table-hover" id="saleslist" width="100%">
                            <thead>
                                <tr>
                                    <td width="10%">DR Date</td>
                                    <td width="10%">DR No.</td>
                                    <td width="10%">Client</td>
                                    <td width="10%">Address</td>
                                    <td width="10%">PGC PR No.</td>   
                                    <td width="10%">PGC PO No.</td> 
                                    <th width="8%"><center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($sales AS $s){ ?>
                                <tr>
                                    <td><?php echo $s['sales_date'];?></td>
                                    <td><?php echo $s['dr_no'];?></td>
                                    <td><?php echo $s['client'];?></td>
                                    <td><?php echo $s['address'];?></td>   
                                    <td><?php echo $s['pr_no'];?></td>
                                    <td><?php echo $s['po_no'];?></td>
                                    <td align="center">
                                        <a href="<?php echo base_url(); ?>sales/goods_update_sales_head/<?php echo $s['sales_good_head_id'];?>" class="btn btn-xs btn-gradient-info btn-rounded" ><span class="mdi mdi-pencil"></span></a>
                                        <a href="" class="btn btn-xs btn-gradient-danger btn-rounded" data-toggle="modal" data-target="#deleteSales"><span class="mdi mdi-delete"></span></a>
                                        <a href="<?php echo base_url(); ?>sales/goods_print_sales" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>
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
        




