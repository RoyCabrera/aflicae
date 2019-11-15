<?php
class Compra_model extends CI_Model {

    public function __construct() {

    parent::__construct();
    $this->load->database();

    }
    public function selectAll() {

		$sql = "SELECT TCompra.*,MUsuario.Nombre,MUsuario.ApellidoPaterno,MUsuario.ApellidoMaterno,MInsumo.Insumo,MFamiliaInsumo.Familia,MInsumo.Atributo1,MInsumo.Atributo2,MAlmacen.Almacen,MUnidadMedida.*
		from TCompra
		inner join MInsumo on MInsumo.ID_Insumo = TCompra.ID_Insumo
        inner join MUnidadMedida on MUnidadMedida.ID_UnidadMedida=MInsumo.ID_UnidadMedida
        inner join MUsuario on MUsuario.Correo = TCompra.CodUsuario
		left join MFamiliaInsumo on MFamiliaInsumo.ID_Familia = MInsumo.ID_Familia
		inner join MAlmacen on MAlmacen.ID_Almacen = TCompra.ID_Almacen";

		$result = $this->db->query($sql);

		if(!$result) {
			return false;
		}
        return $result;
	}

	public function selectAll_aflicae() {
		$sql = "SELECT TCompra.*,MInsumo.Insumo,MAlmacen.Almacen
				from TCompra
				inner join MInsumo on MInsumo.ID_Insumo = TCompra.ID_Insumo
				inner join MAlmacen on MAlmacen.ID_Almacen = TCompra.ID_Almacen";
		$result = $this->db->query($sql);
		if(!$result) {
			return false;
		}
        return $result;
	}


	public function selectAllListaCompra(){

		if(desencriptar($_SESSION['ID_Perfil'])==1 || desencriptar($_SESSION['ID_Perfil'])==1){
			$sql="SELECT TCListaCompra.*, MEstado.Estado,MUsuario.ApellidoPaterno,MUsuario.ApellidoMaterno,MUsuario.Nombre
			from TCListaCompra
			inner join MEstado on MEstado.ID_Estado = TCListaCompra.ID_Estado
			inner join MUsuario on MUsuario.Correo = TCListaCompra.CodUsuario
			order by TCListaCompra.FechaHora DESC";
		}else{
			$Correo=desencriptar($_SESSION['Correo']);
			$sql="SELECT TCListaCompra.*, MEstado.Estado,MUsuario.ApellidoPaterno,MUsuario.ApellidoMaterno,MUsuario.Nombre
		from TCListaCompra
		inner join MEstado on MEstado.ID_Estado = TCListaCompra.ID_Estado
		inner join MUsuario on MUsuario.Correo = TCListaCompra.CodUsuario
		where TCListaCompra.CodUsuario='$Correo'
		order by TCListaCompra.FechaHora DESC";
		}

		
		$result = $this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;
	}



	public function insertar($ID_Insumo,$ID_Almacen,$Cantidad) {

		/*
		1.- ingresa en TAlmacenInsumo
		2.- ingresa en Minsumo
		3.- ingresa en MCompra
		*/
		$sql = "SELECT  *  from TAlmacenInsumo where ID_Almacen=". $ID_Almacen ." and ID_Insumo=". $ID_Insumo;
		$result = $this->db->query($sql);

		if(!$result || $result->num_rows() < 1)  {

			//insert
			$data = array(
			'ID_Insumo' => $ID_Insumo,
			'ID_Almacen' => $ID_Almacen,
			'Stock' => $Cantidad
			);
			$this->db->insert('TAlmacenInsumo', $data);
			$this->db->insert_id();

		} else {
			// update
			$sql = "SELECT Stock from TAlmacenInsumo where ID_Almacen=". $ID_Almacen ." and  ID_Insumo=". $ID_Insumo;

			$result = $this->db->query($sql);
			if(!$result) {
				$stock=0;
			}
			foreach ($result->result() as $row )
			{
				$stock=$row->Stock;
			}
			if($stock==null){
				$stock=0;
			}


			$data = array('Stock'=>$stock + $Cantidad);
			$this->db->where('ID_Insumo', $ID_Insumo);
			$this->db->where('ID_Almacen', $ID_Almacen);
			$this->db->update('TAlmacenInsumo', $data);

		}


		$stock=0;



		/*-------------------------------------*/

		$sql = "SELECT Stock from MInsumo where ID_Insumo=". $ID_Insumo;

			$result = $this->db->query($sql);
			if(!$result) {
				$stock=0;
			}
			foreach ($result->result() as $row )
			{
				$stock=$row->Stock;
			}

		if( $stock==null){$stock=0;}

				$data = array('Stock'=>$stock + $Cantidad);
				$this->db->where('ID_Insumo', $ID_Insumo);
				$this->db->update('MInsumo', $data);

		/*--------------------------------------------------------*/


		date_default_timezone_set('America/Lima');

			$now = new DateTime();
			$data = array(
				'ID_Insumo' => $ID_Insumo,
				'ID_Almacen' => $ID_Almacen,
				'FechaHora'=>  $now->format('Y-m-d H:i:s'),
				'CodUsuario' => desencriptar($_SESSION['Correo']),
				'Cantidad'=> $Cantidad
			);
		//    print_r($data);
		//   die;




        $this->db->insert('TCompra', $data);
        return $this->db->insert_id();

	}

