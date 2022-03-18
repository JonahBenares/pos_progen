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
                    <!-- <li class="breadcrumb-item active" aria-current="page">Damage Item</li> -->
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-danger card-img-holder text-white"></div>
                    <div class="card-body">       
                        <form id='damageHead'>                 
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" placeholder="Date" name='damage_date' id='damage_date'>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Item</label>
                                    <select class="form-control" name='item' id='item'>
                                        <option>-Select Item-</option>
                                        <?php foreach($item AS $i){ ?>
                                            <option value="<?php echo $i->item_id; ?>"><?php echo $i->original_pn." - ".$i->item_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Notes</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="2" placeholder=" Notes" name='notes' id='notes'></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="exampleTextarea1"></label>
                                        <div class="form-group">
                                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                            <input type='button' id="proceed_damage" class="btn btn-gradient-success btn-fw pull-right btn-sm" value="Proceed" onclick="loadTransactions()">
                                            <input type='button' class="btn btn-gradient-danger btn-fw pull-right btn-sm" id="cancel_damage" onclick="canceled_damage()" value="Cancel Transaction" style='display: none;font-size: 10px;'>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        </form>
                        <div id="loadTransactions">
                            <hr>
                            <br>
                            <form id='damageDetails'>
                            <div class="row">
                                <div class="col-lg-12">
                                   <div class="form-group">
                                        
                                        <!-- <a class="btn btn-gradient-danger btn-sm">
                                            <span class="mdi mdi-close"></span>
                                        </a> -->
                                    </div>
                                    <table width="100%" class="tadble-bordered" id='damage'>
                                        <tr>
                                            <td width="45%">
                                                <label>Transactions</label>
                                            </td>
                                            <td width="2%"></td>
                                            <td width="15%">
                                                <label>Quantity</label>
                                            </td>
                                            <td width="2%"></td>
                                            <td width="34%">
                                                <label>Remarks</label>
                                            </td>
                                            <td width="2%">
                                            <a class="btn btn-gradient-info btn-sm mb-3" onclick="add_transaction()">
                                                <span class="mdi mdi-plus"></span>
                                            </a>
                                        </td>
                                        </tr>
                                    </table>
                                    <input type='hidden' name='count' id='count' value='0'>
                                    <input type='hidden' name='damage_id' id='damage_id' >
                                </div>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>        
        <br> 
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <input type='hidden' name='baseurl' id='baseurl' value='<?php echo base_url(); ?>'>
                <input type='button' id="savedamage" class="btn btn-gradient-success btn-md btn-block" value='Save Transaction' onclick='saveDamage()'>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</form>
</div>
        





