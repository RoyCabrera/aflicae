<?php

class Cliente_model extends CI_Model {

    public function __construct() {
    parent::__construct();
    $this->load->database();

	}
	public function insertarCliente($tipo_documento,$dni,$direccion,$razonsocial,$correo) {

		$data = array(
            //'nombre'=>$row->Nombre,

			'Direccion'=>$direccion,
			'ID_Documento'=>$tipo_documento,
			'Numero_Documento'=>$dni,
			'Correo'=>$correo,
			'RazonSocial'=>$razonsocial,

        );
    //    print_r($data);
     //   die;
        $this->db->insert('MCliente', $data);
        return $this->db->insert_id();
	}

	public function actualizarCliente($ID_Cliente,$tipo_documento,$dni,$direccion,$razonsocial,$correo) {
		$data = array(
            //'nombre'=>$row->Nombre,

			'Direccion'=>$direccion,
			'ID_Documento'=>$tipo_documento,
			'Numero_Documento'=>$dni,
			'Correo'=>$correo,
			'RazonSocial'=>$razonsocial,
        );
		$this->db->where('ID_Cliente', $ID_Cliente);
        return $this->db->update('MCliente', $data);
	}

}
