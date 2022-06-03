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
  public function registroView(){
    require_once "../views/login/registro.php";
  }
  public function registrarUsuario(){
    $respuesta = [];
    if(isset($_POST)){
      $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
      $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
      $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
      $email = isset($_POST['email']) ? $_POST['email'] : false;
      $celular = isset($_POST['celular']) ? $_POST['celular'] : false;
      $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
      $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
      $contrasena2 = isset($_POST['contrasena2']) ? $_POST['contrasena2'] : false;
      $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
      $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
      $distrito = isset($_POST['distrito']) ? $_POST['distrito'] : false;
      $egresado = isset($_POST['egresado']) ? $_POST['egresado'] : false;
      $anio_egreso = isset($_POST['anio_egreso']) ? $_POST['anio_egreso'] : false;
      if($nombres){
        $respuesta = [$respuesta];
      }else{
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'No se estan enviando todos los datos necesarios. Por favor verifique'
        ];
      }
    }else{
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
  }elseif ($_GET['method'] == 'registroView') {
    echo ($LoginObj->registroView());
  }elseif ($_GET['method'] == 'registrarUsuario'){
    echo ($LoginObj->registrarUsuario());
  }
}
