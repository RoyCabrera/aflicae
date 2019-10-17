<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Almacen extends CI_Controller {

   public function __construct() {

		parent::__construct();

		$this->load->model('Insumo_model');
		$this->load->model('Almacen_model');
		$this->load->model('Pedido_model');
		sessionExist();
		validaToken();

   }

	public function index() {

		$data = array();

		$data['traspaso_list'] = $this->Almacen_model->selectAllTraspaso();
		$this->template->load('layout','almacen_table',$data);

	}

	public function nuevo(){
		$data = array();
		$aux = (object)  array(
			'ID_Traspaso' => '',
			'ID_AlmacenOrigen' => 0,
			'ID_AlmacenDestino' => 0,
			'Cantidad' => 1);

		$data['traspaso']=$aux;
		$data['almacen_list'] = $this->Almacen_model->selectAll();
		$data['insumo_list'] = $this->Insumo_model->selectAll();

		$this->template->load('layout','almacen_data',$data);

	}

	public function insumoAlmacen($ID_Almacen){

		$InsumoAlmacen=$this->Almacen_model->insumoAlmacen($ID_Almacen);

		foreach($InsumoAlmacen->result() as $insumo){
			if($insumo->Stock >= 1){

				$html="<option value='".$insumo->ID_Insumo."'>".$insumo->Insumo."(Stock:  ".$insumo->Stock." "."$insumo->Abreviatura".")</option>";
				echo $html;

			}
		}


	}

	public function traspaso(){

		$ID_AlmacenOrigen = $this->input->post('ID_AlmacenOrigen');
        $ID_AlmacenDestino = $this->input->post('ID_AlmacenDestino');
        $ID_Insumo= $this->input->post('ID_Insumo');
        $cantidad= $this->input->post('cantidad');

		$stock=$this->Insumo_model->StockPorAlmacen($ID_Insumo,	$ID_AlmacenOrigen);

		if($cantidad>$stock)
		{
			$this->session->set_userdata('error', 'El traspaso no se puede realizar porque el stock quedaría en negativo');
			redirect('Almacen/nuevo/');
		}
		else
		{

			$this->Almacen_model->insertarTraspaso($ID_AlmacenOrigen,$ID_AlmacenDestino,$ID_Insumo,$cantidad);

		}
			redirect('Almacen/nuevo/');
	}

	public function Ajuste() {

		//$ID_Ajuste = $this->input->post('ID_Ajuste');
		$Tipo = $this->input->post('Tipo');
		$ID_Almacen = $this->input->post('ID_AlmacenOrigen');
		$ID_Insumo = $this->input->post('ID_Insumo');
		$Cantidad = $this->input->post('cantidad');

		$stock=$this->Insumo_model->StockPorAlmacen($ID_Insumo,	$ID_Almacen);

		if($Cantidad>$stock)
		{
			$this->session->set_userdata('error', 'El ajuste no se puede realizar porque el stock quedaría en negativo');
			redirect('Insumo/Ajustes/');
		}
		else
		{
			$this->Almacen_model->insertarAjuste($ID_Insumo,$Cantidad,$ID_Almacen,$Tipo);
			$this->Pedido_model->restar($ID_Insumo,$Cantidad,$ID_Almacen);

		}
			redirect('Insumo/Ajustes/');

	}

}
