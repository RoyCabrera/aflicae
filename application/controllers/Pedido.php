<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pedido extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Pedido_model');
		$this->load->model('Mesa_model');
		$this->load->model('Menu_model');
		$this->load->model('Almacen_model');
		/*
		 */
		// estas funciones validadn si la sesion existe
		// si se ocula se trabajara con deliveyry para no causar problema
		sessionExist();
        validaToken();
	}

	public function index($filtro = ""){

		$data = array();
		$data['pedido_list'] = $this->Pedido_model->selectAllHoy();
		$data['pedidodet_list'] = $this->Pedido_model->selectDetalleHoy();
		$data['pedidodetalle_list'] = $this->Pedido_model->selectallDetallePreparado();
		$this->template->load('layout', 'pedido_table', $data);
	}
	public function select_all_pedidos_hoy($filtro = ""){
		$data = array();

		$data['pedido_list'] = $this->Pedido_model->selectAllHoy_Estado();

		$data['pedidodet_list'] = $this->Pedido_model->selectDetalleHoy();
		$data['pedidodetalle_list'] = $this->Pedido_model->selectallDetallePreparado();
		$this->template->load('layout', 'pedido_all_table', $data);
	}

	public function pedidodelivery(){

		$ID_Entrada = $this->input->post('entrada');
		$ID_Segundo = $this->input->post('segundo');
		$ID_Bebida = $this->input->post('bebida');
		$ID_Cliente = $this->input->post('ID_Cliente');
		$ID_Pedido=$this->input->post('ID_PedidoDelivery');

		$ID_Mesa = -1;
		$Observacion = "";
		$ID_Almacen = -1;
		/*---------------------*/

		$Cantidad = 1;
		$ObservacionPlato = "";
		$ID_Estado = 1;
		$ID_Almacen = -1;
		$menu = array(
			'ID_Entrada' => $ID_Entrada,
			'ID_Segundo' => $ID_Segundo,
			'ID_Postre' => $ID_Bebida
		);
		if(!$ID_Pedido){
			$ID_Pedido = $this->Pedido_model->insertarpedidodelivery($ID_Mesa, $Observacion, $ID_Almacen,$ID_Cliente);
		}
		$this->Pedido_model->insertardetalledelivery($ID_Pedido, $menu, $Cantidad, $ObservacionPlato, $ID_Estado, $ID_Almacen);

		redirect('Delivery', 'refresh');
	}

	public function pedidoPlatoCarta(){


		$carta = $this->input->post('carta');
		$ID_Cliente = $this->input->post('ID_Cliente');
		$ID_Pedido=$this->input->post('ID_PedidoDelivery');

		$ID_Mesa = -1;
		$Observacion = "";
		$ID_Almacen = -1;
		/*---------------------*/

		$Cantidad = 1;
		$ObservacionPlato = "";
		$ID_Estado = 1;
		$ID_Almacen = -1;
		$menu = $carta;

		if(!$ID_Pedido){
			$ID_Pedido = $this->Pedido_model->insertarpedidodelivery($ID_Mesa, $Observacion, $ID_Almacen,$ID_Cliente);
		}

		$this->Pedido_model->insertarPlatoCarta($ID_Pedido, $menu, $Cantidad, $ObservacionPlato, $ID_Estado, $ID_Almacen);

		redirect('Delivery', 'refresh');
	}


	public function selectAll($filtro = ""){
		$data = array();
		$data['pedido_list'] = $this->Pedido_model->selectAll();
		$this->template->load('layout', 'pedido_table', $data);
	}

	public function nuevo(){
		$data = array();

		$aux = (object)array(
			'ID_Pedido' => '',
			'ID_Mesa' => 0,
			'Observacion' => ''
		);

		$data['pedido'] = $aux;
		$data['mesa_list'] = $this->Mesa_model->selectAll();
		$this->template->load('layout', 'pedido_data', $data);
	}

	public function pedido($ID_Pedido)
	{

		$data = array();
		$ID = desencriptar($ID_Pedido);
		$data['pedido'] = $this->Pedido_model->select($ID);
		$data['mesa_list'] = $this->Mesa_model->selectAll();

		$this->template->load('layout', 'pedido_data', $data);
	}

 	public function actualizar()
	{

		$ID_Pedido = desencriptar($this->input->post('ID_Pedido'));
		$ID_Mesa = $this->input->post('ID_Mesa');
		$Observacion = $this->input->post('Observacion');
		$ID_Almacen = $this->input->post('ID_Almacen');

		if ($ID_Pedido == "") {

			$this->session->set_userdata('success', 'El Pedido se registró correctamente');
			insertarLog("Registró el Pedido " . $ID_Pedido);
			$ID_Pedido = $this->Pedido_model->insertar($ID_Mesa, $Observacion, $ID_Almacen);
			$this->Mesa_model->PedidoNow($ID_Pedido, $ID_Mesa);//actualizar el panel de mesas con el nuevo pedido

		} else {
			$this->session->set_userdata('success', 'El Pedido se actualizó correctamente');
			insertarLog("Actualizó el Pedido " . $ID_Pedido);
			$this->Pedido_model->actualizar($ID_Mesa, $ID_Pedido, $Observacion, $ID_Almacen);
			redirect('Pedido');
		}
		//redirect('Pedido/posicionMesa/'.$ID_Pedido);
		redirect('Pedido/nuevodetalle/' .  $ID_Pedido);
	}

	public function posicionMesa($ID_Pedido){

		$data=array();
		//$data['allpedido_detalle']=$this->Pedido_model->selectAllDetalle();
		$data['ID_Pedido']=$ID_Pedido;
		$this->template->load('layout', 'mesa_pedido_plano', $data);
	}

	public function nuevoDesdePanelMesa($ID_Mesa){

		$Observacion = "";
		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
		$ID_Pedido = $this->Pedido_model->insertar($ID_Mesa, $Observacion, $ID_Almacen);
		$this->Mesa_model->PedidoNow($ID_Pedido, $ID_Mesa);
		redirect('Pedido/nuevodetalle/' . $ID_Pedido);
	}

	public function eliminar($ID_Pedido, $ID_Mesa)
	{

		if (!$ID_Pedido) {
			show_404();
			return;
		}

		$eliminar = $this->Pedido_model->eliminar(desencriptar($ID_Pedido));

		if ($eliminar) {
			$this->Mesa_model->mesaVacia($ID_Mesa);
			$_SESSION['eliminado'] = 'Este item se eliminó correctamente';
			redirect('Pedido', 'refresh');
		}
	}

	public function detalle($ID_Pedido){

		$data = array();
		$ID = desencriptar($ID_Pedido);

		$data['pedidodetalle_list'] = $this->Pedido_model->selectDetalle($ID);

		$data['ID_Pedido'] = $ID;
		$this->template->load('layout', 'pedidodetalle_table', $data);
	}

	public function detallePosicion($ID_Pedido,$Posicion){

		$data = array();
		$ID = $ID_Pedido;
		$data['pedidodetalle_list'] = $this->Pedido_model->selectDetallePosicion($ID,$Posicion);
		$data['ID_Pedido'] = $ID;
		$data['Posicion'] = $Posicion;
		$this->template->load('layout', 'pedidodetalle_table', $data);
	}

	public function pedidodetalle($ID){
		$data = array();
		$ID_LPedido = desencriptar($ID);

		$data['pedidodetalle'] = $this->Pedido_model->selectMenuDetalle($ID_LPedido);
		// OBTENER PLATOS POR TIPO
		/* $data['entrada_list']= $this->Menu_model->selectAllEntrada();
		$data['segundo_list']= $this->Menu_model->selectAllSegundo();
		$data['postre_list']= $this->Menu_model->selectAllPostre(); */
		// OBTENER TODOS LOS PLATOS
		$data['menu_list'] = $this->Menu_model->selectAllMenu();
		//OBTENER ALAMCENES
		$data['almacen_list'] = $this->Almacen_model->selectAll();

		$this->template->load('layout', 'pedidodetalle_data', $data);
	}

	public function nuevodetalle($ID_Pedido){
		$data = array();

		$detalle = (object)array(
			//'Posicion'=>$Posicion,
			'ID_Pedido' => $ID_Pedido,
			'ID_LPedido' => '',
			'ID_Menu' => 0,
			'ID_Estado' => 1,
			'ID_Almacen' => 0,
			'Cantidad' => 1,
			'Observacion' => ''
		);
		//$data['Posicion']=$Posicion;
		$data['pedidodetalle'] = $detalle;
		$data['menu_list'] = $this->Menu_model->selectAllMenu();
		$data['almacen_list'] = $this->Almacen_model->selectAll();

		$this->template->load('layout', 'pedidodetalle_data', $data);
	}

	public function Posicion($Posicion,$ID_Pedido){
		$ID_Pedido= $this->input->post('ID_Pedido');
		$Posicion = $this->input->post('Posicion');

		$this->nuevodetalle_posicion($ID_Pedido,$Posicion);

	}

	public function nuevodetalle_posicion($ID_Pedido,$Posicion){
		$data = array();

		$detalle = (object)array(
			'Posicion' =>$Posicion,
			'ID_Pedido' => $ID_Pedido,
			'ID_LPedido' => '',
			'ID_Menu' => 0,
			'ID_Estado' => 1,
			'ID_Almacen' => 0,
			'Cantidad' => 1,
			'Observacion' => ''
		);

		$data['pedidodetalle'] = $detalle;
		$data['Posicion']=$Posicion;
		$data['menu_list'] = $this->Menu_model->selectAllMenu();
		$data['almacen_list'] = $this->Almacen_model->selectAll();

		$this->template->load('layout', 'pedidodetalle_data', $data);
	}

	public function actualizardetalle() {
	

		$ID_Pedido = desencriptar($this->input->post('ID_Pedido'));
		$ID_LPedido = desencriptar($this->input->post('ID_LPedido'));
		$ID_Estado = desencriptar($this->input->post('ID_Estado'));
		//$Posicion = $this->input->post('Posicion');
		$ID_Entrada = $this->input->post('ID_Entrada');
		$ID_Segundo = $this->input->post('ID_Segundo');
		$ID_Postre = $this->input->post('ID_Postre');

		$menu = array(
			'ID_Entrada' => $ID_Entrada,
			'ID_Segundo' => $ID_Segundo,
			'ID_Postre' => $ID_Postre,

		);

		$ID_Almacen = ($this->input->post('ID_Almacen'));
		$Cantidad = $this->input->post('Cantidad');
		//$ID_Menu = $this->input->post('ID_Menu');
		$Observacion = $this->input->post('Observacion');



		if ($ID_LPedido == "") {
			$this->session->set_userdata('success', 'El Pedido se registró correctamente');
			insertarLog("Registró el Pedido " . $ID_Pedido);
			$this->Pedido_model->insertardetalle($ID_Pedido, $menu, $Cantidad, $Observacion, $ID_Estado, $ID_Almacen);
		} else {
			$this->session->set_userdata('success', 'El Pedido se actualizó correctamente');
			insertarLog("Actualizó el Pedido " . $ID_Pedido);
			$this->Pedido_model->actualizardetalle($ID_LPedido, $ID_Pedido, $menu, $Cantidad, $Observacion, $ID_Almacen);
		}

		/* $nuevaPosicion=$Posicion+1;
		if($nuevaPosicion > 4){
			redirect('Pedido/posicionMesa/' . $ID_Pedido);
		} */

	//	redirect('Pedido/nuevodetalle/' . $ID_Pedido);
		redirect('Pedido');
	}

	public function ObtenerPrecio($ID_Plato) {

		$precio = $this->Menu_model->select($ID_Plato);
		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
		foreach ($precio->result() as $row) {

			return $row->Precio;
		}
	}

	public function eliminardetalle($ID_LPedido, $ID_Pedido){

		if (!$ID_LPedido) {
			show_404();
			return;
		}
		$eliminar = $this->Pedido_model->eliminardetalle(desencriptar($ID_LPedido));

		if ($eliminar) {
			$_SESSION['eliminado'] = 'Este item se eliminó correctamente';
			redirect('Pedido/detalle/' . $ID_Pedido, 'refresh');
		}
	}

	public function eliminardetalleDesdePlano($ID_LPedido, $ID_Pedido) {

		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);

		if (!$ID_LPedido) {
			show_404();
			return;
		}
		$eliminar = $this->Pedido_model->eliminardetalle(desencriptar($ID_LPedido));

		if ($eliminar) {
			$_SESSION['eliminado'] = 'Este item se eliminó correctamente';
			redirect('Mesa/plano/' . $ID_Almacen, 'refresh');
		}
	}

	public function estado(){

		$ID_Menu = $this->input->post('menu');
		$ID_TLPedido = desencriptar($this->input->post('id'));
		$ID_Pedido = encriptar($this->input->post('idpedido'));
		$ID_Almacen = $this->input->post('id_almacen');
		$Cantidad = $this->input->post('cantidad');

		$this->Pedido_model->estadodetalleaPreparado($ID_TLPedido);

		if ($this->Pedido_model->existeDetalleEnPendiente($ID_Pedido)) {
			$this->Pedido_model->estadoPedidoEnPreparacion($ID_Pedido);
		} else {
			$this->Pedido_model->estadoPedidoAPreparado($ID_Pedido);
		}


		$this->Pedido_model->insertarsalida($ID_Menu, $ID_Almacen, $Cantidad);

		$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);
		if ($ID_Perfil == 4) {
			redirect(base_url('Pedido/HoyPedidoDetalle'));
		} else {
			redirect(base_url('Pedido/detalle/' . $ID_Pedido));
		}
	}

	public function cocinar() {
		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
		$ID_Menu = $this->input->post('plato');
		$ID_Pedido = encriptar($this->input->post('ID_Pedido'));
		$Cantidad = $this->input->post('cantidad');
		//echo $ID_Almacen."----".$ID_Menu."----".$ID_Pedido."----".$Cantidad;
		$this->Pedido_model->estadodetalleaPreparadoCocinero($ID_Pedido,$ID_Menu);

		if ($this->Pedido_model->existeDetalleEnPendiente($ID_Pedido)) {
			$this->Pedido_model->estadoPedidoEnPreparacion($ID_Pedido);
		} else {
			$this->Pedido_model->estadoPedidoAPreparado($ID_Pedido);
		}

		$this->Pedido_model->insertarsalida($ID_Menu, $ID_Almacen, $Cantidad);

		redirect(base_url('Pedido/pedidoDetalladoCocinero'));


	}

	public function HoyPedidoDetalle(){
		$data = array();

		$data['allpedido_detalle'] = $this->Pedido_model->HoyPedidoDetalle();
		//$data['entradascocinero'] = $this->Pedido_model->selectEntradasCocinero();
		$this->template->load('layout', 'allpedidodetalle_table', $data);
	}

	public function pedidoDetalladoCocinero(){
		$data = array();
		$data['entradascocinero'] = $this->Pedido_model->selectEntradasCocinero();
		$data['segundoscocinero'] = $this->Pedido_model->selectSegundosCocinero();
		$data['bebidascocinero'] = $this->Pedido_model->selectBebidasCocinero();
		$data['cartacocinero'] = $this->Pedido_model->selectCartaCocinero();
		$data['SelectDiezUltimos']=$this->Pedido_model->SelectDiezUltimos();

		$data['entradasDelivery'] = $this->Pedido_model->selectEntradasCocineroDelivery();
		$data['segundosDelivery'] = $this->Pedido_model->selectSegundosCocineroDelivery();
		$data['bebidasDelivery']=$this->Pedido_model->selectBebidasCocineroDelivery();
		$data['cartaDelivery'] = $this->Pedido_model->selectCartaCocineroDelivery();

		$data['numeroFilas'] = $this->Pedido_model->notificacionDelivery();
		$this->template->load('layout', 'pedidococinero_table', $data);
	}

	// NOTIFICACIÓN DELIVERY
	public function notificacionDelivery() {
		$noti = $this->Pedido_model->notificacionDelivery();
		echo "<span class='badge badge-warning'>$noti</span>";
	}
	/****************PEDIDO REALTIME*********************** */
	public function realTimeEntrada(){
		date_default_timezone_set('America/Lima');
		$entradascocinero = $this->Pedido_model->selectEntradasCocinero();
		$numerofilasEntradasLocal=$entradascocinero->num_rows();
				if($numerofilasEntradasLocal == 0){
					echo "<div class='col-md-4 text-muted text-center'>
					<h4>No hay entradas pendientes</h4>
					</div>
					";
				}
					if(isset($entradascocinero)){
						$menu="xxx";
						foreach($entradascocinero->result() as $aux){
							if($aux->Menu!=$menu)
							{
							echo "<div class='col-md-12'>
									<div class='card bg-info border-0'>
									<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
									<div class='card-header'>
										<div class='row align-items-center'>

										<div class='col-12'>
											<h1 class='text-lg text-center'><span id='total$aux->ID_Menu' > </span>  </h1>
										</div>
										<div class='col-12'>
										<div class='list-group'>";

										$total=0;
										foreach($entradascocinero->result() as $aux2){
											if($aux2->Menu==$aux->Menu)
											{

										echo "

										<a class='list-group-item' href='#'>
										<form action='".base_url('Pedido/cocinar/')."' method='POST'>

										<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
										<input type='hidden' name='cantidad' value='$aux2->total'>
										<input type='hidden' name='plato' value='$aux2->ID_Menu'>
										<input type='submit' value='$aux2->total Entrada' class='btn btn-success btn-xs float-right' >
										</form>
										<div class='text-danger'>".date_format(date_create($aux2->FechaHora), 'H:i:s')."</div>

											$aux2->Mesa
										</a>";
										$total=$total+$aux2->total;
											}
										}

										echo "<script> $('#total$aux->ID_Menu').text($total);</script> ";

											echo "</div>
												</div>

											</div>

											</div>


										</div>
									</div>
									";

							}
							$menu=$aux->Menu;

						}



						}


	}

	public function realTimeSegundo() {
		date_default_timezone_set('America/Lima');
		$segundoscocinero= $this->Pedido_model->selectSegundosCocinero();
		$numerofilasSegundosLocal=$segundoscocinero->num_rows();
			if($numerofilasSegundosLocal == 0){
				echo "<div class='col-md-4 text-muted text-center'>
				<h4>No hay segundos pendientes</h4>
				</div>
				";
			}
		if(isset($segundoscocinero)){

			$menu="xxx";

			foreach($segundoscocinero->result() as $aux){
				if($aux->Menu!=$menu) {
				echo "<div class='col-md-12'>
						<div class='card bg-success border-0'>
						<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
						<div class='card-header'>
							<div class='row align-items-center'>

							<div class='col-12'>
								<h1 class='text-lg text-center'><span id='total$aux->ID_Menu' > </span>  </h1>
							</div>
							<div class='col-12'>
							<div class='list-group'>";

							$total=0;
							foreach($segundoscocinero->result() as $aux2){
								if($aux2->Menu==$aux->Menu)
								{

											echo "
											<a class='list-group-item' href='#'>
											<form action='".base_url('Pedido/cocinar/')."' method='POST'>

											<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
											<input type='hidden' name='cantidad' value='$aux2->total'>
											<input type='hidden' name='plato' value='$aux2->ID_Menu'>
											<input type='submit' value='$aux2->total Segundo' class='btn btn-success btn-xs float-right' >
											</form>
											<div class='text-danger'>".date_format(date_create($aux2->FechaHora), 'H:i:s')."</div>

												$aux2->Mesa
											</a>";
											$total=$total+$aux2->total;
								}
							}

							echo "<script> $('#total$aux->ID_Menu').text($total);</script> ";

								echo "</div>
									</div>

								</div>

								</div>


							</div>
						</div>
						";

				}
				$menu=$aux->Menu;

			}



			}
	}

	public function realTimeBebida() {
		date_default_timezone_set('America/Lima');
		$bebidascocinero= $this->Pedido_model->selectBebidasCocinero();
		$numerofilasBebidasLocal=$bebidascocinero->num_rows();
		if($numerofilasBebidasLocal == 0){
			echo "<div class='col-md-4 text-muted text-center'>
			<h4>No hay bebidas pendientes</h4>
			</div>
			";
		}
		if(isset($bebidascocinero)){

						$menu="xxx";

						foreach($bebidascocinero->result() as $aux){
							if($aux->Menu!=$menu)
							{

							echo "<div class='col-md-12'>
									<div class='card bg-purple border-0'>
									<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
									<div class='card-header'>
										<div class='row align-items-center'>

										<div class='col-12'>
											<h1 class='text-lg text-center'><span id='total$aux->ID_Menu' > </span>  </h1>
										</div>
										<div class='col-12'>
										<div class='list-group'>";

										$total=0;
										foreach($bebidascocinero->result() as $aux2){
											if($aux2->Menu==$aux->Menu)
											{

										echo "<a class='list-group-item' href='#'>
										<form action='".base_url('Pedido/cocinar/')."' method='POST'>

										<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
										<input type='hidden' name='cantidad' value='$aux2->total'>
										<input type='hidden' name='plato' value='$aux2->ID_Menu'>
										<input type='submit' value='$aux2->total Bebida' class='btn btn-success btn-xs float-right' >
										</form>
										<div class='text-danger'>".date_format(date_create($aux2->FechaHora), 'H:i:s')."</div>

												$aux2->Mesa
											</a>";
												$total=$total+$aux2->total;
											}
										}

										echo "<script> $('#total$aux->ID_Menu').text($total);</script> ";

											echo "</div>
												</div>

											</div>

											</div>


										</div>
									</div>
									";

							}
							$menu=$aux->Menu;

						}



						}

	}

	public function realTimeCarta() {
		date_default_timezone_set('America/Lima');
		$cartacocinero= $this->Pedido_model->selectCartaCocinero();
		$numerofilasCartaLocal=$cartacocinero->num_rows();
							if($numerofilasCartaLocal == 0){
								echo "<div class='col-md-4 text-muted text-center'>
								<h4>No hay platos carta pendientes</h4>
								</div>
								";
							}
									if(isset($cartacocinero)){

										$menu_carta="xxx";

										foreach($cartacocinero->result() as $aux){
											if($aux->Menu != $menu_carta) {
											echo "

												<div class='col-12'>
												<div class='card bg-yellow border-0'>
												<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
												<div class='card-header'>
													<div class='row align-items-center'>

													<div class='col-12'>
														<h1 class='text-lg text-center'><span id='total$aux->ID_Menu' > </span>  </h1>
													</div>
													<div class='col-12'>
													<div class='list-group'>";

													$total_cocinero=0;
													foreach($cartacocinero->result() as $aux2){
														if($aux2->Menu==$aux->Menu)
														{

															echo "
																<a class='list-group-item' href='#'>

																	<form action='".base_url('Pedido/cocinar/')."' method='POST'>

																	<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
																	<input type='hidden' name='cantidad' value='$aux2->total'>
																	<input type='hidden' name='plato' value='$aux2->ID_Menu'>
																	<input type='submit' value='$aux2->total Bebida' class='btn btn-success btn-xs float-right' >
																	</form>
																	<div class='text-danger'>".date_format(date_create($aux2->FechaHora), 'H:i:s')."</div>

																	$aux2->Mesa
																</a>";
																$total_cocinero=$total_cocinero+$aux2->total;
														}
													}
													echo "<script> $('#total$aux->ID_Menu').text($total_cocinero);</script> ";
														echo "</div>
															</div>
														</div>
														</div>

													</div>
												</div>";
											}
											$menu_carta=$aux->Menu;
										}
									}
	}

	/****************DELIVERY REALTIME*********************** */
	public function realTimeEntradaDelivery(){
		date_default_timezone_set('America/Lima');
		$entradasDelivery=$this->Pedido_model->selectEntradasCocineroDelivery();
		$numerofilasEntradas=$entradasDelivery->num_rows();
			if($numerofilasEntradas == 0){
				
				echo "<div class='col-md-4 text-muted text-center'>
				<h4>No hay entradas pendientes</h4>
				</div>
				";
			}
		if(isset($entradasDelivery)){
			$menu="xxx";
			foreach($entradasDelivery->result() as $aux){
				if($aux->Menu!=$menu) {
				echo "<div class='col-md-12'>
						<div class='card bg-info border-0'>
						<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
						<div class='card-header'>
							<div class='row align-items-center'>

							<div class='col-12'>
								<h1 class='text-lg text-center'><span id='totalentradaDelivery$aux->ID_Menu' > </span>  </h1>
							</div>
							<div class='col-12'>";

							$totalED=0;
							foreach($entradasDelivery->result() as $aux2){
								if($aux2->Menu==$aux->Menu)
								{

									echo "
											<form action='".base_url('Pedido/cocinar/')."' method='POST'>
											<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
											<input type='hidden' name='cantidad' value='' id='totalentradaDeliveryR$aux2->ID_Menu'>
											<input type='hidden' name='plato' value='$aux2->ID_Menu'>
											<input type='submit' value='Cocinar' class='btn btn-success btn-block float-right' >
											</form>";
										$totalED=$totalED+$aux2->total;
								}
							}
							echo "<script> $('#totalentradaDeliveryR$aux->ID_Menu').val($totalED);</script> ";
							echo "<script> $('#totalentradaDelivery$aux->ID_Menu').text($totalED);</script> ";
								echo "
									</div>
								</div>
								</div>

							</div>
						</div>
						";
				}
				$menu=$aux->Menu;
			}
		}
	}

	public function realTimesegundoDelivery(){
		date_default_timezone_set('America/Lima');
		$segundosDelivery=$this->Pedido_model->selectSegundosCocineroDelivery();
		$numerofilasSegundo=$segundosDelivery->num_rows();
			if($numerofilasSegundo == 0){
				echo "<div class='col-md-4 text-muted text-center'>
				<h4>No hay segundos pendientes</h4>
				</div>
				";
			}
		if(isset($segundosDelivery)){
			$menu="xxx";
			foreach($segundosDelivery->result() as $aux){
				if($aux->Menu!=$menu) {
				echo "<div class='col-md-12'>
						<div class='card bg-inverse border-0'>
						<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
						<div class='card-header'>
							<div class='row align-items-center'>

							<div class='col-12'>
								<h1 class='text-lg text-center'><span id='totalsegundoDelivery$aux->ID_Menu' > </span>  </h1>
							</div>
							<div class='col-12'>";

							$totalSD=0;
							foreach($segundosDelivery->result() as $aux2){
								if($aux2->Menu==$aux->Menu)
								{

									echo "


											<form action='".base_url('Pedido/cocinar/')."' method='POST'>

											<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
											<input type='hidden' name='cantidad' value='' id='totalsegundoDeliveryR$aux2->ID_Menu'>
											<input type='hidden' name='plato' value='$aux2->ID_Menu'>
											<input type='submit' value='Cocinar' class='btn btn-success btn-block float-right' >
											</form>

										";
										$totalSD=$totalSD+$aux2->total;
								}
							}
							echo "<script> $('#totalsegundoDeliveryR$aux->ID_Menu').val($totalSD);</script> ";
							echo "<script> $('#totalsegundoDelivery$aux->ID_Menu').text($totalSD);</script> ";
								echo "
									</div>
								</div>
								</div>

							</div>
						</div>
						";
				}
				$menu=$aux->Menu;
			}
		}
	}

	public function realTimeBebidaDelivery(){
		date_default_timezone_set('America/Lima');
		$bebidasDelivery=$this->Pedido_model->selectBebidasCocineroDelivery();
		$numerofilasBebida=$bebidasDelivery->num_rows();
				if($numerofilasBebida == 0){
					echo "<div class='col-md-4 text-muted text-center'>
					<h4>No hay bebidas pendientes</h4>
					</div>
					";
				}
		if(isset($bebidasDelivery)){
			$menu="xxx";
			foreach($bebidasDelivery->result() as $aux){
				if($aux->Menu!=$menu) {
				echo "<div class='col-md-12'>
						<div class='card bg-purple border-0'>
						<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
						<div class='card-header'>
							<div class='row align-items-center'>

							<div class='col-12'>
								<h1 class='text-lg text-center'><span id='totalBebidaDelivery$aux->ID_Menu' > </span>  </h1>
							</div>
							<div class='col-12'>";

							$totalBD=0;
							foreach($bebidasDelivery->result() as $aux2){
								if($aux2->Menu==$aux->Menu)
								{

									echo "

											<form action='".base_url('Pedido/cocinar/')."' method='POST'>

											<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
											<input type='hidden' name='cantidad' value='' id='totalBebidaDeliveryR$aux2->ID_Menu'>
											<input type='hidden' name='plato' value='$aux2->ID_Menu'>
											<input type='submit' value='Cocinar' class='btn btn-success btn-block float-right' >
											</form>";
										$totalBD=$totalBD+$aux2->total;
								}
							}
							echo "<script> $('#totalBebidaDeliveryR$aux->ID_Menu').val($totalBD);</script> ";
							echo "<script> $('#totalBebidaDelivery$aux->ID_Menu').text($totalBD);</script> ";
								echo "
									</div>
								</div>
								</div>

							</div>
						</div>
						";
				}
				$menu=$aux->Menu;
			}
		}
	}

	public function realTimeCartaDelivery(){
		date_default_timezone_set('America/Lima');
		$cartaDelivery=$this->Pedido_model->selectCartaCocineroDelivery();
		$numerofilasCarta=$cartaDelivery->num_rows();
				if($numerofilasCarta == 0){
					echo "<div class='col-md-4 text-muted text-center'>
					<h4>No hay platos carta pendientes</h4>
					</div>
					";
				}
		if(isset($cartaDelivery)){

			$menu="xxx";
			foreach($cartaDelivery->result() as $aux){
				if($aux->Menu!=$menu) {
				echo "<div class='col-md-12'>
						<div class='card bg-yellow border-0'>
						<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
						<div class='card-header'>
							<div class='row align-items-center'>

							<div class='col-12'>
								<h1 class='text-lg text-center'><span id='totalCD$aux->ID_Menu' > </span>  </h1>
							</div>
							<div class='col-12'>";

							$totalCD=0;
							foreach($cartaDelivery->result() as $aux2){
								if($aux2->Menu==$aux->Menu)
								{

									echo "
											<form action='".base_url('Pedido/cocinar/')."' method='POST'>

											<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
											<input type='hidden' name='cantidad' value='' id='totalCDR$aux2->ID_Menu'>
											<input type='hidden' name='plato' value='$aux2->ID_Menu'>
											<input type='submit' value='Cocinar' class='btn btn-success btn-block float-right' >
											</form>";
										$totalCD=$totalCD+$aux2->total;
								}
							}
							echo "<script> $('#totalCDR$aux->ID_Menu').val($totalCD);</script> ";
							echo "<script> $('#totalCD$aux->ID_Menu').text($totalCD);</script> ";
								echo "
									</div>
								</div>
								</div>

							</div>
						</div>
						";
				}
				$menu=$aux->Menu;
			}
		}
	}
	/******************************************** */
	public function AllPedidoDetalle(){
		$data = array();
		$data['allpedido_detalle'] = $this->Pedido_model->AllPedidoDetalle();
		$this->template->load('layout', 'allpedidodetalle_table', $data);
	}

	public function VerDetallePedidoMesa($ID_Pedido){

		$pedidodetalle_list = $this->Pedido_model->selectDetalle($ID_Pedido);
		$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);


		// validar botones actualizar y eliminar
		if ($ID_Perfil == '4') {
			$botones = "style='display:none'";
		} else {
			$botones = '';
		}

		if ($pedidodetalle_list) {
			foreach ($pedidodetalle_list->result() as $aux) {
				$ID = encriptar($aux->ID_LPedido);
				$ID_Pedido = encriptar($aux->ID_Pedido);
				$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
				$rutaeliminar = base_url('Pedido/eliminardetalleDesdePlano/' . $ID . '/' . $ID_Pedido);
				switch ($aux->ID_Estado) {
					case 1:
						$color = "danger";
						break;
					case 2:
						$color = "success";
						break;
					case 3:
						$color = "info";
						break;
					case 4:
						$color = "warning";
						break;
					case 5:
						$color = "inverse";
						break;
					case 6:
						$color = "purple";
						break;
					default:
						# code...
						break;
				}

				if ($aux->Estado == 'Preparado') {
					$estadoPreparado = "style='display:none'";
				} else {
					$estadoPreparado = "";
				}

				if ($aux->Estado == 'Pendiente') {
					$estado = '';
				} else {
					$estado = "style='display:none'";
				}
				$Almacen = desencriptar($_SESSION['ID_Almacen']);

				if ($aux->ID_Almacen == 1) {
					if ($aux->EsMenu == 1) {
						$icono = "";
					} else {
						$icono = "<em class='icon-book-open'></em>";
					}
				}
				if ($aux->ID_Almacen == 2) {
					if ($aux->EsMenu2 == 1) {
						$icono = "";
					} else {
						$icono = "<em class='icon-book-open'></em>";
					}
				}

				if ($aux->ID_Almacen == 3) {
					if ($aux->EsMenu3 == 1) {
						$icono = "";
					} else {
						$icono = "<em class='icon-book-open'></em>";
					}
				}

				echo "
			<tr>
				<td>" .  $aux->Menu . " $icono</td>
				<td>Cliente " .  $aux->Posicion . "</td>
				<td><span id='estado' class='badge badge-" . $color . " btn-xs'>" . $aux->Estado . "</span></td>
				<td>" .  $aux->Observacion . "</td>
				<td>" .  $aux->Almacen . "</td>


				<td class='w-20'><a $estadoPreparado href='" . base_url('Pedido/pedidodetalle/' . $ID) . "'  ><em class='icon-pencil  color-tema' ></em> </a></td>

				<td class='w-20'><a href='#'  onclick=\"return baja('" . $rutaeliminar  . "')\" ><em class='icon-trash color-tema'" . $botones . " ></em> </a>
				</td>
			</tr>
			";
			}
		}
	}

	public function allPedidoDelivery(){
		$data = array();
		$data['pedidodet_list'] = $this->Pedido_model->DetalleDelivery();
		$data['pedido_list'] = $this->Pedido_model->SelectPedidoDelivery();
		$this->template->load('layout', 'pedidodelivery_table', $data);
	}

	public function VerDetallePedidoDelivery($ID_Pedido){
		$pedidodetalle_list = $this->Pedido_model->selectDetalleDelivery($ID_Pedido);

		if ($pedidodetalle_list) {
			foreach ($pedidodetalle_list->result() as $aux) {

				switch ($aux->ID_Estado) {
					case 1:
						$color = "danger";
						break;
					case 2:
						$color = "info";
						break;
					case 3:
						$color = "success";
						break;
					case 4:
						$color = "warning";
						break;
					case 5:
						$color = "inverse";
						break;
					case 6:
						$color = "purple";
						break;
					default:
						# code...
						break;
				}

				if($aux->Delivery==0){
					$carta="";
				}else{
				$carta="<em class='icon-book-open bg-yellow'></em>";
				}

				echo "
			<tr>

			<td>".  $aux->Menu ." $carta</td>

				<td class='text-center'>
					<span id='estado' class='badge badge-" . $color . " btn-xs'>" . $aux->Estado . "
					</span>
				</td>


			</tr>
			";
			}
		}
	}

	public function estadoPedidoDelivery(){
		$ID_Pedido = $this->input->post('pedi');
		$cantidadLonchera = $this->input->post('cantidadLonchera');
		$codigoLoncheras = $this->input->post('codigoLoncheras');
		$this->Pedido_model->estadoPedidoArmado($ID_Pedido,$cantidadLonchera,$codigoLoncheras);

		redirect('Pedido/allPedidoDelivery');
	}

	public function realTimePedidosDeliveryMesero() {
		$pedido_list=$this->Pedido_model->SelectPedidoDelivery();
		$pedidodet_list = $this->Pedido_model->DetalleDelivery();
		if($pedido_list){
			foreach ($pedido_list->result() as $aux) {

				switch ( $aux->ID_Estado) {
					case 1:
						$color="danger";
						break;
					case 2:
						$color="success";
						break;
					case 3:
						$color="info";
						break;
					case 4:
						$color="inverse";
						break;
					case 5:
						$color="inverse";
						break;
					case 6:
						$color="purple";
						break;
					case 7:
					$color="warning";
					break;
					case 8:
					$color="purple";
					break;
					case 9:
						$color="green";
						break;
					case 10:
						$color="inverse";
						break;
					default:
					$color="info";
						break;
					}
				if($aux->Estado=='Preparado'){
					$estadoPreparado="";
				}else{
					$estadoPreparado="style='display:none'";
				}

				date_default_timezone_set('America/Lima');
				echo "
				<tr role='row' class='odd'>
					<td>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
					<td><span class='badge badge-$color btn-xs'>$aux->Estado</span></td>
					<td>$aux->Nombre"." "."$aux->ApellidoPaterno"." "."$aux->ApellidoMaterno</td>
					<td class='label label-info'>$aux->Distrito</td>
					<td>$aux->Direccion</td>
					<td>

					<button $estadoPreparado type='button' data-toggle='modal' onclick=\"return armarpedido('$aux->ID_Pedido')\" data-target='#modal_lonchera' class='btn btn-info btn-xs '>Armar pedido</button>
					</td>
					<td class='w-20'>
						<a href='#' onclick=\"return detalleDelivery('$aux->ID_Pedido')\" data-toggle='modal' data-target='#modalmotorizado'>
							<em class='fas fa-list-ol color-tema' style='padding-right:5px'></em>
						</a>
					</td>


				</tr>
				";
				echo "
								<tr id='mostrarDetalle'>
									<td colspan='5'>
										<table>";
										if($pedidodet_list){
											foreach ($pedidodet_list->result() as $aux2) {
												if( $aux2->ID_Pedido == $aux->ID_Pedido){
													echo "
													<tr >
														<td>".$aux2->Menu."</td>

													</tr>";
												}

										}}
										echo "
										</table>
									</td>
								</tr>";
			}
		}

	}

	public function Pendientes_cobro()
	{
		$data = array();
		$data['pedido_list'] = $this->Pedido_model->selectAllPendientes();
		$data['pedidodet_list'] = $this->Pedido_model->selectDetalleHoy();
		$data['pedidodetalle_list'] = $this->Pedido_model->selectallDetallePreparado();
		$this->template->load('layout', 'pedido_pendiente_table', $data);
	}

	public function cobrarPedido($ID_Pedido)
	{
		$this->Pedido_model->cobrarPedido($ID_Pedido);
		$this->Pendientes_cobro();
	}
}
