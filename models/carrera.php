<?php

require_once "../config/db.php";

class Carrera
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  /* ##### METODOS ###### */
  public function carreraGSave($nombre, $duracion, $grado, $titulo, $descripcion, $perfil)
  {
    $result = false;
    $sql = "INSERT INTO `carreras`(`nombre`, `descripcion`, `grado`, `titulo`, `duracion`, `perfil`) VALUES ('$nombre','$descripcion','$grado','$titulo','$duracion','$perfil')";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function carreraGList()
  {
    $sql_facu = "SELECT * FROM `carreras`";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function carreraGEdit($idfacu, $nombre, $descripcion)
  {
    $sql_edit = "UPDATE `facultades` SET `nombre`='$nombre',`descripcion`='$descripcion' WHERE id_facultad = '$idfacu'";
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function facarreraelete($idfacu)
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
