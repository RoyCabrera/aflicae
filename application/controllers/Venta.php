<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta extends CI_Controller {

   	public function __construct() {

		parent::__construct();
		$this->load->model("Configuracion_model");
		$this->load->model("Pedido_model");
		$this->load->model("Venta_model");
		$this->load->model("Almacen_model");
		$this->load->model("Cliente_model");
		$this->load->model("Factura_model");
		$this->load->model("Mesa_model");
		$this->load->model("Mes_model");
		$this->load->helper('download');

		sessionExist();
		validaToken();
	}

    public function index() {
		$data = array();
		$data['preciomenu']= $this->Configuracion_model->VerPrecioMenu();
		$data['venta_list'] = $this->Venta_model->selectAll();
		$data['almacen_list'] = $this->Almacen_model->selectAll();
        $this->template->load('layout','venta_table',$data);
	}

	public function filtro($start,$end,$ID_Almacen){
		date_default_timezone_set('America/Lima');
		$data=array();

		$data['ventas']=$this->Venta_model->filtrarVenta($start,$end,$ID_Almacen);
		$data['preciomenu']= $this->Configuracion_model->VerPrecioMenu();
		$preciomenu=$data['preciomenu'];
		$ventas = $data['ventas']->result();

			foreach($ventas as $aux):
				if($aux->ID_Familia==2){
					$total=0;
								if($aux->EsMenu==1 && $aux->ID_Almacen==1)
								{
									$NombrePlato="Menú";
									$total=$total+$preciomenu*$aux->Cantidad;
									$precio=$preciomenu;
								}
								elseif($aux->EsMenu2==1 && $aux->ID_Almacen==2){
									$NombrePlato="Menú";
									$total=$total+$preciomenu*$aux->Cantidad;
									$precio=$preciomenu;
								}
								elseif($aux->EsMenu3==1 && $aux->ID_Almacen==3){
									$NombrePlato="Menú";
									$total=$total+$preciomenu*$aux->Cantidad;
									$precio=$preciomenu;
								}else {
									$NombrePlato=$aux->Menu;
									$total=$total+ $aux->Precio*$aux->Cantidad;
									$precio=$aux->Precio;
								}
					$html="<tr>
					<td>".  date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
					<td>".$aux->Almacen."</td>
					<td>".$NombrePlato."</td>
					<td class='text-right'>S/".$precio."</td>
					<td class='text-right'>".$aux->Cantidad."</td>
					<td>".$aux->Nombre." ".$aux->ApellidoPaterno."</td>
					<td class='text-right'>S/".$total."</td>
					</tr>";
					echo $html;
				}


			endforeach;

	}

	public function verFactura($ID){
		$ID_Pedido = desencriptar($ID);
		$data=array();

		// para la vista
		$data['config'] = $this->Configuracion_model->selectAll();
		$data['preciomenu']= $this->Configuracion_model->verPrecioMenu();
		$data['mesero']=$this->Pedido_model->VentaMesero($ID_Pedido);
		$data['venta_list']=$this->Pedido_model->verVenta($ID_Pedido);

		$data['total_a_cobrar']=$this->Pedido_model->total_a_cobrar($ID_Pedido);
		$this->template->load('layout_cliente','boleta_table',$data);


	}

	// formulario para llenar factura
	public function datosFactura($ID,$tipo_comprobante,$ID_Mesa){
		$data=array();
		$data['documento_list']=$this->Venta_model->allDocumentos();
		$data['ID']=$ID;
		$data['ID_Mesa']=$ID_Mesa;
		$data['tipo_comprobante']=$tipo_comprobante;
		$this->template->load('layout','cliente_data',$data);
	}

	// llenar formulario cliente con ajax
	function buscarCliente($numero_documento){

		$data=array();
		$data['cliente']= $this->Venta_model->buscarCliente($numero_documento);

		$clienteRuc=$data['cliente']->result();
		foreach($clienteRuc as $row){
			$cliente = array(
				'nombre'=>$row->Nombre,

				'direccion'=>$row->Direccion,
				'documento'=>$row->ID_Documento,
				'numero_documento'=>$row->Numero_Documento,
				'correo'=>$row->Correo,
				'RazonSocial'=>$row->RazonSocial,
				'ID_Cliente'=>$row->ID_Cliente,
			);
		}

		header("Content-type: application/json; charset=utf-8");
    	echo json_encode($cliente);
	}
	public function cobrar($ID,$ID_Mesa){

		date_default_timezone_set('America/Lima');
		$this->PrecioTotalPedido($ID);

		// datos del cliente
		$ID_Cliente = $this->input->post('ID_Cliente');
		$tipo_documento = $this->input->post('documento');
		$dni = $this->input->post('numerodocumento');
		$direccion = $this->input->post('direccion');
		$razonsocial = $this->input->post('razonsocial');
		$correo = $this->input->post('correo');
		$tipo_comprobante = $this->input->post('tipo_comprobante');
		$tipo_cobro = $this->input->post('tipo_cobro');
		$ID_Pedido=desencriptar($ID);
	
		// función guardar y actualizar cliente
		if($razonsocial==""){
			//no guardar cliente
		}
		else{
			//guardar cliente
			$this->actualizarCliente($ID_Cliente,$tipo_documento,$dni,$direccion,$razonsocial,$correo,$ID_Pedido);
		}
		

		// función par acambiar estado del pedido y ID cliente
		$this->Pedido_model->cambiarEstadoCobrado($ID_Pedido,$tipo_cobro,$tipo_comprobante);

		$this->Mesa_model->mesaVacia($ID_Mesa);
		$this->PrecioTotalPedido($ID);


		

		// función actualizar numero de factura

		redirect('Pedido');

	}
	// guardar y actualizar cliente
	public function actualizarCliente($ID_Cliente,$tipo_documento,$dni,$direccion,$razonsocial,$correo,$ID_Pedido) {

		if($ID_Cliente == ""){
			$this->session->set_userdata('success', 'Factura enviada');
			insertarLog("Comprobante enviado");
			$cliente= $this->Cliente_model->insertarCliente($tipo_documento,$dni,$direccion,$razonsocial,$correo);
			$this->Pedido_model->insertar_id_cliente($ID_Pedido,$cliente);
		}else{
			$this->session->set_userdata('success', 'Comprobante enviado');
			insertarLog("guardo la factura");
			$this->Cliente_model->actualizarCliente($ID_Cliente,$tipo_documento,$dni,$direccion,$razonsocial,$correo);
		}
	}
	// emitir factura
	public function factura($ID,$ID_Mesa){

		//obtener el igv de configuraciones
		$result = $this->Configuracion_model->configuracionRow();
		foreach($result->result() as $row) {
			$igv = $row->Igv;
			$serieF = $row->SerieFactura;
			$serieB = $row->SerieBoleta;
			$numeroF = $row->NumeroFactura;
			$numeroB = $row->NumeroBoleta;
			$RutaApi = $row->RutaApi;
			$TokenNubefact = $row->TokenNubefact;
		}


		$total = $this->PrecioTotalPedido($ID);
		$neto = $total/(1+$igv);
		$igvTotal =$total-$neto;


		// datos del cliente
		$ID_Cliente = $this->input->post('ID_Cliente');
		//	$ruc = $this->input->post('ruc');
		$tipo_documento = $this->input->post('documento');
		$dni = $this->input->post('numerodocumento');
		$direccion = $this->input->post('direccion');
		$razonsocial = $this->input->post('razonsocial');
		$correo = $this->input->post('correo');
		$tipo_comprobante = $this->input->post('tipo_comprobante');

		if($tipo_comprobante == 1){
			$serie = $serieF;
			$numero = $numeroF;
		}else{
			$serie = $serieB;
			$numero = $numeroB;
		}
		//echo $serie.$numero;die;
		date_default_timezone_set('America/Lima');
		$now=date('d-m-Y');
		// ruta para guardar la factura
		//resto/ecolunch/facturas
		$rutaGuardarFactura = $_SERVER['DOCUMENT_ROOT']."/mco/ecolunch/facturas/".$serie.$numero.".txt";
		// generar archivo txt
		$txt = fopen($rutaGuardarFactura,"w") or die("Ocurrio un error, no se pudo generar factura") ;
			fwrite($txt,"operacion|generar_comprobante|".PHP_EOL);
			fwrite($txt,"tipo_de_comprobante|$tipo_comprobante|".PHP_EOL);
			fwrite($txt,"serie|$serie|".PHP_EOL);
			fwrite($txt,"numero|$numero|".PHP_EOL);
			fwrite($txt,"sunat_transaction|1|".PHP_EOL);
			fwrite($txt,"cliente_tipo_de_documento|$tipo_documento|".PHP_EOL);
			fwrite($txt,"cliente_numero_de_documento|$dni|".PHP_EOL);
			fwrite($txt,"cliente_denominacion|$razonsocial|".PHP_EOL);
			fwrite($txt,"cliente_direccion|$direccion".PHP_EOL);
			fwrite($txt,"cliente_email|$correo|".PHP_EOL);
			fwrite($txt,"cliente_email_1||".PHP_EOL);
			fwrite($txt,"cliente_email_2||".PHP_EOL);
			fwrite($txt,"fecha_de_emision|$now|".PHP_EOL);
			fwrite($txt,"fecha_de_vencimiento||".PHP_EOL);
			fwrite($txt,"moneda|1|".PHP_EOL);
			fwrite($txt,"tipo_de_cambio||".PHP_EOL);
			fwrite($txt,"porcentaje_de_igv|$igv|".PHP_EOL);
			fwrite($txt,"descuento_global||".PHP_EOL);
			fwrite($txt,"total_descuento||".PHP_EOL);
			fwrite($txt,"total_anticipo||".PHP_EOL);
			fwrite($txt,"total_gravada|".number_format($neto,2)."|".PHP_EOL);
			fwrite($txt,"total_inafecta||".PHP_EOL);
			fwrite($txt,"total_exonerada||".PHP_EOL);
			fwrite($txt,"total_igv|".number_format($igvTotal,2)."|".PHP_EOL);
			fwrite($txt,"total_gratuita||".PHP_EOL);
			fwrite($txt,"total_otros_cargos||".PHP_EOL);
			fwrite($txt,"total|$total|".PHP_EOL);
			fwrite($txt,"percepcion_tipo||".PHP_EOL);
			fwrite($txt,"percepcion_base_imponible||".PHP_EOL);
			fwrite($txt,"total_percepcion||".PHP_EOL);
			fwrite($txt,"total_incluido_percepcion||".PHP_EOL);
			fwrite($txt,"detraccion|false|".PHP_EOL);
			fwrite($txt,"observaciones||".PHP_EOL);
			fwrite($txt,"documento_que_se_modifica_tipo||".PHP_EOL);
			fwrite($txt,"documento_que_se_modifica_serie||".PHP_EOL);
			fwrite($txt,"documento_que_se_modifica_numero||".PHP_EOL);
			fwrite($txt,"tipo_de_nota_de_credito||".PHP_EOL);
			fwrite($txt,"tipo_de_nota_de_debito||".PHP_EOL);
			fwrite($txt,"enviar_automaticamente_a_la_sunat|true|".PHP_EOL);
			fwrite($txt,"enviar_automaticamente_al_cliente|false|".PHP_EOL);
			fwrite($txt,"codigo_unico||".PHP_EOL);
			fwrite($txt,"condiciones_de_pago||".PHP_EOL);
			fwrite($txt,"medio_de_pago||".PHP_EOL);
			fwrite($txt,"placa_vehiculo||".PHP_EOL);
			fwrite($txt,"orden_compra_servicio||".PHP_EOL);
			fwrite($txt,"tabla_personalizada_codigo||".PHP_EOL);
			fwrite($txt,"formato_de_pdf||".PHP_EOL);

			$ID_Pedido=desencriptar($ID);
			// precio total del pedido
			$preciomenu= $this->Configuracion_model->verPrecioMenu();
			// datos de menu y platos para linea items
			$venta_list = $this->Pedido_model->verVenta($ID_Pedido);

			$total=0;
			// calcular igv precio neto y total de linea
			foreach ($venta_list->result() as $aux){

				$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
				$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);
				if($aux->ID_Almacen == 1){
					if(($aux->EsMenu == 1 && $aux->ID_Familia==2 )|| ($aux->EsMenu==0)){
						/********************************************** */
						if($aux->EsMenu == 1){
							$producto = "Menu";
						}
						else{
							$producto = $aux->Menu;
						}

						/********************************************** */
						if($aux->EsMenu==1)
						{
							$precioUnitario = $preciomenu;
							$total = $total + $preciomenu * $aux->Cantidad;
						}else{
							$precioUnitario = $aux->Precio;
							$total = $total + $aux->Precio * $aux->Cantidad;
						}
						/********************************************** */

						$total =$precioUnitario;
						$neto = $total/(1+$igv);
						$igvTotal =$total-$neto;

						// items

						fwrite($txt,"item|NIU|$aux->ID_LPedido|$producto|$aux->Cantidad|".number_format($neto,2)."|$total||".number_format($neto * $aux->Cantidad,2)."|1|".number_format($igvTotal,2)."|".number_format($precioUnitario)."|false|||10000000|".PHP_EOL);

					}
				}
				if($aux->ID_Almacen == 2){
					if(($aux->EsMenu2 == 1 && $aux->ID_Familia==2 )|| ($aux->EsMenu2==0)){

						/********************************************** */
						if($aux->EsMenu2  == 1){
							$producto = "Menu";
						}
						else{
							$producto = $aux->Menu;
						}

						/********************************************** */
						if($aux->EsMenu2 ==1)
						{
							$precioUnitario = $preciomenu;
							$total = $total + $preciomenu * $aux->Cantidad;
						}else{
							$precioUnitario = $aux->Precio;
							$total = $total + $aux->Precio * $aux->Cantidad;
						}
						/********************************************** */

						$total =$precioUnitario;
						$neto = $total/(1+$igv);
						$igvTotal =$total-$neto;

						// items

						fwrite($txt,"item|NIU|$aux->ID_LPedido|$producto|$aux->Cantidad|".number_format($neto,2)."|$total||".number_format($neto * $aux->Cantidad,2)."|1|".number_format($igvTotal,2)."|".number_format($precioUnitario)."|false|||10000000|".PHP_EOL);

					}
				}
				if($aux->ID_Almacen == 3){
					if(($aux->EsMenu3 == 1 && $aux->ID_Familia==2 )|| ($aux->EsMenu3==0)){
						/********************************************** */
						if($aux->EsMenu3  == 1){
							$producto = "Menu";
						}
						else{
							$producto = $aux->Menu;
						}

						/********************************************** */
						if($aux->EsMenu3 ==1)
						{
							$precioUnitario = $preciomenu;
							$total = $total + $preciomenu * $aux->Cantidad;
						}else{
							$precioUnitario = $aux->Precio;
							$total = $total + $aux->Precio * $aux->Cantidad;
						}
						/********************************************** */

						$total =$precioUnitario;
						$neto = $total/(1+$igv);
						$igvTotal =$total-$neto;

						// items

						fwrite($txt,"item|NIU|$aux->ID_LPedido|$producto|$aux->Cantidad|".number_format($neto,2)."|$total||".number_format($neto * $aux->Cantidad,2)."|1|".number_format($igvTotal,2)."|".number_format($precioUnitario)."|false|||10000000|".PHP_EOL);

					}
				}
			}
			// cerrar archivo txt
			fclose($txt);

		// función para enviar a NubeFact

		$this->enviarFactura($rutaGuardarFactura,$ID,$RutaApi,$TokenNubefact);

		// función par acambiar estado del pedido
		$this->Pedido_model->cambiarEstadoCobrado($ID_Pedido);

		$this->Mesa_model->mesaVacia($ID_Mesa);


		$totalP = $this->PrecioTotalPedido($ID);
		$netoP = $totalP/(1+$igv);
		$igvTotalP =$totalP-$netoP;
		$this->Factura_model->insertarFactura($serie,$numero,$dni,$razonsocial,$netoP,$totalP,$igvTotalP);

		// función guardar y actualizar cliente
		// se esta enviando 0 para no enviar mas parametros
		$this->actualizarCliente($ID_Cliente,$tipo_documento,$dni,$direccion,$razonsocial,$correo,0);

		// función actualizar numero de factura

		$cadena_de_texto = $serie;
		$cadena_buscada   = 'F';
		$posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
		if($posicion_coincidencia === false){
			$this->Configuracion_model->actualizarNumeroBoleta($numero);
		}else{
			$this->Configuracion_model->actualizarNumeroFactura($numero);
		}

		redirect('Pedido');

	}

	// enviar factira a NubeFact
	public function enviarFactura($rutaGuardarFactura,$ID,$RutaApi,$TokenNubefact) {

		$ruta = $RutaApi;
		$token = $TokenNubefact;

		$data_txt = file_get_contents($rutaGuardarFactura);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $ruta);
		curl_setopt(
			$ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Token token="'.$token.'"',
			'Content-Type: text/plain',
			)
		);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_txt);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$respuesta  = curl_exec($ch);
		curl_close($ch);


		if (strpos($respuesta, 'errors') !== false) {
			/*$data=array();
			$data['ErrorFactura']=$respuesta;
			$this->template->load('layout','pedido_table',$data);
			die;*/
			echo $respuesta;
			die;
		}




		/* $name = 'factura.txt';
		force_download($name, $respuesta); */

	}

	// calcular precio total del pedido
	public function PrecioTotalPedido($ID){
		$ID_Pedido=desencriptar($ID);
		$preciomenu= $this->Configuracion_model->verPrecioMenu();
		$venta_list = $this->Pedido_model->verVenta($ID_Pedido);
		$total=0;
		foreach ($venta_list->result() as $aux){
			$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
			$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);
			if($aux->ID_Almacen == 1){
				if(($aux->EsMenu==1 && $aux->ID_Familia==2 )|| ($aux->EsMenu==0)){

					if($aux->EsMenu==1)
					{
						$precioUnitario = $preciomenu;
						$total = $total + $preciomenu * $aux->Cantidad;

					}else{
						$precioUnitario = $aux->Precio;
						 $total = $total + $aux->Precio * $aux->Cantidad;

					}
				}
			}
			if( $aux->ID_Almacen == 2){
				if(($aux->EsMenu2==1 && $aux->ID_Familia==2 )|| ($aux->EsMenu2==0)){

					if($aux->EsMenu2==1)
					{
						$precioUnitario = $preciomenu;
						$total = $total + $preciomenu * $aux->Cantidad;

					}else{
						$precioUnitario = $aux->Precio;
						 $total = $total + $aux->Precio * $aux->Cantidad;

					}
				}
			}
			if($aux->ID_Almacen == 3){
				if(($aux->EsMenu3==1 && $aux->ID_Familia==2 )|| ($aux->EsMenu3==0)){

					if($aux->EsMenu3==1)
					{
						$precioUnitario = $preciomenu;
						$total = $total + $preciomenu * $aux->Cantidad;

					}else{
						$precioUnitario = $aux->Precio;
						 $total = $total + $aux->Precio * $aux->Cantidad;

					}
				}
			}

		}
		return  number_format($total,2);
	}

	

	public function filtraryear() {

		$year = $_POST['anio'];

		$enero = $this->Mes_model->enero($year);
		$febrero = $this->Mes_model->febrero($year);
		$marzo = $this->Mes_model->marzo($year);
		$abril = $this->Mes_model->abril($year);
		$mayo = $this->Mes_model->mayo($year);
		$junio = $this->Mes_model->junio($year);
		$julio = $this->Mes_model->julio($year);
		$agosto = $this->Mes_model->agosto($year);
		$septiembre = $this->Mes_model->septiembre($year);
		$octubre = $this->Mes_model->octubre($year);
		$noviembre = $this->Mes_model->noviembre($year);
		$diciembre = $this->Mes_model->diciembre($year);

		$data=array(
			0=>$enero,
			1=>$febrero,
			2=>$marzo,
			3=>$abril,
			4=>$mayo,
			5=>$junio,
			6=>$julio,
			7=>$agosto,
			8=>$septiembre,
			9=>$octubre,
			10=>$noviembre,
			11=>$diciembre
		);
		echo json_encode($data);
	}

	public function ventaAlmacen(){

		$almacen1 = $this->Almacen_model->almacen1();
		$almacen2 = $this->Almacen_model->almacen2();
		$almacen3 = $this->Almacen_model->almacen3();

		$dataAlmacen = array(
			0=> $almacen1,
			1=> $almacen2,
			2=> $almacen3
		);

		echo json_encode($dataAlmacen);
	}


}
