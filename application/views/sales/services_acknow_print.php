<script>
    function goBack() {
      window.history.back();
    }
</script>
<div class="animated " id="printbutton" style="margin-top: 40px;">
    <center>
        <a href="<?php echo base_url(); ?>sales/services_sales_list" class="btn btn-warning btn-sm btn-rounded"  ><b>Back</b></a> 
        <a class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a>
    </center>
    <br>
</div>
<page size="A4" > 
    <div style="padding:30px">
        <table class="page-A4 table-bordersed" width="100%">
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
                    <span style="font-size: 15px;line-height: 10px;"><b>ACKNOWLEDGMENT RECEIPT</b></span>
                </td>
            </tr>
            <tr>
                <td colspan="20">
                    <hr style="margin-top: 0.4rem;margin-bottom: 1rem;border: 0;border-top: 2px solid #000">
                </td>
            </tr>
            <?php foreach($service_head AS $sh){ ?>
            <tr>
                <td colspan="20" align="center"><br></td>
            </tr>
            <tr>
                <td colspan="3">Deliver To:</td>
                <td colspan="9" class="bor-btm1"><?php echo $sh['client'];?></td>
                <td colspan="1"></td>
                <td colspan="3" align="right">DR No: </td>
                <td colspan="4" class="bor-btm1"> <h7 style="color:blue"><b><?php echo $sh['dr_no'];?></b></h7></td>
            </tr>               
            <tr>
                <td colspan="3" style="vertical-align:text-top;">Address:</td>
                <td colspan="9" class="bor-btm1"><?php echo $sh['address'];?></td>
                <td colspan="1"></td>
                <td colspan="3" align="right" style="vertical-align:bottom">Delivery Date:</td>
                <td colspan="4" class="bor-btm1" style="vertical-align:bottom"><?php echo $sh['sales_date'];?></td>
            </tr>
            <tr>
                <td colspan="3">Contact Person:</td>
                <td colspan="9" class="bor-btm1"><?php echo $sh['contact_person'];?></td>
                <td colspan="1"></td>
                <td colspan="3" align="right">JOR </b>No: </td>
                <td colspan="4" class="bor-btm1"><?php echo $sh['jor_no'];?></td>
            </tr>
            <tr>
                <td colspan="3">Contact No:</td>
                <td colspan="9" class="bor-btm1"><?php echo $sh['contact_no'];?></td>
                <td colspan="1"></td>
                <td colspan="3" align="right">JOR Date:</td>
                <td colspan="4" class="bor-btm1"><?php echo $sh['jor_date'];?></td>
            </tr>
            <tr>
                <td colspan="20" align="center"><br><br></td>
            </tr>
            <tr style="border-top:1px solid #aeaeae">
                <td colspan="20">
                    <table class="table-bordered" width="100%">
                        <tr> 
                            <td style="background:#efefef" width="30%">Description</td>
                        </tr>
                        <tr>
                            <td>
                                <!-- Reconditioning of the following:<br>
                                <br> -->
                                <?php echo  nl2br($sh['ar_description']);?><br> 
                                <br>                                                     
                                <br>                                                     
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="3">Remarks:</td>
                <td colspan="17" class="bor-btm1"><?php echo nl2br($sh['remarks']);?></td>
            </tr>
            <tr>
                <td colspan="3">Shipped Via:</td>
                <td colspan="9" class="bor-btm1"><?php echo $sh['shipped_via']; ?></td>
                <td colspan="1"></td>
                <td colspan="3" align="right">Waybill No:</td>
                <td colspan="4" class="bor-btm1"><?php echo $sh['waybill_no']; ?></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <?php } ?>
            <?php if($client_id == '1') {?>
            <tr>
                <td colspan="6"><b>Prepared and Released by:</b></td>
                <td></td>
                <td colspan="6"><b>Recommending Approval: </b></td>
                <td></td>
                <td colspan="6"><b>Verified by:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6" class="bor-btm1" align="center">
                    Mary Grace Bugna
                </td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center">
                    Eric Jabiniar
                </td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center">
                    Roan Renz Liao
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;">Sales Commercial / Commercial & Parts Analyst</td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Plant Director</td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Sr Parts Engineer</td>
            </tr>

            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>Approved by:</b></td>
                <td></td>
                <td colspan="6"><b></b></td>
                <td></td>
                <td colspan="6"><b>Received the above items in good condition:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6" class="bor-btm1" align="center">
                    Merry Michelle Dato
                </td>
                <td></td>
                <td colspan="6"></td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center">
                    <input style="width:100%;border:0px solid #fff;-webkit-appearance: none;text-align: center;">
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;">Assets and Projects Management Assistant</td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Signature over Printed Name</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="2" align="left" style="vertical-align:text-top;">Date/Time:</td>
                <td colspan="4" align="right" style="vertical-align:text-top;"><?php echo date('d F Y, h:i:s A'); ?></td>
                <td></td>
            </tr>
        <?php }else{ ?>
                        <tr>
                <td colspan="6"><b>Prepared and Released by:</b></td>
                <td></td>
                <td colspan="6"><b></b></td>
                <td></td>
                <td colspan="6"><b>Verified by:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6" class="bor-btm1" align="center">
                    Marianne M. Vianña
                </td>
                <td></td>
                <td colspan="6" align="center">
                </td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center">
                    Claro Bolarde
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;">Commercial Asst for Sales/Billing</td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Quality Assurance (Q.A) Supervisor</td>
            </tr>

            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6"><b>Approved by:</b></td>
                <td></td>
                <td colspan="6"><b></b></td>
                <td></td>
                <td colspan="6"><b>Received the above items in good condition:</b></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="6" class="bor-btm1" align="center">
                    Raffy F. Ponce
                </td>
                <td></td>
                <td colspan="6"></td>
                <td></td>
                <td colspan="6" class="bor-btm1" align="center">
                    <input style="width:100%;border:0px solid #fff;-webkit-appearance: none;text-align: center;">
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;">Technical Director</td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Signature over Printed Name</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;"></td>
                <td></td>
                <td colspan="2" align="left" style="vertical-align:text-top;">Date/Time:</td>
                <td colspan="4" align="right" style="vertical-align:text-top;"><?php echo date('d F Y, h:i:s A'); ?></td>
                <td></td>
            </tr>
        <?php } ?>
            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
            <input type="hidden" name="sales_serv_head_id" id="sales_serv_head_id" value="<?php echo $sales_serv_head_id; ?>">
        </table>
    </div>
</page>


