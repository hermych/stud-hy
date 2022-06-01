<?php
session_start();
/*
require_once "../models/caja.php";
require_once "../helpers/utils.php";
*/

class LoginController
{
  public function index()
  {
    require_once "../views/login/login.php";
  }
}

$LoginObj = new LoginController();

if ($_GET['method'] == 'login') {
  echo ($LoginObj->index());
}
/*
if (isset($_SESSION['identity'])) {
  
} else {
  header("Location:../views/sinSesion.php");
}
*/
