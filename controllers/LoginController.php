<?php
session_start();
/*
require_once "../models/caja.php";
require_once "../helpers/utils.php";
*/

class LoginController
{
  public function loginVista()
  {
    require_once "../views/login/login.php";
  }
  public function login()
  {
    var_dump($_POST);
  }
  public function registroView()
  {
    require_once "../views/login/registro.php";
  }
  public function registrarUsuario()
  {
    $respuesta = [];
    if (isset($_POST)) {
      $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
      $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
      $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
      $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
      $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
      if ($nombres) {
        $respuesta = [$respuesta];
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'No se estan enviando todos los datos necesarios. Por favor verifique'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error con el servidor, por favor comuniquese con su soporte'
      ];
    }
    var_dump($respuesta);
  }
}

$LoginObj = new LoginController();

if ($_GET['method'] == 'loginView') {
  echo ($LoginObj->loginVista());
} else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  } elseif ($_GET['method'] == 'registroView') {
    echo ($LoginObj->registroView());
  } elseif ($_GET['method'] == 'registrarUsuario') {
    echo ($LoginObj->registrarUsuario());
  }
}
