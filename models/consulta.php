<?php

require_once "../config/db.php";

class Consultas
{
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  /* ##### METODOS ###### */
  public function consultasGSave($nombre, $univ, $prosp)
  {
    $result = false;
    $sql = "INSERT INTO `consultas`(`id_univ`, `id_prosp`, `nombre`) VALUES ('$univ','$prosp','$nombre')";
    $save = $this->db->query($sql);
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function consultasGList($recibo)
  {
    $sql_facu = "SELECT * FROM `datos` WHERE  `Numerorecibo` = $recibo";
    $listarFacus = $this->db->query($sql_facu);
    $consultas = $listarFacus->fetch_all(MYSQLI_ASSOC);
    // $nuevoArreglo = [];
    // for ($i = 0; $i < count($consultas); $i++) {
    //   $nuevoArreglo = [
    //     0 => [
    //       'ITM' => $consultas[$i]['ITM'],
    //       'Numerorecibo' => $consultas[$i]['Numerorecibo'],
    //       'Importe' => $consultas[$i]['Importe'],
    //       'rural' => "no",
    //     ]
    //   ];
    //   if ($consultas[$i]['Rural'] != '0') {
    //     $nuevo = [
    //       'ITM' => $consultas[$i]['ITM'],
    //       'Numerorecibo' => $consultas[$i]['Numerorecibo'],
    //       'Importe' => $consultas[$i]['Rural'],
    //       'rural' => "si",
    //     ];
    //     array_push($nuevoArreglo, $nuevo);
    //   }
    // }

    return $consultas;
  }
  public function consultasGEdit($iduniv, $idcurso, $nombre)
  {
    $sql_edit = "UPDATE `consultas` SET `id_univ`='$iduniv',`nombre`='$nombre' WHERE `id_curso`='$idcurso'";
    $editar = $this->db->query($sql_edit);
    return $editar;
  }
  public function consultasGDelete($idcurso)
  {
    /* Verificar si la facultad pertenece a algun registro */
    $respuesta = false;
    $consulta = "UPDATE `consultas` SET `estado` = 'inactivo' WHERE id_curso = $idcurso;";
    $query = $this->db->query($consulta);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function consultasGHabilitar($idcurso)
  {
    $respuesta = false;
    $sql_buscar = "UPDATE `consultas` SET `estado` = 'activo' WHERE id_curso = $idcurso;";
    $query = $this->db->query($sql_buscar);
    if ($query) {
      $respuesta = true;
    }
    return $respuesta;
  }
  public function consultasGListEspecifico($iduniv)
  {
    $sql_facu = "SELECT id_facultad, nombre from  facultades WHERE id_univ = $iduniv";
    $listarFacus = $this->db->query($sql_facu);
    $facultades = $listarFacus->fetch_all(MYSQLI_ASSOC);
    return $facultades;
  }
  public function cursoProspList($idpros)
  {
    $respuesta = [];
    $sql_prosp = "SELECT * FROM `consultas` WHERE id_prosp = $idpros;";
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
          "nombre" => "No existen consultas registrados para este prospecto",
          "estado" => ""
        ]
      ];
    }
    return $respuesta;
  }
}
