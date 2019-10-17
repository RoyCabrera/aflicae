<?php
class Receta_model extends CI_Model {

    public function __construct() {
    parent::__construct();
    $this->load->database();
    //$this->DB2 = $this->load->database(coneccion(), TRUE);
    }

    public function selectAll($ID_Menu) {
        $sql= "SELECT MMenu.Menu,MInsumo.Insumo,MInsumo.ID_Insumo,TReceta.Cantidad,MUnidadMedida.UnidadMedida,Abreviatura
        from TReceta
        inner join MInsumo on TReceta.ID_Insumo = MInsumo.ID_Insumo
        inner join MUnidadMedida on MUnidadMedida.ID_UnidadMedida = MInsumo.ID_UnidadMedida
        inner join MMenu on MMenu.ID_Menu = TReceta.ID_Menu
        where TReceta.ID_Menu = $ID_Menu
        order by Menu,Insumo" ;
        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result;
    }


     public function devolverNombre($ID_Menu) {

          $sql= "SELECT Menu
          from MMenu
          where ID_Menu =  ".$ID_Menu;

             $result = $this->db->query($sql );

            if(!$result) {
              return false;
                }
                    else
                    {
                             foreach ($result->result() as $row) {
                              return $row->Menu;}
                            }


  }

    public function select($ID,$ID_Menu) {
		$ID_Insumo = desencriptar($ID);
        $sql= "SELECT TReceta.*
                FROM TReceta WHERE ID_Insumo = ".$ID_Insumo." AND ID_Menu=".$ID_Menu;
        $result = $this->db->query($sql);
        if(!$result) {return false;}
        return $result->row();
    }


    public function insertar($ID_Menu,$ID_Insumo,$Cantidad) {
		date_default_timezone_set('America/Lima');
        $now = new DateTime();

        $this->db->where('ID_Insumo',$ID_Insumo);
        $this->db->where('ID_Menu',$ID_Menu);
         $this->db->delete('TReceta');


        $data = array(
            'ID_Menu'=> $ID_Menu,
            'ID_Insumo' => $ID_Insumo,
            'Cantidad' => $Cantidad

        );

        $this->db->insert('TReceta', $data);
     //   return $this->db->insert_id();

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

	public function eliminar($ID_Menu,$ID_Insumo){
		$this->db->where('ID_Insumo',$ID_Insumo);
        $this->db->where('ID_Menu',$ID_Menu);
		return $this->db->delete('TReceta');
    }

    public function actualizar($ID_Menu,$ID_Insumo,$Cantidad) {
		date_default_timezone_set('America/Lima');
        $now = new DateTime();
        $data = array(

            'Cantidad' => $Cantidad

        );

        $this->db->where('ID_Menu', $ID_Menu);
        $this->db->where('ID_Insumo', $ID_Insumo);
        return $this->db->update('TReceta', $data);
    }

}
?>
