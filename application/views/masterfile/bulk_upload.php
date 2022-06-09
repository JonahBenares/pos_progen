<script src="<?php echo base_url(); ?>assets/js/masterfile.js"></script>
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Bulk Upload 
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Bulk Upload&nbsp;
                        <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                    <!--  <li class="breadcrumb-item"><a href="#">Editors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buyer List</li> -->
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">    
                        <table class="table table-bordered" width="100%">
                            <tr>
                                <td colspan="5"><b>Upload Excel Files:</b><br><br></td>
                            </tr>
                            <tr>
                                <td width="15%"><b>File to Upload</b></td>
                                <td width="45%"><b>Format</b></td>
                                <td width="30%"><b>Upload File Here</b></td>
                                <td width=""></td>
                            </tr>
                            <tr>
                            <form method='POST' action='upload_excel' enctype="multipart/form-data">
                                <td class="pt-0 pb-0">Item Inventory</td>
                                <td class="pt-0 pb-0"><a href='<?php echo base_url(); ?>index.php/masterfile/export_inventory' title = "Download">Download Inventory Format</a></td>
                                <td class="pt-0 pb-0"><input type='file' class="form-control" name='excelfile' id = "file" required></td>
                                <!-- <td class="pt-0 pb-0"><input type="button" class="btn btn-info btn-sm btn-block btn-rounded" name="" value="Upload"></td> -->
                                <td class="pt-0 pb-0"><button type = "submit" class="btn btn-info btn-sm btn-block btn-rounded"  name='uploadexcel' id="submitButton" >Upload</button></td>
                            </form>
                            </tr>
                            <tr>
                            <form method='POST' action='upload_excel_begbal' enctype="multipart/form-data">
                                <td class="pt-0 pb-0">Beginning Balance</td>
                                <td class="pt-0 pb-0"><a href='<?php echo base_url(); ?>index.php/masterfile/export_begbal'>Download Beg. Bal. Format</a></td>
                                <td class="pt-0 pb-0"><input type="file" class="form-control" name='excelfile_begbal' id = "file" required></td>
                                <td class="pt-0 pb-0"><button type = "submit" class="btn btn-info btn-sm btn-block btn-rounded"  name='uploadexcel' id="submit" >Upload</button></td>
                            </form>
                            </tr>
                            <tr>
                                <form method='POST' action='upload_excel_current' enctype="multipart/form-data">
                                <td class="pt-0 pb-0">Update Item Info</td>
                                <td class="pt-0 pb-0"><a href='<?php echo base_url(); ?>index.php/masterfile/export_current' title = "Download">Download Current Inventory Format</a></td>
                                <td class="pt-0 pb-0"><input type="file" class="form-control" name='excelfile_cur' id = "file" required></td>
                                <td class="pt-0 pb-0"><button type = "submit" class="btn btn-info btn-sm btn-block btn-rounded"  name='uploadexcel' id="submit" >Upload</button></td>
                                 </form>
                            </tr>
                        </table>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        




