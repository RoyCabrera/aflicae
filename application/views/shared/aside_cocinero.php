<aside class="aside-container">
	<!-- START Sidebar (left)-->
	<div class="aside-inner">
		<nav class="sidebar" data-sidebar-anyclick-close="">
			<!-- START sidebar nav-->
			<ul class="sidebar-nav">
				<!-- START user info-->
				<li class="has-user-block">
					<div>
						<div class="item user-block">
							<!-- User picture-->
							<div class="user-block-picture">
								<div class="user-block-status">
									<img class="img-thumbnail rounded-circle" src="<?php
										$Imagen = base_url('assets/img/nofoto.png');

										if(file_exists(URL_RAIZ.desencriptar($this->session->userdata('Imagen'))) && desencriptar($this->session->userdata('Imagen'))){
											$Imagen = base_url(desencriptar($this->session->userdata('Imagen')));
										}

										echo $Imagen;

									?>" alt="Imagen" width="60" height="60">
									<div class="circle bg-success circle-lg"></div>
								</div>
							</div>
							<!-- Name and Job-->
							<div class="user-block-info">
								<span class="user-block-name"><?php echo desencriptar($this->session->userdata('NombreCompleto')); ?></span>
								<span class="user-block-role"><?php echo desencriptar($this->session->userdata('Perfil')); ?></span>
							</div>
						</div>
					</div>
				</li>
				<!-- END user info-->
				<!-- Iterates over all sidebar items-->

				<li class="nav-heading ">
					<span data-localize="sidebar.heading.COMPONENTS">MENÚ</span>
				</li>


					<li class='submenu' id='m_pedido'>
						<a title='Control de Pedidos' href="<?php echo base_url('Pedido/HoyPedidoDetalle') ?>" >
							<em class='fa fa-pencil-square-o'></em>
							<span data-localize='sidebar.nav.Mesa'>Pedidos</span>
						</a>
					</li>
					<li class='submenu' id='m_pedido2'>
						<a title='Pedidos' href="<?php echo base_url('Pedido/pedidoDetalladoCocinero') ?>" >
							<em class='fa fa-desktop'></em>
							<span data-localize='sidebar.nav.Mesa'>Pedidos detallados</span>
						</a>
					</li>
                    <li class=" " id='m_menu' style="" >
                           <a href="<?php echo base_url('Menu') ?>" title='Platos'>
                           <em class='fa fa-cutlery'></em>
                           <span data-localize='sidebar.nav.Menu'>Platos</span>
                           </a>
                           </li>

                     	   <li class=" " id='m_insumo' style="">
							<a title='Control de Insumo' href="<?php echo base_url('Insumo') ?>" >
							<em class='fa fa-lemon-o'></em>
							<span data-localize='sidebar.nav.Insumo'>Insumo</span>
							</a>
                           </li>


			</ul>
			<!-- END sidebar nav-->
		</nav>
	</div>
	<!-- END Sidebar (left)-->
</aside>
