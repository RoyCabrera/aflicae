<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Caja extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Caja_model');

        sessionExist();
        validaToken();
    }

    public function show_apertura(){

        $data=array();
        $data['apertura_cajas'] = $this->Caja_model->selectAll();
        $data['existe_apertura'] = $this->Caja_model->existeApertura();
        $data['existe_pedido'] = $this->Caja_model->existePedido_hoy();
        

        $this->template->load('layout', 'apertura_caja_table',$data);
    }

    public function apertura_caja(){
        $data = array();
        $aux = (object)array(
            'ID_Apertura' => "",
			'Q00010' => 0,
            'Q00020' => 0,
            'Q00050' => 0,
            'Q00100' => 0,
            'Q00200' => 0,
            'Q00500' => 0,
            'Q01000' => 0,
            'Q02000' => 0,
            'Q05000' => 0,
            'Q10000' => 0,
            'Q20000' => 0
		);

		$data['caja'] = $aux;
        $this->template->load('layout', 'apertura_caja_data',$data);

    }
    public function actualizarApertura_caja($ID_Apertura)
	{

		$data = array();
		$ID = desencriptar($ID_Apertura);
		$data['caja'] = $this->Caja_model->select($ID);

		$this->template->load('layout', 'apertura_caja_data', $data);
	}

    public function insertarAperturaCaja(){

        $ID_Apertura = desencriptar($this->input->post('ID_Apertura'));
        $diezCentimos = $this->input->post('Q00010');
        $veinteCentimos = $this->input->post('Q00020');
        $cincuentaCentimos = $this->input->post('Q00050');
        $unSol = $this->input->post('Q00100');
        $dosSoles = $this->input->post('Q00200');
        $cincoSoles = $this->input->post('Q00500');
        $diezSoles = $this->input->post('Q01000');
        $veinteSoles = $this->input->post('Q02000');
        $cincuentaSoles = $this->input->post('Q05000');
        $CienSoles = $this->input->post('Q10000');
        $doscientosSoles = $this->input->post('Q20000');

        if($ID_Apertura == ""){
            $this->Caja_model->insertarAperturaCaja($diezCentimos,$veinteCentimos,$cincuentaCentimos,$unSol,$dosSoles,$cincoSoles,$diezSoles,$veinteSoles,$cincuentaSoles,$CienSoles,$doscientosSoles);
        }else{
            $this->Caja_model->actualizarAperturaCaja($diezCentimos,$veinteCentimos,$cincuentaCentimos,$unSol,$dosSoles,$cincoSoles,$diezSoles,$veinteSoles,$cincuentaSoles,$CienSoles,$doscientosSoles,$ID_Apertura);
        }


        redirect('Caja/show_apertura');

    }

    public function eliminarApertura($ID){
        $eliminar = $this->Caja_model->eliminarApertura(desencriptar($ID));
        $_SESSION['eliminado'] = 'Este item se eliminó correctamente';
        redirect('Caja/show_apertura', 'refresh');
    }

    /*****CIERRE */

    public function show_cierre(){
        
        $data=array();
        $existe_cierre= $this->Caja_model->existe_cierre_hoy();
        $existe_cuadre= $this->Caja_model->existe_cuadre_hoy();

        if($existe_cuadre->num_rows()>=1){
            $row = $existe_cuadre->row();
            $aux = (object)array(
                'ID_Cierre' => $row->ID_Cierre,
                'Q00010' => $row->Q00010,
                'Q00020' => $row->Q00020,
                'Q00050' => $row->Q00050,
                'Q00100' => $row->Q00100,
                'Q00200' => $row->Q00200,
                'Q00500' => $row->Q00500,
                'Q01000' => $row->Q01000,
                'Q02000' => $row->Q02000,
                'Q05000' => $row->Q05000,
                'Q10000' => $row->Q10000,
                'Q20000' => $row->Q20000,
                'ImporteVisa'=>0,
                'ImporteMC'=>0
            );
        }else{
            $aux = (object)array(
                'ID_Cierre' => "",
                'Q00010' => 0,
                'Q00020' => 0,
                'Q00050' => 0,
                'Q00100' => 0,
                'Q00200' => 0,
                'Q00500' => 0,
                'Q01000' => 0,
                'Q02000' => 0,
                'Q05000' => 0,
                'Q10000' => 0,
                'Q20000' => 0,
                'ImporteVisa'=>0,
                'ImporteMC'=>0
            );
        }
        if($existe_cierre->num_rows()>=1){
            $data['disabled']="disabled";
        }else{
            $data['disabled']="";
        }
        /* $data['apertura_cajas'] = $this->Caja_model->selectAll();
        $data['existe_apertura'] = $this->Caja_model->existeApertura(); */
       

		$data['caja'] = $aux;
        $data['importe_apertura']=$this->Caja_model->importe_apertura_hoy();
        $data['importe_ventas']=$this->Caja_model->importe_ventas_hoy();
        $data['importe_visa']=$this->Caja_model->importe_visa_hoy();
        $data['importe_mastercard']=$this->Caja_model->importe_mastercard_hoy();
        $data['importe_cobros_hoy']=$this->Caja_model->importe_cobros_hoy();
        $data['existe_cierre'] = $this->Caja_model->existe_cierre_hoy();
        //importe de apertura
        //ventas del dia
        //cobros de deudas
        $this->template->load('layout', 'cierre_caja_data',$data);
    }
    public function verificar_cierre(){

        $Q20000= $this->input->post("Q20000");//doscientos soles
        $Q10000= $this->input->post("Q10000");//cien soles
        $Q05000= $this->input->post("Q05000");//cincuenta soles
        $Q02000= $this->input->post("Q02000");// veinte soles
        $Q01000= $this->input->post("Q01000");//diez soles
        $Q00500= $this->input->post("Q00500");// cinco soles
        $Q00200= $this->input->post("Q00200");// dos soles
        $Q00100= $this->input->post("Q00100");// un sol
        $Q00050= $this->input->post("Q00050");//cincuenta centimos
        $Q00020= $this->input->post("Q00020");//veinte centimos
        $Q00010= $this->input->post("Q00010");//diez centimos
        $ID_Cierre= $this->input->post("ID_Cierre");

        if($Q20000 == ""){
            $Q20000=0;
        }
        if($Q10000 == ""){
            $Q10000=0;
        }
        if($Q05000 == ""){
            $Q05000=0;
        }
        if($Q02000 == ""){
            $Q02000=0;
        }
        if($Q01000 == ""){
            $Q01000=0;
        }
        if($Q00500 == ""){
            $Q00500=0;
        }
        if($Q00200 == ""){
            $Q00500=0;
        }
        if($Q00100 == ""){
            $Q00100=0;
        }
        if($Q00050 == ""){
            $Q00050=0;
        }
        if($Q00020 == ""){
            $Q00020=0;
        }
        if($Q00010 == ""){
            $Q00010=0;
        }


/*
        $ImporteMC = $this->input->post("ImporteMC");
        $ImporteVisa = $this->input->post("ImporteVisa"); */

        // sumnar y verificar si concide con el total


        $total = ($Q20000 *200)+($Q10000 *100)+($Q05000 *50)+($Q02000 *20)+($Q01000 *10)+($Q00500 *5)+($Q00200 *2)+($Q00100 *1)+($Q00050 *0.50)+($Q00020 *0.20)+($Q00010 *0.10);
        //$importe_tarjeta = $ImporteVisa+$ImporteMC;

        //$total = $moneda_billete+$importe_tarjeta;

        $importe_apertura=$this->Caja_model->importe_apertura_hoy();
        $importe_ventas=$this->Caja_model->importe_ventas_hoy();
        $importe_cobros_hoy=$this->Caja_model->importe_cobros_hoy();
        $monto = $importe_apertura->total+$importe_ventas->total+$importe_cobros_hoy->total;

        if($total == $monto){
            if($ID_Cierre == ""){
                //insertar
                $this->Caja_model->insertar_cierre_caja($Q20000,$Q10000,$Q05000,$Q02000,$Q01000,$Q00500,$Q00200,$Q00100,$Q00050,$Q00020,$Q00010);
            }else{
                //actualizar
                $this->Caja_model->actualizar_cierre_caja($ID_Cierre,$Q20000,$Q10000,$Q05000,$Q02000,$Q01000,$Q00500,$Q00200,$Q00100,$Q00050,$Q00020,$Q00010);
            }
            
           
            echo 1;
        }else{
           
          
            echo 0;
        }

    }

    public function Cierre()
    {
        $data=array();
        $data['cierre_caja'] = $this->Caja_model->selectHoyCierre();

        //$data['existe_apertura'] = $this->Caja_model->existeApertura();
        $this->template->load('layout', 'cierre_caja_table',$data);
    }

    public function CerrarCaja()
    {
        $ID_Cierre= $this->input->post("ID_Cierre");
        $this->Caja_model->CerrarCaja($ID_Cierre);
        $this->Cierre();

    }
    public function CierreCajaAll()
    {
        $data=array();
        $data['cierre_caja'] = $this->Caja_model->selectAllCierre();

        //$data['existe_apertura'] = $this->Caja_model->existeApertura();
        $this->template->load('layout', 'cierre_caja_all_table',$data);
    }




}
?>