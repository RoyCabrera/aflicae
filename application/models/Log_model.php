<?php
class Log_model extends CI_Model {

    public function __construct() {
    parent::__construct();
    $this->load->database();
    //$this->DB2 = $this->load->database(coneccion(), TRUE);
    }

    public function insertarLog($Log){
		date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $data = array(
            'UsuarioAlta' => $this->encryption->decrypt($this->session->userdata('Correo')),
            'FechaAlta' => $now->format('Y-m-d H:i:s'),
            'Log' => $Log
        );

        return $this->db->insert('TLog',$data);
    }

}
?>
