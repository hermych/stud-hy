<?php
session_start();
require_once "../models/distrito.php";
//require_once "../helpers/utils.php";

class DistritoController
{
  public function listarDistritos()
  {
    $respuesta = [];
    if (isset($_POST)) {
      $iddep = isset($_POST['iddep']) ? $_POST['iddep'] : false;
      $idprov = isset($_POST['idprov']) ? $_POST['idprov'] : false;
      if ($iddep && $idprov) {
        $distObj = new Distrito();
        $distLis = $distObj->listarDistritos($iddep, $idprov);
        $respuesta = $distLis;
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'No se esta recibiendo los parametros necesarios'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error al hacer la peticion'
      ];
    }
    return json_encode($respuesta);
  }
}

$distrito = new DistritoController();

if ($_GET['method'] == 'listarDistritos') {
  echo ($distrito->listarDistritos());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/