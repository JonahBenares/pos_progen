<script>
    function goBack() {
      window.history.back();
    }
</script>
<div class="animated " id="printbutton" style="margin-top: 40px;">
    <center>
        <a href="<?php echo base_url(); ?>reports/billed_list" class="btn btn-warning btn-sm btn-rounded"><b>Back</b></a> 
        <a href="" class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a>
    </center>
    <br>
</div>
<page size="A4" class="<?php echo ($status==2) ? 'adjusted' : ''; ?>"> 
    <div style="padding:30px">
        <!-- <img src="<?php echo base_url(); ?>assets/images/adjusted.png" style="width: 100%; position: inherit;"> -->
        <table class="page-A4 table-bosrdered" width="100%">
            <tr>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
            </tr>
            <?php foreach($head AS $h){ ?>
            <tr>
                <td colspan="2">
                    <img class="logo-print" src="<?php echo base_url().LOGO;?>">   
                </td>
                <td colspan="12" style="padding-left:10px">
                    <b><?php echo COMPANY_NAME;?></b><br>
                    <?php echo ADDRESS;?> <br>
                    <?php echo TIN;?>
                    <br>
                </td>
                <td colspan="1"></td>
                <td colspan="5" align="right" >
                    <span style="font-size: 15px;line-height: 10px;">
                        <?php if ($h['adjustment_counter'] == 0) { ?>
                            <b>BILLING STATEMENT</b>
                        <?php } elseif ($h['adjustment_counter'] > 0) { ?>
                            <b>TRANSACTION ADJUSTMENT</b>
                        <?php } ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="20">
                    <hr style="margin-top: 0.4rem;margin-bottom: 1rem;border: 0;border-top: 2px solid #000">
                </td>
            </tr>
            <tr>
                <td colspan="2">No:</td>
                <td colspan="5" class="bor-btm1"><?php echo $h['billing_no'].(($h['adjustment_counter'] == 0) ? '' : '.r'.$h['adjustment_counter']); ?></td>
                <td colspan="4"></td>
                <td></td>
                <td colspan="3">TIN:</td>
                <td colspan="5" class="bor-btm1"><?php echo $h['tin']; ?></td>
            </tr>
            <tr>
                <td colspan="2">Date:</td>
                <td colspan="5" class="bor-btm1"><?php echo $h['date']; ?></td>
                <td colspan="4"></td>
                <td></td>
                <td colspan="3">PO/JO No.:</td>
                <td colspan="5" class="bor-btm1"></td>
            </tr>
            <tr>
                <td colspan="2">Customer:</td>
                <td colspan="9" class="bor-btm1"><?php echo $h['client']; ?></td>
                <td></td>
                <td colspan="3" style="vertical-align:top">PO/JO Date:</td>
                <td colspan="5" class="bor-btm1" style="vertical-align:top"></td>
            </tr>
            <tr>
                <td colspan="2" style="vertical-align:top">Address:</td>
                <td colspan="18" class="bor-btm1" style="vertical-align:top"><?php echo $h['address']; ?></td>
            </tr>
            <tr>
                <td colspan="20" align="center"><br><br></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="20">
                    <table class="table-bordered" width="100%">
                        <tr>
                            <td width="30%" class="td-head">DR Date</td>
                            <td width="40%" class="td-head">DR No.</td>
                            <td width="30%" class="td-head" align="right">Total Amount</td>
                        </tr>
                        <?php 
                        $total=array();
                        foreach($details AS $d){ 
                            $total[] = $d->remaining_amount;?>
                        <tr>
                            <td><?php echo date("F d, Y", strtotime($d->dr_date)); ?></td>
                            <td><?php echo $d->dr_no; ?></td>
                            <td align="right"><?php echo number_format($d->remaining_amount,2); ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="2">
                                <span class="pull-right">Total Amount Due:</span>
                            </td>
                            <td class="bor-btm2" align="right"> <b><?php echo number_format(array_sum($total),2); ?></b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="20" align="center">
                    <br>
                    <br>                        
                    <b style="color: red;">Please make all checks payable to PROGEN DIESELTECH SERVICES CORP.</b>
                    <br>
                    <br>
                    <i>This document is not valid for claiming input taxes.</i>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td colspan="6"><b>Prepared by:</b></td>
                <td></td>
                <td colspan="6"><b>Checked by:</b></td>
                <td></td>
                <td colspan="6"><b>Approved by:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6">Mary Grace Bugna</td>
                <td></td>
                <td colspan="6">Jordan T. Yap</td>
                <td></td>
                <td colspan="6">Merry Michelle D. Dato</td>
            </tr>
            <tr>
                <td colspan="6">Sales Officer</td>
                <td></td>
                <td colspan="6">Internal Auditor</td>
                <td></td>
                <td colspan="6">Assets & Projects Management Assistant</td> 
            </tr>
        </table>
    </div>
</page>


