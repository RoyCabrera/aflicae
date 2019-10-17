<?php
class Menu_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->DB2 = $this->load->database(coneccion(), TRUE);
	}

	public function selectAll()
	{
		$sql = "SELECT *
        from MMenu
		left outer join MFamilia on MFamilia.ID_Familia=MMenu.ID_Familia";

		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}

	public function selectAllMenu()
	{

		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
		if ($ID_Almacen == 1) {
			$Menu = "MenuHoy";
		} else if ($ID_Almacen == 2) {
			$Menu = "MenuHoy2";
		} else if ($ID_Almacen == 3) {
			$Menu = "MenuHoy3";
		} else {
			return false;
		}

		$sql = "SELECT *
        from MMenu
       left outer join MFamilia on MFamilia.ID_Familia=MMenu.ID_Familia
        order by MMenu.$Menu DESC,MMenu.Menu
        ";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}
	public function selectAllFamilia()
	{
		$sql = "SELECT * from MFamilia";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}
	public function select($ID_Menu)
	{
		$sql = "SELECT MMenu.*
                FROM MMenu WHERE ID_Menu = " . $ID_Menu;
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result->row();
	}
	public function selectPlato($ID_Menu)
	{
		$sql = "SELECT MMenu.*
                FROM MMenu WHERE ID_Menu = " . $ID_Menu;
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}

	public function insertar($Menu, $Costo, $Precio, $ID_Familia, $PrecioDelivery)
	{
		$now = new DateTime();
		$data = array(
			'Menu' => $Menu,
			'Costo' => $Costo,
			'Precio' => $Precio,
			'ID_Familia' => $ID_Familia,
			'PrecioDelivery' => $PrecioDelivery

		);
		$this->db->insert('MMenu', $data);
		return $this->db->insert_id();
	}

	public function subirfoto($Ruta, $ID_Menu)
	{
		$data = array('ImagenMenu' => $Ruta);
		$this->db->where('ID_Menu', $ID_Menu);
		return $this->db->update('MMenu', $data);
	}

	public function subirfotoThumbnail($Ruta, $ID_Menu)
	{
		$data = array('ImagenThumbnail' => $Ruta);
		$this->db->where('ID_Menu', $ID_Menu);
		return $this->db->update('MMenu', $data);
	}

	public function eliminar($ID_Menu)
	{
		$this->db->where('ID_Menu', $ID_Menu);
		return $this->db->delete('MMenu');
	}

	public function actualizar($ID_Menu, $Menu, $Costo, $Precio, $ID_Familia, $PrecioDelivery)
	{
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$data = array(
			'Menu' => $Menu,
			'Costo' => $Costo,
			'Precio' => $Precio,
			'ID_Familia' => $ID_Familia,
			'PrecioDelivery' => $PrecioDelivery
		);

		$this->db->where('ID_Menu', $ID_Menu);
		return $this->db->update('MMenu', $data);
	}
	public function actualizarMenuHoy($ID_Menu, $menuhoy)
	{

		$data = array(
			'MenuHoy' => $menuhoy
		);

		$this->db->where('ID_Menu', $ID_Menu);
		return $this->db->update('MMenu', $data);
	}

	public function actualizarMenuHoy2($ID_Menu, $menuhoy2)
	{

		$data = array(
			'MenuHoy2' => $menuhoy2
		);

		$this->db->where('ID_Menu', $ID_Menu);
		return $this->db->update('MMenu', $data);
	}
	public function actualizarMenuHoy3($ID_Menu, $menuhoy3)
	{

		$data = array(
			'MenuHoy3' => $menuhoy3
		);

		$this->db->where('ID_Menu', $ID_Menu);
		return $this->db->update('MMenu', $data);
	}
	public function actualizarMenuDelivery($ID_Menu, $EsMenuDelivery)
	{

		$data = array(
			'MenuDelivery1' => $EsMenuDelivery
		);

		$this->db->where('ID_Menu', $ID_Menu);
		return $this->db->update('MMenu', $data);
	}
	public function actualizarMenuDelivery2($ID_Menu, $EsMenuDelivery2)
	{

		$data = array(
			'MenuDelivery2' => $EsMenuDelivery2
		);

		$this->db->where('ID_Menu', $ID_Menu);
		return $this->db->update('MMenu', $data);
	}

	public function actualizarEsDelivery($ID_Menu, $EsDelivery)
	{

		$data = array(
			'Delivery' => $EsDelivery
		);

		$this->db->where('ID_Menu', $ID_Menu);
		return $this->db->update('MMenu', $data);
	}

	public function MenuDelivery1()
	{
		$sql = "SELECT * FROM MMenu where MenuDelivery1=1 and ID_Familia=3";
		$result = $this->db->query($sql);

		if (!$result) {
			return false;
		}
		return $result;
	}

	public function platocarta()
	{
		$sql = "SELECT * FROM MMenu where Delivery=1 and ID_Familia=2";
		$result = $this->db->query($sql);

		if (!$result) {
			return false;
		}
		return $result;
	}
	public function MenuDelivery1Segundo()
	{
		$sql = "SELECT * FROM MMenu where  MenuDelivery1=1 and ID_Familia=2";
		$result = $this->db->query($sql);

		if (!$result) {
			return false;
		}
		return $result;
	}
	public function MenuDelivery1Bebida()
	{
		$sql = "SELECT * FROM MMenu where  MenuDelivery1=1 and ID_Familia=4";
		$result = $this->db->query($sql);

		if (!$result) {
			return false;
		}
		return $result;
	}
}
