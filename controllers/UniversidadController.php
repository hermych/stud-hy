<?php
session_start();
//require_once "../models/universidad.php";
//require_once "../helpers/utils.php";

class UniversidadController
{
  public function universidadView()
  {
    require_once "../views/universidad/index.php";
  }
}

$universidad = new UniversidadController();

if ($_GET['method'] == 'universidadView') {
  echo ($universidad->universidadView());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/