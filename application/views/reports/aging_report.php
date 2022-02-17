<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-file-document"></i>
                </span> Reports
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Aging Report &nbsp;
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
                                <h4 class="m-0">Aging Report</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>report/print_monthly_report" class="btn btn-gradient-info btn-sm btn-rounded">
                                        <b><span class="mdi mdi-printer"></span> Print</b>
                                    </a>                            
                                    <button type="button" class="btn btn-gradient-warning btn-sm btn-rounded" data-toggle="modal" data-target="#updateSales">
                                        <b><span class="mdi mdi-export"></span> Export</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body"> 
                        <div class="row">
                            <div class="col-lg-4 offset-lg-3">
                                <select class="form-control">
                                    <option value = "">--Select Range of Age--</option>
                                    <option value = "60">1-60</option>
                                    <option value = "120">61-120</option>
                                    <option value = "180">121-180</option>
                                    <option value = "360">181-360</option>
                                    <option value = "361">360+</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <input type="submit" class="btn btn-md btn-gradient-success btn-block" name="" value="Filter">
                            </div>
                        </div>    
                        <hr> 
                        <div class="row">
                            <div class="col-lg-12">
                                <small>Total:</small>
                                <h3><b>255,009</h3></b>
                                <!-- <table width="100%">
                                    <tr>
                                        <td width="10%">Enduse:</td>
                                        <td width="40%"> DG1</td>
                                        <td width="10%" align="right"></td>
                                        <td width="40%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Purpose:</td>
                                        <td> Reconditioning</td>
                                        <td align="right"> </td>
                                        <td></td>
                                    </tr>
                                </table> -->
                            </div>
                        </div>     
                        <br>      
                        <table class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <td width="2%" align="center">#</td>
                                    <td >Item Description</td>
                                    <td width="10%" align="center">Date Received</td>                                   
                                    <td width="5%" align="center">Qty</td>                                 
                                    <td width="10%" align="center">Unit Price</td>                                  
                                    <td class="one-green" width="7%" align="center">1-60</td>
                                    <td class="one-yellow" width="7%" align="center">61-120</td>
                                    <td class="one-orange" width="7%" align="center">121-180</td>
                                    <td class="one-red" width="7%" align="center">181-360</td>
                                    <td class="one-pink" width="7%" align="center">360 +</td>   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="one-green"></td>
                                    <td class="one-yellow"></td>
                                    <td class="one-orange"></td>
                                    <td class="one-red"></td>
                                    <td class="one-pink"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="one-green"></td>
                                    <td class="one-yellow"></td>
                                    <td class="one-orange"></td>
                                    <td class="one-red"></td>
                                    <td class="one-pink"></td>
                                </tr>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="one-green"></td>
                                    <td class="one-yellow"></td>
                                    <td class="one-orange"></td>
                                    <td class="one-red"></td>
                                    <td class="one-pink"></td>
                                </tr>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="one-green"></td>
                                    <td class="one-yellow"></td>
                                    <td class="one-orange"></td>
                                    <td class="one-red"></td>
                                    <td class="one-pink"></td>
                                </tr>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="one-green"></td>
                                    <td class="one-yellow"></td>
                                    <td class="one-orange"></td>
                                    <td class="one-red"></td>
                                    <td class="one-pink"></td>
                                </tr>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="one-green"></td>
                                    <td class="one-yellow"></td>
                                    <td class="one-orange"></td>
                                    <td class="one-red"></td>
                                    <td class="one-pink"></td>
                                </tr>
                                </tr>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        




