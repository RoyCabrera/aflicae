<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manual extends CI_Controller {

    public function __construct() {
        parent::__construct();

        sessionExist();
        validaToken();
	}
	public function index() {

		$this->template->load('layout','ManualUsuario');
	}
}
