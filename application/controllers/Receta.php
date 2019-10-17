<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receta extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Receta_model');
        $this->load->model('Insumo_model');
        sessionExist();
        validaToken();
    }

	public function index($filtro = "")
	{
        $data = array();



        $data['Receta_list'] = $this->Receta_model->selectAll();
        $this->template->load('layout','receta_table',$data);
    }

    public function Insumo($ID_Menu)
    {
        $data = array();

        $ID_Menu=desencriptar($ID_Menu);
        $NombreMenu=$this->Receta_model->devolverNombre($ID_Menu);


        $data['Receta_list'] = $this->Receta_model->selectAll($ID_Menu);
        $data['NombreMenu'] =   $NombreMenu;
        $data['ID_Menu'] =    $ID_Menu;

        $data['nuevo'] = 0;
        $this->template->load('layout','receta_table',$data);
	}
	public function receta($ID,$ID_Menu)
    {
	   $data = array();
	   $ID_Receta = desencriptar($ID);

	   $data['receta'] = $this->Receta_model->select($ID,$ID_Menu);
	   $data['Insumo_list'] = $this->Insumo_model->selectAll();

        $this->template->load('layout','receta_data',$data);
    }

    public function nuevo($ID_Menu)
	{
        $data = array();

        $Sum = (object)  array(
            'ID_Menu' => $ID_Menu,
            'ID_Insumo' => '',
            'Insumo' => '',
            'Cantidad' =>0,
            'Imagen' => '');

        $data['Insumo_list'] = $this->Insumo_model->selectAll();
        $data['receta'] = $Sum;
        $data['nuevo'] = 1;
        $data['tab'] = 'info';


        $this->template->load('layout','receta_data',$data);
    }

    public function actualizar(){

        $ID_Menu = desencriptar($this->input->post('ID_Menu'));
        $ID_Insumo= $this->input->post('ID_Insumo');
        $Cantidad= $this->input->post('Cantidad');
        $nuevo= $this->input->post('nuevo');


        if( $nuevo == 1){
            $this->session->set_userdata('success', 'La receta se registró correctamente');
           // insertarLog("Registró el SUM ".$Sum);
           $this->Receta_model->insertar($ID_Menu,$ID_Insumo,$Cantidad);
        }else{
            $this->session->set_userdata('success', 'La receta actualizó correctamente');
            //insertarLog("Actualizó el SUM ".$Sum);
            $this->Receta_model->actualizar($ID_Menu,$ID_Insumo,$Cantidad);
        }
            redirect('Receta/Insumo/'. encriptar($ID_Menu));


    }




    public function eliminar($ID_Menu,$ID_Insumo){

        $ID = desencriptar($ID_Insumo);
        $this->session->set_userdata('success', 'El Insumo se eliminó correctamente');
        insertarLog("Eliminó el Insumo [".$ID."]");
            $this->Receta_model->eliminar($ID_Menu,$ID);


                $aux=encriptar($ID_Menu);
                        redirect('Receta/Insumo/'.$aux);


    }
  /*  public function nuevo($ID_Menu) {

        $data = array();
        $ID = desencriptar($ID_Insumo);


        $receta = (object)  array(
            'ID_Insumo' => '',
            'ID_Menu' => '',
            'Cantidad' => 0
            );

        $data['menu'] = $receta;

        $data['Insumo_list'] = $this->Insumo_model->selectAll();

        $this->template->load('layout','receta_data',$data);

    }*/

}
