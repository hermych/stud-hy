<?php
session_start();
require_once "../models/departamento.php";
//require_once "../helpers/utils.php";

class DepartamentoController
{
  public function listarDepartamentos()
  {
    $depaObj = new Departamento();
    $depaList = $depaObj->listarDepartamentos();
    $respuesta = $depaList;
    return json_encode($respuesta);
  }
}

$departamento = new DepartamentoController();

if ($_GET['method'] == 'listarDepartamentos') {
  echo ($departamento->listarDepartamentos());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/
