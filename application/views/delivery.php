<header class="masthead">
    <div class="container ">
        <div class="row  align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">

                <img src="<?php echo base_url('assets/img/ECOLUNCH_blanco.png'); ?>" width="245px" alt="App Logo">


                <hr class="divider col-1  bg-white" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white font-weight-light mb-5">

                    EcoLunch llegó para que juntos hagamos un pequeño pero gran cambio para preservar el medio ambiente
                    y que mejor que disfrutando de nuestros deliciosos platillos. ¡Bienvenido!
                </p>
                <?php 
                if (!isset($_SESSION['ID_PerfilCliente'])) {
                    echo "<a class='btn btn-outline-ecolunch btn-xl js-scroll-trigger text-white' data-toggle='modal' data-target='#portfolioModal6'>Ingresar</a>";
                }
                
                ?>
                
            </div>
        </div>
    </div>
</header>
<!-- Portfolio Section -->
<section class="page-section portfolio" id="portfolio">
    <div class="container">
        <!-- Portfolio Section Heading -->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">
            La carta
        </h2>

        <!-- Icon Divider -->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="divider-custom-line"></div>
        </div>

        <!-- Portfolio Grid Items -->
        <div class="row">
            <!-- Portfolio Item 1 -->
            <div class="col-md-6 col-lg-3 col-xs-12">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1">
                    <div class="card">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="<?php echo base_url('assets/landing/img/plato3.jpg') ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Menú del día</h5>
                            <p class="card-text">
                                Some quick example text to build on the card title and make
                                up the bulk of the card's content.

                            </p>
                            <div class="card-footer text-right">
                                <?php
                                if ($precios) {
                                    foreach ($precios->result() as $aux) {
                                        echo "<button class='btn btn-outline-ecolunch'>S/ " . $aux->PrecioDelivery1 . " Soles</button>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Portfolio Item 2 -->

            <div class="col-md-6 col-lg-3 col-xs-12">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1">
                    <div class="card" style="">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="<?php echo base_url('assets/landing/img/plato4.jpg') ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Opciones light</h5>
                            <p class="card-text">
                                Arma tu plato puedes elegir: ensalada, proteína, guarnición y tu bebida
                            </p>
                            <div class="card-footer text-right">
                                <?php
                                if ($precios) {
                                    foreach ($precios->result() as $aux) {
                                        echo "<button class='btn btn-outline-ecolunch'>S/ " . $aux->PrecioDelivery2 . " Soles</button>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Portfolio Item 3 -->
            <div class="col-md-6 col-lg-3 col-xs-12">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1">
                    <div class="card" style="">
                        <div class="portfolio-item-caption  d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="<?php echo base_url('assets/landing/img/plato2.jpg') ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Sopas</h5>
                            <p class="card-text">
                                Some quick example text to build on the card title and make
                                up the bulk of the card's content.
                            </p>
                            <div class="card-footer text-right">
                                <?php
                                if ($precios) {
                                    foreach ($precios->result() as $aux) {
                                        echo "<button class='btn btn-outline-ecolunch'>S/ " . $aux->PrecioSopaDelivery . " Soles</button>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Portfolio Item 4 -->

            <div class="col-md-6 col-lg-3 col-xs-12">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal4">
                    <div class="card" style="">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="<?php echo base_url('assets/landing/img/plato5.jpg') ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">A la carta</h5>
                            <p class="card-text">
                                Some quick example text to build on the card title and make
                                up the bulk of the card's content.
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- /.row -->
        </div>
</section>

<!-- About Section -->
<section class="page-section bg-warning text-white mb-0" id="about">
    <div class="container">
        <!-- About Section Heading -->
        <h2 class="page-section-heading text-center text-uppercase text-white">
            Acerca de EcoLunch
        </h2>

        <!-- Icon Divider -->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="divider-custom-line"></div>
        </div>

        <!-- About Section Content -->
        <div class="row">
            <div class="col-lg-4 ml-auto">
                <p class="lead">

                    EcoLunch llegó para que juntos hagamos un pequeño pero gran cambio para preservar el medio ambiente
                    y que mejor que disfrutando de nuestros deliciosos platillos. ¡Bienvenido!
                </p>
            </div>
            <div class="col-lg-4 mr-auto">
                <p class="lead">
                    EcoLunch arrived so that together we can make a small but big change to preserve the environment and
                    what better than enjoying our delicious dishes. You are welcome!
                </p>
            </div>
        </div>

        <!-- About Section Button -->
        <!--  <div class="text-center mt-4">
        <a class="btn btn-xl btn-outline-light" href="https://startbootstrap.com/themes/freelancer/">
          <i class="fas fa-book mr-2"></i>
          Ordenar
        </a>
      </div> -->
    </div>
</section>

<!-- Contact Section -->
<section class="page-section" id="pedido">
    <div class="container">
        <!-- Contact Section Heading -->
        <h4 class="page-section-heading text-center text-uppercase text-secondary mb-0">
            Mis Pedidos
        </h4>


    <?php
    if(isset($pedidoCliente)){
        echo "<table class='table table-bordered mt-3'>
            <thead>
              <tr>
              <th scope='col'>Tipo</th>
                <th scope='col'>Descripcion</th>
                <th scope='col'>Precio</th>
                <th>Estado</th>
                
                
              </tr>
            </thead>
            <tbody>";
        foreach ($pedidoCliente->result() as $aux) {


            if($aux->EsMenuDelivery1==1){
                $tipo="Menu";
            }
            if($aux->Delivery==1){
                $tipo="Carta";
            }
            if($aux->Precio == 0){
                $precio="";
            }
            else{
                $precio=$aux->Precio;
            }
            echo "<tr>
            <td>$tipo</td>
            <td>$aux->Menu</td>
            <td>$precio</td>
            <td>$aux->Estado</td>
            
            </tr>";
        }
    }

    ?>

  </tbody>
</table>



    </div>
</section>

<!-- Footer -->
<footer class="footer  text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location -->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Ubicación</h4>
                <p class="lead mb-0">
                    Mz P1 lt 6 Javier Perez de Cuellar <br />San Bartolo Lima Perú
                </p>
            </div>

            <!-- Footer Social Icons -->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Redes Sociales</h4>
                <a class="btn btn-outline-light btn-social mx-1" target="_blank" href="https://www.facebook.com/EcoLunchDelivery/">
                    <i class="fab fa-fw fa-facebook-f"></i>
                </a>
                <a class="btn btn-outline-light btn-social mx-1" target="_blank" href="https://www.facebook.com/EcoLunchDelivery/">
                    <i class="fab fa-fw fa-twitter"></i>
                </a>

            </div>

            <!-- Footer About Text -->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">Acerca de EcoLunch</h4>
                <p class="lead mb-0">
                    EcoLunch llegó para que juntos hagamos un pequeño pero gran cambio para preservar el medio ambiente
                    y que mejor que disfrutando de nuestros deliciosos platillos. ¡Bienvenidos!
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Copyright Section -->
<section class="copyright py-4 text-center text-white">
    <div class="container">
        <small>Copyright &copy; EcoLunch 2019</small>
    </div>
</section>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- Portfolio Modals -->

<!-- Portfolio Modal 1 -->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fas fa-times"></i>
                </span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title -->
                            <h2 class=" text-secondary text-uppercase mb-0">
                                Menú del día
                            </h2>
                            <!-- Icon Divider -->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image -->

                            <!-- Portfolio Modal - Text -->
                            <form action="<?php echo base_url('Pedido/pedidodelivery') ?>" method="POST">
                            <?php if(isset($existePedidoDelivery)){
                                foreach($existePedidoDelivery->result() as $row){
                                    echo "<input type='hidden' name='ID_PedidoDelivery' value='$row->ID_Pedido' >";
                                }
                            } ?>
                                <h3>Entradas</h3>
                                <div class="row" id="cambiar">
                                    <?php
                                    if ($menuDeliveryentrada) {
                                        foreach ($menuDeliveryentrada->result() as $aux) {
                                            echo "<div class='col-lg-4 col-md-4 col-xs-12 p-1'>
                                                    <div class='card'>
                                                        <img src='$aux->ImagenMenu' class='card-img-top' alt=''>
                                                        <div class='card-body'>
                                                            <p class='card-title text-primary'><strong>$aux->Menu</strong></p>
                                                            <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                            <input name='entrada'  type='radio' id='entrada' value='$aux->ID_Menu'>
                                                        </div>
                                                    </div>
                                                </div>";
                                        }
                                    }
                                    ?>
                                </div>
                                <h3>Segundo</h3>
                                <div class="row">
                                    <?php
                                    if ($menuDelivery1Segundo) {
                                        foreach ($menuDelivery1Segundo->result() as $aux) {
                                            echo "<div class='col-lg-4 col-md-4 col-xs-12 p-1'>
                                                    <div class='card'>
                                                        <img src='$aux->ImagenMenu' class='card-img-top' alt=''>
                                                        <div class='card-body'>
                                                            <p class='card-title text-primary'><strong>$aux->Menu</strong></p>
                                                            <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                            <input name='segundo' type='radio' id='segundo' value='$aux->ID_Menu'>
                                                        </div>
                                                    </div>
                                                </div>";
                                        }
                                    }
                                    ?>
                                </div>
                                <h3>Bebida</h3>
                                <div class="row">
                                    <?php
                                    if ($menuDelivery1Bebida) {
                                        foreach ($menuDelivery1Bebida->result() as $aux) {
                                            echo "<div class='col-lg-4 col-md-4 col-xs-12 p-1'>
                                                    <div class='card'>
                                                        <img src='$aux->ImagenMenu' class='card-img-top' alt=''>
                                                        <div class='card-body'>
                                                            <p class='card-title text-primary'><strong>$aux->Menu</strong></p>
                                                            <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                            <input name='bebida' type='radio' id='bebida' value='$aux->ID_Menu'>
                                                        </div>
                                                    </div>
                                                </div>";
                                        }
                                    }
                                    ?>


                                </div>

                                <?php
                                    if (isset($_SESSION['ID_PerfilCliente'])) {
                                        $ID_Perfil = desencriptar($_SESSION['ID_PerfilCliente']);
                                        $ID_Cliente = desencriptar($_SESSION['ID_Cliente']);
                                        echo "<div class='pt-3'>
                                            <input type='hidden' value='$ID_Cliente' name='ID_Cliente'>
                                            <input class='btn btn-outline-warning' value='Ordenar' type='submit'>
                                            </div>";
                                    }else{
                                        echo "<div class='alert m-4 alert-warning alert-dismissible fade show' role='alert'>
                                         Para comenzar a ordenar inicia sesión.

                                      </div>";
                                    }
                                ?>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Modal 2 -->
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-labelledby="portfolioModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fas fa-times"></i>
                </span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title -->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">
                                Tasty Cake
                            </h2>
                            <!-- Icon Divider -->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image -->
                            <img class="img-fluid rounded mb-5" src="img/portfolio/cake.png" alt="" />
                            <!-- Portfolio Modal - Text -->
                            <p class="mb-5">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Mollitia neque assumenda ipsam nihil, molestias magnam,
                                recusandae quos quis inventore quisquam velit asperiores,
                                vitae? Reprehenderit soluta, eos quod consequuntur itaque.
                                Nam.
                            </p>
                            <button class="btn btn-success" href="#" data-dismiss="modal">
                                <i class="fas fa-times fa-fw"></i>
                                Close Window
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Modal 3 -->
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-labelledby="portfolioModal3Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fas fa-times"></i>
                </span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title -->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">
                                Circus Tent
                            </h2>
                            <!-- Icon Divider -->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image -->
                            <img class="img-fluid rounded mb-5" src="img/portfolio/circus.png" alt="" />
                            <!-- Portfolio Modal - Text -->
                            <p class="mb-5">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Mollitia neque assumenda ipsam nihil, molestias magnam,
                                recusandae quos quis inventore quisquam velit asperiores,
                                vitae? Reprehenderit soluta, eos quod consequuntur itaque.
                                Nam.
                            </p>
                            <button class="btn btn-primary" href="#" data-dismiss="modal">
                                <i class="fas fa-times fa-fw"></i>
                                Close Window
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Modal 4 plato a la carta-->
<div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fas fa-times"></i>
                </span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title -->
                            <h2 class=" text-secondary text-uppercase mb-0">
                                Plato a la carta
                            </h2>
                            <!-- Icon Divider -->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image -->

                            <!-- Portfolio Modal - Text -->
                            <h3>Plato</h3>
                            <form action="<?php echo base_url('Pedido/pedidoPlatoCarta') ?>" method="POST">
                            <?php if(isset($existePedidoDelivery)){
                                foreach($existePedidoDelivery->result() as $row){
                                    echo "<input type='hidden' name='ID_PedidoDelivery' value='$row->ID_Pedido' >";
                                }
                            } ?>
                                <div class="row" id="cambiar">
                                    <?php
                                    if ($platocarta) {
                                        foreach ($platocarta->result() as $aux) {
                                            echo "<div class='col-lg-4 col-md-4 col-xs-12 p-1'>
                                                        <div class='card'>
                                                            <img src='$aux->ImagenMenu' class='card-img-top' alt=''>
                                                            <div class='card-body'>
                                                                <p class='card-title text-primary'><strong>$aux->Menu</strong></p>
                                                                <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                                <input name='carta'  type='radio' id='carta' value='$aux->ID_Menu'>
                                                            </div>
                                                            <div class='card-footer text-right'>
                                                                <button class='btn btn-outline-primary disabled' type='button'>S/ $aux->Precio</button>
                                                            </div>
                                                        </div>
                                                    </div>";
                                        }
                                    }
                                    ?>

                                </div>

                                <?php
                                    if (isset($_SESSION['ID_PerfilCliente'])) {
                                        $ID_Perfil = desencriptar($_SESSION['ID_PerfilCliente']);
                                        echo "<div class='pt-3'>
                                                <input type='hidden' value='$ID_Cliente' name='ID_Cliente'>
                                                <input class='btn btn-outline-warning' value='Ordenar' type='submit'>
                                            </div>";
                                    }else{
                                        echo "<div class='alert m-4 alert-warning alert-dismissible fade show' role='alert'>
                                         Para comenzar a ordenar inicia sesión.

                                      </div>";
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Modal 5 registrarse-->
<div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-labelledby="portfolioModal5Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fas fa-times"></i>
                </span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="container">
                            <!-- Contact Section Heading -->
                            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">
                                Regístrate
                            </h2>

                            <!-- Icon Divider -->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="divider-custom-line"></div>
                            </div>

                            <!-- Contact Section Form -->
                            <div class="">

                                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                                <form name="sentMessage" action="<?php echo base_url('UsuarioClienteDelivery/actualizarCliente') ?>" method="POST" id="frm">
                                    <input type='hidden' name='Insertar' value="<?php echo $Insertar; ?>">
                                    <div class="row">
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Nombre</label>
                                                <input class="form-control" name="nombre" id="nombre" type="text" required />

                                            </div>
                                        </div>
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Apellido Paterno</label>
                                                <input class="form-control" name="apellidopaterno" id="apellidopaterno" type="text" required />

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Apellido Materno</label>
                                                <input class="form-control" name="apellidomaterno" id="apellidomaterno" type="text" required />

                                            </div>
                                        </div>
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" placeholder="fecha de nacimiento">

                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Email</label>
                                                <input class="form-control" name="email" id="email" type="email" required />

                                            </div>
                                        </div>
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Telefono</label>
                                                <input class="form-control" name="telefono" id="telefono" type="tel" required />

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Dirección</label>
                                                <input class="form-control" id="direccion" type="text" name="direccion" required />

                                            </div>
                                        </div>
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Distrito</label>
                                                <select class="form-control" name='distrito' id='distrito' required>
                                                    <option value=''>-- Seleccione --</option>
                                                    <?php
                                                    if ($distrito_list) {
                                                        foreach ($distrito_list->result() as $row) {
                                                            echo "<option value='" . $row->Distrito . "' >" . $row->Distrito . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Piso</label>
                                                <input class="form-control" id="piso" name="piso" type="text" name="piso" required />

                                            </div>
                                        </div>
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Empresa</label>
                                                <input class="form-control" id="empresa" type="text" name="empresa" required />

                                            </div>
                                        </div>
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group text-left">
                                                <label>Contraseña</label>
                                                <input class="form-control" id="clave" type="password" name="clave" required />
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>

                                    </div>

                                    <br />
                                    <div id="success"></div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-success btn-md" id="sendMessageButton">
                                            Registrarse
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Modal 6 iniciar sesion -->
<div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-labelledby="portfolioModal5Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fas fa-times"></i>
                </span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="container">
                            <!-- Contact Section Heading -->
                            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">
                                Inicia Sesión
                            </h2>

                            <!-- Icon Divider -->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="divider-custom-line"></div>
                            </div>

                            <!-- Contact Section Form -->
                            <div class="">

                                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                                <form name="sentMessage" action="<?php echo base_url('Login/validaClienteDelivery') ?>" method="POST" id="frm">

                                    <div class="row">
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                                <label>Correo</label>
                                                <input placeholder="Correo" class="form-control" name="correo" id="nombre" type="text" required />

                                            </div>
                                        </div>
                                        <div class="control-group col-lg-6 col-md-6 col-xs-12">
                                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                                <label>Contraseña</label>
                                                <input placeholder="Contraseña" class="form-control" name="clave" id="clave" type="password" required />

                                            </div>
                                        </div>



                                    </div>
                                    <div class="form-group text-center mt-5">
                                        <button type="submit"  class="btn btn-success btn-xl" id="sendMessageButton">
                                            Ingresar
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(documen t).ready(function() {

        $("#ordenar").click(function() {

            var id_entrada = $('input:radio[name=entrada]:checked').val();
            var id_segundo = $('input:radio[name=segundo]:checked').val();
            var id_bebida = $('input:radio[name=bebida]:checked').val();

            orden(id_entrada, id_segundo, id_bebida);

        });

        function orden(id_entrada, id_segundo, id_bebida) {
            var ruta = "<?php echo base_url('Pedido/pedidodelivery'); ?>" + "/" + id_entrada + "/" + id_segundo +
                "/" + id_bebida;
            $.ajax({
                type: "POST",
                url: ruta,
                success: function(data) {
                    $("input:radio").attr("checked", false);

                    alert("Pedido con exito");
                },
                fail: function() {
                    alert("error");
                }
            })
        }
    });
</script>