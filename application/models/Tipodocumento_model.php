<?php
class Tipodocumento_model extends CI_Model {
    public function __construct() {
    parent::__construct();
    $this->load->database();
    //$this->DB2 = $this->load->database(coneccion(), TRUE);
    }
    public function selectAll() {
        $sql= "SELECT * FROM TTipoDocumento";
        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result;
    }
}
?>
