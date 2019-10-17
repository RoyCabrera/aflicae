<?php
class Pedido_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Configuracion_model');
		//$this->DB2 = $this->load->database(coneccion(), TRUE);
	}
	public function selectAllHoy()
	{
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$hoy = $now->format('Y-m-d');

		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
		$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);
		if ($ID_Perfil == 1 || $ID_Perfil == 2) {
			$comentar =true;
		} else {
			$comentar = false;
		}
		$sql = "SELECT TCPedido.* ,MMesa.Mesa,MUsuario.Nombre,MEstado.Estado
        from TCPedido
		inner join MMesa on MMesa.ID_Mesa=TCPedido.ID_Mesa
		inner join MUsuario on MUsuario.correo=TCPedido.CodUsuario
		inner join MEstado on MEstado.ID_Estado=TCPedido.ID_Estado
		where TCPedido.ID_Estado != 4 and TCPedido.ID_Estado !=16 and TCPedido.FechaHora between '$hoy 00:00:00' and '$hoy 23:59:59'      ";
		if(!$comentar){
		$sql=$sql." and    TCPedido.ID_Almacen=$ID_Almacen";
		}


		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}
	public function selectAllPendientes()
	{
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$hoy = $now->format('Y-m-d');

		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
		$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);
		if ($ID_Perfil == 1 || $ID_Perfil == 2) {
			$comentar =true;
		} else {
			$comentar = false;
		}
		$sql = "SELECT TCPedido.* ,MMesa.Mesa,MUsuario.Nombre,MEstado.Estado,MCliente.RazonSocial
        from TCPedido
		inner join MMesa on MMesa.ID_Mesa=TCPedido.ID_Mesa
		inner join MUsuario on MUsuario.correo=TCPedido.CodUsuario
		inner join MEstado on MEstado.ID_Estado=TCPedido.ID_Estado
		inner join MCliente on MCliente.ID_Cliente = TCPedido.ID_CLiente
		where  TCPedido.ID_Estado =16   ";
		if(!$comentar){
		$sql=$sql." and    TCPedido.ID_Almacen=$ID_Almacen";
		}


		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}
	public function selectAllHoy_Estado(){
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$hoy = $now->format('Y-m-d');

		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
		$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);
		if ($ID_Perfil == 1 || $ID_Perfil == 2) {
			$comentar =true;
		} else {
			$comentar = false;
		}
		$sql = "SELECT TCPedido.* ,MMesa.Mesa,MUsuario.Nombre,MEstado.Estado
        from TCPedido
		inner join MMesa on MMesa.ID_Mesa=TCPedido.ID_Mesa
		inner join MUsuario on MUsuario.correo=TCPedido.CodUsuario
		inner join MEstado on MEstado.ID_Estado=TCPedido.ID_Estado
		where TCPedido.FechaHora between '$hoy 00:00:00' and '$hoy 23:59:59'      ";
		if(!$comentar){
		$sql=$sql." and    TCPedido.ID_Almacen=$ID_Almacen";
		}


		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}

	public function selectAll()
	{


		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
		$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);

		if ($ID_Perfil == 1 || $ID_Perfil == 2) {


			$sql = "SELECT TCPedido.* ,MMesa.Mesa,MUsuario.Nombre,MEstado.Estado
        from TCPedido
		inner join MMesa on MMesa.ID_Mesa=TCPedido.ID_Mesa
		inner join MUsuario on MUsuario.correo=TCPedido.CodUsuario
		inner join MEstado on MEstado.ID_Estado=TCPedido.ID_Estado";


		} else {

			$sql = "SELECT TCPedido.* ,MMesa.Mesa,MUsuario.Nombre,MEstado.Estado
        from TCPedido
		inner join MMesa on MMesa.ID_Mesa=TCPedido.ID_Mesa
		inner join MUsuario on MUsuario.correo=TCPedido.CodUsuario
		inner join MEstado on MEstado.ID_Estado=TCPedido.ID_Estado
		where TCPedido.ID_Almacen=$ID_Almacen";

		}


		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}

	public function select($ID_Pedido)
	{
		$sql = "SELECT TCPedido.*
                FROM TCPedido WHERE ID_Pedido = " . $ID_Pedido;
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result->row();
	}
	public function selectAllDetalle(){
		$sql = "SELECT * FROM TLPedido";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}

	/* funciones iguales  */
	public function selectMenuDetalle($ID_LPedido)
	{
		$sql = "SELECT TLPedido.*
		FROM TLPedido
		where ID_LPedido =" . $ID_LPedido;
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result->row();
	}
	public function selectDetalleHoy()
	{
		$now = new DateTime();
		$hoy = $now->format('Y-m-d');
		$sql = "SELECT TLPedido.*,MMenu.Menu,MMenu.ID_Familia,MEstado.Estado,MAlmacen.Almacen
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
		inner join TCPedido on TCPedido.ID_Pedido = TLPedido.ID_Pedido
				WHERE  TCPedido.FechaHora between '$hoy 00:00:00' and '$hoy 23:59:59' ORDER BY Posicion";

		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;


	}
	public function DetalleDelivery()
	{

		$sql = "SELECT TLPedido.*,MMenu.Menu,MEstado.Estado
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado

		inner join TCPedido on TCPedido.ID_Pedido = TLPedido.ID_Pedido";

		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;


	}
	public function selectDetalle($ID_Pedido)
	{

		$sql = "SELECT TLPedido.*,MMenu.Menu,MEstado.Estado,MAlmacen.Almacen,MMesa.Mesa
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
		inner join TCPedido on TCpedido.ID_Pedido = TLPedido.ID_Pedido
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
		inner join MMEsa on MMesa.ID_Mesa = TCPedido.ID_Mesa
		WHERE TLPedido.ID_Pedido =  $ID_Pedido" ;
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;


	}
	public function selectallDetallePreparado()
	{
		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
		$sql = "SELECT TLPedido.*,MMenu.Menu,MEstado.Estado,MAlmacen.Almacen,MMesa.Mesa
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
        inner join TCPedido on TCPedido.ID_Pedido = TLPedido.ID_Pedido
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado

		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
        inner join MMesa on MMesa.ID_Mesa = TCPedido.ID_Mesa
        where TLPedido.ID_Almacen = $ID_Almacen and TLPedido.ID_Estado=2";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;


	}
	public function selectDetalleDelivery($ID_Pedido)
	{

		$sql = "SELECT TLPedido.*,MMenu.Menu,MEstado.Estado
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado


                WHERE ID_Pedido = " . $ID_Pedido;
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;


	}
	/* 	--------Pedido------------ */
	public function insertar($ID_Mesa, $Observacion, $ID_Almacen)
	{
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$data = array(
			'ID_Mesa' => $ID_Mesa,
			'Observacion' => $Observacion,
			'FechaHora' =>  $now->format('Y-m-d H:i:s'),
			'CodUsuario' => desencriptar($_SESSION['Correo']),
			'ID_Almacen' => $ID_Almacen,
			'ID_Estado' => 1
		);


		$this->db->insert('TCPedido', $data);
		return $this->db->insert_id();
	}
	public function insertarpedidodelivery($ID_Mesa, $Observacion, $ID_Almacen,$ID_Cliente)
	{
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$data = array(
			'ID_Mesa' => $ID_Mesa,
			'Observacion' => $Observacion,
			'FechaHora' =>  $now->format('Y-m-d H:i:s'),
			'ID_Almacen' => $ID_Almacen,
			'ID_Estado' => 1,
			'ID_Cliente'=>$ID_Cliente
		);


		$this->db->insert('TCPedido', $data);
		return $this->db->insert_id();
	}

	public function eliminar($ID_Pedido)
	{
		$this->db->where('ID_Pedido', $ID_Pedido);
		return $this->db->delete('TCPedido');
	}

	public function actualizar($ID_Mesa, $ID_Pedido, $Observacion, $ID_Almacen)
	{
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$data = array(
			'ID_Mesa' => $ID_Mesa,
			'ID_Pedido' => $ID_Pedido,
			'Observacion' => $Observacion,
			'ID_Almacen' => $ID_Almacen
		);

		$this->db->where('ID_Pedido', $ID_Pedido);
		return $this->db->update('TCPedido', $data);
	}

	/* 	--------Detalle------------ */
	public function insertardetalle($ID_Pedido, $menu, $Cantidad, $Observacion, $ID_Estado, $ID_Almacen)
	{

		foreach ($menu as $plato) {
			if ($plato > 0) {

				$sql = "SELECT  *  from MMenu where MenuHoy=1 and ID_Menu=" . $plato;
				$result = $this->db->query($sql);
				if (!$result || $result->num_rows() < 1) {
					$precio = $this->Menu_model->selectPlato($plato);
					foreach ($precio->result() as $row) {

						if ($ID_Almacen == 1) {
							$precioPlato = $row->Precio;
						}
					}

					$menu = 0;
				} else {
					$precio = $this->Menu_model->selectPlato($plato);
					foreach ($precio->result() as $row) {

						if ($ID_Almacen == 1) {
							if ($row->ID_Familia != 2) {
								$precioPlato = 0;
							} else {
								$precioMenu = $this->Configuracion_model->verPrecioMenu();
								$precioPlato = $precioMenu;
							}
						}
					}
					$menu = 1;
				}
				////////////////////////////////////////////////////////////////////////////////////////////////

				$sql2 = "SELECT  *  from MMenu where MenuHoy2=1 and ID_Menu=" . $plato;
				$result2 = $this->db->query($sql2);
				if (!$result2 || $result2->num_rows() < 1) {
					$precio = $this->Menu_model->selectPlato($plato);
					foreach ($precio->result() as $row) {
						if ($ID_Almacen == 2) {
							$precioPlato = $row->Precio;
						}
					}
					$menu2 = 0;
				} else {
					$precio = $this->Menu_model->selectPlato($plato);
					foreach ($precio->result() as $row) {

						if ($ID_Almacen == 2) {
							if ($row->ID_Familia != 2) {
								$precioPlato = 0;
							} else {
								$precioMenu = $this->Configuracion_model->verPrecioMenu();
								$precioPlato = $precioMenu;
							}
						}
					}
					$menu2 = 1;
				}
				////////////////////////////////////////////////////////////////////////////////////////////////
				$sql3 = "SELECT  *  from MMenu where MenuHoy3=1 and ID_Menu=" . $plato;
				$result3 = $this->db->query($sql3);
				if (!$result3 || $result3->num_rows() < 1) {
					$precio = $this->Menu_model->selectPlato($plato);
					foreach ($precio->result() as $row) {
						if ($ID_Almacen == 3) {
							$precioPlato = $row->Precio;
						}
					}
					$menu3 = 0;
				} else {
					$precio = $this->Menu_model->selectPlato($plato);
					foreach ($precio->result() as $row) {

						if ($ID_Almacen == 3) {
							if ($row->ID_Familia != 2) {
								$precioPlato = 0;
							} else {
								$precioMenu = $this->Configuracion_model->verPrecioMenu();
								$precioPlato = $precioMenu;
							}
						}
					}
					$menu3 = 1;
				}
				date_default_timezone_set('America/Lima');
				$now = new DateTime();
				//$PedidoMenu = $PedidoMenu + 1;
				$data = array(
					'ID_Pedido' => $ID_Pedido,
					'ID_Menu' => $plato,
					'ID_Estado' => $ID_Estado,
					'Cantidad' =>  $Cantidad,
					'Observacion' => $Observacion,
					'ID_Almacen' => $ID_Almacen,
					'EsMenu' => $menu,
					'EsMenu2' => $menu2,
					'EsMenu3' => $menu3,
					'Precio' => $precioPlato,
					/* 'Posicion'=>$Posicion, */
					'FechaHora'=>  $now->format('Y-m-d H:i:s')
				);

				$this->db->insert('TLPedido', $data);
			}
		}
	}
	public function insertardetalledelivery($ID_Pedido, $menu, $Cantidad, $Observacion, $ID_Estado, $ID_Almacen)
	{



		foreach ($menu as $plato) {
			if ($plato > 0) {

				$sql2 = "SELECT  *  from MMenu where  MenuDelivery1 = 1 and ID_Menu=" . $plato;
				$result2 = $this->db->query($sql2);
				if (!$result2 || $result2->num_rows() < 1) {
					$precio = $this->Menu_model->selectPlato($plato);
					foreach ($precio->result() as $row) {
						$Delivery = 1;
						$precioPlato = $row->Precio;
					}
				} else {
					$precio = $this->Menu_model->selectPlato($plato);
					foreach ($precio->result() as $row) {


						if ($row->ID_Familia != 2) {
							$precioPlato = 0;
						} else {
							$precioMenu = $this->Configuracion_model->verPrecioMenu();
							$precioPlato = $precioMenu;
						}
						$Delivery = 0;
						$EsMenuDelivery1 = 1;
					}
				}

				$data = array(
					'ID_Pedido' => $ID_Pedido,
					'ID_Menu' => $plato,
					'ID_Estado' => $ID_Estado,
					'Cantidad' =>  $Cantidad,
					'Observacion' => $Observacion,
					'ID_Almacen' => $ID_Almacen,
					'Precio' => $precioPlato,
					'Delivery' => $Delivery,
					'EsMenuDelivery1' => $EsMenuDelivery1
				);

				$this->db->insert('TLPedido', $data);
			}
		}
	}
	public function insertarPlatoCarta($ID_Pedido, $menu, $Cantidad, $Observacion, $ID_Estado, $ID_Almacen)
	{


		$precio = $this->Menu_model->selectPlato($menu);
		foreach ($precio->result() as $row) {

			$precioPlato = $row->Precio;
		}

		$Delivery = 1;

		$data = array(
			'ID_Pedido' => $ID_Pedido,
			'ID_Menu' => $menu,
			'ID_Estado' => $ID_Estado,
			'Cantidad' =>  $Cantidad,
			'Observacion' => $Observacion,
			'ID_Almacen' => $ID_Almacen,
			'Precio' => $precioPlato,
			'Delivery' => $Delivery,

		);

		$this->db->insert('TLPedido', $data);
	}

	public function actualizardetalle($ID_LPedido, $ID_Pedido, $menu, $Cantidad, $Observacion, $ID_Almacen,$Posicion)
	{
		foreach ($menu as $plato) :
			if ($plato > 0) {
				$data = array(
					'ID_LPedido' => $ID_LPedido,
					'ID_Pedido' => $ID_Pedido,
					'ID_Menu' => $plato,
					'Cantidad' => $Cantidad,
					'Observacion' => $Observacion,
					'ID_Almacen' => $ID_Almacen

				);

				$this->db->where('ID_LPedido', $ID_LPedido);
				return $this->db->update('TLPedido', $data);
			}


		endforeach;
	}

	public function eliminardetalle($ID_LPedido)
	{

		$this->db->where('ID_LPedido', $ID_LPedido);
		return $this->db->delete('TLPedido');
	}
	// Cambia el estado del plato en pedidodetalle
	public function estadodetalleaPreparado($ID_LPedido)
	{
		$data = array(
			'ID_Estado' => 2,
		);
		$this->db->where('ID_LPedido', $ID_LPedido);
		return $this->db->update('TLPedido', $data);
	}
	// Lista la receta y me agrega a la tabla TSalida
	public function insertarsalida($ID, $ID_Almacen, $Cantidad)
	{

		// Receta del plato para obtener nombre de insumos
		$sql = "SELECT TReceta.*,MMenu.Menu
				from TReceta
				inner join MMenu on MMenu.ID_Menu = TReceta.ID_Menu
				where MMenu.ID_Menu =" . $ID;

		$result = $this->db->query($sql);

		$salida = $result->result();
		date_default_timezone_set('America/Lima');
		$now = new DateTime();

		// insertar en la nueva tabla TSalida
		foreach ($salida as $aux) {
			$this->restar($aux->ID_Insumo, $aux->Cantidad * $Cantidad, $ID_Almacen);

			$data = array(
				'ID_Insumo' => $aux->ID_Insumo,
				'Cantidad' => $aux->Cantidad * $Cantidad,
				'FechaHora' => $now->format('Y-m-d H:i:s'),
				'CodUsuario' => desencriptar($_SESSION['Correo']),
				'ID_Almacen' => $ID_Almacen
			);
			$this->db->insert('TSalida', $data);
		}

		if (!$result) {
			return false;
		}
		return $result;
	}

	public function restar($ID_Insumo, $Cantidad, $ID_Almacen)
	{

		$sql = "SELECT  *  from TAlmacenInsumo where ID_Almacen=" . $ID_Almacen . " and ID_Insumo=" . $ID_Insumo;

		$result = $this->db->query($sql);
		if (!$result || $result->num_rows() < 1) { } else {
			// update
			$sql = "SELECT Stock from TAlmacenInsumo where ID_Almacen=" . $ID_Almacen . " and  ID_Insumo=" . $ID_Insumo;

			$result = $this->db->query($sql);
			if (!$result) {
				$stock = 0;
			}
			foreach ($result->result() as $row) {
				$stock = $row->Stock;
			}
			if ($stock == null) {
				$stock = 0;
			}


			$data = array('Stock' => $stock - $Cantidad);
			$this->db->where('ID_Insumo', $ID_Insumo);
			$this->db->where('ID_Almacen', $ID_Almacen);
			$this->db->update('TAlmacenInsumo', $data);
		}

		$sql = "SELECT Stock from MInsumo where ID_Insumo=" . $ID_Insumo;

		$result = $this->db->query($sql);
		if (!$result) {
			$stock = 0;
		}
		foreach ($result->result() as $row) {
			$stock = $row->Stock;
		}

		if ($stock == null) {
			$stock = 0;
		}

		$data = array(
			'Stock' => $stock - $Cantidad
		);
		$this->db->where('ID_Insumo', $ID_Insumo);
		$this->db->update('MInsumo', $data);
	}

	public function estadoPedidoEnPreparacion($ID_Pedido)
	{
		$ID = desencriptar($ID_Pedido);

		$data = array(
			'ID_Estado' => 7,
		);
		$this->db->where('ID_Pedido', $ID);
		$this->db->update('TCPedido', $data);
	}

	public function estadoPedidoAPreparado($ID_Pedido)
	{
		$ID = desencriptar($ID_Pedido);

		$data = array(
			'ID_Estado' => 2,
		);
		$this->db->where('ID_Pedido', $ID);
		$this->db->update('TCPedido', $data);
	}

	public function existeDetalleEnPendiente($ID_Pedido)
	{
		$ID = desencriptar($ID_Pedido);
		$sql = "SELECT * from TLPedido where ID_Estado=1 and ID_Pedido = $ID";

		$result = $this->db->query($sql);
		if (!$result || $result->num_rows() < 1) {
			return false;
		}
		foreach ($result->result() as $row) {
			return true;
		}
	}

	public function verVenta($ID_Pedido)
	{

		$sql = "SELECT TLPedido.*,Menu,MMenu.ID_Menu,MAlmacen.Almacen,TCPedido.FechaHora,MMenu.ID_Familia
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu

		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
		inner join TCPedido on TCPedido.ID_Pedido = TLPedido.ID_Pedido

		where TLPedido.ID_Pedido = $ID_Pedido";

		$result = $this->db->query($sql);

		if (!$result) {
			return false;
		}
		return $result;
	}
	public function total_a_cobrar($ID_Pedido)
	{
		$sql = "SELECT SUM(Precio) as precio 
				from TLPedido 
				where ID_Pedido=$ID_Pedido";

		$result= $this->db->query($sql);

		foreach($result->result() as $row)
				{
				return	$row->precio;
				}

	}

	public function VentaMesero($ID_Pedido)
	{


		$sql = "SELECT TCPedido.* ,MUsuario.Nombre
        from TCPedido

		inner join MUsuario on MUsuario.correo=TCPedido.CodUsuario";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}

	public function HoyPedidoDetalle()
	{
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$hoy = $now->format('Y-m-d');
		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);

		$sql = "SELECT TLPedido.*,MEstado.Estado,TCPedido.FechaHora,MMenu.Menu,MMenu.ID_Familia,MUsuario.Nombre,MMesa.Mesa,MFamilia.Familia FROM TLPedido
		inner join MEstado on MEstado.ID_Estado=TLPedido.ID_Estado
		inner join TCPedido on TCPedido.ID_Pedido = TLPedido.ID_Pedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MUsuario on MUsuario.correo=TCPedido.CodUsuario
		inner join MMesa on MMesa.ID_Mesa = TCPedido.ID_Mesa
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
		where TLPedido.ID_Estado = 1 and TCPedido.FechaHora between '$hoy 00:00:00' and '$hoy 23:59:59' and TLPedido.ID_Almacen= $ID_Almacen";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}

	public function AllPedidoDetalle()
	{

		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);

		$sql = "SELECT TLPedido.*,MEstado.Estado,TCPedido.FechaHora,MMenu.Menu,MMenu.ID_Familia,MUsuario.Nombre,MMesa.Mesa,MFamilia.Familia FROM TLPedido
		inner join MEstado on MEstado.ID_Estado=TLPedido.ID_Estado
		inner join TCPedido on TCPedido.ID_Pedido = TLPedido.ID_Pedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MUsuario on MUsuario.correo=TCPedido.CodUsuario
		inner join MMesa on MMesa.ID_Mesa = TCPedido.ID_Mesa
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
		where TLPedido.ID_Estado = 1  and TLPedido.ID_Almacen= $ID_Almacen";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}

	public function cambiarEstadoCobrado($ID_Pedido,$tipo_cobro,$tipo_comprobante)
	{
		if($tipo_cobro == "Porcobrar"){
			$data = array(
				'ID_Estado' => 16,
				'Tipo_cobro' =>$tipo_cobro,
				'TipoFactura'=>$tipo_comprobante
				
			);
		}else{
			$data = array(
				'ID_Estado' => 4,
				'Tipo_cobro' =>$tipo_cobro,
				'TipoFactura'=>$tipo_comprobante
			);
		}

		$this->db->where('ID_Pedido', $ID_Pedido);
		return $this->db->update('TCPedido', $data);
	}
	public function insertar_id_cliente($ID_Pedido,$cliente){
		$data = array(
			'ID_Cliente' => $cliente
			
		);
		$this->db->where('ID_Pedido', $ID_Pedido);
		return $this->db->update('TCPedido', $data);
	}

	public function pedidosPendientesAdmin()
	{
		$sql = "SELECT TCPedido.*,MAlmacen.Almacen,MMesa.Mesa,MUsuario.Nombre
		from  TCPedido
		inner join MAlmacen on MAlmacen.ID_Almacen= TCPedido.ID_Almacen
		inner join MMesa on MMesa.ID_Mesa = TCPedido.ID_Mesa
		inner join MUsuario on MUsuario.correo=TCPedido.CodUsuario
		where ID_Estado = 1";

		$result = $this->db->query($sql);

		if (!$result) {
			return false;
		}
		return $result;
	}

	public function VerDetalleMesa($ID_Pedido)
	{
		$sql = "";

		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}
	public function PedidoClienteDelivery($ID_Cliente){

		$sql="SELECT TCPedido.ID_Pedido,TCPedido.FechaHora,TCPedido.ID_Estado,ID_Cliente,MMenu.Menu,TLPedido.Precio,TLPedido.Delivery,TLPedido.EsMenuDelivery1,MEstado.Estado
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
        inner join MEstado on MEstado.ID_Estado =TCPedido.ID_Estado
		inner join MMenu on MMenu.ID_Menu=TLPedido.ID_Menu
		where ID_Cliente = $ID_Cliente and TCPedido.ID_Almacen = -1 and TCPedido.ID_Estado !=3";
		$result = $this->db->query($sql);

		if (!$result) {
			return false;
		}
		return $result;
	}
	public function SelectPedidoDelivery(){

		$sql = "SELECT TCPedido.ID_Pedido,TCPedido.FechaHora,MEstado.Estado,MEstado.ID_Estado,MClienteDelivery.*
		FROM resto.TCPedido
		inner join MClienteDelivery on MClienteDelivery.ID_Cliente = TCPedido.ID_Cliente
		inner join MEstado on MEstado.ID_Estado = TCPedido.ID_Estado
		where TCPedido.ID_Almacen = -1 and TCPedido.ID_Mesa=-1 and (TCPedido.ID_Estado=1 or TCPedido.ID_Estado=7 or TCPedido.ID_Estado = 2)
		order by TCPedido.ID_Estado";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}
	public function SelectPedidoDeliveryArmado(){

		$sql = "SELECT TCPedido.ID_Pedido,TCPedido.CodigoLoncheras,TCPedido.CantidadLonchera,TCPedido.FechaHora,MEstado.Estado,MEstado.ID_Estado,MClienteDelivery.*
		FROM resto.TCPedido
		inner join MClienteDelivery on MClienteDelivery.ID_Cliente = TCPedido.ID_Cliente
		inner join MEstado on MEstado.ID_Estado = TCPedido.ID_Estado
		where TCPedido.ID_Almacen = -1 and TCPedido.ID_Mesa=-1 and (TCPedido.ID_Estado=8)";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
	}



	public function estadoPedidoArmado($ID_Pedido,$cantidadLonchera,$codigoLoncheras) {
		$data = array(
			'ID_Estado' => 8,
			'CantidadLonchera'=>$cantidadLonchera,
			'CodigoLoncheras'=>$codigoLoncheras
		);
		$this->db->where('ID_Pedido', $ID_Pedido);
		return $this->db->update('TCPedido', $data);
	}

	public function existePedidoDelivery($ID_Cliente) {


		//$sql="SELECT * FROM TCPedido where ID_Cliente=$ID_Cliente and ID_Estado !=3";
		$sql="SELECT * FROM TCPedido where ID_Cliente=$ID_Cliente and (ID_Estado =1 or ID_Estado=7)";
		$result = $this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;
	}

	public function selectEntradasCocinero(){
		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);

	/*	$sql="SELECT count(*) as total ,TLPedido.ID_LPedido,TLPedido.EsMenu,TLPedido.EsMenu2,TLPedido.EsMenu3,TLPedido.ID_Estado,TLPedido.ID_Almacen,MMenu.Menu,MEstado.Estado,MAlmacen.Almacen,MFamilia.ID_Familia,TCPedido.ID_Mesa,MMesa.Mesa
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
        inner join TCPedido on TCPedido.ID_Pedido= TLPedido.ID_Pedido
		inner join MMesa on MMesa.ID_Mesa = TCPedido.ID_Mesa
        where MFamilia.ID_Familia=3 and TLPedido.ID_Almacen= $ID_Almacen and TLPedido.ID_Estado = 1
		GROUP BY TLPedido.ID_Menu";*/
		$sql="SELECT  TLPedido.ID_Pedido,TLPedido.ID_LPedido,MMenu.ID_Menu,TLPedido.FechaHora,   MMesa.Mesa ,TLPedido.EsMenu,TLPedido.EsMenu2,TLPedido.EsMenu3, MMenu.Menu,count(*) as total
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
        inner join TCPedido on TCPedido.ID_Pedido= TLPedido.ID_Pedido
		inner join MMesa on MMesa.ID_Mesa = TCPedido.ID_Mesa
        where MFamilia.ID_Familia=3 and TLPedido.ID_Almacen= $ID_Almacen and TLPedido.ID_Estado = 1
		and ((TLPedido.ID_Almacen = 1 and  TLPedido.EsMenu = 1) or ( TLPedido.ID_Almacen = 2  and TLPedido.EsMenu2 = 1 )or(  TLPedido.ID_Almacen = 3 and TLPedido.EsMenu3 = 1))
		GROUP BY TLPedido.ID_Menu,MMesa.Mesa
		order by TLPedido.ID_Menu";




		$result = $this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;
	}
	public function selectSegundosCocinero() {
		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);

		$sql="SELECT TLPedido.ID_Pedido,TLPedido.ID_LPedido,MMenu.ID_Menu, TLPedido.FechaHora,  MMesa.Mesa ,TLPedido.EsMenu,TLPedido.EsMenu2,TLPedido.EsMenu3, MMenu.Menu,count(*) as total
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
        inner join TCPedido on TCPedido.ID_Pedido= TLPedido.ID_Pedido
		inner join MMesa on MMesa.ID_Mesa = TCPedido.ID_Mesa
        where MFamilia.ID_Familia=2 and TLPedido.ID_Almacen= $ID_Almacen and TLPedido.ID_Estado = 1
		and ((TLPedido.ID_Almacen = 1 and  TLPedido.EsMenu = 1) or ( TLPedido.ID_Almacen = 2  and TLPedido.EsMenu2 = 1 )or(  TLPedido.ID_Almacen = 3 and TLPedido.EsMenu3 = 1))
		GROUP BY TLPedido.ID_Menu,MMesa.Mesa
		order by TLPedido.ID_Menu";

		$result = $this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;
	}
	public function selectBebidasCocinero(){
		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);

		$sql="SELECT  TLPedido.ID_Pedido,TLPedido.ID_LPedido,MMenu.ID_Menu,MMesa.Mesa,TLPedido.FechaHora ,TLPedido.EsMenu,TLPedido.EsMenu2,TLPedido.EsMenu3, MMenu.Menu,count(*) as total
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
        inner join TCPedido on TCPedido.ID_Pedido= TLPedido.ID_Pedido
		inner join MMesa on MMesa.ID_Mesa = TCPedido.ID_Mesa
        where MFamilia.ID_Familia=4 and TLPedido.ID_Almacen= $ID_Almacen and TLPedido.ID_Estado = 1
		and ((TLPedido.ID_Almacen = 1 and  TLPedido.EsMenu = 1) or ( TLPedido.ID_Almacen = 2  and TLPedido.EsMenu2 = 1 )or(  TLPedido.ID_Almacen = 3 and TLPedido.EsMenu3 = 1))
		GROUP BY TLPedido.ID_Menu,MMesa.Mesa
		order by TLPedido.ID_Menu";

		$result = $this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;
	}
	public function selectCartaCocinero(){
		$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);

		$sql="SELECT TLPedido.ID_Pedido,TLPedido.ID_LPedido,MMenu.ID_Menu, TLPedido.FechaHora,  MMesa.Mesa ,TLPedido.EsMenu,TLPedido.EsMenu2,TLPedido.EsMenu3, MMenu.Menu,count(*) as total
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
        inner join TCPedido on TCPedido.ID_Pedido= TLPedido.ID_Pedido
		inner join MMesa on MMesa.ID_Mesa = TCPedido.ID_Mesa
        where MFamilia.ID_Familia=2 and TLPedido.ID_Almacen= $ID_Almacen and TLPedido.ID_Estado = 1
		and ((TLPedido.ID_Almacen = 1 and  TLPedido.EsMenu != 1) or ( TLPedido.ID_Almacen = 2  and TLPedido.EsMenu2 != 1 )or(  TLPedido.ID_Almacen = 3 and TLPedido.EsMenu3 != 1))
		GROUP BY TLPedido.ID_Menu,MMesa.Mesa
		order by TLPedido.ID_Menu";

		$result = $this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;
	}

	// DELIVERY
	public function selectEntradasCocineroDelivery() {
		$sql="SELECT TLPedido.ID_Pedido,TLPedido.ID_LPedido,MMenu.ID_Menu,TLPedido.EsMenuDelivery1,MMenu.Menu,count(*) as total
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
        inner join TCPedido on TCPedido.ID_Pedido= TLPedido.ID_Pedido
        where MFamilia.ID_Familia=3 and TLPedido.ID_Almacen= -1 and TLPedido.ID_Estado = 1
		GROUP BY TLPedido.ID_Menu
		order by TLPedido.ID_Menu";

		$result = $this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;

	}
	public function selectSegundosCocineroDelivery() {
		$sql="SELECT TLPedido.ID_Pedido,TLPedido.ID_LPedido,MMenu.ID_Menu,TLPedido.EsMenuDelivery1,MMenu.Menu,count(*) as total
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
        inner join TCPedido on TCPedido.ID_Pedido= TLPedido.ID_Pedido
        where MFamilia.ID_Familia=2 and TLPedido.ID_Almacen= -1 and TLPedido.ID_Estado = 1 and TLPedido.EsMenuDelivery1 = 1
		GROUP BY TLPedido.ID_Menu
		order by TLPedido.ID_Menu";

		$result = $this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;

	}
	public function selectBebidasCocineroDelivery() {
		$sql="SELECT TLPedido.ID_Pedido,TLPedido.ID_LPedido,MMenu.ID_Menu,TLPedido.EsMenuDelivery1,MMenu.Menu,count(*) as total
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
        inner join TCPedido on TCPedido.ID_Pedido= TLPedido.ID_Pedido
        where MFamilia.ID_Familia=4 and TLPedido.ID_Almacen= -1 and TLPedido.ID_Estado = 1
		GROUP BY TLPedido.ID_Menu
		order by TLPedido.ID_Menu";

		$result = $this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;

	}
	// carta delivery
	public function selectCartaCocineroDelivery() {
		$sql="SELECT TLPedido.ID_Pedido,TLPedido.ID_LPedido,MMenu.ID_Menu,TLPedido.Delivery,MMenu.Menu,count(*) as total
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
        inner join TCPedido on TCPedido.ID_Pedido= TLPedido.ID_Pedido
        where TLPedido.ID_Almacen= -1 and TLPedido.ID_Estado = 1 and TLPedido.Delivery=1
		GROUP BY TLPedido.ID_Menu
		order by TLPedido.ID_Menu";

		$result = $this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;

	}
	// saber numero de filas para la notificación
	public function notificacionDelivery(){
		$sql="SELECT TLPedido.ID_Pedido,TLPedido.ID_LPedido,MMenu.ID_Menu,TLPedido.EsMenuDelivery1,MMenu.Menu,count(*) as total
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
        inner join MFamilia on MFamilia.ID_Familia = MMenu.ID_Familia
        inner join TCPedido on TCPedido.ID_Pedido= TLPedido.ID_Pedido
        where TLPedido.ID_Almacen= -1 and TLPedido.ID_Estado = 1
		GROUP BY TLPedido.ID_Menu
		order by TLPedido.ID_Menu";

		$result = $this->db->query($sql);
		$numerofilas=$result->num_rows();

		return $numerofilas;
	}



	// cocinero detallado (realTime)
	public function estadodetalleaPreparadoCocinero($ID_Pedido,$ID_Menu) {
		$ID=desencriptar($ID_Pedido);
		$data = array(
			'ID_Estado' => 2,
		);
		$array = array('ID_Pedido' => $ID, 'ID_Menu' => $ID_Menu);
		$this->db->where($array);
		return $this->db->update('TLPedido', $data);
	}
