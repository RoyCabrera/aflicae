<aside class="aside-container">
	<!-- START Sidebar (left)-->
	<div class="aside-inner">
		<nav class="sidebar" data-sidebar-anyclick-close>
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
					<?php
					$ID_Perfil =desencriptar($_SESSION['ID_Perfil']);
					if($ID_Perfil==1){
						echo "<li class=' ' id='t_admin' >
						<a href='".base_url('Admin')."' title='Panel de Inicio' >
							<em class='icon-speedometer'></em>
							<span data-localize='sidebar.nav.DASHBOARD'>Panel de Inicio</span>
						</a>
					</li>";

					}
				//MAESTROS
				if($ID_Perfil==1){
						echo "<li class='m_maestros' >
						<a href='#m_maestros' title='Maestros' data-toggle='collapse'>
							<em class='icon-grid'></em>
							<span data-localize='sidebar.nav.element.Maestros'>Mantenimiento</span>
						</a>
						<ul class='sidebar-nav sidebar-subnav collapse' id='m_maestros' >
							<li class='sidebar-subnav-header'>Mantenimiento</li>

							<li class=' ' id='m_usuario' style='margin-left: 30px;' >
								<a href='".base_url('Usuario')."' title='Usuarios' >
									<em class='icon-people'></em>
									<span data-localize='sidebar.nav.USUARIO'>Usuarios</span>
								</a>
							</li>

							

							<li class=' ' id='m_insumo' style='margin-left: 30px;'>
								<a title='Control de productos' href='".base_url('Insumo')." ' >
									<em class='fa fa-lemon-o'></em>
									<span data-localize='sidebar.nav.Insumo'>Productos</span>
								</a>
							</li>

							
							

						</ul>
					</li>";

				}
				// PEDIDO (SUPERADMIN, ADMIN Y MESERO)
				if($ID_Perfil==1 || $ID_Perfil==2 ||  $ID_Perfil==3 || $ID_Perfil==9 ||$ID_Perfil==10){
					echo "<li class='submenu' id='m_pedido'>
						<a title='' href='".base_url('Pedido/venta_aflicae')." ' >
							<em class='fa fa-pencil-square-o'></em>
							<span data-localize='sidebar.nav.Mesa'>Ventas</span>
						</a>
					</li>";
					echo "<li class='submenu' id='m_pedidopendiente'>
						<a title='' href='#' >
							<em class='fas fa-calendar-alt'></em>
							<span data-localize='sidebar.nav.Mesa'>Historial de ventas</span>
						</a>
					</li>";


				


				}
				
					
					//MANUAL DE USUARIO
					if($ID_Perfil==1){

						echo "<li class=' ' id='m_manual'>
						<a title='Compras' href='".base_url('Compra/compra_aflicae')." '>
						<em class='fa fa-book'></em>
						<span data-localize='sidebar.nav.Mesa'>Compras</span>
						</a>
                    </li>";

					}

					?>

			</ul>
			<!-- END sidebar nav-->
		</nav>
	</div>
	<!-- END Sidebar (left)-->
</aside>
