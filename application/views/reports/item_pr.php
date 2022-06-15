<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reports.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-file-document"></i>
                </span> Reports
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Item PR Report &nbsp;
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
                                <h4 class="m-0">Item PR Report</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <button type="button" onclick="printDiv('printableArea')" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </button>                                                     
                                    <a href="<?php echo base_url(); ?>reports/export_itempr/<?php echo $item_id;?>" class="btn btn-gradient-warning btn-sm btn-rounded">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST"> 
                            <div class="row">
                                <div class="col-lg-4 offset-lg-3">
                                    <select class="form-control select2" name="item" id='item'>
                                        <option value="">-Choose Item-</option>
                                        <?php foreach($item AS $i){ ?>
                                             <option value="<?php echo $i->item_id; ?>"><?php echo $i->item_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <input type="button" class="btn btn-md btn-gradient-success btn-block" name="filter_itpr" id="filter_itpr" value="Filter" onclick="filter_prreport()">
                                </div>
                            </div>    
                        </form>
                        <hr> 
                        <div id="printableArea"> 
                        <div class="row">
                            <div class="col-lg-12">
                                <small>Item Name:</small>
                                <h3><b><?php echo $item_name; ?></h3></b>
                                <!-- <table width="100%">
                                    <tr>
                                        <td width="10%">Enduse:</td>
                                        <td width="40%"> DG1</td>
                                        <td width="10%" align="right"></td>
                                        <td width="40%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Purpose:</td>
                                        <td> Reconditioning</td>
                                        <td align="right"> </td>
                                        <td></td>
                                    </tr>
                                </table> -->
                            </div>
                        </div>     
                        <br>      
                        <table class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <td class="td-head" width="1%">#</td>
                                    <td class="td-head" width="40%">PR No</td>
                                    <td class="td-head">Begbal Qty</td>
                                    <td class="td-head">Received Qty</td>
                                    <td class="td-head">Sales Qty</td>
                                    <td class="td-head">Initial Balance</td>
                                    <td class="td-head">Return Qty</td>
                                    <td class="td-head">Damaged Qty</td>
                                    <td class="td-head">Repaired Qty</td>
                                    <td class="td-head">Expired Qty</td>
                                    <td class="td-head">Final Balance</td>     
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($item_pr)){ $x=1; foreach($item_pr AS $ip){ ?>
                                <tr>
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $ip['prno'];?></td>
                                    <td><?php echo $ip['begbal'];?></td>
                                    <td><?php echo $ip['recqty'];?></td>
                                    <td><?php echo number_format($ip['sales_quantity'],2);?></td>
                                    <td><?php echo number_format($ip['in_balance'],2);?></td>
                                    <td><?php echo $ip['returnqty'];?></td>
                                    <td><?php echo $ip['damageqty'];?></td>
                                    <td><?php echo $ip['repairqty'];?></td>
                                    <td><?php echo $ip['expired_qty'];?></td>
                                    <td><?php echo number_format($ip['final_balance'],2);?></td>
                                </tr>
                                <?php $x++; } } ?>
                            </tbody>                            
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        




