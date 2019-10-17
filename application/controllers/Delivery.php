<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delivery extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model("Configuracion_model");
		$this->load->model("Menu_model");
		$this->load->model('Distrito_model');
		$this->load->model('Pedido_model');
		
	}

	public function index()
	{

		$data = array();
		$data['Insertar'] = 1;
		$data['distrito_list'] = $this->Distrito_model->selectAll();
		$data['precios'] = $this->Configuracion_model->configuracionRow();
		$data['menuDeliveryentrada'] = $this->Menu_model->MenuDelivery1();
		$data['menuDelivery1Segundo'] = $this->Menu_model->MenuDelivery1Segundo();
		$data['menuDelivery1Bebida'] = $this->Menu_model->MenuDelivery1Bebida();
		$data['platocarta'] = $this->Menu_model->platoCarta();
		


		if(isset($_SESSION['ID_Cliente'])){
			$ID_Cliente=desencriptar($_SESSION['ID_Cliente']);
			$data['existePedidoDelivery']=$this->Pedido_model->existePedidoDelivery($ID_Cliente);
			$data['pedidoCliente']= $this->Pedido_model->PedidoClienteDelivery($ID_Cliente);
		}

		$this->template->load('layout_delivery', 'delivery', $data);
	}
}
