<script src="<?php echo base_url(); ?>assets/js/masterfile.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Buyer List
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <button type="button" class="btn btn-gradient-primary btn-sm" data-toggle="modal" data-target="#addBuyer">
                            <b><span class="mdi mdi-plus"></span> Add</b>
                        </button>
                    </li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">
                        <button type="button" class="btn btn-gradient-success btn-sm" data-toggle="modal" data-target="#filterBuyer">
                            <b><span class="mdi mdi-filter"></span> Filter</b>
                        </button>
                    </li>
                    <?php if(!empty($filt)){ ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a type="button" class="btn btn-gradient-warning btn-sm" href="<?php echo base_url(); ?>index.php/Masterfile/export_buyer_list/<?php echo $buyer_name;?>/<?php echo $address;?>/<?php echo $contact_person;?>/<?php echo $contact_no;?>" >
                            <b><span class="mdi mdi-export"></span> Export</b>
                        </a>
                    </li>
                    <?php } else { ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a type="button" class="btn btn-gradient-warning btn-sm" href="<?php echo base_url(); ?>index.php/masterfile/export_buyer_list">
                            <b><span class="mdi mdi-export"></span> Export</b>
                        </a>
                    </li> 
                    <?php } ?> -->
                </ul>
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
        <!-- <?php if(!empty($filt)){ ?>     
        <span class='btn btn-success disabled'>Filter Applied</span><?php echo $filt ?>, <a href='<?php echo base_url(); ?>index.php/masterfile/buyer_list/' class='remove_filter alert-link pull-right btn'><span class="fa fa-times"></span></a>
        <?php } ?>  -->
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="myTable">
                        <div class="main-button-center">
                            <button type="button" class="btn btn-gradient-primary btn-md" data-toggle="modal" data-target="#addBuyer">
                                <b><span class="mdi mdi-plus"></span> Add </b>
                            </button>
                            <!-- <button type="button" class="btn btn-gradient-success btn-sm" data-toggle="modal" data-target="#filterBuyer">
                                <b><span class="mdi mdi-filter"></span> Filter</b>
                            </button>
                            <button type="button" class="btn btn-gradient-warning btn-sm" data-toggle="modal" data-target="#updateBuyer">
                                <b><span class="mdi mdi-export"></span> Export</b>
                            </button> -->
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
                            <tbody>
                                    <?php 
                                        if(!empty($buyer)){
                                        foreach($buyer AS $buy){ ?>
                                    <tr>
                                        <td><?php echo $buy->buyer_name;?></td>
                                        <td><?php echo $buy->address;?></td>
                                        <td><?php echo $buy->contact_person;?></td>
                                        <td><?php echo $buy->contact_no;?></td>
                                        <td width="1%">
                                         <center>
                                             <a onclick="updateBuyer('<?php echo base_url(); ?>','<?php echo $buy->buyer_id; ?>')" class="btn btn-custon-three btn-info btn-xs"><span class="fa fa-pencil"></span></a>
                                             <a href = "<?php echo base_url(); ?>index.php/masterfile/delete_buyer/<?php echo $buy->buyer_id;?>" onclick="confirmationDelete(this);return false;" class = "btn btn-danger btn-sm" title="DELETE"><span class="fa fa-trash"></span></a>
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
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/add_buyer">
                            <div class="form-group">
                                <label >Buyer</label>
                                <input type="text" class="form-control" name="buyer_name" placeholder="Buyer">
                            </div>
                            <div class="form-group">
                                <label >Address</label>
                                <input type="Text" class="form-control" name="address" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label >Contact Person</label>
                                <input type="text" class="form-control" name="contact_person" placeholder="Contact Person">
                            </div>
                            <div class="form-group">
                                <label >Contact Number</label>
                                <input type="text" class="form-control" name="contact_no" placeholder="Contact Number">
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
                        <form method="POST" action = "<?php echo base_url();?>index.php/masterfile/search_buyer">
                            <div class="form-group">
                                <label >Buyer</label>
                                <input type="text" class="form-control" name="buyer_name" placeholder="Buyer">
                            </div>
                            <div class="form-group">
                                <label >Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label >Contact Person</label>
                                <input type="text" class="form-control" name="contact_person" placeholder="Contact Person">
                            </div>
                            <div class="form-group">
                                <label >Contact Number</label>
                                <input type="text" class="form-control" name="contact_no" placeholder="Contact Number">
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




