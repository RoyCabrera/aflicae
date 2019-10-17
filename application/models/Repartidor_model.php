<?php

class Repartidor_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
    }
    public function selectRepartidorDisponible(){
        $sql="SELECT * FROM MUsuario
        where RepartidorDisponible = 1 and ID_perfil=6";

        $result = $this->db->query($sql);
        if(!$result){
            return false;
        }
        return $result;
    }
    public function InsertarImporteEnviado($ID_Perfil,$ID,$cien,$cincuenta,$veinte,$diez,$cinco,$dos,$uno,$cincuentaC,$veinteC,$diezC) {
        date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$data = array(
            'FechaHora' =>  $now->format('Y-m-d H:i:s'),
            'Motorizado' => $ID_Perfil,
            'ID_Pedido' => $ID,
			'cien' => $cien,
			'cincuenta' => $cincuenta,
            'veinte' =>$veinte,
            'diez'=>$diez,
            'cinco'=>$cinco,
            'dos'=>$dos,
            'uno'=>$uno,
            'cincuentaC'=>$cincuentaC,
            'veinteC'=>$veinteC,
            'diezC'=>$diezC,
            
            'ID_Estado'=>10
		);


		$this->db->insert('TImporteMotorizado', $data);
		return $this->db->insert_id();

    }

    public function AsignarPedidoEstado($ID_Pedido,$ID_Perfil){
       
		$data = array(
			'ID_Estado' => 10,
			'ID_Repartidor' => $ID_Perfil,
			
		);

		$this->db->where('ID_Pedido', $ID_Pedido);
		return $this->db->update('TCPedido', $data);

    }

    // pedidos asignados a motorizado
	public function misAsignadosMotorizado() {

		$Correo = desencriptar($_SESSION['Correo']);

		$sql="SELECT TCPedido.ID_Pedido,TCPedido.CantidadLonchera,TCPedido.FechaHora,TCPedido.ID_Repartidor,MEstado.Estado,MEstado.ID_Estado,MClienteDelivery.*
		FROM resto.TCPedido
		inner join MClienteDelivery on MClienteDelivery.ID_Cliente = TCPedido.ID_Cliente
		inner join MEstado on MEstado.ID_Estado = TCPedido.ID_Estado
		where TCPedido.ID_Almacen = -1 and TCPedido.ID_Mesa=-1 and ID_Repartidor='$Correo' and MEstado.ID_Estado=10";
		$result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
    }

    public function totalImporteMotorizado() {
        $Correo = desencriptar($_SESSION['Correo']);
        $sql="SELECT SUM(cien) as cien, SUM(cincuenta) as cincuenta, SUM(veinte) as veinte, SUM(diez) as diez, SUM(cinco) as cinco
        , SUM(dos) as dos, SUM(uno) as uno, SUM(cincuentaC) as cincuentaC, SUM(veinteC) as veinteC, SUM(diezC) as diezC
         FROM TImporteMotorizado 
        where Motorizado='$Correo' and ID_Estado=10";

        $result = $this->db->query($sql);
		if (!$result) {
			return false;
		}
		return $result;
    }
    public function totalDineroEnviado() {
        $Correo = desencriptar($_SESSION['Correo']);
        $sql="SELECT SUM(cien*100) as cien, SUM(cincuenta*50) as cincuenta, SUM(veinte*20) as veinte, SUM(diez*10) as diez, SUM(cinco*5) as cinco
        , SUM(dos*2) as dos, SUM(uno*1) as uno, SUM(cincuentaC*0.50) as cincuentaC, SUM(veinteC*0.20) as veinteC, SUM(diezC*0.10) as diezC
         FROM TImporteMotorizado  
        where Motorizado='$Correo' and ID_Estado=10";
             
             $result = $this->db->query($sql);
             if (!$result) {
                 return false;
             }
             return $result;
    }
    public function DineroEnviadoPedido($ID_Pedido){
        $sql="SELECT SUM(cien*100) as cien, SUM(cincuenta*50) as cincuenta, SUM(veinte*20) as veinte, SUM(diez*10) as diez, SUM(cinco*5) as cinco
        , SUM(dos*2) as dos, SUM(uno*1) as uno, SUM(cincuentaC*0.50) as cincuentaC, SUM(veinteC*0.20) as veinteC, SUM(diezC*0.10) as diezC
         FROM TImporteMotorizado  
        where ID_Pedido=$ID_Pedido and ID_Estado=10";
         $result = $this->db->query($sql);
         if (!$result) {
             return false;
         }
         return $result;
    }
    public function allPedidosAsignados() {
        $sql="SELECT TCPedido.ID_Pedido,TCPedido.CantidadLonchera,TCPedido.FechaHora,TZona.Zona,
        MEstado.Estado,MEstado.ID_Estado,
        MClienteDelivery.Nombre,MClienteDelivery.ApellidoPaterno,MClienteDelivery.ApellidoMaterno,
        MClienteDelivery.Distrito,MCLienteDelivery.Direccion,
        TCPedido.ID_Repartidor,
        MUsuario.Nombre as NombreMotorizado,MUsuario.ApellidoPaterno as ApellidoMotorizado
                FROM resto.TCPedido
                inner join MClienteDelivery on MClienteDelivery.ID_Cliente = TCPedido.ID_Cliente
                inner join MUsuario on MUsuario.Correo = TCPedido.ID_Repartidor
                inner join MEstado on MEstado.ID_Estado = TCPedido.ID_Estado
                inner join TZona on TZona.ID_Zona = TCPedido.ID_Zona
                where TCPedido.ID_Almacen = -1 and TCPedido.ID_Mesa=-1 and TCPedido.ID_Estado=10";
        $result = $this->db->query($sql);
        if (!$result) {
            return false;
        }
        return $result;

    }
    public function selectImportePedido($ID_Pedido){
        $sql="SELECT SUM(cien) as cien, SUM(cincuenta) as cincuenta, SUM(veinte) as veinte, SUM(diez) as diez, SUM(cinco) as cinco
        , SUM(dos) as dos, SUM(uno) as uno, SUM(cincuentaC) as cincuentaC, SUM(veinteC) as veinteC, SUM(diezC) as diezC
         FROM TImporteMotorizado 
        where ID_Pedido=$ID_Pedido and ID_Estado=10";

        $result = $this->db->query($sql);
        if (!$result) {
            return false;
        }
        return $result;
    }
    public function eliminarTImporteMotorizado($ID_Pedido){
        $this->db->where('ID_Pedido',$ID_Pedido);
        return $this->db->delete('TImporteMotorizado');
    }
    public function selecAllZonas(){
        $sql="SELECT * from TZona";

        $result = $this->db->query($sql);
        if (!$result) {
            return false;
        }
        return $result;
    }
    
}