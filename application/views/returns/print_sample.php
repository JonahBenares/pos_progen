<style type="text/css">
    body {
        background: rgb(204,204,204); 
        color: #000;
        font-family: sans-serif, Arial;
    }
    h1,h2,h3,h4,h5,h6{color: #000}
    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    page[size="A4"] {  
        width: 21cm;
        height: 29.7cm; 
    }
    page[size="A4"][layout="landscape"] {
        width: 29.7cm;
        height: 21cm;  
    }
    page[size="A3"] {
        width: 29.7cm;
        height: 42cm;
    }
    page[size="A3"][layout="landscape"] {
        width: 42cm;
        height: 29.7cm;  
    }
    page[size="A5"] {
        width: 14.8cm;
        height: 21cm;
    }
    page[size="A5"][layout="landscape"] {
        width: 21cm;
        height: 14.8cm;  
    }
    @media print {
        body, page {
            margin: 0;
            box-shadow: 0;
        }
        /*table td{ border:1px solid #fff!important; }*/
        .bor-btm{border-bottom:1px solid #000!important;}
        .bor-all{
            border: 1px solid #000;
        }
        #printbutton, #br, #br1{display: none}
        table{border:1px solid #000!important;}
    }
    /*.table-bordered, td {
        border: 1px solid #000!important;
    } */
    .bor-btm{
        border-bottom:1px solid #000;
    }
    .bor-right{
        border-right:1px solid #000;
    }
    .bor-left{
        border-left:1px solid #000;
    }
    .bor-top{
        border-top:1px solid #000;
    }
    .bor-all{
        border: 1px solid #000;
    }
    table td{
        font-size: 11px;
    }
    .font-12{
        font-size: 12px!important;
    }
    table{border:1px solid #000!important;}
    .btn-w100{
        width: 100px
    }
    .btn-round{
        border-radius: 20px
    }
</style>
<script>
    function goBack() {
      window.history.back();
    }
</script>
<div class="animated fadeInDown p-t-20" id="printbutton">
    <center>
        <a onclick="goBack()" class="btn btn-warning text-white btn-w100 btn-round">Back</a>
        <a href='update_emp.php?id=<?php echo $id; ?>' class="btn btn-primary btn-w100 btn-round">Update</a> 
        <a href="" class="btn btn-success btn-w100 btn-round" onclick="window.print()">Print</a>
        <!-- <button class="btn btn-danger btn-fill"onclick="printDiv('printableArea')" style="margin-bottom:5px;width:80px;"></span> Print</button><br> -->
    </center>
    <br>
</div>
<page size="A4">
    <div class="p-t-20 m-l-20 m-r-20">
        <table class="page-A4 table-borsdered" width="100%">
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
                        <b>DELIVERY RECEIPT - GOODS</b>
                        <br>
                        <br>
                    </td>
                </tr>
                <?php foreach($sales_head AS $sh){ ?>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="11" class=""></td>
                    <td colspan="6" align="right"><h5 style="color:blue"><b><?php echo $sh['dr_no'];?></b></h5></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="10"></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">Date: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['sales_date'];?></td>
                </tr> 
                <tr>
                    <td colspan="3">Client:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['client'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">TIN: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['tin'];?></td>
                </tr>               
                <tr>
                    <td colspan="3">Address:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['address'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">VAT: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo ($sh['vat']==1) ? 'Vatable' : 'Non-Vatable';?></td>
                </tr>
                <tr>
                    <td colspan="3">Contact Person:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['contact_person'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">Contact No: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['contact_no'];?></td>
                </tr>
                <tr>
                    <td colspan="3">PGC <b>PR </b>No:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['pr_no'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">PR Date: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['pr_date'];?></td>
                </tr>
                <tr>
                    <td colspan="3">PGC <b>PO </b>No:</td>
                    <td colspan="10" class="bor-btm1"><?php echo $sh['po_no'];?></td>
                    <td colspan="1"></td>
                    <td colspan="2" align="right">PO Date: &nbsp;</td>
                    <td colspan="4" class="bor-btm1"><?php echo $sh['po_date'];?></td>
                </tr>
               <!--  <tr>
                    <td colspan="3"></td>
                    <td colspan="11" class="bor-btm1"></td>
                    <td colspan="2" align="right"></td>
                    <td colspan="4" class="bor-btm1"></td>
                </tr> -->
                <tr>
                    <td colspan="20" align="center"><br><br></td>
                </tr>
                <tr>
                    <td colspan="20">
                        <table class="table-bordered" width="100%">
                            <tr> 
                                <td width="2%">#</td>
                                <td width="7%">Part No.</td>
                                <td width="30%">Item Description</td>
                                <td width="15%">Serial No.</td>
                                <td width="5%">Qty</td>
                                <td width="5%">UOM</td>
                                <td width="10%">Selling Price</td>
                                <td width="8%">Discount</td>
                                <td width="12%">Total Price</td>
                            </tr>
                            <?php 
                                $x = 1;
                                foreach($sales_details AS $sd){ ?>
                            <tr>
                                <td><?php echo $x;?></td>
                                <td><?php echo $sd['original_pn'];?></td>
                                <td><?php echo $sd['item'];?></td>
                                <td><?php echo $sd['serial_no'];?></td>
                                <td><?php echo $sd['quantity'];?></td>
                                <td><?php echo $sd['uom'];?></td>
                                <td align="center"><?php echo number_format($sd['selling_price'],2);?></td>
                                <td align="center"><?php echo number_format($sd['discount'],2);?></td>
                                <!-- <td align="center"><?php echo number_format($sd['discount'],0)."%";?></td> -->
                                <td><?php echo number_format($sd['total'],2);?></td>
                            </tr>
                            <?php $x++; } ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td colspan="2">Remarks:</td>
                    <td colspan="18" class="bor-btm1"><?php echo nl2br($sh['remarks']);?></td>
                </tr>
                <!-- <tr>
                    <td colspan="2">Shipped via:</td>
                    <td colspan="8" class="bor-btm1"></td>

                    <td colspan="2" align="center">Waybill No.:</td>
                    <td colspan="8" class="bor-btm1"></td>
                </tr> -->
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5"><b>Prepared by:</b></td>
                    <td></td>
                    <td colspan="5"><b>Released by:</b></td>
                    <td></td>
                    <td colspan="6"><b>Approved by:</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="20"><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" class="bor-btm1" align="center"></td>
                    <td></td>
                    <td colspan="5" class="bor-btm1" align="center"></td>
                    <td></td>
                    <td colspan="6" class="bor-btm1" align="center"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;">Sales Officer</td>
                    <td></td>
                    <td colspan="5" align="center" style="vertical-align:text-top;">Warehouse Assistant</td>
                    <td></td>
                    <td colspan="6" align="center" style="vertical-align:text-top;">Warehouse Supervisor</td>
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
                </tr>
                <?php } ?>
            </table>
    </div>
</page>
<page size="A4">
    <div class="p-t-20 m-l-20 m-r-20">
        <table width="100%">
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
                <td colspan="20" class="bor-btm"><strong>ADDITIONAL INFORMATION DATA:</strong></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="5"><b><?php echo $row['tin'];?></b></td>
                <td class="bor-right" colspan="5"><b><?php echo $row['sss'];?></b></td>
                <td class="bor-right" colspan="5"><b><?php echo $row['philhealth'];?></b></td>
                <td class="bor-right" colspan="5"><b><?php echo $row['pagibig'];?></b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="5">TIN</td>
                <td class="bor-btm bor-right" colspan="5">SSS</td>
                <td class="bor-btm bor-right" colspan="5">PHILHEALTH</td>
                <td class="bor-btm bor-right" colspan="5">PAG-IBIG (HDMF)</td>
            </tr>
            <tr>
                <td class="bor-right" colspan="5"><b><?php echo $row['height'];?></b></td>
                <td class="bor-right" colspan="5"><b><?php echo $row['weight'];?></b></td>
                <td class="bor-right" colspan="10"><b><?php echo $row['dialect'];?></b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="5">HEIGHT</td>
                <td class="bor-btm bor-right" colspan="5">WEIGHT</td>
                <td class="bor-btm bor-right" colspan="10">TYPES OF DIALECT SPOKEN/ CAN UNDERSTAND</td>
            </tr>
            <tr>
                <td class="bor-right" colspan="7"><b><?php echo $row['drivers_license'];?></b></td>
                <td class="bor-right" colspan="7"><b><?php echo $row['date_issued_licensed_number'];?></b></td>
                <td class="bor-right" colspan="6"><b><?php echo $row['special_skills'];?></b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="7">DO YOU HAVE DRIVER'S LICENSE</td>
                <td class="bor-btm bor-right" colspan="7">DATE ISSUED/ LICENSE NUMBER</td>
                <td class="bor-btm bor-right" colspan="6">SPECIAL SKILLS</td>
            </tr>
            <tr>
                <td class="" colspan="20">
                    <b>
                         <?php  
                            if(empty($row['illness'])){
                                echo("<br>");
                            }else{
                                 echo $row['illness'];
                            }                          
                         ;?>
                    </b>
                </td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20">HAVE YOU EVER BEEN HOSPITALIZED? WHAT MAJOR ILLNESS?<br></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="4" align="center">
                    <b>
                        <?php  
                            if(empty($row['own_bus'])){
                                echo("<br>");
                            }else{
                                 echo $row['own_bus'];
                            }                          
                         ?>
                    </b>
                </td>
                <td class="bor-right" colspan="5" align="center">
                    <b>
                        <?php  
                            if(empty($row['nature_bus'])){
                                echo("<br>");
                            }else{
                                $row['nature_bus'];
                            }                          
                         ?>
                    </b>
                </td>
                <td class="bor-right" colspan="6" align="center">
                    <b>
                        <?php  
                            if(empty($row['profession'])){
                                echo("<br>");
                            }else{
                                 echo $row['profession'];
                            }                          
                         ?>
                    </b>
                </td>
                <td class="bor-right" colspan="5" align="center">
                    <b>
                        <?php  
                            if(empty($row['license_no'])){
                                echo("<br>");
                            }else{
                                 echo $row['license_no'];
                            }                          
                         ?>
                    </b>
                </td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="4" align="center">DO YOU OWN A BUSINESS?</td>
                <td class="bor-btm bor-right" colspan="5" align="center">NATURE OF BUSINESS</td>
                <td class="bor-btm bor-right" colspan="6" align="center">PROFESSION:</td>
                <td class="bor-btm bor-right" colspan="5" align="center">LICENSE NUMBER:</td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20"><b>CHARACTER REFERENCE:</b></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center">NAME </td>
                <td class="bor-right bor-btm" colspan="5" align="center">EMPLOYER</td>
                <td class="bor-right bor-btm" colspan="4" align="center">POSITION</td>
                <td class="bor-right bor-btm" colspan="3" align="center">RELATIONSHIP</td>
                <td class="bor-right bor-btm" colspan="3" align="center">09668664192</td>
            </tr>
            <?php
                $query3 = mysqli_query($con,"SELECT * FROM character_reference WHERE personal_id = '$id'") or die(mysqli_error($con));
                $rows =mysqli_num_rows($query3);
                if ($rows != 0 ){
                while($row3 = mysqli_fetch_array($query3)){
            ?>
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center"><b><?php echo sanitize(utf8_encode($row3['c_name'])) ?></b></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b><?php echo sanitize(utf8_encode($row3['c_employer'])) ?></b></td>
                <td class="bor-right bor-btm" colspan="4" align="center"><b><?php echo $row3['c_position'] ?></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b><?php echo $row3['c_relationship'] ?></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b><?php echo $row3['c_contact_no'] ?></b></td>
            </tr> 
            <?php } }else{ ?>
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b><br></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="4" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
            </tr>        
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b><br></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="4" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
            </tr> 
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b><br></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="4" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
            </tr> 
            <tr>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b><br></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="4" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b></b></td>
            </tr>
            <?php } ?> 
            <tr>
                <td class="bor-btm" colspan="20"><b>SKETCH LOCATION OF RESIDENCE GOING TO OFFICE</b></td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20" style="height:400px" >
                    <?php   
                        if (empty($row['map_file'])){
                            echo '<h5 style = "text-align:center;"><strong>NO MAP FILE PROVIDED</strong></h5>';
                        }
                        else{ ?>
                            <img src="../uploads/<?php echo $row['map_file'];?>" height="fixed" width="100%" class="thumbnail" >
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20"><b>PERSON TO CONTACT INCASE OF EMERGENCY:</b></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="6"><b><?php echo sanitize(utf8_encode($row['p_name']));?></b></td>
                <td class="bor-right" colspan="3"><b><?php echo $row['p_relationship'];?></b></td>
                <td class="bor-right" colspan="3"><b><?php echo $row['p_contact_no'];?></b></td>
                <td class="bor-right" colspan="8"><b><?php echo $row['address'];?></b></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="6">NAME</td>
                <td class="bor-right bor-btm" colspan="3">RELATIONSHIP</td>
                <td class="bor-right bor-btm" colspan="3">CONTACT NUMBER</td>
                <td class="bor-right bor-btm" colspan="8">ADDRESS</td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="3"></td>
                <td class="bor-btm" colspan="14" align="center">
                    <br>I HERBY CERTIFY THAT THE INFORMATION GIVEN IS TRUE AND CORRECT AND THAT IT HAS BEEN AMDE IN GOOD FAITH TO THE BEST OF MY KNOWLEDGE AND BELIEF.
                    <br>
                    <br>
                </td> 
                <td class="bor-btm" colspan="3"></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="10"><br></td> 
                <td class="bor-right" colspan="10"></td> 
            </tr>
            <tr>
                <td class="bor-right" colspan="10">PRINTED NAME & SIGNATURE</td> 
                <td class="bor-right" colspan="10">DATE </td> 
            </tr>
        </table>
        <div style="text-align: right;width: 100%"><small>HRFORMS061713</small></div>
    </div>
</page>

<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="assets/js/demo.js"></script> 
   

</html>
