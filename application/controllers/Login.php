<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }

 /*    public function index()
    {
        if ($this->session->userdata('token')) {
          
            redirect('Pedido');

        } else {
            $this->load->view('login');
        }
    } */
    public function index()
	{
        if($this->session->userdata('token')){
            redirect('Admin');
        }else{
            $this->load->view('login');
        }
    }


    public function valida()
    {

        $correo = $this->input->post('correo');
        $clave = $this->input->post('clave');

        $valida = $this->Login_model->valida($correo);
        if ($valida) {
            if ($valida->Clave == $clave) {
                if ($valida->Baja == null) {
                    $data = array(
                        'Correo'  => encriptar($valida->Correo),
                        'NombreCompleto'     => encriptar($valida->Nombre . " " . $valida->ApellidoPaterno . " " . $valida->ApellidoMaterno),
                        'ID_Perfil' => encriptar($valida->ID_Perfil),
                        'Perfil' => encriptar($valida->Perfil),
                        'Tema' => encriptar($valida->Tema),
                        'Imagen' => encriptar($valida->ImagenThumbnail),
                        'token' => bin2hex(openssl_random_pseudo_bytes(64)),
                        'ID_Almacen' => encriptar($valida->ID_Almacen),
                    );

                    $this->session->set_userdata($data);


                    $this->Token_model->insertarToken($this->getRealIP(), $this->isWeb(), $this->getOS(), $data['token']);
                    insertarLog("Ingreso al sistema");
                    if (desencriptar($_SESSION['ID_Perfil']) == 1 || desencriptar($_SESSION['ID_Perfil']) == 2) {
                        redirect('Admin');
                    }
                    if (desencriptar($_SESSION['ID_Perfil']) == 3) {
                        redirect('Pedido');
                    }
                    if (desencriptar($_SESSION['ID_Perfil']) == 4) {
                        redirect('Pedido/HoyPedidoDetalle');
                    }
                    if (desencriptar($_SESSION['ID_Perfil']) == 5) {
                        redirect('Pedido');
                    }
                    if (desencriptar($_SESSION['ID_Perfil']) == 6) {
                        redirect('Repartidor/motorizado');
                    }
                    if (desencriptar($_SESSION['ID_Perfil']) == 8) {
                        redirect('Compra/MisAsignados');
                    }
                } else {
                    $this->session->set_flashdata('error', 'No tiene permiso para acceder al sistema');
                }
            } else {
                $this->session->set_flashdata('error', 'La clave ingresada es incorrecta. Inténtelo otra vez.');
            }
        } else {
            $this->session->set_flashdata('error', 'El correo ingresado no está registrado');
        }

        redirect('Login', 'refresh');
    }
    public function validaClienteDelivery() {

        $correo = $this->input->post('correo');
        $clave = $this->input->post('clave');

        $valida = $this->Login_model->validaClienteDelivery($correo);
        if ($valida) {
            if ($valida->Clave == $clave) {
                if ($valida->Baja == null) {
                    $dataCliente = array(
                        'ID_Cliente' => encriptar($valida->ID_Cliente),
                        'Email'  => encriptar($valida->Correo),
                        'Usuario'     => encriptar($valida->Nombre . " " . $valida->ApellidoPaterno . " " . $valida->ApellidoMaterno),
                        'ID_PerfilCliente' => encriptar($valida->ID_Perfil),

                        'token2' => bin2hex(openssl_random_pseudo_bytes(64)),

                    );

                    $this->session->set_userdata($dataCliente);


                    $this->Token_model->insertarToken2($this->getRealIP(), $this->isWeb(), $this->getOS(), $dataCliente['token2']);
                    insertarLog("Ingreso al sistema");
                    if (desencriptar($_SESSION['ID_PerfilCliente']) == 7) {
                        redirect('Delivery');
                    }
                } else {
                    $this->session->set_flashdata('error', 'No tiene permiso para acceder al sistema');
                }
            } else {
                $this->session->set_flashdata('error', 'La clave ingresada es incorrecta. Inténtelo otra vez.');
            }
        } else {
            $this->session->set_flashdata('error', 'El correo ingresado no está registrado');
        }

        redirect('Delivery', 'refresh');
    }


    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('error', 'El correo ingresado no está registrado');
        redirect('Login');
    }
    function logoutClienteDelivery()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('error', 'El correo ingresado no está registrado');
        redirect('Delivery');
    }

    function validaToken()
    {
        $this->session->set_flashdata('error', 'Se ha logueado en otro navegador o móvil.');
        $this->session->set_userdata('token', null);
        redirect('Login', 'refresh');
    }
    function validaToken2()
    {
        $this->session->set_flashdata('error', 'Se ha logueado en otro navegador o móvil.');
        $this->session->set_userdata('token2', null);
        redirect('Delivery', 'refresh');
    }

    public function getRealIP()
    {

        if (isset($_SERVER["HTTP_CLIENT_IP"])) {

            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {

            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {

            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {

            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {

            return $_SERVER["HTTP_FORWARDED"];
        } else {

            return $_SERVER["REMOTE_ADDR"];
        }
    }


    public function isWeb()
    {
        if (isset($_SERVER['HTTP_USER_AGENT']) and !empty($_SERVER['HTTP_USER_AGENT'])) {
            $user_ag = $_SERVER['HTTP_USER_AGENT'];
            if (preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis', $user_ag)) {
                return 0;
            } else {
                return 1;
            };
        } else {
            return 1;
        };
    }

    public function getOS()
    {

        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $os_platform  = "Unknown OS Platform";

        $os_array     = array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;

        return $os_platform;
    }
}
