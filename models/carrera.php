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
  public function carreraGSave($univ, $facu, $nombre, $duracion, $grado, $titulo, $descripcion, $perfil, $plan_estudio)
  {
    $result = false;
    $sql = "INSERT INTO `carreras`(`id_univ`,`id_facu`,`nombre`, `descripcion`, `grado`, `titulo`, `duracion`, `perfil`, `plan_estudio`) VALUES ('$univ','$facu','$nombre','$descripcion','$grado','$titulo','$duracion','$perfil', '$plan_estudio')";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function carreraGList()
  {
    $sql_facu = "SELECT u.nombre as 'univ', f.nombre as 'facu', c.* FROM `carreras` as c, universidades as u, facultades as f WHERE c.id_univ = u.id_universidad AND c.id_facu=f.id_facultad;";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function carreraGEdit($id_carrera, $nombre, $duracion, $grado, $titulo, $descripcion, $perfil, $plan_estudio, $id_univ, $id_facu)
  {
    $sql_edit = "UPDATE `carreras` SET `id_univ`='$id_univ', `id_facu`='$id_facu', `nombre`='$nombre',`descripcion`='$descripcion',`grado`='$grado',`titulo`='$titulo',`duracion`='$duracion',`perfil`='$perfil'";
    if ($plan_estudio != '') {
      $sql_edit = "$sql_edit ,`plan_estudio`='$plan_estudio' WHERE `id_carrera` = '$id_carrera'";
    } else {
      $sql_edit = "$sql_edit WHERE `id_carrera` = '$id_carrera'";
    }
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function carreraGInhabilitar($id_carrera)
  {
    $respuesta = false;
    $sql_buscar = "UPDATE `carreras` SET `estado` = 'inactivo' WHERE id_carrera = $id_carrera;";
    $query = $this->db->query($sql_buscar);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function carreraGHabilitar($id_carrera)
  {
    $respuesta = false;
    $sql_buscar = "UPDATE `carreras` SET `estado` = 'activo' WHERE id_carrera = $id_carrera;";
    $query = $this->db->query($sql_buscar);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
}
