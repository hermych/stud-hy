<?php
require_once "../config/db.php";

// session_start();

class Distrito
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  public function listarDistritos($iddep, $idprov)
  {
    // * Obtener el ID de caja abierta actualmente
    $sql_provincias = "SELECT * FROM `distritos` WHERE id_provincia = '$idprov' AND id_departamento = $iddep;";
    $listProv = $this->db->query($sql_provincias);
    $provincias = $listProv->fetch_all(MYSQLI_ASSOC);
    return $provincias;
  }
}