	public function insertarAlmacenCompras($ID_Insumo,$Cantidad,$precio,$ID_Lista) {

		
		$data3 = array('Comprado'=>1);

		$this->db->where('ID_Lista', $ID_Lista);
		$this->db->update('TDetalleListaCompra', $data3);
		$ID_Almacen = 4; // almacen compras por defecto

		$sql = "SELECT  *  from TAlmacenInsumo where ID_Almacen=". $ID_Almacen ." and ID_Insumo=". $ID_Insumo;
		$result = $this->db->query($sql);

		if(!$result || $result->num_rows() < 1)  {

			//insert
			$data = array(
			'ID_Insumo' => $ID_Insumo,
			'ID_Almacen' => $ID_Almacen,
			'Stock' => $Cantidad
			);
			$this->db->insert('TAlmacenInsumo', $data);
			$this->db->insert_id();

		} else {
			// update
			$sql = "SELECT Stock from TAlmacenInsumo where ID_Almacen=". $ID_Almacen ." and  ID_Insumo=". $ID_Insumo;

			$result = $this->db->query($sql);
			if(!$result) {
				$stock=0;
			}
			foreach ($result->result() as $row )
			{
				$stock=$row->Stock;
			}
			if($stock==null){
				$stock=0;
			}


			$data2 = array('Stock'=>$stock + $Cantidad);
			$this->db->where('ID_Insumo', $ID_Insumo);
			$this->db->where('ID_Almacen', $ID_Almacen);
			$this->db->update('TAlmacenInsumo', $data2);

			

		}
		/*************************************************** */

		$data3 = array('Comprado'=>1);

		$this->db->where('ID_Lista', $ID_Lista);
		$this->db->update('TDetalleListaCompra', $data3);


		/*--------------------------------------------------*/
		
		date_default_timezone_set('America/Lima');

		$now = new DateTime();
		$data = array(
			'ID_Insumo' => $ID_Insumo,
			'ID_Almacen' => $ID_Almacen,
			'FechaHora'=>  $now->format('Y-m-d H:i:s'),
			'CodUsuario' => desencriptar($_SESSION['Correo']),
			'Cantidad'=> $Cantidad,
			'Precio'=>$precio
		);
	//    print_r($data);
	//   die;




	$this->db->insert('TCompra', $data);
	return $this->db->insert_id();



	}
	public function insertarAlmacenComprasConversion($ID_Insumo,$Cantidad,$precio,$ID_Lista,$unidadMedidaCompra,$unidadConversion) {

	}

	public function eliminar($ID_Compra){

		$this->db->where('ID_Compra',$ID_Compra);
		return $this->db->delete('TCompra');
	}
	public function select($ID_Compra) {

		$sql= "SELECT TCompra.*
                FROM TCompra WHERE ID_Compra = ".$ID_Compra;
        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result->row();
	}
	public function actualizar($ID_Insumo,$ID_Almacen,$Cantidad,$ID_Compra) {
	/* 	date_default_timezone_set('America/Lima');
		$now = new DateTime(); */
		$data = array(
			'ID_Compra'=>$ID_Compra,
		  'ID_Insumo' => $ID_Insumo,
		  'ID_Almacen' => $ID_Almacen,
		  'Cantidad' => $Cantidad

	  );

	  $this->db->where('ID_Compra', $ID_Compra);
	  return $this->db->update('TCompra', $data);
	}

