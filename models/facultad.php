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
  public function facultadGSave($nombre, $descripcion)
  {
    $result = false;
    $sql = "INSERT INTO `facultades`(`nombre`, `descripcion`) VALUES ('$nombre','$descripcion')";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function facultadGList()
  {
    $sql_facu = "SELECT * FROM `facultades`";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function facultadGEdit($idfacu, $nombre, $descripcion)
  {
    $sql_edit = "UPDATE `facultades` SET `nombre`='$nombre',`descripcion`='$descripcion' WHERE id_facultad = '$idfacu'";
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function facultadGDelete($idfacu)
  {
    /* Verificar si la universidad pertenece a algun registro */
    $respuesta = [];
    $sql_buscar = "SELECT * FROM `univ_fac_carr` WHERE id_facultad = $idfacu;";
    $buscar = $this->db->query($sql_buscar);
    $busqueda = $buscar->fetch_all(MYSQLI_ASSOC);
    if (count($busqueda) == 0) {
      $consulta = "DELETE FROM `facultades` WHERE `id_facultad` = $idfacu";
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
        'mensaje' => 'No se puede inhabilitar esta facultad, ya que hay registros previos donde participa'
      ];
    }
    return $respuesta;
  }
}
