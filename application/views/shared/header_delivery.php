  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light text-uppercase fixed-top " id="mainNav">
    <div class="container">

      <a class="navbar-brand js-scroll-trigger " href="#page-top"><img src="<?php echo base_url('assets/img/ECOLUNCH.png'); ?>" width="50px" alt="App Logo"><span class="m-2" style="font-family:'Comic Sans MS', cursive, sans-serif" class="">ecolunch</span></a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-warning text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3  px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">La carta</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0  px-lg-3 rounded js-scroll-trigger" href="#pedido">Pedido</a>
          </li>



          <?php

          if (isset($_SESSION['ID_PerfilCliente'])) {
            $ID_Perfil = desencriptar($_SESSION['ID_PerfilCliente']);

            if ($ID_Perfil == 7) {
              ?>
              <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0   px-lg-3 rounded js-scroll-trigger" href="#"><?php echo desencriptar($this->session->userdata('Usuario')); ?></a>
              </li>
              <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link py-3 px-0   px-lg-3 rounded js-scroll-trigger" href="<?php echo base_url('Login/logoutClienteDelivery') ?>">Salir</a>
              </li>

            <?php
          }
        } else {
          ?>
            <li class="nav-item mx-0 mx-lg-1" data-toggle="modal" data-target="#portfolioModal6">
              <a class="nav-link py-3 px-0   px-lg-3 rounded js-scroll-trigger" href="#">Ingresar</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1" data-toggle="modal" data-target="#portfolioModal5">
              <a class="nav-link py-3 px-0   px-lg-3 rounded js-scroll-trigger" href="#">Registrarse</a>
            </li>
          <?php
        }
        ?>
        </ul>
      </div>
    </div>
  </nav>