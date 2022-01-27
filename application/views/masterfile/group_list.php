<script src="<?php echo base_url(); ?>assets/js/masterfile.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Group List
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <button type="button" class="btn btn-gradient-primary btn-sm" data-toggle="modal" data-target="#addGroup">
                            <b><span class="mdi mdi-plus"></span> Add</b>
                        </button>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <button type="button" class="btn btn-gradient-success btn-sm" data-toggle="modal" data-target="#filterGroup">
                            <b><span class="mdi mdi-filter"></span> Filter</b>
                        </button>
                    </li>
                    <?php if(!empty($filt)){ ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a type="button" class="btn btn-gradient-warning btn-sm" href="<?php echo base_url(); ?>index.php/Masterfile/export_group_list/<?php echo $group_name;?>" >
                            <b><span class="mdi mdi-export"></span> Export</b>
                        </a>
                    </li>
                    <?php } else { ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a type="button" class="btn btn-gradient-warning btn-sm" href="<?php echo base_url(); ?>index.php/masterfile/export_group_list">
                            <b><span class="mdi mdi-export"></span> Export</b>
                        </a>
                    </li> 
                    <?php } ?>
                </ul>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Group &nbsp;
                        <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                    <!--  <li class="breadcrumb-item"><a href="#">Editors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buyer List</li> -->
                </ol>
            </nav>
        </div>
        <?php if(!empty($filt)){ ?>     
        <span class='btn btn-success disabled'>Filter Applied</span><?php echo $filt ?>, <a href='<?php echo base_url(); ?>index.php/masterfile/group_list/' class='remove_filter alert-link pull-right btn'><span class="fa fa-times"></span></a>
        <?php } ?> 
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="main-button-center">
                            <button type="button" class="btn btn-gradient-success btn-sm" data-toggle="modal" data-target="#filterGroup">
                                <b><span class="mdi mdi-filter"></span> Filter</b>
                            </button>
                            <button type="button" class="btn btn-gradient-primary btn-md" data-toggle="modal" data-target="#addGroup">
                            <b><span class="mdi mdi-plus"></span> Add</b>
                            </button>
                            <button type="button" class="btn btn-gradient-warning btn-sm">
                                <b><span class="mdi mdi-export"></span> Export</b>
                            </button>
                        </div>
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th width="90%"> Group </th>
                                    <th width="10%" align="center"> <span class="mdi mdi-menu"></span> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!empty($group)){
                                foreach($group AS $gr){ ?>
                                    <tr>
                                        <td><?php echo $gr->group_name;?></td>
                                        <td width="1%">
                                         <center>
                                             <a onclick="updateGroup('<?php echo base_url(); ?>','<?php echo $gr->group_id; ?>')" class="btn btn-custon-three btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                                             <a href = "<?php echo base_url(); ?>index.php/masterfile/delete_group/<?php echo $gr->group_id;?>" onclick="confirmationDelete(this);return false;" class = "btn btn-danger btn-sm" title="DELETE"><span class="fa fa-trash"></span></a>
                                         </center>
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                <tr>
                                    <td align="center" colspan='9'><center>No Data Available.</center></td>
                                </tr>
                                <?php } ?>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- //Add Group// -->
        <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header primary-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Add Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/add_group">
                            <div class="form-group">
                                <label>Group</label>
                                <input type="text" class="form-control" name="group_name" placeholder="Group">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- //Filter Group// -->
        <div class="modal fade" id="filterGroup" tabindex="-1" role="dialog" aria-labelledby="filterGroup" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header success-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Filter Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/search_group">
                            <div class="form-group">
                                <label>Group</label>
                                <input type="text" class="form-control" name="group_name" placeholder="Group">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Filter</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- //Update Group// 
        <div class="modal fade" id="updateGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header info-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Update Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Group</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Group">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Update Group</button>
                    </div>
                </div>
            </div>
        </div>-->

        <!-- //Delete Group// -->
        <div class="modal fade" id="deleteGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content " >
                    <div class="modal-header danger-modalhead">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Group</h5>
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
        




