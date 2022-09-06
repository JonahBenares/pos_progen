<script>
    function goBack() {
      window.history.back();
    }
</script>
<div class="animated " id="printbutton" style="margin-top: 40px;">
    <center>
        <a href="<?php echo base_url(); ?>damage/damage_list" class="btn btn-warning btn-sm btn-rounded"  ><b>Back</b></a> 
        <a class="btn btn-success btn-sm btn-rounded" onclick="window.print()"><b>Print</b></a>
    </center>
    <br>
</div>
<page size="A4" > 
    <div style="padding:30px">
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
                    <span style="font-size: 15px;line-height: 10px;"><b>PARTS/ EQUIPMENT DAMAGE REPORT</b></span>
                </td>
            </tr>
            <tr>
                <td colspan="20">
                    <hr style="margin-top: 0.4rem;margin-bottom: 1rem;border: 0;border-top: 2px solid #000">
                </td>
            </tr>
           
            <?php foreach($head as $h){ ?>
                <tr>
                    <td colspan="3">PDR No.:</td>
                    <td colspan="7" class="bor-btm1"><?php echo $h['pdr_no']; ?></td>
                    <td colspan="1"></td>
                    <td colspan="3" align="right">Date:</td>
                    <td colspan="7" class="bor-btm1"> &nbsp;<?php echo date("Y-m-d", strtotime($h['date_reported'])); ?></td>
                </tr>               
                <tr>
                    <td colspan="3">Reported by:</td>
                    <td colspan="7" class="bor-btm1"><?php echo $h['reported_by']; ?></td>
                    <td colspan="1"></td>
                    <td colspan="3" align="right">Accounted to:</td>
                    <td colspan="7" class="bor-btm1"> &nbsp; <?php echo $h['accounted_person']; ?></td>
                </tr>
                <tr>
                    <td colspan="3">Date/ Time Reported:</td>
                    <td colspan="7" class="bor-btm1"><?php echo date("Y-m-d H:i:s", strtotime($h['date_reported'])); ?></td>
                    <td colspan="1"></td>
                    <td colspan="3" align="right">Person using upon damage: </td>
                    <td colspan="7" class="bor-btm1">&nbsp; <?php echo $h['person_using']; ?></td>
                </tr>
             <?php } ?>
            <tr>
                <td colspan="20" ><br></td>
            </tr>
            <tr>
                <td colspan="20" style="background:#efefef">Item Specification</td>
            </tr>
            <?php foreach($details AS $d){ ?>
                <tr>
                    <td colspan="3">Item Description:</td>
                    <td colspan="17" class="bor-btm1"><?php echo $d['item']; ?></td>
                </tr>
                <tr>
                    <td colspan="3">Brand:</td>
                    <td colspan="17" class="bor-btm1"><?php echo $d['brand']; ?></td>
                </tr>
                <tr>
                    <td colspan="3">Serial No:</td>
                    <td colspan="7" class="bor-btm1"><?php echo $d['serial_no']; ?></td>
                    <td colspan="3" align="right">Part No:</td>
                    <td colspan="7" class="bor-btm1"><?php echo $d['part_no']; ?></td>
                </tr>
                <tr>
                    <td colspan="3">Accquisition Date:</td>
                    <td colspan="7" class="bor-btm1"><?php echo date("F j, Y", strtotime($d['acquisition_date'])); ?></td>
                    <td colspan="3" align="right">Accquisition Cost:</td>
                    <td colspan="7" class="bor-btm1"><?php echo number_format($d['acquisition_cost'],2); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="20" align="center"><br><br></td>
            </tr>
            <?php foreach($head as $h){ ?>
                <tr>
                    <td colspan="20">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td>Description of the Damaged on the Item:</td>
                            </tr>
                            <tr> 
                                <td><?php echo $h['damage_description']; ?><br><br></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td>Reason of Damage:</td>
                            </tr>
                            <tr> 
                                <td><?php echo $h['damage_reason']; ?><br><br></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="3">Inspected by:</td>
                    <td colspan="9" class="bor-btm1"><?php echo $h['inspected_by']; ?></td>
                    <td colspan="3"></td>
                    <td colspan="4" align="right">Repairable:</td>
                    <?php if($h['repaired'] == 0){ ?>
                    <td colspan="1" class="bor-btm1" align="center"></td>
                    <?php } else if($h['repaired'] == '1' && $h['assessment']=='1'){ ?>
                         <td colspan="1" class="bor-btm1" align="center">x</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td colspan="3">Date Inspected:</td>
                    <td colspan="9" class="bor-btm1"><?php echo $h['date_inspected']; ?></td>
                    <td colspan="3"></td>
                    <td colspan="4" align="right">Beyond Repair:</td>
                      <?php if($h['repaired'] == 0 ){ ?>
                    <td colspan="1" class="bor-btm1" align="center"></td>
                      <?php } else if($h['repaired'] == '0' && $h['assessment']=='2'){ ?>
                         <td colspan="1" class="bor-btm1" align="center">x</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="20">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td>Provide a recommendation on how the parts/equipment is going to be repaired or replaced:</td>
                            </tr>
                            <tr> 
                                <td><?php echo $h['recommendation']; ?><br><br></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="20">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td>Notes:</td>
                            </tr>
                            <tr> 
                                <td><?php echo $h['remarks']; ?><br><br></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="6"><b>Prepared by:</b></td>
                    <td></td>
                    <td colspan="6"><b>Checked/Verified by:</b></td>
                    <td></td>
                    <td colspan="6"><b>Noted by:</b></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="6" class="bor-btm1" align="center"><?php echo $h['prepared_by']; ?></td>
                    <td></td>
                    <td colspan="6" class="bor-btm1" align="center"><?php echo $h['checked_by']; ?></td>
                    <td></td>
                    <td colspan="6" class="bor-btm1" align="center"><?php echo $h['noted_by']; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="6" align="center" style="vertical-align:text-top;">Sales Officer</td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Toolkeeper/Technical Person</td>
                <td></td>
                <td colspan="6" align="center" style="vertical-align:text-top;">Assets & Projects Mgmt. Assist.</td>
            </tr>

            <tr>
                <td colspan="20"><br></td>
            </tr>
            <!-- <tr>
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
                <td></td> -->
            </tr>
        </table>
    </div>
</page>


