<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Mi Condominio Online">
   <meta name="keywords" content="condominio, vecino, gestion">
   <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/aflicae.png');?>">
   <title>Aflicae</title>
   <!-- =============== VENDOR STYLES ===============-->
	 <!-- FONT AWESOME-->

   <link rel="stylesheet" href="<?php echo base_url('assets/vendor/@fortawesome/fontawesome-free-webfonts/css/fa-brands.css'); ?>">
   <link rel="stylesheet" href="<?php echo base_url('assets/vendor/@fortawesome/fontawesome-free-webfonts/css/fa-regular.css'); ?>">
   <link rel="stylesheet" href="<?php echo base_url('assets/vendor/@fortawesome/fontawesome-free-webfonts/css/fa-solid.css'); ?>">
   <link rel="stylesheet" href="<?php echo base_url('assets/vendor/@fortawesome/fontawesome-free-webfonts/css/fontawesome.css'); ?>">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="<?php echo base_url('assets/vendor/simple-line-icons/css/simple-line-icons.css'); ?>">
   <!-- ANIMATE.CSS-->
   <link rel="stylesheet" href="<?php echo base_url('assets/vendor/animate.css/animate.css'); ?>">
   <!-- WHIRL (spinners)-->
   <link rel="stylesheet" href="<?php echo base_url('assets/vendor/whirl/dist/whirl.css'); ?>">
   <!-- =============== PAGE VENDOR STYLES ===============-->
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" id="bscss">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>" id="maincss">
   <!-- =============== MY STYLE ===============-->
   <link rel="stylesheet" href="<?php echo base_url('assets/css/estilo.css'); ?>" >

	 <link rel="stylesheet" href="<?php echo base_url('assets/css/theme-a.css'); ?>" >
	<!--  <link rel="stylesheet" href="<?php echo base_url('assets/css/theme-'.desencriptar($this->session->userdata('Tema')).'.css'); ?>" > -->
   <link href="<?php echo base_url('assets/vendor/toastr/toastr.min.css');?>" rel="stylesheet" />
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fontawesome/css/font-awesome.min.css'); ?>">
 <!-- ALERTAS-->
   <link rel="stylesheet" href="<?php echo base_url('assets/vendor/sweetalert/dist/sweetalert.css'); ?>">
      <!-- Datatables-->
      <link rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css');?>">
   <link rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css');?>">
	 <link rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css');?>">
	 <!-- Datapicker -->
	 <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.css');?>">

   <style type="text/css">
  .w-20 {width:20px; }
	.derecha {text-align:right;}
	table{
		width:100% !important;
	}
  </style>
</head>

<div style='width: 100%;
    height: 100%;
    position: absolute;
    z-index: 10000;background-color:#fbfafa;text-align: -webkit-center;position:fixed;' id='preloader'  >

	<h2 class="text-center" style="color:blue;">Aflicae</h2>
</div>
