<?php

class Distrito_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function selectAll(){
		$sql = "SELECT * FROM MDistrito";
		$result = $this->db->query($sql);

		if(!$result) {
			return false;
		}

		return $result;
	}
}
