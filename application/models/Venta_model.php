<?php
class Venta_model extends CI_Model {

    public function __construct() {
    parent::__construct();
    $this->load->database();

    }
    public function selectAll() {

        $sql= "SELECT TLPedido.*,MMenu.*,TLPedido.Precio,MAlmacen.Almacen,TCPedido.FechaHora,MUsuario.Nombre,ApellidoPaterno
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
		inner join TCPedido on TCPedido.ID_Pedido=TLPedido.ID_Pedido
        inner join MUsuario on MUsuario.Correo = TCPedido.CodUsuario
		where TCPedido.ID_Estado=4
        ";
        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result;
	}

	public function filtrarVenta($start,$end,$ID_Almacen){


		if($start != "vacio" && $end == "vacio"){
			$end = $start;
		}

		if($start=="vacio"){

			
			// se creo almacen 4 solo a nivel de html para obtener todos los almacenes
			if($ID_Almacen == "4"){
				//comentar all
				$sql = "SELECT TLPedido.*,MMenu.*,TLPedido.Precio,MAlmacen.Almacen,TCPedido.FechaHora,MUsuario.Nombre,ApellidoPaterno
			FROM TLPedido
			inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
			inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
			inner join TCPedido on TCPedido.ID_Pedido=TLPedido.ID_Pedido
			inner join MUsuario on MUsuario.Correo = TCPedido.CodUsuario
			
			where TCPedido.ID_Estado=4
			order by TCPedido.FechaHora DESC";
			}else{
				// no comentar all
				$sql = "SELECT TLPedido.*,MMenu.*,TLPedido.Precio,MAlmacen.Almacen,TCPedido.FechaHora,MUsuario.Nombre,ApellidoPaterno
			FROM TLPedido
			inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
			inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
			inner join TCPedido on TCPedido.ID_Pedido=TLPedido.ID_Pedido
			inner join MUsuario on MUsuario.Correo = TCPedido.CodUsuario
			where  TCPedido.ID_Estado=4
			and TLPedido.ID_Almacen = $ID_Almacen
			order by TCPedido.FechaHora DESC";
			}
			
		}
		else{
			// se creo almacen 4 solo a nivel de html para obtener todos los almacenes
			if($ID_Almacen == "4"){
				// comentar all
				
				$sql = "SELECT TLPedido.*,MMenu.*,TLPedido.Precio,MAlmacen.Almacen,TCPedido.FechaHora,MUsuario.Nombre,ApellidoPaterno
			FROM TLPedido
			inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
			inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
			inner join TCPedido on TCPedido.ID_Pedido=TLPedido.ID_Pedido
			inner join MUsuario on MUsuario.Correo = TCPedido.CodUsuario
			   where TCPedido.FechaHora between '$start 00:00:00' and '$end 23:59:59'
			  and TCPedido.ID_Estado=4
			 order by TCPedido.FechaHora DESC";
			}else{
				// no comentar all
				
			$sql = "SELECT TLPedido.*,MMenu.*,TLPedido.Precio,MAlmacen.Almacen,TCPedido.FechaHora,MUsuario.Nombre,ApellidoPaterno
		FROM TLPedido
		inner join MMenu on MMenu.ID_Menu = TLPedido.ID_Menu
		inner join MAlmacen on MAlmacen.ID_Almacen = TLPedido.ID_Almacen
		inner join TCPedido on TCPedido.ID_Pedido=TLPedido.ID_Pedido
        inner join MUsuario on MUsuario.Correo = TCPedido.CodUsuario
       	where TCPedido.FechaHora between '$start 00:00:00' and '$end 23:59:59'
		and TLPedido.ID_Almacen = $ID_Almacen and TCPedido.ID_Estado=4
		 order by TCPedido.FechaHora DESC";
			}
			
			
		}

		


		$result = $this->db->query($sql);

		if(!$result) {
			return false;
		}
		return $result;
	}

	public function buscarCliente($numero_documento){
		$sql="SELECT * FROM MCliente
				WHERE Numero_Documento =$numero_documento";
		$result = $this->db->query($sql);

		if(!$result) {
			return false;
		}
		return $result;
	}

	public function allDocumentos(){
		$sql="SELECT * FROM TipoDocumento";

		$result=$this->db->query($sql);
		if(!$result) {
			return false;
		}
		return $result;
	}

	public function totalVentasHoy() {

		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$hoy = $now->format('Y-m-d');
		$sql = "SELECT * from TCPedido where FechaHora between '$hoy 00:00:00' and '$hoy 23:59:59'";

		$result=$this->db->query($sql);

		if(!$result){
			return false;
		}
		return $result;

	}

	public function totalVentasMes() {

		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$mes = $now->format('m');
		$year = $now->format('Y');
		$sql = "SELECT * from TCPedido where MONTH(FechaHora) = $mes AND YEAR(FechaHora) = $year";

		$result=$this->db->query($sql);

		if(!$result){
			return false;
		}
		return $result;

	}

	public function totalVentasAllMeses(){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu

		group by YEAR(TCPedido.FechaHora),MONTH(TCPedido.FechaHora)
		order by YEAR(TCPedido.FechaHora) DESC,MONTH(TCPedido.FechaHora) DESC";

		$result=$this->db->query($sql);
		if(!$result){return false;}
		return $result;
	}
}
