<div class="main-panel">
    <div class="content-wrapper">    
        <!-- <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-import"></i>
                </span> Department
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>masterfile/department_list">Department List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Department</li>
                </ol>
            </nav>
        </div> -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-info card-img-holder text-white">
                        <h4 class="m-0">Transaction Adjustment List</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <table width="100%" class="table-bordered">
                                    <?php foreach($adjust AS $a){ ?>
                                        <tr>
                                            <td><a onclick = "window.open('<?php echo base_url(); ?>reports/adjustment_print/<?php echo $a['billing_id'];?>',);" class="btn btn-link btn-block text-left"><?php echo $a['billing_no'].(($a['adjustment_counter'] == 0) ? '' : '.a'.$a['adjustment_counter']);?></a></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
        