	public function insertListaCompra($CodUsuario,$Observacion) {
		
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$data = array(
			'FechaHora'=> $now->format('Y-m-d H:i:s'),
			'ID_Estado' => 10,
			'Observacion' => $Observacion,
			'CodUsuario' => $CodUsuario
		);
		$this->db->insert('TCListaCompra',$data);
		return $this->db->insert_id();

	}

	public function insertarLista($ID_Insumo,$Cantidad,$ID_ListaCompra,$CodUsuario) {

		date_default_timezone_set('America/Lima');
		$now = new DateTime();
        $data = array(

            'ID_Insumo' => $ID_Insumo,
            'Codusuario' => $CodUsuario,
			'FechaHora'=>  $now->format('Y-m-d H:i:s'),
			'Comprado'=>0,
           	'ID_ListaCompra'=> $ID_ListaCompra,
           	'Cantidad'=> $Cantidad
        );

        $this->db->insert('TDetalleListaCompra', $data);
        return $this->db->insert_id();
	}

	public function listaCompraPendiente(){
		$sql="SELECT TDetalleListaCompra.*,MInsumo.*,MUnidadMedida.Abreviatura
		from TDetalleListaCompra
		inner join MInsumo on MInsumo.ID_Insumo = TDetalleListaCompra.ID_Insumo
        inner join MUnidadMedida on MUnidadMedida.ID_UnidadMedida = MInsumo.ID_UnidadMedida";
		$result = $this->db->query($sql);

		if(!$result) {
			return false;
		}
        return $result;
	}
	public function listarCompradores(){
		$sql="SELECT * FROM MUsuario where ID_Perfil = 6 or ID_Perfil = 8 order by RepartidorDisponible ASC";
		$result = $this->db->query($sql);

		if(!$result) {
			return false;
		}
        return $result;
	}
	public function CambiarEstadoUsuarioCompra($Correo) {
		
		$data = array(
			'CompradorDisponible'=>0
		);
		$this->db->where('Correo', $Correo);
	  return $this->db->update('MUsuario', $data);
	}
	public function InsertarImporteEnviadoCompra($Correo,$cien,$cincuenta,$veinte,$diez,$cinco,$dos,$uno,$cincuentaC,$veinteC,$diezC,$ID_ListaCompra,$total) {
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
		$data = array(
            'FechaHora' =>  $now->format('Y-m-d H:i:s'),
            'Correo' => $Correo,
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
			'Comprado'=>0,
			'Total'=>$total,
			'ID_ListaCompra'=>$ID_ListaCompra
		);

		$this->db->insert('TDineroCompra', $data);
		return $this->db->insert_id();
	}
	public function CambiarEstadoDineroAsignado($ID_ListaCompra){
		$data=array(
			'ID_Estado'=>14
		);

		$this->db->where('ID_ListaCompra', $ID_ListaCompra);
	  return $this->db->update('TCListaCompra', $data);
	}
	public function EliminarLista($Correo)
	{
		
		$data = array(
			'CodUsuario'=>$Correo,
			'Comprado'=>0
		);
		return $this->db->delete('TListaCompras',$data);
	}
	public function EliminarDineroAsignado($Correo) {
		
		$data= array(
			'Correo'=>$Correo,
			'Comprado'=>0
		);
		return $this->db->delete('TDineroCompra',$data);
	}

	public function QuitarEstadoComprado($Correo) {

		$data = array(
			'CompradorDisponible'=>1,
			'DineroAsignadoCompras'=>0
		);
		$this->db->where('Correo', $Correo);
	  	return $this->db->update('MUsuario', $data);
	}

	public function selectDineroListaCompra($ID_ListaCompra) {
		$sql= "SELECT * FROM TDineroCompra
		where ID_ListaCompra = $ID_ListaCompra";
		$result = $this->db->query($sql);
		if(!$result) 
		{return 
			false;
		}
		return $result;
	}
	public function actualizarDineroCompra($ID_ListaCompra,$cien,$cincuenta,$veinte,$diez,$cinco,$dos,$uno,$cincuentaC,$veinteC,$diezC,$total){
	
		$data = array(

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
			'Comprado'=>0,
			'Total'=>$total
		);
		
		$this->db->where('ID_ListaCompra', $ID_ListaCompra);
		//$this->db->where('Comprado', 0);
		return $this->db->update('TDineroCompra', $data);
	}