// desasignarPedidoMotorizado
	public function actualzarPedidoAsignado($ID_Pedido){
		$data = array(
			'ID_Estado' => 8,
			'ID_Repartidor'=>''
		);
		$array = array('ID_Pedido' => $ID_Pedido);
		$this->db->where($array);
		return $this->db->update('TCPedido', $data);
	}
	public function selectDetallePosicion($ID_Pedido,$Posicion)
	{
		$sql = "SELECT TLPedido.*,MMenu.Menu,MEstado.Estado,MAlmacen.Almacen
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen

                WHERE ID_Pedido =$ID_Pedido and Posicion = $Posicion";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;


	}
	public function AsignarZonaPedidoDelivery($ID_Zona,$ID)
	{
		$data = array(
			'ID_Zona' => $ID_Zona

		);
		$array = array('ID_Pedido' => $ID);
		$this->db->where($array);
		return $this->db->update('TCPedido', $data);
	}
	public function SelectDiezUltimos(){
		$sql="SELECT TLPedido.*,MMenu.Menu,MEstado.Estado,MAlmacen.Almacen,MMenu.ID_Familia
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MEstado on MEstado.ID_Estado = TLPedido.ID_Estado
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
		inner join TCPedido on TCPedido.ID_Pedido = TLPedido.ID_Pedido
		where MMenu.ID_Familia = 3 or MMenu.ID_Familia = 2";
			$result = $this->db->query($sql);
			if (!$result) {
				return false;
			}
			return $result;

	}
	public function cobrarPedido($ID_Pedido)
	{
		$ID_Pedido=desencriptar($ID_Pedido);
		date_default_timezone_set('America/Lima');
		$now = new DateTime();

		$data = array(
			'FechaCobro'=>$now->format('Y-m-d H:i:s'),
			'ID_Estado'=>4
		);
		$this->db->where('ID_Pedido', $ID_Pedido);
		return $this->db->update('TCPedido', $data);
	}
}
