<?php
session_start();
require_once "../models/universidad.php";
//require_once "../helpers/utils.php";

class UniversidadController
{
  /**Vistas */
  public function universidadView()
  {
    require_once "../views/universidad/index.php";
  }
  public function univEspecifico($id)
  {
    require_once "../views/universidad/univEspecifo.php";
  }
  public function universidadGView()
  {
    require_once "../views/universidad/indexG.php";
  }
  /**Metodos */
  public function universidadGList()
  {
    $indice = 1;
    $respuesta = [];
    $univObj = new Universidad();
    $universidades = $univObj->universidadGList();
    if (count($universidades) == 0) {
      $respuesta = [
        'indice' => '-',
        'id_universidad' => '',
        'departamento' => 'No hay datos',
        'provincia' => 'No hay datos',
        'distrito' => 'No hay datos',
        'id_prospecto  ' => 'No hay datos',
        'nombre' => 'No hay datos',
        'descripcion' => 'No hay datos',
        'imagen' => 'No hay datos',
      ];
    } else {
      foreach ($universidades as $key => $value) {
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
  public function universidadGListActivos()
  {
    $respuesta = [];
    $univObj = new Universidad();
    $universidades = $univObj->universidadGListActivos();
    return json_encode($universidades);
  }
  public function universidadGSave()
  {
    $respuesta = [];
    // proceso de guardar imagenes
    if (isset($_FILES['imagen'])) {
      $file = $_FILES['imagen'];
      $filename = $file['name'];
      $mimetype = $file['type'];
      $allowed_type = array("image/jpg", "image/jpeg", "image/png");

      if (!in_array($mimetype, $allowed_type)) {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'por favor, selecciona una imagen'
        ];
        return json_encode($respuesta);
      }
      // crear directorio upload
      if (!is_dir("../assets/image/fotosUniv")) {
        mkdir("../assets/image/fotosUniv", 0777);
      }
      // mover archivo a upload
      $rename = substr(sha1(rand(1, 999)), 0, -30) . "_" . $filename;
      $rutaLogo = "../assets/image/fotosUniv/" . $rename;
      move_uploaded_file($file['tmp_name'], $rutaLogo);
    }
    // proceso de guardar datos
    if (isset($_POST)) {
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $iddep = isset($_POST['iddep']) ? $_POST['iddep'] : false;
      $idprov = isset($_POST['idprov']) ? $_POST['idprov'] : false;
      $iddist = isset($_POST['iddist']) ? $_POST['iddist'] : false;
      $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
      if ($nombre && $iddep && $idprov && $iddist && $descripcion && $rename) {
        $univObj = new Universidad();
        $registrar = $univObj->guardarUniversidad($nombre, $iddep, $idprov, $iddist, $descripcion, $rename);
        if ($registrar == 1) {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Universidad registrada correctamente'
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
  public function universidadGEdit()
  {
    $respuesta = [];
    $rename = '';
    // proceso de guardar imagenes
    if (isset($_FILES['imagenEdit'])) {
      $file = $_FILES['imagenEdit'];
      $filename = $file['name'];
      $mimetype = $file['type'];
      $allowed_type = array("image/jpg", "image/jpeg", "image/png");

      if (!in_array($mimetype, $allowed_type)) {
        $respuesta = [
          'estado' => 'failed',
          'mensaje' => 'por favor, selecciona una imagen'
        ];
        return json_encode($respuesta);
      }
      // crear directorio upload
      if (!is_dir("../assets/image/fotosUniv")) {
        mkdir("../assets/image/fotosUniv", 0777);
      }
      // mover archivo a upload
      $rename = substr(sha1(rand(1, 999)), 0, -30) . "_" . $filename;
      $rutaLogo = "../assets/image/fotosUniv/" . $rename;
      move_uploaded_file($file['tmp_name'], $rutaLogo);
    }
    // proceso de guardar datos
    if (isset($_POST)) {
      $iduniv = isset($_POST['iduniv']) ? $_POST['iduniv'] : false;
      $nombre = isset($_POST['nombreEdit']) ? $_POST['nombreEdit'] : false;
      $iddep = isset($_POST['departamentoEdit']) ? $_POST['departamentoEdit'] : false;
      $idprov = isset($_POST['provinciaEdit']) ? $_POST['provinciaEdit'] : false;
      $iddist = isset($_POST['distritoEdit']) ? $_POST['distritoEdit'] : false;
      $descripcion = isset($_POST['descripcionEdit']) ? $_POST['descripcionEdit'] : false;
      $imagen = $rename;
      if ($iduniv && $nombre && $iddep && $idprov && $iddist && $descripcion) {
        $univObj = new Universidad();
        $registrar = $univObj->universidadGEdit($iduniv, $nombre, $iddep, $idprov, $iddist, $descripcion, $imagen);
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
  public function universidadGDelete()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $iduniv = isset($_POST['iduniv']) ? $_POST['iduniv'] : false;
      if ($iduniv) {
        $univObj = new Universidad();
        $registrar = $univObj->universidadGDelete($iduniv);
        if ($registrar['estado'] == 'ok') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Inahbilitacion realizada correctamente'
          ];
        } elseif ($registrar['estado'] == 'failed') {
          $mensaje = $registrar['mensaje'];
          $respuesta = [
            'estado' => 'failed',
            'mensaje' => "$mensaje"
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
  public function universidadGHabilitar()
  {
    // proceso de guardar datos
    if (isset($_POST)) {
      $iduniv = isset($_POST['iduniv']) ? $_POST['iduniv'] : false;
      if ($iduniv) {
        $univObj = new Universidad();
        $registrar = $univObj->universidadGHabilitar($iduniv);
        if ($registrar['estado'] == 'ok') {
          $respuesta = [
            'estado' => 'ok',
            'mensaje' => 'Proceso realizado correctamente'
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

$universidad = new UniversidadController();

if ($_GET['method'] == 'universidadView') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo ($universidad->univEspecifico($id));
  } else {
    echo ($universidad->universidadView());
  }
} elseif ($_GET['method'] == 'universidadGView') {
  echo ($universidad->universidadGView());
} elseif ($_GET['method'] == 'universidadGList') {
  echo ($universidad->universidadGList());
} elseif ($_GET['method'] == 'universidadGSave') {
  echo ($universidad->universidadGSave());
} elseif ($_GET['method'] == 'universidadGEdit') {
  echo ($universidad->universidadGEdit());
} elseif ($_GET['method'] == 'universidadGDelete') {
  echo ($universidad->universidadGDelete());
} elseif ($_GET['method'] == 'universidadGHabilitar') {
  echo ($universidad->universidadGHabilitar());
} elseif ($_GET['method'] == 'universidadGListActivos') {
  echo ($universidad->universidadGListActivos());
}
/* else {
  if ($_GET['method'] == 'login') {
    echo ($LoginObj->login());
  }
}
*/