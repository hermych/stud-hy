<?php
session_start();
require_once "../models/provincia.php";
//require_once "../helpers/utils.php";

class ProvinciaController
{
  public function listarProvincias()
  {
    $respuesta = [];
    if (isset($_POST)) {
      $iddep = isset($_POST['iddep']) ? $_POST['iddep'] : false;
      if ($iddep) {
        $provObj = new Provincia();
        $provList = $provObj->listarProvincias($iddep);
        $respuesta = $provList;
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'No se esta recibiendo los parametros necesarios'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error al realizar la peticion'
      ];
    }
    return json_encode($respuesta);
  }
}

$provincia = new ProvinciaController();

if ($_GET['method'] == 'listarProvincias') {
  echo ($provincia->listarProvincias());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/