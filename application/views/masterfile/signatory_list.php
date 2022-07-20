<script src="<?php echo base_url(); ?>assets/js/masterfile.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Signatory
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Signatory List &nbsp;
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
                                <h4 class="m-0">Signatory List</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">          
                                    <a class=" btn btn-gradient-primary btn-rounded btn-sm"  href="<?php echo base_url(); ?>masterfile/signatory_add">
                                        <span class="mdi mdi-plus"></span> Update
                                    </a>              
                                </div>
                                
                            </div>
                        </div>   
                    </div>
                    <div class="card-body">       
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr style="font-size: 13px">
                                    <th style="padding:10px;" width="30%">Employee Name</th>
                                    <th style="padding:10px;text-align: center">Prepared and Released By</th>
                                    <th style="padding:10px;text-align: center">Received By</th>
                                    <th style="padding:10px;text-align: center">Verified By</th>
                                    <th style="padding:10px;text-align: center">Approved By</th>                                         
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($signatory AS $sig){ ?>
                                <tr>
                                    <td><?php echo $sig['employee']; ?></td>
                                    <?php if($sig['pre_rel'] == '1'){ ?>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <?php } else { ?>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class=""></span></p></td>
                                    <?php } ?>
                                    <?php if($sig['received'] == '1'){ ?>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <?php } else { ?>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class=""></span></p></td>
                                    <?php } ?>
                                    <?php if($sig['verified'] == '1'){ ?>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <?php } else { ?>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class=""></span></p></td>
                                    <?php } ?>
                                    <?php if($sig['approved'] == '1'){ ?>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <?php } else { ?>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class=""></span></p></td>
                                    <?php } ?>
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
        




