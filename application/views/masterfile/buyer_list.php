<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Buyer List
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Buyers &nbsp;
                        <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                    <!--  <li class="breadcrumb-item"><a href="#">Editors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buyer List</li> -->
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="main-button-center">
                            <button type="button" class="btn btn-gradient-success btn-sm" data-toggle="modal" data-target="#filterBuyer">
                                <b><span class="mdi mdi-filter"></span> Filter</b>
                            </button>
                            <button type="button" class="btn btn-gradient-primary btn-md" data-toggle="modal" data-target="#addBuyer">
                                <b><span class="mdi mdi-plus"></span> Add </b>
                            </button>
                            <button type="button" class="btn btn-gradient-warning btn-sm" data-toggle="modal" data-target="#updateBuyer">
                                <b><span class="mdi mdi-export"></span> Export</b>
                            </button>
                        </div>                                
                        <table class="table table-bordered table-hover" id="example">
                            <thead>
                                <tr>
                                    <th width="40%"> Buyer </th>
                                    <th width="20%"> Address</th>
                                    <th width="15%"> Contact Person </th>
                                    <th width="15%"> Contact No. </th>
                                    <th width="10%" align="center"> <span class="mdi mdi-menu"></span> </th>
                                </tr>
                            </thead>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- //Add Buyer// -->
        <div class="modal fade" id="addBuyer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Buyer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Buyer</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Buyer">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="Text" class="form-control" id="exampleInputEmail1" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact Person</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Contact Person">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Contact Number</label>
                                <input type="text" class="form-control" id="exampleInputConfirmPassword1" placeholder="Contact Number">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Filter Buyer// -->
        <div class="modal fade" id="filterBuyer" tabindex="-1" role="dialog" aria-labelledby="filterBuyer" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header success-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Buyer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Buyer</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Buyer">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="Text" class="form-control" id="exampleInputEmail1" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact Person</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Contact Person">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Contact Number</label>
                                <input type="text" class="form-control" id="exampleInputConfirmPassword1" placeholder="Contact Number">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Update Buyer// -->
        <div class="modal fade" id="updateBuyer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header info-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Buyer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Buyer</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Buyer">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="Text" class="form-control" id="exampleInputEmail1" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact Person</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Contact Person">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Contact Number</label>
                                <input type="text" class="form-control" id="exampleInputConfirmPassword1" placeholder="Contact Number">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Update Buyer</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Delete Employee Name// -->
        <div class="modal fade" id="deleteEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content " >
                    <div class="modal-header danger-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <br>
                        <br>
                        <center>Do you want to delete _________?</center>
                        <br>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
        




