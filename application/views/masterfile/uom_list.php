<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> UOM List
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <button type="button" class="btn btn-gradient-primary btn-sm" data-toggle="modal" data-target="#addUOM">
                            <b><span class="mdi mdi-plus"></span> Add</b>
                        </button>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <button type="button" class="btn btn-gradient-success btn-sm" data-toggle="modal" data-target="#filterUOM">
                            <b><span class="mdi mdi-filter"></span> Filter</b>
                        </button>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <button type="button" class="btn btn-gradient-warning btn-sm">
                            <b><span class="mdi mdi-export"></span> Export</b>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th width="90%"> UOM </th>
                                    <th width="10%" align="center"> <span class="mdi mdi-menu"></span> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <td></td>
                                <td>
                                    <a href="" class="btn btn-sm btn-gradient-info" data-toggle="modal" data-target="#updateUOM"><span class="mdi mdi-pencil"></span></a>
                                    <a href="" class="btn btn-sm btn-gradient-danger" data-toggle="modal" data-target="#deleteUOM"><span class="mdi mdi-delete"></span></a>
                                </td>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Add UOM// -->
        <div class="modal fade" id="addUOM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add UOM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">UOM</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="UOM">
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

        <!-- //Filter UOM// -->
        <div class="modal fade" id="filterUOM" tabindex="-1" role="dialog" aria-labelledby="filterUOM" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header success-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Filter UOM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">UOM</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="UOM">
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

        <!-- //Update UOM// -->
        <div class="modal fade" id="updateUOM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header info-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update UOM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">UOM</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="UOM">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Update UOM</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Delete UOM// -->
        <div class="modal fade" id="deleteUOM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content " >
                    <div class="modal-header danger-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Delete UOM</h5>
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
        



