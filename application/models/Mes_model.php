<?php
class Mes_model extends CI_Model {

    public function __construct() {
    parent::__construct();
    $this->load->database();

	}

	public function enero($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=1 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function febrero($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=2 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function marzo($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=3 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function abril($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=4 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function mayo($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=5 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function junio($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=6 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function julio($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=7 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function agosto($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=8 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function septiembre($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=9 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function octubre($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=10 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function noviembre($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=11 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}

	public function diciembre($year){
		$sql="SELECT  YEAR(TCPedido.FechaHora) as yea ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=12 and  YEAR(TCPedido.FechaHora)=$year and TCPedido.ID_Estado=4";

		$result = $this->db->query($sql);
		$row = $result->row();
		return $row->total;
	}
}
