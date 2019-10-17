<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Menu_model');
        sessionExist();
        validaToken();
    }

	public function index($filtro = "") {
        $data = array();
        $data['Menu_list'] = $this->Menu_model->selectAll();
        $this->template->load('layout','menu_table',$data);
	}

    public function MenuHoy($id_menu,$menuhoy) {


        $this->Menu_model->actualizarMenuHoy($id_menu,$menuhoy);

        redirect('Menu');
	}

	public function MenuHoy2($id_menu,$menuhoy) {


        $this->Menu_model->actualizarMenuHoy2($id_menu,$menuhoy);

        redirect('Menu');
	}

	public function MenuHoy3($id_menu,$menuhoy) {


        $this->Menu_model->actualizarMenuHoy3($id_menu,$menuhoy);

        redirect('Menu');
	}

	public function EsDelivery($id_menu,$EsDelivery) {


        $this->Menu_model->actualizarEsDelivery($id_menu,$EsDelivery);

        redirect('Menu');
	}

	public function EsMenuDelivery($id_menu,$EsMenuDelivery) {


        $this->Menu_model->actualizarMenuDelivery($id_menu,$EsMenuDelivery);

        redirect('Menu');
	}

	public function EsMenuDelivery2($id_menu,$EsMenuDelivery2) {


        $this->Menu_model->actualizarMenuDelivery2($id_menu,$EsMenuDelivery2);

        redirect('Menu');
    }

    public function nuevo() {
        $data = array();

        $Sum = (object)  array(
            'ID_Menu' => '',
            'Menu' => '',
            'Precio' => 0,
            'Costo' =>0,
            'PrecioDelivery'=>0,
            'ImagenMenu' => '');


        $data['menu'] = $Sum;
        $data['tab'] = 'info';
        $data['familia_list'] = $this->Menu_model->selectAllFamilia();

        $this->template->load('layout','menu_data',$data);
    }

    public function actualizar() {
        $ID_Menu = desencriptar($this->input->post('ID_Menu'));
        $Menu = $this->input->post('Menu');
        $Costo = $this->input->post('Costo');
        $Precio = $this->input->post('Precio');
        $ID_Familia = $this->input->post('ID_Familia');
        $PrecioDelivery = $this->input->post('PrecioDelivery');


        if($ID_Menu == ""){
            $this->session->set_userdata('success', 'El Plato se registró correctamente');

            $this->Menu_model->insertar( $Menu,$Costo,$Precio, $ID_Familia,$PrecioDelivery);
        }else{
            $this->session->set_userdata('success', 'El Plato se actualizó correctamente');

            $this->Menu_model->actualizar( $ID_Menu,$Menu,$Costo,$Precio, $ID_Familia,$PrecioDelivery);
        }


		if(!empty($_FILES['file']['name'])) {
            // normalC:\xampp\htdocs\Sistemas\Empresa\Virtual360
            $url = subirimagen('assets/img/plato/','/plato/','file');
            if($url){
                $this->Menu_model->subirfoto('assets/img/plato/'.$_FILES['file']['name'],$ID_Menu);
                // Thumbnail
                subirimagenthumbnail('assets/img/plato/thumbnails/','/plato/'.$_FILES['file']['name'],'/plato/thumbnails/');
                $this->Menu_model->subirfotoThumbnail('assets/img/plato/thumbnails/'.$_FILES['file']['name'],$ID_Menu);

            }
        }


            redirect('Menu');


    }

    public function menu($ID_Menu) {
        $data = array();
        $ID = desencriptar($ID_Menu);
        $data['menu'] = $this->Menu_model->select($ID);
      //  $data['edificio_list'] = $this->Edificio_model->selectAll();
      $data['familia_list'] = $this->Menu_model->selectAllFamilia();

        $this->template->load('layout','menu_data',$data);
    }

    public function eliminar($ID_Menu) {
        $ID = desencriptar($ID_Menu);
        $this->session->set_userdata('success', 'El Menu se eliminó correctamente');
        insertarLog("Eliminó el Menu [".$ID."]");
            $this->Menu_model->eliminar($ID);

                        redirect('Menu');


    }

}
