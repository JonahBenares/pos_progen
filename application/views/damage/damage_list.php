<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/damage.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-danger text-white mr-2">
                  <i class="mdi mdi-image-broken-variant"></i>
                </span>Damage List
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>damage/damage_list">Damage list</a></li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Add New Item</li> -->
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="m-0">Damage List</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>damage/damage_item" type="button" class="btn btn-gradient-danger btn-sm btn-rounded">
                                        <b><span class="mdi mdi-plus"></span> Add Damage Item</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th width="15%"> PDR No </th>
                                    <th width="12%"> Date</th>
                                    <th width=""> Item Description </th>
                                    <th width="15%">Date/Time Reported</th>
                                    <th width="1%"><center><span class="mdi mdi-menu"></span></center></th>
                                </tr>
                            </thead>    
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><a  href="<?php echo base_url(); ?>damage/damage_print/1" class="btn btn-xs btn-gradient-warning btn-rounded" data-toggle="tooltip" data-placement="top" title="View"><span class="mdi mdi-eye"></span></a></td>
                                </tr> 
                            </tbody>                        
                        </table>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</form>
</div>
        





