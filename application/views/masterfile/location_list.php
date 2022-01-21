<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Location List
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Location &nbsp;
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
                            <button type="button" class="btn btn-gradient-success btn-sm" data-toggle="modal" data-target="#filterLocation">
                                <b><span class="mdi mdi-filter"></span> Filter</b>
                            </button>
                            <button type="button" class="btn btn-gradient-primary btn-md" data-toggle="modal" data-target="#addLocation">
                            <b><span class="mdi mdi-plus"></span> Add</b>
                            </button>
                            <button type="button" class="btn btn-gradient-warning btn-sm">
                                <b><span class="mdi mdi-export"></span> Export</b>
                            </button>
                        </div>
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th width="90%"> Location </th>
                                    <th width="10%" align="center"> <span class="mdi mdi-menu"></span> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <td></td>
                                <td>
                                    <a href="" class="btn btn-sm btn-gradient-info" data-toggle="modal" data-target="#updateLocation"><span class="mdi mdi-pencil"></span></a>
                                    <a href="" class="btn btn-sm btn-gradient-danger" data-toggle="modal" data-target="#deleteLocation"><span class="mdi mdi-delete"></span></a>
                                </td>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Add Location// -->
        <div class="modal fade" id="addLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Location</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Location">
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

        <!-- //Filter Location// -->
        <div class="modal fade" id="filterLocation" tabindex="-1" role="dialog" aria-labelledby="filterLocation" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header success-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Location</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Location">
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

        <!-- //Update Location// -->
        <div class="modal fade" id="updateLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header info-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Location</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Location">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Update Location</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Delete Location// -->
        <div class="modal fade" id="deleteLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content " >
                    <div class="modal-header danger-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Location</h5>
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
        