	public function ListaCompraAsignado() {
		$Correo=desencriptar($_SESSION['Correo']);
		
		$sql = "SELECT TCListaCompra.*, MEstado.Estado,MUsuario.ApellidoPaterno,MUsuario.ApellidoMaterno,MUsuario.Nombre
				from TCListaCompra
				inner join MEstado on MEstado.ID_Estado = TCListaCompra.ID_Estado
				inner join MUsuario on MUsuario.Correo = TCListaCompra.CodUsuario 
				where CodUsuario='$Correo' order by TCListaCompra.FechaHora DESC";
		$result = $this->db->query($sql);
		if(!$result) 
		{return 
			false;
		}
		return $result;

	}

	public function selectDetalleListaCompra($ID_ListaCompra) {

		$sql = "SELECT TDetalleListaCompra.*,MInsumo.*,MUnidadMedida.Abreviatura,MFamiliaInsumo.Familia
				from TDetalleListaCompra
				inner join MInsumo on MInsumo.ID_Insumo = TDetalleListaCompra.ID_Insumo
				left join MFamiliaInsumo on MFamiliaInsumo.ID_Familia = MInsumo.ID_Familia
				inner join MUnidadMedida on MUnidadMedida.ID_UnidadMedida = MInsumo.ID_UnidadMedida
				where TDetalleListaCompra.ID_ListaCompra='$ID_ListaCompra' order by TDetalleListaCompra.Comprado ASC";
		$result = $this->db->query($sql);
		if(!$result) 
		{return 
			false;
		}
		return $result;
	}
	public function estadodetalleaPreparado($ID_Lista)
	{
		$data = array(
			'Comprado' => 1,
		);
		$this->db->where('ID_Lista', $ID_Lista);
		return $this->db->update('TDetalleListaCompra', $data);
	}

	public function existeDetalleEnPendiente($ID_ListaCompra)
	{
		
		$sql = "SELECT * from TDetalleListaCompra where Comprado = 0 and ID_ListaCompra = $ID_ListaCompra";

		$result = $this->db->query($sql);

		if (!$result || $result->num_rows() < 1) {
			return false;
		}else{
			return true;
		}
	}

	public function estadoCompraEnProceso($ID_ListaCompra)
	{
		

		$data = array(
			'ID_Estado' => 15,
		);
		$this->db->where('ID_ListaCompra', $ID_ListaCompra);
		$this->db->update('TCListaCompra', $data);
	}

	public function estadoCompraTerminada($ID_ListaCompra)
	{
		//$ID = desencriptar($ID_Pedido);

		$data = array(
			'ID_Estado' => 12,
		);
		$this->db->where('ID_ListaCompra', $ID_ListaCompra);
		$this->db->update('TCListaCompra', $data);
	}
	public function eliminarListaCompra($ID_ListaCompra)
	{
		$this->db->where('ID_ListaCompra', $ID_ListaCompra);
		return $this->db->delete('TCListaCompra');
	}
	
	public function eliminarListaCompraDetalle($ID_Lista)
	{
		$this->db->where('ID_Lista', $ID_Lista);
		return $this->db->delete('TDetalleListaCompra');
	}
	public function selectDineroAsignado($ID_ListaCompra)
	{
		$sql = "SELECT * from TCListaCompra
				where ID_ListaCompra=$ID_ListaCompra";

		$result = $this->db->query($sql);
		if(!$result) 
		{return 
			false;
		}
		return $result;
	}
	public function actualizarListaCompras($ID_ListaCompra,$total){

		$data = array(
			'TotalDineroAsignado' => $total,
		);
		$this->db->where('ID_ListaCompra', $ID_ListaCompra);
		$this->db->update('TCListaCompra', $data);
	}
	/* public function selectTotalDineroAsignado($ID_ListaCompra)
	{
		$sql = "SELECT * from TDineroCompra
				where ID_ListaCompra=$ID_ListaCompra";

		$result = $this->db->query($sql);
		if(!$result) 
		{return 
			false;
		}
		return $result;
	} */
	public function selectTotalDinero($ID_ListaCompra)
	{
		$sql = "SELECT * from TDineroCompra
				where ID_ListaCompra=$ID_ListaCompra";

		$result = $this->db->query($sql);
		if(!$result) 
		{return 
			false;
		}
		return $result;
	}

