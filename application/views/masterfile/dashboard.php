
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
                <a href="<?php echo base_url(); ?>reports/sales_backorder/<?php echo date('Y-m-d') ?>" class="card bg-gradient-success card-img-holder text-white" style="text-decoration: none;" >
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
          <div class="col-md-7 grid-margin stretch-card">
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
          <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Traffic Sources</h4>
                <canvas id="traffic-chart"></canvas>
                <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Recent Tickets</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> Assignee </th>
                        <th> Subject </th>
                        <th> Status </th>
                        <th> Last Update </th>
                        <th> Tracking ID </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <img src="<?php echo base_url(); ?>assets/images/faces/face1.jpg" class="mr-2" alt="image"> David Grey
                        </td>
                        <td> Fund is not recieved </td>
                        <td>
                          <label class="badge badge-gradient-success">DONE</label>
                        </td>
                        <td> Dec 5, 2017 </td>
                        <td> WD-12345 </td>
                      </tr>
                      <tr>
                        <td>
                          <img src="<?php echo base_url(); ?>assets/images/faces/face2.jpg" class="mr-2" alt="image"> Stella Johnson
                        </td>
                        <td> High loading time </td>
                        <td>
                          <label class="badge badge-gradient-warning">PROGRESS</label>
                        </td>
                        <td> Dec 12, 2017 </td>
                        <td> WD-12346 </td>
                      </tr>
                      <tr>
                        <td>
                          <img src="<?php echo base_url(); ?>assets/images/faces/face3.jpg" class="mr-2" alt="image"> Marina Michel
                        </td>
                        <td> Website down for one week </td>
                        <td>
                          <label class="badge badge-gradient-info">ON HOLD</label>
                        </td>
                        <td> Dec 16, 2017 </td>
                        <td> WD-12347 </td>
                      </tr>
                      <tr>
                        <td>
                          <img src="<?php echo base_url(); ?>assets/images/faces/face4.jpg" class="mr-2" alt="image"> John Doe
                        </td>
                        <td> Loosing control on server </td>
                        <td>
                          <label class="badge badge-gradient-danger">REJECTED</label>
                        </td>
                        <td> Dec 3, 2017 </td>
                        <td> WD-12348 </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Recent Updates</h4>
                <div class="d-flex">
                  <div class="d-flex align-items-center mr-4 text-muted font-weight-light">
                    <i class="mdi mdi-account-outline icon-sm mr-2"></i>
                    <span>jack Menqu</span>
                  </div>
                  <div class="d-flex align-items-center text-muted font-weight-light">
                    <i class="mdi mdi-clock icon-sm mr-2"></i>
                    <span>October 3rd, 2018</span>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-6 pr-1">
                    <img src="<?php echo base_url(); ?>assets/images/dashboard/img_1.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                    <img src="<?php echo base_url(); ?>assets/images/dashboard/img_4.jpg" class="mw-100 w-100 rounded" alt="image">
                  </div>
                  <div class="col-6 pl-1">
                    <img src="<?php echo base_url(); ?>assets/images/dashboard/img_2.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                    <img src="<?php echo base_url(); ?>assets/images/dashboard/img_3.jpg" class="mw-100 w-100 rounded" alt="image">
                  </div>
                </div>
                <div class="d-flex mt-5 align-items-top">
                  <img src="<?php echo base_url(); ?>assets/images/faces/face3.jpg" class="img-sm rounded-circle mr-3" alt="image">
                  <div class="mb-0 flex-grow">
                    <h5 class="mr-2 mb-2">School Website - Authentication Module.</h5>
                    <p class="mb-0 font-weight-light">It is a long established fact that a reader will be distracted by the readable content of a page.</p>
                  </div>
                  <div class="ml-auto">
                    <i class="mdi mdi-heart-outline text-muted"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Project Status</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> # </th>
                        <th> Name </th>
                        <th> Due Date </th>
                        <th> Progress </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> 1 </td>
                        <td> Herman Beck </td>
                        <td> May 15, 2015 </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td> 2 </td>
                        <td> Messsy Adam </td>
                        <td> Jul 01, 2015 </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td> 3 </td>
                        <td> John Richards </td>
                        <td> Apr 12, 2015 </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td> 4 </td>
                        <td> Peter Meggik </td>
                        <td> May 15, 2015 </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td> 5 </td>
                        <td> Edward </td>
                        <td> May 03, 2015 </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td> 5 </td>
                        <td> Ronald </td>
                        <td> Jun 05, 2015 </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-white">Todo</h4>
                <div class="add-items d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                  <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" id="add-task">Add</button>
                </div>
                <div class="list-wrapper">
                  <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                    <li>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox"> Meeting with Alisa </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li class="completed">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox" checked> Call John </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox"> Create invoice </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox"> Print Statements </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li class="completed">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                      </div>
                      <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="container-fluid clearfix">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates </a> from Bootstrapdash.com</span>
    </div>
  </footer>
  <!-- partial -->
</div>
        