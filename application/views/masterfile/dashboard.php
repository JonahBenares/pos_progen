
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <?php
                //$diff = dateDifference($expiration_date, $today);
               // if($diff<=7){ ?>
        <div class="row">
            <div class="col-md-6 stretch-card">
              <a href="<?php echo base_url(); ?>reports/near_expiry/" class="card bg-gradient-danger card-img-holder text-white" style="text-decoration: none;" >
                <div class="card-body">
                    <img src="<?php echo base_url(); ?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Near Expiry Products </h4>
                    <i class="mdi mdi-timer float-right" style="position: absolute;font-size: 100px;top: 0;right: 0;margin: 25px;"></i>
                      <h2 class="mb-5"><?php echo $expired ?></h2>
                    <h6 class="card-text">Click to View</h6>
                </div>
              </a>
            </div>
            <?php //}?>
            <!-- <div class="col-md-4 stretch-card">
                <div class="card bg-gradient-primary card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url(); ?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Weekly Orders <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">45,6334</h2>
                        <h6 class="card-text">Decreased by 10%</h6>
                    </div>
                </div>
            </div> -->
            <div class="col-md-6 stretch-card">
                <a href="<?php echo base_url(); ?>sales_backorder/backorder_form/" class="card bg-gradient-success card-img-holder text-white" style="text-decoration: none;" >
                    <div class="card-body">
                        <img src="<?php echo base_url(); ?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Sales Back Order </h4>
                        <i class="mdi mdi-replay float-right" style="position: absolute;font-size: 100px;top: 0;right: 0;margin: 25px;"></i>
                        <h2 class="mb-5"><?php echo $sales_backorder ?></h2>
                        <h6 class="card-text">Click to View</h6>
                    </div>
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="justify-content">
                    <a href="<?php echo base_url(); ?>masterfile/upload_priceRef" class="mr-3 btn btn-inverse-success btn-rounded"><span class="mdi mdi-upload mr-2"></span>Upload Price Reference</a>
                    <a href="<?php echo base_url(); ?>receive/add_receive" class="mr-3 btn btn-inverse-primary btn-rounded"><span class="mdi mdi-plus mr-2"></span>Add Receive</a>
                    <a href="<?php echo base_url(); ?>sales/add_sales" class="mr-3 btn btn-inverse-primary btn-rounded"><span class="mdi mdi-plus mr-2"></span>Add Sales</a>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                          <h4 class="card-title float-left">Visit And Sales Statistics</h4>
                          <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                        </div>
                        <canvas id="visit-sale-chart" class="mt-4"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
        