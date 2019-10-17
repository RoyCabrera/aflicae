<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>EcoLunch</title>

    <link href="<?php echo base_url('assets/css/login/bootstrap.min.css'); ?>" rel="stylesheet" id="bootstrap-css">
    <link href="<?php echo base_url('assets/css/login/font-awesome.css') ?>" rel="stylesheet" >
	<script src="<?php echo base_url('assets/js/login/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/login/bootstrap.min.js') ?>"></script>


	<link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/ECOLUNCH.png');?>">

	<style>
        .login-block{
         /*   background: #DE6262;   fallback for old browsers
        background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6
        background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        float:left;
        width:100%;
        padding : 50px 0;
        }
        /* .banner-sec{ min-height:500px; border-radius: 0 10px 10px 0; padding:0;} */
        .container{background:#fff; border-radius: 10px; }
        .carousel-inner{border-radius:0 10px 10px 0;}
        .carousel-caption{text-align:left; left:5%;}
        .login-sec{padding: 10px 30px; position:relative;}
        .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
        .login-sec .copy-text i{color:#23b7e5;}
        .login-sec .copy-text a{color:#23b7e5;}
        .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #23b7e5;    margin-bottom: 0px;}
        .login-sec h2:after{content:" "; width:100px; height:5px; background:#23b7e5; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
        .btn-login{background: #23b7e5; color:#fff; font-weight:600;}
        .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
        .banner-text h2{color:#fff; font-weight:600;}
        .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
        .banner-text p{color:#fff;}
    </style>
</head>
<div style='width: 100%;
    height: 100%;
    position: absolute;
    z-index: 10000;background-color:#fbfafa;text-align: -webkit-center;position:fixed;' id='preloader'  >
	<img class="ml-5" src="<?php echo base_url('assets/img/.gif') ?>" >
	<h2 class="text-center" style="color:blue;">Aflicae</h2>
</div>
<body>
<?php
		 if($this->session->has_userdata('error')){
			echo "<div class='alert alert-danger text-center' role='alert'>".$this->session->flashdata('error')."</div>";
			$this->session->sess_destroy();
		 }

		?>
	<section class="login-block">

		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12  login-sec">

					<div class="text-center  rounded">
						<img class="img-fluid" src="<?php echo base_url('assets/img/aflicae.png');?>" width="80%" alt="App Logo">
					</div>
					<form class="login-form" method="POST" action="<?php echo site_url('Login/valida') ?>" >
						<div class="form-group">
							<label for="exampleInputEmail1" class="text-uppercase">Correo</label>
							<input type="email" name='correo' id='correo' class="form-control" placeholder="" required>

						</div>
						<div class="form-group">
							<label for="exampleInputPassword1" class="text-uppercase">Contraseña</label>
							<input type="password" name='clave' id='clave' class="form-control" placeholder="" required>
						</div>


						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input">
								<small>Recordar Cuenta</small>
							</label>

						</div>
						<br>
						<button type="submit" class="btn btn-primary float-right w-100">Ingresar</button>
					</form>

				</div>
				<div class="col-lg-8 col-md-8 col-xs-12 col-sm-12 banner-sec">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner" role="listbox">
							<div class="carousel-item active">
								<img class="d-block img-fluid" src="<?php echo base_url('assets/img/aflicae1.jpg') ?>" alt="1er slide">
							</div>
							
						</div>

					</div>
				</div>
			</div>
	</section>
</body>
<script>
$('.carousel').carousel({
  interval: 5000
})

 		$( window ).on( "load", function() {
          $('#preloader').fadeOut('slow',function(){$(this).remove();});
      });

</script>
</html>
