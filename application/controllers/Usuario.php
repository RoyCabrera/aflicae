<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->model('Tipodocumento_model');
        $this->load->model('Distrito_model');
        sessionExist();
        validaToken();
    }

    public function index($filtro = "")
    {
        $data = array();
        $data['Usuario_list'] = $this->Usuario_model->selectAll();
        $this->template->load('layout', 'usuario_table', $data);
    }

    public function nuevo()
    {
        $data = array();

        $usuario = (object)array(
            'Correo' => '',
            'Nombre' => '',
            'ApellidoPaterno' => '',
            'ApellidoMaterno' => '',
            'ID_Perfil' => '',
            'ID_TipoDocumento' => '',
            'Documento' => '',
            'Telefono' => '',
            'Clave' => '',
            'Tema' => '',
            'ID_Almacen' => '',
            'Imagen' => ''
        );

        $data['Insertar'] = 1;
        $data['usuario'] = $usuario;
        $data['tab'] = 'info';
        $data['tipodocumento_list'] = $this->Tipodocumento_model->selectAll();
        $data['almacen_list'] = $this->Usuario_model->selectAllAlmacen();
        $data['tipoperfil_list'] = $this->Usuario_model->selectAllTipoPerfil();

        $this->template->load('layout', 'usuario_data', $data);
    }

    public function nuevoCliente()
    {
        $data = array();

        $usuario = (object)array(
            'Correo' => '',
            'Nombre' => '',
            'ApellidoPaterno' => '',
            'ApellidoMaterno' => '',
            'ID_Perfil' => 'Cliente',
            'ID_TipoDocumento' => '',
            'Documento' => '',
            'Telefono' => '',
            'Clave' => '',
            'Tema' => '',
            'ID_Almacen' => 'Almacen 1',
            'Direccion' => '',
            'Departamento' => 'LIMA',
            'Distrito' => ''
        );

        $data['Insertar'] = 1;
        $data['usuario'] = $usuario;
        $data['tab'] = 'info';

        $data['tipodocumento_list'] = $this->Tipodocumento_model->selectAll();
        $data['almacen_list'] = $this->Usuario_model->selectAllAlmacen();
        $data['tipoperfil_list'] = $this->Usuario_model->selectAllTipoPerfil();
        $data['distrito_list'] = $this->Distrito_model->selectAll();
        $this->template->load('layout_cliente', 'usuariocliente_data', $data);
    }

    public function actualizar()
    {
        $Correo = $this->input->post('Correo');
        $Nombre = $this->input->post('Nombre');
        $ApellidoPaterno = $this->input->post('ApellidoPaterno');
        $ApellidoMaterno = $this->input->post('ApellidoMaterno');
        $ID_TipoDocumento = $this->input->post('ID_TipoDocumento');
        $Documento = $this->input->post('Documento');
        $ID_Perfil = $this->input->post('ID_Perfil');
        $Telefono = $this->input->post('Telefono');
        $Clave = $this->input->post('Clave');
        $Insertar = $this->input->post('Insertar');
        $ID_Almacen = $this->input->post('ID_Almacen');
        $Direccion = "";
        $Distrito = "";

        if ($Insertar) {
            $existeCorreo = $this->Usuario_model->existeCorreo($Correo);
            if ($existeCorreo) {
                $this->session->set_userdata('error', 'El correo que intentó registrar ya existe');
                insertarLog("Intentó registrar un usuario con el mismo correo [" . $Correo . "]");
                redirect('Usuario');
            }

            $this->session->set_userdata('success', 'El usuario se registró correctamente');
            insertarLog("Registró el usuario " . $Correo);
            $this->Usuario_model->insertar($Correo, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $ID_TipoDocumento, $Documento, $ID_Perfil, $Telefono, $Clave, $ID_Almacen, $Direccion, $Distrito);
        } else {
            $this->session->set_userdata('success', 'El usuario se actualizó correctamente');
            insertarLog("Actualizó el usuario " . $Correo);
            $this->Usuario_model->actualizar($Correo, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $ID_TipoDocumento, $Documento, $ID_Perfil, $Telefono, $Clave, $ID_Almacen, $Direccion, $Distrito);
        }

        if (!empty($_FILES['file']['name'])) {
            // normalC:\xampp\htdocs\Sistemas\Empresa\Virtual360
            $url = subirimagen('assets/img/usuario/', '/usuario/', 'file');
            if ($url) {
                $this->Usuario_model->subirfoto('assets/img/usuario/' . $_FILES['file']['name'], $Correo);
                // Thumbnail
                subirimagenthumbnail('assets/img/usuario/thumbnails/', '/usuario/' . $_FILES['file']['name'], '/usuario/thumbnails/');
                $this->Usuario_model->subirfotoThumbnail('assets/img/usuario/thumbnails/' . $_FILES['file']['name'], $Correo);
                //actualizar session
                if ($Correo == desencriptar($this->session->userdata('Correo'))) {
                    $this->session->set_userdata('Imagen', encriptar('assets/img/usuario/thumbnails/' . $_FILES['file']['name']));
                }
            }
        }


        redirect('Usuario');
    }

    

    public function Usuario($Correo, $tab = "info")
    {
        $data = array();
        $ID = desencriptar($Correo);
        $data['Insertar'] = 0;
        $data['usuario'] = $this->Usuario_model->select($ID);
        $data['tipodocumento_list'] = $this->Tipodocumento_model->selectAll();
        $data['tipoperfil_list'] = $this->Usuario_model->selectAllTipoPerfil();
        $data['almacen_list'] = $this->Usuario_model->selectAllAlmacen();
        $data['tab'] = $tab;

        $this->template->load('layout', 'usuario_data', $data);
    }

    public function baja($Correo)
    {
        $ID = desencriptar($Correo);
        insertarLog("Dió de baja al usuario [" . $ID . "] ");
        $this->session->set_userdata('success', 'Se dió de baja al usuario correctamente');
        $this->Usuario_model->baja($ID);
        redirect('Usuario');
    }

    public function alta($Correo)
    {
        $ID = desencriptar($Correo);
        insertarLog("Dió de alta nuevamente al usuario [" . $ID . "] ");
        $this->session->set_userdata('success', 'Se dió de alta nuevamente al usuario correctamente');
        $this->Usuario_model->alta($ID);
        redirect('Usuario');
    }
}
