<?php
$porciones = explode("?", $_SERVER["REQUEST_URI"]);
if (count($porciones) > 1) {
  $porciones2 = explode("=", $porciones[1]);
  if ($porciones2[1] == 'loginView') {
    $title = 'Iniciar Sesion';
  } elseif ($porciones2[1] == 'registroView') {
    $title = 'Registrarse';
  } elseif ($porciones2[1] == 'universidadGView') {
    $title = 'Gestionar Universidad';
  } elseif ($porciones2[1] == 'facultadGView') {
    $title = 'Gestionar Facultades';
  }
} else {
  $title = 'Inicio';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Studhy | <?= $title ?></title>
  <!-- LINKS DE JS DE BOOTRSTRAP 5.* -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <!-- LINKS DE JS DE BOOTRSTRAP 4.* -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <!-- Bootstrap Link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- DATATABLE Link -->
  <link rel="stylesheet" href="../assets/css/librerias/datatables.min.css">
  <!-- ############## SWEET ALERT 2 ##############-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- ############## FONT AWESOME ##############-->
  <script src="https://kit.fontawesome.com/ec57de0117.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container-fluid">