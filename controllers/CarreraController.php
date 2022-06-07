<?php
session_start();
require_once "../models/carrera.php";
//require_once "../helpers/utils.php";

class FacultadController
{
  /**Vistas */
  public function facultadView()
  {
    require_once "../views/universidad/index.php";
  }
  public function facuEspecifico($id)
  {
  }
  public function carreraGView()
  {
    require_once "../views/carrera/indexG.php";
  }
  /**Metodos */
  public function carreraGList()
  {
    $indice = 1;
    $respuesta = [];
    $facuObj = new Carrera();
    $facultades = $facuObj->carreraGList();
    if (count($facultades) == 0) {
      $respuesta = [
        'indice' => '-',
        'id_facultad' => '',
        'nombre' => 'No hay datos',
        'descripcion' => 'No hay datos',
      ];
    } else {
      foreach ($facultades as $key => $value) {
        $json['data'][$key] = $value;
      }
      for ($i = 0; $i < count($json['data']); $i++) {
        $json['data'][$i]['indice'] = $indice;
        $indice++;
      }
      $respuesta = $json;
    }
    return json_encode($respuesta);
  }
  public function carreraGSave()
  {
    $respuesta = [];
    // proceso de guardar datos
    if (isset($_POST)) {
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
      $grado = isset($_POST['grado']) ? $_POST['grado'] : false;
      $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
      $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
      $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : false;
      if ($nombre && $descripcion) {
        $facuObj = new Carrera();
        $registrar = $facuObj->carreraGSave($nombre, $duracion, $grado, $titulo, $descripcion, $perfil);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Facultad registrada correctamente'
          ];
        } else {
          $respuesta = [
            'estado' => 'failed',
            'mensaje' => 'Error en la consulta a la base de datos'
          ];
        }
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'Faltan enviar datos, por favor verifique'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error al enviar los datos al servidor'
      ];
    }
    return json_encode($respuesta);
  }
  public function carreraGEdit()
  {
    $respuesta = [];
    // proceso de guardar datos
    if (isset($_POST)) {
      $idfacu = isset($_POST['idfacu']) ? $_POST['idfacu'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
      if ($idfacu && $nombre && $descripcion) {
        $univObj = new Carrera();
        $registrar = $univObj->carreraGEdit($idfacu, $nombre, $descripcion);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Se editaron los datos correctamente'
          ];
        } else {
          $respuesta = [
            'estado' => 'failed',
            'mensaje' => 'Error en la consulta a la base de datos'
          ];
        }
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'Faltan enviar datos, por favor verifique'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error al enviar los datos al servidor'
      ];
    }
    return json_encode($respuesta);
  }
  public function facarreraelete()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idfacu = isset($_POST['idfacu']) ? $_POST['idfacu'] : false;
      if ($idfacu) {
        $univObj = new Carrera();
        $registrar = $univObj->facarreraelete($idfacu);
        if ($registrar['estado'] == 'ok') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Inahbilitacion realizada correctamente'
          ];
        } else {
          $respuesta = [
            'estado' => 'failed',
            'mensaje' => 'Error en la consulta a la base de datos'
          ];
        }
      } else {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'Faltan enviar datos, por favor verifique'
        ];
      }
    } else {
      $respuesta = [
        'estado' => 'failed',
        'mensaje' => 'Error al enviar los datos al servidor'
      ];
    }
    return json_encode($respuesta);
  }
}

$facultad = new FacultadController();

if ($_GET['method'] == 'universidadView') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo ($facultad->facuEspecifico($id));
  } else {
    echo ($facultad->facultadView());
  }
} elseif ($_GET['method'] == 'carreraGView') {
  echo ($facultad->carreraGView());
} elseif ($_GET['method'] == 'carreraGList') {
  echo ($facultad->carreraGList());
} elseif ($_GET['method'] == 'carreraGSave') {
  echo ($facultad->carreraGSave());
} elseif ($_GET['method'] == 'carreraGEdit') {
  echo ($facultad->carreraGEdit());
} elseif ($_GET['method'] == 'facarreraelete') {
  echo ($facultad->facarreraelete());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/