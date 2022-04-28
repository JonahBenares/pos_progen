<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/damage.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-danger text-white mr-2">
                  <i class="mdi mdi-image-broken-variant"></i>
                </span>Damage Item
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>damage/damage_list">Damage list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Print Damage Form</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <center>
                    <a href="#" class="btn btn-gradient-success btn-md btn-rounded" onclick="printDiv('printableArea')">
                        <b><span class="mdi mdi-printer"></span> Print</b>
                    </a>
                </center>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <br>
        <page size="A4" id="printableArea">
            <table class="page-A4 table-bosrdered" width="100%">
                <tr>
                    <td width="5%"><br></td>
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
                    <td colspan="20" align="center">                        
                        <b>PROGEN DIESELTECH SERVICES CORP.</b><br>
                        Prk. San Jose, Brgy. Calumangan, Bago City, Neg. Occ. <br>
                        VAT Reg. TIN: 008-726-170-001  
                        <br>
                        <br>
                        <b>PARTS/ EQUIPMENT DAMAGE REPORT</b>
                        <br>
                        <br>
                    </td>
                </tr>
                <?php foreach($head as $h){ ?>
                <tr>
                    <td colspan="3">PDR No.:</td>
                    <td colspan="7" class="bor-btm1"><?php echo $h['pdr_no']; ?></td>
                    <td colspan="1"></td>
                    <td colspan="3" align="right">Date:</td>
                    <td colspan="7" class="bor-btm1"> &nbsp;</td>
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
                    <td colspan="1" style="background:#efefef"></td>
                    <td colspan="19" style="background:#efefef">Item Specification</td>
                </tr>
                <?php foreach($details AS $d){ ?>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3">Item Description:</td>
                    <td colspan="15" class="bor-btm1"><?php echo $d['item']; ?></td>
                    <td colspan="1"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3">Brand:</td>
                    <td colspan="15" class="bor-btm1"><?php echo $d['brand']; ?></td>
                    <td colspan="1"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3">Serial No:</td>
                    <td colspan="6" class="bor-btm1"><?php echo $d['serial_no']; ?></td>
                    <td colspan="3" align="right">Part No:</td>
                    <td colspan="6" class="bor-btm1"><?php echo $d['part_no']; ?></td>
                    <td colspan="1"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3">Accquisition Date:</td>
                    <td colspan="6" class="bor-btm1"><?php echo date("F j, Y", strtotime($d['acquisition_date'])); ?></td>
                    <td colspan="3" align="right">Accquisition Cost:</td>
                    <td colspan="6" class="bor-btm1"><?php echo number_format($d['acquisition_cost'],2); ?></td>
                    <td colspan="1"></td>
                </tr>
            <?php } ?>
                <tr>
                    <td colspan="20" align="center"><br><br></td>
                </tr>
                  <?php foreach($head as $h){ ?>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="18">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td>Description of the Damaged on the Item:</td>
                            </tr>
                            <tr> 
                                <td><br><?php echo $h['damage_description']; ?><br></td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="1"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="18">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td>Reason of Damage:</td>
                            </tr>
                            <tr> 
                                <td><br><?php echo $h['damage_reason']; ?><br></td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="1"></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3">Inspected by:</td>
                    <td colspan="7" class="bor-btm1"><?php echo $h['inspected_by']; ?></td>
                    <td colspan="3"></td>
                    <td colspan="4" align="right">Repairable:</td>
                    <td colspan="1" class="bor-btm1" align="center"></td>
                    <td colspan="1"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="3">Date Inspected:</td>
                    <td colspan="7" class="bor-btm1"><?php echo $h['date_inspected']; ?></td>
                    <td colspan="3"></td>
                    <td colspan="4" align="right">Beyond Repair:</td>
                    <td colspan="1" class="bor-btm1" align="center"></td>
                    <td colspan="1"></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="18">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td>Provide a recommendation on how the parts/equipment is going to be repaired or replaced:</td>
                            </tr>
                            <tr> 
                                <td><br><?php echo $h['recommendation']; ?><br></td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="1"></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="18">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td>Notes:</td>
                            </tr>
                            <tr> 
                                <td><br><?php echo $h['remarks']; ?><br></td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="1"></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5"><b>Prepared by:</b></td>
                    <td></td>
                    <td colspan="5"><b>Checked/Verified by::</b></td>
                    <td></td>
                    <td colspan="6"><b>Noted by:</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" class="bor-btm1" align="center"><?php echo $h['prepared_by']; ?></td>
                    <td></td>
                    <td colspan="5" class="bor-btm1" align="center"><?php echo $h['checked_by']; ?></td>
                    <td></td>
                    <td colspan="6" class="bor-btm1" align="center"><?php echo $h['noted_by']; ?></td>
                    <td></td>
                </tr>
            <?php } ?>
                <tr>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;">Sales Officer</td>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;">Toolkeeper/Technical Person</td>
                    <td></td>
                    <td colspan="6" align="center" style="vertical-align:text-top;">Assets & Projects Mgmt. Assist.</td>
                    <td></td>
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
        </page>
    </div>
</div>
        




