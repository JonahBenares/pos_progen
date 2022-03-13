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
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" placeholder="Date" value="2022-06-06">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Item</label>
                                    <select class="form-control">
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
                                    <textarea class="form-control" id="exampleTextarea1" rows="2" placeholder=" Notes"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="exampleTextarea1"></label>
                                        <div class="form-group">
                                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                            <button class="btn btn-gradient-success btn-fw pull-right btn-sm" name="" onclick="loadTransactions()">Load Transaction</button>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div id="loadTransactions">
                            <hr>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table width="100%" id='damage'>
                                        <tr>
                                            <td width="45%">
                                                <div class="form-group">
                                                    <label>All Transactions</label>
                                                    <select class="form-control">
                                                        <option>-Select Transaction-</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="2%"></td>
                                            <td width="15%">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input type="number" class="form-control" placeholder="00">
                                                </div>
                                            </td>
                                            <td width="2%"></td>
                                            <td width="25%">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <textarea class="form-control" rows="1"></textarea>
                                                </div>
                                            </td>
                                            <td width="2%"></td>
                                            <td width="9%">
                                                <label><br></label>
                                                <div class="form-group">
                                                    <a href="#" class="btn btn-gradient-info btn-sm" onclick="add_transaction()">
                                                        <span class="mdi mdi-plus"></span>
                                                    </a>
                                                    <a href="" class="btn btn-gradient-danger btn-sm">
                                                        <span class="mdi mdi-close"></span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                     
                                    </table>
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
                <button class="btn btn-gradient-success btn-md btn-block">Save All</button>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
        





