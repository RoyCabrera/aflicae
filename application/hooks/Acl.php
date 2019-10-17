<?php
defined("BASEPATH") or die("Acceso prohibido");

class Acl
{

	/**
	 * @desc - obtenemos la instancia de ci
	 */
	public function __get($var)
	{
		return get_instance()->$var;
	}

	/**
	 * @desc - obtenemos la instancia de ci sin tender que crearla
	 */
	public function __construct()
	{
		!$this->load->library('session') ? $this->load->library('session') : false;
		!$this->load->helper('url') ? $this->load->helper('url') : false;
	}

	/**
	 * @desc - devuelve un array con los roles y las zonas de acceso
	 * @return array
	 */
	private function roles_access()
	{
		return array(
			//Super Administrador
			"1" => array("Login", "Admin", "Usuario", "Menu", "Insumo", "Mesa", "Receta", "Pedido", "Pedidoestado", "Compra", "Almacen", "Venta", "Configuracion", "Manual", "Delivery","Repartidor","Caja"),
			//Administrador
			"2" => array("Login", "Admin", "Usuario", "Menu", "Insumo", "Mesa", "Receta", "Pedido", "Pedidoestado", "Compra", "Almacen", "Venta", "Configuracion", "Delivery"),
			//Mesero
			"3" => array("Login", "Admin", "Mesa", "Pedido", "Pedidoestado", "Almacen", "Venta", "Delivery"),
			//Cocinero
			"4" => array("Login",  "Menu", "Insumo", "Receta", "Compra", "Almacen", "Pedido", "Pedidoestado", "Delivery"),
			//Motorizado
			"6" => array("Login","Pedido", "Motorizado", "Delivery","Repartidor","Compra"),
			//Caja
			"9" => array("Login", "Admin", "Usuario", "Menu", "Insumo", "Mesa", "Receta", "Pedido", "Pedidoestado", "Compra", "Almacen", "Venta", "Configuracion", "Manual", "Delivery","Repartidor","Caja"),
			//Mesero caja
			"9" => array("Login", "Admin", "Usuario", "Menu", "Insumo", "Mesa", "Receta", "Pedido", "Pedidoestado", "Compra", "Almacen", "Venta", "Configuracion", "Manual", "Delivery","Repartidor","Caja")
			
			

		);
	}

	/**
	 * @desc - por defecto, si no existe la sesión de usuario es guest
	 * @return - string - sesión por defecto
	 */

	private function _defaultRole()
	{
		return !$this->session->userdata("ID_Perfil") ?
			$this->session->set_userdata("ID_Perfil", "guest") :
			$this->session->userdata("ID_Perfil");
	}

	/**
	 * @desc - comprobamos si el usuario tiene acceso a una zona,
	 * si no lo tiene lo dejamos en la primera de su rol con un mensaje
	 */
	public function auth()
	{

		//$this->_defaultRole();
		foreach ($this->roles_access() as $role => $areas) {
			if (desencriptar($this->session->userdata("ID_Perfil")) == $role) {
				if (!in_array($this->uri->segment(1), $areas)) {
					$this->session->set_userdata("error", "No tiene permiso para acceder a esa url");
					redirect($areas[0], "refresh");
				}
			}
		}
	}
}
//Hooks: end application/hooks/acl.php
