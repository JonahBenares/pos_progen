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
                <td colspan="20">
                    <center>
                        <h5 style="color:green"><b>CENTRAL NEGROS POWER RELIABILITY, INC.</b></h5>
                        <div style="border:1px solid #999;width: 500px;margin-bottom: 15px">
                            <h6 class="m-b-0"><b>APPLICATION FOR EMPLOYMENT</b></h6>
                        </div>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="4"><b>POSITION APPLIED FOR:</b></td>
                <td colspan="6" class="bor-btm font-12">
                    <b>                   
                    </b>
                </td>
                <td colspan="3"><b class="m-l-5"> DATE APPLIED:</b></td>
                <td colspan="7" class="bor-btm font-12">
                    <b>
                    </b>
                </td>
            </tr>
            <tr>
                <td colspan="4"><b>EXPECTED SALARY:</b></td>
                <td colspan="6" class="bor-btm font-12">
                    <b>
                    </b>
                </td>
                <td colspan="3"><b class="m-l-5"> DATE AVAILABLE:</b></td>
                <td colspan="7" class="bor-btm font-12">
                    <b>
                    </b>
                </td>
            </tr>
            <tr>
                <td colspan="4"><b>COMPANY:</b></td>
                <td colspan="6" class="bor-btm font-12">
                    <b>
                        <?php echo getInfo($con, 'bu_name', 'business_unit', 'bu_id', $row['applied_company']);?>
                    </b>
                </td>
                <td colspan="3"></td>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td colspan="20"><br></td>
            </tr>
            <tr>
                <td colspan="20" class="bor-all"><strong>PERSONAL DATA:</strong></td>
            </tr>
            <tr>
                <td class="font-12" colspan="4"><b><?php echo sanitize(utf8_encode($row['lname']));?></b></td>
                <td class="font-12" colspan="4"><b><?php echo sanitize(utf8_encode($row['fname']));?></b></td>
                <td class="font-12" colspan="4"><b><?php echo sanitize(utf8_encode($row['mname']));?></b></td>
                <td class="bor-right font-12" colspan="2"><b><?php echo $row['name_ext'];?></b></td>
                <td class="bor-right font-12" colspan="1" align="center"><b><?php echo computeAge($row['bdate']);?></b></td>
                <td class="bor-right font-12" colspan="2" align="center"><b><?php echo $row['sex'];?><br></b></td>
                <td class="font-12" colspan="3" align="center"><b><?php echo $row['civil_status'];?></b></td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="4">LAST NAME</td>
                <td class="bor-btm" colspan="4">FIRST NAME</td>
                <td class="bor-btm" colspan="4">MIDDLE NAME</td>
                <td class="bor-btm bor-right" colspan="2">NAME EXT </td>
                <td class="bor-btm bor-right" colspan="1" align="center">AGE</td>
                <td class="bor-btm bor-right" colspan="2" align="center">SEX</td>
                <td class="bor-btm" colspan="3" align="center">CIVIL STATUS</td>
            </tr>
            <?php 
                $pre_add =  $row['permanent_address'] . ", " . getInfo($con, 'name', 'cities', 'id', $row['pre_city']).", ".getInfo($con, 'name', 'provinces', 'id', $row['pre_prov']);
                $perm_add =  $row['provincial_address'] . ", " . getInfo($con, 'name', 'cities', 'id', $row['perm_city']).", ".getInfo($con, 'name', 'provinces', 'id', $row['perm_prov']);
            ?>
            <tr>
                <td class="bor-btm" colspan="20">PRESENT ADDRESS:<b><span class="font-12"> <?php echo $pre_add; ?></span></b></td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20">PERMANENT/HOME ADDRESS:<b><span class="font-12"> <?php echo $perm_add;?></span></b></td>
            </tr>
            <tr>
                <td class="bor-right font-12" colspan="4" align="center"><b><?php echo date("M. j, Y",strtotime($row['bdate']));?></b></td>
                <td class="bor-right font-12" colspan="4" align="center"><b><?php echo $row['place_birth'];?></b></td>
                <td class="bor-right font-12" colspan="4" align="center"><b><?php echo $row['contact_no'];?></b></td>
                <td class="bor-right font-12" colspan="4" align="center"><b><?php echo $row['nationality'];?></b></td>
                <td class="bor-right font-12" colspan="4" align="center"><b><?php echo $row['religion'];?></b></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="4" align="center">DATE OF BIRTH</td>
                <td class="bor-right" colspan="4" align="center">PLACE OF BIRTH</td>
                <td class="bor-right" colspan="4" align="center">CONTACT NUMBER</td>
                <td class="bor-right" colspan="4" align="center">NATIONALITY</td>
                <td class="" colspan="4" align="center">RELIGION</td>
            </tr>
            <tr>
                <td colspan="20" class="bor-all"><strong>FAMILY BACKGROUND:</strong></td>
            </tr>
            <tr>
                <td class="bor-right font-12" colspan="8"><b><?php echo sanitize(utf8_encode($row['father_name']));?></b></td>
                <td class="bor-right font-12" colspan="3"><b><?php echo (!empty($row['fa_bday'])) ? $row['fa_bday'] : '';?></b></td>
                <td class="bor-right font-12" colspan="1"><b><?php echo (!empty($row['fa_bday'])) ? computeAge($row['fa_bday']) : $row['fa_age'];?></b></td>
                <td class="font-12" colspan="8"><b><?php echo $row['occupation'];?></b></td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="8">FATHER'S NAME</td>
                <td class="bor-btm bor-right" colspan="3">BIRTHDATE</td>
                <td class="bor-btm bor-right" colspan="1">AGE</td>
                <td class="bor-btm " colspan="8">OCCUPATION</td>
            </tr>
            <tr>
                <td class="font-12 bor-right" colspan="8"><b><?php echo sanitize(utf8_encode($row['mother_name']));?></b></td>
                <td class="font-12 bor-right" colspan="3"><b><?php echo (!empty($row['m_bday'])) ? $row['m_bday'] : '';?></b></td>
                <td class="bor-right" colspan="1"><b><?php echo (!empty($row['m_bday'])) ? computeAge($row['m_bday']) : $row['m_age'];?></b></td>
                <td class="font-12 " colspan="8"><b><?php echo $row['m_occupation'];?></b></td>
            </tr>        
            <tr>
                <td class="bor-btm bor-right" colspan="8">MOTHER'S NAME</td>
                <td class="bor-btm bor-right" colspan="3">BIRTHDATE</td>            
                <td class="bor-btm bor-right" colspan="1">AGE</td>
                <td class="bor-btm " colspan="8">OCCUPATION</td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20" align="center">NAME OF SIBLING/S (with Age & Occupation)</td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="6" align="center">NAME</td>
                <td class="bor-right bor-btm" colspan="3" align="center">BIRTHDATE</td>
                <td class="bor-right bor-btm" colspan="1" align="center">AGE</td>
                <td class="bor-right bor-btm" colspan="5" align="center">OCCUPATION</td>
                <td class="bor-right bor-btm" colspan="5" align="center">EMPLOYER</td>
            </tr>
            <?php                           
                $query1 = mysqli_query($con, "SELECT * FROM siblings WHERE personal_id = '$id'")or die(mysqli_error($con));
                $rows =mysqli_num_rows($query1);
                if ($rows != 0 ){
                    while($row1 = mysqli_fetch_array($query1)){
            ?>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center"><b><?php echo sanitize(utf8_encode($row1['siblings_name'])); ?></b></td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"><b><?php echo (!empty($row1['siblings_bday'])) ? $row1['siblings_bday'] : ''; ?></b></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"><b><?php echo (!empty($row1['siblings_bday'])) ? computeAge($row1['siblings_bday']) : $row1['siblings_age']; ?></b></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"><b><?php echo $row1['siblings_occupation']; ?></b></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"><b><?php echo $row1['emp_na_add']; ?></b></td>
            </tr>
            <?php } }else{ ?>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="6" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="3" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="1" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <?php } ?> 
            <tr>
                <td class="bor-right" colspan="5"><b>
                    <?php echo (!empty($row['name_spouse'])) ? sanitize(utf8_encode($row['name_spouse'])) : 'N/A' ;?></b>
                </td>
                <td class="bor-right" colspan="1"><b><?php echo (!empty($row['n_bday'])) ? $row['n_bday'] : '';?></b></td>
                <td class="bor-right" colspan="2"><b><?php echo (!empty($row['n_bday'])) ? computeAge($row['n_bday']) : $row['n_age'];?></b></td>                
                <td class="bor-right" colspan="6"><b><?php echo $row['n_occupation'];?></b></td> 
                <td class="bor-right" colspan="6"><b><?php echo $row['employers_name_address'];?></b></td>            
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="5">NAME OF SPOUSE(If married)</td>
                <td class="bor-btm bor-right" colspan="1">AGE</td>
                <td class="bor-btm bor-right" colspan="2">BIRTHDATE</td>
                <td class="bor-btm bor-right" colspan="6">OCCUPATION</td> 
                <td class="bor-btm bor-right" colspan="6">EMPLOYER'S NAME & ADDRESS</td>            
            </tr>
            <tr>
                <td class="bor-btm" colspan="20" align="center">NAME OF CHILDREN (with Birthdate)</td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="10" align="center">NAME</td>
                <td class="bor-right bor-btm" colspan="5" align="center">AGE</td>
                <td class="bor-right bor-btm" colspan="5" align="center">BIRTHDATE</td>
            </tr>
            <?php                           
                $query2 = mysqli_query($con, "SELECT * FROM children WHERE personal_id = '$id'")or die(mysqli_error($con));
                $rows =mysqli_num_rows($query2);
                if ($rows != 0 ){
                    while($row2 = mysqli_fetch_array($query2)){
                        $row2['child_name'];
            ?>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="10" align="center">
                    <b><?php echo sanitize(utf8_encode($row2['child_name'])); ?></b>
                </td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center">
                    <b><?php echo (!empty($row2['child_bday'])) ? computeAge($row2['child_bday']) : ''; ?></b>
                </td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center">
                    <b>
                        <?php if(empty($row2['child_bday'])){
                            $c_date = '';
                        }
                        else {
                            $c_date = date('F j, Y',strtotime($row2['child_bday']));
                        } 
                        echo $c_date;
                        ?>
                    </b>
                </td>
            </tr>
            <?php } }else{ ?>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="10" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="10" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="10" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="10" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm font-12" colspan="10" align="center"><br></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
                <td class="bor-right bor-btm font-12" colspan="5" align="center"></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="20" class="bor-all"><strong>EDUCATIONAL BACKGROUND:</strong></td>
            </tr>
            <tr>
                <td class="bor-right" colspan="12">COLLEGE: <b><?php echo sanitize(utf8_encode($row['college']));?></b></td>
                <td class="bor-btm bor-right" colspan="4">FROM: 
                    <b>
                        <?php
                            if(empty($row['ed_from'])){
                                $colfrom = "";
                            }
                            else {
                                $colfrom = date("F  Y",strtotime($row["ed_from"]));
                            }
                            echo $colfrom;
                        ?>
                    </b>
                </td>
                <td class="bor-btm bor-right" colspan="4">TO: 
                    <b>
                        <?php
                            if(empty($row['ed_to'])){
                                $colto = "";
                            }
                            else {
                                $colto = date("F  Y",strtotime($row["ed_to"]));
                            }
                            echo $colto;
                        ?> 
                    </b>
                </td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="12">COURSE: <b><?php echo $row['course'];?></b></td>
                <td class="bor-btm bor-right" colspan="8">DATE GRADUATED: 
                    <b>
                        <?php
                            if(empty($row['date_graduated'])){
                                $date_col = "";
                            }
                            else {
                                $date_col = date("F  Y",strtotime($row["date_graduated"]));
                            }
                            echo $date_col;
                        ?>
                    </b>
                </td>
            </tr>
            <tr>
                <td class="bor-right" colspan="12">HIGH SCHOOL: <b><?php echo sanitize(utf8_encode($row['highschool']));?></b></td>
                <td class="bor-btm bor-right" colspan="4">FROM: 
                    <b>
                        <?php
                            if(empty($row['h_from'])){
                                $hfrom = "";
                            }
                            else {
                                $hfrom = date("F  Y",strtotime($row["h_from"]));
                            }
                            echo $hfrom;
                        ?>
                    </b>
                </td>
                <td class="bor-btm bor-right" colspan="4">TO: 
                    <b>
                        <?php
                            if(empty($row['h_to'])){
                                $hto = "";
                            }
                            else {
                                $hto = date("F  Y",strtotime($row["h_to"]));
                            }
                            echo $hto;
                        ?> 
                    </b>
                </td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="12">COURSE: <b><?php echo $row['h_course'];?></b></td>
                <td class="bor-btm bor-right" colspan="8">DATE GRADUATED: 
                    <b>
                        <?php
                            if(empty($row['h_date_graduated'])){
                                $h_date = "";
                            }
                            else {
                                $h_date = date("F  Y",strtotime($row["h_date_graduated"]));
                            }
                            echo $h_date;
                        ?> 
                    </b>
                </td>
            </tr>
            <tr>
                <td class="bor-right" colspan="12">ELEMENTARY: 
                    <b><?php echo sanitize(utf8_encode($row['elementary']));?></b>
                </td>
                <td class="bor-btm bor-right" colspan="4">FROM: 
                    <b>
                        <?php
                            if(empty($row['e_from'])){
                                $efrom="";
                            }
                            else {
                                $efrom = date("F  Y",strtotime($row["e_from"]));
                            }
                            echo $efrom;
                        ?>
                    </b>
                </td>
                <td class="bor-btm bor-right" colspan="4">TO: 
                    <b>
                        <?php
                            if(empty($row['e_to'])){
                                $eto = "";
                            }
                            else {
                                $eto = date("F  Y",strtotime($row["e_to"]));
                            }
                            echo $eto;
                        ?> 
                    </b>
                </td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="12">COURSE: <b><?php echo $row['e_course'];?></b></td>
                <td class="bor-btm bor-right" colspan="8">DATE GRADUATED: 
                    <b>
                        <?php
                            if(empty($row['e_date_graduated'])){
                                $e_date = "";
                            }
                            else {
                                $e_date = date("F  Y",strtotime($row["e_date_graduated"]));
                            }
                            echo $e_date;
                        ?>
                    </b>
                </td>
            </tr>
            <tr>
                <td class="bor-right" colspan="12">POST GRAD/ VOCATIONAL: <b><?php echo sanitize(utf8_encode($row['post_grad']));?></b></td>
                <td class="bor-btm bor-right" colspan="4">FROM: 
                    <b>
                        <?php
                            if(empty($row['p_from'])){
                               $pfrom = "";
                            }
                            else {
                                $pfrom = date("F  Y",strtotime($row["p_from"]));
                            }
                            echo $pfrom;
                        ?> 
                    </b>
                </td>
                <td class="bor-btm bor-right" colspan="4">TO: 
                    <b>
                        <?php
                            if(empty($row['p_to'])){
                                $pto = "";
                            }
                            else {
                                $pto = date("F  Y",strtotime($row["p_to"]));
                            }
                            echo $pto;
                        ?>
                    </b>
                </td>
            </tr>
            <tr>
                <td class="bor-btm bor-right" colspan="12">COURSE: <b><?php echo $row['p_course'];?></b></td>
                <td class="bor-btm bor-right" colspan="8">DATE GRADUATED: 
                    <b>
                        <?php
                            if(empty($row['p_date_graduated'])){
                                $date_grad = "";
                            }
                            else {
                                $date_grad = date("F  Y",strtotime($row["p_date_graduated"]));
                            }
                            echo $date_grad;
                        ?>
                    </b>
                </td>
            </tr>
            <tr>
                <td class="bor-btm" colspan="20" align="center">EMPLOYMENT HISTORY (FROM RECENT TO PAST)</td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center">NAME/ADDRESS OF EMPLOYER</td>
                <td class="bor-right bor-btm" colspan="5" align="center">POSITION</td>
                <td class="bor-right bor-btm" colspan="2" align="center">FROM</td>
                <td class="bor-right bor-btm" colspan="2" align="center">TO</td>
                <td class="bor-right bor-btm" colspan="3" align="center">REAMARKS</td>
            </tr>
            <?php                        
                $query4 = mysqli_query($con,"SELECT * FROM employment_history WHERE personal_id = '$id'");
                $rows =mysqli_num_rows($query4);
                if ($rows != 0 ){
                    while($row4 = mysqli_fetch_array($query4)){ ?>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"><b><?php echo sanitize(utf8_encode($row4['name_address_employer'])); ?></b></td>
                <td class="bor-right bor-btm" colspan="5" align="center"><b><?php echo $row4['em_position']?></b></td>
                <?php
                    if(empty($row4['em_from'])){
                        $emfrom = '';
                    }
                    else {
                        $emfrom = date('M. j, Y',strtotime($row4['em_from']));
                    }

                    if(empty($row4['em_to'])){
                        $emto = '';
                    }
                    else {
                        $emto = date('M. j, Y',strtotime($row4['em_to']));
                    }
                ?>
                <td class="bor-right bor-btm" colspan="2" align="center"><b><?php echo $emfrom?></b></td>
                <td class="bor-right bor-btm" colspan="2" align="center"><b><?php echo $emto ?></b></td>
                <td class="bor-right bor-btm" colspan="3" align="center"><b><?php echo $row4['em_remarks']?></b></td>
            </tr>
            <?php  } }else{ ?>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center"><br></td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center"><br></td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center"><br></td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center"><br></td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
            </tr>
            <tr>
                <td class="bor-right bor-btm" colspan="8" align="center"></td>
                <td class="bor-right bor-btm" colspan="5" align="center"></td>
                <td class="bor-right bor-btm" colspan="2" align="center"><br></td>
                <td class="bor-right bor-btm" colspan="2" align="center"></td>
                <td class="bor-right bor-btm" colspan="3" align="center"></td>
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
