<?php

require_once "../config/db.php";

class Facultad
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  /* ##### METODOS ###### */
  public function facultadGSave($nombre, $descripcion, $univ, $decano, $rename)
  {
    $result = false;
    $sql = "INSERT INTO `facultades`(`id_univ`, `nombre`, `decano`, `descripcion`, `imagen`) VALUES ('$univ','$nombre','$decano','$descripcion', '$rename')";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function facultadGList()
  {
    $sql_facu = "SELECT f.id_facultad, u.nombre as 'univ', f.nombre, f.descripcion, f.imagen, f.decano, f.id_univ, f.estado FROM `facultades` as f, universidades as u WHERE f.id_univ = u.id_universidad;";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function facultadGEdit($iduniv, $idfacu, $nombre, $decano, $descripcion, $rename)
  {
    $sql_edit = "UPDATE `facultades` SET `id_univ`='$iduniv',`nombre`='$nombre',`decano`='$decano',`descripcion`='$descripcion'";
    if ($rename != '') {
      $sql_edit = "$sql_edit, `imagen`='$rename' WHERE `id_facultad`='$idfacu'";
    } else {
      $sql_edit = "$sql_edit WHERE `id_facultad`='$idfacu'";
    }
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function facultadGDelete($idfacu)
  {
    /* Verificar si la facultad pertenece a algun registro */
    $respuesta = [];
    $sql_buscar = "SELECT * FROM `carreras` WHERE id_facu = $idfacu;";
    $buscar = $this->db->query($sql_buscar);
    $busqueda = $buscar->fetch_all(MYSQLI_ASSOC);
    if (count($busqueda) == 0) {
      $consulta = "UPDATE `facultades` SET `estado` = 'inactivo' WHERE id_facultad = $idfacu;";
      $query = $this->db->query($consulta);
      if ($query == 1) {
        $respuesta = [
          'estado' => 'ok',
          'mensaje' => 'Se procedio a inhabilitar la Facultad'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'No se puede inhabilitar esta facultad, ya que hay registros previos donde participa'
      ];
    }
    return $respuesta;
  }
  public function facultadGHabilitar($idfacu)
  {
    $respuesta = false;
    $sql_buscar = "UPDATE `facultades` SET `estado` = 'activo' WHERE id_facultad = $idfacu;";
    $query = $this->db->query($sql_buscar);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function facultadGListEspecifico($iduniv)
  {
    $sql_facu = "SELECT id_facultad, nombre from  facultades WHERE id_univ = $iduniv";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
}
