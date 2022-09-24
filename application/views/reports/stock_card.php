<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reports.js"></script>
<?php 
    if(!empty($stockcard)){
        foreach ($stockcard as $key => $row) {
            $date[$key]  = $row['date'];
            $series[$key] = $row['series'];
            $cdate[$key] = $row['create_date'];
        }
        array_multisort($date, SORT_ASC,  $cdate, SORT_ASC, $stockcard);
    }
    if(!empty($stockcard)){
        foreach ($balance as $key => $row) {
            $date[$key]  = $row['date'];
            $series[$key] = $row['series'];
            $cdate[$key] = $row['create_date'];
        }

        array_multisort($date, SORT_ASC, $cdate, SORT_ASC, $balance);
        $total_bal=0;
        foreach($balance AS $sc){
            if($sc['method'] == 'Receive' || $sc['method'] == 'Repaired' || $sc['method'] == 'Return' || $sc['method'] == 'Begbal'){ 
                $total_bal += $sc['quantity'];
            }else if($sc['method'] == 'Sales Good' || $sc['method'] == 'Sales Services' || $sc['method'] == 'Damaged') {
                $total_bal -= $sc['quantity'];
            } 
        }
    }else {
        $total_bal=0;
    }
?>
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
                        <span></span>Stock Card &nbsp;
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
                                <h4 class="m-0">Stock Card</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <button type="button" onclick="printDiv('printableArea')" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </button>                               
                                    <a href="<?php echo base_url(); ?>reports/export_stockcard/<?php echo $item_id; ?>" class="btn btn-gradient-warning btn-sm btn-rounded">
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
                                    <!-- <input type="" class="form-control" name="" placeholder="Customer"> -->
                                    <select class="form-control select2" id="item_id" name="item_id">
                                        <option value="">--Select an Item--</option>
                                        <?php foreach($items AS $it){ ?>
                                            <option value="<?php echo $it->item_id; ?>"><?php echo $it->original_pn." - ".$it->item_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                    <input type="button" class="btn btn-md btn-gradient-success btn-block" name="submit" id="filter" value="Filter" onclick="filter_stockcard()">
                                </div>
                            </div>
                        </form>
                        <hr>   
                        <br>
                        <div id="printableArea">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="mb-0 font-weight-medium">
                                    <?php echo $item_name; ?> 
                                </h3>
                            </div>
                            <div class="col-lg-6">
                                <div style="display: flex;" class="pull-right">
                                    <button type="button" class="btn btn-inverse-info btn-fw">
                                        <small>Running Balance</small>
                                        <h3 class="m-0"><?php echo $total_bal; ?></h3>
                                    </button>
                                </div>
                            </div>
                        </div>     
                        <br>
                        <?php 
                            if(!empty($stockcard)){
                                $run_bal=0;
                                foreach($balance AS $s){
                                    if($s['method'] == 'Receive' || $s['method'] == 'Repaired' || $s['method'] == 'Return' || $s['method'] == 'Begbal'){ 
                                        $run_bal += $s['quantity'];
                                    }else if($s['method'] == 'Sales Good' || $s['method'] == 'Sales Services' || $s['method'] == 'Damaged') {
                                        $run_bal -= $s['quantity'];
                                    } 
                                    $bal[] = $run_bal;
                                }
                            }
                        ?>
                        <table class="table table-bordered table-hover" width="100%" id="myTdable">
                            <thead>
                                <tr>
                                    <td width="10%" class="td-head">Date</td>
                                    <td width="20%" class="td-head">Supplier / Client</td>
                                    <td width="15%" class="td-head">PR #</td>
                                    <td width="15%" class="td-head">PO #</td>
                                    <td width="15%" class="td-head">Catalog No. </td>
                                    <td width="15%" class="td-head">Brand </td>
                                    <td width="10%" class="td-head">Method</td>
                                    <td width="10%" class="td-head">Total Unit Cost</td>
                                    <td width="5%" class="td-head">Qty</td>
                                    <td width="10%" class="td-head">Running Balance</td>
                                </tr>
                            </thead>
                            <tbody id="stockcard-list">
                                <?php 
                                    if(!empty($stockcard)){
                                        $count = count($stockcard)-1;
                                        $run_bal=0;
                                        for($x=$count; $x>=0;$x--){ 
                                            if($stockcard[$x]['method']=='Receive'){
                                                $badge = 'badge-primary';
                                            }else if($stockcard[$x]['method']=='Sales Good'){
                                                $badge = 'badge-warning';
                                            }else if($stockcard[$x]['method']=='Sales Services'){
                                                $badge = 'badge-warning';
                                            }else if($stockcard[$x]['method']=='Return'){
                                                $badge = 'badge-info';
                                            }else if($stockcard[$x]['method']=='Repaired'){
                                                $badge = 'badge-success';
                                            }else if($stockcard[$x]['method']=='Damaged'){
                                                $badge = 'badge-danger';
                                            }else if($stockcard[$x]['method']=='Expired'){
                                                $badge = 'badge-danger';
                                            }else if($stockcard[$x]['method']=='Begbal'){
                                                $badge = 'badge-danger';
                                            }
                                ?>
                                <tr>
                                    <td><?php echo date("Y-m-d", strtotime($stockcard[$x]['date']));?></td>
                                    <td><?php echo $stockcard[$x]['supplier']; ?></td>
                                    <td><?php echo $stockcard[$x]['pr_no']; ?></td>
                                    <td><?php echo $stockcard[$x]['po_no']; ?></td>
                                    <td><?php echo $stockcard[$x]['catalog_no']; ?></td>
                                    <td><?php echo $stockcard[$x]['brand']; ?></td>
                                    <td>
                                        <div class="badge <?php echo $badge; ?> badge-pill"><?php echo $stockcard[$x]['method']; ?></div>
                                    </td>
                                    <td><?php echo number_format($stockcard[$x]['item_cost'],2); ?></td>
                                    <td>
                                        <?php echo (($stockcard[$x]['method']== 'Sales Good' || $stockcard[$x]['method'] == 'Sales Services' || $stockcard[$x]['method'] == 'Damaged' || $stockcard[$x]['method'] == 'Expired') ? "-" : "") .number_format($stockcard[$x]['quantity'],2); ?>    
                                    </td>
                                    <td><?php echo $bal[$x]; ?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>                            
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        

