<?php
class Mesa_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->DB2 = $this->load->database(coneccion(), TRUE);
	}

	public function selectAll()
	{

		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
		$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);
		if ($ID_Perfil == 1) {
			$mostrartodo = ' -- ';
		} else {
			$mostrartodo = '';
		}
		$sql = "SELECT MMesa.*,MAlmacen.Almacen from MMesa
                inner join MAlmacen on MAlmacen.ID_Almacen = MMesa.ID_Almacen
                $mostrartodo  where MMesa.ID_Almacen=$ID_Almacen
				 order by Mesa ASC";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}


	public function selectMesaAlmacen($ID_Perfil)
	{
		$sql = "SELECT 'Ocupado' as quees, MMesa.*,MAlmacen.Almacen,TCPedido.ID_Estado from MMesa
		inner join MAlmacen on MAlmacen.ID_Almacen = MMesa.ID_Almacen
		inner join TCPedido on TCPedido.ID_Pedido = MMesa.ID_PedidoNow
		  where MMesa.ID_Almacen=$ID_Perfil
		  union
		  select 'Libre' as quees, MMesa.*,MAlmacen.Almacen ,MMesa.Mesa from MMesa
		inner join MAlmacen on MAlmacen.ID_Almacen = MMesa.ID_Almacen
		 where MMesa.ID_Almacen=$ID_Perfil and ID_PedidoNow = 0";

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
	public function select($ID_Mesa)
	{
		$sql = "SELECT MMesa.*
                FROM MMesa WHERE ID_Mesa = " . $ID_Mesa;
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result->row();
	}



	public function insertar($Mesa, $ID_Almacen) {
		$now = new DateTime();
		$data = array(
			'Mesa' => $Mesa,
			'ID_Almacen' => $ID_Almacen,
			'Estilo' => 'class="mesa" style="width: 100px; right: auto; height: 100px; bottom: auto; left: 0px; top: 0px;"'
		);
		$this->db->insert('MMesa', $data);
		return $this->db->insert_id();
	}

	public function eliminar($ID_Mesa)
	{
		$this->db->where('ID_Mesa', $ID_Mesa);
		return $this->db->delete('MMesa');
	}

	public function actualizar($ID_Mesa, $Mesa, $ID_Almacen)
	{
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$data = array(
			'Mesa' => $Mesa,
			'ID_Almacen' => $ID_Almacen
		);

		$this->db->where('ID_Mesa', $ID_Mesa);
		return $this->db->update('MMesa', $data);
	}


	public function mesaVacia($ID_Mesa)
	{
		$data = array(
			'ID_PedidoNow' => 0
		);

		$this->db->where('ID_Mesa', $ID_Mesa);
		return $this->db->update('MMesa', $data);
	}

	public function PedidoNow($ID_Pedido, $ID_Mesa)
	{
		$data = array(
			'ID_PedidoNow' => $ID_Pedido
		);

		$this->db->where('ID_Mesa', $ID_Mesa);
		return $this->db->update('MMesa', $data);
	}
}
