<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insumo extends CI_Controller {

    public function __construct() {
        parent::__construct();

		$this->load->model('Insumo_model');
		$this->load->model('Almacen_model');
        sessionExist();
        validaToken();
    }

	public function index($filtro = "") {
        $data = array();


       // $data['Insumo_list'] = $this->Insumo_model->selectAll();

        $data = array( );
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
                $aux['StockAlmacen'] = $this->Insumo_model->StockPorAlmacen($row->ID_Insumo,desencriptar($_SESSION['ID_Almacen']));
				$aux['Abreviatura']= $row->Abreviatura;
				$aux['StockMinimo'] = $row->StockMinimo;
				$aux['UnidadMedida'] = $row->UnidadMedida;
                $aux['Costo'] = $row->Costo;
                $data['Insumo_list'][] = $aux;
            }
        }


        $this->template->load('layout','insumo_table',$data);
    }

    public function nuevo() {
        $data = array();

        $Insumo = (object)  array(
            'ID_Insumo'=>'',
            'Insumo'=>'',
			'Costo'=>0,
            'StockMinimo'=>0,
            'ID_Familia'=>'',
            'Atributo1'=>'',
            'Atributo2'=>'',
        );


		$data['insumo'] = $Insumo;
        $data['Unidad_Medida'] = $this->Insumo_model->selectAllUnidadMedida();
        $data['FamiliaInsumo'] = $this->Insumo_model->sellectAllFamiliaInsumo();
        $data['insumo_list'] = $this->Insumo_model->selectAll();

        $this->template->load('layout','insumo_data',$data);
    }

    public function actualizar(){

        $ID_Insumo = $this->input->post('ID_Insumo');
        $Insumo = $this->input->post('Insumo');
        $Costo = $this->input->post('Costo');
		$StockMinimo = $this->input->post('stockmin');
        $ID_UnidadMedida = $this->input->post('ID_UnidadMedida');
        $ID_Familia = $this->input->post('ID_Familia');
        $Atributo1 = $this->input->post('Atributo1');
        $Atributo2 = $this->input->post('Atributo2');


       if($ID_Insumo == ""){
            $this->session->set_userdata('success', 'El Insumo se registró correctamente');
            insertarLog("Registró el Insumo ".$Insumo);
            $ID_Insumo = $this->Insumo_model->insertar($Insumo,$Costo,$StockMinimo,$ID_UnidadMedida,$ID_Familia,$Atributo1,$Atributo2);
        }
       else{
            $this->session->set_userdata('success', 'El Insumo se actualizó correctamente');
            insertarLog("Actualizó el Insumo ".$Insumo);
            $this->Insumo_model->actualizar($ID_Insumo,$Insumo,$Costo,$StockMinimo,$ID_UnidadMedida,$ID_Familia,$Atributo1,$Atributo2);
        }
            redirect('Insumo');
    }

    public function Insumo($ID_Insumo){
        $data = array();
		$ID = desencriptar($ID_Insumo);

        $data['insumo'] = $this->Insumo_model->select($ID);
		$data['insumo_almacen'] = $this->Insumo_model->insumoalmacen($ID);
        $data['Unidad_Medida'] = $this->Insumo_model->selectAllUnidadMedida();
        $data['FamiliaInsumo'] = $this->Insumo_model->sellectAllFamiliaInsumo();
		$this->template->load('layout','insumo_data',$data);

    }

    public function eliminar($ID_Insumo){
        $ID = desencriptar($ID_Insumo);
        $this->session->set_userdata('success', 'El Insumo se eliminó correctamente');
        insertarLog("Eliminó el Insumo [".$ID."]");
        $this->Insumo_model->eliminar($ID);
        redirect('Insumo');

    }

    public function verDetalles($ID_Insumo ){

		$s="
		<div class='row'>
			<div class='col-md-10 offset-md-1'>
				<div class='table-responsive'>
					<table class='table table-striped maestra'>";

					$s=$s."<tr><td>Tipo</td><td>Fecha</td><td>Local-Almacen</td><td>Cantidad</td></tr>";
					$query =  $this->Insumo_model->verDetalles($ID_Insumo );


						if(!$query || $query->num_rows() < 1) { } else
						{
							foreach ($query->result() as $row) {

								if($row->quees == "Consumo" || $row->quees == "Ajuste"){
									$a="<em <i class='fas fa-arrow-up text-danger'></i></em>";
								}
								else{
									$a="<em <i class='fas fa-arrow-down text-success'></i></em>";
								}
									if($row->Tipo=="Tipo"){
										$tipo="";
									}else{
										$tipo="/".$row->Tipo;
									}

									$s=$s . "<tr><td>$a ".$row->quees.$tipo."</td><td>".  $row->FechaHora ."</td><td>" .  $row->Almacen ."</td><td>" .  $row->Cantidad ."</td></tr>";
							}
							}

							$s=$s."</table></div>
				</div>
			</div>";


		echo $s;
	}

	public function ajustes() {

		$data = array();
		$aux = (object)  array(
			'ID_Ajuste' => '',
			'ID_Almacen' => 0,
			'ID_AlmacenDestino' => 0,
			'Cantidad' => 1
		);

		$data['ajustes']=$aux;
		$data['almacen_list'] = $this->Almacen_model->selectAll();
		$data['insumo_list'] = $this->Insumo_model->selectAll();

		$this->template->load('layout','ajustes_data',$data);
	}

}
