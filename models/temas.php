<?php

require_once "../config/db.php";

class Temas
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  /* ##### METODOS ###### */
  public function temasGSave($nombre, $univ, $prosp, $curso)
  {
    $result = false;
    $sql = "INSERT INTO `temas`(`id_univ`, `id_prosp`, `nombre`) VALUES ('$univ','$prosp','$nombre')";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function temasGList()
  {
    $sql_facu = "SELECT c.*, u.nombre as 'universidad', p.nombre as 'prospecto' FROM temas as c, universidades as u, prospectos as p WHERE c.id_univ = u.id_universidad AND c.id_prosp = p.id_prospecto;";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function temasGEdit($iduniv, $idcurso, $nombre)
  {
    $sql_edit = "UPDATE `temas` SET `id_univ`='$iduniv',`nombre`='$nombre' WHERE `id_curso`='$idcurso'";
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function temasGDelete($idcurso)
  {
    /* Verificar si la facultad pertenece a algun registro */
    $respuesta = false;
    $consulta = "UPDATE `temas` SET `estado` = 'inactivo' WHERE id_curso = $idcurso;";
    $query = $this->db->query($consulta);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function temasGHabilitar($idcurso)
  {
    $respuesta = false;
    $sql_buscar = "UPDATE `temas` SET `estado` = 'activo' WHERE id_curso = $idcurso;";
    $query = $this->db->query($sql_buscar);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function temasGListEspecifico($iduniv)
  {
    $sql_facu = "SELECT id_facultad, nombre from  facultades WHERE id_univ = $iduniv";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
}
