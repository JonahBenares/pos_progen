<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-import"></i>
                </span> Receive
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Receive List &nbsp;
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
                                <h4 class="m-0">Receive List</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>receive/add_receive_head" type="button" class="btn btn-gradient-primary btn-sm btn-rounded">
                                        <b><span class="mdi mdi-plus"></span> Add</b>
                                    </a>
                                    <button type="button" class="btn btn-gradient-success btn-sm btn-rounded" data-toggle="modal" data-target="#filterReceive">
                                        <b><span class="mdi mdi-filter"></span> Filter</b>
                                    </button>                            
                                    <button type="button" class="btn btn-gradient-warning btn-sm btn-rounded" data-toggle="modal" data-target="#updateBuyer">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">                        
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th width="90%"> Receive </th>
                                    <th width="10%"><center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <td></td>
                                <td align="center">
                                    <a href="<?php echo base_url(); ?>receive/update_receive_head" class="btn btn-xs btn-gradient-info btn-rounded" ><span class="mdi mdi-pencil"></span></a>
                                    <a href="" class="btn btn-xs btn-gradient-danger btn-rounded" data-toggle="modal" data-target="#deleteReceive"><span class="mdi mdi-delete"></span></a>
                                    <a href="<?php echo base_url(); ?>receive/print_receive" class="btn btn-xs btn-gradient-warning btn-rounded"><span class="mdi mdi-eye"></span></a>                                    
                                </td>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Add Receive// -->
        <div class="modal fade" id="addReceive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Receive</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Receive</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Receive">
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

        <!-- //Filter Receive// -->
        <div class="modal fade" id="filterReceive" tabindex="-1" role="dialog" aria-labelledby="filterReceive" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header success-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Receive</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Receive</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Receive">
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

        <!-- //Update Receive// -->
        <div class="modal fade" id="updateReceive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header info-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Receive</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Receive</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Receive">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Update Receive</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Delete Receive// -->
        <div class="modal fade" id="deleteReceive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content " >
                    <div class="modal-header danger-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Receive</h5>
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
        




