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
                                        <span class="mdi mdi-plus"></span> Add
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
                                    <th style="padding:10px;text-align: center">Noted By</th>
                                    <th style="padding:10px;text-align: center">Inspected By</th>
                                    <th style="padding:10px;text-align: center">Delivered By</th>
                                    <th style="padding:10px;text-align: center">Reviewed By</th>
                                    <th style="padding:10px;text-align: center">Received By</th>
                                    <th style="padding:10px;text-align: center">Released By</th>
                                    <th style="padding:10px;text-align: center">Requested By</th>
                                    <th style="padding:10px;text-align: center">Approved By</th>        
                                    <th style="padding:10px;text-align: center">Acknowledge By</th>                                     
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Employee</td>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                    <td align="center"><p style="color:green;font-size: 22px;" class="m-0"><span class="mdi mdi-check-circle"></span></p></td>
                                </tr>
                                <!-- <tr>
                                    <td><?php echo $sig['employee']; ?></td>
                                    <?php if($sig['noted'] == '1'){ ?>
                                    <td align="center"><p style="font-size: 19px;color:green;"><span class="fa fa-check"></span></p></td>
                                    <?php } else { ?>
                                    <td align="center"><p style="font-size: 19px;color:red;"><span class=""></span></p></td>
                                    <?php } ?>
                                    <?php if($sig['inspected'] == '1'){ ?>
                                    <td align="center"><p style="font-size: 19px;color:green;"><span class="fa fa-check"></span></p></td>
                                    <?php }else{ ?>
                                    <td align="center"><p style="font-size: 19px;color:red;"><span class=""></span></p></td>
                                    <?php } ?>
                                    <?php if($sig['delivered'] == '1'){ ?>
                                    <td align="center"><p style="font-size: 19px;color:green;"><span class="fa fa-check"></span></p></td>
                                    <?php }else{ ?>
                                    <td align="center"><p style="font-size: 19px;color:red;"><span class=""></span></p></td>
                                    <?php } ?>
                                    <?php if($sig['reviewed'] == '1'){ ?>
                                    <td align="center"><p style="font-size: 19px;color:green;"><span class="fa fa-check"></span></p></td>
                                    <?php }else{ ?>
                                    <td align="center"><p style="font-size: 19px;color:red;"><span class=""></span></p></td>    
                                    <?php } ?>
                                    <?php if($sig['received'] == '1'){ ?>
                                    <td align="center"><p style="font-size: 19px;color:green;"><span class="fa fa-check"></span></p></td>
                                    <?php }else{ ?>
                                    <td align="center"><p style="font-size: 19px;color:red;"><span class=""></span></p></td>    
                                    <?php } ?>
                                    <?php if($sig['released'] == '1'){ ?>
                                    <td align="center"><p style="font-size: 19px;color:green;"><span class="fa fa-check"></span></p></td>
                                    <?php } else{ ?>
                                    <td align="center"><p style="font-size: 19px;color:red;"><span class=""></span></p></td>    
                                    <?php } ?>
                                    <?php if($sig['requested'] == '1'){ ?>
                                    <td align="center"><p style="font-size: 19px;color:green;"><span class="fa fa-check"></span></p></td>
                                    <?php } else{ ?>
                                    <td align="center"><p style="font-size: 19px;color:red;"><span class=""></span></p></td>    
                                    <?php } ?>
                                    <?php if($sig['approved'] == '1'){ ?>
                                    <td align="center"><p style="font-size: 19px;color:green;"><span class="fa fa-check"></span></p></td>
                                    <?php } else { ?>
                                    <td align="center"><p style="font-size: 19px;color:red;"><span class=""></span></p></td>    
                                    <?php } ?>
                                    <?php if($sig['acknowledged'] == '1'){ ?>
                                    <td align="center"><p style="font-size: 19px;color:green;"><span class="fa fa-check"></span></p></td>
                                    <?php } else { ?>
                                    <td align="center"><p style="font-size: 19px;color:red;"><span class=""></span></p></td>    
                                    <?php } ?>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
        




