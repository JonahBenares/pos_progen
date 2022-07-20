<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script  type="text/javascript">
    function toggle_rec(source) {
        checkboxes_rec = document.getElementsByClassName('rec');
        for(var i=0, n=checkboxes_rec.length;i<n;i++) {
            checkboxes_rec[i].checked = source.checked;
        }
    }
    function toggle_prerel(source) {
        checkboxes_prerel = document.getElementsByClassName('prerel');
        for(var i=0, n=checkboxes_prerel.length;i<n;i++) {
            checkboxes_prerel[i].checked = source.checked;
        }
    }
    function toggle_ver(source) {
        checkboxes_ver = document.getElementsByClassName('ver');
        for(var i=0, n=checkboxes_ver.length;i<n;i++) {
            checkboxes_ver[i].checked = source.checked;
        }
    }

    function toggle_app(source) {
        checkboxes_app = document.getElementsByClassName('app');
        for(var i=0, n=checkboxes_app.length;i<n;i++) {
            checkboxes_app[i].checked = source.checked;
        }
    }

    $(document).ready(function() {
        $("#checkAll").click(function () {
            $('#checprerel').not(this).prop('checked', this.checked);
        });
        $("#checkAll").click(function () {
            $('#checkrec').not(this).prop('checked', this.checked);
        });
        $("#checkAll").click(function () {
            $('#checkver').not(this).prop('checked', this.checked);
        });
        $("#checkAll").click(function () {
            $('#checkapp').not(this).prop('checked', this.checked);
        });
    });
</script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Signatory
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Signatory List &nbsp;
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
                                <h4 class="m-0">Signatory List</h4>
                            </div>
                        </div>   
                    </div>
                    <div class="card-body pt-0">
                    <form method = "POST" action = "<?php echo base_url(); ?>index.php/masterfile/insert_signatory">       
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr style="font-size: 13px" >
                                    <th style="text-align: center;" width="30%">Employee Name</th>
                                    <th style="text-align: center;">Prepared and Released By</th>
                                    <th style="text-align: center;">Received By</th>
                                    <th style="text-align: center;">Verified By</th>
                                    <th style="text-align: center;">Approved By</th>
                                    <!-- <th width="5%"></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: #ffe08e4a">
                                    <td align="right"></td>
                                    <td align="center"><input style="height: 20px" type="checkbox" onClick="toggle_pre_rel(this)" name="halo" class="form-control rec" ><span class="fa fa-caret-down"></span></td>
                                    <td align="center"><input style="height: 20px" type="checkbox" onClick="toggle_rec(this)" name="halo" class="form-control rec" ><span class="fa fa-caret-down"></span></td>
                                    <td align="center"><input style="height: 20px" type="checkbox" onClick="toggle_ver(this)" name="halo" class="form-control ver" ><span class="fa fa-caret-down"></span></td>
                                    <td align="center"><input style="height: 20px" type="checkbox" onClick="toggle_app(this)" name="halo" class="form-control app" ><span class="fa fa-caret-down"></span></td>
                                    <!-- <td style="background-color: #ffe08e7a"></td> -->
                                </tr>
                                <?php 
                                        $count=1;
                                        foreach($employee as $emp){ 
                                    ?>
                                <tr>
                                    <td><input type = "hidden" name = "employee_id<?php echo $count?>" value = "<?php echo $emp['employeeid'];?>"<?php echo set_checkbox('employee_id', $emp['employeeid']); ?>> <?php echo $emp['employee'];?></td>
                                    <?php if($emp['pre_rel'] == '0'){ ?>
                                    <td><input style="height: 20px" type="checkbox" name="pre_rel<?php echo $count?>" value = "1" class="form-control prerel chkChild" id="checkprerel"></td>
                                    <?php } else{ ?>
                                    <td><input style="height: 20px" type="checkbox" name="pre_rel<?php echo $count?>" value = "1" <?php echo ((strpos($emp['pre_rel'], "1") !== false) ? ' checked' : '');?> class="form-control prerel" id="checkprerel" ></td>
                                    <?php } ?>
                                    <?php if($emp['received'] == '0'){ ?>
                                    <td><input style="height: 20px" type="checkbox" name="received<?php echo $count?>" value = "1" class="form-control rec chkChild" id="checkrec"></td>
                                    <?php } else{ ?>
                                    <td><input style="height: 20px" type="checkbox" name="received<?php echo $count?>" value = "1" <?php echo ((strpos($emp['received'], "1") !== false) ? ' checked' : '');?> class="form-control rec" id="checkrec" ></td>
                                    <?php } ?>
                                    <?php if($emp['verified'] == '0'){ ?>
                                    <td><input style="height: 20px" type="checkbox" name="verified<?php echo $count?>" value = "1" class="form-control ver chkChild" id="checkver"></td>
                                    <?php } else{ ?>
                                    <td><input style="height: 20px" type="checkbox" name="verified<?php echo $count?>" value = "1" <?php echo ((strpos($emp['verified'], "1") !== false) ? ' checked' : '');?> class="form-control ver" id="checkver" ></td>
                                    <?php } ?>
                                    <?php if($emp['approved'] == '0'){ ?>
                                    <td><input style="height: 20px" type="checkbox" name="approved<?php echo $count?>" value = "1" class="form-control app chkChild" id="checkapp"></td>
                                    <?php } else{ ?>
                                    <td><input style="height: 20px" type="checkbox" name="approved<?php echo $count?>" value = "1" <?php echo ((strpos($emp['approved'], "1") !== false) ? ' checked' : '');?> class="form-control app" id="checkapp" ></td>
                                    <?php } ?>
<!--                                     <td style="background-color: #ffe08e7a">
                                            <div class="col-md-1" style="padding:0px">                                          
                                                <span class="fa fa-caret-left"></span>
                                            </div>
                                            <div class="col-md-11" style="padding:0px">
                                                <input style="height: 20px" type="checkbox" id="checkAll" name="halo" class="form-control chkParent" >
                                            </div>
                                    </td> -->
                                </tr>
                                <?php $count++; }?>
                            </tbody>
                            <input type='hidden' name='count' value='<?php echo $count; ?>'>
                        </table>
                        <br>
                        <button type="submit" class="btn btn-warning btn-md" style="width:100%">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        




