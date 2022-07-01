<?php
$porciones = explode("?", $_SERVER["REQUEST_URI"]);
if (count($porciones) > 1) {
  $porciones2 = explode("=", $porciones[1]);
  if ($porciones2[1] == 'loginView') {
    $title = 'Iniciar Sesion';
  } elseif ($porciones2[1] == 'registroView') {
    $title = 'Registrarse';
  } elseif ($porciones2[1] == 'universidadView') {
    $title = 'Universidades';
  } elseif ($porciones2[1] == 'universidadGView') {
    $title = 'Gestionar Universidad';
  } elseif ($porciones2[1] == 'facultadView') {
    $title = 'Facultades';
  } elseif ($porciones2[1] == 'facultadGView') {
    $title = 'Gestionar Facultades';
  } elseif ($porciones2[1] == 'carreraGView') {
    $title = 'Gestionar Carreras';
  } elseif ($porciones2[1] == 'plan_estudioView') {
    $title = 'Prospectos';
  } elseif ($porciones2[1] == 'cursosGView') {
    $title = 'Cursos';
  } elseif ($porciones2[1] == 'temasGView') {
    $title = 'Temas por Curso';
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


  <!-- links  -->
  <link href="../assets/css/librerias/styles_sidebar.css" rel="stylesheet">

</head>

<body>
  <!--1-->
  <div class="d-flex" id="wrapper">
    <!--2-->
    <div class="border-end bg-dark" id="sidebar-wrapper">
      <div class="sidebar-heading border-bottom"> Bootstrap</div>
      <div class="list-group list-group-flush ">
        <a class="list-group-item bg-dark list-group-item-action list-group-item p-3 text-light" href="../controllers/UniversidadController.php?method=universidadGView">G. Universidades</a>
        <a class="list-group-item bg-dark list-group-item-action list-group-item p-3 text-light" href="../controllers/FacultadController.php?method=facultadGView">G. Facultades</a>
        <a class="list-group-item bg-dark list-group-item-action list-group-item p-3 text-light" href="../controllers/CarreraController.php?method=carreraGView">G. Carreras</a>
        <a class="list-group-item bg-dark list-group-item-action list-group-item p-3 text-light" href="../controllers/PlanEstudioController.php?method=plan_estudioView">G. Planes de Estudio</a>
        <a class="list-group-item bg-dark list-group-item-action list-group-item p-3 text-light" href="../controllers/CursosController.php?method=cursosGView">G. Cursos</a>
        <a class="list-group-item bg-dark list-group-item-action list-group-item p-3 text-light" href="../controllers/TemasController.php?method=temasGView">G. Temas</a>
      </div>
      <!--2-->
    </div>
    <!--3-->
    <div id="page-content-wrapper">
      <!-- Top navigation -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
          <button class="btn btn-primary" id="sidebarToggle"><i class="fas fa-bars"></i></button>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link" href="#!">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#!">Link</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Something else here</a>
                                    </div>
                                </li>
                            </ul> 
                          -->
          </div>
        </div>
        <!--4-->
      </nav>
      <!-- Page content-->
      <div class="container-fluid">


        <!--</div>-->