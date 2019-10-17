<?php
class Configuracion_model extends CI_Model {

    public function __construct() {

    parent::__construct();
    $this->load->database();

    }
    public function selectAll() {

		$sql = "SELECT * FROM TConfiguracion";

		$result= $this->db->query($sql);

		foreach($result->result() as $row):

			$ID_Empresa = $row->ID_Empresa;;
			$Empresa= $row->Empresa;
			$Ruc = $row->Ruc;
			$Correo = $row->Correo;
			$Direccion = $row->Direccion;
			$Telefono = $row->Telefono;
			$PrecioMenu = $row->PrecioMenu;
			$PrecioDelivery1=$row->PrecioDelivery1;
			$PrecioDelivery2=$row->PrecioDelivery2;
			$Imagen = $row->Imagen;
			$SerieFactura = $row->SerieFactura;
			$SerieBoleta = $row->SerieBoleta;
			$Igv=$row->Igv;
			$NumeroFactura=$row->NumeroFactura;
			$NumeroBoleta = $row->NumeroBoleta;
			$RutaApi = $row->RutaApi;
			$TokenNubefact =$row->TokenNubefact;
			$AnchoMesa = $row->AnchoMesa;

		endforeach;

		$config = (object)  array(
					'ID_Empresa'=>$ID_Empresa,
            'Empresa' => $Empresa,
            'Ruc' => $Ruc,
            'Correo' => $Correo,
            'Direccion' => $Direccion,
            'Telefono' => $Telefono,
			'PrecioMenu' => $PrecioMenu,
			'PrecioDelivery1'=>$PrecioDelivery1,
			'PrecioDelivery2'=>$PrecioDelivery2,
			'SerieFactura'=>$SerieFactura,
			'SerieBoleta'=>$SerieBoleta,
			'Igv'=>$Igv,
			'NumeroFactura'=>$NumeroFactura,
			'NumeroBoleta'=>$NumeroBoleta,
			'RutaApi' =>$RutaApi,
			'TokenNubefact'=>$TokenNubefact,
			'AnchoMesa'=>$AnchoMesa,
			'Imagen' => $Imagen);

		if(!$config){
			return false;
		}
		return $config;

	}

	public function verPrecioMenu(){
		$sql = "SELECT PrecioMenu FROM TConfiguracion";

		$result= $this->db->query($sql);

		foreach($result->result() as $row)
				{
				return	$row->PrecioMenu;
				}

	}

	public function actualizar($ID_Empresa,$Empresa,$Ruc,$Direccion,$Correo,$Telefono,$PrecioMenu,$PrecioDelivery1,$PrecioDelivery2,$SerieFactura,$Igv,$NumeroFactura,$SerieBoleta,$NumeroBoleta,$RutaApi,$TokenNubefact,$AnchoMesa){
		$data = array(
			'ID_Empresa' => $ID_Empresa,
			'Empresa' => $Empresa,
			'Ruc' => $Ruc,
			'Correo' => $Correo,
			'Direccion' => $Direccion,
			'Telefono' => $Telefono,
			'PrecioMenu' => $PrecioMenu,
			'PrecioDelivery1'=>$PrecioDelivery1,
			'PrecioDelivery2'=>$PrecioDelivery2,
			'SerieFactura'=>$SerieFactura,
			'Igv'=>$Igv,
			'NumeroFactura'=>$NumeroFactura,
			'SerieBoleta'=>$SerieBoleta,
			'NumeroBoleta'=>$NumeroBoleta,
			'RutaApi'=>$RutaApi,
			'TokenNubefact'=>$TokenNubefact,
			'AnchoMesa'=>$AnchoMesa
			);

		$this->db->where('ID_Empresa', $ID_Empresa);
		return $this->db->update('TConfiguracion', $data);

	}

	public function configuracionRow(){
		$sql = "SELECT * FROM TConfiguracion";
		$result = $this->db->query($sql);

		if(!$result){
			return false;
		}
		return $result;


	}

	public function actualizarNumeroFactura($numero) {
		$data = array(
			'NumeroFactura'=>$numero+1
		);

    	return $this->db->update('TConfiguracion', $data);
	}
	public function actualizarNumeroBoleta($numero) {
		$data = array(
			'NumeroBoleta'=>$numero+1
		);

    	return $this->db->update('TConfiguracion', $data);
	}

	public function subirfoto($Ruta,$ID){
		$ID_Empresa=desencriptar($ID);
        $data = array('Imagen' => $Ruta);
        $this->db->where('ID_Empresa',$ID_Empresa);
        return $this->db->update('TConfiguracion',$data);
	}

	public function AnchoMesa() {
		$sql="SELECT * FROM TConfiguracion";
		$result=$this->db->query($sql);


		if(!$result){return false;}
		return $result;
	}

}
