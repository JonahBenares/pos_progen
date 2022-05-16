<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>POS - PROGEN</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" />
    </head>
    <body id="background">
        <?php
            $error_msg= $this->session->flashdata('error_msg');  
        ?>
        <?php 
            if($error_msg){
        ?>
            <div class="alert alert-danger alert-shake">
                <center><?php echo $error_msg; ?></center>                    
            </div>
        <?php } ?>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth" style="background: #ffffff00;"> 
                    <div class="row flex-grow">
                        <div class="col-lg-4 offset-lg-7 col-md-4 offset-md-4">
                            <div class="auth-form-light text-left p-5">
                                <div class="brand-logo">
                                    <img src="<?php echo base_url(); ?>assets/images/logo.svg">
                                </div>
                                <h4>Hello! let's get started</h4>
                                <h6 class="font-weight-light">Sign in to continue.</h6>
                                <br>
                                <form method = "POST" action="<?php echo base_url(); ?>index.php/masterfile/login_process">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="username" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <button type = "submit" class="btn btn-primary btn-block  " >Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </body>
    <script src="<?php echo base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/off-canvas.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/misc.js"></script>
</html>