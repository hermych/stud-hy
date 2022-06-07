<?php
session_start();
require_once "../models/facultad.php";
//require_once "../helpers/utils.php";

class FacultadController
{
  /**Vistas */
  public function facultadView()
  {
    require_once "../views/facultad/index.php";
  }
  public function facuEspecifico($id)
  {
  }
  public function facultadGView()
  {
    require_once "../views/facultad/indexG.php";
  }
  /**Metodos */
  public function facultadGList()
  {
    $indice = 1;
    $respuesta = [];
    $facuObj = new Facultad();
    $facultades = $facuObj->facultadGList();
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
  public function facultadGSave()
  {
    $respuesta = [];
    // proceso de guardar datos
    if (isset($_POST)) {
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;

      $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
      if ($nombre && $descripcion) {
        $facuObj = new Facultad();
        $registrar = $facuObj->facultadGSave($nombre, $descripcion);
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
  public function facultadGEdit()
  {
    $respuesta = [];
    // proceso de guardar datos
    if (isset($_POST)) {
      $idfacu = isset($_POST['idfacu']) ? $_POST['idfacu'] : false;
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
      if ($idfacu && $nombre && $descripcion) {
        $univObj = new Facultad();
        $registrar = $univObj->facultadGEdit($idfacu, $nombre, $descripcion);
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
  public function facultadGDelete()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $idfacu = isset($_POST['idfacu']) ? $_POST['idfacu'] : false;
      if ($idfacu) {
        $univObj = new Facultad();
        $registrar = $univObj->facultadGDelete($idfacu);
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

if ($_GET['method'] == 'facultadView') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo ($facultad->facuEspecifico($id));
  } else {
    echo ($facultad->facultadView());
  }
} elseif ($_GET['method'] == 'facultadGView') {
  echo ($facultad->facultadGView());
} elseif ($_GET['method'] == 'facultadGList') {
  echo ($facultad->facultadGList());
} elseif ($_GET['method'] == 'facultadGSave') {
  echo ($facultad->facultadGSave());
} elseif ($_GET['method'] == 'facultadGEdit') {
  echo ($facultad->facultadGEdit());
} elseif ($_GET['method'] == 'facultadGDelete') {
  echo ($facultad->facultadGDelete());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/