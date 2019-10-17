<?php
class Token_model extends CI_Model {

    public function __construct() {
    parent::__construct();
    $this->load->database();
    //$this->DB2 = $this->load->database(coneccion(), TRUE);
    }


    public function insertarToken($IP,$Web,$SO,$Token){
		date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $data = array(
            'UsuarioAlta' => desencriptar($this->session->userdata('Correo')),
            'FechaAlta' => $now->format('Y-m-d H:i:s'),
            'IP' => $IP,
            'Web' => $Web,
            'SO' => $SO,
            'Token' => $Token
        );

        return $this->db->insert('TUsuarioToken',$data);
    }
    public function insertarToken2($IP,$Web,$SO,$Token){
		date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $data = array(
            'UsuarioAlta' => desencriptar($this->session->userdata('Email')),
            'FechaAlta' => $now->format('Y-m-d H:i:s'),
            'IP' => $IP,
            'Web' => $Web,
            'SO' => $SO,
            'Token' => $Token
        );

        return $this->db->insert('TUsuarioToken',$data);
    }

    public function validaToken(){
        $UsuarioAlta = desencriptar($this->session->userdata('Correo'));
        $sql= "SELECT Token FROM TUsuarioToken WHERE UsuarioAlta = '".$UsuarioAlta."' ORDER BY  ID_UsuarioToken DESC LIMIT 1 ";
        $result = $this->db->query($sql);
        if(!$result || $result->num_rows() < 1) {return false;}
        return $result->row()->Token;

    }


}
?>
