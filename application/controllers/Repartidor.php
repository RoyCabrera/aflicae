<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Repartidor extends CI_Controller{
    public function __construct() {
		parent::__construct();

		$this->load->model('Pedido_model');
		$this->load->model('Repartidor_model');
		
		sessionExist();
		validaToken();
    }

    public function index() {
        $data = array();

		$data['pedidos_armados'] = $this->Pedido_model->SelectPedidoDeliveryArmado();
		$data['allpedidosAsignados'] =$this->Repartidor_model->allPedidosAsignados();
		$data['repartidores']=$this->Repartidor_model->selectRepartidorDisponible();
		$data['zonas']=$this->Repartidor_model->selecAllZonas();
		$this->template->load('layout', 'pedidorepartidor_table', $data);
	}
	public function RealTimeSinAsignar() {
		$pedidos_armados=$this->Pedido_model->SelectPedidoDeliveryArmado();
		if($pedidos_armados){
			foreach ($pedidos_armados->result() as $aux) {

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
				date_default_timezone_set('America/Lima');
				echo "
				<tr>
					<td>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
					<td><span class='badge badge-$color btn-xs'>$aux->Estado</span></td>
					<td>$aux->Nombre"." "."$aux->ApellidoPaterno"." "."$aux->ApellidoMaterno</td>
					<td class='label label-info'>$aux->Distrito</td>
					<td>$aux->Direccion</td>
					<td class='text-right'>$aux->CantidadLonchera</td>
					<td>$aux->CodigoLoncheras</td>
					<td class='w-20 text-right'>
						<a href='#' onclick=\"return detalleDelivery('$aux->ID_Pedido')\" data-toggle='modal' data-target='#modalmotorizado'>
							<em class='fas fa-list-ol color-tema' style='padding-right:5px'></em>
						</a>
					</td>
					<td class='w-20 text-right'>
						<a href='#' onclick='AsignarPedido($aux->ID_Pedido);' data-toggle='modal' data-target='#modalasignarmotorizado''>
							<em class='fas fa-motorcycle color-tema' style='padding-right:5px'></em>
						</a>
					</td>


				</tr>";
			}
		}
	}
	public function AsignarPedidoDelivery() {
		$ID_Zona=$this->input->post('ID_Zona');
		$ID_Perfil=$this->input->post('ID_Perfil');
		$ID=$this->input->post('ID');
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

		$this->Repartidor_model->InsertarImporteEnviado($ID_Perfil,$ID,$cien,$cincuenta,$veinte,$diez,$cinco,$dos,$uno,$cincuentaC,$veinteC,$diezC);
		$this->Repartidor_model->AsignarPedidoEstado($ID,$ID_Perfil);
		$this->Pedido_model->AsignarZonaPedidoDelivery($ID_Zona,$ID);
		
		redirect(base_url('Repartidor'));

	}

	public function motorizado(){
		$data = array();
		$data['pedidoAsignado'] = $this->Repartidor_model->misAsignadosMotorizado();
		$data['listImporte']=$this->Repartidor_model->totalImporteMotorizado();
		$data['sumar']=$this->Repartidor_model->totalDineroEnviado();
		$this->template->load('layout', 'pedidosAsignados_table', $data);
	}
	public function VerImporte($ID_Pedido){
		$sumar=$this->Repartidor_model->DineroEnviadoPedido($ID_Pedido);
		if(isset($sumar)){
			foreach($sumar->result() as $s){
				$a=$s->cien;
				$b=$s->cincuenta;
				$c=$s->veinte;
				$d=$s->diez;
				$e=$s->cinco;
				$f=$s->dos;
				$g=$s->uno;
				$h=$s->cincuentaC;
				$i=$s->veinteC;
				$j=$s->diezC;
	
				$totalAsignado=$a+$b+$c+$d+$e+$f+$g+$h+$i+$j;
				$totalAsignado=number_format($totalAsignado, 2, '.', '');
			}
		}
		$listImporteMotorizado = $this->Repartidor_model->selectImportePedido($ID_Pedido);
		if(isset($listImporteMotorizado)){
			foreach($listImporteMotorizado->result() as $aux){
		echo "<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 100
			<span class='badge badge-dark badge-pill'>$aux->cien</span>
			</li>
			<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 50
			<span class='badge badge-dark badge-pill'>$aux->cincuenta</span>
			</li>
			<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 20
			<span class='badge badge-dark badge-pill'>$aux->veinte</span>
			</li>
			<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 10
			<span class='badge badge-dark badge-pill'>$aux->diez</span>
			</li>
			<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 5
			<span class='badge badge-dark badge-pill'>$aux->cinco</span>
			</li>
			<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 2
			<span class='badge badge-dark badge-pill'>$aux->dos</span>
			</li>
			<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 1
			<span class='badge badge-dark badge-pill'>$aux->uno</span>
			</li>
			<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 0.50
			<span class='badge badge-dark badge-pill'>$aux->cincuentaC</span>
			</li>
			<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 0.20
			<span class='badge badge-dark badge-pill'>$aux->veinteC</span>
			</li>
			<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 0.10
			<span class='badge badge-dark badge-pill'>$aux->diezC</span>
			</li>
			<li class='list-group-item d-flex justify-content-between align-items-center text-primary'>total
			<span class='badge badge-primary badge-pill'>S/ $totalAsignado</span>
			</li>";
			
			}
		}
		
	
	}
	public function desasignar($ID_Pedido){

		$this->Repartidor_model->eliminarTImporteMotorizado($ID_Pedido);
		$this->Pedido_model->actualzarPedidoAsignado($ID_Pedido);

		$allpedidosAsignados =$this->Repartidor_model->allPedidosAsignados();
		if($allpedidosAsignados){
			foreach ($allpedidosAsignados->result() as $aux) {

	
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

				echo "
				<tr>
				
					<td>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
					<td>$aux->NombreMotorizado $aux->ApellidoMotorizado</td>
					<td><span class='badge badge-$color btn-xs'>$aux->Estado</span></td>
					
					<td class='label label-info'>$aux->Distrito</td>
					<td>$aux->Direccion</td>
					<td>$aux->Nombre"." "."$aux->ApellidoPaterno"." "."$aux->ApellidoMaterno</td>
					<td class='text-right'>$aux->CantidadLonchera</td>
					
					<td class='w-20 text-center'>
						<a href='#' onclick=\"return detalleDelivery('$aux->ID_Pedido')\" data-toggle='modal' data-target='#modalmotorizado'>
							<em class='fas fa-list-ol color-tema' style='padding-right:5px'></em>
						</a>
					</td>
					<td class='w-20 text-center'>
						<a href='#'onclick=\"return VerImporteMotorizado('$aux->ID_Pedido')\"  data-toggle='modal' data-target='#modalimporteMotorizado'>
							<em class='fas fa-eye color-tema' style='padding-right:5px'></em>
						</a>
					</td>
					<td class='w-20 text-center'>
						<a href='#' onclick='QuitarPedido($aux->ID_Pedido);'>
							<em class='fas fa-times color-tema' style='padding-right:5px'></em>
						</a>
					</td>


				</tr>";
			}
		}
	   
	}
	
}