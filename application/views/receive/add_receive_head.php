
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> -->
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-import"></i>
                </span> Receive
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>receive/receive_list">Receive List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Receive</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-primary card-img-holder text-white">
                        <h4 class="m-0">Add New Receive</h4>
                    </div>
                    <div class="card-body">  
                    <form id="receiveHead" >                      
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Date</label>
                                            <input type="date" class="form-control" placeholder="Date" name='receive_date'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">PO No.</label>
                                            <input type="text" class="form-control" placeholder="PO No" name='po_no'>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">DR No.</label>
                                            <input type="text" class="form-control" placeholder="DR No" name='dr_no'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">SI/OR</label>
                                            <input type="text" class="form-control" placeholder="SI/OR" name='si_no'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Overall Remarks</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="2" name='remarks' placeholder="Overall Remarks"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-check mx-sm-2">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" checked name='pcf' value='1'> PCF
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="exampleTextarea1"><br></label>
                                        <div class="form-group">
                                            <input type="hidden" name="count" id="count" value='1'>
                                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                            <input type='button' class="btn btn-gradient-primary btn-sm btn-block btn-rounded" id="proc" onclick="proceed()" value="Proceed">
                                            <input type='button' class="btn btn-gradient-danger btn-sm btn-block btn-rounded" id="cancel" onclick="cancel_receive()" value="Cancel Transaction" style='display: none;'>
                                           <!--  <a  href="<?php echo base_url(); ?>receive/add_receive_pr"  class="btn btn-gradient-primary btn-sm btn-block btn-rounded">Proceed</a> -->
                                            <!-- <input type="submit" class="btn btn-gradient-primary btn-fw pull-right" value="Add PR" name=""> -->
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>  
                    </form>
                    </div>
                </div>
            </div>
        </div>        
        <div class="row">
            <div class="col-lg-5"><br><hr></div>
            <div class="col-lg-2"><center><br><span style="color:#aeaeae;font-size: 13px;">PURCHASE REQUESTS</span></center></div>
            <div class="col-lg-5"><br><hr></div>
        </div>

        <div class="customer_records" id='myDIV' style='display: none;'>
            <br>
            <div class="row" id="append_pr1">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-1">
                                    <br>
                                    <h3 class="page-title">
                                        <span class="page-title-icon bg-gradient-primary text-white mr-2 item-block" >
                                            <span id='PRcount1' class='prcnt'><b><h4 class="m-0" style="padding-top:6px">01</h4></b></span>
                                        </span>
                                    </h3>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="exampleInputName1">PR/JO No.</label>
                                        <input type="text" class="form-control " placeholder="PR/JO No." name='pr_no1' id='pr_no1' onblur="updateDetails(this.value, this.id)";>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Department</label>
                                        <select class="form-control" name='department1' id='department1' onchange="updateDetailsDD(this.value, this.id)">
                                            <option>-Select Department-</option>
                                            <?php foreach($department AS $d){ ?>
                                                <option value='<?php echo $d->department_id; ?>'><?php echo $d->department_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>  
                            <div class="row">                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Purpose</label>
                                        <select class="form-control " name='purpose1' id='purpose1' onchange="updateDetailsDD(this.value, this.id)">
                                            <option>-Select Purpose-</option>
                                            <?php foreach($purpose AS $p){ ?>
                                                <option value='<?php echo $p->purpose_id; ?>'><?php echo $p->purpose_desc; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>   
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleTextarea1">Inspected by</label>
                                        <select class="form-control " name='inspected1' id='inspected1'  onchange="updateDetailsDD(this.value, this.id)">
                                            <option>-Select Inspected by-</option>
                                            <?php foreach($employees AS $e){ ?>
                                                <option value='<?php echo $e->employee_id; ?>'><?php echo $e->employee_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type='hidden' name='receive_id' id='receive_id'>
                                        <input type='hidden' name='rd_id1' id='rd_id1'>
                                    </div>
                                </div>                             
                            </div>
                            <div class="row prrow1">
                                <div class="col-lg-12">
                                  <!--   <button class="btn btn-gradient-primary btn-xs pull-right " onclick="add_receive_items('<?php echo base_url(); ?>')" name="">
                                        <span class="mdi mdi-plus"></span> Add Item
                                    </button>   -->
                                    <div id ="myButton1" class='bttn'></div>
                                </div>      
                                <br>
                                <br>             
                                <div class="col-lg-12">
                                    <div > <!-- style="width:100%;overflow-x: scroll;" -->
                                        <table id="table-alt" class="table-bordered " width="100%">
                                            <thead>
                                            <tr>
                                                <td class="td-head" width="15%">Item Description</td>
                                                <td class="td-head" width="15%">Supplier</td>
                                                <td class="td-head" width="10%">Brand</td>
                                                <td class="td-head" width="10%">Serial No.</td>
                                                <td class="td-head" width="">Catalog No</td>
                                                <td class="td-head" width="">Net Cost</td>
                                                <td class="td-head" width="">Expected Qty</td>
                                                <td class="td-head" width="">Delivered/ Received</td>
                                                <td class="td-head" width="">Shipping/U & other related cost</td>
                                                <td class="td-head" width="">Exp Date</td>
                                                <td class="td-head" width="">Local/ Manila</td>
                                                <td class="td-head" width="2%">
                                                    <a class="mdi mdi-menu"></a>
                                                </td>
                                            </tr>
                                         </thead>
                                         <tbody id="append_data1">
                                         </tbody>
                                           
                                           
                                        </table>
                                    </div>  
                                </div>                            
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <?php for($x=1;$x<=10;$x++){ ?>
        <div class="customer_records_dynamic<?php echo $x; ?>"></div>
        <?php } ?> 
       <!--  <div class="customer_records_dynamic1"></div>
         <div class="customer_records_dynamic2"></div> -->
        <div id="PRDiv" style='display: none;'>
            <br>
            <div class="row" >
                <div class="col-lg-3 offset-lg-3">
                    <button class="btn btn-gradient-primary btn-md btn-block addPR">Add PR</button>
                </div>
                <div class="col-lg-3" id='savebttn'>
                    <!-- <a href="#" class="btn btn-gradient-success btn-md btn-block">Save and Print</a> -->
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>
</div>
        

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/receive.js"></script> 


