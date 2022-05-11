<?php
if (!isset($_SESSION['user_id']) || ($_SESSION['user_id'] == '')) {
        echo "<script>alert('You are currently not logged in.'); 
        window.location ='".base_url()."index.php/masterfile/index'; </script>";
        exit();
    } 
?>
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/scroller.dataTables.min.css">
    </head>
    <style type="text/css">
        @media print{
            .prnt{
                display: none;
            }
        }
    </style>
  <body class="sidebar-icon-only">