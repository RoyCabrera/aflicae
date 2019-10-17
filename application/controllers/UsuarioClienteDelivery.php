<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsuarioClienteDelivery extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->model('Tipodocumento_model');
        $this->load->model('Distrito_model');
       
    }
    public function actualizarCliente()
    {

        $ID_Perfil = 7;
        $ID_Almacen = 1;
        $Correo = $this->input->post('email');
        $Nombre = $this->input->post('nombre');
        $ApellidoPaterno = $this->input->post('apellidopaterno');
        $ApellidoMaterno = $this->input->post('apellidomaterno');
        $Telefono = $this->input->post('telefono');
        $Clave = $this->input->post('clave');
        $Direccion = $this->input->post('direccion');
        $Distrito = $this->input->post('distrito');
        $Piso = $this->input->post('piso');
        $Empresa = $this->input->post('empresa');
        $Insertar = $this->input->post('Insertar');

        if ($Insertar) {
            //$existeCorreo = $this->Usuario_model->existeCorreo($Correo);
            $existeCorreo = $this->Usuario_model->existeCorreoClienteDelivery($Correo);
            if ($existeCorreo) {
                $msg = "ya existe el correo : ";
                return  $msg . $existeCorreo;
            }
            $this->Usuario_model->insertarClienteDelivery($Correo, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $Piso, $Empresa, $ID_Perfil, $Telefono, $Clave, $ID_Almacen, $Direccion, $Distrito);
        } else {

            $this->Usuario_model->actualizarClienteDelivery($Correo, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $Piso, $Empresa, $ID_Perfil, $Telefono, $Clave, $ID_Almacen, $Direccion, $Distrito);
        }

        redirect('Delivery');
    }

}