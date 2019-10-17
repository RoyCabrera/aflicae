<?php

class Factura_model extends CI_Model {

    public function __construct() {
    parent::__construct();
    $this->load->database();

	}

	public function insertarFactura($serie,$numero,$ruc,$razonsocial,$neto,$total,$igvTotal) {

		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$netoP = number_format($neto,2);
		$totalP = number_format($total,2);
		$igvTotalP = number_format($igvTotal,2);

		$data = array(
            //'nombre'=>$row->Nombre,
			'FechaHora'=>$now->format('Y-m-d H:i:s'),
			'Serie'=>$serie,
			'Numero'=>$numero,
			'Ruc'=>$ruc,
			'RazonSocial'=>$razonsocial,
			'Neto'=>$netoP,
			'Total'=>$totalP,
			'IGV'=>$igvTotalP
		);

		$this->db->insert('TFactura', $data);
        return $this->db->insert_id();
	}
}
