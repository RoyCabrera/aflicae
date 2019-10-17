<?php
class Caja_model extends CI_Model {

    public function __construct() {
    parent::__construct();
    $this->load->database();

    }
    public function selectAll(){
        $sql = "SELECT TApertura.*,MUsuario.Nombre,MUsuario.ApellidoPaterno,MUsuario.ApellidoMaterno,(Q20000 * 200) + (Q10000 * 100) + (Q05000 * 50) +(Q02000 * 20) +(Q01000 * 10) +(Q00500 * 5) +(Q00200 * 2)+(Q00100 * 1)+
        (Q00050 * 0.50) + (Q00020 * 0.20)+(Q00010 * 0.10) as total
                FROM TApertura
                INNER JOIN MUsuario on MUsuario.Correo = TApertura.UsuarioAlta
                ORDER BY TApertura.FechaAlta DESC";
        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }

        return $result;
    }
    public function selectAllCierre(){
        $sql = "SELECT TCierre.*,MUsuario.Nombre,MUsuario.ApellidoPaterno,MUsuario.ApellidoMaterno,cierre.Nombre as NombreCierre,cierre.ApellidoPaterno as ApellidoPaternoCierre,cierre.ApellidoMaterno as ApellidoMaternoCierre ,(Q20000 * 200) + (Q10000 * 100) + (Q05000 * 50) +(Q02000 * 20) +(Q01000 * 10) +(Q00500 * 5) +(Q00200 * 2)+(Q00100 * 1)+
        (Q00050 * 0.50) + (Q00020 * 0.20)+(Q00010 * 0.10) as total FROM TCierre
        INNER JOIN MUsuario on MUsuario.Correo = TCierre.UsuarioAlta
        left outer join MUsuario as cierre on TCierre.UsuarioCierre = cierre.Correo
        order by TCierre.FechaCierre DESC ";
        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }

        return $result;
    }
    public function selectHoyCierre(){
        date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $dia = $now->format('d');
        $mes = $now->format('m');
        $anio = $now->format('Y');
        $sql = "SELECT TCierre.*,MUsuario.Nombre,MUsuario.ApellidoPaterno,MUsuario.ApellidoMaterno,cierre.Nombre as NombreCierre,cierre.ApellidoPaterno as ApellidoPaternoCierre,cierre.ApellidoMaterno as ApellidoMaternoCierre ,(Q20000 * 200) + (Q10000 * 100) + (Q05000 * 50) +(Q02000 * 20) +(Q01000 * 10) +(Q00500 * 5) +(Q00200 * 2)+(Q00100 * 1)+
        (Q00050 * 0.50) + (Q00020 * 0.20)+(Q00010 * 0.10) as total FROM TCierre
        INNER JOIN MUsuario on MUsuario.Correo = TCierre.UsuarioAlta
        left outer join MUsuario as cierre on TCierre.UsuarioCierre = cierre.Correo
        where DAY(TCierre.FechaAlta) = $dia and MONTH(TCierre.FechaAlta) = $mes AND YEAR(TCierre.FechaAlta) = $anio 
        order by TCierre.FechaCierre DESC ";
        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }

        return $result;
    }

    public function insertarAperturaCaja($diezCentimos,$veinteCentimos,$cincuentaCentimos,$unSol,$dosSoles,$cincoSoles,$diezSoles,$veinteSoles,$cincuentaSoles,$CienSoles,$doscientosSoles){

        date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $data = array(
            'Q00010' => $diezCentimos,
            'Q00020' => $veinteCentimos,
            'Q00050' => $cincuentaCentimos,
            'Q00100' => $unSol,
            'Q00200' => $dosSoles,
            'Q00500' => $cincoSoles,
            'Q01000' => $diezSoles,
            'Q02000' => $veinteSoles,
            'Q05000' => $cincuentaSoles,
            'Q10000' => $CienSoles,
            'Q20000' => $doscientosSoles,
            'UsuarioAlta' => desencriptar($_SESSION['Correo']),
            'FechaAlta'=>  $now->format('Y-m-d H:i:s')
        );

        $this->db->insert('TApertura',$data);
    }

    public function eliminarApertura($ID_Apertura){
        $this->db->where('ID_Apertura', $ID_Apertura);
		return $this->db->delete('TApertura');
    }

    public function existeApertura(){

        date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $dia = $now->format('d');
        $mes = $now->format('m');
        $anio = $now->format('Y');
        $sql = "SELECT * FROM TApertura
        where DAY(FechaAlta) = $dia and MONTH(FechaAlta) = $mes AND YEAR(FechaAlta) = $anio";

        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }
        return $result;
    }
    public function existe_cierre_hoy()
    {
        date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $dia = $now->format('d');
        $mes = $now->format('m');
        $anio = $now->format('Y');
        $sql = "SELECT * FROM TCierre
        where DAY(FechaCierre) = $dia and MONTH(FechaCierre) = $mes AND YEAR(FechaCierre) = $anio";

        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }
        return $result;
    }
    public function existe_cuadre_hoy()
    {
        date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $dia = $now->format('d');
        $mes = $now->format('m');
        $anio = $now->format('Y');
        $sql = "SELECT * FROM TCierre
        where DAY(FechaAlta) = $dia and MONTH(FechaAlta) = $mes AND YEAR(FechaAlta) = $anio";

        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }
        return $result;
    }
    public function existePedido_hoy(){
        date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $dia = $now->format('d');
        $mes = $now->format('m');
        $anio = $now->format('Y');
        $sql = "SELECT * FROM TCPedido
        where DAY(FechaHora) = $dia and MONTH(FechaHora) = $mes AND YEAR(FechaHora) = $anio and (TCPedido.ID_Estado =4 or TCPedido.ID_Estado =16)";

        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }
        return $result;
    }
    public function select($ID_Apertura)
    {
        $sql = "SELECT * FROM TApertura WHERE ID_Apertura = $ID_Apertura";

        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }
        return $result->row();
    }

    public function actualizarAperturaCaja($diezCentimos,$veinteCentimos,$cincuentaCentimos,$unSol,$dosSoles,$cincoSoles,$diezSoles,$veinteSoles,$cincuentaSoles,$CienSoles,$doscientosSoles,$ID_Apertura){

        date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $data = array(
            'Q00010' => $diezCentimos,
            'Q00020' => $veinteCentimos,
            'Q00050' => $cincuentaCentimos,
            'Q00100' => $unSol,
            'Q00200' => $dosSoles,
            'Q00500' => $cincoSoles,
            'Q01000' => $diezSoles,
            'Q02000' => $veinteSoles,
            'Q05000' => $cincuentaSoles,
            'Q10000' => $CienSoles,
            'Q20000' => $doscientosSoles,
            'UsuarioMod' => desencriptar($_SESSION['Correo']),
            'FechaMod'=>  $now->format('Y-m-d H:i:s')
        );


        $this->db->where('ID_Apertura', $ID_Apertura);
		return $this->db->update('TApertura', $data);

    }

    public function importe_apertura_hoy(){
        date_default_timezone_set('America/Lima');
        $now = new DateTime();
		$mes = $now->format('m');
        $year = $now->format('Y');
        $day = $now->format('d');

        $sql = "SELECT ID_Apertura,FechaAlta,UsuarioAlta,(Q20000 * 200) + (Q10000 * 100) + (Q05000 * 50) +(Q02000 * 20) +(Q01000 * 10) +(Q00500 * 5) +(Q00200 * 2)+(Q00100 * 1)+
        (Q00050 * 0.50) + (Q00020 * 0.20)+(Q00010 * 0.10) as total
                FROM  TApertura where MONTH(TApertura.FechaAlta)=$mes and  YEAR(TApertura.FechaAlta)=$year and day(TApertura.FechaAlta)=$day";

        $result = $this->db->query($sql);
        if(!$result){
            return false;
        }
        return $result->row();
    }
 
    public function importe_ventas_hoy(){

        date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$mes = $now->format('m');
        $year = $now->format('Y');
        $day = $now->format('d');

        $sql = "SELECT  YEAR(TCPedido.FechaHora) as anio ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=$mes and  YEAR(TCPedido.FechaHora)=$year and day(TCPedido.FechaHora)=$day and TCPedido.ID_Estado=4 and Tipo_cobro = 'Efectivo'";

        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }
        return $result->row();
    }
    public function importe_visa_hoy(){

        date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$mes = $now->format('m');
        $year = $now->format('Y');
        $day = $now->format('d');

        $sql = "SELECT  YEAR(TCPedido.FechaHora) as anio ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=$mes and  YEAR(TCPedido.FechaHora)=$year and day(TCPedido.FechaHora)=$day and TCPedido.ID_Estado=4 and Tipo_cobro = 'Visa'";

        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }
        return $result->row();
    }
    public function importe_mastercard_hoy(){

        date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$mes = $now->format('m');
        $year = $now->format('Y');
        $day = $now->format('d');

        $sql = "SELECT  YEAR(TCPedido.FechaHora) as anio ,MONTH(TCPedido.FechaHora) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaHora)=$mes and  YEAR(TCPedido.FechaHora)=$year and day(TCPedido.FechaHora)=$day and TCPedido.ID_Estado=4 and Tipo_cobro = 'MasterCard'";

        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }
        return $result->row();
    }
    public function importe_cobros_hoy()
    {
        
        date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$mes = $now->format('m');
        $year = $now->format('Y');
        $day = $now->format('d');

        $sql = "SELECT  YEAR(TCPedido.FechaCobro) as anio ,MONTH(TCPedido.FechaCobro) as mes ,SUM(TLPedido.Precio) as total
		FROM TCPedido
		inner join TLPedido on TLPedido.ID_Pedido=TCPedido.ID_Pedido
		inner join MMenu on TLPedido.ID_Menu=MMenu.ID_Menu
		where MONTH(TCPedido.FechaCobro)=$mes and  YEAR(TCPedido.FechaCobro)=$year and day(TCPedido.FechaCobro)=$day and TCPedido.ID_Estado=4";

        $result = $this->db->query($sql);

        if(!$result){
            return false;
        }
        return $result->row();
    }

    public function insertar_cierre_caja($Q20000,$Q10000,$Q05000,$Q02000,$Q01000,$Q00500,$Q00200,$Q00100,$Q00050,$Q00020,$Q00010){
        date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $data = array(
            'Q00010' => $Q00010,
            'Q00020' => $Q00020,
            'Q00050' => $Q00050,
            'Q00100' => $Q00100,
            'Q00200' => $Q00200,
            'Q00500' => $Q00500,
            'Q01000' => $Q01000,
            'Q02000' => $Q02000,
            'Q05000' => $Q05000,
            'Q10000' => $Q10000,
            'Q20000' => $Q20000,

            'UsuarioAlta' => desencriptar($_SESSION['Correo']),
            'FechaAlta'=>  $now->format('Y-m-d H:i:s')
        );

        $this->db->insert('TCierre',$data);
    }
    public function actualizar_cierre_caja($ID_Cierre,$Q20000,$Q10000,$Q05000,$Q02000,$Q01000,$Q00500,$Q00200,$Q00100,$Q00050,$Q00020,$Q00010)
    {
        date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$data = array(
            'Q00010' => $Q00010,
            'Q00020' => $Q00020,
            'Q00050' => $Q00050,
            'Q00100' => $Q00100,
            'Q00200' => $Q00200,
            'Q00500' => $Q00500,
            'Q01000' => $Q01000,
            'Q02000' => $Q02000,
            'Q05000' => $Q05000,
            'Q10000' => $Q10000,
            'Q20000' => $Q20000,

            'UsuarioAlta' => desencriptar($_SESSION['Correo']),
            'FechaAlta'=>  $now->format('Y-m-d H:i:s')
        );

		$this->db->where('ID_Cierre', $ID_Cierre);
		return $this->db->update('TCierre', $data);
    }
    public function CerrarCaja($ID_Cierre)
    {
        date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$data = array(
			'UsuarioCierre' => desencriptar($_SESSION['Correo']),
			'FechaCierre' => $now->format('Y-m-d H:i:s')
		);

		$this->db->where('ID_Cierre', $ID_Cierre);
		return $this->db->update('TCierre', $data);
    }
}
?>