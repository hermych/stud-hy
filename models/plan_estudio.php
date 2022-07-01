<?php

require_once "../config/db.php";

class Prospecto
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  /* ##### METODOS ###### */
  public function prospectoGSave($nombre, $univ)
  {
    $result = false;
    $sql = "INSERT INTO `prospectos`(`id_univ`, `nombre`) VALUES ('$univ','$nombre')";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function prospectoGList()
  {
    $sql_facu = "SELECT p.*, u.nombre as 'univ' FROM prospectos as p, universidades as u WHERE p.id_univ = u.id_universidad;";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function prospectoUnivList($iduniv)
  {
    $respuesta = [];
    $sql_prosp = "SELECT * FROM `prospectos` WHERE id_univ = $iduniv;";
    $listarProspectos = $this->db->query($sql_prosp);
    $prospectos = $listarProspectos->fetch_all(MYSQLI_ASSOC);
    if (count($prospectos) != 0) {
      $respuesta = $prospectos;
    } else {
      $respuesta = [
        0 => [
          "id_prospecto" =>  "0",
          "id_univ" => "",
          "nombre" => "No hay prospecto para esta Univ",
          "estado" => ""
        ]
      ];
    }
    return $respuesta;
  }
  public function prospectoGEdit($iduniv, $idpros, $nombre)
  {
    $sql_edit = "UPDATE `prospectos` SET `id_univ`='$iduniv',`nombre`='$nombre' WHERE `id_prospecto`='$idpros'";
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function prospectoGDelete($idpros)
  {
    /* Verificar si la facultad pertenece a algun registro */
    $respuesta = false;
    $consulta = "UPDATE `prospectos` SET `estado` = 'inactivo' WHERE id_prospecto = $idpros;";
    $query = $this->db->query($consulta);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function prospectoGHabilitar($idpros)
  {
    $respuesta = false;
    $sql_buscar = "UPDATE `prospectos` SET `estado` = 'activo' WHERE id_prospecto = $idpros;";
    $query = $this->db->query($sql_buscar);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function prospectoGListEspecifico($iduniv)
  {
    $sql_facu = "SELECT id_facultad, nombre from  facultades WHERE id_univ = $iduniv";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
}
