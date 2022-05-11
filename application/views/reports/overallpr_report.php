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
                        <span></span>Overall PR Report &nbsp;
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
                                <h4 class="m-0">Overall PR Report</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>report/print_monthly_report" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </a>
                                    <?php if($pr!=''){ ?>                            
                                    <a href="<?php echo base_url(); ?>reports/export_overallpr/<?php echo $pr;?>" class="btn btn-gradient-warning btn-sm btn-rounded">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </a>
                                    <?php } else { ?>
                                    <a href="<?php echo base_url(); ?>reports/export_overallpr/" class="btn btn-gradient-warning btn-sm btn-rounded">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">  
                        <div class="row">
                            <div class="col-lg-4 offset-lg-3">
                                <select class="form-control select2" name="pr" id='pr'>
                                    <option value = "">-Choose PR-</option>
                                        <?php foreach($pr_list AS $pl){ ?>
                                             <option value="<?php echo $pl->pr_no; ?>"><?php echo $pl->pr_no; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                <input type="submit" name="search_pr" id = "search_pr" value='Filter' class="btn btn-md btn-gradient-success btn-block" onclick="loadPR()">
                            </div>
                        </div>   
                        <hr> 
                        <?php if(!empty($pr_no)){ ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <small>PR No. :</small>
                                <h3><b><?php echo $pr; ?></h3></b>
                                <table width="100%">
                                   <!--  <tr>
                                        <td width="10%">Enduse:</td>
                                        <td width="40%"> DG1</td>
                                        <td width="10%" align="right"></td>
                                        <td width="40%">&nbsp;</td>
                                    </tr> -->
                                    <tr>
                                        <td>Purpose: <?php echo $purpose; ?></td>
                                        <td align="left"></td>
                                        <td align="center"></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>     
                        <br>      
                        <table class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <td class="td-head" width="1%">#</td>
                                    <td class="td-head" width="40%">Item Description</td>
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
                                <?php $x=1; foreach($pr_no AS $pn){ ?>
                                <tr>
                                    <td><?php echo $x; ?></td>
                                    <td><?php echo $pn['item']; ?></td>
                                    <td><?php echo number_format($pn['recqty'],2);?></td>
                                    <td><?php echo number_format($pn['sales_quantity'],2);?></td>
                                    <td><?php echo number_format($pn['in_balance'],2);?></td>
                                    <td><?php echo  number_format($pn['returnqty'],2);?></td>
                                    <td><?php echo  number_format($pn['damageqty'],2);?></td>
                                    <td><?php echo  number_format($pn['repairqty'],2);?></td>
                                    <td><?php echo  number_format($pn['expired_qty'],2);?></td>
                                    <td><?php echo number_format($pn['final_balance'],2);?></td>
                                </tr>
                                <?php $x++; }  ?>
                            </tbody>                            
                        </table>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
        