	public function restarDineroCompra($ID_ListaCompra,$precio)
	{
		$result = $this->selectTotalDinero($ID_ListaCompra);

		$total=0;
		foreach($result->result() as $row){
			$total = $row->Total;
		}

		$restar = $total - $precio;

		$data = array(
			'Total' => $restar,
		);
		$this->db->where('ID_ListaCompra', $ID_ListaCompra);
		$this->db->update('TDineroCompra', $data);
	}
	public function rendiCompra($ID_ListaCompra)
	{
		$data = array(
			'ID_Estado' => 13,
		);
		$this->db->where('ID_ListaCompra', $ID_ListaCompra);
		$this->db->update('TCListaCompra', $data);
	}
	public function precioUltimaCompraInsumo($ID_Insumo){
		$sql = "SELECT TCompra.Precio from TCompra
		where ID_Insumo=$ID_Insumo order by FechaHora DESC limit 1";

		$result = $this->db->query($sql);
		if(!$result) 
		{return 
			false;
		}
		return $result;
	}
	
	public function actualizarPrecioListaCompra($ID_Lista,$precio)
	{
		$data = array(
			'Precio' => $precio,
		);
		$this->db->where('ID_Lista', $ID_Lista);
		$this->db->update('TDetalleListaCompra', $data);
	}
	public function selectListaCompra($ID_ListaCompra){
		$sql = "SELECT * from TCListaCompra
				where ID_ListaCompra = $ID_ListaCompra";
		$result=$this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result->row();
	}
	public function updateListaCompra($ID_ListaCompra,$CodUsuario,$Observacion) {
		$data = array(
			'CodUsuario' => $CodUsuario,
			'Observacion' => $Observacion
		);
		$this->db->where('ID_ListaCompra', $ID_ListaCompra);
		$this->db->update('TCListaCompra', $data);
	}
	public function actualizarListaCompra($ID_ListaCompra,$ID_Lista,$ID_Insumo) {
		$data = array(
			'ID_Insumo' => $ID_Insumo
		);
		$array = array('ID_Lista' => $ID_Lista, 'ID_ListaCompra' => $ID_ListaCompra);
		$this->db->where($array); 
		$this->db->update('TDetalleListaCompra', $data);
	}

	public function insertarCompraDirecta($ID_Proveedor,$Producto,$Cantidad,$Precio){
		date_default_timezone_set('America/Lima');
		$now = new DateTime();
        $data = array(

            'Producto' => $Producto,
            'ID_Proveedor' => $ID_Proveedor,
			'FechaHora'=>  $now->format('Y-m-d H:i:s'),
			'Cantidad'=>$Cantidad,
           	'Precio'=> $Precio,
           	
        );

        $this->db->insert('TCompraDirecta', $data);
        return $this->db->insert_id();
	}

	public function selectAllCompraDirecta() {
		$sql="SELECT TCompraDirecta.ID_CompraDirecta,Producto,Cantidad,Precio,FechaHora, MProveedor.Proveedor from TCompraDirecta
		inner join MProveedor on MProveedor.ID_Proveedor = TCompraDirecta.ID_Proveedor";
		$result=$this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;
	}

	// ver el total de dinero asignado *
	public function selectTotalDineroAsignadoCompra($ID_ListaCompra){

		$sql = "SELECT ID_DineroCompra,ID_ListaCompra,(cien * 100) +(cincuenta * 50)+(veinte * 20 )+(diez * 10 )+(cinco * 5)+(dos * 2)+(uno * 1)+(cincuentaC * 0.50)+(veinteC * 0.20)+(diezC * 0.10)  as total
		FROM  TDineroCompra where ID_ListaCompra = $ID_ListaCompra";

		$result=$this->db->query($sql);
		if(!$result){
			return false;
		}
		return $result;

	}
	
}
