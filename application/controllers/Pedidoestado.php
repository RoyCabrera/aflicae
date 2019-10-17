<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidoestado extends CI_Controller {

   public function __construct() {
        parent::__construct();

        $this->load->model('Pedido_model');
   		/* $this->load->model('Mesa_model');
   		$this->load->model('Menu_model'); */
        sessionExist();
        validaToken();
    }

    /* public function index($filtro = "")
	{
        $data = array();

        $data['pedido_list'] = $this->Pedido_model->selectAll();
        $this->template->load('layout','pedido_table',$data);
	} */

	public function estado(){


		$ID_Menu = $this->input->post('menu');
		$ID_TLPedido = desencriptar($this->input->post('id'));
		$ID_Pedido = encriptar($this->input->post('idpedido'));

		$this->Pedido_model->estadodetalle($ID_TLPedido);
		$this->Pedido_model->insertarsalida($ID_Menu);

		redirect(base_url('Pedido/detalle/'.$ID_Pedido));

		/* $this->template->load('layout','salida',$data);
		$this->Pedido_model->insertarsalida(); */

	}

}
