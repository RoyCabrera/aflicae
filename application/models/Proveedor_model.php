<?php
class Proveedor_model extends CI_Model {

    public function __construct() {

    parent::__construct();
    $this->load->database();

    }
    public function selectAll() {
        $sql = "SELECT * FROM MProveedor";
        $result = $this->db->query($sql);
        if(!$result){
            return false;
        }
        return $result;
    }
}