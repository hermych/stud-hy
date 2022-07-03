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
    $sql = "INSERT INTO `temas`(`id_univ`, `id_prosp`, `id_curso`,`nombre`) VALUES ('$univ','$prosp','$curso','$nombre')";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function temasGList()
  {
    $sql_facu = "SELECT t.*, u.nombre as 'universidad', p.nombre as 'prospecto', c.nombre as 'curso' FROM temas as t, universidades as u, prospectos as p, cursos as c WHERE t.id_univ = u.id_universidad AND t.id_prosp = p.id_prospecto AND t.id_curso = c.id_curso;";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function temasGEdit($idtema, $iduniv, $idpros, $idcurso, $nombre)
  {
    $sql_edit = "UPDATE `temas` SET `id_univ`='$iduniv',`id_prosp`='$idpros',`id_curso` = $idcurso,`nombre`='$nombre' WHERE `id_tema`='$idtema'";
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function temasGDelete($idtema)
  {
    /* Verificar si la facultad pertenece a algun registro */
    $respuesta = false;
    $consulta = "UPDATE `temas` SET `estado` = 'inactivo' WHERE id_tema = $idtema;";
    $query = $this->db->query($consulta);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function temasGHabilitar($idtema)
  {
    $respuesta = false;
    $sql_buscar = "UPDATE `temas` SET `estado` = 'activo' WHERE id_tema = $idtema;";
    $query = $this->db->query($sql_buscar);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  /*
  public function temasGListEspecifico($iduniv)
  {
    $sql_facu = "SELECT id_facultad, nombre from  facultades WHERE id_univ = $iduniv";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  */
}
