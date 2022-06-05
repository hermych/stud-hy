<?php
require_once "../config/db.php";

// session_start();

class Departamento
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  public function listarDepartamentos()
  {
    $sql_departamentos = "SELECT * FROM `departamentos`";
    $listDepa = $this->db->query($sql_departamentos);
    $departamentos = $listDepa->fetch_all(MYSQLI_ASSOC);
    return $departamentos;
  }
}
