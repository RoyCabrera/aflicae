<?php
class Insumo_model extends CI_Model {

    public function __construct() {
    parent::__construct();
    $this->load->database();
    //$this->DB2 = $this->load->database(coneccion(), TRUE);
    }

    public function selectAll() {
		$sql= "SELECT MInsumo.*,MUnidadMedida.UnidadMedida,Abreviatura from MInsumo
		inner join MUnidadMedida on MUnidadMedida.ID_UnidadMedida = MInsumo.ID_UnidadMedida";
        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result;
	}

	public function selectAllUnidadMedida() {
		$sql = "SELECT * FROM MUnidadMedida";
		$result = $this->db->query($sql);
		if(!$result) {
			return false;
		}
		return $result;
    }
    public function sellectAllFamiliaInsumo() {
		$sql = "SELECT * FROM MFamiliaInsumo";
		$result = $this->db->query($sql);
		if(!$result) {
			return false;
		}
		return $result;
    }

    public function selectStockBajo() {
        $sql= "SELECT * FROM MInsumo
        where Stock < StockMinimo";
        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result;
    }

    public function select($ID_Insumo) {
        $sql= "SELECT MInsumo.*
                FROM MInsumo WHERE ID_Insumo = ".$ID_Insumo;
        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result->row();
    }
    public function select2($ID_Insumo) {
        $sql= "SELECT MInsumo.*,MUnidadMedida.Abreviatura
                FROM MInsumo 
                inner join MUnidadMedida on MUnidadMedida.ID_UnidadMedida = MInsumo.ID_UnidadMedida
                WHERE ID_Insumo = ".$ID_Insumo;
        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result;
    }

    public function insertar($Insumo,$Costo,$StockMinimo,$ID_UnidadMedida,$ID_Familia,$Atributo1,$Atributo2) {

        $data = array(

            'Insumo' => $Insumo,
			'Costo' => $Costo,
			'StockMinimo'=>$StockMinimo,
            'ID_UnidadMedida'=>$ID_UnidadMedida,
            'ID_Familia'=>$ID_Familia,
            'Atributo1'=>$Atributo1,
            'Atributo2'=>$Atributo2

        );


        $this->db->insert('MInsumo', $data);
        return $this->db->insert_id();

    }

    public function subirfoto($Ruta,$ID_Sum){
        $data = array('Imagen' => $Ruta);
        $this->db->where('ID_Sum',$ID_Sum);
        return $this->db->update('MSum',$data);
    }

    public function subirfotoThumbnail($Ruta,$ID_Sum){
        $data = array('ImagenThumbnail' => $Ruta);
        $this->db->where('ID_Sum',$ID_Sum);
        return $this->db->update('MSum',$data);
    }

	public function eliminar($ID_Insumo){
		$this->db->where('ID_Insumo',$ID_Insumo);
		return $this->db->delete('MInsumo');
    }

    public function actualizar($ID_Insumo,$Insumo,$Costo,$StockMinimo,$ID_UnidadMedida,$ID_Familia,$Atributo1,$Atributo2) {

        $data = array(
            'ID_Insumo' => $ID_Insumo,
            'Insumo' => $Insumo,
            'Costo' => $Costo,
			'StockMinimo' => $StockMinimo,
            'ID_UnidadMedida'=>$ID_UnidadMedida,
            'ID_Familia'=>$ID_Familia,
            'Atributo1'=>$Atributo1,
            'Atributo2'=>$Atributo2

        );

        $this->db->where('ID_Insumo', $ID_Insumo);
        return $this->db->update('MInsumo', $data);
    }

	public function StockPorAlmacen($ID_Insumo,$ID_Almacen){
		$sql= "SELECT TAlmacenInsumo.Stock
				FROM TAlmacenInsumo
                where ID_Almacen=".$ID_Almacen." and ID_Insumo=".$ID_Insumo;

        $result = $this->db->query($sql);

        if(!$result) {return 0;}

        foreach($result->result() as $row)
        { return $row->Stock;}
	}

	public function insumoalmacen($ID_Insumo){
		$sql= "SELECT
		TAlmacenInsumo.*, MAlmacen.Almacen,MInsumo.Insumo,MUnidadMedida.Abreviatura
		FROM
		TAlmacenInsumo
			INNER JOIN
		MAlmacen ON MAlmacen.ID_Almacen = TAlmacenInsumo.ID_Almacen
			INNER JOIN
		MInsumo ON MInsumo.ID_Insumo = TAlmacenInsumo.ID_Insumo
			INNER JOIN
		MUnidadMedida ON MUnidadMedida.ID_UnidadMedida = MInsumo.ID_UnidadMedida
				where TAlmacenInsumo.ID_Insumo=".$ID_Insumo;
        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result;
    }

    public function verDetalles($ID_Insumo){

       /*  $ID_Almacen=desencriptar($_SESSION['ID_Almacen']);

        $sql= "SELECT xxx.* from(
        select 'Compra' as quees, FechaHora,Cantidad from TCompra where ID_Insumo=$ID_Insumo and ID_Almacen=$ID_Almacen
        union
        select  'Consumo' as quees , FechaHora,Cantidad  from TSalida   where ID_Insumo=$ID_Insumo and ID_Almacen=$ID_Almacen
		) as xxx order by FechaHora desc"; */

		$sql = "SELECT xxx.* from(
			select 'Compra' as quees, FechaHora,Cantidad,MAlmacen.Almacen,'Tipo' from TCompra
			 inner join  MAlmacen on MAlmacen.ID_Almacen =TCompra.ID_ALmacen
			where ID_Insumo=$ID_Insumo
			union
			select  'Consumo' as quees , FechaHora,Cantidad,MAlmacen.Almacen,'Tipo' from TSalida
			inner join MAlmacen on MAlmacen.ID_Almacen =TSalida.ID_ALmacen
			where ID_Insumo=$ID_Insumo
            union
            select  'Ajuste' as quees , FechaHora,Cantidad,MAlmacen.Almacen,TAjuste.Tipo  from TAjuste
			inner join MAlmacen on MAlmacen.ID_Almacen =TAjuste.ID_ALmacen
			where ID_Insumo=$ID_Insumo
			) as xxx order by FechaHora desc";

        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result ;
    }


}
?>
