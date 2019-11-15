<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compra extends CI_Controller {

   public function __construct() {

		parent::__construct();

		$this->load->model('Compra_model');
		$this->load->model('Insumo_model');
		$this->load->model('Almacen_model');
		$this->load->model('Usuario_model');
		$this->load->model('Proveedor_model');
		sessionExist();
		validaToken();

   }

	public function index() {

		$data = array();
	
		$data['listaAsignado'] = $this->Compra_model->selectAllListaCompra();
		$this->template->load('layout','listacompra_table',$data);

	}

	public function compra_aflicae(){
		$data = array();
		$data['compra_list'] = $this->Compra_model->selectAll_aflicae();
		$this->template->load('layout','compra_table',$data);
	}

	public function nuevo_afliace() {
		$aux = (object)  array(
			'ID_Compra' => '',
			'ID_Insumo' => 0,
			'ID_Almacen' => 0,
			'Cantidad' => 1);
		$data['compra'] = $aux;
		$data['insumo_list'] = $this->Insumo_model->selectAll();
		$data['almacen_list'] = $this->Almacen_model->selectAll();
		$this->template->load('layout','compra_data',$data);
	}

	public function actualizar_aflicae() {
		$ID_Compra = desencriptar($this->input->post('ID_Compra'));
		$ID_Insumo = $this->input->post('ID_Insumo');
		$ID_Almacen = $this->input->post('ID_Almacen');
		$Cantidad = $this->input->post('cantidad');
		if($ID_Compra == ""){
            $this->session->set_userdata('success', 'La Comptra se registró correctamente');
            insertarLog("Registró la Compra ".$ID_Compra);
            $ID_Compra = $this->Compra_model->insertar($ID_Insumo,$ID_Almacen,$Cantidad);
        }else{
            $this->session->set_userdata('success', 'La Compra se actualizó correctamente');
            insertarLog("Actualizó la Compra ".$ID_Compra);
			$this->Compra_model->actualizar( $ID_Insumo,$ID_Almacen,$Cantidad,$ID_Compra);
        }
            redirect('Compra/compra_aflicae');
	}


	
	public function listaInsumosComprados() {

		$data = array();
		$data['compra_list'] = $this->Compra_model->selectAll();
		$data['compra_directa'] = $this->Compra_model->selectAllCompraDirecta();
		$this->template->load('layout','compra_table',$data);

	}
	public function Asignar() {
		$data = array();
		$aux = (object)array(
			'ID_ListaCompra' => '',
			'CodUsuario' => '',
			'Observacion' => '',
			
		);
		$data['listacompra']=$aux;
		$data['list_usuarios']=$this->Usuario_model->selectUsuariosCompras();

		$this->template->load('layout','listacompra_data',$data);
	}
	public function compraDirecta() {
		$data = array();
		$aux = (object)array(
			'ID_CompraDirecta' => '',
			'Producto' => '',
			'ID_Proveedor' => '',
			'Cantidad' => 0,
			'Precio' => 0
			
		);
		$data['compra']=$aux;
		$data['lista_proveedores']=$this->Proveedor_model->selectAll();

		$this->template->load('layout','compra_data',$data);
	}

	public function AsignarInsumoListaCompra($CodUsuario,$ID_ListaCompra){

		$query = $this->Insumo_model->selectAll();
		

        if(!$query || $query->num_rows() < 1) {

            $data['Insumo_list'] = null;
        }
        else {
            $data['Insumo_list'] = array( );
            foreach ($query->result() as $row) {
                $aux = array( );
                $aux['ID_Insumo'] = $row->ID_Insumo;
                $aux['Insumo'] = $row->Insumo;
                $aux['Stock'] = $row->Stock;
				$aux['Abreviatura']= $row->Abreviatura;
				$aux['StockMinimo'] = $row->StockMinimo;
				$aux['Costo'] = $row->Costo;
				$data['precioUltimaCompraInsumo']=$this->Compra_model->precioUltimaCompraInsumo($row->ID_Insumo);
				/* $aux['promedioPrecioCompraInsumo']=$this->Compra_model->promedioPrecioCompraInsumo($row->ID_Insumo); */
                $data['Insumo_list'][] = $aux;
			}
			$data['CodUsuario']=$CodUsuario;
			$data['ID_ListaCompra']=$ID_ListaCompra;
		}
		$this->template->load('layout','listacompradetalle_data',$data);
	}

	public function nuevo() {

		$aux = (object)  array(
			'ID_Compra' => '',
			'ID_Insumo' => 0,
			'ID_Almacen' => 0,
			'Cantidad' => 1);


		$data['compra'] = $aux;

		$data['insumo_list'] = $this->Insumo_model->selectAll();
		$data['almacen_list'] = $this->Almacen_model->selectAll();

		$this->template->load('layout','compra_data',$data);
	}
	
	
	public function compra($ID_Compra) {

		$data= array();
		$ID = desencriptar($ID_Compra);

		$data['compra'] = $this->Compra_model->select($ID);

		$data['insumo_list'] = $this->Insumo_model->selectAll();
		$data['almacen_list'] = $this->Almacen_model->selectAll();

		$this->template->load('layout','compra_data',$data);
	}

	public function actualizar() {

		//$ID_Compra = desencriptar($this->input->post('ID_Compra'));
		$ID_Proveedor = $this->input->post('ID_Proveedor');
		$Producto = $this->input->post('producto');
		$Cantidad = $this->input->post('cantidad');
		$Precio = $this->input->post('precio');

		$this->Compra_model->insertarCompraDirecta($ID_Proveedor,$Producto,$Cantidad,$Precio);


            redirect('Compra/compraDirecta');
	}

	public function actualizarCompraInsumo() {

		// datos fijos para la compra
		$ID_Insumo = $this->input->post('ID_Insumo');
		$Cantidad = $this->input->post('cantidadCompra');
		$precio=$this->input->post('precio');
		$ID_Lista=$this->input->post('ID_Lista');
		$CodUsuario=$this->input->post('CodUsuario');
		$ID_ListaCompra=$this->input->post('ID_ListaCompra');
		/* $CantidadConvertida=$this->input->post('CantidadConvertida'); */

		//datos opcionales para la conversion de unidad de medida
		$unidadMedidaCompra=$this->input->post('ID_UnidadMedidaCompra');
		$unidadConversion=$this->input->post('UnidadConversion');

		$this->Compra_model->estadodetalleaPreparado($ID_Lista);

		if ($this->Compra_model->existeDetalleEnPendiente($ID_ListaCompra)) {
			$this->Compra_model->estadoCompraEnProceso($ID_ListaCompra);
		} else {
			$this->Compra_model->estadoCompraTerminada($ID_ListaCompra);
		}

		/* if($unidadMedidaCompra && $unidadConversion){
// si quiere usasr la conversion
			$this->Compra_model->insertarAlmacenComprasConversion($ID_Insumo,$Cantidad,$precio,$ID_Lista,$unidadMedidaCompra,$unidadConversion);
			redirect('Compra/selectDetalleListaCompra/'.$ID_ListaCompra.'/'.$CodUsuario);
		}else{
			// compra tradicional
			
		} */

		$this->Compra_model->actualizarListaCompra($ID_ListaCompra,$ID_Lista,$ID_Insumo);
		$this->Compra_model->restarDineroCompra($ID_ListaCompra,$precio);
		$this->Compra_model->actualizarPrecioListaCompra($ID_Lista,$precio);
		$this->Compra_model->insertarAlmacenCompras($ID_Insumo,$Cantidad,$precio,$ID_Lista);

		
		redirect('Compra/selectDetalleListaCompra/'.encriptar($ID_ListaCompra).'/'.encriptar($CodUsuario));

		
	}

	public function UnidadMedidaInsumos($ID_Insumo){

		$UnidadMedida=$this->Insumo_model->select2($ID_Insumo);

		foreach($UnidadMedida->result() as $row){
			//echo "<input class='form-control' value='$row->Abreviatura'>";
			echo $row->Abreviatura;
		}

	}

	public function ComprarInsumo($ID_UnidadMedida,$Abreviatura,$Insumo,$Cantidad,$ID_Insumo,$ID_Lista,$ID_ListaCompra,$CodUsuario){

		$data=array();
		$data['ID_Insumo']= $ID_Insumo;
		$data['ID_Lista']=$ID_Lista;
		$data['Insumo']=$Insumo;
		$data['Cantidad'] = $Cantidad;
		$data['ID_UnidadMedida'] = $ID_UnidadMedida;
		$data['Abreviatura'] = $Abreviatura;
		$data['Unidad_Medida'] = $this->Insumo_model->selectAllUnidadMedida();
		$data['ID_ListaCompra'] =$ID_ListaCompra;
		$data['CodUsuario'] =$CodUsuario;
		$data['Insumo_list'] = $this->Insumo_model->selectAll();

		
		$this->template->load('layout','compraInsumo_data',$data);

	}

	public function HacerCompraInsumo() {

		$ID_Compra = desencriptar($this->input->post('ID_Compra'));
		$ID_Insumo = $this->input->post('ID_Insumo');
		
		$Cantidad = $this->input->post('Cantidad');

		if($ID_Compra == ""){
            $this->session->set_userdata('success', 'La Compra se registró correctamente');
            insertarLog("Registró la Compra ".$ID_Compra);
            $ID_Compra = $this->Compra_model->insertar($ID_Insumo,$Cantidad);
        }

            redirect('Compra/MisAsignados');
	}

	public function comprar() {

		$ID_ListaCompra = $this->input->post('ID_ListaCompra');
		$CodUsuario = $this->input->post('CodUsuario');
		$Comprar = $this->input->post('comprar');
		//$Observacion = $this->input->post('Observacion');

		$this->Compra_model->CambiarEstadoUsuarioCompra($CodUsuario);
		foreach ($Comprar as $ID_Insumo => $Cantidad) {
			if(strlen($Cantidad)> 0 ){
				$this->session->set_userdata('success', 'La Compra se registró correctamente');
				$this->Compra_model->insertarLista($ID_Insumo,$Cantidad,$CodUsuario,$ID_ListaCompra);
			}

		}
      redirect('Compra');
	}

	public function AsignarListaCompra() {

		$ID_ListaCompra = desencriptar($this->input->post('ID_ListaCompra'));
		$CodUsuario = $this->input->post('CodUsuario');
		$Observacion = $this->input->post('Observacion');
		
		//$this->Compra_model->CambiarEstadoUsuarioCompra($CodUsuario); 
		if($ID_ListaCompra==""){
			$ID_ListaCompra = $this->Compra_model->insertListaCompra($CodUsuario,$Observacion);
			redirect('Compra/AsignarInsumoListaCompra/'.$ID_ListaCompra.'/'.$CodUsuario);
		}else{
			$ID_ListaCompra = $this->Compra_model->updateListaCompra($ID_ListaCompra,$CodUsuario,$Observacion);
			redirect('Compra');
		}
		
	}

	public function eliminar($ID_Compra) {
		if(!$ID_Compra) {
			show_404();
			return;
		  }

		  $eliminar = $this->Compra_model->eliminar(desencriptar($ID_Compra));

		  if($eliminar)
		  {
			$_SESSION['eliminado'] = 'Este item se eliminó correctamente';
			redirect('Compra', 'refresh');
		  }
	}

	public function lista(){
		$data = array();
		$data['list_users'] = $this->Compra_model->listarCompradores();
		$data['comprasPendientes']=$this->Compra_model->listaCompraPendiente();
		$this->template->load('layout','compra_pendiente',$data);
	}

	public function ver($correo){
		$listaCompra=$this->Compra_model->listaCompraPendiente($correo);
		foreach($listaCompra->result() as $row){
			echo "<p>$row->Insumo</p>";
		}

	}

	public function AsginarDineroCompras() {
		
		$Correo=$this->input->post('correo');

		$cien=$this->input->post('100');
		$cincuenta=$this->input->post('50');
		$veinte=$this->input->post('20');
		$diez=$this->input->post('10');
		$cinco=$this->input->post('5');
		$dos=$this->input->post('2');
		$uno=$this->input->post('1');
		$cincuentaC=$this->input->post('050');
		$veinteC=$this->input->post('020');
		$diezC=$this->input->post('010');
		$ID_ListaCompra=$this->input->post('ID_ListaCompra');

		$totalCien = 100 * intval($cien);
		$totalCincuenta = 50 * intval($cincuenta);
		$totalveinte = 20 * intval($veinte);
		$totalDiez = 10 * intval($diez);
		$totalCinco = 5 * intval($cinco);
		$totalDos = 2 * intval($dos);
		$totalCincuentaC = 0.50 * intval($cincuentaC);
		$totalVeinteC = 0.20 * intval($veinteC);
		$totalDiezC = 0.10 * intval($diezC);

		$total = $totalCien+$totalCincuenta+$totalveinte+$totalDiez+$totalCinco+$totalDos+$uno+$totalCincuentaC+$totalVeinteC+$totalDiezC;
		


		$this->Compra_model->InsertarImporteEnviadoCompra($Correo,$cien,$cincuenta,$veinte,$diez,$cinco,$dos,$uno,$cincuentaC,$veinteC,$diezC,$ID_ListaCompra,$total);
		//$this->Compra_model->actualizarListaCompras($ID_ListaCompra);
		$this->Compra_model->CambiarEstadoDineroAsignado($ID_ListaCompra);
		redirect(base_url('Compra'));

	}

	public function EliminarLista($Correo) {
		if (!$Correo) {
			show_404();
			return;
		}

		$this->Compra_model->EliminarLista($Correo);
		$this->Compra_model->EliminarDineroAsignado($Correo);
		$this->Compra_model->QuitarEstadoComprado($Correo);
		
			redirect(base_url('Compra/lista'));
		

	}

	public function selectDineroCompras($ID_ListaCompra,$correo) {
		$Dinero= $this->Compra_model->selectDineroListaCompra($ID_ListaCompra);
		
		if($Dinero->num_rows() == 0){
			echo "<form action='Compra/AsginarDineroCompras' method='POST'>
					
				
			<label>Billetes</label>
					<input type='hidden' name='ID_ListaCompra' id='ID_ListaCompra' value='$ID_ListaCompra'>
					<input type='hidden' name='correo' id='CorreoCompras' value='$correo'>
			<div class='row'>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 100.00</span>
						</div>
						<input class='form-control text-right' id='cien' min='0' pattern='^[0-9]+' type='number' aria-describedby='basic-addon3' name='100' >
				</div>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text ' id='basic-addon3'>S/ 50.00</span>
						</div>
						<input class='form-control text-right' min='0' pattern='^[0-9]+'  id='cincuenta' type='number' aria-describedby='basic-addon3' name='50' >
				</div>
			</div>
			<div class='row'>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 20.00</span>
						</div>
						<input class='form-control text-right' min='0' pattern='^[0-9]+'  id='veinte' type='number' aria-describedby='basic-addon3' name='20'>
				</div>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 10.00</span>
						</div>
						<input class='form-control text-right' min='0' pattern='^[0-9]+' id='diez' type='number' aria-describedby='basic-addon3' name='10'>
				</div>
			</div>
			<hr>
			<label>Monedas</label>
			
			<div class='row'>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 5.00</span>
						</div>
						<input class='form-control text-right' min='0' pattern='^[0-9]+'  id='basic-url' type='number' aria-describedby='basic-addon3' name='5'>
				</div>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 2.00</span>
						</div>
						<input class='form-control text-right'  min='0' pattern='^[0-9]+' id='basic-url' type='number' aria-describedby='basic-addon3' name='2'>
				</div>
			</div>
			<div class='row'>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 1.00</span>
						</div>
						<input class='form-control text-right' min='0' pattern='^[0-9]+'  id='basic-url' type='number' aria-describedby='basic-addon3' name='1'>
				</div>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 0.50</span>
						</div>
						<input class='form-control text-right' min='0' pattern='^[0-9]+'  id='basic-url' type='number' aria-describedby='basic-addon3' name='050'>
				</div>
			</div>
			<div class='row'>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 0.20</span>
						</div>
						<input class='form-control text-right' min='0' pattern='^[0-9]+'  id='basic-url' type='number' aria-describedby='basic-addon3' name='020'>
				</div>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 0.10</span>
						</div>
						<input class='form-control text-right' min='0' pattern='^[0-9]+'  id='basic-url' type='number' aria-describedby='basic-addon3' name='010'>
				</div>
				
			</div>
		
			
		
				<div class='modal-footer'>
					<button class='btn btn-success' id='botonasignar'  type='submit' >Asignar</button>
					<div id='nuevo'></div>
				</div>
		</form>";
		}else{
			foreach($Dinero->result() as $row){
				
				echo "
				<form action='Compra/ActualizarDineroAsignado' method='POST' id='formularioEditarDinero'>
				<label>Billetes</label>
		
				<div class='row'>
				<input name='ID_ListaCompra' value='$row->ID_ListaCompra' type='hidden'>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 100.00</span>
						</div>
						<input class='form-control text-right' id='basic-url' type='number' aria-describedby='basic-addon3' name='100' value='$row->cien'>
				</div>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text ' id='basic-addon3'>S/ 50.00</span>
						</div>
						<input value='$row->cincuenta' class='form-control text-right' id='basic-url' type='number' aria-describedby='basic-addon3' name='50'>
				</div>
				</div>
				<div class='row'>
					<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 20.00</span>
						</div>
						<input value='$row->veinte' class='form-control text-right' id='basic-url' type='number' aria-describedby='basic-addon3' name='20'>
				</div>
				<div class='input-group mb-3 col-lg-6'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='basic-addon3'>S/ 10.00</span>
						</div>
						<input value='$row->diez' class='form-control text-right' id='basic-url' type='number' aria-describedby='basic-addon3' name='10'>
				</div>
				</div>
				<hr>
				<label>Monedas</label>
				
				<div class='row'>
					<div class='input-group mb-3 col-lg-6'>
							<div class='input-group-prepend'>
								<span class='input-group-text' id='basic-addon3'>S/ 5.00</span>
							</div>
							<input value='$row->cinco' class='form-control text-right' id='basic-url' type='number' aria-describedby='basic-addon3' name='5'>
					</div>
					<div class='input-group mb-3 col-lg-6'>
							<div class='input-group-prepend'>
								<span class='input-group-text' id='basic-addon3'>S/ 2.00</span>
							</div>
							<input value='$row->dos' class='form-control text-right' id='basic-url' type='number' aria-describedby='basic-addon3' name='2'>
					</div>
				</div>
				<div class='row'>
					<div class='input-group mb-3 col-lg-6'>
							<div class='input-group-prepend'>
								<span class='input-group-text' id='basic-addon3'>S/ 1.00</span>
							</div>
							<input value='$row->uno' class='form-control text-right' id='basic-url' type='number' aria-describedby='basic-addon3' name='1'>
					</div>
					<div class='input-group mb-3 col-lg-6'>
							<div class='input-group-prepend'>
								<span class='input-group-text' id='basic-addon3'>S/ 0.50</span>
							</div>
							<input value='$row->cincuentaC' class='form-control text-right' id='basic-url' type='number' aria-describedby='basic-addon3' name='050'>
					</div>
				</div>
					<div class='row'>
							<div class='input-group mb-3 col-lg-6'>
									<div class='input-group-prepend'>
										<span class='input-group-text' id='basic-addon3'>S/ 0.20</span>
									</div>
									<input value='$row->veinteC' class='form-control text-right' id='basic-url' type='number' aria-describedby='basic-addon3' name='020'>
							</div>
					<div class='input-group mb-3 col-lg-6'>
							<div class='input-group-prepend'>
								<span class='input-group-text' id='basic-addon3'>S/ 0.10</span>
							</div>
							<input value='$row->diezC' class='form-control text-right' id='basic-url' type='number' aria-describedby='basic-addon3' name='010'>
					</div>
					</div>
					</div>
	
						</div>
						<div class='modal-footer'>
						<button class='btn btn-success' id='btnactualizar'  type='submit' >Guardar</button>
						
						</div>
					
				</form>
			
				";
			}
		}
			
			
		
	}

	public function ActualizarDineroAsignado() {
		$ID_ListaCompra=$this->input->post('ID_ListaCompra');
		$cien=$this->input->post('100');
		$cincuenta=$this->input->post('50');
		$veinte=$this->input->post('20');
		$diez=$this->input->post('10');
		$cinco=$this->input->post('5');
		$dos=$this->input->post('2');
		$uno=$this->input->post('1');
		$cincuentaC=$this->input->post('050');
		$veinteC=$this->input->post('020');
		$diezC=$this->input->post('010');

		$totalCien = 100 * intval($cien);
		$totalCincuenta = 50 * intval($cincuenta);
		$totalveinte = 20 * intval($veinte);
		$totalDiez = 10 * intval($diez);
		$totalCinco = 5 * intval($cinco);
		$totalDos = 2 * intval($dos);
		$totalCincuentaC = 0.50 * intval($cincuentaC);
		$totalVeinteC = 0.20 * intval($veinteC);
		$totalDiezC = 0.10 * intval($diezC);

		$total = $totalCien+$totalCincuenta+$totalveinte+$totalDiez+$totalCinco+$totalDos+$uno+$totalCincuentaC+$totalVeinteC+$totalDiezC;

		$this->Compra_model->actualizarDineroCompra($ID_ListaCompra,$cien,$cincuenta,$veinte,$diez,$cinco,$dos,$uno,$cincuentaC,$veinteC,$diezC,$total);
		redirect('Compra', 'refresh');
	}

	public function MisAsignados()
	{
		$data=array();
		$data['listaAsignado']=$this->Compra_model->ListaCompraAsignado();
		$this->template->load('layout','listacompra_table',$data);
	}

	public function selectDetalleListaCompra($ID_ListaCompra,$CodUsuario) {

		$ID_ListaCompra = desencriptar($ID_ListaCompra);
		$CodUsuario = desencriptar($CodUsuario);

		$data=array();
		$data['list_asignado'] = $this->Compra_model->selectDetalleListaCompra($ID_ListaCompra);

		
		// ver total dinero asignado *
		$data['dineroTotalAsigando'] = $this->Compra_model->selectTotalDineroAsignadoCompra($ID_ListaCompra);


		$data['dineroTotal'] = $this->Compra_model->selectTotalDinero($ID_ListaCompra);
		/*$data['dineroAsignado'] = $this->Compra_model->selectTotalDineroAsignado($ID_ListaCompra); */

		$data['ID_ListaCompra']=$ID_ListaCompra;
		$data['CodUsuario']=$CodUsuario;
		$this->template->load('layout','listacompradetalle_table',$data);

	}
	public function eliminarListaCompra($ID_ListaCompra)
	{

		if (!$ID_ListaCompra) {
			show_404();
			return;
		}

		$this->Compra_model->eliminarListaCompra(desencriptar($ID_ListaCompra));

		redirect('Compra', 'refresh');
		
	}
	public function eliminarListaCompraDetalle($ID_Lista)
	{

		if (!$ID_Lista) {
			show_404();
			return;
		}

		$this->Compra_model->eliminarListaCompraDetalle(desencriptar($ID_Lista));

		redirect('Compra', 'refresh');
		
	}

	public function rendirListaCompra($ID_ListaCompra)
	{
		$this->Compra_model->rendiCompra($ID_ListaCompra);

		redirect('Compra', 'refresh');
	}
	public function listacompraEdit($ID_ListaCompra) {
		$data = array();

		$ID = desencriptar($ID_ListaCompra);
		$data['listacompra'] = $this->Compra_model->selectListaCompra($ID);
		$data['list_usuarios']=$this->Usuario_model->selectUsuariosCompras();
		$this->template->load('layout', 'listacompra_data', $data);


	}

	public function listacompraEditDinero($ID_ListaCompra) {
		$data = array();

		$ID = desencriptar($ID_ListaCompra);

		$data['listacompra'] = $this->Compra_model->selectListaCompra($ID);
		$this->template->load('layout', 'listacompra_data', $data);

		
	}

}
