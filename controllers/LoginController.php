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
  public function login()
  {
    var_dump($_POST);
  }
}

$LoginObj = new LoginController();

if ($_GET['method'] == 'loginView') {
  echo ($LoginObj->index());
} else {
  if ($_GET['method'] == 'loginView') {
    echo ($LoginObj->login());
  }
}
