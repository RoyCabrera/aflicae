<?php
class Usuario_model extends CI_Model
{

  private $DB2 = null;


  public function __construct()
  {
    parent::__construct();

    $this->DB2 = $this->load->database('default', TRUE);
  }

  public function selectUsuariosCompras() {
    $sql = "SELECT MUsuario.*, TPerfil.Perfil FROM MUsuario
            INNER JOIN TPerfil ON TPerfil.ID_Perfil = MUsuario.ID_Perfil
            where (MUsuario.ID_Perfil = 6 or MUsuario.ID_Perfil = 8)";
    $result = $this->DB2->query($sql);
    if (!$result) {
      return false;
  }

return $result;
  }

  public function selectAll()
  {

    $sql = "SELECT MUsuario.*, TPerfil.Perfil FROM MUsuario
            INNER JOIN TPerfil ON TPerfil.ID_Perfil = MUsuario.ID_Perfil";
    /*$sql= "SELECT MUsuario.*, TPerfil.Perfil, MAlmacen.Almacen FROM MUsuario
      INNER JOIN TPerfil ON TPerfil.ID_Perfil = MUsuario.ID_Perfil
      INNER JOIN MAlmacen ON MAlmacen.ID_Almacen = MUsuario.ID_Almacen";*/


    $result = $this->DB2->query($sql);
    if (!$result) {
      return false;
    }

    return $result;
  }

  public function selectAllTipoPerfil()
  {

    $sql = "SELECT * FROM TPerfil";

    $query = $this->DB2->query($sql);
    if (!$query || $query->num_rows() < 1) {
      return false;
    }

    return $query;
  }
  public function selectAllAlmacen()
  {

    $sql = "SELECT * FROM MAlmacen";

    $query = $this->DB2->query($sql);
    if (!$query || $query->num_rows() < 1) {
      return false;
    }

    return $query;
  }


  public function selectNombreCompleto($Correo)
  {

    $sql = "SELECT CONCAT(Nombre,' ',IFNULL(ApellidoPaterno,''),' ',IFNULL(ApellidoMaterno,'')) as NombreCompleto
    FROM MUsuario WHERE Correo = '" . $Correo . "'";

    $query = $this->DB2->query($sql);
    if (!$query || $query->num_rows() < 1) {
      return '';
    }

    return $query->row()->NombreCompleto;
  }


  public function select($Correo)
  {

    //$sql = "SELECT * FROM MUsuario WHERE Correo ='".$Correo."'";
    $sql = "SELECT MUsuario.*,MAlmacen.Almacen FROM MUsuario
          left outer JOIN MAlmacen ON MAlmacen.ID_Almacen = MUsuario.ID_Almacen
          WHERE Correo ='" . $Correo . "'";

    $query = $this->DB2->query($sql);
    if (!$query || $query->num_rows() < 1) {
      return false;
    }

    return $query->row();
  }

  public function selectAllUsuarioPerfil($ID_Perfil)
  {

    $sql = "SELECT * FROM MUsuario WHERE ID_Perfil =" . $ID_Perfil;

    $query = $this->DB2->query($sql);
    if (!$query || $query->num_rows() < 1) {
      return false;
    }

    return $query;
  }

