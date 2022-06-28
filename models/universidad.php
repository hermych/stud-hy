<?php

require_once "../config/db.php";

class Universidad
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  /* ##### METODOS ###### */
  public function guardarUniversidad($nombre, $iddep, $idprov, $iddist, $descripcion, $imagen)
  {
    $result = false;
    $sql = "INSERT INTO `universidades`(`id_departamento`, `id_provincia`, `id_distrito`,`nombre`, `descripcion`, `imagen_url`) VALUES ('$iddep','$idprov','$iddist','$nombre','$descripcion','$imagen')";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function universidadGList()
  {
    $sql_univ = "SELECT id_universidad, u.nombre, descripcion, imagen_url as 'imagen', d.nombre as 'departamento', u.id_departamento, u.id_distrito, u.id_provincia, p.nombre as 'provincia', di.nombre as 'distrito', u.estado as 'estado' FROM universidades as u, departamentos as d, provincias as p, distritos as di WHERE u.id_departamento = d.id_departamento AND u.id_provincia = p.id_provincia AND u.id_distrito = di.id_distrito;";
    $listarUnv = $this->db->query($sql_univ);
    $universidades = $listarUnv->fetch_all(MYSQLI_ASSOC);
    return $universidades;
  }
  public function universidadGListActivos()
  {
    $sql_listar = "SELECT id_universidad, u.nombre, descripcion, imagen_url as 'imagen', d.nombre as 'departamento', u.id_departamento, u.id_distrito, u.id_provincia, p.nombre as 'provincia', di.nombre as 'distrito', u.estado as 'estado' FROM universidades as u, departamentos as d, provincias as p, distritos as di WHERE u.id_departamento = d.id_departamento AND u.id_provincia = p.id_provincia AND u.id_distrito = di.id_distrito AND estado = 'activo';";
    $listar = $this->db->query($sql_listar);
    $universidades = $listar->fetch_all(MYSQLI_ASSOC);
    return $universidades;
  }
  public function universidadGEdit($iduniv, $nombre, $iddep, $idprov, $iddist, $descripcion, $imagen)
  {
    if ($imagen != '') {
      $sql_edit = "UPDATE `universidades` SET `id_departamento`='$iddep',`id_provincia`='$idprov',`id_distrito`='$iddist',`nombre`='$nombre',`descripcion`='$descripcion',`imagen_url`='$imagen' WHERE id_universidad = '$iduniv'";
    } else {
      $sql_edit = "UPDATE `universidades` SET `id_departamento`='$iddep',`id_provincia`='$idprov',`id_distrito`='$iddist',`nombre`='$nombre',`descripcion`='$descripcion' WHERE id_universidad = '$iduniv'";
    }
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function universidadGDelete($iduniv)
  {
    /* Verificar si la universidad pertenece a algun registro */
    $respuesta = [];
    $sql_buscar = "SELECT * FROM `facultades` WHERE id_univ = $iduniv;";
    $buscar = $this->db->query($sql_buscar);
    $busqueda = $buscar->fetch_all(MYSQLI_ASSOC);
    if (count($busqueda) == 0) {
      $consulta = "UPDATE  `universidades` SET `estado`='inactivo' WHERE `id_universidad` = $iduniv";
      $query = $this->db->query($consulta);
      if ($query == 1) {
        $respuesta = [
          'estado' => 'ok',
          'mensaje' => 'Se procedio a inhabilitar la universidad'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'No se puede inhabilitar esta universidad, ya que hay registros previos donde participa'
      ];
    }
    return $respuesta;
  }
  public function universidadGHabilitar($iduniv)
  {
    /* Verificar si la universidad pertenece a algun registro */
    $respuesta = [];
    $sql_buscar = "SELECT * FROM `univ_fac_carr` WHERE id_universidad = $iduniv;";
    $buscar = $this->db->query($sql_buscar);
    $busqueda = $buscar->fetch_all(MYSQLI_ASSOC);
    if (count($busqueda) == 0) {
      $consulta = "UPDATE  `universidades` SET `estado`='activo' WHERE `id_universidad` = $iduniv";
      $query = $this->db->query($consulta);
      if ($query == 1) {
        $respuesta = [
          'estado' => 'ok',
          'mensaje' => 'Se procedio a inhabilitar la universidad'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'No se puede inhabilitar esta universidad, ya que hay registros previos donde participa'
      ];
    }
    return $respuesta;
  }
}
