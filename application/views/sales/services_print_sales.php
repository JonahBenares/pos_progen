<script>
    function goBack() {
      window.history.back();
    }
</script>
<?php foreach($service_head AS $sh){ ?>
<div class="animated " id="printbutton" style="margin-top: 40px;">
    <center>
        <a href="<?php echo base_url(); ?>sales/goods_sales_list" class="btn btn-warning btn-sm btn-rounded"  ><b>Back</b></a> 
        <a class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a>
        <a href="<?php echo base_url(); ?>sales/services_acknow_print/<?php echo $sh['sales_serv_head_id'];?>" class="btn btn-gradient-primary btn-sm btn-rounded" >
            <b><span class="mdi mdi-printer"></span> Acknowledgement Receipt</b>
        </a>
    </center>
    <br>
</div>
<page size="A4" > 
    <div style="padding:30px">
        <table class="page-A4 table-borsdered" width="100%">
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
                    <span style="font-size: 15px;line-height: 10px;"><b>JOB ORDER SUMMARY REPORT</b></span>
                </td>
            </tr>
            <tr>
                <td colspan="20">
                    <hr style="margin-top: 0.4rem;margin-bottom: 1rem;border: 0;border-top: 2px solid #000">
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="11" class=""></td>
                <td colspan="6" align="right"><h6 style="color:blue"><b><?php echo $sh['dr_no'];?></b></h6></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="10"></td>
                <td colspan="1"></td>
                <td colspan="2" align="right">Date:</td>
                <td colspan="4" class="bor-btm1">&nbsp;<?php echo date("Y-m-d", strtotime($sh['sales_date']));?></td>
            </tr> 
            <tr>
                <td colspan="3">Client:</td>
                <td colspan="10" class="bor-btm1"><?php echo $sh['client'];?></td>
                <td colspan="1"></td>
                <td colspan="2" align="right">TIN:</td>
                <td colspan="4" class="bor-btm1">&nbsp;<?php echo $sh['tin'];?></td>
            </tr>               
            <tr>
                <td colspan="3" style="vertical-align:top">Address:</td>
                <td colspan="10" class="bor-btm1" style="vertical-align:top"><?php echo $sh['address'];?></td>
                <td colspan="1"></td>
                <td colspan="2" align="right" style="vertical-align:top">VAT:</td>
                <td colspan="4" class="bor-btm1" style="vertical-align:top">&nbsp;<?php echo ($sh['vat']==1) ? 'Vatable' : 'Non-Vatable';?></td>
            </tr>
            <tr>
                <td colspan="3">Contact Person:</td>
                <td colspan="10" class="bor-btm1"><?php echo $sh['contact_person'];?></td>
                <td colspan="1"></td>
                <td colspan="2" align="right">Contact No:</td>
                <td colspan="4" class="bor-btm1">&nbsp;<?php echo $sh['contact_no'];?></td>
            </tr>
            <tr>
                <td colspan="3">PGC <b>JOR </b>No:</td>
                <td colspan="10" class="bor-btm1"><?php echo $sh['jor_no'];?></td>
                <td colspan="1"></td>
                <td colspan="2" align="right">JOR Date:</td>
                <td colspan="4" class="bor-btm1">&nbsp;<?php echo $sh['jor_date'];?></td>
            </tr>
            <tr>
                <td colspan="3">PGC <b>JOI </b>No:</td>
                <td colspan="10" class="bor-btm1"><?php echo $sh['joi_no'];?></td>
                <td colspan="1"></td>
                <td colspan="2" align="right">JOI Date:</td>
                <td colspan="4" class="bor-btm1">&nbsp;<?php echo $sh['joi_date'];?></td>
            </tr>
            <tr>
                <td colspan="3">Date Started:</td>
                <td colspan="3" class="bor-btm1">&nbsp;<?php echo $sh['date_started'];?></td>
                <td ></td>
                <td colspan="3">Date Completed:</td>
                <td colspan="3" class="bor-btm1">&nbsp;<?php echo $sh['date_completed'];?></td>
                <td ></td>
                <td colspan="2">Duration:</td>
                <td colspan="4" class="bor-btm1">&nbsp;<?php echo $sh['duration'];?></td>
            </tr>
            <?php } ?>
           <!--  <tr>
                <td colspan="3"></td>
                <td colspan="11" class="bor-btm1"></td>
                <td colspan="2" align="right"></td>
                <td colspan="4" class="bor-btm1"></td>
            </tr> -->
            <tr>
                <td colspan="20" align="center"><br><br></td>
            </tr>
            <tr style="border-top:1px solid #aeaeae">
                <td colspan="20">
                    <table class="table-bordered" width="100%">
                        <tr> 
                            <td style="background:#efefef" width="7%">Part No.</td>
                            <td style="background:#efefef" width="30%">Item Description</td>
                            <td style="background:#efefef" width="15%">Serial No.</td>
                            <td style="background:#efefef" width="5%">Qty</td>
                            <td style="background:#efefef" width="5%">Expected Qty</td>
                            <td style="background:#efefef" width="5%">UOM</td>
                            <td style="background:#efefef" width="10%">Selling Price</td>
                            <td style="background:#efefef" width="8%">Discount</td>
                            <td style="background:#efefef" width="12%">Total Price</td>
                            <td style="background:#efefef" width="12%">Remarks</td>
                        </tr>
                        <?php
                            $itmtotal[]=0;
                            foreach($service_details AS $sd){ 
                                $itmtotal[] = $sd['total'];
                        ?>
                        <tr>
                            <td><?php echo $sd['original_pn'];?></td>
                            <td><?php echo $sd['item'];?></td>
                            <td><?php echo $sd['serial_no'];?></td>
                            <td><?php echo $sd['quantity'];?></td>
                            <td><?php echo $sd['expected_qty'];?></td>
                            <td><?php echo $sd['uom'];?></td>
                            <td align="center"><?php echo number_format($sd['selling_price'],2);?></td>
                            <td align="center"><?php echo number_format($sd['discount'],2);?></td>
                            <td><?php echo number_format($sd['total'],2);?></td>
                            <td><?php echo $sd['i_remarks'];?></td>
                        </tr>
                        <?php } $itemtotal=array_sum($itmtotal); ?>
                        <tr>
                            <td style="background:#efefef" colspan="2" align="center"><b>Sub-Total</b></td>
                            <td style="background:#efefef" colspan="7" align="center"><b>Engine Parts Cost Incurred</b></td>
                            <td style="background:#efefef" align="left"><b><?php echo number_format($itemtotal,2);?></b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="20" align="center"><br></td>
            </tr>
            <tr style="border-top:1px solid #aeaeae">
                <td colspan="20" align="center" style="background:#efefef"><b>Consumables and Other Materials</b></td>
            </tr>
            <tr>
                <td colspan="20">
                    <table class="table-bordered" width="100%">
                        <tr> 
                            <td style="background:#efefef" width="5%">No.</td>
                            <td style="background:#efefef" width="45%">Item Description</td>
                            <td style="background:#efefef" width="8%">Qty</td>
                            <td style="background:#efefef" width="8%">UOM</td>
                            <td style="background:#efefef" width="14%">Unit Cost</td>
                            <td style="background:#efefef" width="12%">Total Cost</td>
                            <td style="background:#efefef" width="12%">Remarks</td>
                        </tr>
                        <?php  
                            $x=1;
                            $mattotal[]=0;
                            foreach($service_materials AS $sm){
                                $mattotal[] = $sm['total_cost'];
                        ?>
                        <tr>
                            <td><?php echo $x; ?></td>
                            <td><?php echo $sm['item_description'];?></td>
                            <td><?php echo $sm['quantity'];?></td>
                            <td><?php echo $sm['uom'];?></td>
                            <td><?php echo $sm['unit_cost'];?></td>
                            <td><?php echo $sm['total_cost'];?></td>
                            <td><?php echo $sm['mat_remarks'];?></td>
                        </tr>
                        <?php  $x++; } $mtotal =array_sum($mattotal);
                        ?>
                        <tr>
                            <td style="background:#efefef" colspan="2" align="center"><b>Sub-Total</b></td>
                            <td style="background:#efefef" colspan="4" align="center"><b>Material Cost Incurred</b></td>
                            <td style="background:#efefef" align="left"><b><?php echo number_format($mtotal,2); ?></b></td>
                        </tr>

                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="20" align="center"><br></td>
            </tr>
            <tr style="border-top:1px solid #aeaeae">
                <td colspan="20" align="center" style="background:#efefef"><b>Manpower</b></td>
            </tr>
            <tr>
                <td colspan="20">
                    <table class="table-bordered" width="100%">
                        <tr> 
                            <td style="background:#efefef" width="5%">No.</td>
                            <td style="background:#efefef" width="45%">Employee</td>
                            <td style="background:#efefef" width="8%">Days</td>
                            <td style="background:#efefef" width="8%">Rate</td>
                            <td style="background:#efefef" width="14%">Overtime</td>
                            <td style="background:#efefef" width="12%">Total</td>
                            <td style="background:#efefef" width="12%">Remarks</td>
                        </tr>
                        <?php 
                            $x=1;
                            $mantotal[]=0;
                            foreach($service_manpower AS $sman){
                                $mantotal[] = $sman['total_cost'];
                        ?>
                        <tr>
                            <td><?php echo $x; ?></td>
                            <td><?php echo $sman['employee_name']; ?></td>
                            <td><?php echo $sman['days']; ?></td>
                            <td><?php echo $sman['rate']; ?></td>
                            <td><?php echo $sman['overtime']; ?></td>
                            <td><?php echo $sman['total_cost']; ?></td>
                            <td><?php echo $sman['man_remarks']; ?></td>
                        </tr>
                        <?php $x++; 
                             }
                            $mntotal =array_sum($mantotal);
                        ?>
                        <tr>
                            <td style="background:#efefef" colspan="2" align="center"><b>Sub-Total</b></td>
                            <td style="background:#efefef" colspan="4" align="center"><b>Labor Cost Incurred</b></td>
                            <td style="background:#efefef" align="left"><b><?php echo number_format($mntotal,2); ?></b></td>
                        </tr>

                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="20" align="center"><br></td>
            </tr>
            <tr style="border-top:1px solid #aeaeae">
                <td colspan="20" align="center" style="background:#efefef"><b>Actual Rental Cost</b></td>
            </tr>
            <tr>
                <td colspan="20">
                    <table class="table-bordered" width="100%">
                        <tr> 
                            <td style="background:#efefef" width="5%">No.</td>
                            <td style="background:#efefef" width="45%">Equipment</td>
                            <td style="background:#efefef" width="8%">Rate</td>
                            <td style="background:#efefef" width="8%">Unit</td>
                            <td style="background:#efefef" width="14%">Days</td>
                            <td style="background:#efefef" width="12%">Total Cost</td>
                            <td style="background:#efefef" width="12%">Remarks</td>
                        </tr>
                        <?php 
                            $x=1;
                            $eqptotal[]=0;
                            foreach($service_equipment AS $se){
                                $eqptotal[] = $se['total_cost'];
                        ?>
                        <tr>
                            <td><?php echo $x; ?></td>
                            <td><?php echo $se['equipment_name']; ?></td>
                            <td><?php echo $se['rate']; ?></td>
                            <td><?php echo $se['uom']; ?></td>
                            <td><?php echo $se['days']; ?></td>
                            <td><?php echo $se['total_cost']; ?></td>
                            <td><?php echo $se['e_remarks']; ?></td>
                        </tr>
                        <?php $x++; }
                            $eqtotal =array_sum($eqptotal);
                        ?>
                        <tr>
                            <td style="background:#efefef" colspan="2" align="center"><b>Sub-Total</b></td>
                            <td style="background:#efefef" colspan="4" align="center"><b>Rental Cost</b></td>
                            <td style="background:#efefef" align="left"><b><?php echo number_format($eqtotal,2); ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="7" style="background:#efefef"><br></td>
                        </tr>
                        <?php 
                            $grand_total = $itemtotal + $mtotal + $mntotal + $eqtotal;
                        ?>
                        <tr>
                            <td style="background:#fff700" colspan="2" align="center"><b>GRAND TOTAL</b></td>
                            <td style="background:#fff700" colspan="4" align="center"><b>Actual Project Cost</b></td>
                            <td style="background:#fff700" align="left"><b><?php echo number_format($grand_total,2); ?></b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <?php if (!empty($sh['overall_remarks'])) {?>
            <tr>
                <td colspan="20" class="bor-btm1">OVERALL REMARKS:
                    <br>
                    <br>
                    <?php echo $sh['overall_remarks'];?>
                </td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <?php } ?>
            <tr>
                <?php $administrative_fee=0; foreach($service_head AS $sh){ ?>
                <td colspan="5"></td>  
                <td colspan="10">
                    <?php 
                            $service_fee = $mtotal + $mntotal + $eqtotal;
                            $administrative_fee=$sh['administrative_fee'];
                            if($service_fee>100000){
                                $total_service_fee = $service_fee * 0.20;
                            }else if($service_fee<100000){
                                $total_service_fee = $service_fee * 0.25;
                            }

                            if($sh['vat']==1){
                                $vat = ($grand_total + $administrative_fee + $total_service_fee)*0.12;
                            }else{
                                $vat = '0';
                            }

                            if($sh['wht']==1){
                                $tax = $grand_total * 0.01;
                            }else{
                                $tax = '0';
                            }

                            $total = ($grand_total + $total_service_fee + $vat)-$tax;
                    ?>
                    <table class="table-bordered" width="100%">
                        <tr>
                            <td style="background:#efefef" colspan="2"><center><b>SUMMARY</b></center></td>
                        </tr>
                        <tr> 
                            <td width="60%">Engine Parts</td>
                            <td width="40%"><?php echo number_format($itemtotal,2); ?></td>
                        </tr>
                        <tr>
                            <td>Material</td>
                            <td><?php echo number_format($mtotal,2); ?></td>
                        </tr>
                        <tr>
                            <td>Manpower</td>
                            <td><?php echo number_format($mntotal,2); ?></td>
                        </tr>
                        <tr>
                            <td>Equipment</td>
                            <td><?php echo number_format($eqtotal,2); ?></td>
                        </tr>
                        <tr style="background:#fff700">
                            <td>TOTAL</td>
                            <td><b><?php echo number_format($grand_total,2); ?></b></td>
                        </tr>
                        <?php if($administrative_fee!=0){ ?>
                        <tr>
                            <td>Add: Administrative Fee</td>
                            <td><?php echo number_format($administrative_fee,2); ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>Add: Service Fee</td>
                            <td><?php echo number_format($total_service_fee,2); ?></td>
                        </tr>
                        <?php if($sh['vat']==1){?>
                        <tr>
                            <td>Add: Vat 12%</td>
                            <td><?php echo number_format($vat,2); ?></td>
                        </tr>
                        <?php } ?>
                        <?php if($sh['wht']==1){?>
                        <tr>
                            <td>Withholding Tax 1%</td>
                            <td><?php echo number_format($tax,2); ?></td>
                        </tr>
                        <?php } ?>
                        <tr style="background:#00ff2b">
                            <td>TOTAL</td>
                            <td><?php echo number_format($total,2); ?></td>
                        </tr>
                    </table>
                </td>  
                <td colspan="5"></td>  
            </tr>
            <?php } ?>
            <!-- <tr>
                <td colspan="2">Remarks:</td>
                <td colspan="18" class="bor-btm1"></td>
            </tr> -->
            <!-- <tr>
                <td colspan="2">Shipped via:</td>
                <td colspan="8" class="bor-btm1"></td>

                <td colspan="2" align="center">Waybill No.:</td>
                <td colspan="8" class="bor-btm1"></td>
            </tr> -->
            <tr>
                <td colspan="20"><br><br><br></td>
            </tr>
            <tr>
                <td colspan="4"><b>Prepared by:</b></td>
                <td></td>
                <td colspan="4"><b>Checked by:</b></td>
                <td colspan="2"></td>
                <td colspan="4"><b>Noted by:</b></td>
                <td></td>
                <td colspan="4"><b>Approved by:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="4" align="center" class="bor-btm1">
                    <?php echo ($_SESSION['fullname']);?>
                    <!-- <select style="width:100%;border:0px solid #fff;-webkit-appearance: none;text-align: center;">
                        <option>Mary Grace BUgna</option>
                    </select> -->
                </td>
                <td></td>
                <td colspan="4" align="center" class="bor-btm1">
                    Mary Grace Bugna
                </td>
                <td colspan="2"></td>
                <td colspan="4" align="center" class="bor-btm1">
                    
                </td>
                <td></td>
                <td colspan="4" align="center" class="bor-btm1">
                    Merry Michelle Dato
                </td>
            </tr>

            <!-- <tr>
                <td></td>
                <td colspan="7"><b>Prepared by:</b></td>
                <td></td>
                <td colspan="3"><b></b></td>
                <td></td>
                <td colspan="7"><b>Approved by:</b></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="7" class="bor-btm1" align="center"></td>
                <td></td>
                <td colspan="3" align="center"></td>
                <td></td>
                <td colspan="7" class="bor-btm1" align="center"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="7" align="center" style="vertical-align:text-top;">Sales Officer</td>
                <td></td>
                <td colspan="3" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="7" align="center" style="vertical-align:text-top;">Warehouse Supervisor</td>
                <td></td>
            </tr>

            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="5"><b>Noted by:</b></td>
                <td></td>
                <td colspan="5"><b></b></td>
                <td></td>
                <td colspan="6"><b>Received the above items in good condition:</b></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="5" class="bor-btm1" align="center"></td>
                <td></td>
                <td colspan="5"></td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="5" align="center" style="vertical-align:text-top;">Projects and Assets Management</td>
                <td></td>
                <td colspan="5" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Signature over Printed Name</td>
                <td></td>
            </tr> -->
        </table>
    </div>
</page>