  public function insertar($Correo, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $ID_TipoDocumento, $Documento, $ID_Perfil, $Telefono, $Clave, $ID_Almacen, $Direccion, $Distrito)
  {
    date_default_timezone_set('America/Lima');
    $now = new DateTime();
    $data = array(
      'Correo' => $Correo,
      'Nombre' => $Nombre,
      'ApellidoPaterno' => $ApellidoPaterno,
      'ApellidoMaterno' => $ApellidoMaterno,
      'ID_TipoDocumento' => $ID_TipoDocumento,
      'Documento' => $Documento,
      'ID_Perfil' => $ID_Perfil,
      'Telefono' => $Telefono,
      'Clave' => $Clave,
      'ID_Almacen' => $ID_Almacen,
      'Distrito' => $Distrito,
      'Direccion' => $Direccion,
      'Departamento' => 'LIMA',
      'Tema' => 'a',
      'UsuarioAlta' => desencriptar($this->session->userdata('Correo')),
      'FechaAlta' => $now->format('Y-m-d H:i:s'),
      'UsuarioMod' => desencriptar($this->session->userdata('Correo')),
      'FechaMod' =>  $now->format('Y-m-d H:i:s')
    );
    return $this->db->insert('MUsuario', $data);
  }
  public function insertarClienteDelivery($Correo, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $Piso, $Empresa, $ID_Perfil, $Telefono, $Clave, $ID_Almacen, $Direccion, $Distrito)
  {

    $data = array(
      'Correo' => $Correo,
      'Nombre' => $Nombre,
      'ApellidoPaterno' => $ApellidoPaterno,
      'ApellidoMaterno' => $ApellidoMaterno,
      'Piso' => $Piso,
      'Empresa' => $Empresa,
      'ID_Perfil' => $ID_Perfil,
      'Telefono' => $Telefono,
      'Clave' => $Clave,
      'ID_Almacen' => $ID_Almacen,
      'Distrito' => $Distrito,
      'Direccion' => $Direccion,

    );
    return $this->db->insert('MClienteDelivery', $data);
  }

  public function subirfoto($Ruta, $Correo)
  {
    $data = array('Imagen' => $Ruta);
    $this->db->where('Correo', $Correo);
    return $this->db->update('MUsuario', $data);
  }

  public function subirfotoThumbnail($Ruta, $Correo)
  {
    $data = array('ImagenThumbnail' => $Ruta);
    $this->db->where('Correo', $Correo);
    return $this->db->update('MUsuario', $data);
  }

  public function baja($Correo)
  {
    $data = array('Baja' => 1);
    $this->db->where('Correo', $Correo);
    return $this->db->update('MUsuario', $data);
  }

  public function alta($Correo)
  {
    $data = array('Baja' => null);
    $this->db->where('Correo', $Correo);
    return $this->db->update('MUsuario', $data);
  }


  public function actualizar($Correo, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $ID_TipoDocumento, $Documento, $ID_Perfil, $Telefono, $Clave, $ID_Almacen, $Direccion, $Distrito)
  {
    date_default_timezone_set('America/Lima');
    $now = new DateTime();
    $data = array(
      'Nombre' => $Nombre,
      'ApellidoPaterno' => $ApellidoPaterno,
      'ApellidoMaterno' => $ApellidoMaterno,
      'ID_TipoDocumento' => $ID_TipoDocumento,
      'Documento' => $Documento,
      'ID_Perfil' => $ID_Perfil,
      'Telefono' => $Telefono,
      'Distrito' => $Distrito,
      'Departamento' => 'LIMA',
      'Direccion' => $Direccion,
      'Clave' => $Clave,
      'ID_Almacen' => $ID_Almacen,
      'UsuarioMod' => desencriptar($this->session->userdata('Correo')),
      'FechaMod' =>  $now->format('Y-m-d H:i:s')
    );

    $this->db->where('Correo', $Correo);
    return $this->db->update('MUsuario', $data);
  }

  public function existeCorreo($Correo)
  {

    $sql = "SELECT * FROM MUsuario WHERE Correo ='" . $Correo . "'";

    $query = $this->DB2->query($sql);
    if (!$query || $query->num_rows() < 1) {
      return false;
    } else {
      return true;
    }
  }
  public function existeCorreoClienteDelivery($Correo)
  {

    $sql = "SELECT * FROM MClienteDelivery WHERE Correo ='" . $Correo . "'";

    $query = $this->DB2->query($sql);
    if (!$query || $query->num_rows() < 1) {
      return false;
    } else {
      return true;
    }
  }
}
