<?php

require_once "../config/db.php";

class Cursos
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  /* ##### METODOS ###### */
  public function cursosGSave($nombre, $univ, $prosp)
  {
    $result = false;
    $sql = "INSERT INTO `cursos`(`id_univ`, `id_prosp`, `nombre`) VALUES ('$univ','$prosp','$nombre')";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function cursosGList()
  {
    $sql_facu = "SELECT c.*, u.nombre as 'universidad', p.nombre as 'prospecto' FROM cursos as c, universidades as u, prospectos as p WHERE c.id_univ = u.id_universidad AND c.id_prosp = p.id_prospecto;";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function cursosGEdit($iduniv, $idcurso, $nombre)
  {
    $sql_edit = "UPDATE `cursos` SET `id_univ`='$iduniv',`nombre`='$nombre' WHERE `id_curso`='$idcurso'";
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function cursosGDelete($idcurso)
  {
    /* Verificar si la facultad pertenece a algun registro */
    $respuesta = false;
    $consulta = "UPDATE `cursos` SET `estado` = 'inactivo' WHERE id_curso = $idcurso;";
    $query = $this->db->query($consulta);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function cursosGHabilitar($idcurso)
  {
    $respuesta = false;
    $sql_buscar = "UPDATE `cursos` SET `estado` = 'activo' WHERE id_curso = $idcurso;";
    $query = $this->db->query($sql_buscar);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function cursosGListEspecifico($iduniv)
  {
    $sql_facu = "SELECT id_facultad, nombre from  facultades WHERE id_univ = $iduniv";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function cursoProspList($idpros)
  {
    $respuesta = [];
    $sql_prosp = "SELECT * FROM `cursos` WHERE id_prosp = $idpros;";
    $listarProspectos = $this->db->query($sql_prosp);
    $prospectos = $listarProspectos->fetch_all(MYSQLI_ASSOC);
    if (count($prospectos) != 0) {
      $respuesta = $prospectos;
    } else {
      $respuesta = [
        0 => [
          "id_curso" =>  "0",
          "id_univ" => "",
          "id_prosp" => "",
          "nombre" => "No existen cursos registrados para este prospecto",
          "estado" => ""
        ]
      ];
    }
    return $respuesta;
  }
}
