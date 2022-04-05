<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-file-document"></i>
                </span> Reports
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>masterfile/purpose_list">Billing Statement</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pay</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-success card-img-holder text-white pt-2" >
                    </div>
                    <div class="card-body">
                        <form method="POST" action = "">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table table-bordered table-hover" >
                                        <tr>
                                            <td class="td-head">Billing Date</td>
                                            <td class="td-head">Billing Statement #</td>
                                            <td class="td-head">Total Amount</td>
                                        </tr>
                                        <?php 
                                        $gtotal=array();
                                        foreach($statement AS $s){ 
                                           $gtotal[]=$s['total_amount']; ?>
                                        <tr>
                                            <td> &nbsp; <?php echo date('F d, Y', strtotime($s['billing_date'])); ?></td>
                                            <td> &nbsp; <a href="<?php echo base_url(); ?>reports/print_billing/<?php echo $s['billing_id']; ?>"><?php echo $s['billing_no']; ?></a></td>
                                            <td align="right">P <?php echo number_format($s['total_amount'],2); ?> &nbsp;</td>
                                        </tr>
                                        <?php } ?>
                                       
                                        <tr>
                                            <td class="td-head" colspan="2" align="right">Grand Total</td>
                                            <td class="td-head" align="right"><b>P <?php echo number_format(array_sum($gtotal),2); ?> &nbsp;</b></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-3">
                                    
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Payment Date</label>
                                        <input type="date" class="form-control" name="payment_date" id="payment_date">
                                    </div>
                                   
                                    <br>
                                    <div class="form-group" >
                                        <label for="exampleInputName1">Form of Payment</label>
                                        <div class="form-check m-0" >
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="payment_type" id="payment_type" value="check"> Check <i class="input-helper"></i></label>
                                        </div>
                                        <div class="form-check m-0">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="payment_type" id="payment_type" value="cash" checked="">Cash <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Check No.</label>
                                        <input type="text" class="form-control" name="check_no" id="check_no" >
                                    </div>  
                                    <div class="form-group">
                                        <label for="exampleInputName1">Collection Receipt No</label>
                                        <input type="text" class="form-control" name="receipt_no" id="receipt_no">
                                    </div>  
                                    <div class="form-group">
                                        <label for="exampleInputName1">Amount</label>
                                        <input type="text" class="form-control" name="amount" id="amount" placeholder="00">
                                    </div> 
                                    <input type='hidden' name='billing_id' id='billing_id' value="<?php echo $ids; ?>">
                                    <input type='button' onclick="submit_payment('<?php echo base_url(); ?>')" class="btn btn-info btn-md btn-block" value='Pay'>
                                  
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
        